<?php

namespace App\Http\Controllers;

use App\Models\Cupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CuponController extends Controller
{
    public function index()
    {
        $cupones = Cupon::latest()->paginate(10);
        return view('cupones.index', compact('cupones'));
    }

    public function create()
    {
        return view('cupones.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|unique:cupones',
            'descuento' => 'required|numeric',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'tipo_descuento' => 'required|in:fijo,porcentaje'
        ]);

        Cupon::create($request->all());

        return redirect()->route('cupones.index')->with('success', 'Cupón creado correctamente.');
    }

    public function edit(Cupon $cupon)
    {
        return view('cupones.edit', compact('cupon'));
    }

    public function update(Request $request, Cupon $cupon)
    {
        $request->validate([
            'codigo' => 'required|unique:cupones,codigo,' . $cupon->id,
            'descuento' => 'required|numeric',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'tipo_descuento' => 'required|in:fijo,porcentaje'
        ]);

        $cupon->update($request->all());

        return redirect()->route('cupones.index')->with('success', 'Cupón actualizado correctamente.');
    }

    public function destroy(Cupon $cupon)
    {
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
