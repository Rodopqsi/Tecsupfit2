<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Objetivo;
use App\Models\Tamano;
use App\Models\Sabor;
use App\Models\Stock;

class OpinionController extends Controller
{
    public function store(Request $request, Producto $producto)
    {
        // Validamos que el usuario haya puesto una valoración y un comentario decente
        $request->validate([
            'valoracion' => 'required|integer|min:1|max:5', // Tiene que ser un número entre 1 y 5 sí o sí
            'comentario' => 'required|string|max:1000', // El comentario no puede estar vacío ni ser larguísimo
        ]);

        // Guardamos la opinión del usuario para este producto
        $producto->opiniones()->create([
            'user_id' => auth()->id(), // Guardamos quién dejó la opinión
            'valoracion' => $request->valoracion, // La nota que puso
            'comentario' => $request->comentario, // El comentario que escribió
        ]);

        // Redirigimos de vuelta al producto con un mensajito de éxito
        return redirect()->route('productos.show', $producto)->with('success', 'Opinión enviada');
    }
}
