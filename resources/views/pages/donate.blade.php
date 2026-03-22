@extends('layouts.app')

@section('meta_title', 'Donate — Sahayog Foundation')
@section('meta_description', 'Support Sahayog Foundation\'s life-changing work. Your donation funds education, healthcare, and sustainable livelihoods for communities in need.')
@section('og_title', 'Donate to Sahayog Foundation')
@section('og_description', 'Every rupee makes a difference. Support education, health, and opportunity for India\'s most underserved communities.')

@section('content')

    @php
        $heroMedia = $media['hero_background'] ?? ['url' => '', 'alt_text' => ''];
        $impactCards = $content['impact_cards'] ?? [];
        $trustBadges = $content['trust_badges'] ?? [];
        $faqs = $content['faqs'] ?? [];

        $trustIcons = [
            '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>',
            '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>',
            '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>',
            '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>',
        ];
    @endphp

    {{-- PAGE HERO --}}
    <section class="page-hero page-hero--short" aria-label="Donation Page Header">
        <div class="page-hero-bg" aria-hidden="true">
            <img src="{{ $heroMedia['url'] }}" alt="{{ $heroMedia['alt_text'] }}" loading="eager" fetchpriority="high">
            <div class="page-hero-overlay"></div>
        </div>
        <div class="container page-hero-content">
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span aria-hidden="true">›</span>
                <span aria-current="page">Donate</span>
            </nav>
            <h1 class="page-hero-title reveal-up">{{ $content['hero_title'] ?? '' }}</h1>
            <p class="page-hero-sub reveal-up">{{ $content['hero_subtitle'] ?? '' }}</p>
        </div>
    </section>

    {{-- DONATION SECTION --}}
    <section class="donation-section section" aria-label="Donation Form">
        <div class="container">
            <div class="donation-layout">

                {{-- Left: Impact Info --}}
                <aside class="donation-impact reveal-left" aria-label="Donation Impact">
                    <h2 class="impact-title">{{ $content['impact_title'] ?? '' }}</h2>

                    <div class="impact-cards">
                        @foreach($impactCards as $card)
                            <div class="impact-card">
                                <div class="impact-amount">{{ $card['amount'] ?? '' }}</div>
                                <div class="impact-desc">{{ $card['desc'] ?? '' }}</div>
                            </div>
                        @endforeach
                    </div>

                    <div class="trust-badges" aria-label="Trust Indicators">
                        @foreach($trustBadges as $i => $badge)
                            <div class="trust-badge">
                                {!! $trustIcons[$i] ?? $trustIcons[0] !!}
                                <span>{{ $badge }}</span>
                            </div>
                        @endforeach
                    </div>
                </aside>

                {{-- Right: Donation Form --}}
                <div class="donation-form-wrap reveal-right" role="region" aria-label="Donation Form">
                    <div class="donation-form-card">
                        <h2 class="form-heading">{{ $content['form_heading'] ?? 'Choose Your Contribution' }}</h2>

                        {{-- Frequency Toggle --}}
                        <div class="frequency-toggle" role="group" aria-label="Donation Frequency">
                            <button type="button" class="freq-btn active" data-freq="one-time">One-Time</button>
                            <button type="button" class="freq-btn" data-freq="monthly">Monthly</button>
                            <button type="button" class="freq-btn" data-freq="annual">Annual</button>
                        </div>

                        {{-- Amount Presets --}}
                        <div class="amount-label">Select Amount (₹)</div>
                        <div class="amount-grid" role="group" aria-label="Preset donation amounts">
                            @foreach([500, 1000, 2500, 5000, 10000, 25000] as $amount)
                            <button type="button" class="amount-btn {{ $amount === 1000 ? 'active' : '' }}" data-amount="{{ $amount }}" aria-pressed="{{ $amount === 1000 ? 'true' : 'false' }}">
                                ₹{{ number_format($amount) }}
                            </button>
                            @endforeach
                        </div>

                        {{-- Custom Amount --}}
                        <div class="custom-amount-wrap">
                            <label for="customAmount" class="custom-label">Or enter a custom amount</label>
                            <div class="custom-input-wrap">
                                <span class="input-prefix" aria-hidden="true">₹</span>
                                <input
                                    type="number"
                                    id="customAmount"
                                    name="custom_amount"
                                    placeholder="Enter amount"
                                    min="100"
                                    class="custom-input"
                                    aria-describedby="minAmountHint"
                                >
                            </div>
                            <span class="field-hint" id="minAmountHint">Minimum donation: ₹100</span>
                        </div>

                        {{-- Program Designation --}}
                        <div class="program-select-wrap">
                            <label for="programSelect" class="form-label">Designate to a program (optional)</label>
                            <select id="programSelect" name="program" class="form-select">
                                <option value="general">General Fund (Where Needed Most)</option>
                                <option value="education">Education</option>
                                <option value="health">Healthcare</option>
                                <option value="livelihood">Livelihoods</option>
                                <option value="environment">Environment</option>
                                <option value="women">Women Empowerment</option>
                            </select>
                        </div>

                        <div class="divider" aria-hidden="true"></div>

                        {{-- Donor Details --}}
                        <h3 class="form-subheading">Your Details</h3>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="donorName" class="form-label">Full Name <span class="required" aria-label="required">*</span></label>
                                <input type="text" id="donorName" name="name" class="form-input" placeholder="Rajesh Kumar" required autocomplete="name">
                            </div>
                            <div class="form-group">
                                <label for="donorPan" class="form-label">PAN Number <span class="field-hint-inline">(for 80G receipt)</span></label>
                                <input type="text" id="donorPan" name="pan" class="form-input" placeholder="ABCDE1234F" maxlength="10">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="donorEmail" class="form-label">Email <span class="required" aria-label="required">*</span></label>
                                <input type="email" id="donorEmail" name="email" class="form-input" placeholder="you@example.com" required autocomplete="email">
                            </div>
                            <div class="form-group">
                                <label for="donorPhone" class="form-label">Phone</label>
                                <input type="tel" id="donorPhone" name="phone" class="form-input" placeholder="+91 98765 43210" autocomplete="tel">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="donorMessage" class="form-label">Message (optional)</label>
                            <textarea id="donorMessage" name="message" class="form-textarea" rows="3" placeholder="A note about why you're donating..."></textarea>
                        </div>

                        {{-- Summary --}}
                        <div class="donation-summary" aria-live="polite" aria-label="Donation Summary">
                            <div class="summary-row">
                                <span>Donation Amount</span>
                                <strong id="summaryAmount">₹1,000</strong>
                            </div>
                            <div class="summary-row">
                                <span>Tax Benefit (30% of ₹1,000)</span>
                                <strong id="summaryTax" class="text-green">- ₹300</strong>
                            </div>
                            <div class="summary-row summary-total">
                                <span>Your Net Cost</span>
                                <strong id="summaryNet">₹700</strong>
                            </div>
                        </div>

                        <button type="button" class="btn btn-primary btn-full btn-lg donate-submit" id="donateBtn">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                            Proceed to Donate ₹1,000
                        </button>

                        <p class="form-disclaimer">By donating, you agree to our <a href="#">Privacy Policy</a>. This is a demo form — no real payment will be processed.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- FAQs --}}
    <section class="section section-tinted" aria-label="Donation FAQs">
        <div class="container">
            <div class="section-header centered reveal-up">
                <span class="section-eyebrow">{{ $content['faq_eyebrow'] ?? 'Questions' }}</span>
                <h2 class="section-title">{{ $content['faq_title'] ?? 'Frequently Asked' }}</h2>
            </div>
            <div class="faq-list reveal-up">
                @foreach($faqs as $i => $faq)
                <details class="faq-item" style="--delay: {{ $i * 0.06 }}s">
                    <summary class="faq-question">
                        {{ $faq['q'] ?? '' }}
                        <svg class="faq-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><polyline points="6 9 12 15 18 9"/></svg>
                    </summary>
                    <div class="faq-answer">{{ $faq['a'] ?? '' }}</div>
                </details>
                @endforeach
            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script src="{{ asset('js/donate.js') }}"></script>
@endpush
