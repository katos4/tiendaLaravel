<?php

namespace App\Http\Controllers;
use App\Producto;
use App\Categoria;
use Cart;

use Illuminate\Http\Request;

class controladorCarrito extends Controller
{


    public function verCarrito(){
       
        $tablaCategorias = Categoria::get();
        return view('carrito', ['tablaCategorias' => $tablaCategorias ]);
    }



    public function addToCart(Request $res){
        $detalles = Producto::find($res->id);


        Cart::add([
            'id'=> $res->id,
            'name' => $detalles->nombre,
            'price' => $detalles->precio,
            'qty'=>$res->cantidad,
        ]);

        $tablaCategorias = Categoria::get();
        return view('carrito', ['tablaCategorias' => $tablaCategorias]);
       
    }


//ELIMINAR
    public function removeFromCart($id){
       // $detalles = Producto::find($id);
        $cart = Cart::content()->where('rowId',$id);
        if($cart->isNotEmpty()){
            Cart::remove($id);
        }
        return back();
    }


//ACTUALIZAR
    public function update(Request $res){
        Cart::update($res->id, $res->cantidad);
        return back();
    }

//VACIAR CARRITO

    public function vaciar(){
        Cart::destroy();

        return redirect('/');
    }



//MOSTRAR FORMULARIO FACTURACION

public function showFacturacion(){

    //dd(Cart::content());

    $tablaCategorias = Categoria::get();
    
    return view('/facturacion',  ['tablaCategorias' => $tablaCategorias]);
}


//----
}
