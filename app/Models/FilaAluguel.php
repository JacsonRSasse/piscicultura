<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FilaAluguel extends Model {
    
    protected $table = 'tbfilaaluguel';
    protected $primaryKey = 'filnumero';
    public $timestamps = false;
           
    protected $fillable = [
        'alunumero'
    ];
            
    function aluguel(){
        return $this->hasOne('App\Models\Aluguel', 'alunumero');
    }
    
}
