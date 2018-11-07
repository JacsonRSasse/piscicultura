@extends('base.navbar_padrao')
@section('botoes_adicionais')
<ul class="right area_botao_car">
    <li class="hide-on-med-and-down">
        <a href="{{route('carrinhoEquipamentos')}}"><i class="material-icons">list_alt</i></a>
    </li>
</ul>
@endsection