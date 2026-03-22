<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasTable('pages')) {
            return;
        }

        Schema::table('pages', function (Blueprint $table): void {
            if (! Schema::hasColumn('pages', 'meta_title')) {
                $table->string('meta_title')->nullable()->after('title');
            }
            if (! Schema::hasColumn('pages', 'meta_description')) {
                $table->text('meta_description')->nullable()->after('meta_title');
            }
            if (! Schema::hasColumn('pages', 'meta_keywords')) {
                $table->text('meta_keywords')->nullable()->after('meta_description');
            }
            if (! Schema::hasColumn('pages', 'og_title')) {
                $table->string('og_title')->nullable()->after('meta_keywords');
            }
            if (! Schema::hasColumn('pages', 'og_description')) {
                $table->text('og_description')->nullable()->after('og_title');
            }
            if (! Schema::hasColumn('pages', 'og_image')) {
                $table->text('og_image')->nullable()->after('og_description');
            }
        });

        if (Schema::hasColumn('pages', 'meta') || Schema::hasColumn('pages', 'content')) {
            $pageRows = DB::table('pages')
                ->select('id', 'meta', 'content', 'meta_title', 'meta_description', 'meta_keywords', 'og_title', 'og_description', 'og_image')
                ->get();

            foreach ($pageRows as $row) {
                if (! empty($row->meta)) {
                    $meta = json_decode((string) $row->meta, true);
                    if (is_array($meta)) {
                        DB::table('pages')
                            ->where('id', $row->id)
                            ->update([
                                'meta_title' => $row->meta_title ?: ($meta['meta_title'] ?? null),
                                'meta_description' => $row->meta_description ?: ($meta['meta_description'] ?? null),
                                'meta_keywords' => $row->meta_keywords ?: ($meta['meta_keywords'] ?? null),
                                'og_title' => $row->og_title ?: ($meta['og_title'] ?? null),
                                'og_description' => $row->og_description ?: ($meta['og_description'] ?? null),
                                'og_image' => $row->og_image ?: ($meta['og_image'] ?? null),
                            ]);
                    }
                }

                if (! empty($row->content)) {
                    $content = json_decode((string) $row->content, true);
                    if (is_array($content)) {
                        foreach ($this->flattenArray($content) as $dotKey => $value) {
                            [$section, $field] = $this->splitDotKey($dotKey);
                            $this->upsertPageSection((int) $row->id, $section, $field, $value);
                        }
                    }
                }
            }
        }

        if (Schema::hasTable('media')) {
            $mediaRows = DB::table('media')
                ->select('id', 'page_id', 'group', 'key', 'disk', 'path', 'is_external', 'alt_text', 'caption', 'created_at', 'updated_at')
                ->get();

            foreach ($mediaRows as $media) {
                if (empty($media->page_id)) {
                    continue;
                }

                if ($media->group === 'page') {
                    $this->upsertPageSection((int) $media->page_id, 'media', "{$media->key}.path", $media->path);
                    $this->upsertPageSection((int) $media->page_id, 'media', "{$media->key}.disk", $media->disk ?: 'public');
                    $this->upsertPageSection((int) $media->page_id, 'media', "{$media->key}.is_external", (bool) $media->is_external);
                    $this->upsertPageSection((int) $media->page_id, 'media', "{$media->key}.alt_text", $media->alt_text);
                    $this->upsertPageSection((int) $media->page_id, 'media', "{$media->key}.caption", $media->caption);
                }

                if ($media->group === 'gallery' && ! empty($media->path)) {
                    DB::table('galleries')->updateOrInsert(
                        ['image_path' => (string) $media->path],
                        [
                            'title' => $media->caption,
                            'alt_text' => $media->alt_text,
                            'created_at' => $media->created_at ?? now(),
                            'updated_at' => $media->updated_at ?? now(),
                        ]
                    );
                }
            }
        }

        $hasContent = Schema::hasColumn('pages', 'content');
        $hasMeta = Schema::hasColumn('pages', 'meta');
        if ($hasContent || $hasMeta) {
            Schema::table('pages', function (Blueprint $table) use ($hasContent, $hasMeta): void {
                if ($hasContent) {
                    $table->dropColumn('content');
                }
                if ($hasMeta) {
                    $table->dropColumn('meta');
                }
            });
        }

        if (Schema::hasTable('media') && Schema::hasColumn('media', 'meta')) {
            Schema::table('media', function (Blueprint $table): void {
                $table->dropColumn('meta');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasTable('pages')) {
            return;
        }

        Schema::table('pages', function (Blueprint $table): void {
            if (! Schema::hasColumn('pages', 'content')) {
                $table->json('content')->nullable()->after('title');
            }
            if (! Schema::hasColumn('pages', 'meta')) {
                $table->json('meta')->nullable()->after('content');
            }
        });

        Schema::table('pages', function (Blueprint $table): void {
            $drops = [];
            foreach (['meta_title', 'meta_description', 'meta_keywords', 'og_title', 'og_description', 'og_image'] as $column) {
                if (Schema::hasColumn('pages', $column)) {
                    $drops[] = $column;
                }
            }

            if ($drops !== []) {
                $table->dropColumn($drops);
            }
        });

        if (Schema::hasTable('media') && ! Schema::hasColumn('media', 'meta')) {
            Schema::table('media', function (Blueprint $table): void {
                $table->json('meta')->nullable()->after('sort_order');
            });
        }
    }

    /**
     * @param  array<string|int, mixed>  $values
     * @return array<string, mixed>
     */
    private function flattenArray(array $values, string $prefix = ''): array
    {
        $flattened = [];

        foreach ($values as $key => $value) {
            $segment = (string) $key;
            $dotKey = $prefix === '' ? $segment : "{$prefix}.{$segment}";

            if (is_array($value)) {
                $flattened += $this->flattenArray($value, $dotKey);
                continue;
            }

            $flattened[$dotKey] = $value;
        }

        return $flattened;
    }

    /**
     * @return array{0:string,1:string}
     */
    private function splitDotKey(string $dotKey): array
    {
        if (! str_contains($dotKey, '.')) {
            return ['general', $dotKey];
        }

        $segments = explode('.', $dotKey);
        $section = array_shift($segments) ?: 'general';
        $field = implode('.', $segments);

        return [$section, $field === '' ? 'value' : $field];
    }

    private function upsertPageSection(int $pageId, string $section, string $field, mixed $value): void
    {
        DB::table('page_sections')->updateOrInsert(
            [
                'page_id' => $pageId,
                'section_name' => $section,
                'field_name' => $field,
            ],
            [
                'field_value' => $this->normalizeScalar($value),
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );
    }

    private function normalizeScalar(mixed $value): ?string
    {
        if ($value === null) {
            return null;
        }

        if (is_bool($value)) {
            return $value ? '1' : '0';
        }

        return (string) $value;
    }
};
