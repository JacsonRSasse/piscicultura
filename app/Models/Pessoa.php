<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    const TIPO_FISICA   = 1;
    const TIPO_JURIDICA = 2;


    protected $table = 'tbpessoa';
    protected $primaryKey = 'pescodigo';
    public $timestamps = false;
    public $incrementing = true;
       
    function getListaTipoPessoa(){
        $aLista = [
            self::TIPO_FISICA   => 'Fisíca',
            self::TIPO_JURIDICA => 'Jurídica'
        ];
        return $aLista;
    }
    
    public function membro() {
        return $this->hasOne('App\Models\Membro', 'pescodigo');
    }
    
    public function user(){
        return $this->hasOne('App\Models\User', 'pescodigo');
    }

    public function fornecedor(){
        return $this->hasOne('App\Models\Fornecedor', 'pescodigo');
    }

    public function pedidos(){
        return $this->hasMany('App\Models\Pedido', 'pescodigo');
    }

    public function comprador(){
        return $this->hasOne('App\Models\Comprador', 'pescodigo');
    }

}
