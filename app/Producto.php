<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use db;

class Producto extends Model
{
    protected $primaryKey = 'id_producto';
    protected $table = 'productos';

    public $timestamps = false;

}
