<?php

namespace App\Http\Controllers;

use App\Models\Deuda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeudaController extends Controller
{
    public function index()
{
    if (auth()->user()->isAdmin()) {
        $deudas = Deuda::with('user')->get();
    } else {
        $deudas = Deuda::where('user_id', Auth::id())->get();
    }
    return view('deudas.index', compact('deudas'));
}

    public function create()
    {
        return view('deudas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'       => 'required|string|max:255',
            'monto_total'  => 'required|numeric|min:0',
            'monto_pagado' => 'required|numeric|min:0',
            'tipo'         => 'required',
            'estado'       => 'required'
        ]);

        Deuda::create([
            'user_id'      => Auth::id(),
            'nombre'       => $request->nombre,
            'monto_total'  => $request->monto_total,
            'monto_pagado' => $request->monto_pagado,
            'tipo'         => $request->tipo,
            'estado'       => $request->estado
        ]);

        $ruta = auth()->user()->isAdmin() ? 'deudas.index' : 'dashboard';
        return redirect()->route($ruta)->with('success', '¡Deuda registrada!');
    }

    public function edit(Deuda $deuda)
    {
        return view('deudas.edit', compact('deuda'));
    }

    public function update(Request $request, Deuda $deuda)
    {
        $request->validate([
            'nombre'       => 'required|string|max:255',
            'monto_total'  => 'required|numeric|min:0',
            'monto_pagado' => 'required|numeric|min:0',
            'tipo'         => 'required',
            'estado'       => 'required'
        ]);

        $deuda->update($request->all());
        $ruta = auth()->user()->isAdmin() ? 'deudas.index' : 'dashboard';
        return redirect()->route($ruta)->with('success', '¡Deuda actualizada!');
    }

    public function destroy(Deuda $deuda)
    {
        $deuda->delete();
        $ruta = auth()->user()->isAdmin() ? 'deudas.index' : 'dashboard';
        return redirect()->route($ruta)->with('success', '¡Deuda eliminada!');
    }
}