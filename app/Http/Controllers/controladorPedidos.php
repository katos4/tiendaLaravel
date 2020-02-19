<?php

namespace App\Http\Controllers;
use App\Producto;
use App\Categoria;
use App\Pedidos;
use App\PedidoProducto;
use Cart;
use Mail;

use Illuminate\Http\Request;

class controladorPedidos extends Controller
{
    
   public function crearPedido(Request $res){
        $fecha = date("Y-m-d");
        $total = Cart::total();
        //$contenidoCarrito = Cart::content();
        $tablaCategorias = Categoria::get();

        $arrayDatos = [
            "direccion" => $res->direccion,
            "codigo" =>$res->codigoPostal,
            "nombre_user" => $res->userName, 
            "email_user" => $res->userEmail,
            "total" => $total
        ];

        //envia email
          Mail::send('mail', $arrayDatos, function($message) {
            $message->to('gregoharriero@gmail.com', 'Grego')
                    ->subject('Factura pedido MyTotem');
            $message->from('gregfdez077@gmail.com','Resumen del pedido');
            });
       
        //inserta los datos del pedido en la tabla pedidos
        Pedidos::insert(["user_id" => $res->userId, "fecha_realizacion" =>$fecha, "estado"=>1, "direccion" =>$res->direccion, "codigo" =>$res->codigoPostal, "nombre_user" => $res->userName, "email_user" => $res->userEmail ]);
        
        /*coge el id del ultimo pedido insertado, saca los datos de cada item del carrito y los inserta
        en la tabla pedido_has_producto*/
        $idPedido = Pedidos::where('email_user', $res->userEmail)->first()->id_pedido;
        
        foreach(Cart::content() as $item){
           
            PedidoProducto::insert(["cantidad" =>Cart::get($item->rowId)->qty, 
            "precio" =>Cart::get($item->rowId)->price, 
            "descuento"=>0, 
            "pedido_id"=>$idPedido, 
            "productos_id" =>Cart::get( $item->rowId)->id ]);
          }
    

        return view('/pedidoRealizado',  ['tablaCategorias' => $tablaCategorias, 
                    "arrayDatos" => $arrayDatos, 
                   ]);
       
    }


    public function aceptar(){
        Cart::destroy();
        return redirect('/');
    }

   








}
