@extends('admin.layout')

@section('admin_title', 'Dashboard')
@section('admin_subtitle', 'Overview of content and media status')

@section('content')
<div class="admin-grid admin-grid-cards">
    <article class="admin-card">
        <h3>Total Pages</h3>
        <p class="admin-card-value">{{ $pageCount }}</p>
    </article>

    <article class="admin-card">
        <h3>Gallery Images</h3>
        <p class="admin-card-value">{{ $galleryCount }}</p>
    </article>

    <article class="admin-card">
        <h3>Logged In As</h3>
        <p class="admin-card-value">{{ auth()->user()->email }}</p>
    </article>
</div>

<div class="admin-grid admin-grid-main">
    <section class="admin-card">
        <div class="admin-card-head">
            <h2>Pages</h2>
            <a href="{{ route('admin.pages.index') }}" class="admin-btn admin-btn-primary">Manage Pages</a>
        </div>

        <table class="admin-table">
            <thead>
            <tr>
                <th>Page</th>
                <th>Slug</th>
                <th>Last Updated</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($pages as $page)
                <tr>
                    <td>{{ $page['name'] }}</td>
                    <td>{{ $page['slug'] }}</td>
                    <td>{{ $page['updated_at'] ? $page['updated_at']->diffForHumans() : 'Not updated yet' }}</td>
                    <td>
                        <a href="{{ route('admin.pages.edit', $page['slug']) }}" class="admin-btn admin-btn-outline">Edit</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>

    <section class="admin-card">
        <div class="admin-card-head">
            <h2>Recent Page Updates</h2>
        </div>

        <ul class="admin-list">
            @forelse($recentPages as $recent)
                <li>
                    <strong>{{ $recent->title }}</strong>
                    <span>{{ $recent->updated_at->format('d M Y, h:i A') }}</span>
                </li>
            @empty
                <li>No recent updates.</li>
            @endforelse
        </ul>
    </section>
</div>
@endsection
