@extends('admin.layout')

@section('admin_title', 'Gallery')
@section('admin_subtitle', 'Manage gallery images and metadata')

@section('content')
<section class="admin-card">
    <div class="admin-card-head">
        <h2>Gallery Images</h2>
        <a href="{{ route('admin.gallery.create') }}" class="admin-btn admin-btn-primary">Add Image</a>
    </div>

    <div class="admin-gallery-grid">
        @forelse($items as $item)
            <article class="admin-gallery-card">
                <img src="{{ $item->image_url }}" alt="{{ $item->alt_text }}" class="admin-gallery-thumb">

                <div class="admin-gallery-meta">
                    <h3>{{ $item->title ?: 'Untitled Image' }}</h3>
                    <p>{{ $item->alt_text ?: 'No alt text' }}</p>
                </div>

                <div class="admin-gallery-actions">
                    <a href="{{ route('admin.gallery.edit', $item) }}" class="admin-btn admin-btn-outline">Edit</a>
                    <form action="{{ route('admin.gallery.destroy', $item) }}" method="POST" onsubmit="return confirm('Delete this image?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="admin-btn admin-btn-danger">Delete</button>
                    </form>
                </div>
            </article>
        @empty
            <p>No gallery images found.</p>
        @endforelse
    </div>

    <div class="admin-pagination-wrap">
        {{ $items->links() }}
    </div>
</section>
@endsection
