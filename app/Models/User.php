<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
    'name',
    'email',
    'password',
    'rol',
    'bloqueado',
    'intentos_fallidos',
    'bloqueado_hasta'
];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
    'password'       => 'hashed',
    'bloqueado'      => 'boolean',
    'bloqueado_hasta' => 'datetime',
];

    // POO - Método propio de la clase
    public function isAdmin()
    {
        return $this->rol === 'admin';
    }

    // Relaciones POO
    public function gastos()
    {
        return $this->hasMany(Gasto::class);
    }

    public function ingresos()
    {
        return $this->hasMany(Ingreso::class);
    }

    public function presupuestos()
    {
        return $this->hasMany(Presupuesto::class);
    }

    public function ahorros()
    {
        return $this->hasMany(Ahorro::class);
    }

    public function deudas()
    {
        return $this->hasMany(Deuda::class);
    }
}
