<?php
use Illuminate\Support\Facades\DB;
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
        Route::get(
                '/itens_pedido',
                ['as' => 'carrinhoEquipamentos', 'uses' => 'ControllerProdutor@getViewCarrinhoEquipamentos']);
        
    });
    
    Route::prefix('associacao')->group(function(){
        
        Route::get(
                '/',
                ['as' => 'associacaoIndex', function(){return 'Not implemmented yiet!';}]);
        
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
            
            dd(bcrypt('teste'));
        });




//Route::get('/getJson', 'Controller@getJson');
