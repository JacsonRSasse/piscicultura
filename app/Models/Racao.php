<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Racao extends Model
{
    protected $table = 'tbracao';
    protected $primaryKey = 'raccodigo';
    public $timestamps = false;

    protected $fillable = [
    	'racnome', 'racdetalhe', 'racfoto'
    ];

    public function produtos(){
    	return $this->belongsToMany('App\Models\Produto', 'tbprodutoracao', 'raccodigo', 'procodigo');
    }
}
