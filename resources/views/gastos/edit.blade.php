@extends('layouts.finanzas')
@section('title', 'Editar Gasto')
@section('page-title', 'Editar Gasto')
@section('page-subtitle', 'Modifica los datos del gasto')

@section('content')
<div class="fin-form-card">
    <form method="POST" action="{{ route('gastos.update', $gasto) }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Descripción</label>
            <input type="text" name="descripcion" class="form-control" value="{{ old('descripcion', $gasto->descripcion) }}" required>
        </div>
        <div class="mb-3">
            <label>Monto ($)</label>
            <input type="number" name="monto" class="form-control" value="{{ old('monto', $gasto->monto) }}" step="0.01" min="0" required>
        </div>
        <div class="mb-3">
            <label>Fecha</label>
            <input type="date" name="fecha" class="form-control" value="{{ old('fecha', $gasto->fecha->format('Y-m-d')) }}" required>
        </div>
        <div class="mb-4">
            <label>Tipo de gasto</label>
            <select name="tipo" class="form-select" required>
                <option value="comida"          {{ $gasto->tipo=='comida'?'selected':'' }}>🍽 Comida</option>
                <option value="transporte"      {{ $gasto->tipo=='transporte'?'selected':'' }}>🚗 Transporte</option>
                <option value="entretenimiento" {{ $gasto->tipo=='entretenimiento'?'selected':'' }}>🎬 Entretenimiento</option>
                <option value="salud"           {{ $gasto->tipo=='salud'?'selected':'' }}>💊 Salud</option>
                <option value="otro"            {{ $gasto->tipo=='otro'?'selected':'' }}>📦 Otro</option>
            </select>
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn-guardar">Actualizar</button>
            <a href="{{ route('gastos.index') }}" class="btn-cancelar">Cancelar</a>
        </div>
    </form>
</div>
@endsection
