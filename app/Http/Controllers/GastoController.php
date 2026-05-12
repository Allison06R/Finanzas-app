<?php

namespace App\Http\Controllers;

use App\Models\Gasto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GastoController extends Controller
{
    public function index()
{
    if (auth()->user()->isAdmin()) {
        $gastos = Gasto::with('user')->orderBy('fecha', 'desc')->get();
    } else {
        $gastos = Gasto::where('user_id', Auth::id())->orderBy('fecha', 'desc')->get();
    }
    return view('gastos.index', compact('gastos'));
}
    public function create()
    {
        return view('gastos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'monto'       => 'required|numeric|min:0',
            'fecha'       => 'required|date',
            'tipo'        => 'required'
        ]);

        Gasto::create([
            'user_id'     => Auth::id(),
            'descripcion' => $request->descripcion,
            'monto'       => $request->monto,
            'fecha'       => $request->fecha,
            'tipo'        => $request->tipo
        ]);

        $ruta = auth()->user()->isAdmin() ? 'gastos.index' : 'dashboard';
        return redirect()->route($ruta)->with('success', '¡Gasto registrado!');
    }

    public function edit(Gasto $gasto)
    {
        return view('gastos.edit', compact('gasto'));
    }

    public function update(Request $request, Gasto $gasto)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'monto'       => 'required|numeric|min:0',
            'fecha'       => 'required|date',
            'tipo'        => 'required'
        ]);

        $gasto->update($request->all());
        $ruta = auth()->user()->isAdmin() ? 'gastos.index' : 'dashboard';
        return redirect()->route($ruta)->with('success', '¡Gasto actualizado!');
    }

    public function destroy(Gasto $gasto)
    {
        $gasto->delete();
        $ruta = auth()->user()->isAdmin() ? 'gastos.index' : 'dashboard';
        return redirect()->route($ruta)->with('success', '¡Gasto eliminado!');
    }
}