<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    
    const TIPO_PRODUTOR   = 1;
    const TIPO_ASSOCIACAO = 2;
    const TIPO_COMPRADOR  = 3;
    const TIPO_FORNECEDOR = 4;
    
    
    protected $table = 'tbusuario';
    protected $primaryKey = 'usucodigo';

    
    function getCodigo(){
        return $this->usucodigo;
    }
    
    function getSenha(){
        return $this->ususenha;
    }
    
    function getPessoaFromUsuario(){
        return $this->belongsTo('App\Pessoa', 'pescodigo');
    }
    
    function getTipo(){
        return $this->usutipo;
    }
    
    function getDescricaoTipo(){
        $aLista = [
            self::TIPO_PRODUTOR   => 'Produtor',
            self::TIPO_ASSOCIACAO => 'Associação',
            self::TIPO_COMPRADOR  => 'Comprador',
            self::TIPO_FORNECEDOR => 'Fornecedor',
        ];
        return $aLista[$this->getTipo()];
    }
    
    function setTipo($tipo){
        $this->usutipo = $tipo;
    }
    
    public function getAuthPassword() {
        return bcrypt($this->getSenha());
    }
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
//    protected $fillable = [
//        'name', 'email', 'password',
//    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
//    protected $hidden = [
//        'password', 'remember_token',
//    ];
}
