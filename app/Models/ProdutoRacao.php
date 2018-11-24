<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdutoRacao extends Model
{
    protected $table = 'tbprodutoracao';
    protected $primaryKey = ['procodigo', 'raccodigo'];
    protected $incrementing = false;
    public $timestamps = false;
}
