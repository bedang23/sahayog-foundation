<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        return view('admin.gallery.index', [
            'items' => Gallery::query()->latest('created_at')->paginate(18),
        ]);
    }

    public function create(): View
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'image' => ['required', 'image', 'max:6144'],
            'title' => ['nullable', 'string', 'max:255'],
            'alt_text' => ['nullable', 'string', 'max:255'],
        ]);

        $path = $validated['image']->store('uploads/gallery', 'public');

        Gallery::query()->create([
            'image_path' => $path,
            'title' => $validated['title'] ?? null,
            'alt_text' => $validated['alt_text'] ?? null,
        ]);

        return redirect()->route('admin.gallery.index')->with('status', 'Gallery image added.');
    }

    public function edit(Gallery $gallery): View
    {
        return view('admin.gallery.edit', [
            'item' => $gallery,
        ]);
    }

    public function update(Request $request, Gallery $gallery): RedirectResponse
    {
        $validated = $request->validate([
            'image' => ['nullable', 'image', 'max:6144'],
            'title' => ['nullable', 'string', 'max:255'],
            'alt_text' => ['nullable', 'string', 'max:255'],
        ]);

        if (! empty($validated['image'])) {
            if (! str_starts_with($gallery->image_path, 'http')) {
                Storage::disk('public')->delete($gallery->image_path);
            }

            $gallery->image_path = $validated['image']->store('uploads/gallery', 'public');
        }

        $gallery->title = $validated['title'] ?? null;
        $gallery->alt_text = $validated['alt_text'] ?? null;
        $gallery->save();

        return redirect()->route('admin.gallery.index')->with('status', 'Gallery image updated.');
    }

    public function destroy(Gallery $gallery): RedirectResponse
    {
        if (! str_starts_with($gallery->image_path, 'http')) {
            Storage::disk('public')->delete($gallery->image_path);
        }

        $gallery->delete();

        return redirect()->route('admin.gallery.index')->with('status', 'Gallery image deleted.');
    }
}
