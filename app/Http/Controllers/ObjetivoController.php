<?php

namespace App\Http\Controllers;

use App\Models\Objetivo;
use App\Models\Producto;
use Illuminate\Http\Request;

class ObjetivoController extends Controller
{
    public function index()
    {
        $objetivos = Objetivo::with('productos')->get();
        return view('objetivos', compact('objetivos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:objetivos,nombre',
            'descripcion' => 'nullable|string'
        ]);

        Objetivo::create($request->all());
        return redirect()->route('productos.index')->with('success', 'Objetivo creado correctamente.');
    }

    public function update(Request $request, Objetivo $objetivo)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:objetivos,nombre,' . $objetivo->id,
            'descripcion' => 'nullable|string'
        ]);

        $objetivo->update($request->all());
        return redirect()->route('productos.index')->with('success', 'Objetivo actualizado correctamente.');
    }

    public function destroy(Objetivo $objetivo)
    {
        $objetivo->delete();
        return redirect()->route('productos.index')->with('success', 'Objetivo eliminado correctamente.');
    }
}
