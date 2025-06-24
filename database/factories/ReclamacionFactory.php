<?php

namespace Database\Factories;

use App\Models\Reclamacion;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReclamacionFactory extends Factory
{
    protected $model = Reclamacion::class;

    public function definition()
    {
        return [
            'tipo_documento' => $this->faker->randomElement(['dni', 'ce', 'pasaporte']),
            'numero_documento' => $this->faker->numerify('########'),
            'telefono' => $this->faker->numerify('#########'),
            'nombres' => $this->faker->firstName(),
            'apellidos' => $this->faker->lastName() . ' ' . $this->faker->lastName(),
            'email' => $this->faker->email(),
            'direccion' => $this->faker->address(),
            'fecha_compra' => $this->faker->dateTimeBetween('-3 months', 'now'),
            'tipo_reclamo' => $this->faker->randomElement(['reclamo', 'queja']),
            'producto' => $this->faker->randomElement(['proteinas', 'creatinas', 'preworkout', 'aminoacidos']),
            'detalle_reclamo' => $this->faker->paragraph(3),
            'pedido_cliente' => $this->faker->paragraph(2),
            'estado' => $this->faker->randomElement(['pendiente', 'en_proceso', 'resuelto']),
        ];
    }
}