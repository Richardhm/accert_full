<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/login');






Route::middleware('auth')->prefix("admin")->group(function(){
    
    
    /* Home **/
    Route::get("/","App\Http\Controllers\Admin\HomeController@index");
    /* Fim Home**/


    /**Orçamentos  */    
    Route::get('/orcamento',"App\Http\Controllers\Admin\OrcamentoController@index")->name('orcamento.index');
    Route::post("/orcamento","App\Http\Controllers\Admin\OrcamentoController@montarOrcamento")->name('orcamento.montarOrcamento');
    /**Fim Orçamentos */


    /**Contratos*/
    Route::get('/contratos',"App\Http\Controllers\Admin\ContratoController@index")->name('contratos.index');
    Route::post('/contratos',"App\Http\Controllers\Admin\ContratoController@store")->name('contratos.store');
    Route::post('/contratos/individual',"App\Http\Controllers\Admin\ContratoController@storeIndividual")->name('individual.store');
    Route::post('/contratos/montarPlanos',"App\Http\Controllers\Admin\ContratoController@montarPlanos")->name('contratos.montarPlanos');
    Route::post('/contratos/montarPlanosIndividual',"App\Http\Controllers\Admin\ContratoController@montarPlanosIndividual")->name('contratos.montarPlanosIndividual');
    
    Route::post('/contratos/empresarial',"App\Http\Controllers\Admin\ContratoController@storeEmpresarial")->name('contratos.storeEmpresarial');  
    
    Route::get('/contratos/listarColetivoPorAdesao',"App\Http\Controllers\Admin\ContratoController@listarColetivoPorAdesao")->name('contratos.listarColetivoPorAdesao');
    Route::get('/contratos/listarindividual',"App\Http\Controllers\Admin\ContratoController@listarIndividual")->name('contratos.listarIndividual');
    Route::get('/contratos/listarempresas',"App\Http\Controllers\Admin\ContratoController@listarContratoEmpresarial")->name('contratos.listarEmpresarial');
    
    Route::post('/contratos/pegarEmpresarialPorUser',"App\Http\Controllers\Admin\ContratoController@listarEmpresarialPorUser")->name('contratos.listarEmpresarialPorUser');
    Route::post('/contratos/descricao',"App\Http\Controllers\Admin\ContratoController@contratoInfo")->name('contratos.info');
    Route::get('/contratos/cadastrar/individual',"App\Http\Controllers\Admin\ContratoController@formCreate")->name('contratos.create');
    Route::get('/contratos/cadastrar/coletivo',"App\Http\Controllers\Admin\ContratoController@formCreateColetivo")->name('contratos.create.coletivo');
    Route::get('/contratos/cadastrar/empresarial',"App\Http\Controllers\Admin\ContratoController@formCreateEmpresarial")->name('contratos.create.empresarial');
    /**Fim Contratos*/

    /**Financeiro*/
    Route::get('/financeiro',"App\Http\Controllers\Admin\FinanceiroController@index")->name('financeiro.index');
    Route::post('/financeiro/mudarEstadosColetivo',"App\Http\Controllers\Admin\FinanceiroController@mudarEstadosColetivo")->name('financeiro.mudarStatusColetivo');
    /**Fim Financeiro*/

    /***Comissões*****/
    Route::get('/comissao',"App\Http\Controllers\Admin\ComissoesController@index")->name('comissao.index');
    Route::get('/comissao/listarindividual',"App\Http\Controllers\Admin\ComissoesController@listarComissoes")->name('comissao.listar');
    /***Fim Comissões*****/


    /***Premiação***/
    Route::get('/premiacao',"App\Http\Controllers\Admin\PremiacaoController@index")->name('premiacao.index');
    Route::get('/premiacao/listarindividual',"App\Http\Controllers\Admin\PremiacaoController@listarPremiacao")->name('premiacao.listar');
    /***Fim Premiação***/



    /****************************************************************Configurações******************************************************************/


        /* Corretora **/
        Route::get('/corretora',"App\Http\Controllers\Admin\CorretoraController@index")->name('corretora.index');
        Route::post('/corretora',"App\Http\Controllers\Admin\CorretoraController@store")->name('corretora.store');
        /* Fim  Corretora **/

        /**Administradoras*/
        Route::get("/administradora","App\Http\Controllers\Admin\AdministradoraController@index")->name('administradoras.index');
        Route::get("/administradora/list","App\Http\Controllers\Admin\AdministradoraController@list")->name('administradoras.list');
        Route::post("/administradora/cadastrar","App\Http\Controllers\Admin\AdministradoraController@cadastrarAjax")->name('administradoras.store');
        /**Fim Administradoras*/


        /**Tabela Origem */
        Route::get("/tabela_origem","App\Http\Controllers\Admin\TabelaOrigemControlller@index")->name('tabela_origem.index');
        Route::get("/tabela_origem/list","App\Http\Controllers\Admin\TabelaOrigemControlller@list")->name('tabela_origem.list');
        Route::post("/tabela_origem/store","App\Http\Controllers\Admin\TabelaOrigemControlller@store")->name('tabela_origem.store');
        /**Fim Tabela Origem */

        /**Planos*/
        Route::get("/planos","App\Http\Controllers\Admin\PlanoController@index")->name('planos.index');
        Route::get("/planos/list","App\Http\Controllers\Admin\PlanoController@list")->name('planos.list');
        Route::post("/planos/store","App\Http\Controllers\Admin\PlanoController@store")->name('planos.store');
        /**Fim Planos*/


        /**Tabela de Preços */
        Route::get("/tabela","App\Http\Controllers\Admin\TabelaController@index")->name('tabela.index');    
        Route::post("/tabela","App\Http\Controllers\Admin\TabelaController@store")->name("store.tabela");
        /** Fim Tabela de Preços */
           
        
        /****Corretor*****/

        Route::get("/corretores","App\Http\Controllers\Admin\CorretorController@index")->name('corretor.index');
        Route::post("/corretores","App\Http\Controllers\Admin\CorretorController@store")->name('corretores.store');


        /****Fim Corretor*****/



    /*************************************************************Fim Configurações****************************************************************/



    


    
});

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
