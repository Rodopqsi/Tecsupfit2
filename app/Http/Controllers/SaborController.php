<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sabor;

class SaborController extends Controller
{
    public function store(Request $request)
    {
        if (!auth()->user()?->is_admin) {
        abort(403);
        }
        $request->validate([
            'nombre' => 'required|string|max:255|unique:sabores,nombre',
        ]);

        Sabor::create($request->all());

        return redirect()->route('productos.index')->with('success', 'Sabor agregado exitosamente.');
    }

    public function update(Request $request, Sabor $sabor)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:sabores,nombre,' . $sabor->id,
        ]);

        $sabor->update($request->all());

        return redirect()->route('productos.index')->with('success', 'Sabor actualizado exitosamente.');
    }

    public function destroy(Sabor $sabor)
    {
        if (!auth()->user()?->is_admin) {
        abort(403);
        }
        $sabor->delete();

        return redirect()->route('productos.index')->with('success', 'Sabor eliminado exitosamente.');
    }
}
