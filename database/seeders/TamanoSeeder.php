<?php
// TamanoSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tamano;

class TamanoSeeder extends Seeder
{
    public function run()
    {
        $tamanos = [
            ['nombre' => '250g', 'descripcion' => 'Tamaño pequeño - 250 gramos'],
            ['nombre' => '500g', 'descripcion' => 'Tamaño mediano - 500 gramos'],
            ['nombre' => '1kg', 'descripcion' => 'Tamaño grande - 1 kilogramo'],
            ['nombre' => '2kg', 'descripcion' => 'Tamaño extra grande - 2 kilogramos'],
            ['nombre' => '5kg', 'descripcion' => 'Tamaño industrial - 5 kilogramos'],
            ['nombre' => 'S', 'descripcion' => 'Talla pequeña'],
            ['nombre' => 'M', 'descripcion' => 'Talla mediana'],
            ['nombre' => 'L', 'descripcion' => 'Talla grande'],
            ['nombre' => 'XL', 'descripcion' => 'Talla extra grande'],
        ];

        foreach ($tamanos as $tamano) {
            Tamano::create($tamano);
        }
    }
}