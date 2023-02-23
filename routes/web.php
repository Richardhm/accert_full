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
    //Route::get('/contratos/listarindividual',"App\Http\Controllers\Admin\ContratoController@listarIndividual")->name('contratos.listarIndividual');
    //Route::get('/contratos/listarempresas',"App\Http\Controllers\Admin\ContratoController@listarContratoEmpresarial")->name('contratos.listarEmpresarial');

    Route::get('/contratos/listarempresas/emanalise',"App\Http\Controllers\Admin\ContratoController@listarContratoEmAnalise")->name('contratos.listarEmpresarial.analise');
    Route::get('/contratos/listarempresas/aguardando_primeiro_parcela',"App\Http\Controllers\Admin\ContratoController@listarContratoPrimeiraParcela")->name('contratos.listarEmpresarial.primeiraparcela');
    Route::get('/contratos/listarempresas/aguardando_segunda_parcela',"App\Http\Controllers\Admin\ContratoController@listarContratoSegundaParcela")->name('contratos.listarEmpresarial.segundaparcela');
    Route::get('/contratos/listarempresas/aguardando_terceira_parcela',"App\Http\Controllers\Admin\ContratoController@listarContratoTerceiraParcela")->name('contratos.listarEmpresarial.terceiraparcela');
    Route::get('/contratos/listarempresas/aguardando_quarta_parcela',"App\Http\Controllers\Admin\ContratoController@listarContratoQuartaParcela")->name('contratos.listarEmpresarial.quartaparcela');
    Route::get('/contratos/listarempresas/aguardando_quinta_parcela',"App\Http\Controllers\Admin\ContratoController@listarContratoQuintaParcela")->name('contratos.listarEmpresarial.quintaparcela');
    Route::get('/contratos/listarempresas/aguardando_sexta_parcela',"App\Http\Controllers\Admin\ContratoController@listarContratoSextaParcela")->name('contratos.listarEmpresarial.sextaparcela');
    Route::get('/contratos/listarempresas/finalizado',"App\Http\Controllers\Admin\ContratoController@listarContratoEmpresarialFinalizado")->name('contratos.listarEmpresarial.finalizado');
    Route::get('/contratos/listarempresas/cancelado',"App\Http\Controllers\Admin\ContratoController@listarContratoEmpresarialCancelado")->name('contratos.listarEmpresarial.cancelado');


    Route::post('/contratos/pegarEmpresarialPorUser',"App\Http\Controllers\Admin\ContratoController@listarEmpresarialPorUser")->name('contratos.listarEmpresarialPorUser');
    Route::post('/contratos/descricao',"App\Http\Controllers\Admin\ContratoController@contratoInfo")->name('contratos.info');
    Route::get('/contratos/cadastrar/individual',"App\Http\Controllers\Admin\ContratoController@formCreate")->name('contratos.create');
    Route::get('/contratos/cadastrar/coletivo',"App\Http\Controllers\Admin\ContratoController@formCreateColetivo")->name('contratos.create.coletivo');
    Route::get('/contratos/cadastrar/empresarial',"App\Http\Controllers\Admin\ContratoController@formCreateEmpresarial")->name('contratos.create.empresarial');
    /**Fim Contratos*/

    /**Financeiro*/
    Route::get('/financeiro',"App\Http\Controllers\Admin\FinanceiroController@index")->name('financeiro.index');

    Route::get('/financeiro/coletivo/em_analise',"App\Http\Controllers\Admin\FinanceiroController@coletivoEmAnalise")->name('financeiro.coletivo.em_analise');
    Route::get('/financeiro/coletivo/em_geral',"App\Http\Controllers\Admin\FinanceiroController@coletivoEmGeral")->name('financeiro.coletivo.em_geral');



    Route::get('/financeiro/coletivo/emissao_boleto',"App\Http\Controllers\Admin\FinanceiroController@coletivoEmissaoBoleto")->name('financeiro.coletivo.emissao_boleto');
    Route::get('/financeiro/coletivo/pagamento_adesao',"App\Http\Controllers\Admin\FinanceiroController@coletivoPagamentoAdesao")->name('financeiro.coletivo.pagamento_adesao');
    Route::get('/financeiro/coletivo/pagamento_vigencia',"App\Http\Controllers\Admin\FinanceiroController@coletivoPagamentoVigencia")->name('financeiro.coletivo.pagamento_vigencia');
    Route::get('/financeiro/coletivo/pagamento_segunda_parcela',"App\Http\Controllers\Admin\FinanceiroController@coletivoPagamentoSegundaParcela")->name('financeiro.coletivo.pagamento_segunda_parcela');
    Route::get('/financeiro/coletivo/pagamento_terceira_parcela',"App\Http\Controllers\Admin\FinanceiroController@coletivoPagamentoTerceiraParcela")->name('financeiro.coletivo.pagamento_terceira_parcela');
    Route::get('/financeiro/coletivo/pagamento_quarta_parcela',"App\Http\Controllers\Admin\FinanceiroController@coletivoPagamentoQuartaParcela")->name('financeiro.coletivo.pagamento_quarta_parcela');
    Route::get('/financeiro/coletivo/pagamento_quinta_parcela',"App\Http\Controllers\Admin\FinanceiroController@coletivoPagamentoQuintaParcela")->name('financeiro.coletivo.pagamento_quinta_parcela');
    Route::get('/financeiro/coletivo/pagamento_sexta_parcela',"App\Http\Controllers\Admin\FinanceiroController@coletivoPagamentoSextaParcela")->name('financeiro.coletivo.pagamento_sexta_parcela');
    Route::get('/financeiro/coletivo/pagamento_coletivo_finalizado',"App\Http\Controllers\Admin\FinanceiroController@coletivoFinalizado")->name('financeiro.coletivo.finalizado');
    Route::get('/financeiro/coletivo/pagamento_coletivo_cancelado',"App\Http\Controllers\Admin\FinanceiroController@coletivoCancelados")->name('financeiro.coletivo.cancelado');

    Route::get("/financeiro/individual/em_geral","App\Http\Controllers\Admin\FinanceiroController@geralIndividualPendentes")->name('financeiro.individual.geralIndividualPendentes');
    Route::get('/financeiro/individual/em_analise',"App\Http\Controllers\Admin\FinanceiroController@emAnaliseIndividual")->name('financeiro.individual.em_analise');
    Route::get('/financeiro/individual/pagamento_primeira_parcela',"App\Http\Controllers\Admin\FinanceiroController@individualPagamentoPrimeiraParcela")->name('financeiro.individual.pagamento_primeira_parcela');
    Route::get('/financeiro/individual/pagamento_segunda_parcela',"App\Http\Controllers\Admin\FinanceiroController@individualPagamentoSegundaParcela")->name('financeiro.individual.pagamento_segunda_parcela');
    Route::get('/financeiro/individual/pagamento_terceira_parcela',"App\Http\Controllers\Admin\FinanceiroController@individualPagamentoTerceiraParcela")->name('financeiro.individual.pagamento_terceira_parcela');
    Route::get('/financeiro/individual/pagamento_quarta_parcela',"App\Http\Controllers\Admin\FinanceiroController@individualPagamentoQuartaParcela")->name('financeiro.individual.pagamento_quarta_parcela');
    Route::get('/financeiro/individual/pagamento_quinta_parcela',"App\Http\Controllers\Admin\FinanceiroController@individualPagamentoQuintaParcela")->name('financeiro.individual.pagamento_quinta_parcela');
    Route::get('/financeiro/individual/pagamento_sexta_parcela',"App\Http\Controllers\Admin\FinanceiroController@individualPagamentoSextaParcela")->name('financeiro.individual.pagamento_sexta_parcela');
    
    Route::get('/financeiro/individual/finalizado',"App\Http\Controllers\Admin\FinanceiroController@individualFinalizado")->name('financeiro.individual.finalizado');
    Route::get('/financeiro/coletivo/pagamento_individual_cancelado',"App\Http\Controllers\Admin\FinanceiroController@individualCancelados")->name('financeiro.individual.cancelado');

    Route::post('/financeiro/mudarEstadosColetivo',"App\Http\Controllers\Admin\FinanceiroController@mudarEstadosColetivo")->name('financeiro.mudarStatusColetivo');
    Route::post('/financeiro/mudarEstadosIndividual',"App\Http\Controllers\Admin\FinanceiroController@mudarEstadosIndividual")->name('financeiro.mudarStatusIndividual');
    Route::post('/financeiro/mudarEstadosEmpresarial',"App\Http\Controllers\Admin\FinanceiroController@mudarEstadosEmpresarial")->name('financeiro.mudarStatusEmpresarial');

    Route::post("/financeiro/mudarDataVigenciaColetivo","App\Http\Controllers\Admin\FinanceiroController@mudarDataVivenciaColetivo")->name('financeiro.mudarVigenciaColetivo');

    Route::post('/financeiro/baixaDaData',"App\Http\Controllers\Admin\FinanceiroController@baixaDaData")->name('financeiro.baixa.data');
    Route::post('/financeiro/baixaDaData/individual',"App\Http\Controllers\Admin\FinanceiroController@baixaDaDataIndividual")->name('financeiro.baixa.data.individual');
    Route::post('/financeiro/baixaDaData/empresarial',"App\Http\Controllers\Admin\FinanceiroController@baixaDaDataEmpresarial")->name('financeiro.baixa.data.empresarial');


    Route::post('/financeiro/editarCampoIndividualmente',"App\Http\Controllers\Admin\FinanceiroController@editarCampoIndividualmente")->name('financeiro.editar.campoIndividualmente');
    Route::post('/financeiro/editarIndividualCampoIndividualmente',"App\Http\Controllers\Admin\FinanceiroController@editarIndividualCampoIndividualmente")->name('financeiro.editar.individual.campoIndividualmente');



    Route::post('/financeiro/contratos',"App\Http\Controllers\Admin\FinanceiroController@verContrato")->name('financeiro.ver.contrato');
    Route::post('/financeiro/cancelados',"App\Http\Controllers\Admin\FinanceiroController@cancelarContrato")->name('financeiro.contrato.cancelados');
    Route::post('/financeiro/excluir',"App\Http\Controllers\Admin\FinanceiroController@excluirCliente")->name('financeiro.excluir.cliente');
    Route::post('/financeiro/excluir/individual',"App\Http\Controllers\Admin\FinanceiroController@excluirClienteIndividual")->name('financeiro.excluir.cliente.individual');

    Route::post('/financeiro/excluir/empresarial',"App\Http\Controllers\Admin\FinanceiroController@excluirClienteEmpresarial")->name('financeiro.excluir.cliente.empresarial');


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
