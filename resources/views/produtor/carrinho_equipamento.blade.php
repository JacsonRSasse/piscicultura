@extends('base.corpo_pagina')
@section('titulo_navbar', 'Carrinho Equipamentos Aluguel')
@section('nome_usuario', auth()->user()->getPessoaFromUsuario->getNomeRazao())

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
                            <a class="waves-effect waves-light btn-small">Cancelar</a>
                            <a class="waves-effect waves-light btn-small">Finalizar</a>
                        </div>
                        <div class="acoes_com_grid">
                            <a class="waves-effect waves-light btn-small disabled">Excluir</a>
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
                                <th>Código</th>
                                <th>Nome</th>
                                <th>Quantidade</th>
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
                                <td>{{ $oEquipamento->codigo }}</td>
                                <td>{{ $oEquipamento->nome }}</td>
                                <td>{{ $oEquipamento->quantidade }}</td>
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
    </div>
</main>
@endsection
