@extends('layouts.finanzas')
@section('title', 'Nuevo Presupuesto')
@section('page-title', 'Nuevo Presupuesto')
@section('page-subtitle', 'Define un límite de gasto mensual')

@section('content')
<div class="fin-form-card">
    <form method="POST" action="{{ route('presupuestos.store') }}">
        @csrf
        <div class="mb-3">
            <label>Nombre del presupuesto</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" placeholder="Ej: Comida, Transporte..." required>
        </div>
        <div class="mb-3">
            <label>Monto límite ($)</label>
            <input type="number" name="monto_limite" class="form-control" value="{{ old('monto_limite') }}" step="0.01" min="0" placeholder="0.00" required>
        </div>
        <div class="mb-3">
            <label>Mes</label>
            <select name="mes" class="form-select" required>
                <option value="">Selecciona...</option>
                @foreach(['1'=>'Enero','2'=>'Febrero','3'=>'Marzo','4'=>'Abril','5'=>'Mayo','6'=>'Junio','7'=>'Julio','8'=>'Agosto','9'=>'Septiembre','10'=>'Octubre','11'=>'Noviembre','12'=>'Diciembre'] as $num => $mes)
                <option value="{{ $num }}" {{ old('mes')==$num?'selected':'' }}>{{ $mes }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label>Año</label>
            <input type="number" name="anio" class="form-control" value="{{ old('anio', date('Y')) }}" min="2000" required>
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn-guardar">Guardar presupuesto</button>
            <a href="{{ route('dashboard') }}" class="btn-cancelar">Cancelar</a>
        </div>
    </form>
</div>
@endsection
