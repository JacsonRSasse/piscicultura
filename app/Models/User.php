<?php

namespace App\Models;

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
    public $timestamps = false;

        
    function getListaTipoUsuario(){
        $aLista = [
            self::TIPO_PRODUTOR   => 'Produtor',
            self::TIPO_ASSOCIACAO => 'Associação',
            self::TIPO_COMPRADOR  => 'Comprador',
            self::TIPO_FORNECEDOR => 'Fornecedor',
        ];
        return $aLista;
    }
    
    public function getAuthPassword() {
        return $this->ususenha;
    }
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'usutipo', 'pescodigo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'ususenha', 'remember_token',
    ];

    public function pessoa(){
        return $this->hasOne('App\Models\Pessoa', 'pescodigo', 'pescodigo');
    }
}
