@extends('layouts.finanzas')
@section('title', 'Editar Ingreso')
@section('page-title', 'Editar Ingreso')
@section('page-subtitle', 'Modifica los datos del ingreso')

@section('content')
<div class="fin-form-card">
    <form method="POST" action="{{ route('ingresos.update', $ingreso) }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Descripción</label>
            <input type="text" name="descripcion" class="form-control" value="{{ old('descripcion', $ingreso->descripcion) }}" required>
        </div>
        <div class="mb-3">
            <label>Monto ($)</label>
            <input type="number" name="monto" class="form-control" value="{{ old('monto', $ingreso->monto) }}" step="0.01" min="0" required>
        </div>
        <div class="mb-3">
            <label>Fecha</label>
            <input type="date" name="fecha" class="form-control" value="{{ old('fecha', $ingreso->fecha->format('Y-m-d')) }}" required>
        </div>
        <div class="mb-4">
            <label>Tipo de ingreso</label>
            <select name="tipo" class="form-select" required>
                <option value="salario"     {{ $ingreso->tipo=='salario'?'selected':'' }}>💼 Salario</option>
                <option value="ventas"      {{ $ingreso->tipo=='ventas'?'selected':'' }}>🛒 Ventas</option>
                <option value="freelancing" {{ $ingreso->tipo=='freelancing'?'selected':'' }}>💻 Freelancing</option>
                <option value="otro"        {{ $ingreso->tipo=='otro'?'selected':'' }}>📦 Otro</option>
            </select>
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn-guardar">Actualizar</button>
            <a href="{{ route('ingresos.index') }}" class="btn-cancelar">Cancelar</a>
        </div>
    </form>
</div>
@endsection
