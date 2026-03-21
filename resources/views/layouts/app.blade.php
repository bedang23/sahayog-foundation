<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    {{-- SEO Meta --}}
    <title>@yield('meta_title', 'Sahayog Foundation — Empowering Communities')</title>
    <meta name="description" content="@yield('meta_description', 'Sahayog Foundation is dedicated to uplifting underserved communities through education, health, and sustainable livelihoods.')">
    <meta name="keywords" content="@yield('meta_keywords', 'NGO, charity, donate, education, health, community, Sahayog Foundation')">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Sahayog Foundation">

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('og_title', 'Sahayog Foundation — Empowering Communities')">
    <meta property="og:description" content="@yield('og_description', 'Sahayog Foundation is dedicated to uplifting underserved communities through education, health, and sustainable livelihoods.')">
    <meta property="og:image" content="@yield('og_image', 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=1200')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="Sahayog Foundation">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('og_title', 'Sahayog Foundation')">
    <meta name="twitter:description" content="@yield('og_description', 'Empowering Communities Across India')">
    <meta name="twitter:image" content="@yield('og_image', 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=1200')">

    {{-- Canonical --}}
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    {{-- Favicon --}}
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🧡</text></svg>">

    {{-- Main CSS --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @stack('styles')
</head>
<body>

    @include('partials.header')

    <main id="main-content">
        @yield('content')
    </main>

    @include('partials.footer')

    {{-- Main JS --}}
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')

</body>
</html>
