<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdutoRacao extends Model
{
    protected $table = 'tbprodracao';
    protected $primaryKey = ['procodigo', 'raccodigo'];
    protected $incrementing = false;
}
