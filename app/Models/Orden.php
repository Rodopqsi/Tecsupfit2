<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    protected $table = 'ordenes';

    protected $fillable = [
        'user_id',
        'nombre',
        'apellidos',
        'dni',
        'region',
        'distrito',
        'direccion',
        'departamento',
        'telefono',
        'email',
        'notas',
        'monto_total',
        'estado_pago',
        'paypal_order_id',
    ];

    public function productos()
    {
        return $this->hasMany(OrdenProducto::class);
    }
}