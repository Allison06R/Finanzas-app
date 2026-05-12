@extends('layouts.finanzas')
@section('title', 'Nuevo Ahorro')
@section('page-title', 'Nueva Meta de Ahorro')
@section('page-subtitle', 'Define una meta económica')

@section('content')
<div class="fin-form-card">
    <form method="POST" action="{{ route('ahorros.store') }}">
        @csrf
        <div class="mb-3">
            <label>Nombre de la meta</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" placeholder="Ej: Viaje, Emergencias, Auto..." required>
        </div>
        <div class="mb-3">
            <label>Monto meta ($)</label>
            <input type="number" name="monto_meta" class="form-control" value="{{ old('monto_meta') }}" step="0.01" min="0" placeholder="0.00" required>
        </div>
        <div class="mb-3">
            <label>Monto actual ahorrado ($)</label>
            <input type="number" name="monto_actual" class="form-control" value="{{ old('monto_actual', 0) }}" step="0.01" min="0" placeholder="0.00" required>
        </div>
        <div class="mb-4">
            <label>Estado</label>
            <select name="estado" class="form-select" required>
                <option value="en_progreso" {{ old('estado','en_progreso')=='en_progreso'?'selected':'' }}>En progreso</option>
                <option value="completado"  {{ old('estado')=='completado'?'selected':'' }}>Completado</option>
                <option value="cancelado"   {{ old('estado')=='cancelado'?'selected':'' }}>Cancelado</option>
            </select>
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn-guardar">Guardar ahorro</button>
            <a href="{{ route('dashboard') }}" class="btn-cancelar">Cancelar</a>
        </div>
    </form>
</div>
@endsection
