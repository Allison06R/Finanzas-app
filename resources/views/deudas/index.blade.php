@extends('layouts.finanzas')
@section('title', 'Deudas - FinanzasApp')
@section('page-title', 'Deudas')
@section('page-subtitle', 'Control de tus obligaciones financieras')

@section('content')
<div class="fin-card">
    <div class="fin-card-header">
        <span class="fin-card-title">💳 Mis Deudas</span>
        <a href="{{ route('deudas.create') }}" class="btn-add">+ agregar</a>
    </div>

    <table class="fin-table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Estado</th>
                <th>Total</th>
                <th>Pagado</th>
                <th>Pendiente</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($deudas as $deuda)
            @php $pendiente = $deuda->monto_total - $deuda->monto_pagado; @endphp
            <tr>
                <td style="font-weight:500;">{{ $deuda->nombre }}</td>
                <td><span class="badge-gris">{{ ucfirst($deuda->tipo) }}</span></td>
                <td>
                    @if($deuda->estado == 'pagado')
                        <span class="badge-verde">✓ Pagado</span>
                    @elseif($deuda->estado == 'vencido')
                        <span class="badge-rojo">⚠ Vencido</span>
                    @else
                        <span class="badge-naranja">Pendiente</span>
                    @endif
                </td>
                <td style="color:var(--muted);">${{ number_format($deuda->monto_total, 2) }}</td>
                <td style="color:var(--verde-claro);">${{ number_format($deuda->monto_pagado, 2) }}</td>
                <td style="font-weight:600; color:#BA7517;">${{ number_format($pendiente, 2) }}</td>
                <td>
                    <a href="{{ route('deudas.edit', $deuda) }}" class="btn-accion">✏ Editar</a>
                    <form action="{{ route('deudas.destroy', $deuda) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-accion danger"
                            onclick="return confirm('¿Eliminar esta deuda?')">🗑 Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="7"><div class="empty-state">Sin deudas registradas. <a href="{{ route('deudas.create') }}">Agrega la primera</a>.</div></td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
