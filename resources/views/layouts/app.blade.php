<!DOCTYPE html>
<?php use Illuminate\Support\Facades\DB; ?>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin Panel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --soft-primary: #cb0c9f;
            --soft-secondary: #839fab;
            --soft-success: #82c91e;
            --soft-info: #3b82f6;
            --soft-warning: #fbbf24;
            --soft-danger: #f36;
            --soft-light: #f0f2f5;
            --soft-dark: #1d1e22;
            --soft-white: #ffffff;
            --soft-gray: #67748e;
            --soft-gray-100: #f1f5f9;
            --soft-gray-200: #e2e8f0;
            --soft-gray-300: #cbd5e1;
            --soft-gray-400: #94a3b8;
            --soft-gray-500: #64748b;
            --soft-gray-600: #475569;
            --soft-gray-700: #334155;
            --soft-gray-800: #1e293b;
            --soft-gray-900: #0f172a;
            --soft-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --soft-gradient-primary: linear-gradient(135deg, #cb0c9f 0%, #764ba2 100%);
            --soft-shadow-light: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
            --soft-shadow: 0 0.875rem 1.25rem -0.25rem rgba(0, 0, 0, 0.1), 0 0.25rem 0.5rem -0.125rem rgba(0, 0, 0, 0.06);
            --soft-shadow-lg: 0 1rem 3rem rgba(0, 0, 0, 0.175);
            --soft-radius: 0.75rem;
            --soft-radius-lg: 1rem;
            --soft-radius-xl: 1.5rem;
        }
        * { box-sizing: border-box; }
        body { font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; background-color: #f0f2f5; color: #1e293b; font-size: 0.9rem; }
        .navbar { background: white; box-shadow: var(--soft-shadow-light); padding: 0.75rem 1.5rem; }
        .card { border: none; border-radius: var(--soft-radius-lg); box-shadow: var(--soft-shadow-light); transition: all 0.3s ease; }
        .card:hover { box-shadow: var(--soft-shadow); transform: translateY(-2px); }
        .btn { border-radius: 0.5rem; padding: 0.625rem 1.5rem; font-weight: 500; font-size: 0.875rem; transition: all 0.2s ease; }
        .btn-primary { background: var(--soft-gradient-primary); border: none; }
        .btn-primary:hover { background: linear-gradient(135deg, #a7086d 0%, #5c3479 100%); transform: translateY(-1px); box-shadow: 0 4px 12px rgba(203, 12, 159, 0.35); }
        .btn-danger { background: #ef4444; border: none; }
        .btn-success { background: #10b981; border: none; }
        .btn-info { background: #3b82f6; border: none; }
        .form-control, .form-select { border-radius: 0.5rem; border: 1px solid #e2e8f0; padding: 0.625rem 1rem; font-size: 0.875rem; transition: all 0.2s ease; }
        .form-control:focus, .form-select:focus { border-color: #cb0c9f; box-shadow: 0 0 0 3px rgba(203, 12, 159, 0.15); }
        .form-label { font-weight: 500; color: #475569; font-size: 0.8rem; margin-bottom: 0.5rem; text-transform: uppercase; letter-spacing: 0.5px; }
        .input-group-text { border-radius: 0.5rem; border: 1px solid #e2e8f0; background: #f8fafc; color: #64748b; }
        .table { border-radius: var(--soft-radius); overflow: hidden; }
        .table thead th { background: #f8fafc; border-bottom: 2px solid #e2e8f0; font-weight: 600; color: #475569; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.5px; padding: 1rem; }
        .table tbody tr { transition: all 0.2s ease; }
        .table tbody tr:hover { background: #f8fafc; }
        .table td { padding: 1rem; vertical-align: middle; border-bottom: 1px solid #f1f5f9; }
        .badge { padding: 0.5rem 0.75rem; font-weight: 500; border-radius: 0.375rem; font-size: 0.75rem; }
        .dropdown-menu { border-radius: var(--soft-radius); box-shadow: var(--soft-shadow-lg); border: none; padding: 0.5rem; }
        .dropdown-item { border-radius: 0.375rem; padding: 0.5rem 1rem; color: #475569; transition: all 0.2s ease; }
        .dropdown-item:hover { background: #f8fafc; color: #cb0c9f; }
        .sidebar { background: white; min-height: 100vh; box-shadow: var(--soft-shadow-light); }
        .sidebar .nav-link { color: #475569; padding: 0.75rem 1.5rem; border-radius: 0.5rem; margin: 0.25rem 0.75rem; transition: all 0.2s ease; }
        .sidebar .nav-link:hover { background: #f8fafc; color: #cb0c9f; }
        .sidebar .nav-link.active { background: var(--soft-gradient-primary); color: white; }
        .page-header { background: white; padding: 1.5rem; border-radius: var(--soft-radius-lg); box-shadow: var(--soft-shadow-light); margin-bottom: 1.5rem; }
        .card-stat { border-radius: var(--soft-radius-lg); overflow: hidden; }
        .card-stat .icon { width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; }
        .card-stat .icon.bg-primary { background: rgba(203, 12, 159, 0.1); color: #cb0c9f; }
        .card-stat .icon.bg-success { background: rgba(16, 185, 129, 0.1); color: #10b981; }
        .card-stat .icon.bg-info { background: rgba(59, 130, 246, 0.1); color: #3b82f6; }
        .card-stat .icon.bg-warning { background: rgba(251, 191, 36, 0.1); color: #fbbf24; }
        .auth-card { background: white; border-radius: var(--soft-radius-xl); box-shadow: var(--soft-shadow); padding: 2.5rem; max-width: 450px; margin: 0 auto; }
        .auth-header { text-align: center; margin-bottom: 2rem; }
        .auth-header .logo { width: 60px; height: 60px; border-radius: 50%; background: var(--soft-gradient-primary); display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; color: white; font-size: 1.5rem; }
        .auth-header h4 { color: #1e293b; font-weight: 600; }
        .auth-header p { color: #64748b; font-size: 0.875rem; }
        .text-gradient { background: var(--soft-gradient-primary); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .bg-gradient { background: var(--soft-gradient-primary); }
        .shadow-soft { box-shadow: var(--soft-shadow); }
        .rounded-soft { border-radius: var(--soft-radius); }
        .avatar { width: 40px; height: 40px; border-radius: 50%; background: var(--soft-gradient-primary); color: white; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 0.875rem; }
        .avatar-lg { width: 60px; height: 60px; font-size: 1.25rem; }
        .alert { border-radius: var(--soft-radius); border: none; padding: 1rem 1.25rem; }
        .pagination { gap: 0.25rem; }
        .page-link { border-radius: 0.375rem; color: #475569; border: none; padding: 0.5rem 0.875rem; }
        .page-link:hover { background: #f8fafc; color: #cb0c9f; }
        .page-item.active .page-link { background: var(--soft-gradient-primary); }
        .modal-content { border-radius: var(--soft-radius-xl); border: none; box-shadow: var(--soft-shadow-lg); }
        .modal-header { border-bottom: 1px solid #f1f5f9; padding: 1.25rem 1.5rem; }
        .modal-body { padding: 1.5rem; }
        .btn-close:focus { box-shadow: 0 0 0 3px rgba(203, 12, 159, 0.15); }
        a { color: #cb0c9f; text-decoration: none; transition: color 0.2s ease; }
        a:hover { color: #a7086d; }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="sidebar collapse d-lg-flex flex-column p-3" id="sidebarMenu">
            <a href="{{ route('dashboard') }}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-decoration-none">
                <i class="bi bi-hexagon fs-4 text-pink me-2"></i>
                <span class="fs-4 fw-bold">SoftUI</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto w-100">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2 me-2"></i>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <i class="bi bi-people me-2"></i>
                        Users
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('profile.edit') }}" class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                        <i class="bi bi-person-circle me-2"></i>
                        Profile
                    </a>
                </li>
            </ul>
            <hr>
            <div class="text-center text-muted small mt-2">
                <i class="bi bi-code-square me-1"></i>v{{ DB::table('app_versions')->latest()->first()?->version ?? '1.0.1.1' }}
            </div>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="avatar me-2">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <strong>{{ Auth::user()->name }}</strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">Sign out</button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="flex-grow-1">
            <!-- Top Navbar -->
            <nav class="navbar navbar-expand-lg sticky-top">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <span class="navbar-brand ms-2">{{ config('app.name') }}</span>
                    <div class="d-flex align-items-center ms-auto">
                        <div class="dropdown">
                            <a href="#" class="text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                                <div class="avatar">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main class="p-4">
                <div id="toastContainer" class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1100;"></div>
                @yield('content')
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>