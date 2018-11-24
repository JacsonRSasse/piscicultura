<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'tbpedido';
    protected $primaryKey = 'pednumero';
    public $timestamps = false;

    public function pessoa(){
    	return $this->hasOne('App\Models\Pessoa', 'pescodigo');
    }

    public function produtos(){
    	return $this->belongsToMany('App\Models\Produto', 'tbpedidoproduto', 'pednumero', 'procodigo');
    }
}
