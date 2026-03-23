@extends('layouts.app')

@section('meta_title', 'Contact Us — Sahayog Foundation')
@section('meta_description', 'Get in touch with Sahayog Foundation. Reach out for volunteering, donations, partnerships, or general inquiries.')
@section('og_title', 'Contact Sahayog Foundation')
@section('og_description', 'We\'d love to hear from you. Reach out to volunteer, partner, or support our mission.')

@section('content')

    @php
        $heroMedia = $media['hero_background'] ?? ['url' => '', 'alt_text' => ''];
        $emails = $content['emails'] ?? [];
        $primaryEmail = $emails[0] ?? 'info@sahayogfoundation.org';
        $secondaryEmail = $emails[1] ?? null;
    @endphp

    {{-- PAGE HERO --}}
    <section class="page-hero page-hero--short" aria-label="Contact Page Header">
        <div class="page-hero-bg" aria-hidden="true">
            <img src="{{ $heroMedia['url'] }}" alt="{{ $heroMedia['alt_text'] }}" loading="eager" fetchpriority="high">
            <div class="page-hero-overlay"></div>
        </div>
        <div class="container page-hero-content">
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span aria-hidden="true">›</span>
                <span aria-current="page">Contact</span>
            </nav>
            <h1 class="page-hero-title reveal-up">{{ $content['hero_title'] ?? '' }}</h1>
            <p class="page-hero-sub reveal-up">{{ $content['hero_subtitle'] ?? '' }}</p>
        </div>
    </section>

    {{-- CONTACT MAIN --}}
    <section class="contact-section section" aria-label="Contact Information and Map">
        <div class="container">
            {{-- Section Header --}}
            <div class="section-header centered reveal-up" style="margin-bottom: 3rem;">
                <span class="section-eyebrow">Get in Touch</span>
                <h2 class="section-title">{{ $content['info_title'] ?? 'Contact Us' }}</h2>
                <p class="section-subtitle" style="max-width: 600px; margin: 0 auto;">{{ $content['info_subtitle'] ?? 'We\'d love to hear from you. Reach out through any of the channels below.' }}</p>
            </div>

            <div class="contact-layout" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2rem; align-items: start;">

                {{-- Contact Info --}}
                <aside class="contact-info reveal-left" aria-label="Contact Details">
                    <div class="contact-info-card" style="background: #fff; border-radius: 16px; padding: 2rem; box-shadow: 0 4px 24px rgba(0,0,0,0.08); height: 100%;">
                        {{-- Card Header --}}
                        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem;">
                            <div style="width: 56px; height: 56px; background: linear-gradient(135deg, #f97316 0%, #fbbf24 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" aria-hidden="true">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.41 2 2 0 0 1 3.6 1.21h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.76a16 16 0 0 0 6 6l.86-.86a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 21.61 16l.31.92z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="contact-info-title" style="font-size: 1.25rem; font-weight: 700; margin: 0; color: #1f2937;">Contact Information</h3>
                                <p style="font-size: 0.875rem; color: #6b7280; margin: 0;">Reach out to us anytime</p>
                            </div>
                        </div>

                        <div class="contact-info-list" style="display: flex; flex-direction: column; gap: 1.25rem;">
                            {{-- Address --}}
                            <div class="contact-info-item" style="display: flex; gap: 1rem; padding: 1rem; background: #f9fafb; border-radius: 12px; transition: all 0.2s ease;">
                                <div class="contact-info-icon" aria-hidden="true" style="width: 44px; height: 44px; background: rgba(249,115,22,0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#f97316" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                </div>
                                <div>
                                    <div class="contact-info-label" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; color: #9ca3af; margin-bottom: 0.25rem;">Office Address</div>
                                    <address class="contact-info-value" style="font-style: normal; color: #1f2937; font-weight: 500; line-height: 1.5;">{!! nl2br(e($content['address'] ?? '')) !!}</address>
                                </div>
                            </div>

                            {{-- Email --}}
                            <div class="contact-info-item" style="display: flex; gap: 1rem; padding: 1rem; background: #f9fafb; border-radius: 12px; transition: all 0.2s ease;">
                                <div class="contact-info-icon" aria-hidden="true" style="width: 44px; height: 44px; background: rgba(249,115,22,0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#f97316" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                                </div>
                                <div>
                                    <div class="contact-info-label" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; color: #9ca3af; margin-bottom: 0.25rem;">Email Us</div>
                                    <a href="mailto:{{ $primaryEmail }}" class="contact-info-value" style="color: #f97316; font-weight: 500; text-decoration: none;">{{ $primaryEmail }}</a>
                                    @if($secondaryEmail)
                                        <br>
                                        <a href="mailto:{{ $secondaryEmail }}" class="contact-info-value" style="color: #f97316; font-weight: 500; text-decoration: none;">{{ $secondaryEmail }}</a>
                                    @endif
                                </div>
                            </div>

                            {{-- Phone --}}
                            <div class="contact-info-item" style="display: flex; gap: 1rem; padding: 1rem; background: #f9fafb; border-radius: 12px; transition: all 0.2s ease;">
                                <div class="contact-info-icon" aria-hidden="true" style="width: 44px; height: 44px; background: rgba(249,115,22,0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#f97316" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.41 2 2 0 0 1 3.6 1.21h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.76a16 16 0 0 0 6 6l.86-.86a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 21.61 16l.31.92z"/></svg>
                                </div>
                                <div>
                                    <div class="contact-info-label" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; color: #9ca3af; margin-bottom: 0.25rem;">Phone</div>
                                    <a href="tel:{{ preg_replace('/\s+/', '', $content['phone'] ?? '') }}" class="contact-info-value" style="color: #1f2937; font-weight: 600; text-decoration: none; font-size: 1.125rem;">{{ $content['phone'] ?? '' }}</a>
                                    <span class="contact-info-sub-note" style="display: block; font-size: 0.75rem; color: #9ca3af; margin-top: 0.25rem;">{{ $content['phone_note'] ?? '' }}</span>
                                </div>
                            </div>
                        </div>

                        {{-- Social --}}
                        <div class="contact-social" style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #e5e7eb;">
                            <div class="contact-social-label" style="font-size: 0.875rem; color: #6b7280; margin-bottom: 1rem;">{{ $content['social_label'] ?? 'Follow Our Work' }}</div>
                            <div class="social-links-row" style="display: flex; gap: 0.75rem;">
                                <a href="#" class="social-link-contact" aria-label="Facebook" style="width: 44px; height: 44px; background: #f3f4f6; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #6b7280; transition: all 0.2s ease;">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                                </a>
                                <a href="#" class="social-link-contact" aria-label="Instagram" style="width: 44px; height: 44px; background: #f3f4f6; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #6b7280; transition: all 0.2s ease;">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                                </a>
                                <a href="#" class="social-link-contact" aria-label="LinkedIn" style="width: 44px; height: 44px; background: #f3f4f6; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #6b7280; transition: all 0.2s ease;">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-4 0v7h-4v-7a6 6 0 0 1 6-6zM2 9h4v12H2z"/><circle cx="4" cy="4" r="2"/></svg>
                                </a>
                                <a href="#" class="social-link-contact" aria-label="YouTube" style="width: 44px; height: 44px; background: #f3f4f6; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #6b7280; transition: all 0.2s ease;">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46a2.78 2.78 0 0 0-1.95 1.96A29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58 2.78 2.78 0 0 0 1.95 1.95C5.12 20 12 20 12 20s6.88 0 8.59-.47a2.78 2.78 0 0 0 1.95-1.95A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58z"/><polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02" fill="white"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </aside>

                {{-- Map --}}
                <div class="map-section reveal-right" aria-label="Office Location">
                    <div class="map-card" style="background: #fff; border-radius: 16px; padding: 2rem; box-shadow: 0 4px 24px rgba(0,0,0,0.08); height: 100%;">
                        {{-- Card Header --}}
                        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                            <div style="width: 56px; height: 56px; background: linear-gradient(135deg, #f97316 0%, #fbbf24 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" aria-hidden="true">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                    <circle cx="12" cy="10" r="3"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="section-title" style="font-size: 1.25rem; font-weight: 700; margin: 0; color: #1f2937;">{{ $content['map_title'] ?? 'Find Us' }}</h2>
                                <p style="font-size: 0.875rem; color: #6b7280; margin: 0;">{{ $content['map_subtitle'] ?? 'Visit our office' }}</p>
                            </div>
                        </div>
                        
                        <div class="map-embed" role="complementary" aria-label="Google Map showing office location" style="border-radius: 12px; overflow: hidden; border: 1px solid #e5e7eb;">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3782.265588856342!2d73.84503931489726!3d18.520430287395556!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bc2c07f4e5d6a03%3A0x4c1a2c4d63c6c0ea!2sShivajinagar%2C%20Pune%2C%20Maharashtra!5e0!3m2!1sen!2sin!4v1234567890123!5m2!1sen!2sin"
                                width="100%"
                                height="380"
                                style="border:0; display: block;"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"
                                title="Sahayog Foundation Office Location in Pune"
                            ></iframe>
                        </div>

                        {{-- Quick Actions --}}
                        <div style="margin-top: 1.5rem; display: flex; gap: 1rem; flex-wrap: wrap;">
                            <a href="https://maps.google.com/?q=Shivajinagar,Pune,Maharashtra" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.75rem 1.25rem; background: linear-gradient(135deg, #f97316 0%, #fbbf24 100%); color: white; border-radius: 8px; font-size: 0.875rem; font-weight: 600; text-decoration: none; transition: all 0.2s ease;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                                Get Directions
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script src="{{ asset('js/contact.js') }}"></script>
@endpush
