<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cupon extends Model
{
    protected $fillable = [
        'codigo', 'descuento', 'tipo_descuento', 'stock',
        'precio_minimo', 'fecha_inicio', 'fecha_fin', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


