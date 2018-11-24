<?php

namespace App\Models;

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
    
    protected $fillable = [
        'eqpnome', 'eqpimagem', 'eqpstatus', 'eqpprecodia', 'eqpdetalhe', 'eqpquantidade', 'asccodigo'
    ];


    /** @return Associacao */
    function getAssociacaoFromEquipamento(){
        return $this->hasOne('App\Associacao', 'asccodigo');
    }
        
    function getListaStatusEquipamento(){
        $aLista = [
            self::STATUS_DISPONIVEL => 'Disponível',
            self::STATUS_ALUGADO => 'Alugado',
            self::STATUS_ALUGADO_PARCIAL => 'Alugado Parcial',
            self::STATUS_REPAROS => 'Em Reparos',
        ];
        return $aLista;
    }
    
    function alugueis(){
        return $this->belongsToMany('App\Aluguel', 'tbequipaluguel', 'eqpcodigo', 'alunumero');
    }
    
    function isAlugado(){
        return $this->eqpstatus == self::STATUS_ALUGADO;
    }
    
    function isDisponivel(){
        return $this->eqpstatus == self::STATUS_DISPONIVEL;
    }
 
}
