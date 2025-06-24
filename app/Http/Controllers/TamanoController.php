<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tamano;

class TamanoController extends Controller
{
    public function store(Request $request)
    {
        if (!auth()->user()?->is_admin) {
        abort(403);
        }
        $request->validate([
            'nombre' => 'required|string|max:255|unique:tamanos,nombre',
            'descripcion' => 'nullable|string|max:500',
        ]);

        Tamano::create($request->all());

        return redirect()->route('productos.index')->with('success', 'Tamaño agregado exitosamente.');
    }

    public function update(Request $request, Tamano $tamano)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:tamanos,nombre,' . $tamano->id,
            'descripcion' => 'nullable|string|max:500',
        ]);

        $tamano->update($request->all());

        return redirect()->route('productos.index')->with('success', 'Tamaño actualizado exitosamente.');
    }

    public function destroy(Tamano $tamano)
    {
        if (!auth()->user()?->is_admin) {
        abort(403);
        }
        $tamano->delete();

        return redirect()->route('productos.index')->with('success', 'Tamaño eliminado exitosamente.');
    }
}
