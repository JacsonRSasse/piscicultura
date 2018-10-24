@extends('base.corpo_pagina')
@section('titulo_navbar', 'Alugar Equipamento')
@section('nome_usuario', $oUsuario->nome)

@section('main')
<main>
    <div class="time_line">
        <div class="row" style="position: relative;">                    
            <div class="col l12 m12 s12">
                <div class="card" style="display: table; width: 100%;">
                    <div class="area_botoes_acoes">
                        <a class="waves-effect waves-light btn-small">Incluir</a>
                        <a class="waves-effect waves-light btn-small">Alterar</a>
                        <a class="waves-effect waves-light btn-small">Excluir</a>
                        <a class="waves-effect waves-light btn-small">Visualizar</a>
                    </div>
                    <div class="area_filtro">
                        <input id="busca" placeholder="Buscar:">
                    </div>
                    <table class="striped centered">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" />
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
                            <tr>
                                <td></td>
                                <td>Rede 200 Metros</td>
                                <td>Disponível</td>
                                <td>1</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                        </tbody>

                    </table>

                    <div class="area_label_cont">
                        <span>
                            <label>Exibindo 10 de 23 Registros</label>
                        </span>
                    </div>
                    
                    <div class="area_botoes_paginacao">
                        <ul class="pagination">
                            <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
                            <li class="active"><a href="#!">1</a></li>
                            <li class="waves-effect"><a href="#!">2</a></li>
                            <li class="waves-effect"><a href="#!">3</a></li>
                            <li class="waves-effect"><a href="#!">4</a></li>
                            <li class="waves-effect"><a href="#!">5</a></li>
                            <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>
@endsection