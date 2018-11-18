@extends('base.navbar_padrao')
@section('botoes_adicionais')
<li class="hide-on-med-and-down">
    <a href="{{route('carrinhoEquipamentos')}}" title="Lista Equipamentos"><i class="material-icons">shopping_cart</i></a>
</li>
@endsection