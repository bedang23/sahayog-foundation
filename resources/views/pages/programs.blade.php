@extends('layouts.app')

@section('meta_title', 'Our Programs — Sahayog Foundation')
@section('meta_description', 'Explore Sahayog Foundation\'s integrated programs in education, healthcare, livelihoods, environment, and women empowerment across rural India.')
@section('og_title', 'Our Programs — Sahayog Foundation')
@section('og_description', 'From classrooms to health camps, discover how Sahayog Foundation creates lasting impact across communities.')

@section('content')

    @php
        $heroMedia = $media['hero_background'] ?? ['url' => '', 'alt_text' => ''];
        $subnav = $content['subnav'] ?? [];
        $sections = $content['sections'] ?? [];
        $sectionMediaMap = [
            'education' => 'education_image',
            'health' => 'health_image',
            'livelihood' => 'livelihood_image',
            'environment' => 'environment_image',
            'women' => 'women_image',
            'digital' => 'digital_image',
        ];
    @endphp

    {{-- PAGE HERO --}}
    <section class="page-hero" aria-label="Programs Page Header">
        <div class="page-hero-bg" aria-hidden="true">
            <img src="{{ $heroMedia['url'] }}" alt="{{ $heroMedia['alt_text'] }}" loading="eager" fetchpriority="high">
            <div class="page-hero-overlay"></div>
        </div>
        <div class="container page-hero-content">
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span aria-hidden="true">›</span>
                <span aria-current="page">Programs</span>
            </nav>
            <h1 class="page-hero-title reveal-up">{{ $content['hero_title'] ?? '' }}</h1>
            <p class="page-hero-sub reveal-up">{{ $content['hero_subtitle'] ?? '' }}</p>
        </div>
    </section>

    {{-- PROGRAMS NAV --}}
    <nav class="programs-subnav" aria-label="Program Categories">
        <div class="container">
            <ul class="subnav-list" role="list">
                @foreach($subnav as $navItem)
                    <li><a href="#{{ $navItem['id'] ?? '' }}" class="subnav-link">{{ $navItem['label'] ?? '' }}</a></li>
                @endforeach
            </ul>
        </div>
    </nav>

    @foreach($sections as $index => $section)
        @php
            $isEven = $index % 2 === 0;
            $id = $section['id'] ?? '';
            $mediaKey = $sectionMediaMap[$id] ?? null;
            $sectionMedia = $mediaKey ? ($media[$mediaKey] ?? ['url' => '', 'alt_text' => '']) : ['url' => '', 'alt_text' => ''];
            $highlights = $section['highlights'] ?? [];
        @endphp

        <section class="program-detail section {{ $isEven ? '' : 'section-tinted' }}" id="{{ $id }}" aria-label="{{ $section['title'] ?? '' }} Program">
            <div class="container">
                <div class="program-detail-grid {{ $isEven ? '' : 'reverse' }}">
                    @if($isEven)
                        <div class="program-detail-text reveal-left">
                            <span class="section-eyebrow">{{ $section['eyebrow'] ?? '' }}</span>
                            <h2 class="section-title">{{ $section['title'] ?? '' }}</h2>
                            <p class="section-body">{{ $section['body_1'] ?? '' }}</p>
                            @if(!empty($section['body_2']))
                                <p class="section-body">{{ $section['body_2'] }}</p>
                            @endif
                            <ul class="program-highlights" role="list">
                                @foreach($highlights as $highlight)
                                    <li>{{ $highlight }}</li>
                                @endforeach
                            </ul>
                            <a href="{{ route('donate') }}" class="btn btn-primary mt-4">{{ $section['cta'] ?? 'Support Program' }}</a>
                        </div>
                        <div class="program-detail-image reveal-right">
                            <img src="{{ $sectionMedia['url'] }}" alt="{{ $sectionMedia['alt_text'] }}" loading="lazy">
                        </div>
                    @else
                        <div class="program-detail-image reveal-left">
                            <img src="{{ $sectionMedia['url'] }}" alt="{{ $sectionMedia['alt_text'] }}" loading="lazy">
                        </div>
                        <div class="program-detail-text reveal-right">
                            <span class="section-eyebrow">{{ $section['eyebrow'] ?? '' }}</span>
                            <h2 class="section-title">{{ $section['title'] ?? '' }}</h2>
                            <p class="section-body">{{ $section['body_1'] ?? '' }}</p>
                            @if(!empty($section['body_2']))
                                <p class="section-body">{{ $section['body_2'] }}</p>
                            @endif
                            <ul class="program-highlights" role="list">
                                @foreach($highlights as $highlight)
                                    <li>{{ $highlight }}</li>
                                @endforeach
                            </ul>
                            <a href="{{ route('donate') }}" class="btn btn-primary mt-4">{{ $section['cta'] ?? 'Support Program' }}</a>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endforeach

    {{-- CTA --}}
    <section class="inner-cta section" aria-label="Support Our Programs">
        <div class="container">
            <div class="inner-cta-box reveal-up">
                <div class="inner-cta-text">
                    <h2 class="inner-cta-title">{{ $content['inner_cta_title'] ?? '' }}</h2>
                    <p>{{ $content['inner_cta_text'] ?? '' }}</p>
                </div>
                <div class="inner-cta-actions">
                    <a href="{{ route('donate') }}" class="btn btn-primary btn-lg">{{ $content['inner_cta_primary'] ?? 'Donate' }}</a>
                    <a href="{{ route('contact') }}" class="btn btn-outline btn-lg">{{ $content['inner_cta_secondary'] ?? 'Get in Touch' }}</a>
                </div>
            </div>
        </div>
    </section>

@endsection
