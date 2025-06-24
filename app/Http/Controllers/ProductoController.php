<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Objetivo;
use App\Models\Tamano;
use App\Models\Sabor;
use App\Models\Stock;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->user()?->is_admin) {
        abort(403);
        }
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

        $productos = $query->paginate(9);
        $categorias = Categoria::all();
        $marcas = Marca::all();
        $objetivos = Objetivo::all();
        $tamanos = Tamano::all();
        $sabores = Sabor::all();

        return view('productos.index', compact('productos', 'categorias', 'marcas', 'objetivos', 'tamanos', 'sabores'));
    }

    public function create()
    {
        if (!auth()->user()?->is_admin) {
        abort(403);
        }
        $categorias = Categoria::all();
        $marcas = Marca::all();
        $objetivos = Objetivo::all();
        $tamanos = Tamano::all();
        $sabores = Sabor::all();
        return view('productos.create', compact('categorias', 'marcas', 'objetivos', 'tamanos', 'sabores'));
    }

    public function store(Request $request)
    {
        if (!auth()->user()?->is_admin) {
        abort(403);
        }
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio_nuevo' => 'required|numeric|min:0',
            'precio_antes' => 'nullable|numeric|min:0',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'descripcion' => 'required|string',
            'tamano_id' => 'nullable|exists:tamanos,id',
            'sabor_id' => 'nullable|exists:sabores,id',
            'categoria_id' => 'required|exists:categorias,id',
            'marca_id' => 'required|exists:marcas,id',
            'objetivo_id' => 'nullable|exists:objetivos,id',
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
        $producto->load(['categoria', 'marca', 'objetivo', 'tamano', 'sabor', 'stock']);
    
        $relacionados = Producto::where('categoria_id', $producto->categoria_id)
            ->where('id', '!=', $producto->id)
            ->take(10)
            ->get();
    
        return view('productos.show', compact('producto', 'relacionados'));
    }


    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();
        $marcas = Marca::all();
        $objetivos = Objetivo::all();
        $tamanos = Tamano::all();
        $sabores = Sabor::all();
        $producto->load('stock');
        return view('productos.edit', compact('producto', 'categorias', 'marcas', 'objetivos', 'tamanos', 'sabores'));
    }

    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio_nuevo' => 'required|numeric|min:0',
            'precio_antes' => 'nullable|numeric|min:0',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'descripcion' => 'required|string',
            'tamano_id' => 'nullable|exists:tamanos,id',
            'sabor_id' => 'nullable|exists:sabores,id',
            'categoria_id' => 'required|exists:categorias,id',
            'marca_id' => 'required|exists:marcas,id',
            'objetivo_id' => 'nullable|exists:objetivos,id',
            'stock_cantidad' => 'required|integer|min:0',
            'stock_minimo' => 'required|integer|min:0',
        ]);

        if (!$producto->relationLoaded('stock')) {
            $producto->load('stock');
        }

        if (!$producto->stock) {
            $stock = Stock::create([
                'cantidad' => $request->stock_cantidad,
                'stock_minimo' => $request->stock_minimo,
            ]);
            $producto->stock_id = $stock->id;
            $producto->save();
            $producto->load('stock');
        } else {
            $producto->stock->update([
                'cantidad' => $request->stock_cantidad,
                'stock_minimo' => $request->stock_minimo,
            ]);
        }

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
        try {
            if (!$producto->relationLoaded('stock')) {
                $producto->load('stock');
            }
            if ($producto->imagen && file_exists(public_path('images/productos/' . $producto->imagen))) {
                unlink(public_path('images/productos/' . $producto->imagen));
            }
            if ($producto->stock) {
                $producto->stock->delete();
            }
            $producto->delete();

            return redirect()->route('productos.index')->with('success', 'Producto eliminado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('productos.index')->with('error', 'Error al eliminar el producto: ' . $e->getMessage());
        }
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

        // Cargar la relación stock si no está cargada
        if (!$producto->relationLoaded('stock')) {
            $producto->load('stock');
        }

        if (!$producto->stock || $producto->stock->cantidad < $cantidad) {
            return redirect()->back()->with('error', 'Stock insuficiente.');
        }

        // Actualizar stock
        $producto->stock->decrement('cantidad', $cantidad);

        // Registrar venta (asumiendo que tienes un modelo Venta)
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