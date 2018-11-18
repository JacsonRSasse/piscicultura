<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllerItemMenuAssociacao extends ControllerItemMenu {
    
    const PAG_SOLICITACAO_ALUGUEL = 'solicitacaoAluguel';
    
    public function getItensAndLinksConsulta() {
        return [
            [route(self::PAG_SOLICITACAO_ALUGUEL), 'Solicitações de Aluguel', self::PAG_SOLICITACAO_ALUGUEL]
        ];
    }

    public function getItensAndLinksManutencao() {
        return [];
    }

}
