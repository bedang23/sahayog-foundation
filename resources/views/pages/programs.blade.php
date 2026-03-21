@extends('layouts.app')

@section('meta_title', 'Our Programs — Sahayog Foundation')
@section('meta_description', 'Explore Sahayog Foundation\'s integrated programs in education, healthcare, livelihoods, environment, and women empowerment across rural India.')
@section('og_title', 'Our Programs — Sahayog Foundation')
@section('og_description', 'From classrooms to health camps, discover how Sahayog Foundation creates lasting impact across communities.')

@section('content')

    {{-- PAGE HERO --}}
    <section class="page-hero" aria-label="Programs Page Header">
        <div class="page-hero-bg" aria-hidden="true">
            <img src="https://images.unsplash.com/photo-1427504494785-3a9ca7044f45?w=1600&auto=format&fit=crop&q=80" alt="" loading="eager" fetchpriority="high">
            <div class="page-hero-overlay"></div>
        </div>
        <div class="container page-hero-content">
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span aria-hidden="true">›</span>
                <span aria-current="page">Programs</span>
            </nav>
            <h1 class="page-hero-title reveal-up">Our Programs</h1>
            <p class="page-hero-sub reveal-up">Integrated initiatives that address the roots of poverty.</p>
        </div>
    </section>

    {{-- PROGRAMS NAV --}}
    <nav class="programs-subnav" aria-label="Program Categories">
        <div class="container">
            <ul class="subnav-list" role="list">
                <li><a href="#education" class="subnav-link">Education</a></li>
                <li><a href="#health" class="subnav-link">Healthcare</a></li>
                <li><a href="#livelihood" class="subnav-link">Livelihoods</a></li>
                <li><a href="#environment" class="subnav-link">Environment</a></li>
                <li><a href="#women" class="subnav-link">Women</a></li>
                <li><a href="#digital" class="subnav-link">Digital</a></li>
            </ul>
        </div>
    </nav>

    {{-- EDUCATION --}}
    <section class="program-detail section" id="education" aria-label="Education Program">
        <div class="container">
            <div class="program-detail-grid">
                <div class="program-detail-text reveal-left">
                    <span class="section-eyebrow">Program 01</span>
                    <h2 class="section-title">Education for All</h2>
                    <p class="section-body">We believe education is the single most powerful lever for lasting change. Our Education for All program ensures that no child drops out of school due to poverty, lack of resources, or distance from learning centers.</p>
                    <p class="section-body">We run scholarship programs, bridge learning centers, digital classrooms, and parent sensitization workshops to keep children — especially girls — in school and learning.</p>
                    <ul class="program-highlights" role="list">
                        <li>₹3,500 scholarships for 2,000+ students annually</li>
                        <li>50+ community learning centers across 5 districts</li>
                        <li>Digital literacy for 8,000+ students</li>
                        <li>85% scholarship retention rate</li>
                    </ul>
                    <a href="{{ route('donate') }}" class="btn btn-primary mt-4">Support Education</a>
                </div>
                <div class="program-detail-image reveal-right">
                    <img
                        src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=700&auto=format&fit=crop&q=80"
                        alt="Children studying in a bright classroom supported by Sahayog Foundation"
                        loading="lazy"
                    >
                </div>
            </div>
        </div>
    </section>

    {{-- HEALTH --}}
    <section class="program-detail section section-tinted" id="health" aria-label="Healthcare Program">
        <div class="container">
            <div class="program-detail-grid reverse">
                <div class="program-detail-image reveal-left">
                    <img
                        src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=700&auto=format&fit=crop&q=80"
                        alt="Doctor conducting mobile health camp in rural village"
                        loading="lazy"
                    >
                </div>
                <div class="program-detail-text reveal-right">
                    <span class="section-eyebrow">Program 02</span>
                    <h2 class="section-title">Community Healthcare</h2>
                    <p class="section-body">Healthcare should not be a privilege. Our mobile health units bring qualified doctors, diagnostic equipment, and medicines directly to villages where the nearest hospital may be 50 km away.</p>
                    <p class="section-body">We focus on maternal health, child nutrition, preventive care, and early detection of diseases that are treatable when caught early but devastating when ignored.</p>
                    <ul class="program-highlights" role="list">
                        <li>12 mobile health vans serving 180+ villages</li>
                        <li>1,200+ health camps conducted annually</li>
                        <li>Free medicines distributed to 8,500+ patients</li>
                        <li>Maternal mortality reduced by 40% in target areas</li>
                    </ul>
                    <a href="{{ route('donate') }}" class="btn btn-primary mt-4">Support Healthcare</a>
                </div>
            </div>
        </div>
    </section>

    {{-- LIVELIHOOD --}}
    <section class="program-detail section" id="livelihood" aria-label="Livelihoods Program">
        <div class="container">
            <div class="program-detail-grid">
                <div class="program-detail-text reveal-left">
                    <span class="section-eyebrow">Program 03</span>
                    <h2 class="section-title">Sustainable Livelihoods</h2>
                    <p class="section-body">Economic independence is the foundation of all other freedoms. We work with families to identify livelihood opportunities, build skills, link with markets, and access credit — enabling sustainable income growth.</p>
                    <ul class="program-highlights" role="list">
                        <li>Skill training in 25+ trades and vocations</li>
                        <li>300+ self-help groups formed and active</li>
                        <li>Microfinance linkages for 3,200+ families</li>
                        <li>Average income increased by 65% post-program</li>
                    </ul>
                    <a href="{{ route('donate') }}" class="btn btn-primary mt-4">Support Livelihoods</a>
                </div>
                <div class="program-detail-image reveal-right">
                    <img
                        src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=700&auto=format&fit=crop&q=80"
                        alt="Women working in a tailoring unit supported by Sahayog Foundation"
                        loading="lazy"
                    >
                </div>
            </div>
        </div>
    </section>

    {{-- ENVIRONMENT --}}
    <section class="program-detail section section-tinted" id="environment" aria-label="Environment Program">
        <div class="container">
            <div class="program-detail-grid reverse">
                <div class="program-detail-image reveal-left">
                    <img
                        src="https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=700&auto=format&fit=crop&q=80"
                        alt="Community members planting trees as part of environmental restoration"
                        loading="lazy"
                    >
                </div>
                <div class="program-detail-text reveal-right">
                    <span class="section-eyebrow">Program 04</span>
                    <h2 class="section-title">Environment & Climate</h2>
                    <p class="section-body">Climate change hits the poorest communities hardest. We work on watershed management, organic farming, tree plantation, and clean energy adoption to build climate-resilient communities.</p>
                    <ul class="program-highlights" role="list">
                        <li>50,000+ trees planted across Maharashtra</li>
                        <li>Watershed projects restoring 1,200 acres</li>
                        <li>800+ solar lamp installations in tribal hamlets</li>
                        <li>Organic certification for 500+ farmers</li>
                    </ul>
                    <a href="{{ route('donate') }}" class="btn btn-primary mt-4">Support Environment</a>
                </div>
            </div>
        </div>
    </section>

    {{-- WOMEN --}}
    <section class="program-detail section" id="women" aria-label="Women Empowerment Program">
        <div class="container">
            <div class="program-detail-grid">
                <div class="program-detail-text reveal-left">
                    <span class="section-eyebrow">Program 05</span>
                    <h2 class="section-title">Women Empowerment</h2>
                    <p class="section-body">When women lead, communities thrive. We invest in women's leadership, legal literacy, safety, and entrepreneurship — helping them claim their rights and transform their families and communities.</p>
                    <ul class="program-highlights" role="list">
                        <li>Leadership training for 5,800+ women</li>
                        <li>Legal aid and rights awareness in 90+ villages</li>
                        <li>150+ women-led enterprises supported</li>
                        <li>Domestic violence intervention programs</li>
                    </ul>
                    <a href="{{ route('donate') }}" class="btn btn-primary mt-4">Support Women</a>
                </div>
                <div class="program-detail-image reveal-right">
                    <img
                        src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?w=700&auto=format&fit=crop&q=80"
                        alt="Group of empowered women from a rural self-help group"
                        loading="lazy"
                    >
                </div>
            </div>
        </div>
    </section>

    {{-- DIGITAL --}}
    <section class="program-detail section section-tinted" id="digital" aria-label="Digital Inclusion Program">
        <div class="container">
            <div class="program-detail-grid reverse">
                <div class="program-detail-image reveal-left">
                    <img
                        src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?w=700&auto=format&fit=crop&q=80"
                        alt="Young people learning digital skills at a community center"
                        loading="lazy"
                    >
                </div>
                <div class="program-detail-text reveal-right">
                    <span class="section-eyebrow">Program 06</span>
                    <h2 class="section-title">Digital Inclusion</h2>
                    <p class="section-body">The digital divide is widening inequality. We build community digital centers, train youth in digital skills, and connect communities to government services, markets, and learning resources online.</p>
                    <ul class="program-highlights" role="list">
                        <li>200+ digital community centers established</li>
                        <li>15,000+ youth trained in digital skills</li>
                        <li>e-Governance access for 30,000+ households</li>
                        <li>Online market linkages for 800+ artisans</li>
                    </ul>
                    <a href="{{ route('donate') }}" class="btn btn-primary mt-4">Support Digital India</a>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="inner-cta section" aria-label="Support Our Programs">
        <div class="container">
            <div class="inner-cta-box reveal-up">
                <div class="inner-cta-text">
                    <h2 class="inner-cta-title">Want to Partner With Us?</h2>
                    <p>We welcome CSR partnerships, institutional grants, and individual donors who share our vision.</p>
                </div>
                <div class="inner-cta-actions">
                    <a href="{{ route('donate') }}" class="btn btn-primary btn-lg">Donate</a>
                    <a href="{{ route('contact') }}" class="btn btn-outline btn-lg">Get in Touch</a>
                </div>
            </div>
        </div>
    </section>

@endsection
