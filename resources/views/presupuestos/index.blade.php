@extends('layouts.finanzas')
@section('title', 'Presupuestos - FinanzasApp')
@section('page-title', 'Presupuestos')
@section('page-subtitle', 'Controla tus límites de gasto por categoría')

@section('content')
<div class="fin-card">
    <div class="fin-card-header">
        <span class="fin-card-title">📊 Mis Presupuestos</span>
        <a href="{{ route('presupuestos.create') }}" class="btn-add">+ agregar</a>
    </div>

    <table class="fin-table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Mes / Año</th>
                <th>Límite</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($presupuestos as $p)
            <tr>
                <td style="font-weight:500;">{{ $p->nombre }}</td>
                <td style="color:var(--muted); font-size:12px;">
                    {{ ['','Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'][$p->mes] }} {{ $p->anio }}
                </td>
                <td style="font-weight:600; color:var(--verde);">${{ number_format($p->monto_limite, 2) }}</td>
                <td>
                    <a href="{{ route('presupuestos.edit', $p) }}" class="btn-accion">✏ Editar</a>
                    <form action="{{ route('presupuestos.destroy', $p) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-accion danger"
                            onclick="return confirm('¿Eliminar este presupuesto?')">🗑 Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="4"><div class="empty-state">Sin presupuestos. <a href="{{ route('presupuestos.create') }}">Define tu primer límite</a>.</div></td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
