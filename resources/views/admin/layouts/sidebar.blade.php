<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') – ResepBareng</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; display: flex; min-height: 100vh; background: #FDF5E6; }

        .sidebar {
            width: 200px; min-height: 100vh;
            background: #4A071D; color: #FDF5E6;
            display: flex; flex-direction: column;
            flex-shrink: 0;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }
        .sidebar-brand { padding: 24px 16px 20px; display: flex; align-items: center; gap: 8px; }
        .brand-logo { background: #7A0C2E; border-radius: 6px; padding: 4px 8px; font-size: 11px; font-weight: 700; color: white; }
        .brand-text { font-size: 14px; font-weight: 700; color: #FDF5E6; letter-spacing: 0.5px; }
        
        .sidebar-user {
            padding: 0 16px 24px;
            display: flex; flex-direction: column; align-items: center; gap: 6px;
            border-bottom: 1px solid rgba(253, 245, 230, 0.1);
        }
        .sidebar-avatar {
            width: 48px; height: 48px; background: rgba(253, 245, 230, 0.2);
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
        }
        .sidebar-avatar svg { width: 28px; fill: #FDF5E6; }
        .sidebar-role { font-size: 11px; color: #A98467; }
        .sidebar-name { font-size: 13px; font-weight: 600; color: #FDF5E6; }

        .sidebar nav { flex: 1; padding: 16px 0; }
        .sidebar nav a {
            display: flex; align-items: center; gap: 10px;
            padding: 12px 20px; color: rgba(253, 245, 230, 0.7); text-decoration: none;
            font-size: 13px; border-left: 4px solid transparent;
            transition: all 0.3s;
        }
        
        .sidebar nav a.active { 
            color: white; 
            background: rgba(169, 132, 103, 0.2); 
            border-left-color: #A98467; 
            font-weight: 600;
        }
        .sidebar nav a:hover { background: rgba(169, 132, 103, 0.1); color: white; }
        .sidebar nav .check { width: 12px; height: 12px; border: 1.5px solid rgba(253, 245, 230, 0.5); border-radius: 2px; }
        .sidebar nav .check.checked { background: #A98467; border-color: #A98467; }

        .sidebar-footer { padding: 16px 20px; border-top: 1px solid rgba(253, 245, 230, 0.1); }
        .btn-keluar {
            background: none; border: none; color: #e53e3e;
            font-size: 13px; cursor: pointer; font-weight: 600;
            transition: opacity 0.3s;
        }
        .btn-keluar:hover { opacity: 0.7; }

        .main { flex: 1; padding: 28px 32px; background: #FDF5E6; }

        .flash-success {
            background: #c6f6d5; color: #276749;
            padding: 10px 16px; border-radius: 6px; margin-bottom: 16px; font-size: 13px;
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-logo">RB</div>
            <span class="brand-text">ResepBareng</span>
        </div>
        <div class="sidebar-user">
            <div class="sidebar-avatar">
                <svg viewBox="0 0 24 24"><path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/></svg>
            </div>
            <div class="sidebar-name">{{ auth()->user()->name }}</div>
            <div class="sidebar-role">Login sebagai Admin</div>
        </div>
        <nav>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="check {{ request()->routeIs('admin.dashboard') ? 'checked' : '' }}"></span>
                Dashboard
            </a>
            <a href="{{ route('admin.resep.index') }}" class="{{ request()->routeIs('admin.resep.*') ? 'active' : '' }}">
                <span class="check {{ request()->routeIs('admin.resep.*') ? 'checked' : '' }}"></span>
                Kelola Resep
            </a>
            <a href="{{ route('admin.kategori.index') }}" class="{{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}">
                <span class="check {{ request()->routeIs('admin.kategori.*') ? 'checked' : '' }}"></span>
                Kelola Kategori
            </a>
            <a href="{{ route('admin.ulasan.index') }}" class="{{ request()->routeIs('admin.ulasan.*') ? 'active' : '' }}">
                <span class="check {{ request()->routeIs('admin.ulasan.*') ? 'checked' : '' }}"></span>
                Ulasan
            </a>
            @if(auth()->user()->isSuperAdmin())
            <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users') ? 'active' : '' }}">
                <span class="check {{ request()->routeIs('admin.users') ? 'checked' : '' }}"></span>
                Kelola User
            </a>
            @endif
        </nav>
        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-keluar">Keluar →</button>
            </form>
        </div>
    </div>
    <div class="main">
        @if(session('success'))
            <div class="flash-success">{{ session('success') }}</div>
        @endif
        @yield('content')
    </div>
    @stack('scripts')
</body>
</html>