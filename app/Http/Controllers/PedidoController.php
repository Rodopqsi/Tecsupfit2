<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orden;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    public function indexUsuario()
    {
        $ordenes = Orden::where('user_id', Auth::id())
            ->with('productos.producto')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pedidos.usuario.index', compact('ordenes'));
    }

    public function indexAdmin(Request $request)
    {
        $estado = $request->input('estado');
        $ordenes = Orden::with('productos.producto');

        if ($estado) {
            $ordenes->where('estado', $estado);
        }

        $ordenes = $ordenes->orderBy('created_at', 'desc')->get();

        return view('pedidos.admin.index', compact('ordenes', 'estado'));
    }

    public function actualizarEstado(Request $request, $id)
    {
        $orden = Orden::findOrFail($id);
        $orden->estado = $request->input('estado');
        $orden->save();

        return redirect()->back()->with('success', 'Estado actualizado correctamente.');
    }
}