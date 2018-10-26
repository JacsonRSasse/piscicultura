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
                        <div class="acoes_sem_grid">
                            <a class="waves-effect waves-light btn-small">Incluir</a>
                            <a class="waves-effect waves-light btn-small">Alterar</a>
                            <a class="waves-effect waves-light btn-small">Excluir</a>
                            <a class="waves-effect waves-light btn-small">Visualizar</a>
                        </div>
                        <div class="acoes_com_grid">
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
                            <tr>
                                <td>
                                    <label>
                                        <input type="checkbox" />
                                        <span></span>
                                    </label>
                                </td>
                                <td>Rede 100 Metros</td>
                                <td>Disponível</td>
                                <td>1</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                        <input type="checkbox" />
                                        <span></span>
                                    </label>
                                </td>
                                <td>Caixa de Transporte</td>
                                <td>Alugado</td>
                                <td>13</td>
                                <td>Rubens Sasse</td>
                                <td>01/10/2018</td>
                                <td>12/10/2018</td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                        <input type="checkbox" />
                                        <span></span>
                                    </label>
                                </td>
                                <td>Rede 200 Metros</td>
                                <td>Alugado</td>
                                <td>2</td>
                                <td>Rubens Sasse</td>
                                <td>01/10/2018</td>
                                <td>12/10/2018</td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                        <input type="checkbox" />
                                        <span></span>
                                    </label>
                                </td>
                                <td>Esteira Elétrica</td>
                                <td>Alugado</td>
                                <td>1</td>
                                <td>Rubens Sasse</td>
                                <td>01/10/2018</td>
                                <td>12/10/2018</td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                        <input type="checkbox" />
                                        <span></span>
                                    </label>
                                </td>
                                <td>Motor/Bomba</td>
                                <td>Alugado</td>
                                <td>1</td>
                                <td>Rubens Sasse</td>
                                <td>01/10/2018</td>
                                <td>12/10/2018</td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                        <input type="checkbox" />
                                        <span></span>
                                    </label>
                                </td>
                                <td>Tanque de Transporte</td>
                                <td>Alugado</td>
                                <td>3</td>
                                <td>Rubens Sasse</td>
                                <td>01/10/2018</td>
                                <td>12/10/2018</td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                        <input type="checkbox" />
                                        <span></span>
                                    </label>
                                </td>
                                <td>Aerador</td>
                                <td>Disponível</td>
                                <td>3</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                        <input type="checkbox" />
                                        <span></span>
                                    </label>
                                </td>
                                <td>Aerador</td>
                                <td>Alugado</td>
                                <td>1</td>
                                <td>Rubens Sasse</td>
                                <td>05/08/2018</td>
                                <td>05/08/2019</td>
                            </tr>
                        </tbody>

                    </table>

                    <div class="area_label_cont">
                        <span>
                            <label>Exibindo 8 de 24 Registros</label>
                        </span>
                    </div>

                    <div class="area_botoes_paginacao">
                        <ul class="pagination">
                            <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
                            <li class="active"><a href="#!">1</a></li>
                            <li class="waves-effect"><a href="#!">2</a></li>
                            <li class="waves-effect"><a href="#!">3</a></li>
                            <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>
@endsection