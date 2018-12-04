<?php

Route::get('/', function() {
    return redirect()->route('login');    
});

Route::prefix('login')->group(function(){

    Route::get(
            '/{erro?}',
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

Route::get(
        'logout',
        ['as' => 'logout', 'uses' => 'ControllerLogin@doRealizaLogout']);

Route::group(['middleware' => 'auth'], function(){
    
    Route::prefix('produtor')->group(function(){
        
        Route::get(
                '/',
                ['as' => 'produtorIndex', 'uses' => 'ControllerProdutor@getIndexProdutor']);
        Route::get(
                '/vender_producao',
                ['as' => 'venderProducao', 'uses' => 'ControllerProdutor@getViewVenderProducao']);
        Route::get(
                '/alugar_equipamento', 
                ['as' => 'alugarEquipamento', 'uses' => 'ControllerProdutor@getViewAlugarEquipamento']);
        Route::post(
                '/add_item_carrinho',
                ['as' => 'addItemCarrinho', 'uses' => 'ControllerProdutor@addItemCarrinho']);
        Route::get(
                '/solicitacoes_aluguel',
                ['as' => 'solicitacaoAluguelProdutor', 'uses' => 'ControllerProdutor@getViewSolicitacoesAluguel']);
        
        Route::prefix('itens_pedido')->group(function(){
            
            Route::get(
                    '/',
                    ['as' => 'carrinhoEquipamentos', 'uses' => 'ControllerProdutor@getViewCarrinhoEquipamentos']);
            Route::post(
                    '/remove_item',
                    ['as' => 'removeItemCarrinho', 'uses' => 'ControllerProdutor@removeItemCarrinho']);
            Route::get(
                    '/cancela_pedido',
                    ['as' => 'cancelaPedido', 'uses' => 'ControllerProdutor@cancelaPedido']);
            Route::post(
                    'finaliza_pedido',
                    ['as' => 'finalizaPedido', 'uses' => 'ControllerProdutor@finalizaPedido']);
            
        });
        
    });
    
    Route::prefix('associacao')->group(function(){
        
        Route::get(
                '/',
                ['as' => 'associacaoIndex', 'uses' => 'ControllerAssociacao@getIndexAssociacao']);
        
        Route::get(
                '/solicitacoes_aluguel',
                ['as' => 'solicitacaoAluguel', 'uses' => 'ControllerAssociacao@getViewSolicitacoesAluguel']);
        
        Route::get(
                '/busca_status_equipamento',
                ['as' => 'buscaStatusEquipamento', 'uses' => 'ControllerEquipamento@getStatusEquipamentos']);
        Route::post(
                '/responde_solicitacao_aluguel',
                ['as' => 'respondeSolicitacaoAluguel', 'uses' => 'ControllerAssociacao@setRespostaSolicitacao']);
        Route::get(
                '/equipamento',
                ['as' => 'cadastroEquipamento', 'uses' => 'ControllerAssociacao@getViewCadastroEquipamento']);
        
    });

    
    Route::prefix('comprador')->group(function(){
        
        Route::get(
                '/',
                ['as' => 'compradorIndex', function(){return 'Not implemmented yiet!';}]);
        
    });
    
    Route::prefix('fornecedor')->group(function(){
        
        Route::get(
                '/',
                ['as' => 'fornecedorIndex', function(){return 'Not implemmented yiet!';}]);
        
    });
    
});


Route::get(
        '/teste',
        function(){
            
        });




//Route::get('/getJson', 'Controller@getJson');

//Auth::routes();
//
//Route::get('/home', 'HomeController@index')->name('home');
