<?php

namespace App\Http\Controllers;

use App\Models\Presupuesto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresupuestoController extends Controller
{
    public function index()
{
    if (auth()->user()->isAdmin()) {
        $presupuestos = Presupuesto::with('user')->get();
    } else {
        $presupuestos = Presupuesto::where('user_id', Auth::id())->get();
    }
    return view('presupuestos.index', compact('presupuestos'));
}
    public function create()
    {
        return view('presupuestos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'       => 'required|string|max:255',
            'monto_limite' => 'required|numeric|min:0',
            'mes'          => 'required|integer|min:1|max:12',
            'anio'         => 'required|integer|min:2000'
        ]);

        Presupuesto::create([
            'user_id'      => Auth::id(),
            'nombre'       => $request->nombre,
            'monto_limite' => $request->monto_limite,
            'mes'          => $request->mes,
            'anio'         => $request->anio
        ]);

        $ruta = auth()->user()->isAdmin() ? 'presupuestos.index' : 'dashboard';
        return redirect()->route($ruta)->with('success', '¡Presupuesto registrado!');
    }

    public function edit(Presupuesto $presupuesto)
    {
        return view('presupuestos.edit', compact('presupuesto'));
    }

    public function update(Request $request, Presupuesto $presupuesto)
    {
        $request->validate([
            'nombre'       => 'required|string|max:255',
            'monto_limite' => 'required|numeric|min:0',
            'mes'          => 'required|integer|min:1|max:12',
            'anio'         => 'required|integer|min:2000'
        ]);

        $presupuesto->update($request->all());
        $ruta = auth()->user()->isAdmin() ? 'presupuestos.index' : 'dashboard';
        return redirect()->route($ruta)->with('success', '¡Presupuesto actualizado!');
    }

    public function destroy(Presupuesto $presupuesto)
    {
        $presupuesto->delete();
        $ruta = auth()->user()->isAdmin() ? 'presupuestos.index' : 'dashboard';
        return redirect()->route($ruta)->with('success', '¡Presupuesto eliminado!');
    }
}