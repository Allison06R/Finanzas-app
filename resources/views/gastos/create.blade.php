@extends('layouts.finanzas')
@section('title', 'Nuevo Gasto')
@section('page-title', 'Nuevo Gasto')
@section('page-subtitle', 'Registra un nuevo egreso')

@section('content')
<div class="fin-form-card">
    <form method="POST" action="{{ route('gastos.store') }}">
        @csrf
        <div class="mb-3">
            <label>Descripción</label>
            <input type="text" name="descripcion" class="form-control" value="{{ old('descripcion') }}" placeholder="Ej: Supermercado, gasolina..." required>
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
            <label>Tipo de gasto</label>
            <select name="tipo" class="form-select" required>
                <option value="">Selecciona...</option>
                <option value="comida" {{ old('tipo')=='comida'?'selected':'' }}>🍽 Comida</option>
                <option value="transporte" {{ old('tipo')=='transporte'?'selected':'' }}>🚗 Transporte</option>
                <option value="entretenimiento" {{ old('tipo')=='entretenimiento'?'selected':'' }}>🎬 Entretenimiento</option>
                <option value="salud" {{ old('tipo')=='salud'?'selected':'' }}>💊 Salud</option>
                <option value="otro" {{ old('tipo')=='otro'?'selected':'' }}>📦 Otro</option>
            </select>
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn-guardar">Guardar gasto</button>
            <a href="{{ route('dashboard') }}" class="btn-cancelar">Cancelar</a>
        </div>
    </form>
</div>
@endsection
