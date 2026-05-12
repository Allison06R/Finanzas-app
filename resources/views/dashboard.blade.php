@extends('layouts.finanzas')
@section('title', 'Dashboard - FinanzasApp')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Bienvenido, ' . auth()->user()->name)

@section('content')

@if(auth()->user()->isAdmin())
{{-- ===== VISTA ADMIN ===== --}}
<div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(150px,1fr)); gap:10px; margin-bottom:1.5rem;">
    <div class="fin-card" style="padding:14px 16px;">
        <div style="font-size:11px; color:var(--muted); text-transform:uppercase; letter-spacing:.07em; margin-bottom:6px;">Usuarios</div>
        <div style="font-size:26px; font-weight:600; color:var(--verde);">{{ \App\Models\User::where('rol','usuario')->count() }}</div>
    </div>
    <div class="fin-card" style="padding:14px 16px;">
        <div style="font-size:11px; color:var(--muted); text-transform:uppercase; letter-spacing:.07em; margin-bottom:6px;">Total Gastos</div>
        <div style="font-size:26px; font-weight:600; color:#D85A30;">${{ number_format(\App\Models\Gasto::sum('monto'), 2) }}</div>
    </div>
    <div class="fin-card" style="padding:14px 16px;">
        <div style="font-size:11px; color:var(--muted); text-transform:uppercase; letter-spacing:.07em; margin-bottom:6px;">Total Ingresos</div>
        <div style="font-size:26px; font-weight:600; color:var(--verde-claro);">${{ number_format(\App\Models\Ingreso::sum('monto'), 2) }}</div>
    </div>
    <div class="fin-card" style="padding:14px 16px;">
        <div style="font-size:11px; color:var(--muted); text-transform:uppercase; letter-spacing:.07em; margin-bottom:6px;">Total Ahorros</div>
        <div style="font-size:26px; font-weight:600; color:#3266ad;">${{ number_format(\App\Models\Ahorro::sum('monto_actual'), 2) }}</div>
    </div>
</div>

{{-- Gastos globales --}}
<div class="fin-card mb-3">
    <div class="fin-card-header">
        <span class="fin-card-title">💸 Gastos (todos los usuarios)</span>
        <a href="{{ route('gastos.create') }}" class="btn-add">+ agregar</a>
    </div>
    <table class="fin-table">
        <thead><tr><th>Usuario</th><th>Descripción</th><th>Tipo</th><th>Fecha</th><th>Monto</th><th>Acciones</th></tr></thead>
        <tbody>
            @forelse(\App\Models\Gasto::with('user')->orderBy('fecha','desc')->get() as $gasto)
            <tr>
                <td style="font-size:12px; color:var(--muted);">{{ $gasto->user->name }}</td>
                <td style="font-weight:500;">{{ $gasto->descripcion }}</td>
                <td><span class="badge-rojo">{{ ucfirst($gasto->tipo) }}</span></td>
                <td style="font-size:12px; color:var(--muted);">{{ $gasto->fecha->format('d/m/Y') }}</td>
                <td style="font-weight:600; color:#D85A30;">-${{ number_format($gasto->monto, 2) }}</td>
                <td>
                    <a href="{{ route('gastos.edit', $gasto) }}" class="btn-accion">✏</a>
                    <form action="{{ route('gastos.destroy', $gasto) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-accion danger" onclick="return confirm('¿Eliminar?')">🗑</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6"><div class="empty-state">No hay gastos.</div></td></tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Ingresos globales --}}
<div class="fin-card mb-3">
    <div class="fin-card-header">
        <span class="fin-card-title">💰 Ingresos (todos los usuarios)</span>
        <a href="{{ route('ingresos.create') }}" class="btn-add">+ agregar</a>
    </div>
    <table class="fin-table">
        <thead><tr><th>Usuario</th><th>Descripción</th><th>Tipo</th><th>Fecha</th><th>Monto</th><th>Acciones</th></tr></thead>
        <tbody>
            @forelse(\App\Models\Ingreso::with('user')->orderBy('fecha','desc')->get() as $ingreso)
            <tr>
                <td style="font-size:12px; color:var(--muted);">{{ $ingreso->user->name }}</td>
                <td style="font-weight:500;">{{ $ingreso->descripcion }}</td>
                <td><span class="badge-verde">{{ ucfirst($ingreso->tipo) }}</span></td>
                <td style="font-size:12px; color:var(--muted);">{{ $ingreso->fecha->format('d/m/Y') }}</td>
                <td style="font-weight:600; color:var(--verde-claro);">+${{ number_format($ingreso->monto, 2) }}</td>
                <td>
                    <a href="{{ route('ingresos.edit', $ingreso) }}" class="btn-accion">✏</a>
                    <form action="{{ route('ingresos.destroy', $ingreso) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-accion danger" onclick="return confirm('¿Eliminar?')">🗑</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6"><div class="empty-state">No hay ingresos.</div></td></tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Presupuestos globales --}}
<div class="fin-card mb-3">
    <div class="fin-card-header">
        <span class="fin-card-title">📊 Presupuestos (todos los usuarios)</span>
        <a href="{{ route('presupuestos.create') }}" class="btn-add">+ agregar</a>
    </div>
    <table class="fin-table">
        <thead><tr><th>Usuario</th><th>Nombre</th><th>Mes</th><th>Año</th><th>Monto Límite</th><th>Acciones</th></tr></thead>
        <tbody>
            @forelse(\App\Models\Presupuesto::with('user')->get() as $presupuesto)
            <tr>
                <td style="font-size:12px; color:var(--muted);">{{ $presupuesto->user->name }}</td>
                <td style="font-weight:500;">{{ $presupuesto->nombre }}</td>
                <td>{{ $presupuesto->mes }}</td>
                <td>{{ $presupuesto->anio }}</td>
                <td style="font-weight:600; color:var(--verde);">${{ number_format($presupuesto->monto_limite, 2) }}</td>
                <td>
                    <a href="{{ route('presupuestos.edit', $presupuesto) }}" class="btn-accion">✏</a>
                    <form action="{{ route('presupuestos.destroy', $presupuesto) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-accion danger" onclick="return confirm('¿Eliminar?')">🗑</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6"><div class="empty-state">No hay presupuestos.</div></td></tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Ahorros globales --}}
<div class="fin-card mb-3">
    <div class="fin-card-header">
        <span class="fin-card-title">🏦 Ahorros (todos los usuarios)</span>
        <a href="{{ route('ahorros.create') }}" class="btn-add">+ agregar</a>
    </div>
    <table class="fin-table">
        <thead><tr><th>Usuario</th><th>Nombre</th><th>Meta</th><th>Actual</th><th>Estado</th><th>Acciones</th></tr></thead>
        <tbody>
            @forelse(\App\Models\Ahorro::with('user')->get() as $ahorro)
            <tr>
                <td style="font-size:12px; color:var(--muted);">{{ $ahorro->user->name }}</td>
                <td style="font-weight:500;">{{ $ahorro->nombre }}</td>
                <td>${{ number_format($ahorro->monto_meta, 2) }}</td>
                <td style="font-weight:600; color:#3266ad;">${{ number_format($ahorro->monto_actual, 2) }}</td>
                <td>{{ ucfirst(str_replace('_',' ',$ahorro->estado)) }}</td>
                <td>
                    <a href="{{ route('ahorros.edit', $ahorro) }}" class="btn-accion">✏</a>
                    <form action="{{ route('ahorros.destroy', $ahorro) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-accion danger" onclick="return confirm('¿Eliminar?')">🗑</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6"><div class="empty-state">No hay ahorros.</div></td></tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Deudas globales --}}
<div class="fin-card mb-3">
    <div class="fin-card-header">
        <span class="fin-card-title">💳 Deudas (todos los usuarios)</span>
        <a href="{{ route('deudas.create') }}" class="btn-add">+ agregar</a>
    </div>
    <table class="fin-table">
        <thead><tr><th>Usuario</th><th>Nombre</th><th>Total</th><th>Pagado</th><th>Tipo</th><th>Estado</th><th>Acciones</th></tr></thead>
        <tbody>
            @forelse(\App\Models\Deuda::with('user')->get() as $deuda)
            <tr>
                <td style="font-size:12px; color:var(--muted);">{{ $deuda->user->name }}</td>
                <td style="font-weight:500;">{{ $deuda->nombre }}</td>
                <td>${{ number_format($deuda->monto_total, 2) }}</td>
                <td style="font-weight:600; color:#BA7517;">${{ number_format($deuda->monto_pagado, 2) }}</td>
                <td>{{ ucfirst($deuda->tipo) }}</td>
                <td>{{ ucfirst($deuda->estado) }}</td>
                <td>
                    <a href="{{ route('deudas.edit', $deuda) }}" class="btn-accion">✏</a>
                    <form action="{{ route('deudas.destroy', $deuda) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-accion danger" onclick="return confirm('¿Eliminar?')">🗑</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="7"><div class="empty-state">No hay deudas.</div></td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@else
{{-- ===== VISTA USUARIO ===== --}}
<div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(140px,1fr)); gap:10px; margin-bottom:1.5rem;">
    <div class="fin-card" style="padding:14px 16px;">
        <div style="font-size:11px; color:var(--muted); text-transform:uppercase; letter-spacing:.07em; margin-bottom:6px;">Ingresos</div>
        <div style="font-size:24px; font-weight:500; color:var(--verde-claro);">${{ number_format(auth()->user()->ingresos()->sum('monto'), 2) }}</div>
    </div>
    <div class="fin-card" style="padding:14px 16px;">
        <div style="font-size:11px; color:var(--muted); text-transform:uppercase; letter-spacing:.07em; margin-bottom:6px;">Gastos</div>
        <div style="font-size:24px; font-weight:500; color:#D85A30;">${{ number_format(auth()->user()->gastos()->sum('monto'), 2) }}</div>
    </div>
    <div class="fin-card" style="padding:14px 16px;">
        <div style="font-size:11px; color:var(--muted); text-transform:uppercase; letter-spacing:.07em; margin-bottom:6px;">Ahorros</div>
        <div style="font-size:24px; font-weight:500; color:#3266ad;">${{ number_format(auth()->user()->ahorros()->sum('monto_actual'), 2) }}</div>
    </div>
    <div class="fin-card" style="padding:14px 16px;">
        <div style="font-size:11px; color:var(--muted); text-transform:uppercase; letter-spacing:.07em; margin-bottom:6px;">Deudas</div>
        <div style="font-size:24px; font-weight:500; color:#BA7517;">${{ number_format(auth()->user()->deudas()->sum('monto_total'), 2) }}</div>
    </div>
</div>

<div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem; margin-bottom:1rem;">

    {{-- Ingresos --}}
    <div class="fin-card">
        <div class="fin-card-header">
            <span class="fin-card-title">💰 Ingresos</span>
            <a href="{{ route('ingresos.create') }}" class="btn-add">+ agregar</a>
        </div>
        @forelse(auth()->user()->ingresos()->orderBy('fecha','desc')->get() as $ingreso)
        <div style="display:flex; align-items:center; gap:10px; padding:8px 0; border-bottom:0.5px solid #F1EFE8;">
            <div style="width:8px; height:8px; border-radius:50%; background:var(--verde-claro); flex-shrink:0;"></div>
            <div style="flex:1; font-size:13px; color:var(--texto);">{{ $ingreso->descripcion }}</div>
            <div style="font-size:11px; color:var(--muted);">{{ $ingreso->fecha->format('d/m/Y') }}</div>
            <div style="font-size:14px; font-weight:500; color:var(--verde-claro);">+${{ number_format($ingreso->monto, 2) }}</div>
        </div>
        @empty
        <div class="empty-state" style="padding:.75rem 0;">Sin registros</div>
        @endforelse
    </div>

    {{-- Gastos --}}
    <div class="fin-card">
        <div class="fin-card-header">
            <span class="fin-card-title">💸 Gastos</span>
            <a href="{{ route('gastos.create') }}" class="btn-add">+ agregar</a>
        </div>
        @forelse(auth()->user()->gastos()->orderBy('fecha','desc')->get() as $gasto)
        <div style="display:flex; align-items:center; gap:10px; padding:8px 0; border-bottom:0.5px solid #F1EFE8;">
            <div style="width:8px; height:8px; border-radius:50%; background:#D85A30; flex-shrink:0;"></div>
            <div style="flex:1;">
                <div style="font-size:13px; color:var(--texto);">{{ $gasto->descripcion }}</div>
                <div style="font-size:11px; color:var(--muted);">{{ ucfirst($gasto->tipo) }}</div>
            </div>
            <div style="font-size:11px; color:var(--muted);">{{ $gasto->fecha->format('d/m/Y') }}</div>
            <div style="font-size:14px; font-weight:500; color:#D85A30;">-${{ number_format($gasto->monto, 2) }}</div>
        </div>
        @empty
        <div class="empty-state" style="padding:.75rem 0;">Sin registros</div>
        @endforelse
    </div>
</div>

{{-- Presupuestos --}}
<div class="fin-card mb-3">
    <div class="fin-card-header">
        <span class="fin-card-title">📊 Presupuestos</span>
        <a href="{{ route('presupuestos.create') }}" class="btn-add">+ agregar</a>
    </div>
    @forelse(auth()->user()->presupuestos()->get() as $p)
    <div style="display:flex; align-items:center; gap:10px; padding:8px 0; border-bottom:0.5px solid #F1EFE8;">
        <div style="width:8px; height:8px; border-radius:50%; background:var(--verde-claro); flex-shrink:0;"></div>
        <div style="flex:1; font-size:13px; color:var(--texto);">{{ $p->nombre }}</div>
        <div style="font-size:11px; color:var(--muted);">Mes {{ $p->mes }}/{{ $p->anio }}</div>
        <div style="font-size:14px; font-weight:500; color:var(--verde);">${{ number_format($p->monto_limite, 2) }}</div>
    </div>
    @empty
    <div class="empty-state" style="padding:.75rem 0;">Define tus límites de gasto</div>
    @endforelse
</div>

<div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">

    {{-- Ahorros --}}
    <div class="fin-card">
        <div class="fin-card-header">
            <span class="fin-card-title">🏦 Ahorros</span>
            <a href="{{ route('ahorros.create') }}" class="btn-add">+ agregar</a>
        </div>
        @forelse(auth()->user()->ahorros()->get() as $ahorro)
        <div style="display:flex; align-items:center; gap:10px; padding:8px 0; border-bottom:0.5px solid #F1EFE8;">
            <div style="width:8px; height:8px; border-radius:50%; background:#3266ad; flex-shrink:0;"></div>
            <div style="flex:1; font-size:13px; color:var(--texto);">{{ $ahorro->nombre }}</div>
            <div style="font-size:14px; font-weight:500; color:#3266ad;">${{ number_format($ahorro->monto_actual, 2) }}</div>
        </div>
        @empty
        <div class="empty-state" style="padding:.75rem 0;">Sin registros</div>
        @endforelse
    </div>

    {{-- Deudas --}}
    <div class="fin-card">
        <div class="fin-card-header">
            <span class="fin-card-title">💳 Deudas</span>
            <a href="{{ route('deudas.create') }}" class="btn-add">+ agregar</a>
        </div>
        @forelse(auth()->user()->deudas()->get() as $deuda)
        <div style="display:flex; align-items:center; gap:10px; padding:8px 0; border-bottom:0.5px solid #F1EFE8;">
            <div style="width:8px; height:8px; border-radius:50%; background:#BA7517; flex-shrink:0;"></div>
            <div style="flex:1; font-size:13px; color:var(--texto);">{{ $deuda->nombre }}</div>
            <div style="font-size:14px; font-weight:500; color:#BA7517;">${{ number_format($deuda->monto_total, 2) }}</div>
        </div>
        @empty
        <div class="empty-state" style="padding:.75rem 0;">Sin registros</div>
        @endforelse
    </div>
</div>
@endif

@endsection
