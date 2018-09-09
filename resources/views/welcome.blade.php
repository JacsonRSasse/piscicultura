<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link type="text/css" rel="stylesheet" href="{{ asset('css/testes.css') }}">
        <script type="text/javascript" src="{{ asset('js/jquery-3.3.1.js') }}"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script type="text/javascript" src="{{ asset('js/funcoes.js') }}"></script>
    </head>
    <body>
        <div>
            <button onclick="abrirJanela()">Abrir</button>
        </div>
    </body>
</html>
