<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reclamacion extends Model
{
    use HasFactory;

    protected $table = 'reclamaciones';

    protected $fillable = [
        'tipo_documento',
        'numero_documento',
        'telefono',
        'nombres',
        'apellidos',
        'email',
        'direccion',
        'fecha_compra',
        'tipo_reclamo',
        'producto',
        'detalle_reclamo',
        'pedido_cliente',
        'estado',
        'respuesta_empresa',
        'fecha_respuesta'
    ];

    protected $casts = [
        'fecha_compra' => 'date',
        'fecha_respuesta' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Scopes
    public function scopePendientes($query)
    {
        return $query->where('estado', 'pendiente');
    }

    public function scopeRecientes($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    // Accessors
    public function getNombreCompletoAttribute()
    {
        return $this->nombres . ' ' . $this->apellidos;
    }

    public function getFechaFormateadaAttribute()
    {
        return $this->created_at->format('d/m/Y H:i');
    }

    public function getEstadoBadgeAttribute()
    {
        $badges = [
            'pendiente' => 'bg-warning text-dark',
            'en_proceso' => 'bg-info text-white',
            'resuelto' => 'bg-success text-white',
            'cerrado' => 'bg-secondary text-white'
        ];
        
        return $badges[$this->estado] ?? 'bg-secondary';
    }
    
    public function getTipoReclamoBadgeAttribute()
    {
        return $this->tipo_reclamo === 'reclamo' ? 'bg-danger' : 'bg-warning';
    }
    public function productos()
{
    return $this->hasManyThrough(
        \App\Models\OrdenProducto::class,
        \App\Models\Orden::class,
        'id',           // Foreign key on OrdenProducto
        'orden_id',     // Foreign key on Orden
        'orden_id',     // Local key on Reclamacion
        'id'            // Local key on Orden
    );
}


}