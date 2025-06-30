<?php

namespace App\Http\Controllers;

use App\Models\Cupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CuponController extends Controller
{
    
    public function index()
    {
        if (!auth()->user()?->is_admin) {
        abort(403);
        }
        
        $cupones = Cupon::latest()->paginate(10);
        return view('cupones.index', compact('cupones'));
    }

    public function create()
    {
        if (!auth()->user()?->is_admin) {
        abort(403);
        }
        return view('cupones.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|unique:cupones',
            'descuento' => 'required|numeric',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'tipo_descuento' => 'required|in:fijo,porcentaje',
            'stock' => 'required|integer|min:1',
            'imagen' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('imagenes/cupones'), $filename);
            $data['imagen'] = 'imagenes/cupones/' . $filename;
        }

        Cupon::create($data);

        return redirect()->route('cupones.index')->with('success', 'Cupón creado correctamente.');
    }


    public function edit(Cupon $cupon)
    {
        if (!auth()->user()?->is_admin) {
        abort(403);
        }
        return view('cupones.edit', compact('cupon'));
    }

    public function update(Request $request, Cupon $cupon)
{
    $request->validate([
        'codigo' => 'required|unique:cupones,codigo,' . $cupon->id,
        'descuento' => 'required|numeric',
        'fecha_inicio' => 'required|date',
        'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        'tipo_descuento' => 'required|in:fijo,porcentaje',
        'stock' => 'required|integer|min:1',
        'imagen' => 'nullable|image|max:2048',
    ]);

    $datos = $request->all();

    if ($request->hasFile('imagen')) {
        // Eliminar imagen anterior si existe
        if ($cupon->imagen && file_exists(public_path($cupon->imagen))) {
            unlink(public_path($cupon->imagen));
        }

        // Guardar la nueva imagen
        $file = $request->file('imagen');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('imagenes/cupones'), $filename);
        $datos['imagen'] = 'imagenes/cupones/' . $filename;
    }

    $cupon->update($datos);

    return redirect()->route('cupones.index')->with('success', 'Cupón actualizado correctamente.');
}


    public function destroy(Cupon $cupon)
    {
        if (!auth()->user()?->is_admin) {
        abort(403);
        }
        $cupon->delete();
        return redirect()->route('cupones.index')->with('success', 'Cupón eliminado.');
    }

    public function verCupones()
    {
        $hoy = now();
        $cupones = Cupon::where('fecha_inicio', '<=', $hoy)
            ->where('fecha_fin', '>=', $hoy)
            ->where('stock', '>', 0)
            ->where(function ($q) {
                $q->whereNull('user_id')->orWhere('user_id', Auth::id());
            })->get();

        return view('cupones.disponibles', compact('cupones'));
    }
}
