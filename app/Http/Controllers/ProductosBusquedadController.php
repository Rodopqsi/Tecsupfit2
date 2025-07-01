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
    // Este método es para mostrar la lista de productos con filtros y paginación
    public function index(Request $request)
    {
        // Armamos la consulta con las relaciones necesarias
        $query = Producto::with(['categoria', 'marca', 'objetivo', 'tamano', 'sabor', 'stock']);

        // Si el usuario puso algo en el buscador, filtramos por eso
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Filtros por categoría, marca, objetivo, tamaño, sabor, etc.
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

        // Filtro por rango de precios
        if ($request->filled('precio_min') && $request->filled('precio_max')) {
            $query->byPrecio($request->precio_min, $request->precio_max);
        }

        // Paginamos los productos, 12 por página
        $productos = $query->paginate(12);

        // Traemos todas las categorías, marcas, etc. para los filtros del frontend
        $categorias = Categoria::all();
        $marcas = Marca::all();
        $objetivos = Objetivo::all();
        $tamanos = Tamano::all();
        $sabores = Sabor::all();

        // Retornamos la vista con todos los datos
        return view('products', compact('productos', 'categorias', 'marcas', 'objetivos', 'tamanos', 'sabores'));
    }

    // Este método es para cuando alguien compra un producto
    public function comprar(Request $request, Producto $producto)
    {
        // Validamos que la cantidad sea un número mayor a 0
        $request->validate([
            'cantidad' => 'required|integer|min:1',
        ]);

        $cantidad = $request->cantidad;

        // Si el stock no está cargado, lo traemos
        if (!$producto->relationLoaded('stock')) {
            $producto->load('stock');
        }

        // Si no hay suficiente stock, mandamos error
        if (!$producto->stock || $producto->stock->cantidad < $cantidad) {
            return redirect()->back()->with('error', 'Stock insuficiente.');
        }

        // Descontamos la cantidad comprada del stock
        $producto->stock->decrement('cantidad', $cantidad);

        // Si el producto tiene relación de ventas, registramos la venta
        if (method_exists($producto, 'ventas')) {
            $producto->ventas()->create([
                'cantidad' => $cantidad,
                'precio_unitario' => $producto->precio_nuevo,
                'total' => $producto->precio_nuevo * $cantidad,
            ]);
        }

        // Si existe el campo ventas_mes, lo incrementamos
        if ($producto->getConnection()->getSchemaBuilder()->hasColumn($producto->getTable(), 'ventas_mes')) {
            $producto->increment('ventas_mes', $cantidad);
        }

        // Todo bien, mandamos mensaje de éxito
        return redirect()->back()->with('success', 'Compra realizada exitosamente.');
    }
}