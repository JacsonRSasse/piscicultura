<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoProduto extends Model
{
    protected $table = 'tbpedprod';
    protected $primaryKey = ['procodigo', 'pednumero'];
    protected $incrementing = false;
}
