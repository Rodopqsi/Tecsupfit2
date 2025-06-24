<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Objetivo;

class ObjetivoSeeder extends Seeder
{
    public function run()
    {
        $objetivos = [
            [
                'nombre' => 'Bajar de peso',
                'descripcion' => 'Productos para reducir peso corporal'
            ],
            [
                'nombre' => 'Subir de peso',
                'descripcion' => 'Productos para aumentar masa corporal'
            ],
            [
                'nombre' => 'Definir músculos',
                'descripcion' => 'Productos para tonificar y definir musculatura'
            ],
            [
                'nombre' => 'Ganar masa muscular',
                'descripcion' => 'Productos para incrementar masa muscular'
            ],
            [
                'nombre' => 'Rendimiento deportivo',
                'descripcion' => 'Productos para mejorar el rendimiento atlético'
            ],
            [
                'nombre' => 'Recuperación',
                'descripcion' => 'Productos para acelerar la recuperación post-entrenamiento'
            ],
            [
                'nombre' => 'Salud general',
                'descripcion' => 'Productos para mantener bienestar general'
            ]
        ];

        foreach ($objetivos as $objetivo) {
            Objetivo::create($objetivo);
        }
    }
}