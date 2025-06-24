<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
{
    if (!auth()->user()->is_admin) {
        abort(403);
    }

    $usuarios = \App\Models\User::latest()->get();
    return view('admin.usuarios.index', compact('usuarios'));
}

}

