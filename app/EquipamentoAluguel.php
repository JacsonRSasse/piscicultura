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
    public $timestamps = false;
    
    function getEquipamento(){
        return $this->eqpcodigo;
    }
    
    function setEquipamento($equipamento) {
        $this->eqpcodigo = $equipamento;
    }
    
    function getAluguel(){
        return $this->alunumero;
    }
    
    function setAluguel($aluguel){
        $this->alunumero = $aluguel;
    }
    
    function getQuantidade(){
        return $this->eqaquantidade;
    }
    
    function setQuantidade($iQuantidade){
        $oModel = EquipamentoAluguel::where([
            ['eqpcodigo', $this->eqpcodigo],
            ['alunumero', $this->alunumero]
        ])->first();
        if($oModel){
            $oModel->eqaquantidade = $oModel->getQuantidade() + $iQuantidade;
            $this->salva(true);
        } else {
            $this->eqaquantidade = $iQuantidade;
            $this->salva();
        }
    }
    
    private function salva($bUpdate = false){
        $sMethod = !$bUpdate ? 'save' : 'update';
        $this->$sMethod();
    }
    
}
