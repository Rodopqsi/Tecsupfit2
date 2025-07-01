<?php

namespace App\Http\Controllers;

use App\Models\Objetivo;
use App\Models\Producto;
use Illuminate\Http\Request;

class ObjetivoController extends Controller
{
    // Este método muestra todos los objetivos con sus productos relacionados
    public function index()
    {
        $objetivos = Objetivo::with('productos')->get(); // Trae los objetivos y sus productos
        return view('objetivos', compact('objetivos')); // Manda los datos a la vista
    }

    // Este método guarda un nuevo objetivo
    public function store(Request $request)
    {
        // Valida que el nombre esté, sea string, no se pase de largo y no se repita
        $request->validate([
            'nombre' => 'required|string|max:255|unique:objetivos,nombre',
            'descripcion' => 'nullable|string'
        ]);

        Objetivo::create($request->all()); // Crea el objetivo con lo que mandaron
        return redirect()->route('productos.index')->with('success', 'Objetivo creado correctamente.'); // Redirige con mensajito
    }

    // Este método actualiza un objetivo ya existente
    public function update(Request $request, Objetivo $objetivo)
    {
        // Valida igual que arriba, pero permite el mismo nombre si es el mismo objetivo
        $request->validate([
            'nombre' => 'required|string|max:255|unique:objetivos,nombre,' . $objetivo->id,
            'descripcion' => 'nullable|string'
        ]);

        $objetivo->update($request->all()); // Actualiza el objetivo con lo nuevo
        return redirect()->route('productos.index')->with('success', 'Objetivo actualizado correctamente.'); // Redirige con mensajito
    }

    // Este método elimina un objetivo
    public function destroy(Objetivo $objetivo)
    {
        $objetivo->delete(); // Borra el objetivo
        return redirect()->route('productos.index')->with('success', 'Objetivo eliminado correctamente.'); // Redirige con mensajito
    }
}

