<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class delmes extends Model
{
    use HasFactory;

    protected $table = 'delmes';

    protected $fillable = [
        'nombre',
        'marca', 
        'descripcion',
        'precio_original',
        'precio_oferta',
        'stock',
        'categoria',
        'imagen',
        'activo',
        'destacado'
    ];

    protected $casts = [
        'precio_original' => 'decimal:2',
        'precio_oferta' => 'decimal:2',
        'activo' => 'boolean',
        'destacado' => 'boolean',
        'stock' => 'integer'
    ];

    // Constantes para categorías
    const CATEGORIAS = [
        'keratinas' => 'CREATINAS',
        'proteinas' => 'PROTEÍNAS', 
        'ganadores_peso' => 'GANADORES DE PESO',
        'quemadores_grasa' => 'QUEMADORES DE GRASA',
        'barras_energeticas' => 'BARRAS ENERGÉTICAS',
        'vitaminas_otros' => 'VITAMINAS Y OTROS'
    ];

    // Scopes para filtros
    public function scopeActivo($query)
    {
        return $query->where('activo', true);
    }

    public function scopeDestacado($query)
    {
        return $query->where('destacado', true);
    }

    public function scopeCategoria($query, $categoria)
    {
        return $query->where('categoria', $categoria);
    }

    public function scopeConStock($query)
    {
        return $query->where('stock', '>', 0);
    }

    // Accessor para mostrar el nombre de la categoría
    public function getCategoriaDisplayAttribute()
    {
        return self::CATEGORIAS[$this->categoria] ?? $this->categoria;
    }

    // Accessor para la URL de la imagen
    public function getImagenUrlAttribute()
    {
        if ($this->imagen) {
            return Storage::url($this->imagen);
        }
        return asset('images/placeholder-product.jpg'); 
    }

    // Accessor para calcular descuento
    public function getDescuentoPorcentajeAttribute()
    {
        if ($this->precio_original > $this->precio_oferta) {
            return round((($this->precio_original - $this->precio_oferta) / $this->precio_original) * 100);
        }
        return 0;
    }

    // Accessor para calcular porcentaje de stock (para la barra de stock)
    public function getPorcentajeStockAttribute()
    {
        // Asumiendo que el stock máximo es 100, ajusta según tus necesidades
        $stockMaximo = 100;
        return min(($this->stock / $stockMaximo) * 100, 100);
    }

    // Método estático para obtener productos por categoría con límite
    public static function getProductosPorCategoria($limite = 6)
    {
        $productos = [];
        
        foreach (array_keys(self::CATEGORIAS) as $categoria) {
            $productos[$categoria] = self::activo()
                ->categoria($categoria)
                ->destacado()
                ->conStock()
                ->orderBy('created_at', 'desc')
                ->limit($limite)
                ->get();
        }
        
        return $productos;
    }

    // Método para obtener productos de una categoría específica
    public static function getProductosCategoria($categoria, $limite = 6)
    {
        return self::activo()
            ->categoria($categoria) 
            ->destacado()
            ->conStock()
            ->orderBy('created_at', 'desc')
            ->limit($limite)
            ->get();
    }

    // Método para obtener todas las categorías con sus nombres
    public static function getCategoriasConNombres()
    {
        return self::CATEGORIAS;
    }

    // Boot method para eliminar imagen al eliminar producto
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($producto) {
            if ($producto->imagen && Storage::disk('public')->exists($producto->imagen)) {
                Storage::disk('public')->delete($producto->imagen);
            }
        });
    }
}