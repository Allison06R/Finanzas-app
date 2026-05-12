<?php

namespace App\Http\Controllers;

use App\Models\Ahorro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AhorroController extends Controller
{
    public function index()
{
    if (auth()->user()->isAdmin()) {
        $ahorros = Ahorro::with('user')->get();
    } else {
        $ahorros = Ahorro::where('user_id', Auth::id())->get();
    }
    return view('ahorros.index', compact('ahorros'));
}
    public function create()
    {
        return view('ahorros.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'       => 'required|string|max:255',
            'monto_meta'   => 'required|numeric|min:0',
            'monto_actual' => 'required|numeric|min:0',
            'estado'       => 'required'
        ]);

        Ahorro::create([
            'user_id'      => Auth::id(),
            'nombre'       => $request->nombre,
            'monto_meta'   => $request->monto_meta,
            'monto_actual' => $request->monto_actual,
            'estado'       => $request->estado
        ]);

        $ruta = auth()->user()->isAdmin() ? 'ahorros.index' : 'dashboard';
        return redirect()->route($ruta)->with('success', '¡Ahorro registrado!');
    }

    public function edit(Ahorro $ahorro)
    {
        return view('ahorros.edit', compact('ahorro'));
    }

    public function update(Request $request, Ahorro $ahorro)
    {
        $request->validate([
            'nombre'       => 'required|string|max:255',
            'monto_meta'   => 'required|numeric|min:0',
            'monto_actual' => 'required|numeric|min:0',
            'estado'       => 'required'
        ]);

        $ahorro->update($request->all());
        $ruta = auth()->user()->isAdmin() ? 'ahorros.index' : 'dashboard';
        return redirect()->route($ruta)->with('success', '¡Ahorro actualizado!');
    }

    public function destroy(Ahorro $ahorro)
    {
        $ahorro->delete();
        $ruta = auth()->user()->isAdmin() ? 'ahorros.index' : 'dashboard';
        return redirect()->route($ruta)->with('success', '¡Ahorro eliminado!');
    }
}