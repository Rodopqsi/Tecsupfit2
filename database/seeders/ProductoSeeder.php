<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Producto;
use App\Models\Stock;
use App\Models\delmes;
use App\Models\Categoria;
use App\Models\Marca;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $productos = [
            [
                'nombre' => 'iPhone 15 Pro',
                'precio_nuevo' => 999.99,
                'precio_antes' => 1199.99,
                'descripcion' => 'El último iPhone con tecnología avanzada',
                'categoria' => 'Electrónicos',
                'marca' => 'Apple',
                'stock_cantidad' => 50,
                'stock_minimo' => 10,
            ],
            [
                'nombre' => 'Galaxy S24',
                'precio_nuevo' => 899.99,
                'precio_antes' => null,
                'descripcion' => 'Smartphone Samsung de última generación',
                'categoria' => 'Electrónicos',
                'marca' => 'Samsung',
                'stock_cantidad' => 75,
                'stock_minimo' => 15,
            ],
            [
                'nombre' => 'Air Jordan 1',
                'precio_nuevo' => 159.99,
                'precio_antes' => 189.99,
                'descripcion' => 'Zapatillas deportivas clásicas',
                'categoria' => 'Deportes',
                'marca' => 'Nike',
                'stock_cantidad' => 30,
                'stock_minimo' => 5,
            ],
            [
                'nombre' => 'Ultraboost 22',
                'precio_nuevo' => 139.99,
                'precio_antes' => null,
                'descripcion' => 'Zapatillas para correr de alto rendimiento',
                'categoria' => 'Deportes',
                'marca' => 'Adidas',
                'stock_cantidad' => 25,
                'stock_minimo' => 8,
            ],
        ];

        foreach ($productos as $productoData) {
            // Crear stock
            $stock = Stock::create([
                'cantidad' => $productoData['stock_cantidad'],
                'stock_minimo' => $productoData['stock_minimo'],
            ]);

            // Buscar categoría y marca
            $categoria = Categoria::where('nombre', $productoData['categoria'])->first();
            $marca = Marca::where('nombre', $productoData['marca'])->first();

            // Crear producto
            Producto::create([
                'nombre' => $productoData['nombre'],
                'precio_nuevo' => $productoData['precio_nuevo'],
                'precio_antes' => $productoData['precio_antes'],
                'descripcion' => $productoData['descripcion'],
                'categoria_id' => $categoria->id,
                'marca_id' => $marca->id,
                'stock_id' => $stock->id,
                'es_delmes' => false,
                'ventas_mes' => 0,
            ]);
        }
    }
}
