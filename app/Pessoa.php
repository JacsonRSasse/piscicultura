<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    protected $table = 'tbpessoa';
    protected $primaryKey = 'pescodigo';
}
