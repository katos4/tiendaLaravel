<?php

namespace App\Http\Controllers;
use App\Producto;
use App\Categoria;
use App\Pedidos;
use Cart;

use Illuminate\Http\Request;

class controladorPedidos extends Controller
{
    
    public function addPedido(Request $res){
        $fecha = date("Y-m-d");

        Pedidos::insert(["user_id" => $res->userId, "fecha_realizacion" =>$fecha, "estado"=>1, "direccion" =>$res->direccion, "codigo" =>$res->codigoPostal, "nombre_user" => $res->name, "email_user" => $res->email ]);
        //Cart::clear();
        return redirect('/');
    }








}
