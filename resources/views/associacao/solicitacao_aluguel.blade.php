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
                                    <a class="waves-effect waves-light btn-small" onclick="carregaModalDetalhesPedido({{$oSolicitacao}})">Detalhes</a>
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

                </div>
            </div>
        </div>
        
        <div class="modal" id="modal_detalhes">
            <div class="row" style="position: relative;">
                <div class="col l12 m12 s12">
                    <ul class="tabs tabs-fixed-width">
                        <li class="tab"><a href="#dados_produtor">Produtor</a></li>
                        <li class="tab"><a href="#dados_equipamentos">Equipamentos</a></li>
                    </ul>
                    <div id="dados_produtor">
                        <div class="row">
                            <div class="input-field col s12 m6">
                                <input type="text" id="pesnomerazao" disabled="">
                                <label id="label_pesnomerazao" for="#pesnomerazao">Membro</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <select id="memsituacao" disabled="">
                                    <option value="1">Em Dia</option>
                                    <option value="2">Com Débitos em Aberto</option>
                                    <option value="3">Com Débitos Vencidos</option>
                                </select>
                                <label for="#memsituacao">Situação</label>
                            </div>
                        </div>
                    </div>
                    <div id="dados_equipamentos">
                        <table id="equipamentos_solicitados">
                            <thead>
                                <tr>
                                    <td>Código</td>
                                    <td>Nome</td>
                                    <td>Situação</td>
                                </tr>
                            </thead>
                            <tbody id="body_tabela_equip">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="modal-close waves-effect btn-flat">Ok</a>
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

    function carregaModalDetalhesPedido(oSolicitacao){
        document.getElementById('pesnomerazao').value = oSolicitacao.membro.pessoa.pesnomerazao;
        document.getElementById('label_pesnomerazao').className = 'active';
        document.getElementById('memsituacao').value = oSolicitacao.memsituacao;

        var bodyTable = document.getElementById('body_tabela_equip');
        for(let i = 0; i < oSolicitacao.equipamentos.length; i++){
            let td_codigo = document.createElement('td');
            td_codigo.innerText = oSolicitacao.equipamentos[i].eqpcodigo;
            let td_nome = document.createElement('td');
            td_nome.innerText = oSolicitacao.equipamentos[i].eqpnome;
            let td_status = document.createElement('td');
            td_status.innerText = oSolicitacao.equipamentos[i].eqpstatus;

            let tr = document.createElement('tr');
            tr.appendChild(td_codigo);
            tr.appendChild(td_nome);
            tr.appendChild(td_status);
            bodyTable.appendChild(tr);
        }

        $('#modal_detalhes').modal('open');
    }

</script>
@endsection