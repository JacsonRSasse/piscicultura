<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aluguel;
use App\Models\Equipamento;
use Illuminate\Support\Facades\DB;

class ControllerAssociacao extends ControllerItemMenuAssociacao {
    
    function getIndexAssociacao(){
        $aItensMenu = $this->getItensMenu();
        return view('associacao.index_associacao', compact('aItensMenu'));
    }
    
    /*------------------------------------------------------------------------------------------------*/
    /*|                                       MÉTODOS DAS VIEWS                                       */
    /*------------------------------------------------------------------------------------------------*/
    
    function getViewSolicitacoesAluguel(){
        $aItensMenu = $this->getItensMenu();
        $this->setPaginaAtiva($aItensMenu, self::PAG_SOLICITACAO_ALUGUEL);
        $iCodAssociacao = auth()->user()->pessoa->membro->associacao->asccodigo;
        $aSolicitacoes = Aluguel::with(['membro.associacao', 'membro.pessoa', 'equipamentos'])
                                ->join('tbmembro', 'tbmembro.memcodigo', '=', 'tbaluguel.memcodigo')
                                ->join('tbassociacao', 'tbassociacao.asccodigo', '=', 'tbmembro.asccodigo')
                                ->where([
                                            ['tbassociacao.asccodigo', $iCodAssociacao]
                                        ])
                                ->whereIn('alustatus', array(Aluguel::STATUS_ABERTO_SOLICITACAO, Aluguel::STATUS_EM_ANDAMENTO, Aluguel::STATUS_NA_FILA))
                                ->get();       
        return view('associacao.solicitacao_aluguel', compact('aItensMenu', 'aSolicitacoes'));
    }

    /*------------------------------------------------------------------------------------------------*/
    /*|                                   MÉTODOS DE PROCESSAMENTO                                    */
    /*------------------------------------------------------------------------------------------------*/
    
    function setRespostaSolicitacao(Request $req){
        $aDados = $req->all();
        if($aDados['deferido']){
            // Se for deferido primeiro vamos verificar se é o primeiro da fila e se os equipamentos estão disponíveis
            $oAluguel = Aluguel::with(['equipamentos'])->find($aDados['alunumero']);
            $bDisponivel = true;
            foreach($oAluguel->equipamentos as $oEquipamento) {
                if($oEquipamento->eqpstatus == Equipamento::STATUS_DISPONIVEL){
                    continue;
                } else {
                    $bDisponivel = false;
                    break;
                }
            }
            if(!$bDisponivel){
                return response()->json(['mensagem' => 'Há equipamentos não disponíveis na solicitação!', 'recarrega' => false]);
            }
            
            
        } else {
            // Se não for deferido
        }
    }
    
}
