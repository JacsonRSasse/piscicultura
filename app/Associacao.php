<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Associacao extends Model
{
    protected $table = 'tbassociacao';
    protected $primaryKey = 'asccodigo';
    
    public function getEquipamentosForAssociacao(){
        return $this->hasMany('App\Equipamento', 'asccodigo');
    }
    
    function getCodigo(){
        return $this->asccodigo;
    }
    
    function setCodigo($codigo) {
        $this->asccodigo = $codigo;
    }
    
    function getNome(){
        return $this->ascnome;
    }
    
    function setNome($nome){
        $this->ascnome = $nome;
    }
    
    function getMembrosFromAssociacao(){
        return $this->hasMany('App\Membro', $this->primaryKey);
    }
    
    function getEquipamentosFromAssociacao(){
        return $this->hasMany('App\Equipamento', $this->primaryKey);
    }
}
