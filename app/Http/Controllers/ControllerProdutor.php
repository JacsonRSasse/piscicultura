<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ControllerProdutor extends Controller
{
    const PAG_VENDER_PRODUCAO    = 'venderProducao';  
    const PAG_ALUGAR_EQUIPAMENTO = 'alugarEquipamento';  
    
    private function getObjetoMenuPadrao($sHeader){
        $oItem = new \stdClass();
        $oItem->header = $sHeader;
        $oItem->active = false;
        $oItem->itens  = [];
        return $oItem;
    }
    
    private function getItensMenu(){
        $aItensMenu = [];
        $aItensMenu[] = $this->getMenuManutencao();
        $aItensMenu[] = $this->getMenuConsulta();
        return $aItensMenu;
    }
    
    private function getMenuManutencao(){
        $oItem = $this->getObjetoMenuPadrao('Manutenção');
        $aItensAndLinks = [
            [route('alugarEquipamento'), 'Alugar Equipamento', self::PAG_ALUGAR_EQUIPAMENTO, ''],
//            [route('venderProducao')   , 'Vender Produção'   , self::PAG_VENDER_PRODUCAO   , ''],
        ];
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
        $aItensAndLinks = [
            [route('#'), 'Consultar Qualquer coisa', 'consultaQualquerCoisa', ''],
        ];
        foreach ($aItensAndLinks as $aItem){
            $oItemItem = new \stdClass();
            $oItemItem->link = $aItem[0];
            $oItemItem->descricao = $aItem[1];
            $oItemItem->id = $aItem[2];
            $oItemItem->class = $aItem[3];
            $oItem->itens[] = $oItemItem;            
        }
        return $oItem;
    }
    
    /*---------------------------------------------------------------------------------------------------------------------*/
    /*|                                                MÉTODOS DAS VIEWS                                                  |*/
    /*---------------------------------------------------------------------------------------------------------------------*/
    
    private function setPaginaAtiva($aItensMenu, $sPagina = ''){
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
    
    public function getIndexProdutor(){
        $aItensMenu = $this->getItensMenu();
        $oUsuario = new \stdClass();
        $oUsuario->nome = 'Nome do Usuário';
        return view('produtor.index_produtor', compact('aItensMenu', 'oUsuario'));
    }
    
    public function getViewVenderProducao(){
        $aItensMenu = $this->getItensMenu();
        $this->setPaginaAtiva($aItensMenu, self::PAG_VENDER_PRODUCAO);
        $oUsuario = new \stdClass();
        $oUsuario->nome = 'Nome do Usuário';
        return view('produtor.vender_producao', compact('aItensMenu', 'oUsuario'));
    }
    
    public function getViewAlugarEquipamento(){
        $aItensMenu = $this->getItensMenu();
        $this->setPaginaAtiva($aItensMenu, self::PAG_ALUGAR_EQUIPAMENTO);
        $oUsuario = new \stdClass();
        $oUsuario->nome = 'Nome do Usuário';
                
        $aEquipamentos = DB::table('tbequipamento')
                            ->join('tbassociacao', 'tbassociacao.asccodigo', '=', 'tbequipamento.asccodigo')
                            ->join('tbmembro', 'tbmembro.asccodigo', '=', 'tbassociacao.asccodigo')
                            ->join('tbpessoa', 'tbpessoa.pescodigo', '=', 'tbmembro.pescodigo')
                            ->join('tbaluguel', 'tbaluguel.memcodigo', '=', 'tbmembro.memcodigo')
                            ->join('tbequipaluguel', function($oJoin){
                                $oJoin->on('tbequipaluguel.alunumero', '=', 'tbaluguel.alunumero')
                                      ->on('tbequipaluguel.eqpcodigo', '=', 'tbequipamento.eqpcodigo');
                            })
                            ->select(DB::raw('coalesce(tbpessoa.pesnomerazao, \'-\') as pesnomerazao'),
                                     'tbequipamento.eqpnome',
                                     'tbequipamento.eqpstatus',
                                     'tbequipamento.eqpquantidade',
                                     'tbaluguel.aludatainicio',
                                     'tbaluguel.aludatafim')
                            ->paginate(8);
        
        return view('produtor.alugar_equipamento', compact('aItensMenu', 'oUsuario', 'aEquipamentos'));
    }
    
    public static function teste(){
        $aEquipamentos = DB::table('tbequipamento')
                            ->join('tbassociacao', 'tbassociacao.asccodigo', '=', 'tbequipamento.asccodigo')
                            ->join('tbmembro', 'tbmembro.asccodigo', '=', 'tbassociacao.asccodigo')
                            ->join('tbpessoa', 'tbpessoa.pescodigo', '=', 'tbmembro.pescodigo')
                            ->join('tbaluguel', 'tbaluguel.memcodigo', '=', 'tbmembro.memcodigo')
                            ->join('tbequipaluguel', function($oJoin){
                                $oJoin->on('tbequipaluguel.alunumero', '=', 'tbaluguel.alunumero')
                                      ->on('tbequipaluguel.eqpcodigo', '=', 'tbequipamento.eqpcodigo');
                            })
                            ->select(DB::raw('coalesce(tbpessoa.pesnomerazao, \'-\') as pesnomerazao'),
                                     'tbequipamento.eqpnome',
                                     'tbequipamento.eqpstatus',
                                     'tbequipamento.eqpquantidade',
                                     'tbaluguel.aludatainicio',
                                     'tbaluguel.aludatafim')
                            ->paginate(1);
        return $aEquipamentos;
    }
    
}
