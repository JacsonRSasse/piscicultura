@extends('base.corpo_pagina')
@section('titulo_navbar', 'Alugar Equipamento')
@section('nome_usuario', auth()->user()->getPessoaFromUsuario->getNomeRazao())

@section('main')
<main>
    <div class="time_line">
        <div class="row" style="position: relative;">                    
            <div class="col l12 m12 s12">
                <div class="card" style="display: table; width: 100%;">
                    <div class="area_botoes_acoes">
                        <div class="acoes_com_grid">
                            <!--<a  class="waves-effect waves-light btn-small disabled">Visualizar</a>-->
                            <a class="waves-effect waves-light btn-small disabled" onclick="onClickAdicionaAoPedido(false)">Adicionar ao Pedido</a>
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
                                <th style="display: none;">Código</th>
                                <th>Nome</th>
                                <th>Status</th>
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
                                <td style="display: none;" id="eqpcodigo_{{$oEquipamento->eqpcodigo}}">{{ $oEquipamento->eqpcodigo }}</td>
                                <td>{{ $oEquipamento->getNome() }}</td>
                                <td>{{ $oEquipamento->getDescricaoStatus() }}</td>
                                <td>{{ $oEquipamento->getQuantidade() }}</td>
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

                    <div id="modal_aviso" class="modal">
                        <div class="modal-content">
                            <h4>Equipamento Alugado</h4>
                            <p>O equipamento solicitado encontra-se alugado. Deseja adiciona-lo mesmo assim à lista de pedidos? Seu pedido será posto na fila de espera e você será notificado quando o equipamento estiver disponível.</p>
                        </div>
                        <div class="modal-footer">
                            <a href="#!" class="modal-close waves-effect waves-green btn-flat" onclick="onClickAdicionaAoPedido(true)">Aceitar</a>
                            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
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

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function onClickAdicionaAoPedido(bIgnoreAlugado) {
        var aSelecionados = retornaItens();
        if (aSelecionados.length > 0) {
            $.post('{{ route('addItemCarrinho') }}', {'selecionados': aSelecionados, _token: '{{csrf_token()}}', 'ignoreAlugado' : bIgnoreAlugado}, function (data) {
                if(data['msg'] != '' && !data['equipAlugado']) {
                    M.toast({html: data['msg'], classes: 'rounded'});                    
                } else {
                    $('.modal').modal('open');
                }
            });
        }
    }

</script>
@endsection