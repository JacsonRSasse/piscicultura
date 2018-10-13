<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Piscicultura</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="{{ asset('css/materialize.css') }}" type="text/css" rel="stylesheet"> 
        <link href="{{ asset('css/datatables.css') }}" type="text/css" rel="stylesheet"> 
        <link href="{{ asset('css/principal.css') }}" type="text/css" rel="stylesheet"> 
        <script src="{{ asset('js/jquery-3.3.1.js') }}" type="text/javascript"></script> 
        <script src="{{ asset('js/materialize.js') }}" type="text/javascript"></script> 
        <script src="{{ asset('js/datatables.js') }}" type="text/javascript"></script> 
        <script src="{{ asset('js/funcoes.js') }}" type="text/javascript"></script> 
    </head>
    <body> 
    
    @include('base.navbar_padrao')
    @yield('body')
    
    </body>
</html>
