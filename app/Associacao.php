<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Associacao extends Model
{
    protected $table = 'tbassociacao';
    protected $primaryKey = 'asccodigo';
    
    public function getEquipamentosForAssociacao(){
        return $this->hasMany('App\Equipamento', 'asccodigo');
    }
}
