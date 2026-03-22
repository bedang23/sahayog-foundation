<?php

namespace App\Services;

use App\Models\Gallery;
use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class CmsService
{
    public function pageConfig(string $slug): array
    {
        $config = config("cms.pages.{$slug}");

        if (! is_array($config)) {
            abort(404);
        }

        return $config;
    }

    public function allPageConfigs(): array
    {
        return config('cms.pages', []);
    }

    public function getPagePayload(string $slug): array
    {
        $config = $this->pageConfig($slug);
        $page = $this->getOrCreatePage($slug);

        $this->syncDefaultSections($page, $config);

        $sectionRows = $page->sections()
            ->orderBy('section_name')
            ->orderBy('field_name')
            ->get();

        $content = $this->buildContent(
            Arr::get($config, 'defaults.content', []),
            $sectionRows->where('section_name', '!=', 'media')
        );

        $media = $this->buildMedia(
            Arr::get($config, 'defaults.media', []),
            $sectionRows->where('section_name', 'media')
        );

        $metaDefaults = Arr::get($config, 'defaults.meta', []);
        $meta = [
            'meta_title' => $page->meta_title ?: ($metaDefaults['meta_title'] ?? ''),
            'meta_description' => $page->meta_description ?: ($metaDefaults['meta_description'] ?? ''),
            'meta_keywords' => $page->meta_keywords ?: ($metaDefaults['meta_keywords'] ?? ''),
            'og_title' => $page->og_title ?: ($metaDefaults['og_title'] ?? ''),
            'og_description' => $page->og_description ?: ($metaDefaults['og_description'] ?? ''),
            'og_image' => $page->og_image ?: ($metaDefaults['og_image'] ?? ''),
        ];

        $galleryItems = $this->galleryPayload($config);

        return [
            'page' => $page,
            'config' => $config,
            'content' => $content,
            'meta' => $meta,
            'media' => $media,
            'galleryItems' => $galleryItems,
        ];
    }

    public function getOrCreatePage(string $slug): Page
    {
        $config = $this->pageConfig($slug);
        $meta = Arr::get($config, 'defaults.meta', []);

        return Page::query()->firstOrCreate(
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
    }

    public function pagesForDashboard(): Collection
    {
        $existingPages = Page::query()->get()->keyBy('slug');

        return collect($this->allPageConfigs())
            ->map(function (array $config, string $slug) use ($existingPages): array {
                $page = $existingPages->get($slug);

                return [
                    'slug' => $slug,
                    'name' => Arr::get($config, 'name', ucfirst($slug)),
                    'updated_at' => $page?->updated_at,
                    'public_route' => $slug === 'home' ? 'home' : $slug,
                ];
            })
            ->values();
    }

    public function sectionsForEditor(Page $page): Collection
    {
        return $page->sections()
            ->orderBy('section_name')
            ->orderBy('field_name')
            ->get()
            ->groupBy('section_name');
    }

    public function fieldLabel(string $fieldName): string
    {
        $label = str_replace(['.', '_', '-'], ' ', $fieldName);

        return ucfirst($label);
    }

    private function syncDefaultSections(Page $page, array $config): void
    {
        $defaults = [];

        foreach ($this->flattenArray(Arr::get($config, 'defaults.content', [])) as $dotKey => $value) {
            [$section, $field] = $this->splitDotKey($dotKey);
            $defaults[] = [
                'page_id' => $page->id,
                'section_name' => $section,
                'field_name' => $field,
                'field_value' => $this->normalizeScalar($value),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        foreach (Arr::get($config, 'defaults.media', []) as $mediaKey => $mediaData) {
            $defaults[] = [
                'page_id' => $page->id,
                'section_name' => 'media',
                'field_name' => "{$mediaKey}.path",
                'field_value' => $mediaData['path'] ?? '',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $defaults[] = [
                'page_id' => $page->id,
                'section_name' => 'media',
                'field_name' => "{$mediaKey}.alt_text",
                'field_value' => $mediaData['alt_text'] ?? '',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $defaults[] = [
                'page_id' => $page->id,
                'section_name' => 'media',
                'field_name' => "{$mediaKey}.caption",
                'field_value' => $mediaData['caption'] ?? '',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $defaults[] = [
                'page_id' => $page->id,
                'section_name' => 'media',
                'field_name' => "{$mediaKey}.is_external",
                'field_value' => isset($mediaData['is_external']) && $mediaData['is_external'] ? '1' : '0',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $defaults[] = [
                'page_id' => $page->id,
                'section_name' => 'media',
                'field_name' => "{$mediaKey}.disk",
                'field_value' => $mediaData['disk'] ?? 'public',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if ($defaults !== []) {
            foreach ($defaults as $row) {
                PageSection::query()->firstOrCreate(
                    [
                        'page_id' => $row['page_id'],
                        'section_name' => $row['section_name'],
                        'field_name' => $row['field_name'],
                    ],
                    [
                        'field_value' => $row['field_value'],
                    ]
                );
            }
        }
    }

    /**
     * @param  array<string, mixed>  $defaultContent
     */
    private function buildContent(array $defaultContent, Collection $rows): array
    {
        $defaultDot = $this->flattenArray($defaultContent);
        $rowDot = [];

        foreach ($rows as $row) {
            $dotKey = $row->section_name === 'general'
                ? $row->field_name
                : $row->section_name.'.'.$row->field_name;
            $rowDot[$dotKey] = $row->field_value;
        }

        $contentDot = [];

        foreach ($defaultDot as $dotKey => $defaultValue) {
            if (array_key_exists($dotKey, $rowDot)) {
                $contentDot[$dotKey] = $this->castStoredValue($rowDot[$dotKey], $defaultValue);
            } else {
                $contentDot[$dotKey] = $defaultValue;
            }
        }

        foreach ($rowDot as $dotKey => $storedValue) {
            if (array_key_exists($dotKey, $contentDot)) {
                continue;
            }

            $contentDot[$dotKey] = $storedValue;
        }

        return Arr::undot($contentDot);
    }

    /**
     * @param  array<string, mixed>  $defaultMedia
     */
    private function buildMedia(array $defaultMedia, Collection $rows): array
    {
        $media = [];
        $rowMap = [];

        foreach ($rows as $row) {
            $rowMap[$row->field_name] = $row->field_value;
        }

        foreach ($defaultMedia as $mediaKey => $defaultData) {
            $path = $rowMap["{$mediaKey}.path"] ?? ($defaultData['path'] ?? '');
            $disk = $rowMap["{$mediaKey}.disk"] ?? ($defaultData['disk'] ?? 'public');
            $isExternal = (string) ($rowMap["{$mediaKey}.is_external"] ?? (($defaultData['is_external'] ?? true) ? '1' : '0')) === '1';
            $altText = $rowMap["{$mediaKey}.alt_text"] ?? ($defaultData['alt_text'] ?? '');
            $caption = $rowMap["{$mediaKey}.caption"] ?? ($defaultData['caption'] ?? '');

            $url = $path;
            if (! $isExternal && ! empty($path)) {
                $url = Storage::disk($disk ?: 'public')->url($path);
            }

            $media[$mediaKey] = [
                'key' => $mediaKey,
                'path' => $path,
                'url' => $url,
                'disk' => $disk,
                'is_external' => $isExternal,
                'alt_text' => $altText,
                'caption' => $caption,
                'category' => '',
                'label' => $defaultData['label'] ?? ucfirst(str_replace('_', ' ', $mediaKey)),
            ];
        }

        return $media;
    }

    private function galleryPayload(array $config): array
    {
        $items = Gallery::query()
            ->latest('created_at')
            ->get();

        if ($items->isNotEmpty()) {
            return $items->map(function (Gallery $item): array {
                return [
                    'id' => $item->id,
                    'url' => $item->image_url,
                    'path' => $item->image_path,
                    'caption' => $item->title,
                    'title' => $item->title,
                    'alt_text' => $item->alt_text ?? '',
                    'category' => '',
                ];
            })->values()->all();
        }

        return collect(Arr::get($config, 'defaults.gallery_items', []))
            ->map(function (array $item): array {
                return [
                    'id' => null,
                    'url' => $item['path'],
                    'path' => $item['path'],
                    'caption' => $item['caption'] ?? '',
                    'title' => $item['caption'] ?? '',
                    'alt_text' => $item['alt_text'] ?? '',
                    'category' => '',
                ];
            })
            ->values()
            ->all();
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

    private function castStoredValue(?string $storedValue, mixed $defaultValue): mixed
    {
        if ($storedValue === null) {
            return $defaultValue;
        }

        if (is_bool($defaultValue)) {
            return in_array(strtolower($storedValue), ['1', 'true', 'yes', 'on'], true);
        }

        if (is_int($defaultValue)) {
            return (int) $storedValue;
        }

        if (is_float($defaultValue)) {
            return (float) $storedValue;
        }

        return $storedValue;
    }
}
