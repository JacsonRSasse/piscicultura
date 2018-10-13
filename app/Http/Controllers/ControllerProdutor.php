<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllerProdutor extends Controller
{
    private function getItensMenu(){
        $aItensMenu = [];
        $oItem = new \stdClass();
        $oItem->header = 'Manutenção';
        $oItem->itens  = [];
        
        $aItensAndLinks = [
            [route('venderProducao'), 'Vender Produção', 'venderProducao'],
        ];
        
        foreach ($aItensAndLinks as $aItem){
            $oItemItem = new \stdClass();
            $oItemItem->link = $aItem[0];
            $oItemItem->descricao = $aItem[1];
            $oItemItem->id = $aItem[2];
            $oItem->itens[] = $oItemItem;            
        }
        $aItensMenu[] = $oItem;
        return $aItensMenu;
    }
    
    public function getIndexProdutor(){
        $aItensMenu = $this->getItensMenu();
        return view('produtor.index_produtor', compact('aItensMenu'));
    }
    
    public function getViewVenderProducao(){
        $aItensMenu = $this->getItensMenu();
        return view('produtor.vender_producao', compact('aItensMenu'));
    }
}
