<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllerItemMenuProdutor extends ControllerItemMenu {
    // Manunteções
    const PAG_VENDER_PRODUCAO    = 'venderProducao';  
    const PAG_ALUGAR_EQUIPAMENTO = 'alugarEquipamento';  
    
    // Consultas
    const PAG_CARRINHO_EQUIPAMENTO = 'carrinhoEquipamentos';  
    
    
    public function getItensAndLinksConsulta() {
        return [
            [route('carrinhoEquipamentos'), 'Carrinho Pedido Aluguel', self::PAG_CARRINHO_EQUIPAMENTO],
        ];
    }

    public function getItensAndLinksManutencao() {
        return [
            [route('alugarEquipamento'), 'Alugar Equipamento', self::PAG_ALUGAR_EQUIPAMENTO, ''],
//            [route('venderProducao')   , 'Vender Produção'   , self::PAG_VENDER_PRODUCAO   , ''],
        ];
    }

}
