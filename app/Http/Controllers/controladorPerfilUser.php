<?php

namespace App\Http\Controllers;
use App\Producto;
use App\Categoria;
use App\Pedidos;
use App\PedidoProducto;
use App\User;
use Cart;
use Mail;
use Barryvdh\DomPDF\Facade as PDF;

use Illuminate\Http\Request;

class controladorPerfilUser extends Controller
{
  public function verPerfil(){
    $tablaCategorias = Categoria::get();
    
    $id = Auth()->id();

    $numeroPedidos = Pedidos::where('user_id', $id)->count();
    $datosUsuario = User::where('id', $id)->get();
   
  
    return view('perfilUsuario',  ['tablaCategorias' => $tablaCategorias,
    'numeroPedidos' => $numeroPedidos, 'datosUsuario' =>$datosUsuario]);
  }



public function editarDatos(Request $res){
  $id = Auth()->id();

  User::where('id', $id)->update(['name'=>$res->nombreCambiar, 'email' =>$res->emailCambiar,
  'nombreApellidos' =>$res->nombreApellidosCambiar, 'direccion'=>$res->direccionCambiar,
  'dni'=>$res->dniCambiar]);

  return back();
}



public function verPedidos(){
  $tablaCategorias = Categoria::get();
  $id = Auth()->id();

  $pedido = Pedidos::where('user_id', $id)->get();

  return view('verPedidos',  ['tablaCategorias' => $tablaCategorias, 'pedido'=>$pedido]);
}



public function facturaPDF(Request $res){
$idPedido = $res->pedidoId;
$pedido = PedidoProducto::where('pedido_id', $idPedido)->get();
foreach($pedido as $ped){
$data = [
  'cantidad' => $ped['cantidad'],
];

}

return PDF::loadView('facturaPdf', $data)
  ->stream('Factura_simplificada.pdf');

 
}


public function darBaja(Request $res){
  $id = $res->id;

  User::where('id',$id)->delete();

  return redirect('/');
}

//----
}
