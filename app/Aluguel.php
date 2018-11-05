<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Membro;

class Aluguel extends Model
{
    protected $table = 'tbaluguel';
    protected $primaryKey = 'alunumero';
    
    
    function getNumero(){
        return $this->alunumero;
    }
    
    function setNumero($numero) {
        $this->alunumero = $numero;
    }
    
    function getPosicaoFila(){
        return $this->aluposfila;
    }
    
    function setPosicaoFila($posicao){
        $this->aluposfila = $posicao;
    }
    
    /** @return Membro */
    function getMembroFromAluguel(){
        return $this->belongsTo('App\Membro', 'memcodigo');
    }
    
    function setMembro($membro){
        $this->memcodigo = $$membro;
    }
    
    function getDataInicio(){
        return $this->aludatainicio;
    }
    
    function setDataInicio($data){
        $this->aludatainicio = $data;
    }
    
    function getDataFim(){
        return $this->aludatafim;
    }
    
    function setDataFim($data){
        $this->aludatafim = $data;
    }
    
    function getValor(){
        return $this->aluvalor;
    }
    
    function setValor($valor){
        $this->aluvalor = $valor;
    }    
    
    /**
     * @return App\Equipamento
     */
    function getEquipamentosFromAluguel(){
        return $this->belongsToMany('App\Equipamento', 'tbequipaluguel', 'alunumero', 'eqpcodigo');
    }
}
