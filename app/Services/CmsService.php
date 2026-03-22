<?php

namespace App\Services;

use App\Models\Media;
use App\Models\Page;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

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
        $page = Page::query()->where('slug', $slug)->first();

        $defaultContent = Arr::get($config, 'defaults.content', []);
        $defaultMeta = Arr::get($config, 'defaults.meta', []);

        $content = $this->mergeDefaults($defaultContent, $page?->content ?? []);
        $meta = $this->mergeDefaults($defaultMeta, $page?->meta ?? []);
        $media = $this->resolvePageMedia($page, $config);
        $galleryItems = $this->resolveGalleryMedia($page, $config);

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

        return Page::query()->firstOrCreate(
            ['slug' => $slug],
            [
                'title' => Arr::get($config, 'name', ucfirst($slug)),
                'content' => Arr::get($config, 'defaults.content', []),
                'meta' => Arr::get($config, 'defaults.meta', []),
            ]
        );
    }

    public function pagesForDashboard(): Collection
    {
        $existingPages = Page::query()->get()->keyBy('slug');

        return collect($this->allPageConfigs())
            ->map(function (array $config, string $slug) use ($existingPages) {
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

    public function mediaDefinition(string $slug, string $mediaKey): array
    {
        $config = $this->pageConfig($slug);

        return Arr::get($config, "defaults.media.{$mediaKey}", []);
    }

    public function mergeDefaults(array $defaults, array $overrides): array
    {
        return array_replace_recursive($defaults, $overrides);
    }

    private function resolvePageMedia(?Page $page, array $config): array
    {
        $defaults = Arr::get($config, 'defaults.media', []);
        $mediaRows = collect();

        if ($page) {
            $mediaRows = $page->media()
                ->where('group', 'page')
                ->get()
                ->keyBy('key');
        }

        $resolved = [];

        foreach ($defaults as $key => $default) {
            /** @var Media|null $row */
            $row = $mediaRows->get($key);

            if ($row) {
                $resolved[$key] = [
                    'id' => $row->id,
                    'key' => $row->key,
                    'url' => $row->url,
                    'path' => $row->path,
                    'disk' => $row->disk,
                    'is_external' => (bool) $row->is_external,
                    'alt_text' => $row->alt_text ?? ($default['alt_text'] ?? ''),
                    'caption' => $row->caption ?? ($default['caption'] ?? ''),
                    'category' => $row->category ?? ($default['category'] ?? ''),
                    'sort_order' => (int) $row->sort_order,
                    'label' => $default['label'] ?? ucwords(str_replace('_', ' ', $key)),
                ];

                continue;
            }

            $resolved[$key] = [
                'id' => null,
                'key' => $key,
                'url' => $default['path'] ?? '',
                'path' => $default['path'] ?? '',
                'disk' => $default['disk'] ?? 'public',
                'is_external' => (bool) ($default['is_external'] ?? true),
                'alt_text' => $default['alt_text'] ?? '',
                'caption' => $default['caption'] ?? '',
                'category' => $default['category'] ?? '',
                'sort_order' => (int) ($default['sort_order'] ?? 0),
                'label' => $default['label'] ?? ucwords(str_replace('_', ' ', $key)),
            ];
        }

        return $resolved;
    }

    private function resolveGalleryMedia(?Page $page, array $config): array
    {
        if (! Arr::get($config, 'editor.uses_gallery_manager')) {
            return [];
        }

        if ($page) {
            $rows = $page->media()
                ->where('group', 'gallery')
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get();

            if ($rows->isNotEmpty()) {
                return $rows->map(function (Media $row): array {
                    return [
                        'id' => $row->id,
                        'key' => $row->key,
                        'url' => $row->url,
                        'path' => $row->path,
                        'disk' => $row->disk,
                        'is_external' => (bool) $row->is_external,
                        'alt_text' => $row->alt_text ?? '',
                        'caption' => $row->caption ?? '',
                        'category' => $row->category ?? '',
                        'sort_order' => (int) $row->sort_order,
                    ];
                })->all();
            }
        }

        return collect(Arr::get($config, 'defaults.gallery_items', []))
            ->sortBy('sort_order')
            ->values()
            ->map(function (array $item): array {
                return [
                    'id' => null,
                    'key' => $item['key'],
                    'url' => $item['path'],
                    'path' => $item['path'],
                    'disk' => $item['disk'] ?? 'public',
                    'is_external' => (bool) ($item['is_external'] ?? true),
                    'alt_text' => $item['alt_text'] ?? '',
                    'caption' => $item['caption'] ?? '',
                    'category' => $item['category'] ?? '',
                    'sort_order' => (int) ($item['sort_order'] ?? 0),
                ];
            })
            ->all();
    }
}
