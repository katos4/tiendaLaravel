<?php

namespace App\Http\Controllers;
use App\Producto;
use App\Categoria;
use Cart;
use Auth;


use Illuminate\Http\Request;

class controladorLogin extends Controller
{
    public function login(Request $res){
        $productosDes = Producto::where('anuncio','1')->get();
        $tablaCategorias = Categoria::get();
    if(Auth::attempt(['usuario' =>$res->user, 'clave' => $res->pass])){
        return view('paginaPrincipal', ['productosDes' =>$productosDes, 'tablaCategorias' => $tablaCategorias ]);
        }else{
            return back();
        }
        
       
    }
}
