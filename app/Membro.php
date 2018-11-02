<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Membro extends Model
{
    protected $table = 'tbmembro';
    protected $primaryKey = 'memcodigo';
    
    /**
     * Retorna o registro da pessoa vinculada ao membro
     * @return App\Pessoa
     */
    public function getPessoaForMembro(){
        return $this->hasOne('App\Pessoa', 'pescodigo');
    }
}
