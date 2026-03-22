<?php

namespace Database\Seeders;

use App\Models\Media;
use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class CmsMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = config('cms.pages', []);

        foreach ($pages as $slug => $config) {
            $page = Page::query()->firstWhere('slug', $slug);

            if (! $page) {
                continue;
            }

            $pageMedia = Arr::get($config, 'defaults.media', []);
            foreach ($pageMedia as $key => $item) {
                Media::query()->updateOrCreate(
                    [
                        'page_id' => $page->id,
                        'group' => 'page',
                        'key' => $key,
                    ],
                    [
                        'disk' => $item['disk'] ?? 'public',
                        'path' => $item['path'] ?? '',
                        'is_external' => (bool) ($item['is_external'] ?? true),
                        'alt_text' => $item['alt_text'] ?? null,
                        'caption' => $item['caption'] ?? null,
                        'category' => $item['category'] ?? null,
                        'sort_order' => (int) ($item['sort_order'] ?? 0),
                    ]
                );
            }

            if (Arr::get($config, 'editor.uses_gallery_manager')) {
                $galleryItems = Arr::get($config, 'defaults.gallery_items', []);

                foreach ($galleryItems as $item) {
                    Media::query()->updateOrCreate(
                        [
                            'page_id' => $page->id,
                            'group' => 'gallery',
                            'key' => $item['key'],
                        ],
                        [
                            'disk' => $item['disk'] ?? 'public',
                            'path' => $item['path'] ?? '',
                            'is_external' => (bool) ($item['is_external'] ?? true),
                            'alt_text' => $item['alt_text'] ?? null,
                            'caption' => $item['caption'] ?? null,
                            'category' => $item['category'] ?? null,
                            'sort_order' => (int) ($item['sort_order'] ?? 0),
                        ]
                    );
                }
            }
        }
    }
}
