@extends('layouts.finanzas')

@section('title', 'Gastos - FinanzasApp')
@section('page-title', 'Gastos')
@section('page-subtitle', 'Registro de todos tus egresos')

@section('content')
<div class="fin-card">
    <div class="fin-card-header">
        <span class="fin-card-title">💸 Mis Gastos</span>
        <a href="{{ route('gastos.create') }}" class="btn-add">+ agregar</a>
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
            @forelse($gastos as $gasto)
            <tr>
                <td style="font-weight:500;">{{ $gasto->descripcion }}</td>
                <td><span class="badge-rojo">{{ ucfirst($gasto->tipo) }}</span></td>
                <td style="color:var(--muted); font-size:12px;">{{ $gasto->fecha->format('d/m/Y') }}</td>
                <td style="font-weight:600; color:#D85A30;">-${{ number_format($gasto->monto, 2) }}</td>
                <td>
                    <a href="{{ route('gastos.edit', $gasto) }}" class="btn-accion">✏ Editar</a>
                    <form action="{{ route('gastos.destroy', $gasto) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-accion danger"
                            onclick="return confirm('¿Eliminar este gasto?')">🗑 Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5"><div class="empty-state">Sin gastos registrados. <a href="{{ route('gastos.create') }}">Agrega el primero</a>.</div></td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($gastos->count())
<div style="margin-top:1rem; font-size:13px; color:var(--muted);">
    Total: <strong style="color:#D85A30;">-${{ number_format($gastos->sum('monto'), 2) }}</strong>
    en {{ $gastos->count() }} registro(s)
</div>
@endif
@endsection
