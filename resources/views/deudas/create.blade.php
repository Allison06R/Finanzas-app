@extends('layouts.finanzas')
@section('title', 'Nueva Deuda')
@section('page-title', 'Nueva Deuda')
@section('page-subtitle', 'Registra una obligación financiera')

@section('content')
<div class="fin-form-card">
    <form method="POST" action="{{ route('deudas.store') }}">
        @csrf
        <div class="mb-3">
            <label>Nombre de la deuda</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" placeholder="Ej: Préstamo banco, Tarjeta..." required>
        </div>
        <div class="mb-3">
            <label>Monto total ($)</label>
            <input type="number" name="monto_total" class="form-control" value="{{ old('monto_total') }}" step="0.01" min="0" placeholder="0.00" required>
        </div>
        <div class="mb-3">
            <label>Monto ya pagado ($)</label>
            <input type="number" name="monto_pagado" class="form-control" value="{{ old('monto_pagado', 0) }}" step="0.01" min="0" placeholder="0.00" required>
        </div>
        <div class="mb-3">
            <label>Tipo</label>
            <select name="tipo" class="form-select" required>
                <option value="">Selecciona...</option>
                <option value="prestamo" {{ old('tipo')=='prestamo'?'selected':'' }}>🏦 Préstamo</option>
                <option value="tarjeta"  {{ old('tipo')=='tarjeta'?'selected':'' }}>💳 Tarjeta</option>
                <option value="otro"     {{ old('tipo')=='otro'?'selected':'' }}>📦 Otro</option>
            </select>
        </div>
        <div class="mb-4">
            <label>Estado</label>
            <select name="estado" class="form-select" required>
                <option value="pendiente" {{ old('estado','pendiente')=='pendiente'?'selected':'' }}>Pendiente</option>
                <option value="pagado"    {{ old('estado')=='pagado'?'selected':'' }}>Pagado</option>
                <option value="vencido"   {{ old('estado')=='vencido'?'selected':'' }}>Vencido</option>
            </select>
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn-guardar">Guardar deuda</button>
            <a href="{{ route('dashboard') }}" class="btn-cancelar">Cancelar</a>
        </div>
    </form>
</div>
@endsection
