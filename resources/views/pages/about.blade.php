@extends('layouts.app')

@section('meta_title', 'About Us — Sahayog Foundation')
@section('meta_description', 'Learn about Sahayog Foundation\'s mission, values, history, and the dedicated team driving change in communities across India.')
@section('og_title', 'About Sahayog Foundation — Our Story & Team')
@section('og_description', 'Meet the passionate people behind Sahayog Foundation and learn why we do what we do.')

@section('content')

    @php
        $heroMedia = $media['hero_background'] ?? ['url' => '', 'alt_text' => ''];
        $values = $content['values'] ?? [];
        $milestones = $content['milestones'] ?? [];
        $team = $content['team'] ?? [];
        $partners = $content['partners'] ?? [];
    @endphp

    {{-- PAGE HERO --}}
    <section class="page-hero" aria-label="About Page Header">
        <div class="page-hero-bg" aria-hidden="true">
            <img src="{{ $heroMedia['url'] }}" alt="{{ $heroMedia['alt_text'] }}" loading="eager" fetchpriority="high">
            <div class="page-hero-overlay"></div>
        </div>
        <div class="container page-hero-content">
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span aria-hidden="true">›</span>
                <span aria-current="page">About</span>
            </nav>
            <h1 class="page-hero-title reveal-up">{{ $content['hero_title'] ?? '' }}</h1>
            <p class="page-hero-sub reveal-up">{{ $content['hero_subtitle'] ?? '' }}</p>
        </div>
    </section>

    {{-- MISSION + VISION --}}
    <section class="section" aria-label="Mission and Vision">
        <div class="container">
            <div class="mv-grid">
                <div class="mv-card reveal-left">
                    <div class="mv-icon" aria-hidden="true">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="4"/><line x1="12" y1="2" x2="12" y2="4"/><line x1="12" y1="20" x2="12" y2="22"/><line x1="2" y1="12" x2="4" y2="12"/><line x1="20" y1="12" x2="22" y2="12"/></svg>
                    </div>
                    <h2 class="mv-title">{{ $content['mission_title'] ?? '' }}</h2>
                    <p class="mv-text">{{ $content['mission_text'] ?? '' }}</p>
                </div>
                <div class="mv-card reveal-right">
                    <div class="mv-icon" aria-hidden="true">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M1 6v16l7-4 8 4 7-4V2l-7 4-8-4-7 4z"/><line x1="8" y1="2" x2="8" y2="18"/><line x1="16" y1="6" x2="16" y2="22"/></svg>
                    </div>
                    <h2 class="mv-title">{{ $content['vision_title'] ?? '' }}</h2>
                    <p class="mv-text">{{ $content['vision_text'] ?? '' }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- VALUES --}}
    <section class="section section-tinted" aria-label="Our Values">
        <div class="container">
            <div class="section-header centered reveal-up">
                <span class="section-eyebrow">{{ $content['values_eyebrow'] ?? '' }}</span>
                <h2 class="section-title">{{ $content['values_title'] ?? '' }}</h2>
            </div>
            <div class="values-grid">
                @foreach($values as $i => $v)
                <div class="value-card reveal-up" style="--delay: {{ $i * 0.07 }}s">
                    <span class="value-emoji" aria-hidden="true">{{ $v['icon'] ?? '' }}</span>
                    <h3 class="value-title">{{ $v['title'] ?? '' }}</h3>
                    <p class="value-desc">{{ $v['desc'] ?? '' }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- TIMELINE --}}
    <section class="section" aria-label="Our Journey">
        <div class="container">
            <div class="section-header centered reveal-up">
                <span class="section-eyebrow">{{ $content['journey_eyebrow'] ?? '' }}</span>
                <h2 class="section-title">{{ $content['journey_title'] ?? '' }}</h2>
            </div>
            <div class="timeline" role="list">
                @foreach($milestones as $i => $m)
                <div class="timeline-item reveal-up {{ $i % 2 === 0 ? 'timeline-left' : 'timeline-right' }}" style="--delay: {{ $i * 0.08 }}s" role="listitem">
                    <div class="timeline-content">
                        <div class="timeline-year">{{ $m['year'] ?? '' }}</div>
                        <h3 class="timeline-title">{{ $m['title'] ?? '' }}</h3>
                        <p class="timeline-desc">{{ $m['desc'] ?? '' }}</p>
                    </div>
                    <div class="timeline-dot" aria-hidden="true"></div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- TEAM --}}
    <section class="section section-tinted" aria-label="Our Team">
        <div class="container">
            <div class="section-header centered reveal-up">
                <span class="section-eyebrow">{{ $content['team_eyebrow'] ?? '' }}</span>
                <h2 class="section-title">{{ $content['team_title'] ?? '' }}</h2>
                <p class="section-subtitle">{{ $content['team_subtitle'] ?? '' }}</p>
            </div>
            <div class="team-grid">
                @foreach($team as $i => $member)
                <article class="team-card reveal-up" style="--delay: {{ $i * 0.08 }}s" aria-label="{{ $member['name'] ?? '' }}">
                    <div class="team-img-wrap">
                        <img
                            src="{{ $member['img'] ?? '' }}"
                            alt="Photo of {{ $member['name'] ?? '' }}, {{ $member['role'] ?? '' }}"
                            class="team-img"
                            loading="lazy"
                            width="300"
                            height="300"
                        >
                    </div>
                    <div class="team-info">
                        <h3 class="team-name">{{ $member['name'] ?? '' }}</h3>
                        <span class="team-role">{{ $member['role'] ?? '' }}</span>
                        <p class="team-bio">{{ $member['bio'] ?? '' }}</p>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- PARTNERS --}}
    <section class="section partners-section" aria-label="Partner Organizations">
        <div class="container">
            <div class="section-header centered reveal-up">
                <span class="section-eyebrow">{{ $content['partners_eyebrow'] ?? '' }}</span>
                <h2 class="section-title">{{ $content['partners_title'] ?? '' }}</h2>
            </div>
            <div class="partners-bar reveal-up">
                @foreach($partners as $p)
                <div class="partner-logo">{{ $p }}</div>
                @endforeach
            </div>
        </div>
    </section>

@endsection
