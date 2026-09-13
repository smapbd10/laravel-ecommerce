<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name') }} - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #FF6B6B;
            --secondary-color: #4ECDC4;
            --accent-color: #FFE66D;
            --dark-bg: #1a1a1a;
            --light-bg: #f8f9fa;
            --border-color: #e0e0e0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-bg);
            color: #333;
        }

        .admin-wrapper {
            display: flex;
            height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background: linear-gradient(135deg, var(--primary-color) 0%, #ff5252 100%);
            color: white;
            overflow-y: auto;
            position: fixed;
            height: 100vh;
            z-index: 1000;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }

        .sidebar .logo {
            padding: 25px 20px;
            text-align: center;
            border-bottom: 2px solid rgba(255,255,255,0.1);
            font-size: 24px;
            font-weight: bold;
        }

        .sidebar .logo img {
            max-width: 100%;
            height: auto;
        }

        .sidebar-menu {
            list-style: none;
            padding: 20px 0;
        }

        .sidebar-menu li {
            margin: 0;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 15px 25px;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background-color: rgba(255,255,255,0.1);
            color: white;
            border-left-color: white;
        }

        .sidebar-menu i {
            margin-right: 15px;
            width: 20px;
        }

        .sidebar-submenu {
            list-style: none;
            padding-left: 50px;
            display: none;
        }

        .sidebar-submenu.show {
            display: block;
        }

        .sidebar-submenu a {
            padding: 10px 25px;
            font-size: 14px;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 250px;
            overflow-y: auto;
            background-color: var(--light-bg);
        }

        /* Top Bar */
        .topbar {
            background: white;
            padding: 20px 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .topbar-title {
            font-size: 22px;
            font-weight: 600;
            color: #333;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .topbar-right .btn-icon {
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            color: #666;
            transition: color 0.3s ease;
        }

        .topbar-right .btn-icon:hover {
            color: var(--primary-color);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        /* Content Area */
        .content {
            padding: 30px;
        }

        /* Breadcrumb */
        .breadcrumb {
            background-color: transparent;
            padding: 0 0 20px 0;
            margin-bottom: 20px;
        }

        .breadcrumb-item.active {
            color: #666;
        }

        /* Cards */
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        .card-header {
            background-color: var(--light-bg);
            border-bottom: 1px solid var(--border-color);
            font-weight: 600;
            color: #333;
        }

        /* Stats Cards */
        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            text-align: center;
            margin-bottom: 20px;
            border-top: 4px solid var(--primary-color);
        }

        .stat-card.secondary {
            border-top-color: var(--secondary-color);
        }

        .stat-card.accent {
            border-top-color: var(--accent-color);
        }

        .stat-card-icon {
            font-size: 32px;
            margin-bottom: 15px;
            color: var(--primary-color);
        }

        .stat-card.secondary .stat-card-icon {
            color: var(--secondary-color);
        }

        .stat-card-value {
            font-size: 28px;
            font-weight: bold;
            color: #333;
            margin: 10px 0;
        }

        .stat-card-label {
            color: #999;
            font-size: 14px;
        }

        /* Buttons */
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: #ff5252;
            border-color: #ff5252;
        }

        .btn-secondary {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        .btn-secondary:hover {
            background-color: #45b7aa;
            border-color: #45b7aa;
        }

        /* Tables */
        .table-responsive {
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background-color: var(--light-bg);
            border-bottom: 2px solid var(--border-color);
            font-weight: 600;
            color: #333;
            padding: 15px;
        }

        .table tbody td {
            padding: 15px;
            border-color: var(--border-color);
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background-color: #fafafa;
        }

        /* Alerts */
        .alert {
            border: none;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        .alert-warning {
            background-color: #fff3cd;
            color: #856404;
        }

        /* Forms */
        .form-control,
        .form-select {
            border: 1px solid var(--border-color);
            border-radius: 5px;
            padding: 10px 15px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(255, 107, 107, 0.25);
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 8px;
            color: #333;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                width: 200px;
                transition: transform 0.3s ease;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .content {
                padding: 20px;
            }

            .topbar {
                padding: 15px 20px;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo">
                <i class="fas fa-store"></i>
                <div style="font-size: 16px; margin-top: 10px;">Gadget50</div>
            </div>
            <ul class="sidebar-menu">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-chart-line"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="toggleSubmenu(this)">
                        <i class="fas fa-box"></i>
                        <span>Products</span>
                        <i class="fas fa-chevron-down" style="margin-left: auto; font-size: 12px;"></i>
                    </a>
                    <ul class="sidebar-submenu {{ request()->routeIs('admin.products*', 'admin.categories*') ? 'show' : '' }}">
                        <li><a href="{{ route('admin.products.index') }}">All Products</a></li>
                        <li><a href="{{ route('admin.products.create') }}">Add Product</a></li>
                        <li><a href="{{ route('admin.categories.index') }}">Categories</a></li>
                        <li><a href="{{ route('admin.brands.index') }}">Brands</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders*') ? 'active' : '' }}">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Orders</span>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="toggleSubmenu(this)">
                        <i class="fas fa-users"></i>
                        <span>Users</span>
                        <i class="fas fa-chevron-down" style="margin-left: auto; font-size: 12px;"></i>
                    </a>
                    <ul class="sidebar-submenu {{ request()->routeIs('admin.users*', 'admin.roles*') ? 'show' : '' }}">
                        <li><a href="{{ route('admin.users.index') }}">Admin Users</a></li>
                        <li><a href="{{ route('admin.roles.index') }}">Roles</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" onclick="toggleSubmenu(this)">
                        <i class="fas fa-cog"></i>
                        <span>Settings</span>
                        <i class="fas fa-chevron-down" style="margin-left: auto; font-size: 12px;"></i>
                    </a>
                    <ul class="sidebar-submenu {{ request()->routeIs('admin.settings*') ? 'show' : '' }}">
                        <li><a href="{{ route('admin.settings.general') }}">General</a></li>
                        <li><a href="{{ route('admin.settings.branding') }}">Branding</a></li>
                        <li><a href="{{ route('admin.settings.theme') }}">Theme</a></li>
                        <li><a href="{{ route('admin.settings.header') }}">Header</a></li>
                        <li><a href="{{ route('admin.settings.footer') }}">Footer</a></li>
                    </ul>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Top Bar -->
            <div class="topbar">
                <div class="topbar-left">
                    <button class="btn-icon" onclick="toggleSidebar()">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 class="topbar-title">{{ $title ?? 'Dashboard' }}</h1>
                </div>
                <div class="topbar-right">
                    <button class="btn-icon">
                        <i class="fas fa-bell"></i>
                    </button>
                    <button class="btn-icon">
                        <i class="fas fa-envelope"></i>
                    </button>
                    <div class="user-profile">
                        <div class="user-avatar">{{ substr(auth()->user()->name, 0, 1) }}</div>
                        <span>{{ auth()->user()->name }}</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="content">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Oops!</strong> Please fix the following errors:
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('show');
        }

        function toggleSubmenu(element) {
            event.preventDefault();
            const submenu = element.nextElementSibling;
            submenu.classList.toggle('show');
        }
    </script>
    @stack('scripts')
</body>
</html>
