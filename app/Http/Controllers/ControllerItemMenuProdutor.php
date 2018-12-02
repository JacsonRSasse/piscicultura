<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllerItemMenuProdutor extends ControllerItemMenu {
    // Manunteções
    const PAG_MAN_ALUGAR_EQUIPAMENTO    = 'alugarEquipamento';  
    
    // Consultas
    const PAG_CON_SOLIC_ALUGUEL         = 'venderProducao';  
    const PAG_CON_CARRINHO_EQUIPAMENTO  = 'carrinhoEquipamentos';  
    
    
    public function getItensAndLinksConsulta() {
        return [
            [route('solicitacaoAluguelProdutor'), 'Solicitações de Aluguel' , self::PAG_CON_SOLIC_ALUGUEL],
            [route('carrinhoEquipamentos')      , 'Carrinho Pedido Aluguel' , self::PAG_CON_CARRINHO_EQUIPAMENTO],
        ];
    }

    public function getItensAndLinksManutencao() {
        return [
            [route('alugarEquipamento'), 'Alugar Equipamento', self::PAG_MAN_ALUGAR_EQUIPAMENTO, ''],
        ];
    }

}
