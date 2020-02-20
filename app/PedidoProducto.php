<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoProducto extends Model
{
    protected $table ='pedido_has_productos';

    protected $fillable = [
        'cantidad',
        'precio',
        'descuento',
        'pedido_id',
        'productos_id',
        'updated_at',
        'created_at'
    ];
}
