@extends('layouts.app')

@section('meta_title', 'Contact Us — Sahayog Foundation')
@section('meta_description', 'Get in touch with Sahayog Foundation. Reach out for volunteering, donations, partnerships, or general inquiries.')
@section('og_title', 'Contact Sahayog Foundation')
@section('og_description', 'We\'d love to hear from you. Reach out to volunteer, partner, or support our mission.')

@section('content')

    {{-- PAGE HERO --}}
    <section class="page-hero page-hero--short" aria-label="Contact Page Header">
        <div class="page-hero-bg" aria-hidden="true">
            <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?w=1600&auto=format&fit=crop&q=80" alt="" loading="eager" fetchpriority="high">
            <div class="page-hero-overlay"></div>
        </div>
        <div class="container page-hero-content">
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span aria-hidden="true">›</span>
                <span aria-current="page">Contact</span>
            </nav>
            <h1 class="page-hero-title reveal-up">Let's Connect</h1>
            <p class="page-hero-sub reveal-up">We'd love to hear from you — whether you want to volunteer, partner, or simply say hello.</p>
        </div>
    </section>

    {{-- CONTACT MAIN --}}
    <section class="contact-section section" aria-label="Contact Information and Form">
        <div class="container">
            <div class="contact-layout">

                {{-- Contact Info --}}
                <aside class="contact-info reveal-left" aria-label="Contact Details">
                    <h2 class="contact-info-title">Get in Touch</h2>
                    <p class="contact-info-sub">Our team typically responds within 1–2 business days.</p>

                    <div class="contact-info-list">
                        <div class="contact-info-item">
                            <div class="contact-info-icon" aria-hidden="true">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            </div>
                            <div>
                                <div class="contact-info-label">Office Address</div>
                                <address class="contact-info-value">
                                    42, Gandhi Road, Shivajinagar<br>
                                    Pune, Maharashtra 411001<br>
                                    India
                                </address>
                            </div>
                        </div>

                        <div class="contact-info-item">
                            <div class="contact-info-icon" aria-hidden="true">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                            </div>
                            <div>
                                <div class="contact-info-label">Email Us</div>
                                <a href="mailto:info@sahayogfoundation.org" class="contact-info-value">info@sahayogfoundation.org</a><br>
                                <a href="mailto:programs@sahayogfoundation.org" class="contact-info-value">programs@sahayogfoundation.org</a>
                            </div>
                        </div>

                        <div class="contact-info-item">
                            <div class="contact-info-icon" aria-hidden="true">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.41 2 2 0 0 1 3.6 1.21h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.76a16 16 0 0 0 6 6l.86-.86a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 21.61 16l.31.92z"/></svg>
                            </div>
                            <div>
                                <div class="contact-info-label">Phone</div>
                                <a href="tel:+912012345678" class="contact-info-value">+91 20 1234 5678</a><br>
                                <span class="contact-info-sub-note">Mon – Sat, 9am – 6pm IST</span>
                            </div>
                        </div>

                        <div class="contact-info-item">
                            <div class="contact-info-icon" aria-hidden="true">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            </div>
                            <div>
                                <div class="contact-info-label">Office Hours</div>
                                <div class="contact-info-value">Monday – Saturday<br>9:00 AM – 6:00 PM IST</div>
                            </div>
                        </div>
                    </div>

                    {{-- Social --}}
                    <div class="contact-social">
                        <div class="contact-social-label">Follow Our Work</div>
                        <div class="social-links-row">
                            <a href="#" class="social-link-contact" aria-label="Facebook">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                            </a>
                            <a href="#" class="social-link-contact" aria-label="Instagram">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                            </a>
                            <a href="#" class="social-link-contact" aria-label="LinkedIn">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-4 0v7h-4v-7a6 6 0 0 1 6-6zM2 9h4v12H2z"/><circle cx="4" cy="4" r="2"/></svg>
                            </a>
                            <a href="#" class="social-link-contact" aria-label="YouTube">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46a2.78 2.78 0 0 0-1.95 1.96A29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58 2.78 2.78 0 0 0 1.95 1.95C5.12 20 12 20 12 20s6.88 0 8.59-.47a2.78 2.78 0 0 0 1.95-1.95A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58z"/><polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02" fill="white"/></svg>
                            </a>
                        </div>
                    </div>
                </aside>

                {{-- Contact Form --}}
                <div class="contact-form-wrap reveal-right">
                    <div class="contact-form-card" role="region" aria-label="Contact Form">
                        <h2 class="form-heading">Send Us a Message</h2>

                        <div id="formSuccess" class="form-success-banner" aria-live="polite" hidden>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                            Thank you! We've received your message and will be in touch soon.
                        </div>

                        <div class="form-group">
                            <label for="contactName" class="form-label">Full Name <span class="required" aria-label="required">*</span></label>
                            <input type="text" id="contactName" name="name" class="form-input" placeholder="Your full name" required autocomplete="name">
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="contactEmail" class="form-label">Email Address <span class="required" aria-label="required">*</span></label>
                                <input type="email" id="contactEmail" name="email" class="form-input" placeholder="you@example.com" required autocomplete="email">
                            </div>
                            <div class="form-group">
                                <label for="contactPhone" class="form-label">Phone Number</label>
                                <input type="tel" id="contactPhone" name="phone" class="form-input" placeholder="+91 98765 43210" autocomplete="tel">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="contactSubject" class="form-label">Subject <span class="required" aria-label="required">*</span></label>
                            <select id="contactSubject" name="subject" class="form-select" required>
                                <option value="" disabled selected>Select a subject</option>
                                <option value="volunteer">Volunteering</option>
                                <option value="donate">Donation Inquiry</option>
                                <option value="csr">CSR / Partnership</option>
                                <option value="media">Media / Press</option>
                                <option value="program">Program Information</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="contactMessage" class="form-label">Message <span class="required" aria-label="required">*</span></label>
                            <textarea id="contactMessage" name="message" class="form-textarea" rows="5" placeholder="Tell us how you'd like to get involved or what you'd like to know..." required></textarea>
                        </div>

                        <div class="form-group form-checkbox-group">
                            <label class="checkbox-label">
                                <input type="checkbox" name="newsletter" class="checkbox-input" id="newsletter">
                                <span class="checkbox-custom" aria-hidden="true"></span>
                                Subscribe to our quarterly newsletter with field updates and impact stories.
                            </label>
                        </div>

                        <button type="button" class="btn btn-primary btn-full btn-lg" id="contactSubmitBtn">
                            Send Message
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                        </button>

                        <p class="form-disclaimer">We respect your privacy. Your information will never be shared with third parties.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- MAP --}}
    <section class="map-section" aria-label="Office Location">
        <div class="container">
            <div class="map-header reveal-up">
                <h2 class="section-title">Find Us</h2>
                <p>42, Gandhi Road, Shivajinagar, Pune – 411001, Maharashtra</p>
            </div>
        </div>
        <div class="map-embed" role="complementary" aria-label="Google Map showing office location">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3782.265588856342!2d73.84503931489726!3d18.520430287395556!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bc2c07f4e5d6a03%3A0x4c1a2c4d63c6c0ea!2sShivajinagar%2C%20Pune%2C%20Maharashtra!5e0!3m2!1sen!2sin!4v1234567890123!5m2!1sen!2sin"
                width="100%"
                height="420"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                title="Sahayog Foundation Office Location in Pune"
            ></iframe>
        </div>
    </section>

@endsection

@push('scripts')
<script src="{{ asset('js/contact.js') }}"></script>
@endpush
