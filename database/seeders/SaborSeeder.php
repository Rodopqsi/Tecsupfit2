<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sabor;

class SaborSeeder extends Seeder
{
    public function run()
    {
        $sabores = [
            ['nombre' => 'Vainilla', 'descripcion' => 'Sabor a vainilla clásico'],
            ['nombre' => 'Chocolate', 'descripcion' => 'Sabor a chocolate'],
            ['nombre' => 'Fresa', 'descripcion' => 'Sabor a fresa'],
            ['nombre' => 'Cookies & Cream', 'descripcion' => 'Sabor a galletas con crema'],
            ['nombre' => 'Banana', 'descripcion' => 'Sabor a banana'],
            ['nombre' => 'Mango', 'descripcion' => 'Sabor tropical a mango'],
            ['nombre' => 'Sin sabor', 'descripcion' => 'Producto sin sabor agregado'],
            ['nombre' => 'Frutas del bosque', 'descripcion' => 'Mezcla de frutas rojas'],
            ['nombre' => 'Café', 'descripcion' => 'Sabor a café'],
            ['nombre' => 'Caramelo', 'descripcion' => 'Sabor dulce a caramelo'],
        ];

        foreach ($sabores as $sabor) {
            Sabor::create($sabor);
        }
    }
}