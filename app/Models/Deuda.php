<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Deuda extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nombre',
        'monto_total',
        'monto_pagado',
        'tipo',
        'estado'
    ];

    protected $casts = [
        'monto_total'  => 'decimal:2',
        'monto_pagado' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}