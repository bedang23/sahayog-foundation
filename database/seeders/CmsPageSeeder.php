<?php

namespace Database\Seeders;

use App\Models\Page;
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
            Page::query()->updateOrCreate(
                ['slug' => $slug],
                [
                    'title' => Arr::get($config, 'name', ucfirst($slug)),
                    'content' => Arr::get($config, 'defaults.content', []),
                    'meta' => Arr::get($config, 'defaults.meta', []),
                ]
            );
        }
    }
}
