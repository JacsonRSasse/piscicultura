@extends('base.corpo_pagina')
@section('titulo_navbar', 'Alugar Equipamento')

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
                                    <a class="waves-effect waves-light btn-small green" 
                                       title="Adicionar ao Carrinho" 
                                       onclick="onClickAdicionaAoPedido({{ $oEquipamento->eqpcodigo }} , {{ $oEquipamento->isAlugado() }})"
                                       >
                                        <i class="material-icons">add_shopping_cart</i>
                                    </a>
                                </td>
                                <td>{{ $oEquipamento->eqpnome }}</td>
                                <td>{{ $oEquipamento->getDescriptionItem('StatusEquipamento', $oEquipamento->eqpstatus) }}</td>
                                <td>{{ $oEquipamento->eqpquantidade }}</td>
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
@section('comportamentos')
<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function onClickAdicionaAoPedido(iCod, bAlugado) {
        var bResp = false;
        debugger;
        if(bAlugado){
            var bResp = confirm('O equipamento solicitado encontra-se alugado. \nDeseja adiciona-lo mesmo assim à lista de pedidos? \nSeu pedido será posto na fila de espera e você será notificado quando o equipamento estiver disponível.');
            if(!bResp){
                return false;
            }
        }
        $.post('{{ route('addItemCarrinho') }}', {'eqpcodigo': iCod, _token: '{{csrf_token()}}', 'ignoreAlugado' : bResp}, function (data) {
            M.toast({html: data['msg'], classes: 'rounded'});
        });
    }

</script>
@endsection