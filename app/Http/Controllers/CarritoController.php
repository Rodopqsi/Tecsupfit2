<?php

namespace App\Http\Controllers;
use App\Models\Cupon;
use Illuminate\Http\Request;
use App\Models\CarritoProducto;
use Illuminate\Support\Facades\Auth;
use App\Models\Producto;

// Controlador del carrito, aquí va toda la lógica del carrito de compras
class CarritoController extends Controller
{
    // Muestra el carrito al usuario
    public function mostrar()
    {
        // Trae los productos del carrito del usuario actual
        $carrito = CarritoProducto::with('producto')
            ->where('user_id', auth()->id())
            ->get();
    
        // Suma el total del carrito (precio * cantidad)
        $total = $carrito->sum(function ($item) {
            return $item->producto->precio_nuevo * $item->cantidad;
        });
    
        // Manda los datos a la vista
        return view('carrito.index', compact('carrito', 'total'));
    }

    // Agrega un producto al carrito
    public function agregar(Request $request)
    {
        $producto = Producto::find($request->producto_id);
        if (!$producto) {
            // Si no existe el producto, manda error
            return redirect()->back()->with('error', 'Producto no encontrado.');
        }

        // Asegura que la cantidad sea mínimo 1
        $cantidad = max(1, (int) $request->input('cantidad', 1));

        if (Auth::check()) {
            // Si el usuario está logueado, guarda en la base de datos
            $item = CarritoProducto::where('user_id', Auth::id())
                ->where('producto_id', $producto->id)
                ->first();

            if ($item) {
                // Si ya está en el carrito, suma la cantidad
                $item->cantidad += $cantidad;
                $item->save();
            } else {
                // Si no está, lo agrega
                CarritoProducto::create([
                    'user_id' => Auth::id(),
                    'producto_id' => $producto->id,
                    'cantidad' => $cantidad,
                ]);
            }

            return redirect()->route('carrito.mostrar')->with('success', 'Producto agregado al carrito.');
        }

        // Si el usuario no está logueado, guarda el carrito en la sesión
        $carrito = session()->get('carrito', []);
        if (isset($carrito[$producto->id])) {
            $carrito[$producto->id]['cantidad'] += $cantidad;
        } else {
            $carrito[$producto->id] = [
                'nombre' => $producto->nombre,
                'precio' => $producto->precio_nuevo, 
                'cantidad' => $cantidad
            ];
        }

        session(['carrito' => $carrito]);
        return redirect()->route('carrito.mostrar')->with('success', 'Producto agregado al carrito.');
    }

    // Elimina un producto del carrito
    public function eliminar(Request $request)
    {
        CarritoProducto::where('user_id', auth()->id())
            ->where('producto_id', $request->producto_id)
            ->delete();
    
        return redirect()->route('carrito.mostrar')->with('success', 'Producto eliminado del carrito.');
    }

    // Actualiza la cantidad de un producto en el carrito
    public function actualizar(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1'
        ]);

        $item = CarritoProducto::where('user_id', auth()->id())
            ->where('producto_id', $request->producto_id)
            ->first();

        if ($item) {
            $item->update(['cantidad' => $request->cantidad]);
        }

        return redirect()->route('carrito.mostrar')->with('success', 'Cantidad actualizada.');
    }

    // Aplica un cupón al carrito
    public function aplicarCupon(Request $request)
    {
        $codigo = strtoupper($request->input('cupon'));
        $cupon = Cupon::where('codigo', $codigo)->first();

        // Saca el total del carrito, depende si está logueado o no
        if (Auth::check()) {
            $carritoDB = CarritoProducto::with('producto')
                ->where('user_id', auth()->id())
                ->get();

            $total = $carritoDB->sum(fn($item) => $item->producto->precio_nuevo * $item->cantidad);
        } else {
            $carrito = session()->get('carrito', []);
            $total = array_sum(array_map(fn($item) => $item['precio'] * $item['cantidad'], $carrito));
        }

        // Checa si el cupón es válido, si no, manda error
        if (
            !$cupon ||
            $cupon->stock <= 0 ||
            now()->lt($cupon->fecha_inicio) ||
            now()->gt($cupon->fecha_fin)
        ) {
            return redirect()->route('checkout')->with('error', 'Cupón inválido o vencido.');
        }

        // Si el cupón es solo para un usuario y no eres tú, no deja usarlo
        if ($cupon->user_id && $cupon->user_id !== Auth::id()) {
            return redirect()->route('checkout')->with('error', 'Cupón no autorizado para tu cuenta.');
        }

        // Si no llegas al mínimo de compra, tampoco deja usarlo
        if ($cupon->precio_minimo && $total < $cupon->precio_minimo) {
            return redirect()->route('checkout')->with('error', 'No alcanzas el mínimo de compra para este cupón.');
        }

        // Calcula el descuento según el tipo de cupón
        $descuentoTotal = $cupon->tipo_descuento === 'porcentaje'
            ? ($cupon->descuento / 100) * $total
            : $cupon->descuento;

        // Checa si ya aplicaste ese cupón antes
        $cupones = session('cupones', []);

        if (isset($cupones[$codigo])) {
            return redirect()->route('checkout')->with('error', 'Este cupón ya fue aplicado.');
        }

        // Que el total no quede en cero o negativo con los cupones
        $descuentoAcumulado = array_sum(array_column($cupones, 'descuento')) + $descuentoTotal;
        $totalConDescuento = $total - $descuentoAcumulado;

        if ($totalConDescuento <= 0) {
            return redirect()->route('checkout')->with('error', 'El total no puede ser menor o igual a 0. Quita algún cupón.');
        }

        // Guarda el cupón en la sesión
        $cupones[$codigo] = [
            'codigo' => $codigo,
            'descuento' => $descuentoTotal,
            'id' => $cupon->id,
        ];

        session(['cupones' => $cupones]);
        session(['cupon_id' => $cupon->id]);

        return redirect()->route('checkout')->with('success', 'Cupón aplicado correctamente.');
    }

    // Quita un cupón del carrito
    public function removerCupon(Request $request)
    {
        $codigo = $request->input('codigo');
        $cupones = session('cupones', []);
        unset($cupones[$codigo]);

        session(['cupones' => $cupones]);

        return redirect()->route('checkout')->with('success', 'Cupón removido.');
    }
}
