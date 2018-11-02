<?php

Route::get('/', function () {
    return view('pagina_teste');
});

Route::get(
        '/produtor',
        ['as' => '#', 'uses' => 'ControllerProdutor@getIndexProdutor']);
Route::get(
        '/produtor/vender_producao',
        ['as' => 'venderProducao', 'uses' => 'ControllerProdutor@getViewVenderProducao']);
Route::get(
        '/produtor/alugar_equipamento', 
        ['as' => 'alugarEquipamento', 'uses' => 'ControllerProdutor@getViewAlugarEquipamento']);
Route::get(
        '/teste',
        function(){
            $lista = App\Http\Controllers\ControllerProdutor::teste();
            dd($lista);
        });




//Route::get('/getJson', 'Controller@getJson');
