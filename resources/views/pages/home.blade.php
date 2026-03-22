@extends('layouts.app')

@section('meta_title', 'Sahayog Foundation — Empowering Communities Across India')
@section('meta_description', 'Sahayog Foundation works with underserved communities in India to provide education, healthcare, and sustainable livelihoods. Join us in making a difference.')
@section('og_title', 'Sahayog Foundation — Empowering Communities Across India')
@section('og_description', 'Join Sahayog Foundation in building a better India through education, health, and opportunity.')

@section('content')

    @php
        $heroMedia = $media['hero_background'] ?? ['url' => '', 'alt_text' => ''];
        $aboutMainMedia = $media['about_main_image'] ?? ['url' => '', 'alt_text' => ''];
        $aboutSecondaryMedia = $media['about_secondary_image'] ?? ['url' => '', 'alt_text' => ''];
        $ctaMedia = $media['cta_background'] ?? ['url' => '', 'alt_text' => ''];

        $stats = $content['stats'] ?? [];
        $aboutValues = $content['about_values'] ?? [];
        $programs = $content['programs'] ?? [];
        $testimonials = $content['testimonials'] ?? [];

        $programIcons = [
            'education' => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>',
            'health' => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>',
            'livelihood' => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>',
            'environment' => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>',
            'women' => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="8" r="4"/><path d="M6 20v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2"/></svg>',
            'digital' => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>',
        ];
    @endphp

    {{-- ═══════════════════════════════════════
         HERO SECTION
    ══════════════════════════════════════ --}}
    <section class="hero" aria-label="Hero">
        <div class="hero-media">
            <img
                src="{{ $heroMedia['url'] }}"
                alt="{{ $heroMedia['alt_text'] }}"
                class="hero-img"
                loading="eager"
                fetchpriority="high"
            >
            <div class="hero-overlay" aria-hidden="true"></div>
        </div>
        <div class="container hero-content">
            <div class="hero-text reveal-up">
                <span class="hero-eyebrow">{{ $content['hero_eyebrow'] ?? '' }}</span>
                <h1 class="hero-headline">
                    {{ $content['hero_headline_line_1'] ?? '' }}<br>
                    a <span class="highlight-word">{{ $content['hero_headline_highlight'] ?? '' }}</span> {{ $content['hero_headline_line_2'] ?? '' }}
                </h1>
                <p class="hero-sub">
                    {{ $content['hero_subtitle'] ?? '' }}
                </p>
                <div class="hero-actions">
                    <a href="{{ route('donate') }}" class="btn btn-primary btn-lg">{{ $content['hero_primary_cta'] ?? 'Donate Today' }}</a>
                    <a href="{{ route('about') }}" class="btn btn-outline-light btn-lg">{{ $content['hero_secondary_cta'] ?? 'Our Story' }}</a>
                </div>
            </div>
        </div>
        <div class="hero-scroll-cue" aria-hidden="true">
            <span>Scroll</span>
            <div class="scroll-line"></div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════
         IMPACT STATS
    ══════════════════════════════════════ --}}
    <section class="stats-strip" aria-label="Impact Statistics">
        <div class="container">
            <div class="stats-grid">
                @foreach($stats as $stat)
                <div class="stat-card reveal-up">
                    <div class="stat-number" data-target="{{ $stat['number'] ?? 0 }}" data-suffix="{{ $stat['suffix'] ?? '' }}">0{{ $stat['suffix'] ?? '' }}</div>
                    <div class="stat-label">{{ $stat['label'] ?? '' }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════
         ABOUT PREVIEW
    ══════════════════════════════════════ --}}
    <section class="about-preview section" aria-label="About Preview">
        <div class="container">
            <div class="about-grid">
                <div class="about-images reveal-left">
                    <div class="image-stack">
                        <img
                            src="{{ $aboutMainMedia['url'] }}"
                            alt="{{ $aboutMainMedia['alt_text'] }}"
                            class="img-main"
                            loading="lazy"
                        >
                        <img
                            src="{{ $aboutSecondaryMedia['url'] }}"
                            alt="{{ $aboutSecondaryMedia['alt_text'] }}"
                            class="img-secondary"
                            loading="lazy"
                        >
                        <div class="image-badge" aria-hidden="true">
                            <span class="badge-number">14+</span>
                            <span class="badge-text">Active Programs</span>
                        </div>
                    </div>
                </div>
                <div class="about-text reveal-right">
                    <span class="section-eyebrow">{{ $content['about_eyebrow'] ?? '' }}</span>
                    <h2 class="section-title">{{ $content['about_title_line_1'] ?? '' }}<br>{{ $content['about_title_line_2'] ?? '' }}</h2>
                    <p class="section-body">{{ $content['about_body_1'] ?? '' }}</p>
                    <p class="section-body">{{ $content['about_body_2'] ?? '' }}</p>
                    <div class="about-values">
                        @foreach($aboutValues as $value)
                            <div class="value-pill">{{ $value }}</div>
                        @endforeach
                    </div>
                    <a href="{{ route('about') }}" class="btn btn-primary mt-4">{{ $content['about_cta'] ?? 'Meet Our Team' }}</a>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════
         PROGRAMS
    ══════════════════════════════════════ --}}
    <section class="programs-preview section section-tinted" aria-label="Key Programs">
        <div class="container">
            <div class="section-header centered reveal-up">
                <span class="section-eyebrow">{{ $content['programs_eyebrow'] ?? '' }}</span>
                <h2 class="section-title">{{ $content['programs_title_line_1'] ?? '' }}<br>{{ $content['programs_title_line_2'] ?? '' }}</h2>
                <p class="section-subtitle">{{ $content['programs_subtitle'] ?? '' }}</p>
            </div>
            <div class="programs-grid">
                @foreach($programs as $index => $program)
                    @php
                        $id = $program['id'] ?? '';
                    @endphp
                    <article class="program-card reveal-up" style="--delay: {{ $index * 0.08 }}s" aria-label="{{ $program['title'] ?? 'Program' }} Program">
                        <div class="program-icon program-icon--{{ $program['color'] ?? 'orange' }}" aria-hidden="true">
                            {!! $programIcons[$id] ?? ($programIcons['education']) !!}
                        </div>
                        <h3 class="program-title">{{ $program['title'] ?? '' }}</h3>
                        <p class="program-desc">{{ $program['desc'] ?? '' }}</p>
                        <div class="program-stat">{{ $program['stat'] ?? '' }}</div>
                        <a href="{{ route('programs') }}#{{ $id }}" class="program-link" aria-label="Learn more about {{ $program['title'] ?? 'program' }}">
                            Learn more
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                        </a>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════
         TESTIMONIALS
    ══════════════════════════════════════ --}}
    <section class="testimonials section" aria-label="Stories and Testimonials">
        <div class="container">
            <div class="section-header centered reveal-up">
                <span class="section-eyebrow">{{ $content['testimonials_eyebrow'] ?? '' }}</span>
                <h2 class="section-title">{{ $content['testimonials_title'] ?? '' }}</h2>
            </div>
            <div class="testimonials-grid">
                @foreach($testimonials as $index => $t)
                <blockquote class="testimonial-card reveal-up" style="--delay: {{ $index * 0.1 }}s">
                    <div class="testimonial-quote-mark" aria-hidden="true">"</div>
                    <p class="testimonial-text">{{ $t['quote'] ?? '' }}</p>
                    <footer class="testimonial-author">
                        <img src="{{ $t['img'] ?? '' }}" alt="Photo of {{ $t['name'] ?? '' }}" class="author-avatar" loading="lazy" width="48" height="48">
                        <div class="author-info">
                            <cite class="author-name">{{ $t['name'] ?? '' }}</cite>
                            <span class="author-role">{{ $t['role'] ?? '' }} · {{ $t['location'] ?? '' }}</span>
                        </div>
                    </footer>
                </blockquote>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════
         FINAL CTA BANNER
    ══════════════════════════════════════ --}}
    <section class="cta-banner section" aria-label="Call to Action">
        <div class="cta-banner-bg" aria-hidden="true">
            <img
                src="{{ $ctaMedia['url'] }}"
                alt="{{ $ctaMedia['alt_text'] }}"
                loading="lazy"
            >
            <div class="cta-banner-overlay"></div>
        </div>
        <div class="container cta-banner-content reveal-up">
            <span class="section-eyebrow light">{{ $content['cta_eyebrow'] ?? '' }}</span>
            <h2 class="cta-title">{{ $content['cta_title_line_1'] ?? '' }}<br>{{ $content['cta_title_line_2'] ?? '' }}</h2>
            <p class="cta-sub">{{ $content['cta_subtitle'] ?? '' }}</p>
            <div class="cta-actions">
                <a href="{{ route('donate') }}" class="btn btn-primary btn-lg">{{ $content['cta_primary_cta'] ?? 'Donate Now' }}</a>
                <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg">{{ $content['cta_secondary_cta'] ?? 'Volunteer With Us' }}</a>
            </div>
        </div>
    </section>

@endsection
