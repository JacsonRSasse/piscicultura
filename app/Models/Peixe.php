<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peixe extends Model
{
    protected $table = 'tbpeixe';
    protected $primaryKey = 'peicodigo';
    public $timestamps = false;

    public function produtos(){
    	return $this->belongsToMany('App\Models\Produto', 'tbprodutopeixe', 'peicodigo', 'procodigo');
    }

    public function compraProducao(){
    	return $this->hasMany('App\Models\CompraProducao', 'peicodigo');
    }

    public function vendaProducao(){
    	return $this->hasMany('App\Models\VendaProducao', 'peicodigo');
    }
}
