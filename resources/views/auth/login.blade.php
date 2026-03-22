<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Login — Sahayog CMS</title>
    <meta name="robots" content="noindex, nofollow">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="admin-auth-body">
    <main class="admin-auth-main">
        <section class="admin-auth-card" aria-label="Admin Login Form">
            <h1>Admin Login</h1>
            <p>Sign in to manage pages and gallery content.</p>

            @if($errors->any())
                <div class="admin-alert admin-alert-error" role="alert">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login.store') }}" method="POST" class="admin-form-stack" novalidate>
                @csrf

                <div class="admin-form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" class="admin-input" required autocomplete="email">
                </div>

                <div class="admin-form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" class="admin-input" required autocomplete="current-password">
                </div>

                <div class="admin-form-group admin-inline-check">
                    <input id="remember" type="checkbox" name="remember" value="1" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">Remember me</label>
                </div>

                <button type="submit" class="admin-btn admin-btn-primary admin-btn-block">Login</button>
            </form>
        </section>
    </main>
</body>
</html>
