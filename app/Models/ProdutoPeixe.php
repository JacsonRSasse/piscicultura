<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdutoPeixe extends Model
{
    protected $table = 'tbprodutopeixe';
    protected $primaryKey = ['procodigo', 'tppcodigo'];
    protected $incrementing = false;
    public $timestamps = false;
}
