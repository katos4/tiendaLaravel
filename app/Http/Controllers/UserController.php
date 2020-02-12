<?php

namespace App\Http\Controllers;
use App\Producto;
use App\Categoria;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        
        return view('inicio');
    }

    public function mostrarLogin(){
        $tablaCategorias = Categoria::get();

        return view('login', ['tablaCategorias' => $tablaCategorias]);
    }
}
