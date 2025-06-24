<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;
class MarcaController extends Controller
{
    
    public function index()
    {
        $marcas = Marca::all();
        return view('marcas.index', compact('marcas'));
    }
    public function store(Request $request)
    {
        if (!auth()->user()?->is_admin) {
        abort(403);
        }
        $request->validate([
            'nombre' => 'required|string|max:255|unique:marcas,nombre',
        ]);
        if ($request->hasFile('imagen')) {
            $imagenNombre = time() . '.' . $request->imagen->extension();
            $request->imagen->move(public_path('images/marcas'), $imagenNombre);
            $request->merge(['imagen' => $imagenNombre]);
        }
        Marca::create($request->all());

        return redirect()->route('productos.index')->with('success', 'Marca agregada exitosamente.');
    }

    public function update(Request $request, Marca $marca)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:marcas,nombre,' . $marca->id,
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // opcional
        ]);

        if ($request->hasFile('imagen')) {
            if ($marca->imagen && file_exists(public_path('images/marcas/' . $marca->imagen))) {
                unlink(public_path('images/marcas/' . $marca->imagen));
            }

            $nombreImagen = time() . '.' . $request->imagen->extension();
            $request->imagen->move(public_path('images/marcas'), $nombreImagen);
            $marca->imagen = $nombreImagen;
        }

        $marca->nombre = $request->nombre;
        $marca->save();

        return redirect()->route('productos.index')->with('success', 'Marca actualizada exitosamente.');
    }


    public function destroy(Marca $marca)
    {
        if (!auth()->user()?->is_admin) {
        abort(403);
        }
        $marca->delete();

        return redirect()->route('productos.index')->with('success', 'Marca eliminada exitosamente.');
    }
}
