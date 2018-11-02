<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'tbusuario';
    protected $primaryKey = 'usucodigo';
}
