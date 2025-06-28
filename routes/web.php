<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DelmesController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\ProductosBusquedadController;
use App\Http\Controllers\BuscadorController;
use App\Http\Controllers\ObjetivoController;
use App\Http\Controllers\ReclamacionController;
use App\Http\Controllers\TamanoController;
use App\Http\Controllers\SaborController;
use App\Http\Controllers\OpinionController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::resource('/', DelmesController::class);


Route::middleware(['auth'])->group(function () {
    Route::get('/admin/usuarios', [UserController::class, 'index'])->name('admin.usuarios.index');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
Route::get('/gracias', fn () => view('gracias'))->name('gracias');
Route::get('/promociones', function(){
    return view('promociones');
});
Route::get('/politicas_privacidad', function(){
    return view('politicas_de_privacidad');
});
Route::get('/politicas_de_devoluciones', function(){
    return view('politicas_de_devoluciones');
});
Route::get('/terminos_y_condiciones', function(){
    return view('terminos_y_condiciones');
});
Route::get('/politicas_de_envio', function(){
    return view('politicas_de_envio');
});
Route::get('/mis-pedidos', [PedidoController::class, 'indexUsuario'])->name('pedidos.usuario');
Route::get('/admin/pedidos', [PedidoController::class, 'indexAdmin'])->name('pedidos.admin');
Route::resource('/products', ProductosBusquedadController::class);

Route::get('/nosotros', function(){
    return view('nosotros');
});
Route::get('/reclamos', function(){
    return view('reclamos');
});
Route::get('/comentarios', function(){
    return view('comentarios');
});
Route::get('/clickcarro', function(){
    return view('carrito.navigation');
});

Route::resource('productos', ProductoController::class);
Route::post('admin/{producto}/toggle-delmes', [ProductoController::class, 'toggleDelMes'])->name('productos.toggle-delmes');
Route::post('admin/{producto}/comprar', [ProductoController::class, 'comprar'])->name('productos.comprar');


Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
Route::get('/categorias/{categoria}/edit', [CategoriaController::class, 'edit'])->name('categorias.edit');
Route::put('/categorias/{categoria}', [CategoriaController::class, 'update'])->name('categorias.update');
Route::delete('/categorias/{categoria}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');

// Rutas para Marcas
Route::post('/marcas', [MarcaController::class, 'store'])->name('marcas.store');
Route::put('/marcas/{marca}', [MarcaController::class, 'update'])->name('marcas.update');
Route::delete('/marcas/{marca}', [MarcaController::class, 'destroy'])->name('marcas.destroy');
// Carrito de compras
Route::get('/carrito', [CarritoController::class, 'mostrar'])->name('carrito.mostrar');
Route::post('/carrito/agregar', [CarritoController::class, 'agregar'])->name('carrito.agregar');
Route::delete('/carrito/eliminar', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
Route::post('/carrito/actualizar', [CarritoController::class, 'actualizar'])->name('carrito.actualizar'); 
// Checkout y pago
Route::get('/checkout', [PagoController::class, 'checkout'])->name('checkout');
Route::post('/procesar-pago', [PagoController::class, 'procesarPago'])->name('procesar.pago');
Route::get('/gracias', function () {
    return view('gracias');
})->name('gracias');

Route::get('/marcas', [MarcaController::class, 'index'])->name('marcas.index');

//Sabores
Route::get('/tamanos', [SaborController::class, 'index'])->name('sabores.index');
Route::post('/sabores', [SaborController::class, 'store'])->name('sabores.store');
Route::put('/sabores/{sabor}', [SaborController::class, 'update'])->name('sabores.update');
Route::delete('/sabores/{sabor}', [SaborController::class, 'destroy'])->name('sabores.destroy');
//Tamaños
Route::get('/tamanos', [TamanoController::class, 'index'])->name('tamanos.index');
Route::post('/tamanos', [TamanoController::class, 'store'])->name('tamanos.store');
Route::put('/tamanos/{tamano}', [TamanoController::class, 'update'])->name('tamanos.update');
Route::delete('/tamanos/{tamano}', [TamanoController::class, 'destroy'])->name('tamanos.destroy');

Route::get('/objetivos', [ObjetivoController::class, 'index'])->name('objetivos.index');
Route::post('/objetivos', [ObjetivoController::class, 'store'])->name('objetivos.store');
Route::put('/objetivos/{objetivo}', [ObjetivoController::class, 'update'])->name('objetivos.update');
Route::delete('/objetivos/{objetivo}', [ObjetivoController::class, 'destroy'])->name('objetivos.destroy');

//Reclamaciones
Route::get('/libro-reclamaciones', [ReclamacionController::class, 'create'])->name('reclamaciones.create');
Route::post('/libro-reclamaciones', [ReclamacionController::class, 'store'])->name('reclamaciones.store');

Route::get('/reclamaciones', [ReclamacionController::class, 'index'])->name('reclamaciones.index');
Route::get('/reclamaciones/buscar', [ReclamacionController::class, 'buscar'])->name('reclamaciones.buscar');
Route::get('/reclamaciones/{reclamacion}', [ReclamacionController::class, 'show'])->name('reclamaciones.show');
Route::patch('/reclamaciones/{reclamacion}/estado', [ReclamacionController::class, 'updateEstado'])->name('reclamaciones.updateEstado');
Route::delete('/reclamaciones/{reclamacion}', [ReclamacionController::class, 'destroy'])->name('reclamaciones.destroy');

Route::post('/productos/{producto}/opiniones', [OpinionController::class, 'store'])->name('opiniones.store');
Route::post('/carrito/aplicar-cupon', [App\Http\Controllers\CarritoController::class, 'aplicarCupon'])->name('carrito.aplicar-cupon');

Route::middleware(['auth', 'admin'])->resource('cupones', CuponController::class);
Route::middleware('auth')->get('/cupones-disponibles', [CuponController::class, 'verCupones'])->name('cupones.ver');
Route::middleware('auth')->post('/aplicar-cupon', [CarritoController::class, 'aplicarCupon'])->name('carrito.aplicar-cupon');