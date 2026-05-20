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
              <button onclick="generarPDF()" style="background:#D85A30; color:white; border:none; border-radius:8px; padding:6px 14px; font-size:12px; cursor:pointer;">📄 PDF</button>
                <button onclick="mostrarGraficos()" style="background:#3266ad; color:white; border:none; border-radius:8px; padding:6px 14px; font-size:12px; cursor:pointer;">📊 Gráficos</button>
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
{{-- Modal Gráficos Admin --}}
<div id="modalGraficos" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:9999; justify-content:center; align-items:center;">
    <div style="background:white; border-radius:12px; padding:2rem; width:90%; max-width:900px; max-height:85vh; overflow-y:auto;">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem;">
            <h5 style="margin:0; color:#0F6E56;">📊 Gráficos de Finanzas</h5>
            <button onclick="cerrarGraficos()" style="background:none; border:none; font-size:20px; cursor:pointer;">✕</button>
        </div>

        {{-- Gráficas 1 --}}
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:1.5rem;">
            <div>
                <h6 style="text-align:center; color:#888780; font-size:11px; text-transform:uppercase; letter-spacing:.08em; margin-bottom:1rem;">Gastos vs Ingresos</h6>
                <div id="chartBarras" style="height:300px;"></div>
            </div>
            <div>
                <h6 style="text-align:center; color:#888780; font-size:11px; text-transform:uppercase; letter-spacing:.08em; margin-bottom:1rem;">Distribución General</h6>
                <div id="chartPie" style="height:300px;"></div>
            </div>
        </div>

        {{-- Gráficas 2--}}
        <hr style="border:none; border-top:1px solid #D3D1C7; margin:1.5rem 0;">

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:1.5rem;">
            <div>
                <p style="text-align:center; font-size:11px; color:#888780; text-transform:uppercase; letter-spacing:.08em; margin-bottom:.5rem;">Gastos por tipo</p>
                <div id="legend-tipo-modal" style="display:flex; flex-wrap:wrap; gap:6px; margin-bottom:10px; font-size:12px; justify-content:center;"></div>
                <div style="position:relative; height:220px;">
                    <canvas id="chartTipoModal"></canvas>
                </div>
            </div>
            <div>
                <p style="text-align:center; font-size:11px; color:#888780; text-transform:uppercase; letter-spacing:.08em; margin-bottom:.5rem;">Ingresos vs Deudas — tendencia mensual</p>
                <div style="display:flex; gap:12px; margin-bottom:10px; font-size:12px; color:#888780; justify-content:center;">
                     <span><span style="display:inline-block;width:10px;height:10px;background:#1D9E75;margin-right:4px;vertical-align:middle;"></span>Ingresos</span>
                     <span><span style="display:inline-block;width:10px;height:10px;background:#D85A30;margin-right:4px;vertical-align:middle;"></span>Deudas</span>
                    </div>
                <div style="position:relative; height:220px;">
                    <canvas id="chartMesModal"></canvas>
                </div>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
google.charts.load('current', {'packages':['corechart', 'bar']});

function mostrarGraficos() {
    document.getElementById('modalGraficos').style.display = 'flex';
    google.charts.setOnLoadCallback(dibujarGraficos);
    dibujarGraficosNuevos(); // <-- agrega esta línea
}

function cerrarGraficos() {
    document.getElementById('modalGraficos').style.display = 'none';
}

function dibujarGraficos() {
    const totalGastos   = {{ \App\Models\Gasto::sum('monto') ?? 0 }};
    const totalIngresos = {{ \App\Models\Ingreso::sum('monto') ?? 0 }};
    const totalAhorros  = {{ \App\Models\Ahorro::sum('monto_actual') ?? 0 }};
    const totalDeudas   = {{ \App\Models\Deuda::sum('monto_total') ?? 0 }};

    // Gráfico de barras
    const dataBarras = new google.visualization.DataTable();
    dataBarras.addColumn('string', 'Categoría');
    dataBarras.addColumn('number', 'Monto');
    dataBarras.addColumn({type:'string', role:'style'});
    dataBarras.addRows([
        ['Gastos',   totalGastos,   'color:#D85A30'],
        ['Ingresos', totalIngresos, 'color:#1D9E75'],
        ['Ahorros',  totalAhorros,  'color:#3266ad'],
        ['Deudas',   totalDeudas,   'color:#BA7517'],
    ]);

    const optsBarras = {
        legend: { position: 'none' },
        backgroundColor: 'transparent',
        chartArea: { width:'80%', height:'75%' },
        vAxis: { format: '$#,##0' },
        bar: { groupWidth: '55%' },
        animation: { startup: true, duration: 800, easing: 'out' }
    };

    const barChart = new google.visualization.ColumnChart(document.getElementById('chartBarras'));
    barChart.draw(dataBarras, optsBarras);

    // Gráfico de pie
    const dataPie = new google.visualization.DataTable();
    dataPie.addColumn('string', 'Categoría');
    dataPie.addColumn('number', 'Monto');
    dataPie.addRows([
        ['Gastos',   totalGastos],
        ['Ingresos', totalIngresos],
        ['Ahorros',  totalAhorros],
        ['Deudas',   totalDeudas],
    ]);

    const optsPie = {
        pieHole: 0.5,
        colors: ['#D85A30', '#1D9E75', '#3266ad', '#BA7517'],
        backgroundColor: 'transparent',
        chartArea: { width:'85%', height:'80%' },
        legend: { position: 'bottom', textStyle: { fontSize: 11 } },
        animation: { startup: true, duration: 800, easing: 'out' }
    };

    const pieChart = new google.visualization.PieChart(document.getElementById('chartPie'));
    pieChart.draw(dataPie, optsPie);
}
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
@php
    $anioActual = now()->year;

    $gpt = \App\Models\Gasto::selectRaw('tipo, SUM(monto) as total')
        ->groupBy('tipo')
        ->pluck('total', 'tipo');

    $ingresosPorMes = array_fill(0, 12, 0);
    \App\Models\Ingreso::whereYear('fecha', $anioActual)
        ->selectRaw('MONTH(fecha) as mes, SUM(monto) as total')
        ->groupBy('mes')
        ->get()
        ->each(fn($r) => $ingresosPorMes[$r->mes - 1] = (float) $r->total);

    $deudasPorMes = array_fill(0, 12, 0);
    \App\Models\Deuda::whereYear('created_at', $anioActual)
        ->selectRaw('MONTH(created_at) as mes, SUM(monto_total) as total')
        ->groupBy('mes')
        ->get()
        ->each(fn($r) => $deudasPorMes[$r->mes - 1] = (float) $r->total);
@endphp


<script>
const gastosPorTipo     = @json($gpt);
const ingresosPorMes = @json($ingresosPorMes);
const deudasPorMes   = @json($deudasPorMes);

const COLORES = {
    comida:          { bg: 'rgba(216,90,48,.7)',   border: '#D85A30' },
    transporte:      { bg: 'rgba(50,102,173,.7)',  border: '#3266ad' },
    entretenimiento: { bg: 'rgba(186,117,23,.7)',  border: '#BA7517' },
    salud:           { bg: 'rgba(29,158,117,.7)',  border: '#1D9E75' },
    otro:            { bg: 'rgba(136,135,128,.7)', border: '#888780' },
};

const MESES = ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];

let instTipo = null;
let instMes  = null;

function dibujarGraficosNuevos() {
    if (instTipo) { instTipo.destroy(); instTipo = null; }
    if (instMes)  { instMes.destroy();  instMes  = null; }

    const keys   = Object.keys(gastosPorTipo);
    const labels = keys.map(k => k.charAt(0).toUpperCase() + k.slice(1));
    const valores = keys.map(k => gastosPorTipo[k]);
    const bgs    = keys.map(k => (COLORES[k] || { bg: '#ccc' }).bg);
    const borders= keys.map(k => (COLORES[k] || { border: '#999' }).border);

    document.getElementById('legend-tipo-modal').innerHTML = keys.map((k, i) =>
        `<span style="display:inline-flex;align-items:center;gap:4px;">
            <span style="width:10px;height:10px;border-radius:50%;background:${bgs[i]};display:inline-block;"></span>
            ${labels[i]}
        </span>`
    ).join('');

    instTipo = new Chart(document.getElementById('chartTipoModal'), {
        type: 'doughnut',
        data: {
            labels,
            datasets: [{ data: valores, backgroundColor: bgs, borderColor: borders, borderWidth: 1.5 }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '60%',
            plugins: {
                legend: { display: false },
                tooltip: { callbacks: { label: c => ' $' + Number(c.parsed).toLocaleString('es-MX', { minimumFractionDigits: 2 }) } }
            }
        }
    });

   instMes = new Chart(document.getElementById('chartMesModal'), {
    type: 'line',
    data: {
        labels: MESES,
        datasets: [
            {
                label: 'Ingresos',
                data: [
                    {{ \App\Models\Ingreso::whereYear('fecha', now()->year)->whereMonth('fecha', 1)->sum('monto') }},
                    {{ \App\Models\Ingreso::whereYear('fecha', now()->year)->whereMonth('fecha', 2)->sum('monto') }},
                    {{ \App\Models\Ingreso::whereYear('fecha', now()->year)->whereMonth('fecha', 3)->sum('monto') }},
                    {{ \App\Models\Ingreso::whereYear('fecha', now()->year)->whereMonth('fecha', 4)->sum('monto') }},
                    {{ \App\Models\Ingreso::whereYear('fecha', now()->year)->whereMonth('fecha', 5)->sum('monto') }},
                    {{ \App\Models\Ingreso::whereYear('fecha', now()->year)->whereMonth('fecha', 6)->sum('monto') }},
                    {{ \App\Models\Ingreso::whereYear('fecha', now()->year)->whereMonth('fecha', 7)->sum('monto') }},
                    {{ \App\Models\Ingreso::whereYear('fecha', now()->year)->whereMonth('fecha', 8)->sum('monto') }},
                    {{ \App\Models\Ingreso::whereYear('fecha', now()->year)->whereMonth('fecha', 9)->sum('monto') }},
                    {{ \App\Models\Ingreso::whereYear('fecha', now()->year)->whereMonth('fecha', 10)->sum('monto') }},
                    {{ \App\Models\Ingreso::whereYear('fecha', now()->year)->whereMonth('fecha', 11)->sum('monto') }},
                    {{ \App\Models\Ingreso::whereYear('fecha', now()->year)->whereMonth('fecha', 12)->sum('monto') }}
                ],
                borderColor: '#1D9E75',
                backgroundColor: 'rgba(29,158,117,.1)',
                borderWidth: 2,
                pointRadius: 4,
                pointBackgroundColor: '#1D9E75',
                fill: true,
                tension: 0.4,
            },
            {
                label: 'Deudas',
                 data: [ 
                    {{ \App\Models\Deuda::whereYear('created_at', now()->year)->whereMonth('created_at', 1)->sum('monto_total') }},
                    {{ \App\Models\Deuda::whereYear('created_at', now()->year)->whereMonth('created_at', 2)->sum('monto_total') }},
                    {{ \App\Models\Deuda::whereYear('created_at', now()->year)->whereMonth('created_at', 3)->sum('monto_total') }},
                     {{ \App\Models\Deuda::whereYear('created_at', now()->year)->whereMonth('created_at', 4)->sum('monto_total') }},
                     {{ \App\Models\Deuda::whereYear('created_at', now()->year)->whereMonth('created_at', 5)->sum('monto_total') }},
                     {{ \App\Models\Deuda::whereYear('created_at', now()->year)->whereMonth('created_at', 6)->sum('monto_total') }},
                     {{ \App\Models\Deuda::whereYear('created_at', now()->year)->whereMonth('created_at', 7)->sum('monto_total') }},
                     {{ \App\Models\Deuda::whereYear('created_at', now()->year)->whereMonth('created_at', 8)->sum('monto_total') }},
                     {{ \App\Models\Deuda::whereYear('created_at', now()->year)->whereMonth('created_at', 9)->sum('monto_total') }},
                     {{ \App\Models\Deuda::whereYear('created_at', now()->year)->whereMonth('created_at', 10)->sum('monto_total') }},
                     {{ \App\Models\Deuda::whereYear('created_at', now()->year)->whereMonth('created_at', 11)->sum('monto_total') }},
                     {{ \App\Models\Deuda::whereYear('created_at', now()->year)->whereMonth('created_at', 12)->sum('monto_total') }}
                    ],
                    
                    borderColor: '#D85A30',
                    backgroundColor: 'rgba(216,90,48,.1)',
                    borderWidth: 2,
                    pointRadius: 4,
                    pointBackgroundColor: '#D85A30',
                    fill: true,
                    tension: 0.4,
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        interaction: { mode: 'index', intersect: false },
        plugins: {
            legend: { display: true, position: 'top', labels: { font: { size: 11 }, boxWidth: 12 } },
            tooltip: { callbacks: { label: c => ' ' + c.dataset.label + ': $' + Number(c.parsed.y).toLocaleString('es-MX', { minimumFractionDigits: 2 }) } }
        },
        scales: {
            x: { grid: { display: false }, ticks: { font: { size: 11 } } },
            y: { grid: { color: 'rgba(0,0,0,.06)' }, ticks: { font: { size: 11 }, callback: v => '$' + Number(v).toLocaleString('es-MX') } }
        }
    }
});
}
</script>
<script>
async function generarPDF() {
    const btnPDF = document.querySelector('button[onclick="generarPDF()"]');
    const textoOriginal = btnPDF.textContent;
    btnPDF.disabled = true;
    btnPDF.textContent = '⏳ Generando...';

    try {
    
        await cargarScript('https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js');
        await cargarScript('https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js');

       
        const modal = document.getElementById('modalGraficos');
        modal.style.display = 'flex';

        // Google Charts (barras + pie)
        await new Promise(resolve => {
            google.charts.setOnLoadCallback(() => {
                dibujarGraficos();
                resolve();
            });
        });

        // Chart.js (donut tipos + línea mensual)
        dibujarGraficosNuevos();

        await new Promise(r => setTimeout(r, 1200));

       
        const contenido = modal.querySelector(':scope > div');
        const canvas = await html2canvas(contenido, {
            scale: 2,
            useCORS: true,
            backgroundColor: '#ffffff',
            logging: false,
        });

     
        const { jsPDF } = window.jspdf;
        const doc   = new jsPDF('p', 'mm', 'a4');
        const pageW = doc.internal.pageSize.getWidth();
        const pageH = doc.internal.pageSize.getHeight();
        const margin = 14;
        let y = margin;


        doc.setFillColor(15, 110, 86);
        doc.rect(0, 0, pageW, 28, 'F');
        doc.setTextColor(159, 225, 203);
        doc.setFontSize(18);
        doc.setFont('helvetica', 'bold');
        doc.text('FinanzasApp', margin, 18);
        doc.setFontSize(9);
        doc.setFont('helvetica', 'normal');
        doc.text('Reporte — ' + new Date().toLocaleDateString('es-SV'), pageW - margin, 18, { align: 'right' });
        y = 38;


        doc.setTextColor(136, 135, 128);
        doc.setFontSize(8);
        doc.setFont('helvetica', 'bold');
        doc.text('RESUMEN GENERAL', margin, y);
        y += 6;

        const totalGastos   = {{ \App\Models\Gasto::sum('monto') ?? 0 }};
        const totalIngresos = {{ \App\Models\Ingreso::sum('monto') ?? 0 }};
        const totalAhorros  = {{ \App\Models\Ahorro::sum('monto_actual') ?? 0 }};
        const totalDeudas   = {{ \App\Models\Deuda::sum('monto_total') ?? 0 }};
        const balance       = totalIngresos - totalGastos;

        const fmt = n => '$' + Number(n).toLocaleString('es-SV', { minimumFractionDigits: 2 });

        const filas = [
            ['Ingresos totales',            fmt(totalIngresos), [29, 158, 117]],
            ['Gastos totales',              fmt(totalGastos),   [216, 90, 48]],
            ['Ahorros totales',             fmt(totalAhorros),  [50, 102, 173]],
            ['Deudas totales',              fmt(totalDeudas),   [186, 117, 23]],
        ];

        filas.forEach(([label, valor, color]) => {
            doc.setFillColor(248, 248, 245);
            doc.roundedRect(margin, y, pageW - margin * 2, 10, 2, 2, 'F');
            doc.setTextColor(26, 26, 24);
            doc.setFontSize(10);
            doc.setFont('helvetica', 'normal');
            doc.text(label, margin + 4, y + 7);
            doc.setTextColor(...color);
            doc.setFont('helvetica', 'bold');
            doc.text(valor, pageW - margin - 4, y + 7, { align: 'right' });
            y += 13;
        });

        y += 8;

        // ── Gráficos (captura del modal) ─────────────────
        doc.setTextColor(136, 135, 128);
        doc.setFontSize(8);
        doc.setFont('helvetica', 'bold');
        doc.text('GRÁFICOS', margin, y);
        y += 5;

        const imgData = canvas.toDataURL('image/png');
        const imgW    = pageW - margin * 2;
        const imgH    = (canvas.height * imgW) / canvas.width;

      
        if (y + imgH > pageH - margin) {
            doc.addPage();
            y = margin;
        }
        doc.addImage(imgData, 'PNG', margin, y, imgW, imgH);

        // ── Pie de página ────────────────────────────────
        doc.setDrawColor(211, 209, 199);
        doc.line(margin, pageH - 12, pageW - margin, pageH - 12);
        doc.setTextColor(136, 135, 128);
        doc.setFontSize(8);
        doc.setFont('helvetica', 'normal');
        doc.text('Generado por FinanzasApp', margin, pageH - 6);
        doc.text('Pág. 1', pageW - margin, pageH - 6, { align: 'right' });

        doc.save('reporte-finanzas.pdf');

     
        modal.style.display = 'none';

    } catch (err) {
        console.error('Error generando PDF:', err);
        alert('Error al generar el PDF: ' + err.message);
    } finally {
        btnPDF.disabled = false;
        btnPDF.textContent = textoOriginal;
    }
}

function cargarScript(src) {
    return new Promise((resolve, reject) => {
        if (document.querySelector('script[src="' + src + '"]')) { resolve(); return; }
        const s = document.createElement('script');
        s.src = src;
        s.onload = resolve;
        s.onerror = reject;
        document.head.appendChild(s);
    });
}
</script>
</body>
</html>
