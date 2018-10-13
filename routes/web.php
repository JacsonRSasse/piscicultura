<?php

Route::get('/', function () {
    return view('pagina_teste');
});

Route::get('/produtor', 'ControllerProdutor@getIndexProdutor');
Route::get('/produtor/vender_producao', ['as' => 'venderProducao', 'uses' => 'ControllerProdutor@getViewVenderProducao']);
//Route::get('/getJson', 'Controller@getJson');
