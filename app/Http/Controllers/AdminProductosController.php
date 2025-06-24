<?php
// app/Http/Controllers/ProductoController.php
namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Stock;
use Illuminate\Http\Request;

class AdminProductosController extends Controller
{
    public function index(Request $request)
    {
        $query = Producto::with(['categoria', 'marca', 'stock']);

        if ($request->filled('search')) {
            $query->search($request->search);
        }

        if ($request->filled('categoria')) {
            $query->byCategoria($request->categoria);
        }

        if ($request->filled('marca')) {
            $query->byMarca($request->marca);
        }

        if ($request->filled('precio_min') && $request->filled('precio_max')) {
            $query->byPrecio($request->precio_min, $request->precio_max);
        }

        $productos = $query->paginate(12);
        $categorias = Categoria::all();
        $marcas = Marca::all();

        return view('productos.index', compact('productos', 'categorias', 'marcas'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        $marcas = Marca::all();
        return view('productos.create', compact('categorias', 'marcas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio_nuevo' => 'required|numeric|min:0',
            'precio_antes' => 'nullable|numeric|min:0',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'descripcion' => 'required|string',
            'categoria_id' => 'required|exists:categorias,id',
            'marca_id' => 'required|exists:marcas,id',
            'stock_cantidad' => 'required|integer|min:0',
            'stock_minimo' => 'required|integer|min:0',
        ]);

        // Crear stock
        $stock = Stock::create([
            'cantidad' => $request->stock_cantidad,
            'stock_minimo' => $request->stock_minimo,
        ]);

        // Crear producto
        $producto = new Producto($request->except(['stock_cantidad', 'stock_minimo']));
        $producto->stock_id = $stock->id;

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '.' . $imagen->getClientOriginalExtension();
            $imagen->move(public_path('images/productos'), $nombreImagen);
            $producto->imagen = $nombreImagen;
        }

        $producto->save();

        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente.');
    }

    public function show(Producto $producto)
    {
        $producto->load(['categoria', 'marca', 'stock']);
        return view('productos.show', compact('producto'));
    }

    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();
        $marcas = Marca::all();
        $producto->load('stock');
        return view('productos.edit', compact('producto', 'categorias', 'marcas'));
    }

    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio_nuevo' => 'required|numeric|min:0',
            'precio_antes' => 'nullable|numeric|min:0',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'descripcion' => 'required|string',
            'categoria_id' => 'required|exists:categorias,id',
            'marca_id' => 'required|exists:marcas,id',
            'stock_cantidad' => 'required|integer|min:0',
            'stock_minimo' => 'required|integer|min:0',
        ]);

        // Actualizar stock
        $producto->stock->update([
            'cantidad' => $request->stock_cantidad,
            'stock_minimo' => $request->stock_minimo,
        ]);

        // Actualizar producto
        $producto->fill($request->except(['stock_cantidad', 'stock_minimo']));

        if ($request->hasFile('imagen')) {
            // Eliminar imagen anterior si existe
            if ($producto->imagen && file_exists(public_path('images/productos/' . $producto->imagen))) {
                unlink(public_path('images/productos/' . $producto->imagen));
            }

            $imagen = $request->file('imagen');
            $nombreImagen = time() . '.' . $imagen->getClientOriginalExtension();
            $imagen->move(public_path('images/productos'), $nombreImagen);
            $producto->imagen = $nombreImagen;
        }

        $producto->save();

        return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente.');
    }

    public function destroy(Producto $producto)
    {
        // Eliminar imagen si existe
        if ($producto->imagen && file_exists(public_path('images/productos/' . $producto->imagen))) {
            unlink(public_path('images/productos/' . $producto->imagen));
        }

        // El stock se eliminará automáticamente por la clave foránea
        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado exitosamente.');
    }

    public function toggleDelMes(Producto $producto)
    {
        $producto->update(['es_delmes' => !$producto->es_delmes]);
        
        $mensaje = $producto->es_delmes ? 'Producto agregado a Del Mes' : 'Producto removido de Del Mes';
        
        return redirect()->back()->with('success', $mensaje);
    }

    public function comprar(Request $request, Producto $producto)
    {
        $request->validate([
            'cantidad' => 'required|integer|min:1',
        ]);

        $cantidad = $request->cantidad;

        if ($producto->stock->cantidad < $cantidad) {
            return redirect()->back()->with('error', 'Stock insuficiente.');
        }

        // Actualizar stock
        $producto->stock->decrement('cantidad', $cantidad);

        // Registrar venta
        $producto->ventas()->create([
            'cantidad' => $cantidad,
            'precio_unitario' => $producto->precio_nuevo,
            'total' => $producto->precio_nuevo * $cantidad,
        ]);

        // Incrementar ventas del mes
        $producto->increment('ventas_mes', $cantidad);

        return redirect()->back()->with('success', 'Compra realizada exitosamente.');
    }
}
