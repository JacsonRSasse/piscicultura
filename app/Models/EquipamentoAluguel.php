<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EquipamentoAluguel extends Model
{
    protected $table = 'tbequipaluguel';
    protected $primaryKey = ['eqpcodigo', 'alunumero'];
    public $incrementing = false;
    public $timestamps = false;
        
    protected $fillable = [
        'eqpcodigo', 'alunumero', 'eqaquantidade'
    ];
            
    
}
