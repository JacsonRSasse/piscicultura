<?php

namespace App;

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
    
    function getCodigo(){
        return $this->memcodigo;
    }
    
    function setCodigo($codigo){
        $this->memcodigo = $codigo;
    }
    
    function getAtivo(){
        return $this->memativo ? 'Sim' : 'Não';
    }
    
    function setAtivo($ativo){
        $this->memativo = $ativo;
    }
    
    function getSituacao(){
        return $this->memsituacao;
    }
    
    function getDescricaoSituacao(){
        $aLista = [
            self::SITUACAO_EM_DIA => 'Em Dia',
            self::SITUACAO_COM_DEBITOS_ABERTOS  => 'Débitos em Aberto',
            self::SITUACAO_COM_DEBITOS_VENCIDOS => 'Débitos Vencidos'
        ];
        return $aLista[$this->getSituacao()];
    }
    
    function setSituacao($situacao){
        $this->memsituacao = $situacao;
    }
    
    function getTipo(){
        return $this->memtipo;
    }
    
    function getDescricaoTipo(){
        $aLista = [
            self::TIPO_PRODUTOR => 'Produtor',
            self::TIPO_PRESIDENTE => 'Presidente',
        ];
        return $aLista[$this->getTipo()];
    }
    
    function setTipo($tipo){
        $this->memtipo = $tipo;
    } 
    
    /**
     * Retorna o registro da pessoa vinculada ao membro
     * @return App\Pessoa
     */
    public function getPessoaFromMembro(){
        return $this->belongsTo('App\Pessoa', 'pescodigo');
    }
    
    public function getAssociacaoFromMembro(){
        return $this->belongsTo('App\Associacao', 'asccodigo');
    }
    
}
