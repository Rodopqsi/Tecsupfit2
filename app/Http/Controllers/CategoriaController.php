<?php

namespace App\Http\Controllers;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    // Guarda una nueva categoría
    public function store(Request $request)
    {
        // Solo admins pueden agregar categorías, si no eres admin, chao
        if (!auth()->user()?->is_admin) {
            abort(403);
        }
        // Validamos que todo esté bien llenado
        $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias,nombre',
            'descripcion' => 'required|string|max:255',
        ]);
        // Guardamos la categoría en la base de datos
        Categoria::create($request->all());
        // Redirigimos con mensajito de éxito
        return redirect()->route('productos.index')->with('success', 'Categoría agregada exitosamente.');
    }

    // Muestra el formulario para editar una categoría
    public function edit(Categoria $categoria)
    {
        // Mandamos la categoría a la vista para editarla
        return view('productos.edit', compact('categoria'));
    }

    // Actualiza una categoría existente
    public function update(Request $request, Categoria $categoria)
    {
        // Validamos los datos, el nombre debe ser único excepto para esta categoría
        $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias,nombre,' . $categoria->id,
            'descripcion' => 'required|string|max:255',
        ]);

        // Actualizamos la info en la base de datos
        $categoria->update($request->all());

        // Redirigimos con mensajito de éxito
        return redirect()->route('productos.index')->with('success', 'Categoría actualizada exitosamente.');
    }

    // Borra una categoría
    public function destroy(Categoria $categoria)
    {
        // Eliminamos la categoría de la base de datos
        $categoria->delete();

        // Redirigimos con mensajito de éxito
        return redirect()->route('productos.index')->with('success', 'Categoría eliminada exitosamente.');
    }
}

