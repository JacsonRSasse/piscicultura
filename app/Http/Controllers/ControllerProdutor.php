<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipamento;
use App\Aluguel;
use App\FilaAluguel;
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
        $aEquipamentos = Equipamento::where('asccodigo', '=', $iAssociacao)->get();
        return view('produtor.alugar_equipamento', compact('aItensMenu', 'aEquipamentos'));
    }
    
    public function addItemCarrinho(Request $req){
        foreach ($req->selecionados as $iSelecionado) {
            if(!$this->verificaEquipamentoAlugado($iSelecionado) || $req->ignoreAlugado != 'false'){
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
        
    public function getViewCarrinhoEquipamentos($bInseriuAluguel = null){
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
        return view('produtor.carrinho_equipamento', compact('aItensMenu', 'aEquipamentos', 'bInseriuAluguel'));
    }
    
    public function removeItemCarrinho(Request $req){
        foreach ($req->selecionados as $iSelecionado) {
            $aItens = session('carrinhoEquipamento', false);
            if(isset($aItens[$iSelecionado])){
                unset($aItens[$iSelecionado]);
                session()->put('carrinhoEquipamento', $aItens);
            }
        }
        return response()->json(true);
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
        $aItens = session('carrinhoEquipamento', false);
        $bDeuBoa = false;
        if($aItens){
            DB::beginTransaction();
            $oAluguel = new Aluguel();
            $oAluguel->setStatus(Aluguel::STATUS_ABERTO_SOLICITACAO);
            $oAluguel->setMembro(auth()->user()->getPessoaFromUsuario->getMembroFromPessoa->getCodigo());
            $oAluguel->setDataInicio($dados['dataDe']);
            $oAluguel->setDataFim($dados['dataAte']);
            
            $xValor = 0;
            $aDados = [];
            $bVaiPraFila = false;
            foreach($aItens as $xIndice => $xQtd){
                $aChave = explode('_', $xIndice);
                if($oEquipamento = Equipamento::find($aChave[1])){
                    if((bool)$this->getEquipamentoEmTransacaoAluguel($oEquipamento->getCodigo())){
                        $bVaiPraFila = true;
                    }
                    $xValor = $xValor + $oEquipamento->getPrecoDia() * $xQtd;
                    $aDados[] = [
                        'codigo' => $aChave[1],
                        'qtd' => $xQtd
                    ];
                }                
            }
            $oAluguel->setValor($xValor);            
            if($bDeuBoa = $oAluguel->save()){
                foreach ($aDados as $xDado){
                    $bDeuBoa = $oAluguel->setRelacionamentoTabelaTerciaria($xDado['codigo'], $xDado['qtd']);
                }
                if($bVaiPraFila){
                    $oFila = new FilaAluguel();
                    $oFila->setAluguel($oAluguel->getNumero());
                    $bDeuBoa = $oFila->save();
                    $oAluguel->setStatus(Aluguel::STATUS_NA_FILA);
                    $oAluguel->update();
                }
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

    private function getEquipamentoEmTransacaoAluguel($iEquip) {
        $aItens = DB::table('tbequipamento')
                        ->select(DB::raw('1 as em_transacao'))
                        ->join('tbequipaluguel', 'tbequipaluguel.eqpcodigo', '=', 'tbequipamento.eqpcodigo')
                        ->join('tbaluguel', 'tbaluguel.alunumero', '=', 'tbequipaluguel.alunumero')
                        ->whereIn('tbaluguel.alustatus', array(Aluguel::STATUS_ABERTO_SOLICITACAO, Aluguel::STATUS_EM_ANDAMENTO, Aluguel::STATUS_NA_FILA))
                        ->where('tbequipaluguel.eqpcodigo', $iEquip)->get();
        foreach($aItens as $oItem){
            if($oItem && $oItem->em_transacao){
                return (int)$oItem->em_transacao;
            } 
        } 
        return false;
    }
    
    private function trocaStatusEquipamento($iEquip, $xQtd){
        $oEquipamento = Equipamento::find($iEquip);
        $iQtd = $this->getQuantidadeAlugado($iEquip);
        if($oEquipamento->getQuantidade() == $iQtd->quantidade_alugada + $xQtd) {
            $oEquipamento->setStatus(Equipamento::STATUS_ALUGADO);
        } else {
            $oEquipamento->setStatus(Equipamento::STATUS_ALUGADO_PARCIAL);
        }
        $oEquipamento->update();
    }
    
}
