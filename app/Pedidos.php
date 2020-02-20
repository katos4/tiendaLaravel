<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    protected $table ='pedido';

    protected $fillable = [
        'id_pedido',
        'user_id',
        'fecha_realizacion',
        'estado',
        'direccion',
        'codigo',
        'nombre_user',
        'email_user',
        'updated_at',
        'created_at'
    ];
}
