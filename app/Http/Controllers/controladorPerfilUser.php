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
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class controladorPerfilUser extends Controller
{

  protected function localizacion(){
    $client = new \GuzzleHttp\Client();
    $response = $client->request('GET', 'http://ip-api.com/json/?lang=es&fields=city,country');
    $localizacion = json_decode($response->getBody());
    return $localizacion;
}


  //Muestra el perfil del usuario
  public function verPerfil(){
    $tablaCategorias = Categoria::get();
    $id = Auth()->id();
    $numeroPedidos = Pedidos::where('user_id', $id)->count();
    //$datosUsuario = User::where('id', $id)->get();
   

    return view('perfilUsuario',  ['tablaCategorias' => $tablaCategorias,
    'numeroPedidos' => $numeroPedidos, 'localizacion'=>$this->localizacion()]);
  }



  //Muestra formulario para editar los datos del usuario
public function editarForm(){
  $tablaCategorias = Categoria::get();
  $id = Auth()->id();
  $datosUsuario = User::where('id', $id)->get();
  return view('/editarForm', ['tablaCategorias' => $tablaCategorias,'datosUsuario'=>$datosUsuario, 'localizacion'=>$this->localizacion()]);
}



//Actualiza los datos editados del usuario
public function editarDatos(Request $res){
  $id = Auth()->id();

  User::where('id', $id)->update(['name'=>$res->nombreCambiar, 'email' =>$res->emailCambiar,
  'nombreApellidos' =>$res->nombreApellidosCambiar, 'direccion'=>$res->direccionCambiar,
  'dni'=>$res->dniCambiar]);

  return redirect('/verPerfil')->with('message', 'Se han editado los datos correctamente');
}



//Muestra los pedidos del usuario
public function verPedidos(){
  $tablaCategorias = Categoria::get();
  $id = Auth()->id();
  $pedido = Pedidos::where('user_id', $id)->get();
  return view('verPedidos',  ['tablaCategorias' => $tablaCategorias, 'pedido'=>$pedido, 'localizacion'=>$this->localizacion()]);
}



//Muestra la factura de un pedido en PDF en el navegador
public function facturaPDF(Request $res){
  $idPedido = $res->pedidoId;
  //$pedido = PedidoProducto::where('pedido_id', $idPedido)->get();

  $pedido = DB::table('pedido')
            ->where('id_pedido', $idPedido)
            ->join('pedido_has_productos', 'pedido_has_productos.pedido_id', 'pedido.id_pedido')
            ->join('productos', 'productos.id_producto', 'pedido_has_productos.productos_id')
            ->select('pedido_has_productos.*', 'pedido.*', 'productos.nombre')
            ->get();
    //dd($pedido);
          
foreach($pedido as $p){
    $data=[
      'nombreUs'=> $p->nombre_user,
      'emailUs' => $p->email_user,
      'dir'=> $p->direccion,
      'fechaRe'=> $p->fecha_realizacion,
      'numPed' =>$p->id_pedido,
    
    ];
}

  return PDF::loadView('facturaPdf', $data, ['pedido'=>$pedido])
    ->stream('Factura_simplificada.pdf');
}



//Cancela la cuenta de un usuario
public function darBaja(Request $res){
  $id = Auth()->user()->id;
  $user = User::find($id);
  $user->update([
    'baja'=>1, 
    'email' => $user->email."-".time(),
  ]);

  $user->delete();
  return redirect('/');
}




public function exportarProductos(){

  /*$productos = Producto::where('Status', '=', 'ON')
    ->orderBy('updated_at', 'asc'); //->get() here brings an error.*/

    $productos = Producto::all();

    foreach ($productos as $p) {
      $data=[
        'nombre'=>$p['nombre'],
      ];
    }
    $xml = new \SimpleXMLElement('');
    array_walk_recursive($data, array ($xml,'addChild'));
   // print $xml->asXML();
  //dd($xml);
return Redirect::route('/');
   
}



//Cambia la contraseña del usuario
public function cambioClave(Request $res){
  $id = $res->id;

  $clave=bcrypt($res->nuevaClave);
  $usuario = User::find($id)->update(['password' =>$clave]);
  return redirect('/verPerfil')->with('message', 'La clave se ha cambiado correctamente');
}


public function confirmacionBaja(){
  $tablaCategorias = Categoria::get();

  return view('confirmacionBaja', ['tablaCategorias' => $tablaCategorias, 'localizacion'=>$this->localizacion()]);
}
//----
}
