<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - Strong Base Academy</title>
    @include('partials.favicon')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #06070C;
            font-family: 'Inter', sans-serif;
            color: #EDEEF3;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }
        .aurora-blob { position: fixed; border-radius: 50%; filter: blur(100px); opacity: .3; z-index: 0; }
        .b1 { width: 420px; height: 420px; background: #7C6CF6; top: -100px; left: -100px; }
        .b2 { width: 380px; height: 380px; background: #4CC9F0; bottom: -120px; right: -100px; }
        .login-card {
            max-width: 400px; width: 100%; position: relative; z-index: 2;
            background: rgba(255,255,255,.03); backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,.08); border-radius: 20px; padding: 36px;
        }
        h4, .btn-dark { font-family: 'Space Grotesk', sans-serif; }
        .form-label { color: #8B92A8; font-size: .85rem; }
        .form-control { background: rgba(255,255,255,.03); border: 1px solid rgba(255,255,255,.1); color: #EDEEF3; }
        .form-control:focus { background: rgba(124,108,246,.07); border-color: #7C6CF6; color: #EDEEF3; box-shadow: none; }
        .btn-dark { background: linear-gradient(135deg,#7C6CF6,#4CC9F0); border: none; color: #06070C; font-weight: 700; }
        .btn-dark:hover { opacity: .9; }
        .alert-danger { background: rgba(246,92,156,.1); border: 1px solid rgba(246,92,156,.3); color: #ffb3cf; border-radius: 10px; }
        .text-muted { color: #8B92A8 !important; }
        .form-check-input:checked { background-color: #7C6CF6; border-color: #7C6CF6; }
    </style>
</head>
<body>
    <div class="aurora-blob b1"></div>
    <div class="aurora-blob b2"></div>

    <div class="login-card">
        <img src="{{ asset('favicon.svg') }}" alt="Strong Base Academy" width="52" height="52" style="border-radius:12px; display:block; margin:0 auto 16px;">
        <h4 class="text-center mb-1">Strong Base Academy</h4>
        <p class="text-center text-muted mb-4">Sign in to your account</p>

        @if ($errors->any())
            <div class="alert alert-danger py-2">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label" for="remember">Remember me</label>
            </div>
            <button type="submit" class="btn btn-dark w-100 py-2">Sign In</button>
        </form>
    </div>
</body>
</html>
