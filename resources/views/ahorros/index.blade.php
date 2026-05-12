@extends('layouts.finanzas')
@section('title', 'Ahorros - FinanzasApp')
@section('page-title', 'Ahorros')
@section('page-subtitle', 'Seguimiento de tus metas de ahorro')

@section('content')
<div class="fin-card">
    <div class="fin-card-header">
        <span class="fin-card-title">🏦 Mis Ahorros</span>
        <a href="{{ route('ahorros.create') }}" class="btn-add">+ agregar</a>
    </div>

    <table class="fin-table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Meta</th>
                <th>Acumulado</th>
                <th>Progreso</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($ahorros as $ahorro)
            @php
                $pct = $ahorro->monto_meta > 0 ? min(100, round($ahorro->monto_actual / $ahorro->monto_meta * 100)) : 0;
            @endphp
            <tr>
                <td style="font-weight:500;">{{ $ahorro->nombre }}</td>
                <td>
                    @if($ahorro->estado == 'completado')
                        <span class="badge-verde">✓ Completado</span>
                    @elseif($ahorro->estado == 'cancelado')
                        <span class="badge-gris">✗ Cancelado</span>
                    @else
                        <span class="badge-azul">En progreso</span>
                    @endif
                </td>
                <td style="color:var(--muted);">${{ number_format($ahorro->monto_meta, 2) }}</td>
                <td style="font-weight:600; color:#3266ad;">${{ number_format($ahorro->monto_actual, 2) }}</td>
                <td style="min-width:100px;">
                    <div style="background:#F1EFE8; border-radius:99px; height:6px; overflow:hidden;">
                        <div style="background:#3266ad; width:{{ $pct }}%; height:100%;"></div>
                    </div>
                    <span style="font-size:11px; color:var(--muted);">{{ $pct }}%</span>
                </td>
                <td>
                    <a href="{{ route('ahorros.edit', $ahorro) }}" class="btn-accion">✏ Editar</a>
                    <form action="{{ route('ahorros.destroy', $ahorro) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-accion danger"
                            onclick="return confirm('¿Eliminar este ahorro?')">🗑 Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6"><div class="empty-state">Sin metas de ahorro. <a href="{{ route('ahorros.create') }}">Crea tu primera meta</a>.</div></td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
