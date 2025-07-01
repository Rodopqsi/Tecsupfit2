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
    // Este método muestra la lista de productos, con filtros y paginación
    public function index(Request $request)
    {
        $query = Producto::with(['categoria', 'marca', 'stock']);

        // Si el usuario busca algo, filtramos por eso
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Filtrar por categoría si se seleccionó una
        if ($request->filled('categoria')) {
            $query->byCategoria($request->categoria);
        }

        // Filtrar por marca si se seleccionó una
        if ($request->filled('marca')) {
            $query->byMarca($request->marca);
        }

        // Filtrar por rango de precios si se puso mínimo y máximo
        if ($request->filled('precio_min') && $request->filled('precio_max')) {
            $query->byPrecio($request->precio_min, $request->precio_max);
        }

        // Paginamos los productos, 12 por página
        $productos = $query->paginate(12);
        $categorias = Categoria::all();
        $marcas = Marca::all();

        // Mostramos la vista con los datos
        return view('productos.index', compact('productos', 'categorias', 'marcas'));
    }

    // Muestra el formulario para crear un producto nuevo
    public function create()
    {
        $categorias = Categoria::all();
        $marcas = Marca::all();
        return view('productos.create', compact('categorias', 'marcas'));
    }

    // Guarda el producto nuevo en la base de datos
    public function store(Request $request)
    {
        // Validamos los datos que llegan del formulario
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

        // Creamos el stock primero
        $stock = Stock::create([
            'cantidad' => $request->stock_cantidad,
            'stock_minimo' => $request->stock_minimo,
        ]);

        // Ahora creamos el producto y le asignamos el stock
        $producto = new Producto($request->except(['stock_cantidad', 'stock_minimo']));
        $producto->stock_id = $stock->id;

        // Si subieron una imagen, la guardamos
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '.' . $imagen->getClientOriginalExtension();
            $imagen->move(public_path('images/productos'), $nombreImagen);
            $producto->imagen = $nombreImagen;
        }

        $producto->save();

        // Redirigimos con mensaje de éxito
        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente.');
    }

    // Muestra los detalles de un producto
    public function show(Producto $producto)
    {
        $producto->load(['categoria', 'marca', 'stock']);
        return view('productos.show', compact('producto'));
    }

    // Muestra el formulario para editar un producto
    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();
        $marcas = Marca::all();
        $producto->load('stock');
        return view('productos.edit', compact('producto', 'categorias', 'marcas'));
    }

    // Actualiza el producto en la base de datos
    public function update(Request $request, Producto $producto)
    {
        // Validamos los datos que llegan del formulario
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

        // Actualizamos el stock del producto
        $producto->stock->update([
            'cantidad' => $request->stock_cantidad,
            'stock_minimo' => $request->stock_minimo,
        ]);

        // Actualizamos los datos del producto
        $producto->fill($request->except(['stock_cantidad', 'stock_minimo']));

        // Si subieron una imagen nueva, borramos la anterior y guardamos la nueva
        if ($request->hasFile('imagen')) {
            // Borramos la imagen vieja si existe
            if ($producto->imagen && file_exists(public_path('images/productos/' . $producto->imagen))) {
                unlink(public_path('images/productos/' . $producto->imagen));
            }

            $imagen = $request->file('imagen');
            $nombreImagen = time() . '.' . $imagen->getClientOriginalExtension();
            $imagen->move(public_path('images/productos'), $nombreImagen);
            $producto->imagen = $nombreImagen;
        }

        $producto->save();

        // Redirigimos con mensaje de éxito
        return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente.');
    }

    // Elimina un producto (y su imagen si tiene)
    public function destroy(Producto $producto)
    {
        // Si tiene imagen, la borramos del servidor
        if ($producto->imagen && file_exists(public_path('images/productos/' . $producto->imagen))) {
            unlink(public_path('images/productos/' . $producto->imagen));
        }

        // El stock se borra solo por la relación en la base de datos
        $producto->delete();

        // Redirigimos con mensaje de éxito
        return redirect()->route('productos.index')->with('success', 'Producto eliminado exitosamente.');
    }

    // Cambia si el producto es "del mes" o no
    public function toggleDelMes(Producto $producto)
    {
        $producto->update(['es_delmes' => !$producto->es_delmes]);
        
        $mensaje = $producto->es_delmes ? 'Producto agregado a Del Mes' : 'Producto removido de Del Mes';
        
        return redirect()->back()->with('success', $mensaje);
    }

    // Método para comprar un producto (descuenta stock y registra la venta)
    public function comprar(Request $request, Producto $producto)
    {
        $request->validate([
            'cantidad' => 'required|integer|min:1',
        ]);

        $cantidad = $request->cantidad;

        // Si no hay suficiente stock, avisamos
        if ($producto->stock->cantidad < $cantidad) {
            return redirect()->back()->with('error', 'Stock insuficiente.');
        }

        // Descontamos el stock
        $producto->stock->decrement('cantidad', $cantidad);

        // Registramos la venta
        $producto->ventas()->create([
            'cantidad' => $cantidad,
            'precio_unitario' => $producto->precio_nuevo,
            'total' => $producto->precio_nuevo * $cantidad,
        ]);

        // Sumamos la venta al contador del mes
        $producto->increment('ventas_mes', $cantidad);

        // Redirigimos con mensaje de éxito
        return redirect()->back()->with('success', 'Compra realizada exitosamente.');
    }
}
