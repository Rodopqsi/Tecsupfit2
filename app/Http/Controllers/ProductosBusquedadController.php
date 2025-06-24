<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Objetivo;
use App\Models\Tamano;
use App\Models\Sabor;
use App\Models\Stock;

class ProductosBusquedadController extends Controller
{
    public function index(Request $request)
    {
        $query = Producto::with(['categoria', 'marca', 'objetivo', 'tamano', 'sabor', 'stock']);

        if ($request->filled('search')) {
            $query->search($request->search);
        }

        if ($request->filled('categoria')) {
            $query->byCategoria($request->categoria);
        }

        if ($request->filled('marca')) {
            $query->byMarca($request->marca);
        }

        if ($request->filled('objetivo')) {
            $query->byObjetivo($request->objetivo);
        }

        if ($request->filled('tamano')) {
            $query->byTamano($request->tamano);
        }

        if ($request->filled('sabor')) {
            $query->bySabor($request->sabor);
        }

        if ($request->filled('precio_min') && $request->filled('precio_max')) {
            $query->byPrecio($request->precio_min, $request->precio_max);
        }

        $productos = $query->paginate(12);
        $categorias = Categoria::all();
        $marcas = Marca::all();
        $objetivos = Objetivo::all();
        $tamanos = Tamano::all();
        $sabores = Sabor::all();

        return view('products', compact('productos', 'categorias', 'marcas', 'objetivos', 'tamanos', 'sabores'));
    }


    public function comprar(Request $request, Producto $producto)
    {
        $request->validate([
            'cantidad' => 'required|integer|min:1',
        ]);

        $cantidad = $request->cantidad;

        // Cargar la relación stock si no está cargada
        if (!$producto->relationLoaded('stock')) {
            $producto->load('stock');
        }

        if (!$producto->stock || $producto->stock->cantidad < $cantidad) {
            return redirect()->back()->with('error', 'Stock insuficiente.');
        }
        $producto->stock->decrement('cantidad', $cantidad);
        if (method_exists($producto, 'ventas')) {
            $producto->ventas()->create([
                'cantidad' => $cantidad,
                'precio_unitario' => $producto->precio_nuevo,
                'total' => $producto->precio_nuevo * $cantidad,
            ]);
        }

        // Incrementar ventas del mes si el campo existe
        if ($producto->getConnection()->getSchemaBuilder()->hasColumn($producto->getTable(), 'ventas_mes')) {
            $producto->increment('ventas_mes', $cantidad);
        }

        return redirect()->back()->with('success', 'Compra realizada exitosamente.');
    }
}