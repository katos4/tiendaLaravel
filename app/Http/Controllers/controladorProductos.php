<?php

namespace App\Http\Controllers;
use App\Producto;
use App\Categoria;
use Illuminate\Http\Request;

class controladorProductos extends Controller
{

   protected function localizacion(){
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'http://ip-api.com/json/?lang=es&fields=city,country');
        $localizacion = json_decode($response->getBody());
        return $localizacion;
    }
    
    
    //mostrar los productos destacados 
    public function mostrarMenuyDestacados(){
        $productosDes = Producto::where('anuncio','1')->get();
        $tablaCategorias = Categoria::get();
    
      /*  $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'http://ip-api.com/json/?lang=es&fields=city,country');
        $localizacion = json_decode($response->getBody());*/
           

        return view('paginaPrincipal',
        ['productosDes' =>$productosDes, 'tablaCategorias' => $tablaCategorias, 'localizacion'=>$this->localizacion()]);
        
    }

 
    public function menuHealthy($categoria){
        $productosH = Producto::where('categorias_id',$categoria)->paginate(8);
        $tablaCategorias = Categoria::get();
        return view('productosMostrados', compact('productosH'), [
            'productosH' => $productosH,
            'tablaCategorias' => $tablaCategorias, 'localizacion'=>$this->localizacion()
        ]);
    }

   public function mostrarDetalles($idProducto){
       $detalles = Producto::where('id_producto',$idProducto)->get();
       $tablaCategorias = Categoria::get();
       return view('detallesProducto', [
           'detalles' => $detalles,
           'tablaCategorias' => $tablaCategorias, 'localizacion'=>$this->localizacion()
       ]);
   } 

}
