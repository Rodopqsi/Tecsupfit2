<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = ['cantidad', 'stock_minimo'];

    public function producto()
    {
        return $this->hasOne(Producto::class);
    }

    public function getStockPercentageAttribute()
    {
        $max = 100; // Stock máximo para el cálculo del porcentaje
        return min(($this->cantidad / $max) * 100, 100);
    }
}