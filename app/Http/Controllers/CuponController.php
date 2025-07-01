<?php

namespace App\Http\Controllers;

use App\Models\Cupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CuponController extends Controller
{
    // Muestra la lista de cupones (solo admins)
    public function index()
    {
        if (!auth()->user()?->is_admin) {
            abort(403); // Si no eres admin, no pasas
        }
        
        $cupones = Cupon::latest()->paginate(10); // Trae los cupones más recientes
        return view('cupones.index', compact('cupones'));
    }

    // Muestra el formulario para crear un cupón (solo admins)
    public function create()
    {
        if (!auth()->user()?->is_admin) {
            abort(403); // Solo admins pueden entrar aquí
        }
        return view('cupones.create');
    }

    // Guarda el cupón nuevo en la base de datos
    public function store(Request $request)
    {
        // Valida los datos, no dejes que te engañen
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

        // Si subieron imagen, la guardamos
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('imagenes/cupones'), $filename);
            $data['imagen'] = 'imagenes/cupones/' . $filename;
        }

        Cupon::create($data); // Guardamos el cupón

        return redirect()->route('cupones.index')->with('success', 'Cupón creado correctamente.');
    }

    // Muestra el formulario para editar un cupón (solo admins)
    public function edit(Cupon $cupon)
    {
        if (!auth()->user()?->is_admin) {
            abort(403); // Solo admins pueden editar
        }
        return view('cupones.edit', compact('cupon'));
    }

    // Actualiza el cupón en la base de datos
    public function update(Request $request, Cupon $cupon)
    {
        // Valida los datos, igual que en store pero permite el mismo código si es el mismo cupón
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

        // Si subieron una nueva imagen, borramos la anterior y guardamos la nueva
        if ($request->hasFile('imagen')) {
            // Borra la imagen vieja si existe
            if ($cupon->imagen && file_exists(public_path($cupon->imagen))) {
                unlink(public_path($cupon->imagen));
            }

            // Guarda la nueva imagen
            $file = $request->file('imagen');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('imagenes/cupones'), $filename);
            $datos['imagen'] = 'imagenes/cupones/' . $filename;
        }

        $cupon->update($datos); // Actualiza el cupón

        return redirect()->route('cupones.index')->with('success', 'Cupón actualizado correctamente.');
    }

    // Borra un cupón (solo admins)
    public function destroy(Cupon $cupon)
    {
        if (!auth()->user()?->is_admin) {
            abort(403); // Solo admins pueden borrar
        }
        $cupon->delete();
        return redirect()->route('cupones.index')->with('success', 'Cupón eliminado.');
    }

    // Muestra los cupones disponibles para los usuarios
    public function verCupones()
    {
        $hoy = now();
        $cupones = Cupon::where('fecha_inicio', '<=', $hoy)
            ->where('fecha_fin', '>=', $hoy)
            ->where('stock', '>', 0)
            ->where(function ($q) {
                // Solo cupones sin dueño o que sean para el usuario actual
                $q->whereNull('user_id')->orWhere('user_id', Auth::id());
            })->get();

        return view('cupones.disponibles', compact('cupones'));
    }
}
