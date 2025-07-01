<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;

class MarcaController extends Controller
{
    // Este método muestra todas las marcas, así de simple
    public function index()
    {
        $marcas = Marca::all();
        return view('marcas.index', compact('marcas'));
    }

    // Aquí se guarda una nueva marca, pero solo si eres admin
    public function store(Request $request)
    {
        if (!auth()->user()?->is_admin) {
            abort(403); // Si no eres admin, ni lo intentes
        }
        // Validamos que el nombre esté bien y no se repita
        $request->validate([
            'nombre' => 'required|string|max:255|unique:marcas,nombre',
        ]);
        // Si subieron una imagen, la guardamos con un nombre único
        if ($request->hasFile('imagen')) {
            $imagenNombre = time() . '.' . $request->imagen->extension();
            $request->imagen->move(public_path('images/marcas'), $imagenNombre);
            $request->merge(['imagen' => $imagenNombre]);
        }
        // Guardamos la marca en la base de datos
        Marca::create($request->all());

        return redirect()->route('productos.index')->with('success', 'Marca agregada exitosamente.');
    }

    // Este método actualiza una marca existente
    public function update(Request $request, Marca $marca)
    {
        // Validamos el nombre y la imagen (si hay)
        $request->validate([
            'nombre' => 'required|string|max:255|unique:marcas,nombre,' . $marca->id,
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // opcional
        ]);

        // Si subieron una nueva imagen, borramos la anterior y guardamos la nueva
        if ($request->hasFile('imagen')) {
            if ($marca->imagen && file_exists(public_path('images/marcas/' . $marca->imagen))) {
                unlink(public_path('images/marcas/' . $marca->imagen));
            }

            $nombreImagen = time() . '.' . $request->imagen->extension();
            $request->imagen->move(public_path('images/marcas'), $nombreImagen);
            $marca->imagen = $nombreImagen;
        }

        // Actualizamos el nombre de la marca
        $marca->nombre = $request->nombre;
        $marca->save();

        return redirect()->route('productos.index')->with('success', 'Marca actualizada exitosamente.');
    }

    // Este método elimina una marca, pero solo si eres admin
    public function destroy(Marca $marca)
    {
        if (!auth()->user()?->is_admin) {
            abort(403); // No eres admin, no puedes borrar nada
        }
        $marca->delete();

        return redirect()->route('productos.index')->with('success', 'Marca eliminada exitosamente.');
    }
}
