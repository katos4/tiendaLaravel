<?php

namespace App\Http\Controllers;
use App\Producto;
use App\Categoria;
use App\Pedidos;
use Cart;
use Mail;

use Illuminate\Http\Request;

class controladorPedidos extends Controller
{
    
   public function crearPedido(Request $res){
        $fecha = date("Y-m-d");
        $total = Cart::total();
        $contenidoCarrito = Cart::content();
        $tablaCategorias = Categoria::get();

        $arrayDatos = [
            "direccion" => $res->direccion,
            "codigo" =>$res->codigoPostal,
            "nombre_user" => $res->userName, 
            "email_user" => $res->userEmail,
            "total" => $total
        ];

         /* Mail::send('mail', $arrayDatos, function($message) {
            $message->to('gregoharriero@gmail.com', 'Grego')
                    ->subject('Factura pedido MyTotem');
            $message->from('gregfdez077@gmail.com','Resumen del pedido');
            });*/

        Pedidos::insert(["user_id" => $res->userId, "fecha_realizacion" =>$fecha, "estado"=>1, "direccion" =>$res->direccion, "codigo" =>$res->codigoPostal, "nombre_user" => $res->userName, "email_user" => $res->userEmail ]);
        
        return view('/pedidoRealizado',  ['tablaCategorias' => $tablaCategorias, 
                    "arrayDatos" => $arrayDatos, 
                    "contenidoCarrito"=>$contenidoCarrito]);
       
    }


    public function aceptar(){
        Cart::destroy();
        return redirect('/');
    }

   








}
