<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FinanzasApp')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --verde: #0F6E56;
            --verde-claro: #1D9E75;
            --verde-menta: #9FE1CB;
            --bg: #f4f6f4;
            --borde: #D3D1C7;
            --texto: #1a1a18;
            --muted: #888780;
        }
        * { box-sizing: border-box; }
        body { background: var(--bg); font-family: 'Segoe UI', sans-serif; margin: 0; }

        /* SIDEBAR */
        .sidebar {
            background: var(--verde);
            min-height: 100vh;
            width: 220px;
            position: fixed;
            top: 0; left: 0;
            padding: 1.5rem 1rem;
            display: flex;
            flex-direction: column;
            z-index: 100;
        }
        .sidebar .logo {
            color: var(--verde-menta);
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .logo-icon {
            background: var(--verde-claro);
            color: white;
            padding: 4px 10px;
            border-radius: 8px;
            font-weight: 800;
        }
        .nav-link-side {
            color: var(--verde-menta);
            border-radius: 8px;
            padding: 10px 12px;
            display: flex;
            align-items: center;
            gap: 9px;
            font-size: 13.5px;
            text-decoration: none;
            transition: background .15s;
            margin-bottom: 2px;
        }
        .nav-link-side:hover,
        .nav-link-side.active {
            background: var(--verde-claro);
            color: #fff;
        }
        .nav-link-side .icon { font-size: 15px; width: 20px; text-align: center; }
        .sidebar-bottom { margin-top: auto; padding-top: 1rem; border-top: 1px solid rgba(159,225,203,.2); }
        .sidebar-user { font-size: 12px; color: var(--verde-menta); margin-bottom: 8px; }
        .sidebar-user strong { display: block; color: #fff; font-size: 13px; }
        .btn-logout {
            background: none;
            border: 1px solid rgba(159,225,203,.4);
            color: var(--verde-menta);
            border-radius: 7px;
            font-size: 12.5px;
            padding: 7px 12px;
            cursor: pointer;
            width: 100%;
            text-align: left;
            transition: background .15s;
        }
        .btn-logout:hover { background: rgba(255,255,255,.08); }

        /* ADMIN BADGE */
        .admin-badge {
            background: rgba(255,255,255,.15);
            color: #fff;
            font-size: 10px;
            letter-spacing: .06em;
            text-transform: uppercase;
            border-radius: 20px;
            padding: 2px 8px;
            margin-left: auto;
        }

        /* MAIN CONTENT */
        .main-content {
            margin-left: 220px;
            min-height: 100vh;
        }
        .topbar {
            background: #fff;
            border-bottom: 1px solid var(--borde);
            padding: 1rem 1.75rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .topbar h5 { margin: 0; font-size: 17px; color: var(--texto); font-weight: 600; }
        .topbar small { color: var(--muted); font-size: 12px; }
        .topbar .fecha-badge {
            font-size: 11.5px;
            color: var(--muted);
            border: 0.5px solid var(--borde);
            border-radius: 20px;
            padding: 4px 13px;
        }
        .page-body { padding: 1.75rem; }

        /* CARDS */
        .fin-card {
            background: #fff;
            border: 0.5px solid var(--borde);
            border-radius: 12px;
            padding: 1.25rem;
        }
        .fin-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.1rem;
        }
        .fin-card-title {
            font-size: 11px;
            font-weight: 600;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: .08em;
        }
        .btn-add {
            background: none;
            border: 0.5px solid var(--borde);
            border-radius: 8px;
            font-size: 12px;
            color: var(--muted);
            padding: 4px 11px;
            text-decoration: none;
            transition: background .15s, color .15s;
        }
        .btn-add:hover { background: var(--verde-claro); color: #fff; border-color: var(--verde-claro); }

        /* FORM */
        .fin-form-card {
            background: #fff;
            border: 0.5px solid var(--borde);
            border-radius: 14px;
            padding: 2rem;
            max-width: 520px;
        }
        .fin-form-card label {
            font-size: 12px;
            font-weight: 600;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: .06em;
            margin-bottom: 5px;
        }
        .fin-form-card .form-control,
        .fin-form-card .form-select {
            border: 0.5px solid var(--borde);
            border-radius: 8px;
            font-size: 14px;
            padding: 9px 12px;
            color: var(--texto);
        }
        .fin-form-card .form-control:focus,
        .fin-form-card .form-select:focus {
            border-color: var(--verde-claro);
            box-shadow: 0 0 0 3px rgba(29,158,117,.15);
        }
        .btn-guardar {
            background: var(--verde);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 10px 24px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background .15s;
        }
        .btn-guardar:hover { background: #085041; }
        .btn-cancelar {
            background: none;
            border: 0.5px solid var(--borde);
            border-radius: 8px;
            padding: 10px 18px;
            font-size: 14px;
            color: var(--muted);
            text-decoration: none;
            transition: background .15s;
        }
        .btn-cancelar:hover { background: #f4f6f4; }

        /* TABLE */
        .fin-table { width: 100%; border-collapse: collapse; }
        .fin-table th {
            font-size: 11px;
            font-weight: 600;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: .07em;
            padding: 8px 12px;
            border-bottom: 0.5px solid var(--borde);
            text-align: left;
        }
        .fin-table td {
            font-size: 13px;
            color: var(--texto);
            padding: 10px 12px;
            border-bottom: 0.5px solid #F1EFE8;
        }
        .fin-table tr:last-child td { border-bottom: none; }
        .fin-table tr:hover td { background: #fafaf8; }

        /* BADGES */
        .badge-verde { background: rgba(29,158,117,.12); color: var(--verde); border-radius: 20px; padding: 2px 10px; font-size: 11px; }
        .badge-rojo  { background: rgba(216,90,48,.10);  color: #D85A30; border-radius: 20px; padding: 2px 10px; font-size: 11px; }
        .badge-azul  { background: rgba(50,102,173,.10); color: #3266ad; border-radius: 20px; padding: 2px 10px; font-size: 11px; }
        .badge-naranja { background: rgba(186,117,23,.10); color: #BA7517; border-radius: 20px; padding: 2px 10px; font-size: 11px; }
        .badge-gris  { background: #F1EFE8; color: var(--muted); border-radius: 20px; padding: 2px 10px; font-size: 11px; }

        /* ACTIONS */
        .btn-accion {
            font-size: 12px;
            padding: 4px 10px;
            border-radius: 6px;
            border: 0.5px solid var(--borde);
            background: none;
            color: var(--muted);
            cursor: pointer;
            text-decoration: none;
            transition: all .15s;
            display: inline-block;
        }
        .btn-accion:hover { background: #f4f6f4; color: var(--texto); }
        .btn-accion.danger:hover { background: #fdf0ee; color: #D85A30; border-color: #D85A30; }

        /* ALERT */
        .fin-alert {
            background: #e6f4ef;
            border: 0.5px solid var(--verde-claro);
            border-radius: 10px;
            padding: 12px 16px;
            margin-bottom: 1.25rem;
            font-size: 13px;
            color: var(--verde);
        }
        .fin-alert-err {
            background: #fdf0ee;
            border: 0.5px solid #D85A30;
            border-radius: 10px;
            padding: 12px 16px;
            margin-bottom: 1.25rem;
            font-size: 13px;
            color: #D85A30;
        }

        /* EMPTY STATE */
        .empty-state {
            text-align: center;
            padding: 2rem;
            color: var(--muted);
            font-size: 13px;
        }
    </style>
</head>
<body>

{{-- SIDEBAR --}}
<div class="sidebar">
    <div class="logo">
        <span class="logo-icon">$</span>FinanzasApp
    </div>

    <nav>
        <a href="{{ route('dashboard') }}"
           class="nav-link-side {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <span class="icon">▦</span> Dashboard
        </a>

        @if(auth()->user()->isAdmin())
        <a href="{{ route('admin.index') }}"
           class="nav-link-side {{ request()->routeIs('admin.*') ? 'active' : '' }}">
            <span class="icon">👥</span> Usuarios
            <span class="admin-badge">Admin</span>
        </a>
        @endif

        <a href="{{ route('ingresos.index') }}"
           class="nav-link-side {{ request()->routeIs('ingresos.*') ? 'active' : '' }}">
            <span class="icon">↑</span> Ingresos
        </a>
        <a href="{{ route('gastos.index') }}"
           class="nav-link-side {{ request()->routeIs('gastos.*') ? 'active' : '' }}">
            <span class="icon">↓</span> Gastos
        </a>
        <a href="{{ route('presupuestos.index') }}"
           class="nav-link-side {{ request()->routeIs('presupuestos.*') ? 'active' : '' }}">
            <span class="icon">◎</span> Presupuestos
        </a>
        <a href="{{ route('ahorros.index') }}"
           class="nav-link-side {{ request()->routeIs('ahorros.*') ? 'active' : '' }}">
            <span class="icon">◇</span> Ahorros
        </a>
        <a href="{{ route('deudas.index') }}"
           class="nav-link-side {{ request()->routeIs('deudas.*') ? 'active' : '' }}">
            <span class="icon">⊖</span> Deudas
        </a>
    </nav>

    <div class="sidebar-bottom">
        <div class="sidebar-user">
            <strong>{{ auth()->user()->name }}</strong>
            {{ ucfirst(auth()->user()->rol) }}
            @if(auth()->user()->bloqueado)
                · <span style="color:#f87171;">Bloqueado</span>
            @endif
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">← Cerrar sesión</button>
        </form>
    </div>
</div>

{{-- MAIN --}}
<div class="main-content">
    <div class="topbar">
        <div>
            <h5>@yield('page-title', 'FinanzasApp')</h5>
            <small>@yield('page-subtitle', now()->locale('es')->isoFormat('MMMM YYYY'))</small>
        </div>
        <div style="display:flex; align-items:center; gap:8px;">
             @if(auth()->user()->isAdmin())
                <button style="background:#D85A30; color:white; border:none; border-radius:8px; padding:6px 14px; font-size:12px; cursor:pointer;">📄 PDF</button>
                <button style="background:#3266ad; color:white; border:none; border-radius:8px; padding:6px 14px; font-size:12px; cursor:pointer;">📊 Gráficos</button>
            @endif
    <div class="fecha-badge">{{ now()->locale('es')->isoFormat('D MMMM YYYY') }}</div> 

</div>
    </div>

    <div class="page-body">
        @if(session('success'))
            <div class="fin-alert">✓ {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="fin-alert-err">✗ {{ session('error') }}</div>
        @endif
        @if($errors->any())
            <div class="fin-alert-err">
                @foreach($errors->all() as $e) {{ $e }}<br> @endforeach
            </div>
        @endif

        @yield('content')
    </div>
</div>

</body>
</html>
