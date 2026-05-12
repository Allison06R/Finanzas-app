@extends('layouts.finanzas')
@section('title', 'Panel Admin - FinanzasApp')
@section('page-title', 'Panel de Administrador')
@section('page-subtitle', 'Gestión de usuarios de la plataforma')

@section('content')
<div class="fin-card">
    <div class="fin-card-header">
        <span class="fin-card-title">👥 Usuarios registrados</span>
        <span style="font-size:12px; color:var(--muted);">{{ $usuarios->count() }} usuarios</span>
    </div>

    <table class="fin-table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($usuarios as $usuario)
            <tr>
                <td style="font-weight:500;">{{ $usuario->name }}</td>
                <td style="color:var(--muted); font-size:12px;">{{ $usuario->email }}</td>
                <td>
                    @if($usuario->isAdmin())
                        <span class="badge-verde">Admin</span>
                    @else
                        <span class="badge-gris">Usuario</span>
                    @endif
                </td>
                <td>
                    @if($usuario->bloqueado)
                        <span class="badge-rojo">🔒 Bloqueado</span>
                    @else
                        <span class="badge-verde">✓ Activo</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.usuario', $usuario) }}" class="btn-accion">👁 Ver</a>

                    @if(!$usuario->isAdmin())
                        @if($usuario->bloqueado)
                        <form action="{{ route('admin.desbloquearUsuario', $usuario) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn-accion" style="color:var(--verde);">🔓 Desbloquear</button>
                        </form>
                        @else
                        <form action="{{ route('admin.bloquearUsuario', $usuario) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn-accion danger" onclick="return confirm('¿Bloquear a {{ $usuario->name }}?')">🔒 Bloquear</button>
                        </form>
                        @endif

                        <form action="{{ route('admin.eliminarUsuario', $usuario) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-accion danger"
                                onclick="return confirm('¿Eliminar permanentemente a {{ $usuario->name }}?')">🗑 Eliminar</button>
                        </form>
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="5"><div class="empty-state">No hay usuarios registrados.</div></td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
