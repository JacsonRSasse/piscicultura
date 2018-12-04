<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllerItemMenuAssociacao extends ControllerItemMenu {
    
    const PAG_CON_SOLICITACAO_ALUGUEL = 'solicitacaoAluguel';
    
    const PAG_MAN_CADASTRAR_EQUIPAMENTOS = 'cadastroEquipamento';
    
    public function getItensAndLinksConsulta() {
        return [
            [route(self::PAG_CON_SOLICITACAO_ALUGUEL), 'Solicitações de Aluguel', self::PAG_CON_SOLICITACAO_ALUGUEL]
        ];
    }

    public function getItensAndLinksManutencao() {
        return [
            //[route(self::PAG_MAN_CADASTRAR_EQUIPAMENTOS), 'Equipamentos', self::PAG_MAN_CADASTRAR_EQUIPAMENTOS]
        ];
    }

}
