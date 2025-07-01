<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orden;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    // Esta función muestra las órdenes del usuario logueado
    public function indexUsuario()
    {
        // Busca las órdenes del usuario actual, con sus productos y ordenadas por fecha
        $ordenes = Orden::where('user_id', Auth::id())
            ->with('productos.producto')
            ->orderBy('created_at', 'desc')
            ->get();

        // Manda las órdenes a la vista de usuario
        return view('pedidos.usuario', compact('ordenes'));
    }

    // Esta es para el admin, puede filtrar por estado
    public function indexAdmin(Request $request)
    {
        $estado = $request->input('estado');
        $ordenes = Orden::with('productos.producto');

        // Si el admin puso un estado, se filtra por eso
        if ($estado) {
            $ordenes->where('estado', $estado);
        }

        // Ordena por fecha y trae todo
        $ordenes = $ordenes->orderBy('created_at', 'desc')->get();

        // Manda las órdenes y el estado a la vista del admin
        return view('pedidos.admin.index', compact('ordenes', 'estado'));
    }

    // Esta función sirve para cambiar el estado de una orden
    public function actualizarEstado(Request $request, $id)
    {
        // Busca la orden por su id, si no existe tira error
        $orden = Orden::findOrFail($id);
        // Cambia el estado por el que mandaron en el request
        $orden->estado = $request->input('estado');
        $orden->save();

        // Redirige para atrás con un mensajito de éxito
        return redirect()->back()->with('success', 'Estado actualizado correctamente.');
    }
}