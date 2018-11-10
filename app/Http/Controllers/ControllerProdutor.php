<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipamento;
use App\Aluguel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Container\Container;

class ControllerProdutor extends Controller
{
    // Manunteções
    const PAG_VENDER_PRODUCAO    = 'venderProducao';  
    const PAG_ALUGAR_EQUIPAMENTO = 'alugarEquipamento';  
    
    // Consultas
    const PAG_CARRINHO_EQUIPAMENTO = 'carrinhoEquipamentos';  
    
    
    private function getObjetoMenuPadrao($sHeader){
        $oItem = new \stdClass();
        $oItem->header = $sHeader;
        $oItem->active = false;
        $oItem->itens  = [];
        return $oItem;
    }
    
    
    /**
     * @return LengthAwarePaginator
     */
    protected function returnPaginator($items, $total, $perPage, $currentPage, $options){
        return Container::getInstance()->makeWith(LengthAwarePaginator::class, compact(
            'items', 'total', 'perPage', 'currentPage', 'options'
        ));
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
            [route('carrinhoEquipamentos'), 'Carrinho Pedido Aluguel', self::PAG_CARRINHO_EQUIPAMENTO],
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
        return view('produtor.index_produtor', compact('aItensMenu'));
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
        $iAssociacao = auth()->user()->getPessoaFromUsuario->getMembroFromPessoa->getAssociacaoFromMembro->getCodigo();
        $aEquipamentos = Equipamento::find($iAssociacao)->paginate(8);
        return view('produtor.alugar_equipamento', compact('aItensMenu', 'aEquipamentos'));
    }
    
    public function addItemCarrinho(Request $req){
        foreach ($req->selecionados as $iSelecionado) {
            if(!$this->verificaEquipamentoAlugado($iSelecionado) || $req->ignoreAlugado){
                $aItens = session('carrinhoEquipamento', false);
                $bAdd = false;
                if(!$aItens) {
                    session()->put('carrinhoEquipamento', [$iSelecionado => 1]);
                    $bAdd = true;
                } else {
                    if(isset($aItens[$iSelecionado])){
                        if($this->verificaQuantidadeDisponivel($aItens[$iSelecionado], $iSelecionado)){
                            $aItens[$iSelecionado] += 1;     
                            $bAdd = true;
                        }
                    } else {
                        $aItens[$iSelecionado] = 1;
                        $bAdd = true;
                    }
                    session()->put('carrinhoEquipamento', $aItens);
                }
                if($bAdd){
                    $sMsg = 'Itens adicionados ao carrinho!';
                } else {
                    $sMsg = 'Itens já adicionados ao carrinho!';                    
                }
                $aRetorno = [
                    'msg' => $sMsg,
                    'equipAlugado' => false
                ];                    
            } else {
                $aRetorno = [
                        'msg' => '',
                        'equipAlugado' => true
                    ];
            }
        }
        return response()->json($aRetorno);
    }
    
    private function verificaEquipamentoAlugado($sChave){
        $aChave = explode('_', $sChave);
        $oEquipamento = Equipamento::find($aChave[1]);
        return $oEquipamento->isAlugado();
    }
    
    private function verificaQuantidadeDisponivel($iQtdeCarrinho, $sChave){
        $aChave = explode('_', $sChave);
        $oEquipamento = Equipamento::find($aChave[1]);
        return $oEquipamento->getQuantidade() > $iQtdeCarrinho;
    }
        
    public function getViewCarrinhoEquipamentos(){
        $aItensMenu = $this->getItensMenu();
        $this->setPaginaAtiva($aItensMenu, self::PAG_CARRINHO_EQUIPAMENTO);
        $aItens = [];
        $aCarrinho = session('carrinhoEquipamento');
        if($aCarrinho){
            foreach ($aCarrinho as $indice => $quantidade) {
                $aChaves = explode('_', $indice);

                if($oEquipamento = Equipamento::find($aChaves[1])){
                    $oItem = new \stdClass();
                    $oItem->codigo = $oEquipamento->getCodigo();
                    $oItem->nome = $oEquipamento->getNome();
                    $oItem->quantidade = $quantidade;
                    $aItens[] = $oItem;
                }
            }
        }
        $aEquipamentos = $this->returnPaginator($aItens, count($aItens), 8, 1, [
            'path' => route('carrinhoEquipamentos'),
            'pageName' => 'page',
        ]);        
        $aEquipamentos->links();
        return view('produtor.carrinho_equipamento', compact('aItensMenu', 'aEquipamentos'));
    }
    
    public function removeItemCarrinho(Request $req){
        foreach ($req->selecionados as $iSelecionado) {
            $aItens = session('carrinhoEquipamento', false);
            if(isset($aItens[$iSelecionado])){
                unset($aItens[$iSelecionado]);
                session()->put('carrinhoEquipamento', $aItens);
            }
        }
    }



    public static function teste(){
        $aEquipamentos = Equipamento::find(1);
        return $aEquipamentos;
    }
    
}
