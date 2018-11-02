<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'tbpedido';
    protected $primaryKey = 'pednumero';
}
