<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Marca;

class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $marcas = [
            ['nombre' => 'Samsung'],
            ['nombre' => 'Apple'],
            ['nombre' => 'Nike'],
            ['nombre' => 'Adidas'],
            ['nombre' => 'Sony'],
            ['nombre' => 'LG'],
            ['nombre' => 'Zara'],
            ['nombre' => 'H&M'],
        ];

        foreach ($marcas as $marca) {
            Marca::create($marca);
        }
    }
}
