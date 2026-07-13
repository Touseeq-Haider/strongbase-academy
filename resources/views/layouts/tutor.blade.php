<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Tutor Panel')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f4f6f9; }
        .card-stat { border: none; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,.06); }
    </style>
</head>
<body>
<nav class="navbar navbar-dark px-4" style="background:#1e2a3a;">
    <a class="navbar-brand" href="{{ route('tutor.dashboard') }}">🎓 Strong Base Academy — Tutor</a>
    <div>
        <a href="{{ route('tutor.dashboard') }}" class="btn btn-sm btn-outline-light me-1">Dashboard</a>
        <a href="{{ route('tutor.attendance.select') }}" class="btn btn-sm btn-outline-light me-1">Mark Attendance</a>
        <a href="{{ route('tutor.attendance.history') }}" class="btn btn-sm btn-outline-light me-1">History</a>
        <a href="{{ route('password.edit') }}" class="btn btn-sm btn-outline-light me-1"><i class="fa-solid fa-lock"></i></a>
        <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button class="btn btn-sm btn-outline-danger">Logout</button>
        </form>
    </div>
</nav>

<div class="p-4">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
