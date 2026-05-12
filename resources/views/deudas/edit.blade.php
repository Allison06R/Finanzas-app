@extends('layouts.finanzas')
@section('title', 'Editar Deuda')
@section('page-title', 'Editar Deuda')
@section('page-subtitle', 'Actualiza los datos de la deuda')

@section('content')
<div class="fin-form-card">
    <form method="POST" action="{{ route('deudas.update', $deuda) }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $deuda->nombre) }}" required>
        </div>
        <div class="mb-3">
            <label>Monto total ($)</label>
            <input type="number" name="monto_total" class="form-control" value="{{ old('monto_total', $deuda->monto_total) }}" step="0.01" min="0" required>
        </div>
        <div class="mb-3">
            <label>Monto pagado ($)</label>
            <input type="number" name="monto_pagado" class="form-control" value="{{ old('monto_pagado', $deuda->monto_pagado) }}" step="0.01" min="0" required>
        </div>
        <div class="mb-3">
            <label>Tipo</label>
            <select name="tipo" class="form-select" required>
                <option value="prestamo" {{ $deuda->tipo=='prestamo'?'selected':'' }}>🏦 Préstamo</option>
                <option value="tarjeta"  {{ $deuda->tipo=='tarjeta'?'selected':'' }}>💳 Tarjeta</option>
                <option value="otro"     {{ $deuda->tipo=='otro'?'selected':'' }}>📦 Otro</option>
            </select>
        </div>
        <div class="mb-4">
            <label>Estado</label>
            <select name="estado" class="form-select" required>
                <option value="pendiente" {{ $deuda->estado=='pendiente'?'selected':'' }}>Pendiente</option>
                <option value="pagado"    {{ $deuda->estado=='pagado'?'selected':'' }}>Pagado</option>
                <option value="vencido"   {{ $deuda->estado=='vencido'?'selected':'' }}>Vencido</option>
            </select>
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn-guardar">Actualizar</button>
            <a href="{{ route('deudas.index') }}" class="btn-cancelar">Cancelar</a>
        </div>
    </form>
</div>
@endsection
