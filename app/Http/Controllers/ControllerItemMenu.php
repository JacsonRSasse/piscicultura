<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class ControllerItemMenu extends Controller {
            
    private function getObjetoMenuPadrao($sHeader){
        $oItem = new \stdClass();
        $oItem->header = $sHeader;
        $oItem->active = false;
        $oItem->itens  = [];
        return $oItem;
    }
        
    public function setPaginaAtiva($aItensMenu, $sPagina = ''){
        $bAchou = false;
        foreach($aItensMenu as $xIndice => $xValue) {
            if($bAchou){
                continue;
            }
            if(is_object($xValue) || is_array($xValue)){
                if(!is_numeric($xIndice)){
                    list($aItensMenu->$xIndice, $bAchou) = $this->setPaginaAtiva($xValue, $sPagina);
                    if(isset($aItensMenu->active) && $bAchou){
                        $aItensMenu->active = true;
                    }
                } else {
                    list($aItensMenu[$xIndice], $bAchou) = $this->setPaginaAtiva($xValue, $sPagina);
                }
            } else {
                if($xValue == $sPagina){
                    $aItensMenu->class = 'active';
                    $bAchou = true;
                    return Array($aItensMenu, $bAchou);
                } else {
                    continue;                    
                }
            }
        }
        return Array($aItensMenu, $bAchou);
    }
    
    public function getItensMenu(){
        $aItensMenu = [];
        $aItensMenu[] = $this->getMenuManutencao();
        $aItensMenu[] = $this->getMenuConsulta();
        return $aItensMenu;
    }    
    
    abstract function getItensAndLinksManutencao();
    abstract function getItensAndLinksConsulta();

    private function getMenuManutencao(){
        $oItem = $this->getObjetoMenuPadrao('Manutenção');
        $aItensAndLinks = $this->getItensAndLinksManutencao();
        foreach ($aItensAndLinks as $aItem){
            $oItemItem = new \stdClass();
            $oItemItem->link = $aItem[0];
            $oItemItem->descricao = $aItem[1];
            $oItemItem->class = $aItem[2];
            $oItem->itens[] = $oItemItem;            
        }
        return $oItem;
    }
    
    private function getMenuConsulta(){
        $oItem = $this->getObjetoMenuPadrao('Consulta');
        $aItensAndLinks = $this->getItensAndLinksConsulta();
        foreach ($aItensAndLinks as $aItem){
            $oItemItem = new \stdClass();
            $oItemItem->link = $aItem[0];
            $oItemItem->descricao = $aItem[1];
            $oItemItem->class = $aItem[2];
            $oItem->itens[] = $oItemItem;            
        }
        return $oItem;
    }
    
}
