<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GastoController;
use App\Http\Controllers\IngresoController;
use App\Http\Controllers\PresupuestoController;
use App\Http\Controllers\AhorroController;
use App\Http\Controllers\DeudaController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('gastos', GastoController::class);
    Route::resource('ingresos', IngresoController::class);
    Route::resource('presupuestos', PresupuestoController::class);
    Route::resource('ahorros', AhorroController::class);
    Route::resource('deudas', DeudaController::class);
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/usuario/{user}', [AdminController::class, 'verUsuario'])->name('usuario');
    Route::delete('/usuario/{user}', [AdminController::class, 'eliminarUsuario'])->name('eliminarUsuario');
    Route::post('/usuario/{user}/bloquear', [AdminController::class, 'bloquearUsuario'])->name('bloquearUsuario');
    Route::post('/usuario/{user}/desbloquear', [AdminController::class, 'desbloquearUsuario'])->name('desbloquearUsuario');
    Route::delete('/gasto/{gasto}', [AdminController::class, 'eliminarGasto'])->name('eliminarGasto');
    Route::delete('/ingreso/{ingreso}', [AdminController::class, 'eliminarIngreso'])->name('eliminarIngreso');
});

require __DIR__.'/auth.php';