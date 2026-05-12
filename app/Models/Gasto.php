<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gasto extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'descripcion',
        'monto',
        'fecha',
        'tipo'
    ];

    protected $casts = [
        'fecha' => 'date',
        'monto' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}