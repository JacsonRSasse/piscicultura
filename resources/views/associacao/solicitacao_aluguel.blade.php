@extends('base.corpo_pagina')
@section('titulo_navbar', 'Alugar Equipamento')

@section('main')
<main>
    <div class="time_line">
        <div class="row" style="position: relative;">                    
            <div class="col l12 m12 s12">
                <div class="card" style="display: table; width: 100%;">
                    <div class="area_botoes_acoes">
                        <div class="acoes_com_grid">
                            <!--<a  class="waves-effect waves-light btn-small disabled">Visualizar</a>-->
                            <a class="waves-effect waves-light btn-small disabled">Deferir</a>
                            <a class="waves-effect waves-light btn-small disabled">Indeferir</a>
                            <a class="waves-effect waves-light btn-small disabled dropdown-trigger" data-target="dropdown_detalhes">Detalhes</a>

                            <ul id="dropdown_detalhes" class="dropdown-content">
                                <li onclick="carregaModalDetalhesPedido()"><a href="#">Pedido</a></li>
                                <li><a href="#!">Membro</a></li>
                            </ul>
                        </div>
                    </div>
                    <table id="dataTable_consulta" class="consulta_padrao compact centered cell-border highlight">
                        <thead>
                            <tr>
                                <th style="width: 40px;" class="sorting_desc_disabled ">
                                    <label>
                                        <input id="seleciona_tudo" type="checkbox" />
                                        <span></span>
                                    </label>
                                </th>

                                <th>Número</th>
                                <th>Solicitante</th>
                                <th>Data Inicio</th>
                                <th>Data Devolução</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if(isset($aSolicitacoes) && count($aSolicitacoes))
                            @foreach($aSolicitacoes as $oSolicitacao)
                            <tr>
                                <td>
                                    <label>
                                        <input type="checkbox" />
                                        <span></span>
                                    </label>
                                </td>
                                <td id="alunumero_{{$oSolicitacao->getNumero()}}">{{$oSolicitacao->getNumero()}}</td>
                                <td>{{$oSolicitacao->getMembroFromAluguel->getPessoaFromMembro->getNomeRazao()}}</td>
                                <td>{{$oSolicitacao->getDataInicio()}}</td>
                                <td>{{$oSolicitacao->getDataFim()}}</td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="7">
                                    <label>Sem Registros</label>
                                </td>
                            </tr>
                            @endif
                        </tbody>

                    </table>

                    <div id="modal_detalhes_pedido" class="modal">
                        <div class="modal-content">
                            <h4>Equipamentos Solicitados</h4>
                            <div id="gridEquipamentos">
                                
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Ok</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('comportamentos')
<script>

    function getOrderForConsulta() {
        return [1, 'asc'];
    }

    function carregaModalDetalhesPedido(){
        var aSelecionados = retornaItens();
        $.get('{{route('buscaDadosSolicitacaoAluguel')}}', {'solicitacao': aSelecionados[0]}, function(xRetorno) {
            debugger;
            xRetorno;
        });
    }

</script>
@endsection