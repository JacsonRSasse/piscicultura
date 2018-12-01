<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipamento;

class ControllerEquipamento extends Controller {
    
    public function getStatusEquipamentos(){
        $oEquipamento = new Equipamento();
        return response()->json($oEquipamento->getListaStatusEquipamento());
    }

}
