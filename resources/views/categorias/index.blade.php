<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías - FinanzasApp</title>
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
        .topbar { background: white; border-bottom: 1px solid #e0e0e0; padding: 1rem 1.5rem; }
        .badge-ingreso { background: #E1F5EE; color: #0F6E56; font-size: 11px; padding: 3px 10px; border-radius: 10px; }
        .badge-gasto { background: #FCEBEB; color: #A32D2D; font-size: 11px; padding: 3px 10px; border-radius: 10px; }
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
                    <h5 class="mb-0">Categorías</h5>
                    <small class="text-muted">Administra tus categorías</small>
                </div>
                <a href="{{ route('categorias.create') }}" class="btn-verde">+ Nueva categoría</a>
            </div>

            <div class="p-4">
                @if(session('success'))
                    <div class="alert alert-success rounded-3">{{ session('success') }}</div>
                @endif

                <div class="bg-white rounded-3 p-3">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Color</th>
                                <th>Nombre</th>
                                <th>Tipo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categorias as $categoria)
                            <tr>
                                <td>
                                    <div style="width:24px; height:24px; border-radius:50%; background:{{ $categoria->color }};"></div>
                                </td>
                                <td>{{ $categoria->nombre }}</td>
                                <td>
                                    @if($categoria->tipo == 'ingreso')
                                        <span class="badge-ingreso">Ingreso</span>
                                    @else
                                        <span class="badge-gasto">Gasto</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('categorias.edit', $categoria) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                                    <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Eliminar esta categoría?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">No hay categorías aún.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>