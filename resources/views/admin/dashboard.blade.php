@extends('layouts.app')

@section('meta_title', 'Admin Dashboard — Sahayog Foundation')
@section('meta_description', 'Manage website content and media for Sahayog Foundation.')

@section('content')

    <section class="page-hero page-hero--short" aria-label="Admin Dashboard Header">
        <div class="page-hero-bg" aria-hidden="true">
            <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=1600&auto=format&fit=crop&q=80" alt="Dashboard workspace" loading="eager" fetchpriority="high">
            <div class="page-hero-overlay"></div>
        </div>
        <div class="container page-hero-content">
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span aria-hidden="true">›</span>
                <span aria-current="page">Admin</span>
            </nav>
            <h1 class="page-hero-title reveal-up">Content Dashboard</h1>
            <p class="page-hero-sub reveal-up">Update text, SEO metadata, and media page-by-page.</p>
        </div>
    </section>

    <section class="section" aria-label="Admin Actions">
        <div class="container">
            <div class="admin-toolbar reveal-up">
                <div>
                    <h2 class="section-title">Manage Pages</h2>
                    <p class="section-subtitle">Choose a page to edit content blocks, SEO tags, and images.</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline">Logout</button>
                </form>
            </div>

            <div class="programs-grid">
                @foreach($pages as $index => $page)
                    <article class="program-card reveal-up" style="--delay: {{ $index * 0.05 }}s">
                        <h3 class="program-title">{{ $page['name'] }}</h3>
                        <p class="program-desc">
                            @if($page['updated_at'])
                                Last updated {{ $page['updated_at']->diffForHumans() }}
                            @else
                                Not customized yet (using seeded defaults)
                            @endif
                        </p>

                        <div class="admin-card-actions">
                            <a href="{{ route('admin.pages.edit', $page['slug']) }}" class="btn btn-primary btn-sm">Edit Page</a>
                            <a href="{{ route($page['public_route']) }}" class="btn btn-outline btn-sm">View Live</a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

@endsection
