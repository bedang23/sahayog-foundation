<footer class="site-footer" role="contentinfo">
    <div class="container">

        <div class="footer-grid">

            {{-- Brand Column --}}
            <div class="footer-brand">
                <a href="{{ route('home') }}" class="logo logo-light" aria-label="Sahayog Foundation">
                    <span class="logo-mark" aria-hidden="true">
                        <svg width="28" height="28" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="16" cy="16" r="15" stroke="currentColor" stroke-width="2"/>
                            <path d="M10 20 C10 14, 22 14, 22 20" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/>
                            <circle cx="16" cy="11" r="3" fill="currentColor"/>
                        </svg>
                    </span>
                    <span class="logo-text">
                        <span class="logo-name">Sahayog</span>
                        <span class="logo-sub">Foundation</span>
                    </span>
                </a>
                <p class="footer-tagline">Empowering communities through education, health, and sustainable livelihoods since 2010.</p>
                <div class="footer-social">
                    <a href="#" class="social-link" aria-label="Facebook" rel="noopener noreferrer">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                    </a>
                    <a href="#" class="social-link" aria-label="Twitter / X" rel="noopener noreferrer">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/></svg>
                    </a>
                    <a href="#" class="social-link" aria-label="Instagram" rel="noopener noreferrer">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                    </a>
                    <a href="#" class="social-link" aria-label="LinkedIn" rel="noopener noreferrer">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6zM2 9h4v12H2z"/><circle cx="4" cy="4" r="2"/></svg>
                    </a>
                </div>
            </div>

            {{-- Quick Links --}}
            <div class="footer-col">
                <h3 class="footer-heading">Quick Links</h3>
                <ul class="footer-links" role="list">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('programs') }}">Our Programs</a></li>
                    <li><a href="{{ route('donate') }}">Donate</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>

            {{-- Programs --}}
            <div class="footer-col">
                <h3 class="footer-heading">Our Programs</h3>
                <ul class="footer-links" role="list">
                    <li><a href="{{ route('programs') }}#education">Education</a></li>
                    <li><a href="{{ route('programs') }}#health">Healthcare</a></li>
                    <li><a href="{{ route('programs') }}#livelihood">Livelihoods</a></li>
                    <li><a href="{{ route('programs') }}#environment">Environment</a></li>
                    <li><a href="{{ route('programs') }}#women">Women Empowerment</a></li>
                </ul>
            </div>

            {{-- Contact Info --}}
            <div class="footer-col">
                <h3 class="footer-heading">Get in Touch</h3>
                <address class="footer-contact">
                    <div class="contact-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        <span>42, Gandhi Road, Pune, Maharashtra 411001</span>
                    </div>
                    <div class="contact-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        <a href="mailto:info@sahayogfoundation.org">info@sahayogfoundation.org</a>
                    </div>
                    <div class="contact-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.41 2 2 0 0 1 3.6 1.21h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.76a16 16 0 0 0 6 6l.86-.86a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 21.61 16l.31.92z"/></svg>
                        <a href="tel:+912012345678">+91 20 1234 5678</a>
                    </div>
                </address>
            </div>

        </div>

        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Sahayog Foundation. All rights reserved. Registered NGO under Section 12A.</p>
            <div class="footer-bottom-links">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Use</a>
                <a href="#">80G Certificate</a>
            </div>
        </div>

    </div>
</footer>
