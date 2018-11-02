<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdutoPeixe extends Model
{
    protected $table = 'tbprodpeixe';
    protected $primaryKey = ['procodigo', 'tppcodigo'];
    protected $incrementing = false;
}
