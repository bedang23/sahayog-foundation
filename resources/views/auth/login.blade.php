@extends('layouts.app')

@section('meta_title', 'Admin Login — Sahayog Foundation')
@section('meta_description', 'Secure login for Sahayog Foundation content management.')

@section('content')

    <section class="page-hero page-hero--short" aria-label="Admin Login Header">
        <div class="page-hero-bg" aria-hidden="true">
            <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=1600&auto=format&fit=crop&q=80" alt="Team planning session" loading="eager" fetchpriority="high">
            <div class="page-hero-overlay"></div>
        </div>
        <div class="container page-hero-content">
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span aria-hidden="true">›</span>
                <span aria-current="page">Admin Login</span>
            </nav>
            <h1 class="page-hero-title reveal-up">Admin Login</h1>
            <p class="page-hero-sub reveal-up">Sign in to manage page content and media.</p>
        </div>
    </section>

    <section class="section" aria-label="Login Form">
        <div class="container admin-auth-wrap">
            <div class="contact-form-card reveal-up admin-auth-card" role="region" aria-label="Admin Sign In Form">
                @if ($errors->any())
                    <div class="form-success-banner form-error-banner" aria-live="polite">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        {{ $errors->first() }}
                    </div>
                @endif

                <h2 class="form-heading">Welcome Back</h2>

                <form action="{{ route('login.store') }}" method="POST" novalidate>
                    @csrf

                    <div class="form-group">
                        <label for="email" class="form-label">Email Address <span class="required" aria-label="required">*</span></label>
                        <input type="email" id="email" name="email" class="form-input" value="{{ old('email') }}" required autocomplete="email">
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Password <span class="required" aria-label="required">*</span></label>
                        <input type="password" id="password" name="password" class="form-input" required autocomplete="current-password">
                    </div>

                    <div class="form-group form-checkbox-group">
                        <label class="checkbox-label">
                            <input type="checkbox" name="remember" class="checkbox-input" value="1" {{ old('remember') ? 'checked' : '' }}>
                            <span class="checkbox-custom" aria-hidden="true"></span>
                            Keep me signed in on this device.
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary btn-full btn-lg">Sign In</button>
                </form>

                <p class="form-disclaimer">Authorized users only. All access is logged.</p>
            </div>
        </div>
    </section>

@endsection
