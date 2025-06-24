<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Marca;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $productos = Producto::with('categoria', 'marca', 'stock')->get();
        $categorias = Categoria::all();
        $marcas = Marca::all();

        return view('admin', compact('productos', 'categorias', 'marcas'));
    }
    
}
