<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'tbproduto';
    protected $primaryKey = 'procodigo';
    public $timestamps = false;

    protected $fillable = [
    	'prodescricao', 'forcodigo'
    ];

    public function racoes(){
    	return $this->belongsToMany('App\Models\Racao', 'tbprodutoracao', 'procodigo', 'raccodigo');
    }

    public function pedidos(){
        return $this->belongsToMany('App\Models\Produto', 'tbpedidoproduto', 'procodigo', 'pednumero');
    }

    public function fornecedor(){
    	return $this->hasOne('App\Models\Fornecedor', 'forcodigo');
    }
}
