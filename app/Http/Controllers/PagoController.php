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
    // Esta función muestra la vista del checkout
    public function checkout()
    {
        // Si el usuario está logueado, saca el carrito de la base de datos
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
            // Si no está logueado, el carrito está en la sesión
            $carrito = session()->get('carrito', []);
        }

        // Calcula el total del carrito
        $total = array_sum(array_map(fn($item) => $item['precio'] * $item['cantidad'], $carrito));
        // Saca los cupones aplicados de la sesión
        $cupones = session('cupones', []);
        // Suma todos los descuentos de los cupones
        $descuento = array_sum(array_column($cupones, 'descuento'));
        // Calcula el total con descuento (no puede ser menor a 0)
        $totalConDescuento = max($total - $descuento, 0);

        // Manda todo a la vista del checkout
        return view('checkout', [
            'carrito' => $carrito,
            'total' => $total,
            'descuento' => $descuento,
            'totalConDescuento' => $totalConDescuento
        ]);
    }

    // Esta función procesa el pago y guarda la orden
    public function procesarPago(Request $request)
    {
        if (Auth::check()) {
            // Si está logueado, saca el carrito de la base de datos
            $carritoDB = CarritoProducto::with('producto')
                ->where('user_id', auth()->id())
                ->get();

            if ($carritoDB->isEmpty()) {
                // Si el carrito está vacío, lo manda de vuelta al checkout
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
            // Si no está logueado, saca el carrito de la sesión
            $carrito = session()->get('carrito', []);
            if (empty($carrito)) {
                return redirect()->route('checkout')->with('error', 'Tu carrito está vacío.');
            }
        }

        try {
            // Calcula el total y el descuento igual que antes
            $total = array_sum(array_map(fn($item) => $item['precio'] * $item['cantidad'], $carrito));
            $cupones = session('cupones', []);
            $descuento = array_sum(array_column($cupones, 'descuento'));
            $totalConDescuento = max($total - $descuento, 0);

            // Saca el id del usuario si está logueado
            $user_id = Auth::check() ? Auth::id() : null;
            $email = $request->input('email');
            $nombre = $request->input('nombre');

            // Crea la orden en la base de datos
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

            // Guarda cada producto del carrito en la tabla de productos de la orden
            foreach ($carrito as $productoId => $item) {
                OrdenProducto::create([
                    'orden_id' => $orden->id,
                    'producto_id' => $productoId,
                    'cantidad' => $item['cantidad'],
                    'precio_unitario' => $item['precio'],
                ]);
            }

            // Si hay email, manda el correo de confirmación
            if ($email) {
                Mail::to($email)->send(new ConfirmacionPedido([
                    'nombre' => $nombre,
                    'numero_orden' => $orden->id,
                    'fecha' => now()->format('d/m/Y H:i'),
                    'total' => $totalConDescuento,
                    'productos' => $carrito
                ]));
            }

            // Si se usó un cupón, le baja el stock
            if (session()->has('cupon_id')) {
                $cupon = Cupon::find(session('cupon_id'));
                if ($cupon && $cupon->stock > 0) {
                    $cupon->decrement('stock');
                }
            }

            // Guarda un resumen del pedido en la sesión para mostrarlo después
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

            // Limpia el carrito y los datos del cupón de la sesión
            session()->forget(['carrito', 'descuento', 'cupon_codigo', 'cupon_id']);

            // Si la petición es por AJAX, responde con JSON
            if ($request->wantsJson()) {
                return response()->json(['success' => true, 'redirect_url' => route('gracias')]);
            }

            // Si todo salió bien, redirige a la página de gracias
            return redirect()->route('gracias');

        } catch (\Exception $e) {
            // Si algo falla, lo loguea y muestra un error
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

