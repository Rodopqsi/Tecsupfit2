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
        $totalConDescuento = max($total - $descuento, 0); 

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

    try {
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
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'dni' => $request->dni,
            'region' => $request->region,
            'distrito' => $request->distrito,
            'direccion' => $request->direccion,
            'departamento' => $request->departamento,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'notas' => $request->notas,
            'monto_total' => $totalConDescuento,
            'estado_pago' => 'Pagado',
            'paypal_order_id' => $request->input('paypal_order_id'),
        ]);

        // Guardar productos
        foreach ($carrito as $productoId => $item) {
            OrdenProducto::create([
                'orden_id' => $orden->id,
                'producto_id' => $productoId,
                'cantidad' => $item['cantidad'],
                'precio_unitario' => $item['precio'],
            ]);
        }

        // Enviar correo
        if ($email) {
            Mail::to($email)->send(new ConfirmacionPedido([
                'nombre' => $nombre,
                'numero_orden' => $orden->id,
                'fecha' => now()->format('d/m/Y H:i'),
                'total' => $totalConDescuento,
                'productos' => $carrito
            ]));
        }

        // ✅ Pasar resumen del pedido a la vista de gracias
        session()->put('resumen_pedido', [
            'numero_orden' => $orden->id,
            'fecha' => $orden->created_at->format('d/m/Y H:i'),
            'productos' => array_map(function ($item) {
                return [
                    'nombre' => $item['nombre'],
                    'cantidad' => $item['cantidad'],
                    'precio' => $item['precio']
                ];
            }, $carrito),
            'total' => $totalConDescuento
        ]);

        // Limpiar sesión
        session()->forget(['carrito', 'descuento']);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'mensaje' => 'Pago registrado.']);
        }

        return redirect()->route('gracias');

    } catch (\Exception $e) {
        \Log::error('Error al guardar el pedido: ' . $e->getMessage());
        if ($request->ajax() || $request->wantsJson()) {
    return response()->json([
        'success' => true,
        'redirect_url' => route('gracias')
    ]);
}

        return redirect()->route('checkout')->with('error', 'Ocurrió un error al guardar el pedido.');
    }
}

}