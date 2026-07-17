<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Tutor Panel')</title>
    @include('partials.favicon')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { background: #f4f6f9; }
        .card-stat { border: none; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,.06); }
        .tutor-navbar { display:flex; flex-wrap:wrap; align-items:center; gap:8px; }
        .tutor-navbar .nav-links { display:flex; flex-wrap:wrap; gap:6px; }
        @media (max-width:700px) {
            .tutor-navbar { flex-direction:column; align-items:stretch; }
            .tutor-navbar .nav-links { justify-content:flex-start; }
            .tutor-navbar .nav-links .btn { flex:1 1 auto; font-size:.8rem; padding:6px 8px; }
            .p-4 { padding:1rem !important; }
            table { font-size:.85rem; }
        }
    </style>
</head>
<body>
<nav class="navbar navbar-dark px-3 px-md-4 py-3 tutor-navbar" style="background:#1e2a3a;">
    <a class="navbar-brand mb-2 mb-md-0" href="{{ route('tutor.dashboard') }}"><img src="{{ asset('favicon.svg') }}" alt="Strong Base Academy" width="24" height="24" style="border-radius:6px; vertical-align:-5px; margin-right:6px;"> Strong Base Academy — Tutor</a>
    <div class="nav-links">
        <a href="{{ route('tutor.dashboard') }}" class="btn btn-sm btn-outline-light">Dashboard</a>
        <a href="{{ route('tutor.attendance.select') }}" class="btn btn-sm btn-outline-light">Mark Attendance</a>
        <a href="{{ route('tutor.attendance.history') }}" class="btn btn-sm btn-outline-light">History</a>
        <a href="{{ route('password.edit') }}" class="btn btn-sm btn-outline-light"><i class="fa-solid fa-lock"></i></a>
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
