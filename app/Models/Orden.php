<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    protected $table = 'ordenes'; // Especificamos la tabla (por si acaso)

    protected $fillable = [
        'nombre', 'apellidos', 'dni', 'region', 'distrito', 'direccion',
        'departamento', 'telefono', 'email', 'notas', 'total'
    ];

    public function productos()
    {
        return $this->hasMany(OrdenProducto::class);
    }
}
