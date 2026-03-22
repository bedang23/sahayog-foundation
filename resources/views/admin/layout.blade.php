<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>@yield('admin_title', 'Admin') — Sahayog CMS</title>
    <meta name="robots" content="noindex, nofollow">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @stack('styles')
</head>
<body class="admin-body">

    <div class="admin-shell">
        @include('admin.components.sidebar')

        <div class="admin-main">
            @include('admin.components.topbar')

            <main class="admin-content">
                @if(session('status'))
                    <div class="admin-alert admin-alert-success" role="status" aria-live="polite">
                        {{ session('status') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="admin-alert admin-alert-error" role="alert">
                        {{ $errors->first() }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script src="{{ asset('js/admin.js') }}"></script>
    @stack('scripts')
</body>
</html>
