<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedidoProduto extends Model
{
    protected $table = 'tbpedprod';
    protected $primaryKey = ['procodigo', 'pednumero'];
    protected $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
    	'ppdquantidade'
    ];
}
