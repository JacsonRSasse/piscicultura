<header class="navbar_fixa">
    <div class="navbar-fixed">
        <nav class="navbar white">
            <div class="nav-wrapper">
                <a href="#" class="brand-logo blue-grey-text">Piscicultura Alto Vale do Itajaí - @yield('titulo_navbar')</a>
            </div>
        </nav>
    </div>
    <ul class="sidenav sidenav-fixed">
        <li>
            <a id="logo-usuario"><i class="material-icons">person</i>@yield('nome_usuario')</a>
        </li>
        <li class="">
            <ul class="collapsible">            
            @foreach($aItensMenu as $oItem)
                <li class="waves-effect">
                    <a class="collapsible-header"><i class="material-icons chevron">chevron_left</i>{{$oItem->header}}</a>
                    @if(count($oItem->itens))
                    <div class="collapsible-body">
                        @foreach($oItem->itens as $item)
                        <ul>
                            <li><a id="{{$item->id}}" href="{{$item->link}}" class="waves-effect item-corpo">{{$item->descricao}}</a></li>
                        </ul>
                        @endforeach
                    </div>
                    @endif
                </li>                
            @endforeach
            </ul>
        </li>
    </ul>
</header>