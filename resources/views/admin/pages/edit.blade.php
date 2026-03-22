@extends('layouts.app')

@section('meta_title', $pageName . ' Editor — Sahayog Foundation')
@section('meta_description', 'Edit page content, SEO fields, and media assets.')

@section('content')

    <section class="page-hero page-hero--short" aria-label="Page Editor Header">
        <div class="page-hero-bg" aria-hidden="true">
            <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=1600&auto=format&fit=crop&q=80" alt="Content editing workspace" loading="eager" fetchpriority="high">
            <div class="page-hero-overlay"></div>
        </div>
        <div class="container page-hero-content">
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('admin.dashboard') }}">Admin</a>
                <span aria-hidden="true">›</span>
                <span aria-current="page">{{ $pageName }}</span>
            </nav>
            <h1 class="page-hero-title reveal-up">Edit {{ $pageName }} Page</h1>
            <p class="page-hero-sub reveal-up">Update text, metadata, and images while preserving the current design.</p>
        </div>
    </section>

    <section class="section" aria-label="Page Editor Form">
        <div class="container">

            @if(session('status'))
                <div class="form-success-banner reveal-up" role="status" aria-live="polite">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                    {{ session('status') }}
                </div>
            @endif

            @if($errors->any())
                <div class="form-success-banner form-error-banner reveal-up" role="alert">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.pages.update', $slug) }}" enctype="multipart/form-data" class="admin-editor-form">
                @csrf
                @method('PUT')

                <div class="admin-editor-layout">
                    <div class="admin-editor-main">
                        @foreach(($editorConfig['quick_fields'] ?? []) as $groupLabel => $fields)
                            <div class="donation-form-card reveal-up admin-editor-card">
                                <h2 class="form-heading">{{ $groupLabel }}</h2>

                                @foreach($fields as $field)
                                    @php
                                        $key = $field['key'];
                                        $type = $field['type'] ?? 'text';
                                        $inputName = "content.{$key}";
                                        $value = old($inputName);

                                        if ($value === null) {
                                            if ($type === 'json') {
                                                $value = json_encode($content[$key] ?? [], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
                                            } else {
                                                $value = $content[$key] ?? '';
                                            }
                                        }
                                    @endphp

                                    <div class="form-group">
                                        <label class="form-label" for="field_{{ $key }}">{{ $field['label'] }}</label>

                                        @if($type === 'textarea' || $type === 'json')
                                            <textarea
                                                id="field_{{ $key }}"
                                                name="content[{{ $key }}]"
                                                class="form-textarea {{ $type === 'json' ? 'admin-json-field' : '' }}"
                                                rows="{{ $type === 'json' ? 8 : 4 }}"
                                            >{{ $value }}</textarea>
                                        @else
                                            <input
                                                id="field_{{ $key }}"
                                                type="text"
                                                name="content[{{ $key }}]"
                                                class="form-input"
                                                value="{{ $value }}"
                                            >
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endforeach

                        <div class="donation-form-card reveal-up admin-editor-card">
                            <h2 class="form-heading">Full Page Content JSON</h2>
                            <p class="section-subtitle">Advanced editor for all page keys. Use this when you need to update fields not listed above.</p>

                            <div class="form-group">
                                <label class="form-label" for="content_full_json">Full Content Payload</label>
                                <textarea id="content_full_json" name="content_full_json" class="form-textarea admin-json-field" rows="18">{{ old('content_full_json', json_encode($content, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)) }}</textarea>
                            </div>
                        </div>

                        <div class="donation-form-card reveal-up admin-editor-card">
                            <h2 class="form-heading">SEO Fields</h2>

                            <div class="form-group">
                                <label class="form-label" for="meta_title">Meta Title</label>
                                <input id="meta_title" type="text" name="meta[meta_title]" class="form-input" value="{{ old('meta.meta_title', $meta['meta_title'] ?? '') }}">
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="meta_description">Meta Description</label>
                                <textarea id="meta_description" name="meta[meta_description]" class="form-textarea" rows="4">{{ old('meta.meta_description', $meta['meta_description'] ?? '') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="meta_keywords">Meta Keywords</label>
                                <input id="meta_keywords" type="text" name="meta[meta_keywords]" class="form-input" value="{{ old('meta.meta_keywords', $meta['meta_keywords'] ?? '') }}">
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="og_title">OG Title</label>
                                <input id="og_title" type="text" name="meta[og_title]" class="form-input" value="{{ old('meta.og_title', $meta['og_title'] ?? '') }}">
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="og_description">OG Description</label>
                                <textarea id="og_description" name="meta[og_description]" class="form-textarea" rows="4">{{ old('meta.og_description', $meta['og_description'] ?? '') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="og_image">OG Image URL</label>
                                <input id="og_image" type="url" name="meta[og_image]" class="form-input" value="{{ old('meta.og_image', $meta['og_image'] ?? '') }}">
                            </div>
                        </div>

                        @if(($editorConfig['uses_gallery_manager'] ?? false) && !empty($galleryItems))
                            <div class="donation-form-card reveal-up admin-editor-card">
                                <h2 class="form-heading">Gallery Items</h2>
                                <p class="section-subtitle">Edit category, caption, order, and images for each gallery item.</p>

                                <div class="admin-gallery-items">
                                    @foreach($galleryItems as $item)
                                        <div class="admin-media-item">
                                            <div class="admin-media-preview-wrap">
                                                <img src="{{ $item['url'] }}" alt="{{ $item['alt_text'] }}" class="admin-media-preview">
                                            </div>

                                            @if($item['id'])
                                                <div class="form-row">
                                                    <div class="form-group">
                                                        <label class="form-label" for="gallery_category_{{ $item['id'] }}">Category</label>
                                                        <input id="gallery_category_{{ $item['id'] }}" type="text" name="gallery[{{ $item['id'] }}][category]" class="form-input" value="{{ old('gallery.'.$item['id'].'.category', $item['category']) }}">
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="form-label" for="gallery_order_{{ $item['id'] }}">Sort Order</label>
                                                        <input id="gallery_order_{{ $item['id'] }}" type="number" name="gallery[{{ $item['id'] }}][sort_order]" class="form-input" value="{{ old('gallery.'.$item['id'].'.sort_order', $item['sort_order']) }}" min="0">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label" for="gallery_caption_{{ $item['id'] }}">Caption</label>
                                                    <input id="gallery_caption_{{ $item['id'] }}" type="text" name="gallery[{{ $item['id'] }}][caption]" class="form-input" value="{{ old('gallery.'.$item['id'].'.caption', $item['caption']) }}">
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label" for="gallery_alt_{{ $item['id'] }}">Alt Text</label>
                                                    <input id="gallery_alt_{{ $item['id'] }}" type="text" name="gallery[{{ $item['id'] }}][alt_text]" class="form-input" value="{{ old('gallery.'.$item['id'].'.alt_text', $item['alt_text']) }}">
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label" for="gallery_url_{{ $item['id'] }}">External Image URL (optional)</label>
                                                    <input id="gallery_url_{{ $item['id'] }}" type="url" name="gallery[{{ $item['id'] }}][external_url]" class="form-input" value="{{ old('gallery.'.$item['id'].'.external_url', $item['is_external'] ? $item['path'] : '') }}">
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label" for="gallery_file_{{ $item['id'] }}">Replace Image Upload</label>
                                                    <input id="gallery_file_{{ $item['id'] }}" type="file" name="gallery[{{ $item['id'] }}][file]" class="form-input" accept="image/*">
                                                </div>

                                                <div class="form-group form-checkbox-group">
                                                    <label class="checkbox-label">
                                                        <input type="checkbox" name="gallery[{{ $item['id'] }}][remove]" class="checkbox-input" value="1">
                                                        <span class="checkbox-custom" aria-hidden="true"></span>
                                                        Remove this gallery item.
                                                    </label>
                                                </div>
                                            @else
                                                <p class="form-disclaimer">This item is from configuration defaults. Run database seeding to make it editable.</p>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>

                                <div class="divider" aria-hidden="true"></div>

                                <h3 class="form-subheading">Add New Gallery Images</h3>
                                <div class="form-group">
                                    <label class="form-label" for="new_gallery_images">Upload Images</label>
                                    <input id="new_gallery_images" type="file" name="new_gallery_images[]" class="form-input" accept="image/*" multiple>
                                </div>

                                <div class="form-row">
                                    <div class="form-group">
                                        <label class="form-label" for="new_gallery_category">Category</label>
                                        <input id="new_gallery_category" type="text" name="new_gallery_category" class="form-input" value="{{ old('new_gallery_category') }}" placeholder="Education">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="new_gallery_caption">Caption</label>
                                        <input id="new_gallery_caption" type="text" name="new_gallery_caption" class="form-input" value="{{ old('new_gallery_caption') }}" placeholder="Community event in Pune">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="new_gallery_alt_text">Alt Text</label>
                                    <input id="new_gallery_alt_text" type="text" name="new_gallery_alt_text" class="form-input" value="{{ old('new_gallery_alt_text') }}" placeholder="Description for accessibility">
                                </div>
                            </div>
                        @endif
                    </div>

                    <aside class="admin-editor-sidebar">
                        <div class="donation-form-card reveal-up admin-editor-card">
                            <h2 class="form-heading">Page Media</h2>
                            <p class="section-subtitle">Upload new assets or set external URLs. Current previews are shown below.</p>

                            @foreach(($editorConfig['media_keys'] ?? []) as $mediaKey)
                                @php
                                    $item = $media[$mediaKey] ?? null;
                                @endphp
                                @if($item)
                                    <div class="admin-media-item">
                                        <h3 class="form-subheading">{{ $item['label'] }}</h3>

                                        @if(!empty($item['url']))
                                            <div class="admin-media-preview-wrap">
                                                <img src="{{ $item['url'] }}" alt="{{ $item['alt_text'] }}" class="admin-media-preview">
                                            </div>
                                        @endif

                                        <div class="form-group">
                                            <label class="form-label" for="media_url_{{ $mediaKey }}">External URL</label>
                                            <input id="media_url_{{ $mediaKey }}" type="url" name="media_url[{{ $mediaKey }}]" class="form-input" value="{{ old('media_url.'.$mediaKey, $item['is_external'] ? $item['path'] : '') }}">
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="media_file_{{ $mediaKey }}">Upload Image</label>
                                            <input id="media_file_{{ $mediaKey }}" type="file" name="media_uploads[{{ $mediaKey }}]" class="form-input" accept="image/*">
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="media_alt_{{ $mediaKey }}">Alt Text</label>
                                            <input id="media_alt_{{ $mediaKey }}" type="text" name="media_alt[{{ $mediaKey }}]" class="form-input" value="{{ old('media_alt.'.$mediaKey, $item['alt_text']) }}">
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="media_caption_{{ $mediaKey }}">Caption (optional)</label>
                                            <input id="media_caption_{{ $mediaKey }}" type="text" name="media_caption[{{ $mediaKey }}]" class="form-input" value="{{ old('media_caption.'.$mediaKey, $item['caption']) }}">
                                        </div>

                                        <div class="form-group form-checkbox-group">
                                            <label class="checkbox-label">
                                                <input type="checkbox" name="media_remove[{{ $mediaKey }}]" class="checkbox-input" value="1">
                                                <span class="checkbox-custom" aria-hidden="true"></span>
                                                Remove custom media and fallback to default.
                                            </label>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </aside>
                </div>

                <div class="admin-editor-submit-wrap reveal-up">
                    <button type="submit" class="btn btn-primary btn-lg">Save Changes</button>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline btn-lg">Back to Dashboard</a>
                </div>
            </form>
        </div>
    </section>

@endsection
