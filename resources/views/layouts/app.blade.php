<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Strong Base Academy')</title>
    @include('partials.favicon')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { background: #f4f6f9; }
        .sidebar {
            min-height: 100vh;
            background: #1e2a3a;
            color: #fff;
            width: 230px;
            flex-shrink: 0;
        }
        .sidebar a {
            color: #c7d0da;
            text-decoration: none;
            display: block;
            padding: 10px 18px;
            border-radius: 6px;
            margin: 3px 8px;
            transition: background .15s ease, color .15s ease;
        }
        .sidebar a i { width: 20px; text-align:center; margin-right:4px; }
        .sidebar a:hover, .sidebar a.active {
            background: #2d3e50;
            color: #fff;
        }
        .brand {
            font-weight: 700;
            padding: 18px;
            font-size: 1.15rem;
            border-bottom: 1px solid #2d3e50;
        }
        .card-stat {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,.06);
            transition: box-shadow .15s ease, transform .15s ease;
        }
        .card-stat:hover { box-shadow: 0 6px 16px rgba(0,0,0,.09); transform: translateY(-1px); }
        .table-hover tbody tr:hover { background-color: rgba(0,0,0,.02); }
        .badge { font-weight: 500; }

        /* ---------- Mobile Responsive ---------- */
        .sidebar-close-btn { display: none; }
        .mobile-toggle { display: none; }
        .sidebar-backdrop { display: none; }

        @media (max-width: 900px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                height: 100vh;
                z-index: 1050;
                transform: translateX(-100%);
                transition: transform .3s ease;
                overflow-y: auto;
            }
            .sidebar.open { transform: translateX(0); }
            .sidebar-close-btn {
                display: block;
                position: absolute;
                top: 14px;
                right: 14px;
                background: none;
                border: none;
                color: #fff;
                font-size: 1.3rem;
            }
            .mobile-toggle {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 38px; height: 38px;
                border: 1px solid #dee2e6;
                border-radius: 8px;
                background: #fff;
                margin-right: 10px;
            }
            .sidebar-backdrop {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0,0,0,.4);
                z-index: 1040;
            }
            .sidebar-backdrop.show { display: block; }
            .top-navbar { flex-wrap: wrap; gap: 8px; }
            .top-navbar .fw-semibold { font-size: .95rem; }
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
        <button class="sidebar-close-btn" id="sidebarClose"><i class="fa-solid fa-xmark"></i></button>
        <div class="brand"><img src="{{ asset('favicon.svg') }}" alt="Strong Base Academy" width="24" height="24" style="border-radius:6px; vertical-align:-5px; margin-right:6px;"> Strong Base Academy</div>
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
        <nav class="navbar navbar-light bg-white border-bottom px-3 px-md-4 top-navbar">
            <button class="mobile-toggle" id="mobileToggle"><i class="fa-solid fa-bars"></i></button>
            <span class="fw-semibold flex-grow-1">@yield('title', 'Dashboard')</span>
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button class="btn btn-sm btn-outline-danger">
                    <i class="fa-solid fa-right-from-bracket"></i> <span class="logout-text">Logout ({{ auth()->user()->name }})</span>
                </button>
            </form>
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
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const sidebar = document.getElementById('sidebar');
    const backdrop = document.getElementById('sidebarBackdrop');
    const openBtn = document.getElementById('mobileToggle');
    const closeBtn = document.getElementById('sidebarClose');

    function openSidebar() {
        sidebar.classList.add('open');
        backdrop.classList.add('show');
    }
    function closeSidebar() {
        sidebar.classList.remove('open');
        backdrop.classList.remove('show');
    }
    openBtn?.addEventListener('click', openSidebar);
    closeBtn?.addEventListener('click', closeSidebar);
    backdrop?.addEventListener('click', closeSidebar);
</script>
</body>
</html>
