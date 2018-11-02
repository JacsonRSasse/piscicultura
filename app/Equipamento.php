<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipamento extends Model
{
    protected $table = 'tbequipamento';
    protected $primaryKey = 'eqpcodigo';
}
