<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Strong Base Academy</title>
    @include('partials.favicon')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg,#1e2a3a,#2d3e50);
            padding: 20px;
        }
        .login-card { max-width: 400px; width: 100%; margin: auto; border: none; border-radius: 14px; box-shadow: 0 10px 30px rgba(0,0,0,.25); }
    </style>
</head>
<body>
    <div class="card login-card p-4">
        <img src="{{ asset('favicon.svg') }}" alt="Strong Base Academy" width="52" height="52" style="border-radius:12px; display:block; margin:0 auto 14px;">
        <h4 class="text-center mb-1">Strong Base Academy</h4>
        <p class="text-center text-muted mb-4">Admin / Tutor Login</p>

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
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label" for="remember">Remember me</label>
            </div>
            <button type="submit" class="btn btn-dark w-100">Login</button>
        </form>
    </div>
</body>
</html>
