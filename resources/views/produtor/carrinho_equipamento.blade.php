@extends('base.corpo_pagina')
@section('titulo_navbar', 'Carrinho Equipamentos Aluguel')
@section('nome_usuario', auth()->user()->getPessoaFromUsuario->getNomeRazao())

@section('main')
<main>
    <div class="time_line">
        <div class="row" style="position: relative;">                    
            <div class="col l12 m12 s12">
                <div class="card" style="display: table; width: 100%;">
                    <div class="area_botoes_acoes">
                        <div class="acoes_sem_grid">
                            <a class="waves-effect waves-light btn-small" onclick="onClickCancelaPedido()">Cancelar</a>
                            <a class="waves-effect waves-light btn-small" onclick="onClickFinalizaPedido()">Finalizar</a>
                        </div>
                        <div class="acoes_com_grid">
                            <a class="waves-effect waves-light btn-small disabled" onclick="onClickExcluiItemPedido()">Excluir</a>
                        </div>
                    </div>
                    <table id="dataTable_consulta" class="consulta_padrao centered highlight">
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

<!--                    <div class="area_label_cont">
                        <span>
                            <label>Exibindo {{ $aEquipamentos->count() }} de {{ $aEquipamentos->total() }} Registros</label>
                        </span>
                    </div>-->

<!--                    <div class="area_botoes_paginacao">
                        <ul class="pagination">
                            <li class="waves-effect {{ $aEquipamentos->currentPage() == 1 ? ' disabled' : '' }}"><a href="{{ $aEquipamentos->previousPageUrl() }}"><i class="material-icons">chevron_left</i></a></li>
                            @for($i = 1; $i <= $aEquipamentos->lastPage(); $i++)
                            <li class="waves-effect {{ $aEquipamentos->currentPage() == $i ? ' active' : '' }}"><a href="{{ $aEquipamentos->url($i) }}">{{ $i }}</a></li>
                            @endfor
                            <li class="waves-effect {{ $aEquipamentos->currentPage() == $aEquipamentos->lastPage() ? ' disabled' : '' }}"><a href="{{ $aEquipamentos->nextPageUrl() }}"><i class="material-icons">chevron_right</i></a></li>
                        </ul>
                    </div>-->
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('comportamentos')
<script>
    
    function onClickCancelaPedido(){
        
    }
    
    function onClickFinalizaPedido(){
        
    }
    
    function onClickExcluiItemPedido(){
        var oConsulta = document.getElementById('consulta_padrao');
        var oCorpo = oConsulta.getElementsByTagName('tbody');
        var aLinha = oCorpo[0].getElementsByTagName('tr');
        var aSelecionados = [];
        $.each(aLinha, function () {
            if (this.firstElementChild.firstElementChild.firstElementChild.checked) {
                $.each(this.getElementsByTagName('td'), function () {
                    if (this.id) {
                        aSelecionados.push(this.id);
                    }
                });
            }
        });
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
@endsection()
