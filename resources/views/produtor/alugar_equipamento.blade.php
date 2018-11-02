@extends('base.corpo_pagina')
@section('titulo_navbar', 'Alugar Equipamento')
@section('nome_usuario', $oUsuario->nome)

@section('main')
<main>
    <div class="time_line">
        <div class="row" style="position: relative;">                    
            <div class="col l12 m12 s12">
                <div class="card" style="display: table; width: 100%;">
                    <div class="area_filtro">
                        <input id="busca" placeholder="Buscar:">
                    </div>
                    <div class="area_botoes_acoes">
<!--                        <div class="acoes_sem_grid">
                            <a class="waves-effect waves-light btn-small">Incluir</a>
                            <a class="waves-effect waves-light btn-small">Alterar</a>
                            <a class="waves-effect waves-light btn-small">Excluir</a>
                            <a class="waves-effect waves-light btn-small">Visualizar</a>
                        </div>-->
                        <div class="acoes_com_grid">
                            <a class="waves-effect waves-light btn-small disabled">Visualizar</a>
                            <a class="waves-effect waves-light btn-small disabled">Adicionar ao Pedido</a>
                        </div>
                    </div>
                    <table id="consulta_padrao" class="consulta_padrao centered highlight">
                        <thead>
                            <tr>
                                <th>
                                    <label>
                                        <input id="seleciona_tudo" type="checkbox" />
                                        <span></span>
                                    </label>
                                </th>
                                <th>Nome</th>
                                <th>Status</th>
                                <th>Quantidade</th>
                                <th>Alugado a</th>
                                <th>Data de Retirada</th>
                                <th>Data de Devolução</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if(count($aEquipamentos))
                            @foreach($aEquipamentos as $oEquipamento)
                            <tr>
                                <td>
                                    <label>
                                        <input type="checkbox" />
                                        <span></span>
                                    </label>
                                </td>
                                <td>{{ $oEquipamento->eqpnome }}</td>
                                <td>{{ $oEquipamento->eqpstatus }}</td>
                                <td>{{ $oEquipamento->eqpquantidade }}</td>
                                <td>{{ $oEquipamento->pesnomerazao }}</td>
                                <td>{{ $oEquipamento->aludatainicio }}</td>
                                <td>{{ $oEquipamento->aludatafim }}</td>
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

                    <div class="area_label_cont">
                        <span>
                            <label>Exibindo {{ $aEquipamentos->count() }} de {{ $aEquipamentos->total() }} Registros</label>
                        </span>
                    </div>

                    <div class="area_botoes_paginacao">
                        <ul class="pagination">
                            <li class="waves-effect {{ $aEquipamentos->currentPage() == 1 ? ' disabled' : '' }}"><a href="{{ $aEquipamentos->previousPageUrl() }}"><i class="material-icons">chevron_left</i></a></li>
                            @for($i = 1; $i < $aEquipamentos->total() + 1 ; $i++)
                            <li class="waves-effect {{ $aEquipamentos->currentPage() == $i ? ' active' : '' }}"><a href="{{ $aEquipamentos->url($i) }}">{{ $i }}</a></li>
                            @endfor
                            <li class="waves-effect {{ $aEquipamentos->currentPage() == $aEquipamentos->lastPage() ? ' disabled' : '' }}"><a href="{{ $aEquipamentos->nextPageUrl() }}"><i class="material-icons">chevron_right</i></a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>
@endsection