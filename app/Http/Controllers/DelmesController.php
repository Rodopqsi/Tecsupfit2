<?php
namespace App\Http\Controllers;

// Importando los modelos que vamos a usar
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Stock;
use App\Models\delmes;
use Illuminate\Http\Request;

class DelMesController extends Controller
{
    // Esta función muestra los productos del mes con filtros y todo el rollo
    public function index(Request $request)
    {
        // Armamos la consulta con relaciones y scopes personalizados
        $query = Producto::with(['categoria', 'marca', 'stock'])
            ->delMes()
            ->topVentas();

        // Si el usuario busca algo, filtramos por nombre o descripción
        if ($request->filled('search')) {
            $query->where('nombre', 'like', '%' . $request->search . '%')
                ->orWhere('descripcion', 'like', '%' . $request->search . '%');
        }

        // Filtramos por categoría si el usuario seleccionó una
        if ($request->filled('categoria')) {
            $query->where('categoria_id', $request->categoria);
        }

        // Filtramos por marca si el usuario seleccionó una
        if ($request->filled('marca')) {
            $query->where('marca_id', $request->marca);
        }

        // Filtramos por precio mínimo si el usuario puso uno
        if ($request->filled('precio_min')) {
            $query->where('precio_nuevo', '>=', $request->precio_min);
        }

        // Filtramos por precio máximo si el usuario puso uno
        if ($request->filled('precio_max')) {
            $query->where('precio_nuevo', '<=', $request->precio_max);
        }

        // Obtenemos los productos ya filtrados
        $productosDelMes = $query->get();

        // Traemos todas las categorías y marcas para los filtros del frontend
        $categorias = Categoria::all();
        $marcas = Marca::all();

        // Mandamos todo a la vista
        return view('index', compact('productosDelMes', 'categorias', 'marcas'));
    }

    // Esta función muestra el detalle de un producto
    public function show(Producto $producto)
    {
        // Cargamos las relaciones para mostrar más info
        $producto->load(['categoria', 'marca', 'stock']);
        return view('index', compact('producto'));
    }

    // Esta función agrega un producto al carrito
    public function agregar(Request $request)
    {
        // Buscamos el producto por ID
        $producto = Producto::find($request->producto_id);
        if (!$producto) {
            // Si no existe, mandamos error
            return redirect()->back()->with('error', 'Producto no encontrado.');
        }

        // Si no ponen cantidad, por defecto es 1
        $cantidad = max(1, (int) $request->input('cantidad', 1));

        // Obtenemos el carrito de la sesión (o lo creamos vacío)
        $carrito = session()->get('carrito', []);

        // Si el producto ya está en el carrito, sumamos la cantidad
        if (isset($carrito[$producto->id])) {
            $carrito[$producto->id]['cantidad'] += $cantidad;
        } else {
            // Si no, lo agregamos al carrito
            $carrito[$producto->id] = [
                'nombre' => $producto->nombre,
                'precio' => $producto->precio_nuevo, 
                'cantidad' => $cantidad
            ];
        }

        // Guardamos el carrito actualizado en la sesión
        session(['carrito' => $carrito]);

        // Redirigimos al carrito con mensaje de éxito
        return redirect()->route('carrito.mostrar')->with('success', 'Producto agregado al carrito.');
    }

    // Esta función elimina un producto del carrito (solo admins)
    public function eliminar(Request $request)
    {
        // Solo los admins pueden eliminar productos del carrito
        if (!auth()->user()?->is_admin) {
            abort(403);
        }
        // Sacamos el producto del carrito
        $carrito = session()->get('carrito', []);
        unset($carrito[$request->producto_id]);
        session(['carrito' => $carrito]);

        // Redirigimos con mensaje de éxito
        return redirect()->route('carrito.mostrar')->with('success', 'Producto eliminado del carrito.');
    }

    // Esta función actualiza la cantidad de un producto en el carrito
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