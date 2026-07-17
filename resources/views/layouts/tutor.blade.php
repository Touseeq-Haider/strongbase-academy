<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Tutor Panel')</title>
    @include('partials.favicon')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root{
            --bg:#06070C; --panel-soft:rgba(255,255,255,.03); --border:rgba(255,255,255,.08); --border-soft:rgba(255,255,255,.05);
            --text:#EDEEF3; --muted:#8B92A8; --grad-1: linear-gradient(135deg,#7C6CF6,#4CC9F0);
        }
        body { background: var(--bg); color: var(--text); font-family:'Inter',sans-serif; }
        h1,h2,h3,h4,h5,h6 { font-family:'Space Grotesk',sans-serif; }
        .card, .card-stat { background: var(--panel-soft); border: 1px solid var(--border-soft); border-radius: 16px; color: var(--text); }
        .table { color: var(--text); }
        .table > :not(caption) > * > * { border-bottom-color: var(--border-soft); background-color: transparent; color: var(--text); }
        .table-hover tbody tr:hover { background-color: rgba(255,255,255,.03); }
        .btn-dark { background: var(--grad-1); border: none; color:#06070C; font-weight:600; }
        .btn-dark:hover { opacity:.9; color:#06070C; }
        .form-control, .form-select { background: rgba(255,255,255,.03); border: 1px solid var(--border); color: var(--text); }
        .form-control:focus, .form-select:focus { background: rgba(124,108,246,.06); border-color:#7C6CF6; color: var(--text); box-shadow:none; }
        .alert { border-radius: 12px; border: 1px solid var(--border-soft); }
        .alert-danger { background: rgba(246,92,156,.1); color: #ffb3cf; }
        .alert-success { background: rgba(76,201,240,.1); color: #9fe3f5; }
        .text-muted { color: var(--muted) !important; }

        .tutor-navbar { display:flex; flex-wrap:wrap; align-items:center; gap:8px; background:#090B12!important; border-bottom:1px solid var(--border-soft); }
        .tutor-navbar .nav-links { display:flex; flex-wrap:wrap; gap:6px; }
        .tutor-navbar .btn-outline-light { border-color: var(--border); color: var(--text); }
        .tutor-navbar .btn-outline-light:hover { background: rgba(255,255,255,.06); color: var(--text); }
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
<nav class="navbar px-3 px-md-4 py-3 tutor-navbar">
    <a class="navbar-brand mb-2 mb-md-0 d-flex align-items-center" href="{{ route('tutor.dashboard') }}">
        <img src="{{ asset('favicon.svg') }}" alt="Strong Base Academy" width="24" height="24" style="border-radius:6px; margin-right:8px;">
        Strong Base Academy — Tutor
    </a>
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
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@include('partials.sweetalert')
</body>
</html>
