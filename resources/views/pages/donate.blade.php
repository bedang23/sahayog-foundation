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
    <section class="donation-section section" aria-label="Donation Information">
        <div class="container">
            {{-- Section Header --}}
            <div class="section-header centered reveal-up" style="margin-bottom: 3rem;">
                <span class="section-eyebrow">Support Our Cause</span>
                <h2 class="section-title">Ways to Donate</h2>
                <p class="section-subtitle" style="max-width: 600px; margin: 0 auto;">Choose your preferred method to support our mission. Every contribution makes a difference.</p>
            </div>

            <div class="donation-layout" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2rem; align-items: start;">

                {{-- Left: Bank Details --}}
                <aside class="bank-details reveal-left" aria-label="Bank Information">
                    <div class="donation-info-card" style="background: #fff; border-radius: 16px; padding: 2rem; box-shadow: 0 4px 24px rgba(0,0,0,0.08); height: 100%;">
                        {{-- Card Header with Icon --}}
                        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                            <div style="width: 56px; height: 56px; background: linear-gradient(135deg, #f97316 0%, #fbbf24 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" aria-hidden="true">
                                    <rect x="1" y="4" width="22" height="16" rx="2" ry="2"/>
                                    <line x1="1" y1="10" x2="23" y2="10"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="section-title" style="font-size: 1.5rem; margin: 0;">Bank Transfer</h2>
                                <p class="section-subtitle" style="font-size: 0.875rem; color: #6b7280; margin: 0;">Direct bank transfer</p>
                            </div>
                        </div>

                        <div class="bank-info-section" style="background: #f9fafb; border-radius: 12px; padding: 1.5rem; margin-bottom: 1.5rem;">
                            <div class="bank-detail" style="display: flex; justify-content: space-between; padding: 0.75rem 0; border-bottom: 1px solid #e5e7eb;">
                                <span class="label" style="color: #6b7280; font-size: 0.875rem;">Bank Name</span>
                                <span class="value" style="font-weight: 600; color: #1f2937;">State Bank of India</span>
                            </div>
                            <div class="bank-detail" style="display: flex; justify-content: space-between; padding: 0.75rem 0; border-bottom: 1px solid #e5e7eb;">
                                <span class="label" style="color: #6b7280; font-size: 0.875rem;">Account Holder</span>
                                <span class="value" style="font-weight: 600; color: #1f2937;">Sahayog Foundation</span>
                            </div>
                            <div class="bank-detail" style="display: flex; justify-content: space-between; padding: 0.75rem 0; border-bottom: 1px solid #e5e7eb;">
                                <span class="label" style="color: #6b7280; font-size: 0.875rem;">Account Number</span>
                                <span class="value" style="font-weight: 600; color: #1f2937; font-family: monospace;">1234567890</span>
                            </div>
                            <div class="bank-detail" style="display: flex; justify-content: space-between; padding: 0.75rem 0; border-bottom: 1px solid #e5e7eb;">
                                <span class="label" style="color: #6b7280; font-size: 0.875rem;">IFSC Code</span>
                                <span class="value" style="font-weight: 600; color: #1f2937; font-family: monospace;">SBIN0012345</span>
                            </div>
                            <div class="bank-detail" style="display: flex; justify-content: space-between; padding: 0.75rem 0; border-bottom: 1px solid #e5e7eb;">
                                <span class="label" style="color: #6b7280; font-size: 0.875rem;">Branch</span>
                                <span class="value" style="font-weight: 600; color: #1f2937;">Pune, Maharashtra</span>
                            </div>
                            <div class="bank-detail" style="display: flex; justify-content: space-between; padding: 0.75rem 0;">
                                <span class="label" style="color: #6b7280; font-size: 0.875rem;">Account Type</span>
                                <span class="value" style="font-weight: 600; color: #1f2937;">Current Account</span>
                            </div>
                        </div>

                        <div class="donation-note" style="background: linear-gradient(135deg, rgba(249,115,22,0.08) 0%, rgba(251,191,36,0.08) 100%); border-radius: 12px; padding: 1.25rem; border-left: 4px solid #f97316;">
                            <p style="font-weight: 600; color: #1f2937; margin-bottom: 0.75rem; display: flex; align-items: center; gap: 0.5rem;">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#f97316" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                                Important Notes
                            </p>
                            <ul style="margin: 0; padding-left: 1.25rem; color: #4b5563; font-size: 0.875rem; line-height: 1.7;">
                                <li>For donations above ₹2000, we will issue an 80G receipt</li>
                                <li>After making a payment, please email us at <a href="mailto:info@sahayogfoundation.org" style="color: #f97316; text-decoration: underline;">info@sahayogfoundation.org</a> with your transaction details</li>
                                <li>For any queries, please contact us at +91 98765 43210</li>
                            </ul>
                        </div>
                    </div>
                </aside>

                {{-- Right: QR Code --}}
                <div class="qr-code-section reveal-right" aria-label="QR Code for UPI Payments">
                    <div class="donation-info-card" style="background: #fff; border-radius: 16px; padding: 2rem; box-shadow: 0 4px 24px rgba(0,0,0,0.08); height: 100%; text-align: center;">
                        {{-- Card Header with Icon --}}
                        <div style="display: flex; align-items: center; justify-content: center; gap: 1rem; margin-bottom: 1.5rem;">
                            <div style="width: 56px; height: 56px; background: linear-gradient(135deg, #f97316 0%, #fbbf24 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" aria-hidden="true">
                                    <rect x="3" y="3" width="7" height="7"/>
                                    <rect x="14" y="3" width="7" height="7"/>
                                    <rect x="14" y="14" width="7" height="7"/>
                                    <rect x="3" y="14" width="7" height="7"/>
                                </svg>
                            </div>
                        </div>
                        <h2 class="section-title" style="font-size: 1.5rem; margin-bottom: 0.5rem;">Scan to Donate</h2>
                        <p class="section-subtitle" style="font-size: 0.875rem; color: #6b7280; margin-bottom: 2rem;">Use UPI for instant donations</p>

                        <div class="qr-code-container" style="background: #fff; border: 2px solid #e5e7eb; border-radius: 16px; padding: 1.5rem; display: inline-block; margin-bottom: 1.5rem;">
                            <img src="{{ asset('images/qr-code-donation.png') }}" alt="QR Code for Donation" class="qr-code" width="200" height="200" style="display: block;">
                        </div>

                        <div class="qr-info" style="background: #f9fafb; border-radius: 12px; padding: 1.25rem;">
                            <p class="qr-note" style="color: #6b7280; font-size: 0.875rem; margin-bottom: 0.75rem;">Scan with any UPI app to donate instantly</p>
                            <div style="display: flex; align-items: center; justify-content: center; gap: 0.5rem; background: #fff; border: 1px solid #e5e7eb; border-radius: 8px; padding: 0.75rem 1rem;">
                                <span style="color: #6b7280; font-size: 0.875rem;">UPI ID:</span>
                                <span class="qr-upi-id" style="font-weight: 700; color: #f97316; font-family: monospace;">sahayogfoundation@upi</span>
                                <button type="button" onclick="navigator.clipboard.writeText('sahayogfoundation@upi')" style="background: none; border: none; cursor: pointer; padding: 0.25rem;" title="Copy UPI ID">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#6b7280" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
                                </button>
                            </div>
                        </div>

                        {{-- Supported Apps --}}
                        <div style="margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid #e5e7eb;">
                            <p style="font-size: 0.75rem; color: #9ca3af; margin-bottom: 0.75rem;">Supported UPI Apps</p>
                            <div style="display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap;">
                                <span style="font-size: 0.75rem; color: #6b7280; background: #f3f4f6; padding: 0.25rem 0.75rem; border-radius: 999px;">Google Pay</span>
                                <span style="font-size: 0.75rem; color: #6b7280; background: #f3f4f6; padding: 0.25rem 0.75rem; border-radius: 999px;">PhonePe</span>
                                <span style="font-size: 0.75rem; color: #6b7280; background: #f3f4f6; padding: 0.25rem 0.75rem; border-radius: 999px;">Paytm</span>
                                <span style="font-size: 0.75rem; color: #6b7280; background: #f3f4f6; padding: 0.25rem 0.75rem; border-radius: 999px;">BHIM</span>
                            </div>
                        </div>
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
