<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompraProducao extends Model
{
    protected $table = 'tbcompraprod';
    protected $primaryKey = 'cpdnumero';
    public $timestamps = false;
    
    protected $fillable = [
        'cpddetalhe', 'cpdvalor', 'comcodigo', 'peicodigo'
    ];
    
    public function peixe(){
        return $this->hasOne('App\Models\Peixe', 'peicodigo');
    }
    
    public function comprador(){
        return $this->hasOne('App\Models\Comprador', 'comcodigo');
    }
    
    public function negociacoes(){
        return $this->hasMany('App\Models\Negociacao', 'cpdnumero');
    }
}
