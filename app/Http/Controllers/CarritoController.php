<?php

namespace App\Http\Controllers;
use App\Models\Cupon;
use Illuminate\Http\Request;
use App\Models\CarritoProducto;
use Illuminate\Support\Facades\Auth;
use App\Models\Producto;

    class CarritoController extends Controller
{
    
    public function mostrar()
    {
        $carrito = CarritoProducto::with('producto')
            ->where('user_id', auth()->id())
            ->get();
    
        $total = $carrito->sum(function ($item) {
            return $item->producto->precio_nuevo * $item->cantidad;
        });
    
        return view('carrito.index', compact('carrito', 'total'));
    }


    

    public function agregar(Request $request)
    {
        $producto = Producto::find($request->producto_id);
        if (!$producto) {
            return redirect()->back()->with('error', 'Producto no encontrado.');
        }

        $cantidad = max(1, (int) $request->input('cantidad', 1));

        if (Auth::check()) {
            $item = CarritoProducto::where('user_id', Auth::id())
                ->where('producto_id', $producto->id)
                ->first();

            if ($item) {
                $item->cantidad += $cantidad;
                $item->save();
            } else {
                CarritoProducto::create([
                    'user_id' => Auth::id(),
                    'producto_id' => $producto->id,
                    'cantidad' => $cantidad,
                ]);
            }

            return redirect()->route('carrito.mostrar')->with('success', 'Producto agregado al carrito.');
        }

        // Usuario no autenticado: usar sesión
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



    public function eliminar(Request $request)
    {
        CarritoProducto::where('user_id', auth()->id())
            ->where('producto_id', $request->producto_id)
            ->delete();
    
        return redirect()->route('carrito.mostrar')->with('success', 'Producto eliminado del carrito.');
    }


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

    public function aplicarCupon(Request $request)
    {
        $codigo = strtoupper($request->input('cupon'));
        $cupon = Cupon::where('codigo', $codigo)->first();
        $carrito = session()->get('carrito', []);
        $total = array_sum(array_map(fn($item) => $item['precio'] * $item['cantidad'], $carrito));

        if (!$cupon || $cupon->stock <= 0 || now()->lt($cupon->fecha_inicio) || now()->gt($cupon->fecha_fin)) {
            return redirect()->route('checkout')->with('error', 'Cupón inválido o vencido.');
        }

        if ($cupon->user_id && $cupon->user_id !== Auth::id()) {
            return redirect()->route('checkout')->with('error', 'Cupón no autorizado para tu cuenta.');
        }

        if ($cupon->precio_minimo && $total < $cupon->precio_minimo) {
            return redirect()->route('checkout')->with('error', 'No alcanzas el mínimo de compra para este cupón.');
        }

        // Lógica del descuento (puedes ampliar según tipo)
        $descuentoTotal = $cupon->descuento;

        session([
            'cupon_codigo' => $codigo,
            'descuento' => $descuentoTotal,
            'cupon_id' => $cupon->id
        ]);

        return redirect()->route('checkout')->with('success', 'Cupón aplicado correctamente.');
    }

}
