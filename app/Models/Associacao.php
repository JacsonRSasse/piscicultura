<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Associacao extends Model
{
    protected $table = 'tbassociacao';
    protected $primaryKey = 'asccodigo';
    public $timestamps = false;
    
    protected $fillable = [
        'ascnome'
    ];
    
    public function equipamentos(){
        return $this->hasMany('App\Models\Equipamento', 'asccodigo');
    }
    
    function membros(){
        return $this->hasMany('App\Models\Membro', $this->primaryKey);
    }
    
}
