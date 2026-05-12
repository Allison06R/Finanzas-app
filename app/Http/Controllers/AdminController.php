<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Gasto;
use App\Models\Ingreso;
use App\Models\Presupuesto;
use App\Models\Ahorro;
use App\Models\Deuda;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Ver todos los usuarios
    public function index()
    {
        $usuarios = User::all();
        return view('admin.index', compact('usuarios'));
    }

    // Ver registros de un usuario específico
    public function verUsuario(User $user)
    {
        $gastos       = Gasto::where('user_id', $user->id)->get();
        $ingresos     = Ingreso::where('user_id', $user->id)->get();
        $presupuestos = Presupuesto::where('user_id', $user->id)->get();
        $ahorros      = Ahorro::where('user_id', $user->id)->get();
        $deudas       = Deuda::where('user_id', $user->id)->get();

        return view('admin.usuario', compact('user', 'gastos', 'ingresos', 'presupuestos', 'ahorros', 'deudas'));
    }

    // Eliminar usuario
    public function eliminarUsuario(User $user)
    {
        $user->delete();
        return redirect()->route('admin.index')->with('success', '¡Usuario eliminado!');
    }

    // Bloquear usuario (POO)
    public function bloquearUsuario(User $user)
    {
        $user->bloqueado = true;
        $user->save();
        return redirect()->route('admin.index')->with('success', '¡Usuario bloqueado!');
    }

    // Desbloquear usuario (POO)
    public function desbloquearUsuario(User $user)
    {
        $user->bloqueado = false;
        $user->save();
        return redirect()->route('admin.index')->with('success', '¡Usuario desbloqueado!');
    }

    // Eliminar gasto de cualquier usuario
    public function eliminarGasto(Gasto $gasto)
    {
        $userId = $gasto->user_id;
        $gasto->delete();
        return redirect()->route('admin.usuario', $userId)->with('success', '¡Gasto eliminado!');
    }

    // Eliminar ingreso de cualquier usuario
    public function eliminarIngreso(Ingreso $ingreso)
    {
        $userId = $ingreso->user_id;
        $ingreso->delete();
        return redirect()->route('admin.usuario', $userId)->with('success', '¡Ingreso eliminado!');
    }
}