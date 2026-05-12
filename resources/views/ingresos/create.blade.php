@extends('layouts.finanzas')
@section('title', 'Nuevo Ingreso')
@section('page-title', 'Nuevo Ingreso')
@section('page-subtitle', 'Registra una nueva entrada de dinero')

@section('content')
<div class="fin-form-card">
    <form method="POST" action="{{ route('ingresos.store') }}">
        @csrf
        <div class="mb-3">
            <label>Descripción</label>
            <input type="text" name="descripcion" class="form-control" value="{{ old('descripcion') }}" placeholder="Ej: Salario enero, venta..." required>
        </div>
        <div class="mb-3">
            <label>Monto ($)</label>
            <input type="number" name="monto" class="form-control" value="{{ old('monto') }}" step="0.01" min="0" placeholder="0.00" required>
        </div>
        <div class="mb-3">
            <label>Fecha</label>
            <input type="date" name="fecha" class="form-control" value="{{ old('fecha', date('Y-m-d')) }}" required>
        </div>
        <div class="mb-4">
            <label>Tipo de ingreso</label>
            <select name="tipo" class="form-select" required>
                <option value="">Selecciona...</option>
                <option value="salario"      {{ old('tipo')=='salario'?'selected':'' }}>💼 Salario</option>
                <option value="ventas"       {{ old('tipo')=='ventas'?'selected':'' }}>🛒 Ventas</option>
                <option value="freelancing"  {{ old('tipo')=='freelancing'?'selected':'' }}>💻 Freelancing</option>
                <option value="otro"         {{ old('tipo')=='otro'?'selected':'' }}>📦 Otro</option>
            </select>
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn-guardar">Guardar ingreso</button>
            <a href="{{ route('dashboard') }}" class="btn-cancelar">Cancelar</a>
        </div>
    </form>
</div>
@endsection
