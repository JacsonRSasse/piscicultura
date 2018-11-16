<li>
    <a id="logo-usuario"><i class="material-icons">person</i>@yield('nome_usuario')</a>
</li>
<li class="">
    <ul class="collapsible">            
        @foreach($aItensMenu as $oItem)
        <li class="waves-effect {{$oItem->active ? ' active' : ''}}">
            <a class="collapsible-header"><i class="material-icons chevron">chevron_left</i>{{$oItem->header}}</a>
            @if(count($oItem->itens))
            <div class="collapsible-body">
                @foreach($oItem->itens as $item)
                <ul>
                    <li><a href="{{$item->link}}" class="waves-effect item-corpo {{$item->class}}">{{$item->descricao}}</a></li>
                </ul>
                @endforeach
            </div>
            @endif
        </li>                
        @endforeach
    </ul>
</li>