@extends('layouts.app')

@section('meta_title', 'Our Gallery — Sahayog Foundation')
@section('meta_description', 'Explore moments from Sahayog Foundation field programs across education, healthcare, livelihoods, and community impact.')
@section('og_title', 'Our Gallery — Sahayog Foundation')
@section('og_description', 'Stories in pictures from our work with communities across India.')

@section('content')

    @php
        $heroMedia = $media['hero_background'] ?? ['url' => '', 'alt_text' => ''];

        $categories = collect($galleryItems)
            ->pluck('category')
            ->filter()
            ->unique()
            ->sort()
            ->values();
    @endphp

    {{-- PAGE HERO --}}
    <section class="page-hero" aria-label="Gallery Header">
        <div class="page-hero-bg" aria-hidden="true">
            <img src="{{ $heroMedia['url'] }}" alt="{{ $heroMedia['alt_text'] }}" loading="eager" fetchpriority="high">
            <div class="page-hero-overlay"></div>
        </div>
        <div class="container page-hero-content">
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span aria-hidden="true">›</span>
                <span aria-current="page">Gallery</span>
            </nav>
            <h1 class="page-hero-title reveal-up">{{ $content['hero_title'] ?? 'Our Gallery' }}</h1>
            <p class="page-hero-sub reveal-up">{{ $content['hero_subtitle'] ?? '' }}</p>
        </div>
    </section>

    <section class="section" aria-label="Gallery Images">
        <div class="container">

            @if(($content['show_filters'] ?? true) && $categories->isNotEmpty())
                <div class="gallery-filters reveal-up" role="tablist" aria-label="Gallery Categories">
                    <button type="button" class="btn btn-outline btn-sm gallery-filter-btn active" data-filter="all" aria-pressed="true">
                        {{ $content['filter_all_label'] ?? 'All' }}
                    </button>
                    @foreach($categories as $category)
                        <button type="button" class="btn btn-outline btn-sm gallery-filter-btn" data-filter="{{ \Illuminate\Support\Str::slug($category) }}" aria-pressed="false">
                            {{ $category }}
                        </button>
                    @endforeach
                </div>
            @endif

            <div class="gallery-grid" id="galleryGrid">
                @foreach($galleryItems as $index => $item)
                    @php
                        $cat = $item['category'] ?? '';
                    @endphp
                    <article class="gallery-card reveal-up" style="--delay: {{ $index * 0.05 }}s" data-category="{{ \Illuminate\Support\Str::slug($cat) }}">
                        <button
                            type="button"
                            class="gallery-image-btn"
                            data-lightbox-src="{{ $item['url'] }}"
                            data-lightbox-alt="{{ $item['alt_text'] }}"
                            data-lightbox-caption="{{ $item['caption'] }}"
                        >
                            <img src="{{ $item['url'] }}" alt="{{ $item['alt_text'] }}" class="gallery-image" loading="lazy">
                            <span class="gallery-overlay" aria-hidden="true"></span>
                        </button>
                        <div class="gallery-meta">
                            @if($cat)
                                <span class="program-stat">{{ $cat }}</span>
                            @endif
                            @if(!empty($item['caption']))
                                <p class="gallery-caption">{{ $item['caption'] }}</p>
                            @endif
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <div class="gallery-lightbox" id="galleryLightbox" aria-hidden="true" role="dialog" aria-label="Image Preview">
        <button type="button" class="gallery-lightbox-close" id="galleryLightboxClose" aria-label="Close preview">×</button>
        <div class="gallery-lightbox-inner">
            <img id="galleryLightboxImage" src="" alt="">
            <p id="galleryLightboxCaption"></p>
        </div>
    </div>

@endsection

@push('scripts')
<script src="{{ asset('js/gallery.js') }}"></script>
@endpush
