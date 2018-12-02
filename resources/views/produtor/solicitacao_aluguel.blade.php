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
                                <th>Aluguel Número</th>
                                <th>Posição na Fila</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if(count($aAluguel))
                            @foreach($aAluguel as $oAluguel)
                            <tr>
                                <td>{{ $oAluguel->alunumero }}</td>
                                <td>{{ $oAluguel->filaAluguel->filnumero }}</td>
                                <td>{{ $oAluguel->getDescriptionItem('StatusAluguel', $oAluguel->alustatus) }}</td>
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

    function getOrderForConsulta() {
        return [0, 'asc'];
    }
</script>
@endsection
