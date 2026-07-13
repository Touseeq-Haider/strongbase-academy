<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Strong Base Academy')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { background: #f4f6f9; }
        .sidebar {
            min-height: 100vh;
            background: #1e2a3a;
            color: #fff;
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
    </style>
</head>
<body>
<div class="d-flex">
    <div class="sidebar" style="width:230px;">
        <div class="brand">🎓 Strong Base Academy</div>
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

    <div class="flex-grow-1">
        <nav class="navbar navbar-light bg-white border-bottom px-4">
            <span class="fw-semibold">@yield('title', 'Dashboard')</span>
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button class="btn btn-sm btn-outline-danger">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout ({{ auth()->user()->name }})
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
</body>
</html>
