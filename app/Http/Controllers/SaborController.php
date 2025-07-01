<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sabor;

class SaborController extends Controller
{
    // Esta función guarda un nuevo sabor
    public function store(Request $request)
    {
        // Solo los admins pueden agregar sabores, si no eres admin, chao
        if (!auth()->user()?->is_admin) {
            abort(403);
        }
        // Validamos que el nombre venga bien y no se repita
        $request->validate([
            'nombre' => 'required|string|max:255|unique:sabores,nombre',
        ]);

        // Guardamos el sabor en la base de datos
        Sabor::create($request->all());

        // Redirigimos con mensajito de éxito
        return redirect()->route('productos.index')->with('success', 'Sabor agregado exitosamente.');
    }

    // Esta función actualiza un sabor existente
    public function update(Request $request, Sabor $sabor)
    {
        // Validamos el nombre, pero permitimos que el mismo sabor conserve su nombre
        $request->validate([
            'nombre' => 'required|string|max:255|unique:sabores,nombre,' . $sabor->id,
        ]);

        // Actualizamos el sabor con los nuevos datos
        $sabor->update($request->all());

        // Redirigimos con mensajito de éxito
        return redirect()->route('productos.index')->with('success', 'Sabor actualizado exitosamente.');
    }

    // Esta función elimina un sabor
    public function destroy(Sabor $sabor)
    {
        // Solo los admins pueden borrar sabores, si no eres admin, fuera
        if (!auth()->user()?->is_admin) {
            abort(403);
        }
        // Borramos el sabor
        $sabor->delete();

        // Redirigimos con mensajito de éxito
        return redirect()->route('productos.index')->with('success', 'Sabor eliminado exitosamente.');
    }
}

