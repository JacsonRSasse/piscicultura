<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    const TIPO_FISICA   = 1;
    const TIPO_JURIDICA = 2;


    protected $table = 'tbpessoa';
    protected $primaryKey = 'pescodigo';
    public $timestamps = false;
    public $incrementing = true;
    
    function getCodigo(){
        return $this->pescodigo;
    }
    
    function setCodigo($codigo){
        $this->pescodigo = $codigo;
    }
    
    function getNomeRazao(){
        return $this->pesnomerazao;
    }
    
    function setNomeRazao($nome){
        $this->pesnomerazao = $nome;
    }
    
    function getCpfCnpj(){
        return $this->pescpfcnpj;
    }
    
    function setCpfCnpj($cpfCnpj){
        $this->pescpfcnpj = $cpfCnpj;
    }
    
    function getRg(){
        $this->pesrg;
    }
    
    function setRg($rg){
        $this->pesrg = $rg;
    }

    function getTipo(){
        return $this->pestipo;
    }
    
    function getDescricaoTipo(){
        $aLista = [
            self::TIPO_FISICA   => 'Fisíca',
            self::TIPO_JURIDICA => 'Jurídica'
        ];
        return $aLista[$this->getTipo()];
    }
    
    function setTipo($tipo){
        $this->pestipo = $tipo;
    }
    
    function getEmail(){
        $this->pesemail;
    }
    
    function setEmail($email){
        $this->pesemail = $email;
    }

    /**
     * Retorna o registro de Membro da Pessoa, esse relacionamento é inverso
     * @return App\Membro
     */
    public function getMembroFromPessoa() {
        return $this->hasOne('App\Membro', 'pescodigo');
    }
    
    public function getUsuarioFromPessoa(){
        return $this->hasOne('App\User', 'pescodigo');
    }
}
