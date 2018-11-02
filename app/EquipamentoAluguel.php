<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EquipamentoAluguel extends Model
{
    protected $table = 'tbequipaluguel';
    protected $primaryKey = ['eqpcodigo', 'alunumero'];
    protected $incrementing = false;
}
