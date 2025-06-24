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
    $request->validate([
        'valoracion' => 'required|integer|min:1|max:5',
        'comentario' => 'required|string|max:1000',
    ]);

    $producto->opiniones()->create([
        'user_id' => auth()->id(),
        'valoracion' => $request->valoracion,
        'comentario' => $request->comentario,
    ]);

    return redirect()->route('productos.show', $producto)->with('success', 'Opinión enviada');
}

}
