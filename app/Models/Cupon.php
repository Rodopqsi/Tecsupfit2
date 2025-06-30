<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cupon extends Model
{
    protected $table = 'cupones';
    protected $fillable = [
        'codigo', 'descuento', 'tipo_descuento', 'stock',
        'precio_minimo', 'fecha_inicio', 'fecha_fin', 'user_id','imagen'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected function casts(): array
    {
        return [
            'fecha_inicio' => 'date',
            'fecha_fin' => 'date',
        ];
    }

}


