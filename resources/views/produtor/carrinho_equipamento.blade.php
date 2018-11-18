@extends('base.corpo_pagina')
@section('titulo_navbar', 'Carrinho Equipamentos Aluguel')

@section('main')
<main>
    <div class="time_line">
        <div class="row" style="position: relative;">                    
            <div class="col l12 m12 s12">
                <div class="card" style="display: table; width: 100%;">
                    <div class="area_botoes_acoes">
                        <div class="acoes_sem_grid">
                            <a class="waves-effect waves-light btn-small" href="{{route('cancelaPedido')}}">Cancelar</a>
                            <a class="waves-effect waves-light btn-small modal-trigger" href="#modal_data_final">Finalizar</a>
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
                                <td id="eqpcodigo_{{$oEquipamento->codigo}}">{{ $oEquipamento->codigo }}</td>
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

                    @if(isset($bInseriuAluguel) && $bInseriuAluguel)
                    
                    @endif
                    
                    <div id="modal_data_final" class="modal" style="width: 350px;">
                        <div class="modal-content">
                            <h4>Datas</h4>
                            <p>Informe o intervalo de datas que você deseja alugar o(s) equipamento(s).</p>
                            <form action="{{route('finalizaPedido')}}" method="post">
                                @csrf
                                <div class="row">
                                    <label for="dataDe">De</label>
                                    <input type="date" id="dataDe" name="dataDe">
                                </div>
                                <div class="row">
                                    <label for="dataAte">Até</label>
                                    <input type="date" id="dataAte" name="dataAte">
                                </div>
                                
                                <input type="submit" value="Enviar" class="btn-small">
                            </form>
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
    
    $(document).ready(function(){
        @if(isset($bInseriuAluguel))
            @if($bInseriuAluguel)
                M.toast({html: 'Solicitação de Aluguel encaminhada com sucesso', classes: 'rounded'});
            @else
                M.toast({html: 'Erro na Solicitação de Aluguel', classes: 'rounded'});
            @endif
        @endif
    });
    
    function onClickExcluiItemPedido(){
        var aSelecionados = retornaItens(); 
        if (aSelecionados.length > 0) {
            $.post('{{ route('removeItemCarrinho') }}', {'selecionados': aSelecionados, _token: '{{csrf_token()}}'}, function (data) {
                window.location='{{route('carrinhoEquipamentos')}}';
            });
        }        
    }
    
    
</script>
@endsection()
