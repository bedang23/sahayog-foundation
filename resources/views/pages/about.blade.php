@extends('layouts.app')

@section('meta_title', 'About Us — Sahayog Foundation')
@section('meta_description', 'Learn about Sahayog Foundation\'s mission, values, history, and the dedicated team driving change in communities across India.')
@section('og_title', 'About Sahayog Foundation — Our Story & Team')
@section('og_description', 'Meet the passionate people behind Sahayog Foundation and learn why we do what we do.')

@section('content')

    {{-- PAGE HERO --}}
    <section class="page-hero" aria-label="About Page Header">
        <div class="page-hero-bg" aria-hidden="true">
            <img src="https://images.unsplash.com/photo-1573164713988-8665fc963095?w=1600&auto=format&fit=crop&q=80" alt="" loading="eager" fetchpriority="high">
            <div class="page-hero-overlay"></div>
        </div>
        <div class="container page-hero-content">
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span aria-hidden="true">›</span>
                <span aria-current="page">About</span>
            </nav>
            <h1 class="page-hero-title reveal-up">Our Story</h1>
            <p class="page-hero-sub reveal-up">Built on trust, driven by compassion.</p>
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
                    <h2 class="mv-title">Our Mission</h2>
                    <p class="mv-text">To work in solidarity with marginalized communities to enable them to lead dignified, healthy, and productive lives — through participatory development, rights-based advocacy, and sustainable programs.</p>
                </div>
                <div class="mv-card reveal-right">
                    <div class="mv-icon" aria-hidden="true">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M1 6v16l7-4 8 4 7-4V2l-7 4-8-4-7 4z"/><line x1="8" y1="2" x2="8" y2="18"/><line x1="16" y1="6" x2="16" y2="22"/></svg>
                    </div>
                    <h2 class="mv-title">Our Vision</h2>
                    <p class="mv-text">An India where every community has equitable access to education, health, and opportunity — and the agency to shape its own future free from poverty and discrimination.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- VALUES --}}
    <section class="section section-tinted" aria-label="Our Values">
        <div class="container">
            <div class="section-header centered reveal-up">
                <span class="section-eyebrow">What Guides Us</span>
                <h2 class="section-title">Our Core Values</h2>
            </div>
            <div class="values-grid">
                @php
                    $values = [
                        ['icon' => '🤝', 'title' => 'Community Ownership', 'desc' => 'Communities are not beneficiaries — they are partners and leaders in every initiative we undertake.'],
                        ['icon' => '🔍', 'title' => 'Transparency', 'desc' => 'We publish annual reports, audited accounts, and impact data publicly. Your trust is our foundation.'],
                        ['icon' => '♻️', 'title' => 'Sustainability', 'desc' => 'We design programs to become community-owned and self-sustaining, not dependent on external support forever.'],
                        ['icon' => '⚖️', 'title' => 'Equity & Inclusion', 'desc' => 'We prioritize the most marginalized: women, Dalits, Adivasis, and persons with disabilities.'],
                        ['icon' => '📊', 'title' => 'Evidence-Based', 'desc' => 'Every program is tracked, measured, and iterated based on real field data and community feedback.'],
                        ['icon' => '💛', 'title' => 'Compassion', 'desc' => 'Behind every number is a human being. We lead with empathy in every interaction and decision.'],
                    ];
                @endphp
                @foreach($values as $i => $v)
                <div class="value-card reveal-up" style="--delay: {{ $i * 0.07 }}s">
                    <span class="value-emoji" aria-hidden="true">{{ $v['icon'] }}</span>
                    <h3 class="value-title">{{ $v['title'] }}</h3>
                    <p class="value-desc">{{ $v['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- TIMELINE --}}
    <section class="section" aria-label="Our Journey">
        <div class="container">
            <div class="section-header centered reveal-up">
                <span class="section-eyebrow">Since 2010</span>
                <h2 class="section-title">Our Journey</h2>
            </div>
            <div class="timeline" role="list">
                @php
                    $milestones = [
                        ['year' => '2010', 'title' => 'Founded', 'desc' => 'Sahayog Foundation registered as a public charitable trust in Pune with a small team of 5.'],
                        ['year' => '2012', 'title' => 'Education Program Launched', 'desc' => 'First scholarship program reaches 200 students across 3 districts of Maharashtra.'],
                        ['year' => '2015', 'title' => 'Healthcare Initiative', 'desc' => 'Mobile health van program launched, conducting over 1,200 camps in the first year.'],
                        ['year' => '2017', 'title' => 'National Award', 'desc' => 'Recognized by the Ministry of Social Justice for outstanding community development work.'],
                        ['year' => '2020', 'title' => 'COVID Relief', 'desc' => 'Provided food rations, hygiene kits, and mental health support to 25,000 families during the pandemic.'],
                        ['year' => '2023', 'title' => '40,000+ Lives Impacted', 'desc' => 'Crossed a major milestone with presence in 180+ villages and 14 active programs running simultaneously.'],
                    ];
                @endphp
                @foreach($milestones as $i => $m)
                <div class="timeline-item reveal-up {{ $i % 2 === 0 ? 'timeline-left' : 'timeline-right' }}" style="--delay: {{ $i * 0.08 }}s" role="listitem">
                    <div class="timeline-content">
                        <div class="timeline-year">{{ $m['year'] }}</div>
                        <h3 class="timeline-title">{{ $m['title'] }}</h3>
                        <p class="timeline-desc">{{ $m['desc'] }}</p>
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
                <span class="section-eyebrow">The People Behind the Work</span>
                <h2 class="section-title">Meet Our Team</h2>
                <p class="section-subtitle">A diverse group of changemakers united by a single purpose.</p>
            </div>
            <div class="team-grid">
                @php
                    $team = [
                        [
                            'name' => 'Dr. Anjali Sharma',
                            'role' => 'Founder & Executive Director',
                            'bio' => 'Former IAS officer with 20 years in grassroots development. Passionate about rights-based approaches to poverty alleviation.',
                            'img' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=400&auto=format&fit=crop&q=80',
                        ],
                        [
                            'name' => 'Vikram Deshpande',
                            'role' => 'Director of Programs',
                            'bio' => 'Social entrepreneur with expertise in livelihood programs, microfinance, and community mobilization across five states.',
                            'img' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?w=400&auto=format&fit=crop&q=80',
                        ],
                        [
                            'name' => 'Sunita Rao',
                            'role' => 'Head of Education',
                            'bio' => 'Former schoolteacher turned education activist. Has built learning programs reaching over 12,000 students across Maharashtra.',
                            'img' => 'https://images.unsplash.com/photo-1551836022-d5d88e9218df?w=400&auto=format&fit=crop&q=80',
                        ],
                        [
                            'name' => 'Dr. Rajan Nair',
                            'role' => 'Head of Healthcare',
                            'bio' => 'Public health specialist with WHO experience. Designs mobile healthcare models that work in the most resource-scarce settings.',
                            'img' => 'https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=400&auto=format&fit=crop&q=80',
                        ],
                        [
                            'name' => 'Kavitha Menon',
                            'role' => 'Communications Manager',
                            'bio' => 'Storyteller and journalist who ensures every voice from the field is heard. Manages donor relations and advocacy campaigns.',
                            'img' => 'https://images.unsplash.com/photo-1508214751196-bcfd4ca60f91?w=400&auto=format&fit=crop&q=80',
                        ],
                        [
                            'name' => 'Arun Pawar',
                            'role' => 'Finance & Compliance',
                            'bio' => 'Chartered accountant ensuring full financial transparency, FCRA compliance, and responsible stewardship of donor funds.',
                            'img' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=400&auto=format&fit=crop&q=80',
                        ],
                    ];
                @endphp
                @foreach($team as $i => $member)
                <article class="team-card reveal-up" style="--delay: {{ $i * 0.08 }}s" aria-label="{{ $member['name'] }}">
                    <div class="team-img-wrap">
                        <img
                            src="{{ $member['img'] }}"
                            alt="Photo of {{ $member['name'] }}, {{ $member['role'] }}"
                            class="team-img"
                            loading="lazy"
                            width="300"
                            height="300"
                        >
                    </div>
                    <div class="team-info">
                        <h3 class="team-name">{{ $member['name'] }}</h3>
                        <span class="team-role">{{ $member['role'] }}</span>
                        <p class="team-bio">{{ $member['bio'] }}</p>
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
                <span class="section-eyebrow">Trusted Partners</span>
                <h2 class="section-title">Who We Work With</h2>
            </div>
            <div class="partners-bar reveal-up">
                @php
                    $partners = ['UNICEF India', 'GIZ India', 'Tata Trusts', 'CSR India', 'NABARD', 'Govt. of Maharashtra'];
                @endphp
                @foreach($partners as $p)
                <div class="partner-logo">{{ $p }}</div>
                @endforeach
            </div>
        </div>
    </section>

@endsection
