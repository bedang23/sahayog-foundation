@extends('admin.layout')

@section('admin_title', 'Edit Gallery Image')
@section('admin_subtitle', 'Update image details and accessibility text')

@section('content')
<section class="admin-card">
    <div class="admin-card-head">
        <h2>Edit Image</h2>
    </div>

    <div class="admin-image-preview-wrap admin-image-preview-large">
        <img src="{{ $item->image_url }}" alt="{{ $item->alt_text }}" class="admin-image-preview">
    </div>

    <form action="{{ route('admin.gallery.update', $item) }}" method="POST" enctype="multipart/form-data" class="admin-form-stack">
        @csrf
        @method('PUT')

        <div class="admin-form-group">
            <label for="image">Replace Image (optional)</label>
            <input id="image" type="file" name="image" class="admin-input admin-input-file" accept="image/*">
        </div>

        <div class="admin-form-group">
            <label for="title">Title</label>
            <input id="title" type="text" name="title" class="admin-input" value="{{ old('title', $item->title) }}">
        </div>

        <div class="admin-form-group">
            <label for="alt_text">Alt Text</label>
            <input id="alt_text" type="text" name="alt_text" class="admin-input" value="{{ old('alt_text', $item->alt_text) }}">
        </div>

        <div class="admin-form-actions">
            <button type="submit" class="admin-btn admin-btn-primary">Update Image</button>
            <a href="{{ route('admin.gallery.index') }}" class="admin-btn admin-btn-outline">Back</a>
        </div>
    </form>
</section>
@endsection
