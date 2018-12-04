<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aluguel;
use App\Models\Equipamento;
use App\Models\FilaAluguel;
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
        $this->setPaginaAtiva($aItensMenu, self::PAG_CON_SOLICITACAO_ALUGUEL);
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

    function getViewCadastroEquipamento(){
        $aItensMenu = $this->getItensMenu();
        $this->setPaginaAtiva($aItensMenu, self::PAG_MAN_CADASTRAR_EQUIPAMENTOS);
        
    }


    /*------------------------------------------------------------------------------------------------*/
    /*|                                   MÉTODOS DE PROCESSAMENTO                                    */
    /*------------------------------------------------------------------------------------------------*/
    
    function setRespostaSolicitacao(Request $req){
        $aDados = $req->all();
        $oAluguel = Aluguel::with(['equipamentos'])->find($aDados['alunumero']);
        if($aDados['deferido'] == 'true'){
            // Se for deferido primeiro vamos verificar se é o primeiro da fila e se os equipamentos estão disponíveis
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
            $iFirstFila = FilaAluguel::max('filnumero');
            if($oAluguel->filaAluguel->filnumero != $iFirstFila){
                return response()->json(['mensagem' => 'Há solicitações anteriores! Respeite a ordem cronológica.', 'recarrega' => false]);
            }
            return $this->processaSolicitacao($oAluguel, Aluguel::STATUS_DEFERIDO);
        } else {
            return $this->processaSolicitacao($oAluguel, Aluguel::STATUS_INDEFERIDO);
        }
    }
    
    private function processaSolicitacao($oAluguel, $iStatus) {
        $bDeuBoa = true;
        if($iStatus == Aluguel::STATUS_DEFERIDO){
            foreach ($oAluguel->equipamentos as $oEquipamento){
                $oEquipamento->eqpstatus = Equipamento::STATUS_ALUGADO;
                $bDeuBoa = $oEquipamento->update();
            }               
        }
        if ($bDeuBoa){
            $oAluguel->alustatus = $iStatus;
            $bDeuBoa = $oAluguel->update();
        }
        $sMsg = $iStatus == Aluguel::STATUS_DEFERIDO ? 'aprovada' : 'negada';
        return response()->json(['mensagem' => 'Solicitação '.$sMsg.' com sucesso!', 'recarrega' => true]);
        
    }
    
    
}
