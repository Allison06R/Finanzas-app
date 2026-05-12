<?php

namespace App\Http\Controllers;

use App\Models\Ingreso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IngresoController extends Controller
{
    public function index()
{
    if (auth()->user()->isAdmin()) {
        $ingresos = Ingreso::with('user')->orderBy('fecha', 'desc')->get();
    } else {
        $ingresos = Ingreso::where('user_id', Auth::id())->orderBy('fecha', 'desc')->get();
    }
    return view('ingresos.index', compact('ingresos'));
}

    public function create()
    {
        return view('ingresos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'monto'       => 'required|numeric|min:0',
            'fecha'       => 'required|date',
            'tipo'        => 'required'
        ]);

        Ingreso::create([
            'user_id'     => Auth::id(),
            'descripcion' => $request->descripcion,
            'monto'       => $request->monto,
            'fecha'       => $request->fecha,
            'tipo'        => $request->tipo
        ]);

        $ruta = auth()->user()->isAdmin() ? 'ingresos.index' : 'dashboard';
        return redirect()->route($ruta)->with('success', '¡Ingreso registrado!');
    }

    public function edit(Ingreso $ingreso)
    {
        return view('ingresos.edit', compact('ingreso'));
    }

    public function update(Request $request, Ingreso $ingreso)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'monto'       => 'required|numeric|min:0',
            'fecha'       => 'required|date',
            'tipo'        => 'required'
        ]);

        $ingreso->update($request->all());
        $ruta = auth()->user()->isAdmin() ? 'ingresos.index' : 'dashboard';
        return redirect()->route($ruta)->with('success', '¡Ingreso actualizado!');
    }

    public function destroy(Ingreso $ingreso)
    {
        $ingreso->delete();
        $ruta = auth()->user()->isAdmin() ? 'ingresos.index' : 'dashboard';
        return redirect()->route($ruta)->with('success', '¡Ingreso eliminado!');
    }
}