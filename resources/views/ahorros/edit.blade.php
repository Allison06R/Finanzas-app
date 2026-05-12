@extends('layouts.finanzas')
@section('title', 'Editar Ahorro')
@section('page-title', 'Editar Ahorro')
@section('page-subtitle', 'Actualiza tu meta de ahorro')

@section('content')
<div class="fin-form-card">
    <form method="POST" action="{{ route('ahorros.update', $ahorro) }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $ahorro->nombre) }}" required>
        </div>
        <div class="mb-3">
            <label>Monto meta ($)</label>
            <input type="number" name="monto_meta" class="form-control" value="{{ old('monto_meta', $ahorro->monto_meta) }}" step="0.01" min="0" required>
        </div>
        <div class="mb-3">
            <label>Monto actual ($)</label>
            <input type="number" name="monto_actual" class="form-control" value="{{ old('monto_actual', $ahorro->monto_actual) }}" step="0.01" min="0" required>
        </div>
        <div class="mb-4">
            <label>Estado</label>
            <select name="estado" class="form-select" required>
                <option value="en_progreso" {{ $ahorro->estado=='en_progreso'?'selected':'' }}>En progreso</option>
                <option value="completado"  {{ $ahorro->estado=='completado'?'selected':'' }}>Completado</option>
                <option value="cancelado"   {{ $ahorro->estado=='cancelado'?'selected':'' }}>Cancelado</option>
            </select>
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn-guardar">Actualizar</button>
            <a href="{{ route('ahorros.index') }}" class="btn-cancelar">Cancelar</a>
        </div>
    </form>
</div>
@endsection
