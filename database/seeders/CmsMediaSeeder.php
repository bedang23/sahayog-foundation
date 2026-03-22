<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class CmsMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $galleryItems = Arr::get(config('cms.pages', []), 'gallery.defaults.gallery_items', []);

        foreach ($galleryItems as $item) {
            Gallery::query()->updateOrCreate(
                ['image_path' => $item['path'] ?? ''],
                [
                    'title' => $item['caption'] ?? null,
                    'alt_text' => $item['alt_text'] ?? null,
                ]
            );
        }
    }
}
