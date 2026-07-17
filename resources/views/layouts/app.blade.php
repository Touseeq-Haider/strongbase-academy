<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Strong Base Academy')</title>
    @include('partials.favicon')
    <script>
        // Applied before paint to avoid a light/dark flash on load
        (function () {
            const saved = localStorage.getItem('sba-theme') || 'dark';
            document.documentElement.setAttribute('data-theme', saved);
        })();
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&family=IBM+Plex+Mono:wght@500;600&display=swap" rel="stylesheet">
    <style>
        :root, html[data-theme="dark"] {
            --bg:#06070C; --sidebar-bg:#090B12; --topbar-bg:rgba(6,7,12,.7);
            --panel:#0F1420; --panel-soft:rgba(255,255,255,.03);
            --border:rgba(255,255,255,.08); --border-soft:rgba(255,255,255,.05);
            --text:#EDEEF3; --muted:#8B92A8; --input-bg:rgba(255,255,255,.03);
            --hover-bg:rgba(255,255,255,.04); --placeholder:#5C6480;
            --violet:#7C6CF6; --cyan:#4CC9F0; --amber:#F0B429; --pink:#F65C9C;
            --grad-1: linear-gradient(135deg,var(--violet),var(--cyan));
            --btn-text: #06070C;
        }
        html[data-theme="light"] {
            --bg:#F5F6FA; --sidebar-bg:#FFFFFF; --topbar-bg:rgba(255,255,255,.85);
            --panel:#FFFFFF; --panel-soft:#FFFFFF;
            --border:rgba(15,20,32,.12); --border-soft:rgba(15,20,32,.08);
            --text:#12141C; --muted:#5B6172; --input-bg:#FFFFFF;
            --hover-bg:rgba(15,20,32,.04); --placeholder:#9AA0B4;
            --violet:#6C5CE7; --cyan:#0EA5C4; --amber:#D98E00; --pink:#E0447E;
            --grad-1: linear-gradient(135deg,var(--violet),var(--cyan));
            --btn-text: #ffffff;
        }
        body { background: var(--bg); color: var(--text); font-family:'Inter',sans-serif; transition: background .25s ease, color .25s ease; }
        h1,h2,h3,h4,h5,h6 { font-family:'Space Grotesk',sans-serif; }
        a { color: inherit; }

        .sidebar {
            min-height: 100vh;
            background: var(--sidebar-bg);
            border-right: 1px solid var(--border-soft);
            width: 240px;
            flex-shrink: 0;
            transition: background .25s ease;
        }
        .sidebar a {
            color: var(--muted);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 18px;
            border-radius: 10px;
            margin: 3px 10px;
            font-size: .9rem;
            font-weight: 500;
            transition: background .15s ease, color .15s ease;
        }
        .sidebar a i { width: 18px; text-align:center; }
        .sidebar a:hover { background: var(--hover-bg); color: var(--text); }
        .sidebar a.active { background: rgba(124,108,246,.12); color: var(--violet); box-shadow: inset 2px 0 0 var(--violet); }
        html[data-theme="dark"] .sidebar a.active { color: #fff; }
        .brand {
            font-family:'Space Grotesk',sans-serif;
            font-weight: 700;
            padding: 20px 18px;
            font-size: 1.05rem;
            border-bottom: 1px solid var(--border-soft);
            display: flex;
            align-items: center;
        }

        .top-navbar { background: var(--topbar-bg)!important; backdrop-filter: blur(14px); border-bottom: 1px solid var(--border-soft)!important; transition: background .25s ease; }
        .top-navbar .fw-semibold { color: var(--text); }

        .theme-toggle {
            width: 38px; height: 38px; border-radius: 10px; border: 1px solid var(--border);
            background: transparent; color: var(--text); display:inline-flex; align-items:center; justify-content:center;
            cursor: pointer; transition: background .2s ease;
        }
        .theme-toggle:hover { background: var(--hover-bg); }

        .card, .card-stat {
            background: var(--panel-soft);
            border: 1px solid var(--border-soft);
            border-radius: 16px;
            color: var(--text);
            transition: box-shadow .2s ease, transform .2s ease, border-color .2s ease, background .25s ease;
        }
        .card-stat:hover { border-color: rgba(124,108,246,.35); transform: translateY(-2px); }

        .table { color: var(--text); --bs-table-color: var(--text); }
        .table-hover tbody tr:hover { background-color: var(--hover-bg); }
        .table > :not(caption) > * > * { border-bottom-color: var(--border-soft); background-color: transparent; color: var(--text); }
        thead.table-light, .table thead { color: var(--muted); }

        .form-control, .form-select {
            background: var(--input-bg);
            border: 1px solid var(--border);
            color: var(--text);
        }
        .form-control:focus, .form-select:focus {
            background: rgba(124,108,246,.06);
            border-color: var(--violet);
            color: var(--text);
            box-shadow: none;
        }
        .form-control::placeholder { color: var(--placeholder); }
        .form-label { color: var(--muted); font-size: .85rem; }

        .btn-dark { background: var(--grad-1); border: none; color: var(--btn-text); font-weight:600; }
        .btn-dark:hover { opacity: .9; color: var(--btn-text); }
        .btn-outline-dark { border-color: var(--border); color: var(--text); }
        .btn-outline-dark:hover { background: var(--hover-bg); color: var(--text); border-color: var(--border); }
        .btn-outline-primary, .btn-outline-success, .btn-outline-danger, .btn-outline-secondary { border-width: 1px; }

        .badge { font-weight: 500; }
        .text-muted { color: var(--muted) !important; }
        .alert { border-radius: 12px; border: 1px solid var(--border-soft); }
        .alert-danger { background: rgba(246,92,156,.1); color: #d63e7f; }
        html[data-theme="dark"] .alert-danger { color: #ffb3cf; }
        .alert-success { background: rgba(76,201,240,.1); color: #0b7c99; }
        html[data-theme="dark"] .alert-success { color: #9fe3f5; }

        .mobile-toggle { display: none; }
        .sidebar-backdrop { display: none; }

        @media (max-width: 900px) {
            .sidebar {
                position: fixed; top: 0; left: 0; height: 100vh; z-index: 1050;
                transform: translateX(-100%); transition: transform .3s ease; overflow-y: auto;
            }
            .sidebar.open { transform: translateX(0); }
            .mobile-toggle {
                display: inline-flex; align-items: center; justify-content: center;
                width: 38px; height: 38px; border: 1px solid var(--border); border-radius: 8px;
                background: transparent; color: var(--text); margin-right: 10px;
            }
            .sidebar-backdrop { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.6); z-index: 1040; }
            .sidebar-backdrop.show { display: block; }
            .top-navbar { flex-wrap: wrap; gap: 8px; }
            .top-navbar form button span.logout-text { display: none; }
            .p-4 { padding: 1rem !important; }
            table { font-size: .85rem; }
        }
    </style>
</head>
<body>
<div class="d-flex">
    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>
    <div class="sidebar" id="sidebar">
        <div class="brand">
            <img src="{{ asset('favicon.svg') }}" alt="Strong Base Academy" width="26" height="26" style="border-radius:7px; margin-right:8px;">
            Strong Base
        </div>
        <nav class="mt-2">
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-gauge"></i> Dashboard
            </a>
            <a href="{{ route('admin.students.index') }}" class="{{ request()->routeIs('admin.students.*') ? 'active' : '' }}">
                <i class="fa-solid fa-user-graduate"></i> Students
            </a>
            <a href="{{ route('admin.tutors.index') }}" class="{{ request()->routeIs('admin.tutors.*') ? 'active' : '' }}">
                <i class="fa-solid fa-chalkboard-user"></i> Tutors
            </a>
            <a href="{{ route('admin.fees.index') }}" class="{{ request()->routeIs('admin.fees.*') ? 'active' : '' }}">
                <i class="fa-solid fa-money-bill"></i> Fees
            </a>
            <a href="{{ route('admin.inquiries.index') }}" class="{{ request()->routeIs('admin.inquiries.*') ? 'active' : '' }}">
                <i class="fa-solid fa-envelope"></i> Inquiries
            </a>
            <a href="{{ route('password.edit') }}" class="{{ request()->routeIs('password.*') ? 'active' : '' }}">
                <i class="fa-solid fa-lock"></i> Change Password
            </a>
        </nav>
    </div>

    <div class="flex-grow-1" style="min-width:0;">
        <nav class="navbar top-navbar px-3 px-md-4 sticky-top">
            <button class="mobile-toggle" id="mobileToggle"><i class="fa-solid fa-bars"></i></button>
            <span class="fw-semibold flex-grow-1">@yield('title', 'Dashboard')</span>
            <button class="theme-toggle me-2" id="themeToggle" title="Toggle light/dark mode">
                <i class="fa-solid fa-moon" id="themeIcon"></i>
            </button>
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button class="btn btn-sm btn-outline-danger">
                    <i class="fa-solid fa-right-from-bracket"></i> <span class="logout-text">Logout ({{ auth()->user()->name }})</span>
                </button>
            </form>
        </nav>

        <div class="p-4">
            @yield('content')
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@include('partials.sweetalert')
<script>
    const sidebar = document.getElementById('sidebar');
    const backdrop = document.getElementById('sidebarBackdrop');
    const openBtn = document.getElementById('mobileToggle');

    function openSidebar() { sidebar.classList.add('open'); backdrop.classList.add('show'); }
    function closeSidebar() { sidebar.classList.remove('open'); backdrop.classList.remove('show'); }
    openBtn?.addEventListener('click', openSidebar);
    backdrop?.addEventListener('click', closeSidebar);

    // Theme toggle
    const themeToggle = document.getElementById('themeToggle');
    const themeIcon = document.getElementById('themeIcon');

    function updateIcon() {
        const current = document.documentElement.getAttribute('data-theme');
        themeIcon.className = current === 'dark' ? 'fa-solid fa-moon' : 'fa-solid fa-sun';
    }
    updateIcon();

    themeToggle.addEventListener('click', () => {
        const current = document.documentElement.getAttribute('data-theme');
        const next = current === 'dark' ? 'light' : 'dark';
        document.documentElement.setAttribute('data-theme', next);
        localStorage.setItem('sba-theme', next);
        updateIcon();
    });
</script>
</body>
</html>
