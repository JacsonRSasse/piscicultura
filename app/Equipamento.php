<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Associacao;

class Equipamento extends Model
{
    const STATUS_DISPONIVEL      = 1;
    const STATUS_ALUGADO         = 2;
    const STATUS_ALUGADO_PARCIAL = 3;
    const STATUS_REPAROS         = 4;
        
    protected $table = 'tbequipamento';
    protected $primaryKey = 'eqpcodigo';
    public $timestamps = false;
        
    function getCodigo(){
        return $this->eqpcodigo;
    }
    
    function setCodigo($codigo){
        $this->eqpcodigo = $codigo;
    }
    
    function getNome() {
        return $this->eqpnome;
    }
    
    function setNome($nome){
        $this->eqpnome = $nome;
    }
    
    /** @return Associacao */
    function getAssociacaoFromEquipamento(){
        return $this->hasOne('App\Associacao', 'asccodigo');
    }
    
    function setAssociacao($associacao){
        $this->asccodigo = $associacao;
    }
    
    function getImagemPath(){
        return $this->eqpimagem;
    }
    
    function setImagemPath($path){
        $this->eqpimagem = $path;
    }
    
    function getStatus(){
        return $this->eqpstatus;
    }
    
    function setStatus($stauts){
        $this->eqpstatus = $stauts;
    }
    
    function getDescricaoStatus(){
        $aLista = [
            self::STATUS_DISPONIVEL => 'Disponível',
            self::STATUS_ALUGADO => 'Alugado',
            self::STATUS_ALUGADO_PARCIAL => 'Alugado Parcial',
            self::STATUS_REPAROS => 'Em Reparos',
        ];
        return $aLista[$this->getStatus()];
    }
    
    function getPrecoDia(){
        return $this->eqpprecodia;
    }
    
    function setPrecoDia($precoDia){
        $this->eqpprecodia = $precoDia;
    }
    
    function getDetalhe(){
        return $this->eqpdetalhe;
    }
    
    function setDetalhe($detalhe){
        $this->eqpdetalhe = $detalhe;
    }
    
    function getQuantidade() {
        return $this->eqpquantidade;
    }
    
    function setQuantidade($quantidade) {
        $this->eqpquantidade = $quantidade;
    }
    
    function getAlugueisFromEquipamento(){
        return $this->belongsToMany('App\Aluguel', 'tbequipaluguel', 'eqpcodigo', 'alunumero');
    }
    
    function isAlugado(){
        return $this->getStatus() == self::STATUS_ALUGADO;
    }
    
    function isDisponivel(){
        return $this->getStatus() == self::STATUS_DISPONIVEL;
    }
 
}
