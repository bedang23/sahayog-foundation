@extends('admin.layout')

@section('admin_title', 'Edit: ' . $pageName)
@section('admin_subtitle', 'Section-wise content editor for ' . $pageName)

@section('content')
<form action="{{ route('admin.pages.update', $pageRecord) }}" method="POST" enctype="multipart/form-data" class="admin-form-stack">
    @csrf
    @method('PUT')

    <section class="admin-card">
        <div class="admin-card-head">
            <h2>Page Settings</h2>
        </div>

        <div class="admin-form-grid admin-form-grid-2">
            <div class="admin-form-group">
                <label for="title">Page Title</label>
                <input id="title" type="text" name="title" value="{{ old('title', $pageRecord->title) }}" class="admin-input" required>
            </div>

            <div class="admin-form-group">
                <label for="slug">Slug</label>
                <input id="slug" type="text" value="{{ $pageRecord->slug }}" class="admin-input" disabled>
            </div>

            <div class="admin-form-group admin-form-group-full">
                <label for="meta_title">Meta Title</label>
                <input id="meta_title" type="text" name="meta_title" value="{{ old('meta_title', $pageRecord->meta_title) }}" class="admin-input">
            </div>

            <div class="admin-form-group admin-form-group-full">
                <label for="meta_description">Meta Description</label>
                <textarea id="meta_description" name="meta_description" class="admin-textarea" rows="3">{{ old('meta_description', $pageRecord->meta_description) }}</textarea>
            </div>

            <div class="admin-form-group admin-form-group-full">
                <label for="meta_keywords">Meta Keywords</label>
                <input id="meta_keywords" type="text" name="meta_keywords" value="{{ old('meta_keywords', $pageRecord->meta_keywords) }}" class="admin-input">
            </div>

            <div class="admin-form-group admin-form-group-full">
                <label for="og_title">OG Title</label>
                <input id="og_title" type="text" name="og_title" value="{{ old('og_title', $pageRecord->og_title) }}" class="admin-input">
            </div>

            <div class="admin-form-group admin-form-group-full">
                <label for="og_description">OG Description</label>
                <textarea id="og_description" name="og_description" class="admin-textarea" rows="3">{{ old('og_description', $pageRecord->og_description) }}</textarea>
            </div>

            <div class="admin-form-group admin-form-group-full">
                <label for="og_image">OG Image URL</label>
                <input id="og_image" type="url" name="og_image" value="{{ old('og_image', $pageRecord->og_image) }}" class="admin-input">
            </div>
        </div>
    </section>

    @php
        $oldSections = old('sections', []);
    @endphp

    @foreach($sections as $sectionName => $fields)
        <section class="admin-card">
            <div class="admin-card-head">
                <h2>{{ ucfirst(str_replace('_', ' ', $sectionName)) }} Section</h2>
            </div>

            <div class="admin-form-grid admin-form-grid-2">
                @foreach($fields as $row)
                    @php
                        $rawValue = $oldSections[$sectionName][$row->field_name] ?? $row->field_value;
                        $value = is_string($rawValue) ? $rawValue : '';
                        $lowerField = strtolower($row->field_name);
                        $looksLikeImageField = str_contains($lowerField, 'image') || str_contains($lowerField, 'img') || str_contains($lowerField, 'photo') || str_contains($lowerField, 'background') || str_contains($lowerField, 'avatar');
                        $looksLikeTextArea = strlen($value) > 120 || str_contains($lowerField, 'description') || str_contains($lowerField, 'subtitle') || str_contains($lowerField, 'text') || str_contains($lowerField, 'body') || str_contains($lowerField, 'quote') || str_contains($lowerField, 'bio');

                        $imageUrl = '';
                        if ($looksLikeImageField && $value !== '') {
                            if (str_starts_with($value, 'http://') || str_starts_with($value, 'https://')) {
                                $imageUrl = $value;
                            } else {
                                $imageUrl = \Illuminate\Support\Facades\Storage::disk('public')->url($value);
                            }
                        }

                        $inputId = 'field_'.md5($sectionName.'_'.$row->field_name);
                    @endphp

                    <div class="admin-form-group {{ $looksLikeTextArea ? 'admin-form-group-full' : '' }}">
                        <label for="{{ $inputId }}">{{ ucfirst(str_replace(['_', '.', '-'], ' ', $row->field_name)) }}</label>

                        @if($looksLikeImageField)
                            @if($imageUrl !== '')
                                <div class="admin-image-preview-wrap">
                                    <img src="{{ $imageUrl }}" alt="Preview" class="admin-image-preview">
                                </div>
                            @endif

                            <input id="{{ $inputId }}" type="text" name="sections[{{ $sectionName }}][{{ $row->field_name }}]" value="{{ $value }}" class="admin-input" placeholder="Image path or URL">
                            <input type="file" name="section_uploads[{{ $sectionName }}][{{ $row->field_name }}]" class="admin-input admin-input-file" accept="image/*">
                        @elseif($looksLikeTextArea)
                            <textarea id="{{ $inputId }}" name="sections[{{ $sectionName }}][{{ $row->field_name }}]" class="admin-textarea" rows="4">{{ $value }}</textarea>
                        @else
                            <input id="{{ $inputId }}" type="text" name="sections[{{ $sectionName }}][{{ $row->field_name }}]" value="{{ $value }}" class="admin-input">
                        @endif
                    </div>
                @endforeach
            </div>
        </section>
    @endforeach

    <div class="admin-form-actions">
        <button type="submit" class="admin-btn admin-btn-primary">Save Page</button>
        <a href="{{ route('admin.pages.index') }}" class="admin-btn admin-btn-outline">Back to Pages</a>
    </div>
</form>
@endsection
