@extends('layouts.finanzas')
@section('title', 'Registros de ' . $user->name)
@section('page-title', 'Registros de ' . $user->name)
@section('page-subtitle', $user->email . ' · ' . ucfirst($user->rol))

@section('content')

{{-- KPIs --}}
<div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(140px,1fr)); gap:10px; margin-bottom:1.5rem;">
    <div class="fin-card" style="padding:14px 16px;">
        <div style="font-size:11px; color:var(--muted); text-transform:uppercase; letter-spacing:.07em; margin-bottom:6px;">Ingresos</div>
        <div style="font-size:22px; font-weight:500; color:var(--verde-claro);">${{ number_format($ingresos->sum('monto'), 2) }}</div>
    </div>
    <div class="fin-card" style="padding:14px 16px;">
        <div style="font-size:11px; color:var(--muted); text-transform:uppercase; letter-spacing:.07em; margin-bottom:6px;">Gastos</div>
        <div style="font-size:22px; font-weight:500; color:#D85A30;">${{ number_format($gastos->sum('monto'), 2) }}</div>
    </div>
    <div class="fin-card" style="padding:14px 16px;">
        <div style="font-size:11px; color:var(--muted); text-transform:uppercase; letter-spacing:.07em; margin-bottom:6px;">Ahorros</div>
        <div style="font-size:22px; font-weight:500; color:#3266ad;">${{ number_format($ahorros->sum('monto_actual'), 2) }}</div>
    </div>
    <div class="fin-card" style="padding:14px 16px;">
        <div style="font-size:11px; color:var(--muted); text-transform:uppercase; letter-spacing:.07em; margin-bottom:6px;">Deudas</div>
        <div style="font-size:22px; font-weight:500; color:#BA7517;">${{ number_format($deudas->sum('monto_total'), 2) }}</div>
    </div>
</div>

{{-- Gastos --}}
<div class="fin-card mb-3">
    <div class="fin-card-header">
        <span class="fin-card-title">💸 Gastos</span>
    </div>
    <table class="fin-table">
        <thead><tr><th>Descripción</th><th>Tipo</th><th>Fecha</th><th>Monto</th><th>Acción</th></tr></thead>
        <tbody>
            @forelse($gastos as $g)
            <tr>
                <td>{{ $g->descripcion }}</td>
                <td><span class="badge-rojo">{{ ucfirst($g->tipo) }}</span></td>
                <td style="font-size:12px; color:var(--muted);">{{ $g->fecha->format('d/m/Y') }}</td>
                <td style="color:#D85A30; font-weight:600;">-${{ number_format($g->monto, 2) }}</td>
                <td>
                    <form action="{{ route('admin.eliminarGasto', $g) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-accion danger" onclick="return confirm('¿Eliminar?')">🗑</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5"><div class="empty-state">Sin gastos</div></td></tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Ingresos --}}
<div class="fin-card mb-3">
    <div class="fin-card-header">
        <span class="fin-card-title">💰 Ingresos</span>
    </div>
    <table class="fin-table">
        <thead><tr><th>Descripción</th><th>Tipo</th><th>Fecha</th><th>Monto</th><th>Acción</th></tr></thead>
        <tbody>
            @forelse($ingresos as $i)
            <tr>
                <td>{{ $i->descripcion }}</td>
                <td><span class="badge-verde">{{ ucfirst($i->tipo) }}</span></td>
                <td style="font-size:12px; color:var(--muted);">{{ $i->fecha->format('d/m/Y') }}</td>
                <td style="color:var(--verde-claro); font-weight:600;">+${{ number_format($i->monto, 2) }}</td>
                <td>
                    <form action="{{ route('admin.eliminarIngreso', $i) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-accion danger" onclick="return confirm('¿Eliminar?')">🗑</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5"><div class="empty-state">Sin ingresos</div></td></tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Presupuestos --}}
<div class="fin-card mb-3">
    <div class="fin-card-header">
        <span class="fin-card-title">📊 Presupuestos</span>
    </div>
    <table class="fin-table">
        <thead><tr><th>Nombre</th><th>Mes/Año</th><th>Límite</th></tr></thead>
        <tbody>
            @forelse($presupuestos as $p)
            <tr>
                <td>{{ $p->nombre }}</td>
                <td style="font-size:12px; color:var(--muted);">{{ $p->mes }}/{{ $p->anio }}</td>
                <td style="color:var(--verde); font-weight:600;">${{ number_format($p->monto_limite, 2) }}</td>
            </tr>
            @empty
            <tr><td colspan="3"><div class="empty-state">Sin presupuestos</div></td></tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Ahorros --}}
<div class="fin-card mb-3">
    <div class="fin-card-header">
        <span class="fin-card-title">🏦 Ahorros</span>
    </div>
    <table class="fin-table">
        <thead><tr><th>Nombre</th><th>Estado</th><th>Meta</th><th>Actual</th></tr></thead>
        <tbody>
            @forelse($ahorros as $a)
            <tr>
                <td>{{ $a->nombre }}</td>
                <td><span class="badge-azul">{{ ucfirst(str_replace('_',' ',$a->estado)) }}</span></td>
                <td style="color:var(--muted);">${{ number_format($a->monto_meta, 2) }}</td>
                <td style="color:#3266ad; font-weight:600;">${{ number_format($a->monto_actual, 2) }}</td>
            </tr>
            @empty
            <tr><td colspan="4"><div class="empty-state">Sin ahorros</div></td></tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Deudas --}}
<div class="fin-card mb-3">
    <div class="fin-card-header">
        <span class="fin-card-title">💳 Deudas</span>
    </div>
    <table class="fin-table">
        <thead><tr><th>Nombre</th><th>Tipo</th><th>Estado</th><th>Total</th><th>Pagado</th></tr></thead>
        <tbody>
            @forelse($deudas as $d)
            <tr>
                <td>{{ $d->nombre }}</td>
                <td><span class="badge-gris">{{ ucfirst($d->tipo) }}</span></td>
                <td><span class="badge-naranja">{{ ucfirst($d->estado) }}</span></td>
                <td style="color:var(--muted);">${{ number_format($d->monto_total, 2) }}</td>
                <td style="color:var(--verde-claro);">${{ number_format($d->monto_pagado, 2) }}</td>
            </tr>
            @empty
            <tr><td colspan="5"><div class="empty-state">Sin deudas</div></td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<a href="{{ route('admin.index') }}" class="btn-cancelar">← Volver a usuarios</a>
@endsection
