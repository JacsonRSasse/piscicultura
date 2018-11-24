<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Negociacao extends Model
{
	const STATUS_ABERTA = 1;
	const STATUS_EM_ANALISE = 2;

    protected $table = 'tbnegociacao';
    protected $primaryKey = 'negcodigo';
    public $timestamps = false;

    protected $fillable = [
    	'negstatus', 'negproposta', 'vennumero', 'cpdnumero'
    ];

    public function vendaProducao(){
    	return $this->hasOne('App\Models\VendaProducao', 'vennumero');
    }

    public function compraProducao(){
    	return $this->hasOne('App\Models\CompraProducao', 'cpdnumero');
    }

    public function getListaStatusNegociacao(){
    	return [
    		self::STATUS_ABERTA => 'Aberta Negociação',
    		self::STATUS_EM_ANALISE => 'Em Análise'
    	];
    }
}
