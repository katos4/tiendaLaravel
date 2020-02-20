<?php

namespace App\Http\Controllers;
use App\Producto;
use App\Categoria;
use App\Pedidos;
use App\PedidoProducto;
use Cart;
use Mail;
use Barryvdh\DomPDF\Facade as PDF;

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
            "total" => $total,
            "contenidoCarrito" => Cart::content()
        ];

        //envia email y adjunta PDF
          $pdf = PDF::loadView('mail', $arrayDatos);

          Mail::send('mail', $arrayDatos, function($message) use ($pdf) {
            $message->from('gregfdez077@gmail.com','Resumen del pedido');
            $message->to('gregoharriero@gmail.com', 'Grego')
                    ->subject('Factura pedido MyTotem');
            $message -> attachData($pdf->output(), 'Resumen_Pedido.pdf');
            
            });
       
        //inserta los datos del pedido en la tabla pedidos
       $pedido = Pedidos::create(["user_id" => $res->userId, "fecha_realizacion" =>$fecha, "estado"=>1, "direccion" =>$res->direccion, "codigo" =>$res->codigoPostal, "nombre_user" => $res->userName, "email_user" => $res->userEmail ]);
       
       $id=$pedido->id; 
       
        /*coge el id del ultimo pedido insertado, saca los datos de cada item del carrito y los inserta
        en la tabla pedido_has_producto*/
      
        foreach(Cart::content() as $item){
           
            PedidoProducto::create(["cantidad" =>Cart::get($item->rowId)->qty, 
            "precio" =>Cart::get($item->rowId)->price, 
            "descuento"=>0, 
            "pedido_id"=>$id, 
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
