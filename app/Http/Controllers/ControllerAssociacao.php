<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aluguel;
use Illuminate\Support\Facades\DB;

class ControllerAssociacao extends ControllerItemMenuAssociacao {
    
    function getIndexAssociacao(){
        $aItensMenu = $this->getItensMenu();
        return view('associacao.index_associacao', compact('aItensMenu'));
    }
    
    function getViewSolicitacoesAluguel(){
        $aItensMenu = $this->getItensMenu();
        $this->setPaginaAtiva($aItensMenu, self::PAG_SOLICITACAO_ALUGUEL);
        $iCodAssociacao = auth()->user()->pessoa->membro->associacao->asccodigo;
        $aSolicitacoes = Aluguel::join('tbmembro', 'tbmembro.memcodigo', '=', 'tbaluguel.memcodigo')
                            ->join('tbassociacao', 'tbassociacao.asccodigo', '=', 'tbmembro.asccodigo')
                            ->join('tbpessoa', 'tbpessoa.pescodigo', '=', 'tbmembro.pescodigo')
                            ->whereIn('alustatus', array(Aluguel::STATUS_ABERTO_SOLICITACAO, Aluguel::STATUS_EM_ANDAMENTO, Aluguel::STATUS_NA_FILA))
                            ->where([
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
                    'eqpcodigo' => $oEquipamento->eqpcodigo,
                ];
            }
        }
        return response()->json($aRetorno);
    }
}
