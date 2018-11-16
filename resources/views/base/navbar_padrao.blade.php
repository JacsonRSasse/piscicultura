<header class="navbar_fixa">
    <div class="navbar-fixed">
        <nav class="navbar white">
            <div class="nav-wrapper">
                <a href="#" data-target="mobile-sidenav" class="sidenav-trigger blue-grey-text"><i class="material-icons">menu</i></a>
                <a href="#" class="brand-logo blue-grey-text" data-target="dropdown_user">Piscicultura Alto Vale do Itajaí - @yield('titulo_navbar')</a>
                <ul class="right area_botao_car">
                    @yield('botoes_adicionais')
                    <li class="hide-on-med-and-down">
                        <a class="dropdown-trigger" data-target="dropdown_user"><i class="material-icons" title="Configurações">settings</i></a>
                    </li>
                </ul>
                <div id="dropdown_user" class="dropdown-content">
                    <ul>
                        <li><a href="{{route('logout')}}">Sair</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <ul class="sidenav sidenav-fixed">
        @include('base.sidebar_itens')
    </ul>
    <ul class="sidenav" id="mobile-sidenav">
        @include('base.sidebar_itens')
    </ul>
</header>