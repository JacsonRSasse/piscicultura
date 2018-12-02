<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipamento;
use App\Models\Aluguel;
use App\Models\FilaAluguel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Container\Container;

class ControllerProdutor extends ControllerItemMenuProdutor {
    
    /**
     * @return LengthAwarePaginator
     */
    protected function returnPaginator($items, $total, $perPage, $currentPage, $options){
        return Container::getInstance()->makeWith(LengthAwarePaginator::class, compact(
            'items', 'total', 'perPage', 'currentPage', 'options'
        ));
    }
        
    /*---------------------------------------------------------------------------------------------------------------------*/
    /*|                                                MÉTODOS DAS VIEWS                                                  |*/
    /*---------------------------------------------------------------------------------------------------------------------*/
        
    public function getIndexProdutor(){
        $aItensMenu = $this->getItensMenu();
        return view('produtor.index_produtor', compact('aItensMenu'));
    }
    
    public function getViewAlugarEquipamento(){
        $aItensMenu = $this->getItensMenu();
        $this->setPaginaAtiva($aItensMenu, self::PAG_MAN_ALUGAR_EQUIPAMENTO); 
        $iAssociacao = auth()->user()->pessoa->membro->associacao->asccodigo;
        $aEquipamentos = Equipamento::where('asccodigo', '=', $iAssociacao)->get();
        return view('produtor.alugar_equipamento', compact('aItensMenu', 'aEquipamentos'));
    }
    
    public function getViewSolicitacoesAluguel(){
        $aItensMenu = $this->getItensMenu();
        $this->setPaginaAtiva($aItensMenu, self::PAG_CON_SOLIC_ALUGUEL);
        $aAluguel = Aluguel::with(['filaAluguel'])->where('memcodigo', '=', auth()->user()->pessoa->membro->memcodigo)->get();
        return view('produtor.solicitacao_aluguel', compact('aItensMenu', 'aAluguel'));
    }
    
    /*---------------------------------------------------------------------------------------------------------------------*/
    /*|                                            MÉTODOS DE PROCESSAMENTO                                               |*/
    /*---------------------------------------------------------------------------------------------------------------------*/
    
    public function addItemCarrinho(Request $req){
        $xDados = $req->all();
        if(!$this->verificaEquipamentoAlugado($xDados['eqpcodigo'])){
            $aItens = session('carrinhoEquipamento', false);
            $bAdd = false;
            if(!$aItens) {
                session()->put('carrinhoEquipamento', [$xDados['eqpcodigo'] => 1]);
                $bAdd = true;
            } else {
                if(isset($aItens[$xDados['eqpcodigo']])){
                    if($this->verificaQuantidadeDisponivel($aItens[$xDados['eqpcodigo']], $xDados['eqpcodigo'])){
                        $aItens[$xDados['eqpcodigo']] += 1;     
                        $bAdd = true;
                    }
                } else {
                    $aItens[$xDados['eqpcodigo']] = 1;
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
        return response()->json($aRetorno);
    }
    
    private function verificaEquipamentoAlugado($iEquip){
        $oEquipamento = Equipamento::find($iEquip);
        return $oEquipamento->isAlugado();
    }
    
    private function verificaQuantidadeDisponivel($iQtdeCarrinho, $sChave){
        $aChave = explode('_', $sChave);
        $oEquipamento = Equipamento::find($aChave[1]);
        return $oEquipamento->getQuantidade() > $iQtdeCarrinho;
    }
        
    public function getViewCarrinhoEquipamentos($bInseriuAluguel = null){
        $aItensMenu = $this->getItensMenu();
        $this->setPaginaAtiva($aItensMenu, self::PAG_CON_CARRINHO_EQUIPAMENTO);
        $aItens = [];
        $aCarrinho = session('carrinhoEquipamento');
        if($aCarrinho){
            foreach ($aCarrinho as $indice => $quantidade) {
                if($oEquipamento = Equipamento::find($indice)){
                    $oItem = new \stdClass();
                    $oItem->codigo = $oEquipamento->eqpcodigo;
                    $oItem->nome = $oEquipamento->eqpnome;
                    $oItem->quantidade = $quantidade;
                    $aItens[] = $oItem;
                }
            }
        }
        $aEquipamentos = $this->returnPaginator($aItens, count($aItens), 8, 1, [
            'path' => route('carrinhoEquipamentos'),
            'pageName' => 'page',
        ]);
        return view('produtor.carrinho_equipamento', compact('aItensMenu', 'aEquipamentos', 'bInseriuAluguel'));
    }
    
    public function removeItemCarrinho(Request $req){
        $xDados = $req->all();
        $aItens = session('carrinhoEquipamento', false);
        if(isset($aItens[$xDados['eqpcodigo']])){
            unset($aItens[$xDados['eqpcodigo']]);
            session()->put('carrinhoEquipamento', $aItens);
            return response()->json(true);
        }
    }
    
    public function cancelaPedido(){
        $aItens = session('carrinhoEquipamento', false);
        if($aItens){
            $aItens = [];
            session()->put('carrinhoEquipamento', $aItens);
            return redirect()->route('produtorIndex');
        }
        return redirect()->route('carrinhoEquipamentos');
    }

    public function finalizaPedido(Request $req){
        $dados = $req->all();
        
        if(strtotime($dados['dataAte']) < strtotime($dados['dataDe'])){
            return back()->withErrors(['data' => 'Data inicial maior que final']);
        }
        
        $aItens = session('carrinhoEquipamento', false);
        $bDeuBoa = false;
        if($aItens){
            DB::beginTransaction();
            $oAluguel = new Aluguel();
            $oAluguel->alustatus = Aluguel::STATUS_ABERTO_SOLICITACAO;
            $oAluguel->memcodigo = (auth()->user()->pessoa->membro->memcodigo);
            $oAluguel->aludatainicio = ($dados['dataDe']);
            $oAluguel->aludatafim = ($dados['dataAte']);
            
            $iDifDia =  (int)str_replace('-', '', $dados['dataAte']) - (int) str_replace('-', '', $dados['dataDe']);
            
            $xValor = 0;
            $aDados = [];
            foreach($aItens as $xIndice => $xQtd){
                if($oEquipamento = Equipamento::find($xIndice)){
                    $xValor = $xValor + $oEquipamento->eqpprecodia * $xQtd * $iDifDia;
                    $aDados[] = [
                        'codigo' => $xIndice,
                        'qtd' => $xQtd
                    ];
                }                
            }
            $oAluguel->aluvalor = ($xValor);            
            if($bDeuBoa = $oAluguel->save()){
                foreach ($aDados as $xDado){
                    $bDeuBoa = $oAluguel->setRelacionamentoTabelaTerciaria($xDado['codigo'], $xDado['qtd']);
                }
                $oFila = new FilaAluguel();
                $oFila->alunumero = $oAluguel->alunumero;
                $bDeuBoa = $oFila->save();
            }
            if($bDeuBoa){
                session()->put('carrinhoEquipamento', []);
                DB::commit();
            } else {
                DB::rollback();
            }
        }
        return $this->getViewCarrinhoEquipamentos($bDeuBoa);
    }
    
}
