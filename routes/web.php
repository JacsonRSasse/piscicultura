<?php

Route::prefix('login')->group(function(){

    Route::get(
            '/',
            [
                'as'   => 'login', 
                'uses' => 'ControllerLogin@getTelaLogin'
            ]);
    Route::post(
            '/realiza_login',
            [
                'as' => 'realizaLogin',
                'uses' => 'ControllerLogin@doRealizaLogin'
            ]);
    
});

Route::group(['middleware' => 'auth'], function(){
    
    Route::prefix('produtor')->group(function(){
        
        Route::get(
                '/',
                ['as' => '#', 'uses' => 'ControllerProdutor@getIndexProdutor']);
        Route::get(
                '/vender_producao',
                ['as' => 'venderProducao', 'uses' => 'ControllerProdutor@getViewVenderProducao']);
        Route::get(
                '/alugar_equipamento', 
                ['as' => 'alugarEquipamento', 'uses' => 'ControllerProdutor@getViewAlugarEquipamento']);
        Route::post(
                '/add_item_carrinho',
                ['as' => 'addItemCarrinho', 'uses' => 'ControllerProdutor@addItemCarrinho']);
        
    });
    
    
});


Route::get(
        '/teste',
        function(){
            /*@var $lista Equipamento*/
            $lista = App\Membro::find(1);
            dd($lista->getAssociacaoFromMembro);
        });




//Route::get('/getJson', 'Controller@getJson');
