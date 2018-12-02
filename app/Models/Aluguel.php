<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\EquipamentoAluguel;

class Aluguel extends Model {

    const STATUS_ABERTO_SOLICITACAO = 1;
    const STATUS_EM_ANDAMENTO = 2;
    const STATUS_NA_FILA = 3;
    const STATUS_FINALIZADO = 4;
    
    protected $table = 'tbaluguel';
    protected $primaryKey = 'alunumero';
    public $timestamps = false;
    
    protected $fillable = [
        'alustatus', 'aludatainicio', 'aludatafim', 'aluvalor', 'memcodigo'
    ];

    public function getListaStatusAluguel(){
        return [
            self::STATUS_ABERTO_SOLICITACAO => 'Solicitação Aberta',
            self::STATUS_EM_ANDAMENTO       => 'Em Andamento',
            self::STATUS_NA_FILA            => 'Aguardando na Fila',
            self::STATUS_FINALIZADO         => 'Finalizado'
        ];
    }

    function membro(){
        return $this->belongsTo('App\Models\Membro', 'memcodigo');
    }
    function filaAluguel(){
        return $this->hasOne('App\Models\FilaAluguel', 'alunumero');
    }
    
    function equipamentos(){
        return $this->belongsToMany('App\Models\Equipamento', 'tbequipaluguel', 'alunumero', 'eqpcodigo');
    }
    
    function setRelacionamentoTabelaTerciaria($iEquipamento, $iQtd = false){
        $oEquipAluguel = new EquipamentoAluguel();
        return $oEquipAluguel->save([$iEquipamento, $this->alunumero, (!$iQtd ? 1 : $iQtd)]);
    }
    
}
