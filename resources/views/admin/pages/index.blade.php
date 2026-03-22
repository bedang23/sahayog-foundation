@extends('admin.layout')

@section('admin_title', 'Pages')
@section('admin_subtitle', 'Manage page-wise website content')

@section('content')
<section class="admin-card">
    <div class="admin-card-head">
        <h2>Pages List</h2>
    </div>

    <table class="admin-table">
        <thead>
        <tr>
            <th>Page Name</th>
            <th>Slug</th>
            <th>Last Updated</th>
            <th>Edit</th>
        </tr>
        </thead>
        <tbody>
        @foreach($pages as $page)
            <tr>
                <td>{{ $page['name'] }}</td>
                <td>{{ $page['slug'] }}</td>
                <td>{{ $page['updated_at'] ? $page['updated_at']->diffForHumans() : 'Not updated yet' }}</td>
                <td>
                    <a href="{{ route('admin.pages.edit', $page['slug']) }}" class="admin-btn admin-btn-primary">Edit Page</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</section>
@endsection
