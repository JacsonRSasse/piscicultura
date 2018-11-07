@extends('base.corpo_login')

@section('main')

<main>
    <div class="container">
        <div class="row">
            <div id="tela-login" class="col s12">
                <div class="card">
                    <div class="card-content formulario-login">

                        <form action=" {{ route('realizaLogin') }} " method="post">
                            {{ csrf_field() }}
                            <div class="input-field">
                                <i class="material-icons prefix">account_circle</i>
                                <input type="text" name="usuario" id="usuario">
                                <label for="usuario">Usuário</label>
                            </div>

                            <div class="input-field">
                                <i class="material-icons prefix">vpn_key</i>
                                <input type="password" name="senha" id="senha">
                                <label for="senha">Senha</label>
                            </div>
                            @if(isset($erro) && $erro)
                            <div class="center">
                                <label style="color: red;">Usuário ou Senha incorretos</label>                               
                            </div>
                            @endif
                            <div class="center botao_submit">
                                <button class="btn waves-effect waves-light" type="submit" name="action">Login
                                    <i class="material-icons right">send</i>
                                </button>
                            </div>


                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<div class="row">
    <div class="col s12 center logo">
        <span class="span_logo">Piscicultura Alto Vale do Itajaí</span>
    </div>
</div>

@endsection