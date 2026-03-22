<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\Page;
use App\Services\CmsService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PageController extends Controller
{
    public function __construct(private readonly CmsService $cms)
    {
    }

    public function edit(string $slug): View
    {
        $config = $this->cms->pageConfig($slug);
        $page = $this->cms->getOrCreatePage($slug);
        $payload = $this->cms->getPagePayload($slug);

        return view('admin.pages.edit', [
            'slug' => $slug,
            'pageRecord' => $page,
            'pageName' => Arr::get($config, 'name', ucfirst($slug)),
            'editorConfig' => Arr::get($config, 'editor', []),
            'content' => $payload['content'],
            'meta' => $payload['meta'],
            'media' => $payload['media'],
            'galleryItems' => $payload['galleryItems'],
        ]);
    }

    public function update(Request $request, string $slug): RedirectResponse
    {
        $config = $this->cms->pageConfig($slug);
        $page = $this->cms->getOrCreatePage($slug);

        $request->validate([
            'meta.meta_title' => ['nullable', 'string', 'max:255'],
            'meta.meta_description' => ['nullable', 'string'],
            'meta.meta_keywords' => ['nullable', 'string'],
            'meta.og_title' => ['nullable', 'string', 'max:255'],
            'meta.og_description' => ['nullable', 'string'],
            'meta.og_image' => ['nullable', 'url'],
            'content_full_json' => ['nullable', 'string'],
            'media_uploads.*' => ['nullable', 'image', 'max:6144'],
            'media_url.*' => ['nullable', 'url'],
            'media_alt.*' => ['nullable', 'string', 'max:255'],
            'media_caption.*' => ['nullable', 'string', 'max:255'],
            'gallery.*.category' => ['nullable', 'string', 'max:120'],
            'gallery.*.caption' => ['nullable', 'string', 'max:255'],
            'gallery.*.alt_text' => ['nullable', 'string', 'max:255'],
            'gallery.*.sort_order' => ['nullable', 'integer', 'min:0'],
            'gallery.*.external_url' => ['nullable', 'url'],
            'gallery.*.file' => ['nullable', 'image', 'max:6144'],
            'new_gallery_images.*' => ['nullable', 'image', 'max:6144'],
            'new_gallery_category' => ['nullable', 'string', 'max:120'],
            'new_gallery_caption' => ['nullable', 'string', 'max:255'],
            'new_gallery_alt_text' => ['nullable', 'string', 'max:255'],
        ]);

        $content = is_array($page->content) ? $page->content : [];

        $fullContentJson = $request->input('content_full_json');
        if ($fullContentJson !== null && trim((string) $fullContentJson) !== '') {
            $decodedFullContent = json_decode((string) $fullContentJson, true);
            if (json_last_error() !== JSON_ERROR_NONE || ! is_array($decodedFullContent)) {
                return back()
                    ->withInput()
                    ->withErrors(['content_full_json' => 'Invalid full page JSON.']);
            }

            $content = $decodedFullContent;
        }
        $fieldMap = $this->contentFieldMap(Arr::get($config, 'editor.quick_fields', []));

        foreach ($fieldMap as $key => $field) {
            if (! $request->has("content.{$key}")) {
                continue;
            }

            $raw = $request->input("content.{$key}");

            if (($field['type'] ?? 'text') === 'json') {
                if ($raw === null || trim((string) $raw) === '') {
                    $content[$key] = [];
                    continue;
                }

                $decoded = json_decode((string) $raw, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    return back()
                        ->withInput()
                        ->withErrors(["content.{$key}" => 'Invalid JSON format.']);
                }

                $content[$key] = $decoded;
                continue;
            }

            $content[$key] = $raw;
        }

        $meta = array_merge(
            is_array($page->meta) ? $page->meta : [],
            $request->input('meta', [])
        );

        DB::transaction(function () use ($config, $request, $page, $content, $meta, $slug): void {
            $page->update([
                'title' => Arr::get($config, 'name', ucfirst($slug)),
                'content' => $content,
                'meta' => $meta,
            ]);

            $this->handlePageMediaUpdates($request, $page, $slug, Arr::get($config, 'editor.media_keys', []));

            if (Arr::get($config, 'editor.uses_gallery_manager')) {
                $this->handleGalleryUpdates($request, $page, $slug);
            }
        });

        return back()->with('status', 'Page content updated successfully.');
    }

    /**
     * @param  array<string, array<int, array<string, string>>>  $quickFields
     * @return array<string, array<string, string>>
     */
    private function contentFieldMap(array $quickFields): array
    {
        $map = [];

        foreach ($quickFields as $fields) {
            foreach ($fields as $field) {
                if (! isset($field['key'])) {
                    continue;
                }

                $map[$field['key']] = $field;
            }
        }

        return $map;
    }

    /**
     * @param  array<int, string>  $mediaKeys
     */
    private function handlePageMediaUpdates(Request $request, Page $page, string $slug, array $mediaKeys): void
    {
        foreach ($mediaKeys as $mediaKey) {
            $existing = Media::query()
                ->where('page_id', $page->id)
                ->where('group', 'page')
                ->where('key', $mediaKey)
                ->first();

            $remove = $request->boolean("media_remove.{$mediaKey}");
            $upload = $request->file("media_uploads.{$mediaKey}");
            $externalUrl = trim((string) $request->input("media_url.{$mediaKey}", ''));

            if ($remove && ! $upload && $externalUrl === '') {
                $this->deleteMediaFileIfLocal($existing);
                $existing?->delete();
                continue;
            }

            if (! $upload && $externalUrl === '' && ! $existing) {
                continue;
            }

            $attributes = [
                'alt_text' => $request->input("media_alt.{$mediaKey}"),
                'caption' => $request->input("media_caption.{$mediaKey}"),
            ];

            if ($upload) {
                $this->deleteMediaFileIfLocal($existing);
                $attributes['path'] = $upload->store("uploads/pages/{$slug}", 'public');
                $attributes['disk'] = 'public';
                $attributes['is_external'] = false;
            } elseif ($externalUrl !== '') {
                $attributes['path'] = $externalUrl;
                $attributes['disk'] = 'public';
                $attributes['is_external'] = true;
            }

            Media::query()->updateOrCreate(
                [
                    'page_id' => $page->id,
                    'group' => 'page',
                    'key' => $mediaKey,
                ],
                $attributes
            );
        }
    }

    private function handleGalleryUpdates(Request $request, Page $page, string $slug): void
    {
        $galleryInputs = $request->input('gallery', []);

        foreach ($galleryInputs as $mediaId => $input) {
            $item = Media::query()
                ->where('page_id', $page->id)
                ->where('group', 'gallery')
                ->whereKey((int) $mediaId)
                ->first();

            if (! $item) {
                continue;
            }

            if (Arr::get($input, 'remove')) {
                $this->deleteMediaFileIfLocal($item);
                $item->delete();
                continue;
            }

            $upload = $request->file("gallery.{$mediaId}.file");
            $externalUrl = trim((string) Arr::get($input, 'external_url', ''));

            if ($upload) {
                $this->deleteMediaFileIfLocal($item);
                $item->path = $upload->store("uploads/pages/{$slug}/gallery", 'public');
                $item->disk = 'public';
                $item->is_external = false;
            } elseif ($externalUrl !== '') {
                $item->path = $externalUrl;
                $item->is_external = true;
            }

            $item->category = Arr::get($input, 'category');
            $item->caption = Arr::get($input, 'caption');
            $item->alt_text = Arr::get($input, 'alt_text');
            $item->sort_order = (int) Arr::get($input, 'sort_order', 0);
            $item->save();
        }

        $newImages = $request->file('new_gallery_images', []);
        if (empty($newImages)) {
            return;
        }

        $nextSort = (int) Media::query()
            ->where('page_id', $page->id)
            ->where('group', 'gallery')
            ->max('sort_order');

        foreach ($newImages as $image) {
            if (! $image) {
                continue;
            }

            $nextSort++;

            Media::query()->create([
                'page_id' => $page->id,
                'group' => 'gallery',
                'key' => 'gallery_'.Str::lower(Str::random(12)),
                'disk' => 'public',
                'path' => $image->store("uploads/pages/{$slug}/gallery", 'public'),
                'is_external' => false,
                'category' => $request->input('new_gallery_category'),
                'caption' => $request->input('new_gallery_caption'),
                'alt_text' => $request->input('new_gallery_alt_text'),
                'sort_order' => $nextSort,
            ]);
        }
    }

    private function deleteMediaFileIfLocal(?Media $media): void
    {
        if (! $media || $media->is_external || ! $media->path) {
            return;
        }

        if (Storage::disk($media->disk ?: 'public')->exists($media->path)) {
            Storage::disk($media->disk ?: 'public')->delete($media->path);
        }
    }
}
