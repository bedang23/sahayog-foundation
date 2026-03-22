<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class CmsPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = config('cms.pages', []);

        foreach ($pages as $slug => $config) {
            $meta = Arr::get($config, 'defaults.meta', []);

            Page::query()->updateOrCreate(
                ['slug' => $slug],
                [
                    'title' => Arr::get($config, 'name', ucfirst($slug)),
                    'meta_title' => $meta['meta_title'] ?? null,
                    'meta_description' => $meta['meta_description'] ?? null,
                    'meta_keywords' => $meta['meta_keywords'] ?? null,
                    'og_title' => $meta['og_title'] ?? null,
                    'og_description' => $meta['og_description'] ?? null,
                    'og_image' => $meta['og_image'] ?? null,
                ]
            );

            $page = Page::query()->where('slug', $slug)->first();

            if (! $page) {
                continue;
            }

            $rows = [];
            $flattenedContent = $this->flattenArray(Arr::get($config, 'defaults.content', []));

            foreach ($flattenedContent as $dotKey => $value) {
                [$section, $field] = $this->splitDotKey($dotKey);
                $rows[] = [
                    'page_id' => $page->id,
                    'section_name' => $section,
                    'field_name' => $field,
                    'field_value' => $this->normalizeScalar($value),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            foreach (Arr::get($config, 'defaults.media', []) as $mediaKey => $mediaData) {
                $rows[] = [
                    'page_id' => $page->id,
                    'section_name' => 'media',
                    'field_name' => "{$mediaKey}.path",
                    'field_value' => $mediaData['path'] ?? '',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                $rows[] = [
                    'page_id' => $page->id,
                    'section_name' => 'media',
                    'field_name' => "{$mediaKey}.alt_text",
                    'field_value' => $mediaData['alt_text'] ?? '',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                $rows[] = [
                    'page_id' => $page->id,
                    'section_name' => 'media',
                    'field_name' => "{$mediaKey}.caption",
                    'field_value' => $mediaData['caption'] ?? '',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                $rows[] = [
                    'page_id' => $page->id,
                    'section_name' => 'media',
                    'field_name' => "{$mediaKey}.is_external",
                    'field_value' => (($mediaData['is_external'] ?? true) ? '1' : '0'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                $rows[] = [
                    'page_id' => $page->id,
                    'section_name' => 'media',
                    'field_name' => "{$mediaKey}.disk",
                    'field_value' => $mediaData['disk'] ?? 'public',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            $legacyScalarSections = collect(array_keys($flattenedContent))
                ->filter(fn (string $key): bool => ! str_contains($key, '.'))
                ->values()
                ->all();

            if ($legacyScalarSections !== []) {
                PageSection::query()
                    ->where('page_id', $page->id)
                    ->where('field_name', 'value')
                    ->whereIn('section_name', $legacyScalarSections)
                    ->delete();
            }

            if ($rows !== []) {
                PageSection::query()->upsert(
                    $rows,
                    ['page_id', 'section_name', 'field_name'],
                    ['field_value', 'updated_at']
                );
            }
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
}
