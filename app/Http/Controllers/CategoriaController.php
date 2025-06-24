<?php

namespace App\Http\Controllers;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function store(Request $request)
    {
        if (!auth()->user()?->is_admin) {
        abort(403);
        }
        $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias,nombre',
            'descripcion' => 'required|string|max:255',
        ]);
        Categoria::create($request->all());
        return redirect()->route('productos.index')->with('success', 'Categoría agregada exitosamente.');
    }
    public function edit(Categoria $categoria)
    {
        return view('productos.edit', compact('categoria'));
    }

    // Actualizar una categoría
    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias,nombre,' . $categoria->id,
            'descripcion' => 'required|string|max:255',
        ]);

        $categoria->update($request->all());

        return redirect()->route('productos.index')->with('success', 'Categoría actualizada exitosamente.');
    }

    // Eliminar una categoría
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return redirect()->route('productos.index')->with('success', 'Categoría eliminada exitosamente.');
    }
}
