<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FilaAluguel extends Model {
    
    protected $table = 'tbfilaaluguel';
    protected $primaryKey = 'filnumero';
    public $timestamps = false;
    
    function setAluguel($numero){
        $this->alunumero = $numero;
    }
            
    function getAluguelFromFila(){
        return $this->hasOne('App\Aluguel', 'alunumero');
    }
    
}
