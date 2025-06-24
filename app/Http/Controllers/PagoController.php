<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Orden;
use App\Models\OrdenProducto;
use App\Mail\ConfirmacionPedido;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PagoController extends Controller
{
    public function checkout()
    {
        $carrito = session()->get('carrito', []);
        $total = array_sum(array_map(function ($item) {
            return $item['precio'] * $item['cantidad'];
        }, $carrito));

        $descuento = session('descuento', 0);
        $totalConDescuento = max($total - $descuento, 0); // evita negativos

        return view('checkout', [
            'carrito' => $carrito,
            'total' => $total,
            'descuento' => $descuento,
            'totalConDescuento' => $totalConDescuento
        ]);
    }

    public function procesarPago(Request $request)
    {
        $carrito = session()->get('carrito', []);
        if (empty($carrito)) {
            return redirect()->route('checkout')->with('error', 'Tu carrito está vacío.');
        }

        $total = array_sum(array_map(function ($item) {
            return $item['precio'] * $item['cantidad'];
        }, $carrito));

        $descuento = session('descuento', 0);
        $totalConDescuento = max($total - $descuento, 0);

        $email = $request->input('email');
        $nombre = $request->input('nombre');
        $user_id = Auth::check() ? Auth::id() : null;

        // Guardar la orden
        $orden = Orden::create([
            'user_id' => $user_id,
            'nombre' => $nombre,
            'email' => $email,
            'total' => $totalConDescuento,
            'estado' => 'En proceso',
            'direccion' => $request->input('direccion') ?? '',
            'telefono' => $request->input('telefono') ?? '',
        ]);

        // Guardar productos de la orden
        foreach ($carrito as $productoId => $item) {
            OrdenProducto::create([
                'orden_id' => $orden->id,
                'producto_id' => $productoId,
                'cantidad' => $item['cantidad'],
                'precio_unitario' => $item['precio'],
            ]);
        }

        // Enviar correo de confirmación
        if ($email) {
            Mail::to($email)->send(new ConfirmacionPedido([
                'nombre' => $nombre,
                'total' => $totalConDescuento,
                'productos' => $carrito,
            ]));
        }

        // Limpiar la sesión
        session()->forget(['carrito', 'descuento']);

        // Puedes devolver una redirección o una respuesta JSON según contexto
        if ($request->wantsJson()) {
            \Log::info('Pago recibido (API):', $request->all());
            return response()->json(['success' => true, 'mensaje' => 'Pago registrado.']);
        }

        return redirect()->route('gracias');
    }
}
