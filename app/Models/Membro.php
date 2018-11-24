<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membro extends Model
{
    const SITUACAO_EM_DIA               = 1;
    const SITUACAO_COM_DEBITOS_ABERTOS  = 2;
    const SITUACAO_COM_DEBITOS_VENCIDOS = 3;
    
    const TIPO_PRODUTOR   = 1;
    const TIPO_PRESIDENTE = 2;
    
    protected $table = 'tbmembro';
    protected $primaryKey = 'memcodigo';
    public $timestamps = false;
     
    protected $fillable = [
        'memativo', 'memsituacao', 'memtipo', 'asccodigo', 'pescodigo'
    ];


    public function getListaSituacaoMembro(){
        return [
            self::SITUACAO_EM_DIA               => 'Em dia',
            self::SITUACAO_COM_DEBITOS_ABERTOS  => 'Débitos em Aberto',
            self::SITUACAO_COM_DEBITOS_VENCIDOS => 'Débitos Vencidos'
        ];
    }
    
    public function getListaTipoMembro() {
        return [
            self::TIPO_PRODUTOR     => 'Produtor',
            self::TIPO_PRESIDENTE   =>  'Presidente'
        ];
    }


    /**
     * Retorna o registro da pessoa vinculada ao membro
     * @return App\Pessoa
     */
    public function pessoa(){
        return $this->belongsTo('App\Models\Pessoa', 'pescodigo');
    }
    
    public function associacao(){
        return $this->belongsTo('App\Models\Associacao', 'asccodigo');
    }
    
    public function alugueis(){
        return $this->hasMany('App\Models\Aluguel', 'memcodigo');
    }
    
}
