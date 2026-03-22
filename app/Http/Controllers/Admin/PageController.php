<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageSection;
use App\Services\CmsService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PageController extends Controller
{
    public function __construct(private readonly CmsService $cms)
    {
    }

    public function index(): View
    {
        return view('admin.pages.index', [
            'pages' => $this->cms->pagesForDashboard(),
        ]);
    }

    public function edit(Page $page): View
    {
        $payload = $this->cms->getPagePayload($page->slug);
        $page->refresh();

        return view('admin.pages.edit', [
            'pageRecord' => $page,
            'pageName' => Arr::get($payload, 'config.name', ucfirst($page->slug)),
            'sections' => $this->cms->sectionsForEditor($page),
        ]);
    }

    public function update(Request $request, Page $page): RedirectResponse
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'meta_keywords' => ['nullable', 'string'],
            'og_title' => ['nullable', 'string', 'max:255'],
            'og_description' => ['nullable', 'string'],
            'og_image' => ['nullable', 'url'],
            'sections' => ['nullable', 'array'],
            'section_uploads' => ['nullable', 'array'],
            'section_uploads.*.*' => ['nullable', 'image', 'max:6144'],
        ]);

        DB::transaction(function () use ($request, $page): void {
            $page->update([
                'title' => $request->input('title'),
                'meta_title' => $request->input('meta_title'),
                'meta_description' => $request->input('meta_description'),
                'meta_keywords' => $request->input('meta_keywords'),
                'og_title' => $request->input('og_title'),
                'og_description' => $request->input('og_description'),
                'og_image' => $request->input('og_image'),
            ]);

            foreach ($request->input('sections', []) as $sectionName => $fields) {
                if (! is_array($fields)) {
                    continue;
                }

                foreach ($fields as $fieldName => $value) {
                    PageSection::query()->updateOrCreate(
                        [
                            'page_id' => $page->id,
                            'section_name' => (string) $sectionName,
                            'field_name' => (string) $fieldName,
                        ],
                        [
                            'field_value' => $this->normalizeScalarValue($value),
                        ]
                    );
                }
            }

            foreach ($request->file('section_uploads', []) as $sectionName => $fields) {
                if (! is_array($fields)) {
                    continue;
                }

                foreach ($fields as $fieldName => $upload) {
                    if (! $upload) {
                        continue;
                    }

                    $existing = PageSection::query()->where([
                        'page_id' => $page->id,
                        'section_name' => (string) $sectionName,
                        'field_name' => (string) $fieldName,
                    ])->first();

                    if ($existing && $existing->field_value && ! str_starts_with((string) $existing->field_value, 'http')) {
                        Storage::disk('public')->delete((string) $existing->field_value);
                    }

                    $path = $upload->store("uploads/pages/{$page->slug}/sections", 'public');

                    PageSection::query()->updateOrCreate(
                        [
                            'page_id' => $page->id,
                            'section_name' => (string) $sectionName,
                            'field_name' => (string) $fieldName,
                        ],
                        [
                            'field_value' => $path,
                        ]
                    );
                }
            }
        });

        return back()->with('status', 'Page updated successfully.');
    }

    private function normalizeScalarValue(mixed $value): ?string
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
