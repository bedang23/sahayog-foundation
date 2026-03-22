@extends('admin.layout')

@section('admin_title', 'Add Gallery Image')
@section('admin_subtitle', 'Upload a new image for frontend gallery')

@section('content')
<section class="admin-card">
    <div class="admin-card-head">
        <h2>Add New Image</h2>
    </div>

    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" class="admin-form-stack">
        @csrf

        <div class="admin-form-group">
            <label for="image">Image File</label>
            <input id="image" type="file" name="image" class="admin-input admin-input-file" accept="image/*" required>
        </div>

        <div class="admin-form-group">
            <label for="title">Title</label>
            <input id="title" type="text" name="title" class="admin-input" value="{{ old('title') }}">
        </div>

        <div class="admin-form-group">
            <label for="alt_text">Alt Text</label>
            <input id="alt_text" type="text" name="alt_text" class="admin-input" value="{{ old('alt_text') }}">
        </div>

        <div class="admin-form-actions">
            <button type="submit" class="admin-btn admin-btn-primary">Save Image</button>
            <a href="{{ route('admin.gallery.index') }}" class="admin-btn admin-btn-outline">Back</a>
        </div>
    </form>
</section>
@endsection
