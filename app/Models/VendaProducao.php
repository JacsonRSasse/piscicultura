<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendaProducao extends Model
{
    protected $table = 'tbvendaproducao';
    protected $primaryKey = 'vennumero';
    public $timestamps = false;

    protected $fillable = [
    	'venpesomediotipo',
    	'venpreco', 
    	'vendetalhe',
    	'memcodigo',
    	'peicodigo' 
    ];

    public function membro(){
    	return $this->hasOne('App\Models\Membro', 'memcodigo');
    }

    public function peixe(){
    	return $this->hasOne('App\Models\Peixe', 'peicodigo');
    }

    public function negociacao(){
        return $this->hasOne('App\Models\Negociacao', 'vennumero');
    }
}
