<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ahorro extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nombre',
        'monto_meta',
        'monto_actual',
        'estado'
    ];

    protected $casts = [
        'monto_meta'    => 'decimal:2',
        'monto_actual'  => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}