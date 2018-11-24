@extends('base.corpo_pagina')
@section('titulo_navbar', 'Solicitações de Aluguel')

@section('main')
<main>
    <div class="time_line">
        <div class="row" style="position: relative;">                    
            <div class="col l12 m12 s12">
                <div class="card" style="display: table; width: 100%;">
                    <table id="dataTable_consulta" class="consulta_padrao compact centered cell-border highlight">
                        <thead>
                            <tr>
                                <th class="sorting_desc_disabled">Ações</th>
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
                                    <a class="waves-effect waves-light btn-small green" title="Deferir"><i class="material-icons">check</i></a>
                                    <a class="waves-effect waves-light btn-small red" title="Indeferir"><i class="material-icons">close</i></a>
                                    <a class="waves-effect waves-light btn-small">Detalhes</a>
                                </td>
                                <td>{{$oSolicitacao->alunumero}}</td>
                                <td>{{$oSolicitacao->membro->pessoa->pesnomerazao}}</td>
                                <td>{{$oSolicitacao->aludatainicio}}</td>
                                <td>{{$oSolicitacao->aludatafim}}</td>
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