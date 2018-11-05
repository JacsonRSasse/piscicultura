<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Equipamento;
use App\Aluguel;

class EquipamentoAluguel extends Model
{
    protected $table = 'tbequipaluguel';
    protected $primaryKey = ['eqpcodigo', 'alunumero'];
    public $incrementing = false;
    
    function getEquipamento(){
        return Equipamento::find($this->eqpcodigo);
    }
    
    function setEquipamento($equipamento) {
        $this->eqpcodigo = $equipamento;
    }
    
    function getAluguel(){
        return Aluguel::find($this->alunumero);
    }
    
    function setAluguel($aluguel){
        $this->alunumero = $aluguel;
    }
    
}
