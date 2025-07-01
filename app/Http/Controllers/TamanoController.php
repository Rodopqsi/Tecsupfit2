<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tamano;

class TamanoController extends Controller
{
    // Esta función guarda un nuevo tamaño
    public function store(Request $request)
    {
        // Solo los admins pueden hacer esto, si no eres admin, chao
        if (!auth()->user()?->is_admin) {
            abort(403);
        }
        // Validamos que el nombre sea único y que la descripción no sea muy larga
        $request->validate([
            'nombre' => 'required|string|max:255|unique:tamanos,nombre',
            'descripcion' => 'nullable|string|max:500',
        ]);

        // Guardamos todo lo que venga del request
        Tamano::create($request->all());

        // Redirigimos con mensajito de éxito
        return redirect()->route('productos.index')->with('success', 'Tamaño agregado exitosamente.');
    }

    // Esta función actualiza un tamaño existente
    public function update(Request $request, Tamano $tamano)
    {
        // Validamos igual que en store, pero permitimos el mismo nombre si es el mismo registro
        $request->validate([
            'nombre' => 'required|string|max:255|unique:tamanos,nombre,' . $tamano->id,
            'descripcion' => 'nullable|string|max:500',
        ]);

        // Actualizamos el tamaño con los nuevos datos
        $tamano->update($request->all());

        // Redirigimos con mensajito de éxito
        return redirect()->route('productos.index')->with('success', 'Tamaño actualizado exitosamente.');
    }

    // Esta función elimina un tamaño
    public function destroy(Tamano $tamano)
    {
        // Solo los admins pueden borrar, si no eres admin, ni lo intentes
        if (!auth()->user()?->is_admin) {
            abort(403);
        }
        // Borramos el tamaño
        $tamano->delete();

        // Redirigimos con mensajito de éxito
        return redirect()->route('productos.index')->with('success', 'Tamaño eliminado exitosamente.');
    }
}

