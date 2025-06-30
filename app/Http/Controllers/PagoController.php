<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Orden;
use App\Models\OrdenProducto;
use App\Mail\ConfirmacionPedido;
use Illuminate\Support\Facades\Auth;
use App\Models\CarritoProducto;
use Illuminate\Support\Facades\Mail;
use App\Models\Cupon;

class PagoController extends Controller
{
    public function checkout()
    {
        if (auth()->check()) {
            $carritoDB = CarritoProducto::with('producto')
                ->where('user_id', auth()->id())
                ->get();

            $carrito = [];
            foreach ($carritoDB as $item) {
                $carrito[$item->producto->id] = [
                    'nombre' => $item->producto->nombre,
                    'precio' => $item->producto->precio_nuevo,
                    'cantidad' => $item->cantidad,
                ];
            }
        } else {
            $carrito = session()->get('carrito', []);
        }

        $total = array_sum(array_map(fn($item) => $item['precio'] * $item['cantidad'], $carrito));
        $cupones = session('cupones', []);
        $descuento = array_sum(array_column($cupones, 'descuento'));
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
        if (Auth::check()) {
            $carritoDB = CarritoProducto::with('producto')
                ->where('user_id', auth()->id())
                ->get();

            if ($carritoDB->isEmpty()) {
                return redirect()->route('checkout')->with('error', 'Tu carrito está vacío.');
            }

            $carrito = [];
            foreach ($carritoDB as $item) {
                $carrito[$item->producto->id] = [
                    'nombre' => $item->producto->nombre,
                    'precio' => $item->producto->precio_nuevo,
                    'cantidad' => $item->cantidad,
                ];
            }
        } else {
            $carrito = session()->get('carrito', []);
            if (empty($carrito)) {
                return redirect()->route('checkout')->with('error', 'Tu carrito está vacío.');
            }
        }

        try {
            $total = array_sum(array_map(fn($item) => $item['precio'] * $item['cantidad'], $carrito));
            $cupones = session('cupones', []);
            $descuento = array_sum(array_column($cupones, 'descuento'));
            $totalConDescuento = max($total - $descuento, 0);


            $user_id = Auth::check() ? Auth::id() : null;
            $email = $request->input('email');
            $nombre = $request->input('nombre');

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

            foreach ($carrito as $productoId => $item) {
                OrdenProducto::create([
                    'orden_id' => $orden->id,
                    'producto_id' => $productoId,
                    'cantidad' => $item['cantidad'],
                    'precio_unitario' => $item['precio'],
                ]);
            }

            if ($email) {
                Mail::to($email)->send(new ConfirmacionPedido([
                    'nombre' => $nombre,
                    'numero_orden' => $orden->id,
                    'fecha' => now()->format('d/m/Y H:i'),
                    'total' => $totalConDescuento,
                    'productos' => $carrito
                ]));
            }

            // Descontar stock del cupón si se aplicó
            if (session()->has('cupon_id')) {
                $cupon = Cupon::find(session('cupon_id'));
                if ($cupon && $cupon->stock > 0) {
                    $cupon->decrement('stock');
                }
            }

            // Guardar resumen de pedido
            session()->put('resumen_pedido', [
                'numero_orden' => $orden->id,
                'fecha' => $orden->created_at->format('d/m/Y H:i'),
                'productos' => array_map(fn($item) => [
                    'nombre' => $item['nombre'],
                    'cantidad' => $item['cantidad'],
                    'precio' => $item['precio']
                ], $carrito),
                'total' => $totalConDescuento
            ]);

        
            session()->forget(['carrito', 'descuento', 'cupon_codigo', 'cupon_id']);

            if ($request->wantsJson()) {
                return response()->json(['success' => true, 'redirect_url' => route('gracias')]);
            }

            return redirect()->route('gracias');

        } catch (\Exception $e) {
                \Log::error('Error al guardar el pedido: ' . $e->getMessage());
                    
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Error al guardar el pedido'
                    ]);
                }
            
                return redirect()->route('checkout')->with('error', 'Ocurrió un error al guardar el pedido.');
            }

    }
}
