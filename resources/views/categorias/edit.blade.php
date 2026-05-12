<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categoría - FinanzasApp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f6f4; }
        .sidebar { background-color: #0F6E56; min-height: 100vh; padding: 1.5rem 1rem; }
        .sidebar .logo { color: #9FE1CB; font-size: 20px; font-weight: 700; margin-bottom: 2rem; }
        .logo-icon { background: #1D9E75; color: white; padding: 4px 10px; border-radius: 8px; margin-right: 6px; }
        .nav-link { color: #9FE1CB; border-radius: 8px; padding: 10px 14px; display: flex; align-items: center; gap: 10px; font-size: 14px; }
        .nav-link:hover, .nav-link.active { background: #1D9E75; color: #E1F5EE; }
        .btn-verde { background: #0F6E56; color: white; border: none; border-radius: 8px; padding: 8px 18px; }
        .btn-verde:hover { background: #085041; color: white; }
        .form-control:focus, .form-select:focus { border-color: #1D9E75; box-shadow: 0 0 0 3px rgba(29,158,117,0.2); }
        .topbar { background: white; border-bottom: 1px solid #e0e0e0; padding: 1rem 1.5rem; }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 sidebar">
            <div class="logo"><span class="logo-icon">$</span>FinanzasApp</div>
            <nav class="d-flex flex-column gap-1">
                <a href="/dashboard" class="nav-link">▦ Dashboard</a>
                <a href="/ingresos" class="nav-link">↑ Ingresos</a>
                <a href="/gastos" class="nav-link">↓ Gastos</a>
                <a href="/categorias" class="nav-link active">⊞ Categorías</a>
                <a href="/presupuestos" class="nav-link">◎ Presupuestos</a>
                <a href="/ahorros" class="nav-link">◇ Ahorros</a>
                <a href="/deudas" class="nav-link">⊖ Deudas</a>
                <div class="mt-auto pt-4">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link border-0 bg-transparent w-100 text-start">← Cerrar sesión</button>
                    </form>
                </div>
            </nav>
        </div>

        <div class="col-md-10 p-0">
            <div class="topbar d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0">Editar Categoría</h5>
                    <small class="text-muted">Modifica los datos de la categoría</small>
                </div>
                <a href="{{ route('categorias.index') }}" class="btn btn-outline-secondary btn-sm">← Volver</a>
            </div>

            <div class="p-4">
                <div class="bg-white rounded-3 p-4" style="max-width: 500px;">
                    @if($errors->any())
                        <div class="alert alert-danger rounded-3">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('categorias.update', $categoria) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $categoria->nombre) }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tipo</label>
                            <select name="tipo" class="form-select" required>
                                <option value="ingreso" {{ $categoria->tipo == 'ingreso' ? 'selected' : '' }}>Ingreso</option>
                                <option value="gasto" {{ $categoria->tipo == 'gasto' ? 'selected' : '' }}>Gasto</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Color</label>
                            <input type="color" name="color" class="form-control form-control-color" value="{{ old('color', $categoria->color) }}" required>
                        </div>
                        <button type="submit" class="btn-verde w-100 py-2">Actualizar categoría</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>