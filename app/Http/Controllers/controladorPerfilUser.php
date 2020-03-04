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
/**
 * Muestra en la pagina el sitio desde donde se conecta el usuario, este metodo se repite en todos los controladores
 *
 * @return void
 */
  protected function localizacion(){
    $client = new \GuzzleHttp\Client();
    $response = $client->request('GET', 'http://ip-api.com/json/?lang=es&fields=city,country');
    $localizacion = json_decode($response->getBody());
    return $localizacion;
}


  /**
   * Muestra la vista del perfil del usuario
   *
   * @return void
   */
  public function verPerfil(){
    $tablaCategorias = Categoria::get();
    $id = Auth()->id();
    $numeroPedidos = Pedidos::where('user_id', $id)->count();
    //$datosUsuario = User::where('id', $id)->get();
   

    return view('perfilUsuario',  ['tablaCategorias' => $tablaCategorias,
    'numeroPedidos' => $numeroPedidos, 'localizacion'=>$this->localizacion()]);
  }



 /**
  * Muestra un formulario donde el usuario puede editar sus datos
  *
  * @return void
  */
public function editarForm(){
  $tablaCategorias = Categoria::get();
  $id = Auth()->id();
  $datosUsuario = User::where('id', $id)->get();
  return view('/editarForm', ['tablaCategorias' => $tablaCategorias,'datosUsuario'=>$datosUsuario, 'localizacion'=>$this->localizacion()]);
}



/**
 * Actualiza los datos del formulario que el usuario ha introducido previamente
 *
 * @param Request $res
 * @return void
 */
public function editarDatos(Request $res){
  $id = Auth()->id();

  User::where('id', $id)->update(['name'=>$res->nombreCambiar, 'email' =>$res->emailCambiar,
  'nombreApellidos' =>$res->nombreApellidosCambiar, 'direccion'=>$res->direccionCambiar,
  'dni'=>$res->dniCambiar]);

  return redirect('/verPerfil')->with('message', 'Se han editado los datos correctamente');
}



/**
 * Muestra los pedidos que ha hecho el usuario
 *
 * @return void
 */
public function verPedidos(){
  $tablaCategorias = Categoria::get();
  $id = Auth()->id();
  $pedido = Pedidos::where('user_id', $id)->get();
  return view('verPedidos',  ['tablaCategorias' => $tablaCategorias, 'pedido'=>$pedido, 'localizacion'=>$this->localizacion()]);
}



/**
 * Muestra una factura en pdf del pedido seleccionado en el perfil del usuario
 *
 * @param Request $res
 * @return void
 */
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
      'totalPagado'=>$p->totalPagado,
    ];
}

  return PDF::loadView('facturaPdf', $data, ['pedido'=>$pedido])
    ->stream('Factura_simplificada.pdf');
}



/**
 * Cancela la cuenta de un usuario
 *
 * @param Request $res
 * @return void
 */
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



/**
 * Exporta las tablas de la base de datos en formato XML (este metodo no funciona)
 *
 * @return void
 */
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



/**
 * Cambia la contraseña del usuario
 *
 * @param Request $res
 * @return void
 */
public function cambioClave(Request $res){
  $id = $res->id;

  $clave=bcrypt($res->nuevaClave);
  $usuario = User::find($id)->update(['password' =>$clave]);
  return redirect('/verPerfil')->with('message', 'La clave se ha cambiado correctamente');
}

/**
 * Muestra un formulario de confirmacion antes de dar de baja la cuenta del usuario
 *
 * @return void
 */
public function confirmacionBaja(){
  $tablaCategorias = Categoria::get();

  return view('confirmacionBaja', ['tablaCategorias' => $tablaCategorias, 'localizacion'=>$this->localizacion()]);
}
//----
}
