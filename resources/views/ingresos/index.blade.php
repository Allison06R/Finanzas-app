@extends('layouts.finanzas')
@section('title', 'Ingresos - FinanzasApp')
@section('page-title', 'Ingresos')
@section('page-subtitle', 'Registro de todas tus entradas de dinero')

@section('content')
<div class="fin-card">
    <div class="fin-card-header">
        <span class="fin-card-title">💰 Mis Ingresos</span>
        <a href="{{ route('ingresos.create') }}" class="btn-add">+ agregar</a>
    </div>

    <table class="fin-table">
        <thead>
            <tr>
                <th>Descripción</th>
                <th>Tipo</th>
                <th>Fecha</th>
                <th>Monto</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($ingresos as $ingreso)
            <tr>
                <td style="font-weight:500;">{{ $ingreso->descripcion }}</td>
                <td><span class="badge-verde">{{ ucfirst($ingreso->tipo) }}</span></td>
                <td style="color:var(--muted); font-size:12px;">{{ $ingreso->fecha->format('d/m/Y') }}</td>
                <td style="font-weight:600; color:var(--verde-claro);">+${{ number_format($ingreso->monto, 2) }}</td>
                <td>
                    <a href="{{ route('ingresos.edit', $ingreso) }}" class="btn-accion">✏ Editar</a>
                    <form action="{{ route('ingresos.destroy', $ingreso) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-accion danger"
                            onclick="return confirm('¿Eliminar este ingreso?')">🗑 Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5"><div class="empty-state">Sin ingresos registrados. <a href="{{ route('ingresos.create') }}">Agrega el primero</a>.</div></td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($ingresos->count())
<div style="margin-top:1rem; font-size:13px; color:var(--muted);">
    Total: <strong style="color:var(--verde-claro);">+${{ number_format($ingresos->sum('monto'), 2) }}</strong>
    en {{ $ingresos->count() }} registro(s)
</div>
@endif
@endsection
