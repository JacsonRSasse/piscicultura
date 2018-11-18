<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aluguel;
use Illuminate\Support\Facades\DB;

class ControllerAssociacao extends ControllerItemMenuAssociacao {
    
    function getIndexAssociacao(){
        $aItensMenu = $this->getItensMenu();
        return view('associacao.index_associacao', compact('aItensMenu'));
    }
    
    function getViewSolicitacoesAluguel(){
        $aItensMenu = $this->getItensMenu();
        $this->setPaginaAtiva($aItensMenu, self::PAG_SOLICITACAO_ALUGUEL);
        $iCodAssociacao = auth()->user()->getPessoaFromUsuario->getMembroFromPessoa->getAssociacaoFromMembro->getCodigo();
        $aSolicitacoes = Aluguel::join('tbmembro', 'tbmembro.memcodigo', '=', 'tbaluguel.memcodigo')
                            ->join('tbassociacao', 'tbassociacao.asccodigo', '=', 'tbmembro.asccodigo')
                            ->join('tbpessoa', 'tbpessoa.pescodigo', '=', 'tbmembro.pescodigo')
                            ->where([
                                    ['alustatus', Aluguel::STATUS_ABERTO_SOLICITACAO],
                                    ['tbassociacao.asccodigo', $iCodAssociacao]
                                ])->get();
               
        return view('associacao.solicitacao_aluguel', compact('aItensMenu', 'aSolicitacoes'));
    }
    
    public function getDadosSolicitacaoAluguel(Request $req){
        $aDados = $req->all();
        $aRetorno = [];
        if(count($aDados)){
            $aChave = explode('_', $aDados['solicitacao']);
            $oAluguel = Aluguel::find($aChave[1]);
            
            foreach($oAluguel->getEquipamentosFromAluguel as $oEquipamento){
                $aRetorno[] = [
                    'eqpcodigo' => $oEquipamento->getCodigo(),
                ];
            }
        }
        return response()->json($aRetorno);
    }
}
