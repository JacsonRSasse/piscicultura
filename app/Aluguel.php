<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Membro;
use App\EquipamentoAluguel;

class Aluguel extends Model
{
    const STATUS_EM_CARRINHO = -1;
    const STATUS_EM_ANDAMENTO = 1;
    const STATUS_NA_FILA = 2;
    
    protected $table = 'tbaluguel';
    protected $primaryKey = 'alunumero';
    public $timestamps = false;
    
    
    function getNumero(){
        return $this->alunumero;
    }
    
    function setNumero() {
        $oUltimoAluguel = Aluguel::orderBy('alunumero', 'asc')->select('alunumero')->first();
        if($oUltimoAluguel){
            $this->alunumero = $oUltimoAluguel->getNumero() + 1;
        } else {
            $this->alunumero = 1;
        }
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
        $this->memcodigo = $membro;
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
    
    function getStatus(){
        return $this->alustatus;
    }
    
    function setStatus($status){
        $this->alustatus = $status;
    }
    
    /**
     * @return App\Equipamento
     */
    function getEquipamentosFromAluguel(){
        return $this->belongsToMany('App\Equipamento', 'tbequipaluguel', 'alunumero', 'eqpcodigo');
    }
    
    function setRelacionamentoTabelaTerciaria($iEquipamento){
        $oEquipAluguel = new EquipamentoAluguel();
        $oEquipAluguel->setEquipamento($iEquipamento);
        $oEquipAluguel->setAluguel($this->getNumero());
        $oEquipAluguel->setQuantidade(1);
    }
}
