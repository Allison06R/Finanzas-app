@extends('layouts.finanzas')
@section('title', 'Editar Presupuesto')
@section('page-title', 'Editar Presupuesto')
@section('page-subtitle', 'Modifica los datos del presupuesto')

@section('content')
<div class="fin-form-card">
    <form method="POST" action="{{ route('presupuestos.update', $presupuesto) }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $presupuesto->nombre) }}" required>
        </div>
        <div class="mb-3">
            <label>Monto límite ($)</label>
            <input type="number" name="monto_limite" class="form-control" value="{{ old('monto_limite', $presupuesto->monto_limite) }}" step="0.01" min="0" required>
        </div>
        <div class="mb-3">
            <label>Mes</label>
            <select name="mes" class="form-select" required>
                @foreach(['1'=>'Enero','2'=>'Febrero','3'=>'Marzo','4'=>'Abril','5'=>'Mayo','6'=>'Junio','7'=>'Julio','8'=>'Agosto','9'=>'Septiembre','10'=>'Octubre','11'=>'Noviembre','12'=>'Diciembre'] as $num => $mes)
                <option value="{{ $num }}" {{ $presupuesto->mes==$num?'selected':'' }}>{{ $mes }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label>Año</label>
            <input type="number" name="anio" class="form-control" value="{{ old('anio', $presupuesto->anio) }}" min="2000" required>
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn-guardar">Actualizar</button>
            <a href="{{ route('presupuestos.index') }}" class="btn-cancelar">Cancelar</a>
        </div>
    </form>
</div>
@endsection
