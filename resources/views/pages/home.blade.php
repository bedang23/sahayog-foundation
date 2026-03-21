@extends('layouts.app')

@section('meta_title', 'Sahayog Foundation — Empowering Communities Across India')
@section('meta_description', 'Sahayog Foundation works with underserved communities in India to provide education, healthcare, and sustainable livelihoods. Join us in making a difference.')
@section('og_title', 'Sahayog Foundation — Empowering Communities Across India')
@section('og_description', 'Join Sahayog Foundation in building a better India through education, health, and opportunity.')

@section('content')

    {{-- ═══════════════════════════════════════
         HERO SECTION
    ══════════════════════════════════════ --}}
    <section class="hero" aria-label="Hero">
        <div class="hero-media">
            <img
                src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=1600&auto=format&fit=crop&q=80"
                alt="Children learning together in a bright classroom"
                class="hero-img"
                loading="eager"
                fetchpriority="high"
            >
            <div class="hero-overlay" aria-hidden="true"></div>
        </div>
        <div class="container hero-content">
            <div class="hero-text reveal-up">
                <span class="hero-eyebrow">Changing lives since 2010</span>
                <h1 class="hero-headline">
                    Every Child Deserves<br>
                    a <span class="highlight-word">Brighter</span> Tomorrow
                </h1>
                <p class="hero-sub">
                    We partner with communities to break the cycle of poverty through education, healthcare, and sustainable livelihoods — one family at a time.
                </p>
                <div class="hero-actions">
                    <a href="{{ route('donate') }}" class="btn btn-primary btn-lg">Donate Today</a>
                    <a href="{{ route('about') }}" class="btn btn-outline-light btn-lg">Our Story</a>
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
                @php
                    $stats = [
                        ['number' => 42000, 'suffix' => '+', 'label' => 'Lives Impacted'],
                        ['number' => 180,   'suffix' => '+', 'label' => 'Villages Reached'],
                        ['number' => 95,    'suffix' => '%',  'label' => 'Program Success Rate'],
                        ['number' => 12,    'suffix' => '',   'label' => 'Years of Service'],
                    ];
                @endphp
                @foreach($stats as $stat)
                <div class="stat-card reveal-up">
                    <div class="stat-number" data-target="{{ $stat['number'] }}" data-suffix="{{ $stat['suffix'] }}">0{{ $stat['suffix'] }}</div>
                    <div class="stat-label">{{ $stat['label'] }}</div>
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
                            src="https://images.unsplash.com/photo-1509099836639-18ba1795216d?w=700&auto=format&fit=crop&q=80"
                            alt="Volunteer teaching children in rural school"
                            class="img-main"
                            loading="lazy"
                        >
                        <img
                            src="https://images.unsplash.com/photo-1571210862729-78a52d3779a2?w=400&auto=format&fit=crop&q=80"
                            alt="Community health camp in progress"
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
                    <span class="section-eyebrow">Who We Are</span>
                    <h2 class="section-title">Rooted in Community,<br>Driven by Purpose</h2>
                    <p class="section-body">Sahayog Foundation was born from a simple belief: that every human being deserves dignity, opportunity, and the tools to shape their own future. Since 2010, we have worked alongside communities — not for them — to create lasting change.</p>
                    <p class="section-body">Our approach is holistic. We address the interconnected roots of poverty by focusing on education, health, environment, and economic opportunity simultaneously.</p>
                    <div class="about-values">
                        <div class="value-pill">Community-First</div>
                        <div class="value-pill">Transparent</div>
                        <div class="value-pill">Sustainable</div>
                        <div class="value-pill">Accountable</div>
                    </div>
                    <a href="{{ route('about') }}" class="btn btn-primary mt-4">Meet Our Team</a>
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
                <span class="section-eyebrow">What We Do</span>
                <h2 class="section-title">Programs That Create<br>Lasting Change</h2>
                <p class="section-subtitle">We run integrated programs across five key areas, designed to address root causes rather than symptoms.</p>
            </div>
            <div class="programs-grid">
                @php
                    $programs = [
                        [
                            'icon' => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>',
                            'title' => 'Education',
                            'desc' => 'Bridging the learning gap through scholarships, digital literacy, and quality coaching for underprivileged students.',
                            'stat' => '12,000+ students enrolled',
                            'color' => 'orange',
                            'link' => route('programs') . '#education',
                        ],
                        [
                            'icon' => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>',
                            'title' => 'Healthcare',
                            'desc' => 'Mobile health camps, maternal care, and preventive medicine reaching the most remote communities.',
                            'stat' => '8,500+ patients treated',
                            'color' => 'yellow',
                            'link' => route('programs') . '#health',
                        ],
                        [
                            'icon' => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>',
                            'title' => 'Livelihoods',
                            'desc' => 'Skill training, microfinance linkages, and self-help group formation empowering families toward financial independence.',
                            'stat' => '3,200+ families supported',
                            'color' => 'orange',
                            'link' => route('programs') . '#livelihood',
                        ],
                        [
                            'icon' => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>',
                            'title' => 'Environment',
                            'desc' => 'Watershed management, tree plantation, and clean energy adoption for a sustainable future.',
                            'stat' => '50,000+ trees planted',
                            'color' => 'yellow',
                            'link' => route('programs') . '#environment',
                        ],
                        [
                            'icon' => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="8" r="4"/><path d="M6 20v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2"/></svg>',
                            'title' => 'Women Empowerment',
                            'desc' => 'Leadership training, legal literacy, and entrepreneurship support for women to lead change in their communities.',
                            'stat' => '5,800+ women empowered',
                            'color' => 'orange',
                            'link' => route('programs') . '#women',
                        ],
                        [
                            'icon' => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>',
                            'title' => 'Digital Inclusion',
                            'desc' => 'Bringing internet access, e-governance training, and digital skills to rural communities across Maharashtra.',
                            'stat' => '200+ digital centers',
                            'color' => 'yellow',
                            'link' => route('programs') . '#digital',
                        ],
                    ];
                @endphp
                @foreach($programs as $index => $program)
                <article class="program-card reveal-up" style="--delay: {{ $index * 0.08 }}s" aria-label="{{ $program['title'] }} Program">
                    <div class="program-icon program-icon--{{ $program['color'] }}" aria-hidden="true">
                        {!! $program['icon'] !!}
                    </div>
                    <h3 class="program-title">{{ $program['title'] }}</h3>
                    <p class="program-desc">{{ $program['desc'] }}</p>
                    <div class="program-stat">{{ $program['stat'] }}</div>
                    <a href="{{ $program['link'] }}" class="program-link" aria-label="Learn more about {{ $program['title'] }}">
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
                <span class="section-eyebrow">Real Stories</span>
                <h2 class="section-title">Voices from the Community</h2>
            </div>
            <div class="testimonials-grid">
                @php
                    $testimonials = [
                        [
                            'quote' => 'Sahayog\'s scholarship changed everything. I was about to drop out in Class 9. Today I am a computer science student at Pune University. I want to come back and give back.',
                            'name' => 'Priya Kamble',
                            'role' => 'Scholarship Beneficiary',
                            'location' => 'Solapur, Maharashtra',
                            'img' => 'https://images.unsplash.com/photo-1531123897727-8f129e1688ce?w=150&auto=format&fit=crop&q=80',
                        ],
                        [
                            'quote' => 'Our self-help group received training and a small loan through the foundation. We now run a successful tailoring unit with 11 women. We are independent.',
                            'name' => 'Meena Jadhav',
                            'role' => 'SHG Leader',
                            'location' => 'Nashik, Maharashtra',
                            'img' => 'https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?w=150&auto=format&fit=crop&q=80',
                        ],
                        [
                            'quote' => 'The mobile health camp visited our village for the first time. My son\'s eye disease was caught early. Without this, he could have lost his sight. Thank you.',
                            'name' => 'Ramesh Patil',
                            'role' => 'Community Member',
                            'location' => 'Osmanabad, Maharashtra',
                            'img' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=150&auto=format&fit=crop&q=80',
                        ],
                    ];
                @endphp
                @foreach($testimonials as $index => $t)
                <blockquote class="testimonial-card reveal-up" style="--delay: {{ $index * 0.1 }}s">
                    <div class="testimonial-quote-mark" aria-hidden="true">"</div>
                    <p class="testimonial-text">{{ $t['quote'] }}</p>
                    <footer class="testimonial-author">
                        <img src="{{ $t['img'] }}" alt="Photo of {{ $t['name'] }}" class="author-avatar" loading="lazy" width="48" height="48">
                        <div class="author-info">
                            <cite class="author-name">{{ $t['name'] }}</cite>
                            <span class="author-role">{{ $t['role'] }} · {{ $t['location'] }}</span>
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
                src="https://images.unsplash.com/photo-1559027615-cd4628902d4a?w=1600&auto=format&fit=crop&q=80"
                alt=""
                loading="lazy"
            >
            <div class="cta-banner-overlay"></div>
        </div>
        <div class="container cta-banner-content reveal-up">
            <span class="section-eyebrow light">Make a Difference</span>
            <h2 class="cta-title">Together, We Can Do<br>So Much More</h2>
            <p class="cta-sub">Your contribution — however small — ripples through generations. Help us reach the next village, the next child, the next family.</p>
            <div class="cta-actions">
                <a href="{{ route('donate') }}" class="btn btn-primary btn-lg">Donate Now</a>
                <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg">Volunteer With Us</a>
            </div>
        </div>
    </section>

@endsection
