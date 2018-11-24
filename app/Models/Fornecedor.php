<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    protected $table = 'tbfornecedor';
    protected $primaryKey = 'forcodigo';
    public $timestamps = false;
    
    protected $fillable = [
        'fortipo', 'pescodigo'
    ];
    
    public function pessoa(){
        return $this->hasOne('App\Models\Pessoa', 'pescodigo');
    }
    
    public function produtos(){
        return $this->hasMany('App\Models\Produto', 'forcodigo');
    }
}
