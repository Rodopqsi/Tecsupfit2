<?php
namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Stock;
use App\Models\delmes;
use Illuminate\Http\Request;

class DelMesController extends Controller
{
    public function index(Request $request)
{
    $query = Producto::with(['categoria', 'marca', 'stock'])
        ->delMes()
        ->topVentas();

    if ($request->filled('search')) {
        $query->where('nombre', 'like', '%' . $request->search . '%')
                ->orWhere('descripcion', 'like', '%' . $request->search . '%');
    }

    if ($request->filled('categoria')) {
        $query->where('categoria_id', $request->categoria);
    }

    if ($request->filled('marca')) {
        $query->where('marca_id', $request->marca);
    }

    if ($request->filled('precio_min')) {
        $query->where('precio_nuevo', '>=', $request->precio_min);
    }

    if ($request->filled('precio_max')) {
        $query->where('precio_nuevo', '<=', $request->precio_max);
    }

    $productosDelMes = $query->get();

    $categorias = Categoria::all();
    $marcas = Marca::all();

    return view('index', compact('productosDelMes', 'categorias', 'marcas'));
}

    public function show(Producto $producto)
    {
        $producto->load(['categoria', 'marca', 'stock']);
        return view('index', compact('producto'));
    }

    
    public function agregar(Request $request)
{
    $producto = Producto::find($request->producto_id);
    if (!$producto) {
        return redirect()->back()->with('error', 'Producto no encontrado.');
    }

    $cantidad = max(1, (int) $request->input('cantidad', 1));

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
        if (!auth()->user()?->is_admin) {
        abort(403);
        }
        $carrito = session()->get('carrito', []);
        unset($carrito[$request->producto_id]);
        session(['carrito' => $carrito]);

        return redirect()->route('carrito.mostrar')->with('success', 'Producto eliminado del carrito.');
    }

    public function actualizar(Request $request)
    {
        $carrito = session()->get('carrito', []);
        if (isset($carrito[$request->producto_id])) {
            $carrito[$request->producto_id]['cantidad'] = $request->cantidad;
        }
        session(['carrito' => $carrito]);

        return redirect()->route('carrito.mostrar')->with('success', 'Cantidad actualizada.');
    }

}