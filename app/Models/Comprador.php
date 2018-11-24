<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comprador extends Model
{
    protected $table = 'tbcomprador';
    protected $primaryKey = 'comcodigo';
    public $timestamps = false;
    
    protected $fillable = [
        'comtipo', 'pescodigo'
    ];
    
    public function pessoa(){
        return $this->hasOne('App\Models\Pessoa', 'pescodigo');
    }
    
    public function compraProducoes(){
        return $this->hasMany('App\Models\CompraProducao', 'comcodigo');
    }
}
