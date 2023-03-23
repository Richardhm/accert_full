@extends('adminlte::page')
@section('title', 'Contratos')
@section('plugins.jqueryUi', true)
@section('plugins.Toastr', true)
@section('plugins.Datatables', true)
@section('content_header')
        
    <ul class="list_abas">
        <li data-id="aba_individual" class="ativo">Individual</li>
        <li data-id="aba_coletivo">Coletivo</li>
        <li data-id="aba_empresarial">Empresarial</li>
    </ul>

@stop

@section('content_top_nav_right')
    <li class="nav-item"><a class="nav-link text-white" href="{{route('orcamento.search.home')}}">Tabela de Preço</a></li>
    <li class="nav-item"><a class="nav-link text-white" href="{{route('home.administrador.consultar')}}">Consultar</a></li>
    <!-- <li class="nav-item"><a href="" class="nav-link div_info"><i class="fas fa-cogs text-white"></i></a></li> -->
    <a class="nav-link" data-widget="fullscreen" href="#" role="button"><i class="fas fa-expand-arrows-alt text-white"></i></a>
@stop

@section('content')

    <input type="hidden" id="janela_ativa" name="janela_ativa" value="aba_individual">


    <div class="container_div_info">
        
    </div>

    <section class="conteudo_abas">
        <!--------------------------------------INDIVIDUAL------------------------------------------>
        <main id="aba_individual">
           
            <section class="d-flex justify-content-between" style="flex-wrap: wrap;align-content: flex-start;">
            
                <!--COLUNA DA ESQUERDA-->
                <div class="d-flex flex-column text-white ml-1" style="flex-basis:16%;border-radius:5px;">                    

                    <div class="mb-1">
                        <!-- <button class="btn btn-success btn-block estilo_btn_plus_individual">Criar Contrato</button> -->
                        <a class="btn btn-block" style="background-color:#123449;color:#FFF;" href="{{route('contratos.create')}}">Criar Contrato</a>
                    </div>

                    <div class="mb-1">
                        <select id="select_usuario_individual" class="form-control">
                            <option value="todos" class="text-center">---Escolher Corretor---</option>
                            
                        </select>
                    </div>

                    <div style="margin:0 0 20px 0;padding:0;background-color:#123449;border-radius:5px;">

                        <div class="text-center py-1 d-flex justify-content-between border-bottom textoforte-list" id="all_pendentes_individual">
                            <span class="w-50 d-flex justify-content-start ml-2">
                                Pendentes
                            </span>
                            <span class="d-flex justify-content-end badge badge-light mr-1 individual_quantidade_pendentes" style="width:45px;text-align:right;">
                                {{$qtd_individual_pendentes}}
                            </span>
                        </div>

                        <ul style="margin:0;padding:0;list-style:none;" id="listar_individual">
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_em_analise_individual" class="individual">
                                <span>Em Análise</span>
                               <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_individual_em_analise}}</span>                        
                            </li>

                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_pagamento_1_parcela_individual" class="individual">
                                <span>Pag. 1º Parcela</span>
                               <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_individual_parcela_01}}</span>                        
                            </li>

                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_pagamento_2_parcela_individual" class="individual">
                               <span>Pag. 2º Parcela</span>
                               <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_individual_parcela_02}}</span>                        
                            </li>

                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_pagamento_3_parcela_individual" class="individual">
                               <span>Pag. 3º Parcela</span>
                               <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_individual_parcela_03}}</span>                        
                            </li>

                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_pagamento_4_parcela_individual" class="individual">
                               <span>Pag. 4º Parcela</span>
                               <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_individual_parcela_04}}</span>                        
                            </li>

                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_pagamento_5_parcela_individual" class="individual">
                               <span>Pag. 5º Parcela</span>
                               <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_individual_parcela_05}}</span>                        
                            </li>

                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_pagamento_6_parcela_individual" class="individual">
                               <span>Pag. 6º Parcela</span>
                               <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_individual_parcela_06}}</span>                        
                            </li>

                            
                        </ul>
                    </div>


                    <div style="margin:0 0 20px 0;padding:0;background-color:#123449;border-radius:5px;">
                        <ul style="list-style:none;margin:0;padding:10px 0;" id="grupo_individual_concluido">

                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="finalizado_individual" class="individual">
                               <span>Finalizado</span>
                               <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_individual_finalizado}}</span>                        
                            </li>

                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="cancelado_individual" class="individual">
                               <span>Cancelado</span>
                               <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_individual_cancelado}}</span>                        
                            </li>

                        </ul>
                    </div>    




                </div>
                <!--Fim Coluna da Esquerda  -->


                <!--COLUNA DA CENTRAL-->
                <div style="flex-basis:53%;">
                    <div class="p-2" style="background-color:#123449;color:#FFF;border-radius:5px;">
                        <table id="tabela_individual" class="table display table-sm listarindividual">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Corretor</th>
                                    <th>Cliente</th>
                                    <th>Vencimento</th>                                  
                                    <th>Status</th>
                                    <th>Detalhes</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>   
                    </div>
                </div>  
                <!--FIM COLUNA DA CENTRAL-->

                <!---------DIREITA-------------->    
                <div class="mr-1 coluna-right aba_individual">
                    <section class="p-1" style="background-color:#123449;border-radius: 5px;">


                        <div class="d-flex mb-2">
                                
                            <div style="flex-basis:25%;">
                                <span class="text-white" style="font-size:0.81em;">Administradora:</span>
                                <input type="text" name="administradora_individual" id="administradora_individual" class="form-control  form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:28%;margin:0 1%;">    
                                <span class="text-white" style="font-size:0.81em;">Tipo Plano:</span>
                                <input type="text" name="tipo_plano" id="tipo_plano_individual" class="form-control  form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:45%;" id="status">
                                <span class="text-white" style="font-size:0.81em;">Status:</span>
                                <input type="text" id="status_individual_view" class="form-control form-control-sm" readonly>
                            </div>    


                        </div>

                        <div class="d-flex mb-2">
                            
                            <div style="flex-basis:40%;">
                                <span class="text-white" style="font-size:0.81em;">Cliente:</span>
                                <input type="text" name="cliente" id="cliente" class="form-control form-control-sm" readonly>
                            </div>
                            
                            <div style="flex-basis:28%;margin:0 1%;">
                                <span class="text-white" style="font-size:0.81em;">Data Nascimento:</span>
                                <input type="text" name="data_nascimento" id="data_nascimento" class="form-control form-control-sm" readonly>
                            </div>
                            
                            <div style="flex-basis:30%;">
                                <span class="text-white" style="font-size:0.81em;">Codigo Externo:</span>
                                <input type="text" name="codigo_externo" id="codigo_externo_individual" class="form-control  form-control-sm" readonly>
                            </div>    

                        </div>

                        <div class="d-flex mb-2">
                            <div style="flex-basis:28%;">
                                <span class="text-white" style="font-size:0.81em;">CPF:</span>
                                <input type="text" id="cpf" class="form-control form-control-sm" readonly>
                            </div>
                            <div style="flex-basis:38%;margin:0 1%;">
                                <span class="text-white" style="font-size:0.81em;">Responsavel Financeiro:</span>
                                <input type="text" id="responsavel_financeiro" class="form-control  form-control-sm" readonly>
                            </div>
                            <div style="flex-basis:32%;">
                                <span class="text-white" style="font-size:0.81em;">CPF Financeiro:</span>
                                <input type="text" id="cpf_financeiro" class="form-control  form-control-sm" readonly>
                            </div>    
                        </div>


                        <div class="d-flex mb-2">
                            
                            <div style="flex-basis:28%;margin-right:1%;">
                                <span class="text-white" style="font-size:0.81em;">Celular:</span>
                                <input type="text" id="celular_individual_view_input" class="form-control form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:25%;margin-right:1%;">
                                <span class="text-white" style="font-size:0.81em;">Telefone:</span>
                                <input type="text" id="telefone_individual_view_input" class="form-control form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:45%;">
                                <span class="text-white" style="font-size:0.81em;">Email:</span>
                                <input type="text" id="email" class="form-control form-control-sm" readonly>
                            </div>


                        </div>


                        <div class="d-flex mb-2">
                            <div style="flex-basis:22%;">
                                <span class="text-white" style="font-size:0.81em;">CEP:</span>
                                <input type="text" name="cep" id="cep_individual_cadastro" class="form-control form-control-sm" readonly>
                            </div>
                            <div style="flex-basis:78%;margin:0 1%;">
                                <span class="text-white" style="font-size:0.81em;">Cidade:</span> 
                                <input type="text" id="cidade" class="form-control  form-control-sm" readonly>
                            </div>
                            <div style="flex-basis:10%;">
                                <span class="text-white" style="font-size:0.81em;">UF:</span>
                                <input type="text" id="uf" class="form-control form-control-sm" readonly>
                            </div>                         
                        </div>

                        <div class="d-flex mb-2">
                            
                            <div style="flex-basis:30%;">
                                <span class="text-white" style="font-size:0.81em;">Bairro:</span>
                                <input type="text" id="bairro_individual_cadastro" class="form-control form-control-sm" readonly>
                            </div>    

                            <div style="flex-basis:40%;margin:0 1%;">
                                <span class="text-white" style="font-size:0.81em;">Rua:</span>
                                <input type="text" id="rua_individual_cadastro" class="form-control form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:29%;">
                                <span class="text-white" style="font-size:0.81em;">Complemento:</span>
                                <input type="text" id="complemento_individual_cadastro" class="form-control form-control-sm" readonly>
                            </div>



                        </div>

                       
                        <div class="d-flex mb-2">
                            <div style="flex-basis:32%;">
                                <span class="text-white" style="font-size:0.81em;">Data Contrato:</span>
                                <input type="text" name="data_contrato" id="data_contrato" class="form-control form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:32%;margin:0 1%;">
                                <span class="text-white" style="font-size:0.81em;">Valor Contrato:</span>
                                <input type="text" name="valor_contrato" id="valor_contrato" class="form-control  form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:32%;">
                                <span class="text-white" style="font-size:0.81em;">Valor Adesão:</span>
                                <input type="text" name="valor_adesao" id="valor_adesao" class="form-control  form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:8%;margin-left:1%;">    
                                <span class="text-white" style="font-size:0.81em;">Vidas</span>
                                <input type="text" name="quantidade_vidas" id="quantidade_vidas_individual_cadastrar" class="form-control  form-control-sm" readonly>
                            </div>
                             
                        </div>

                        <div class="d-flex mb-2">

                            <div style="flex-basis:23%;">
                                <span class="text-white" style="font-size:0.81em;">Data Boleto:</span>
                                <input type="text" name="data_boleto" id="data_boleto" class="form-control  form-control-sm" readonly>
                            </div>

                             <div style="flex-basis:23%;margin:0 1%;">
                                <span class="text-white" style="font-size:0.81em;">Data Vigência:</span>
                                <input type="text" name="data_vigencia" id="data_vigencia" class="form-control  form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:53%;">
                                <span class="text-white" style="font-size:0.81em;">Plano Contratado:</span>
                                <input type="text" id="texto_descricao_individual_view" value="" class="form-control form-control-sm" readonly>     
                            </div>    
                                                    
                        </div> 
                        
                        <div class="ocultar dados_cancelados">
                            <div class="d-flex mb-2" style="flex-wrap: wrap;">
                                <div style="flex-basis:49%;">
                                    <span class="text-white" style="font-size:0.81em;">Motivo:</span>
                                    <input type="text" id="motivo_cancelamento" class="form-control  form-control-sm" readonly>
                                </div>
                                <div style="flex-basis:50%;margin-left:1%;">
                                    <span class="text-white" style="font-size:0.81em;">Data Cancelamento:</span>
                                    <input type="text" id="data_cancelamento" class="form-control  form-control-sm" readonly>
                                </div>
                                <div style="flex-basis:100%;">
                                    <span class="text-white" style="font-size:0.81em;">Observação Cancelamento:</span>
                                    <input type="text" id="observacao_cancelamento" class="form-control  form-control-sm" readonly>
                                </div>
                            </div>            
                        </div>
                        




                    </section>                    
                </div>    
                <!---------FIM DIREITA-------------->    
            </section>
       </main><!-------------------------------------DIV FIM Individial------------------------------------->     
       <!-------------------------------------FIM Individial------------------------------------->

       <!------------------------------------------COLETIVO---------------------------------------------------->
       <main id="aba_coletivo" class="ocultar">
             <section class="d-flex justify-content-between" style="flex-wrap: wrap;">
                <!--COLUNA DA ESQUERDA-->
                <div class="d-flex flex-column text-white ml-1" style="flex-basis:16%;border-radius:5px;">
                    <div class="d-flex flex-column">
                       <div class="text-white" style="flex-basis:10%;">
                            <!-- <button class="estilo_btn_plus_coletivo btn btn-success btn-block">Criar Contrato</button> -->
                            <a href="{{route('contratos.create.coletivo')}}" class="btn btn-block" style="background-color:#123449;color:#FFF;">Criar Contrato</a>
                        </div>
                        <select class="my-1 form-control" style="flex-basis:80%;" id="select_coletivo">
                            <option value="todos" class="text-center">---Administradora---</option>      
                        </select>
                        <select class="form-control" style="flex-basis:80%;" id="select_usuario">
                            <option value="todos" class="text-center">---Escolher Corretor---</option>
                        </select>
                    </div>
                    
                    <div style="margin:0 0 20px 0;padding:0;background-color:#123449;border-radius:5px;">
                        <div class="text-center py-1 d-flex justify-content-between border-bottom textoforte-list" id="all_pendentes_coletivo">
                            <span class="w-50 d-flex justify-content-start ml-2">Pendentes</span>
                            <span class="d-flex justify-content-end badge badge-light mr-1 coletivo_quantidade_pendentes" style="width:45px;text-align:right;">
                                {{$contratos_coletivo_pendentes}}
                            </span>
                        </div>
                        <ul style="margin:0;padding:0;list-style:none;" id="listar">
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="em_analise_coletivo" class="coletivo">
                                <span>Em Analise</span>
                                <span class="badge badge-light" style="width:45px;text-align:right;vertical-align: middle;">{{$qtd_coletivo_em_analise}}</span>                        
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="emissao_boleto_coletivo" class="coletivo">
                                <span>Emissão Boleto</span>
                                <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_coletivo_emissao_boleto}}</span>
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="pagamento_adesao_coletivo" class="coletivo">
                                <span>Pag. Adesão</span>
                                <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_coletivo_pg_adesao}}</span>
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="pagamento_vigencia_coletivo" class="coletivo">
                                <span>Pag. Vigência</span>
                                <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_coletivo_pg_vigencia}}</span>
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="pagamento_segunda_parcela" class="coletivo">
                                <span>Pag. 2º Parcela</span>
                                <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_coletivo_02_parcela}}</span>
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="pagamento_terceira_parcela" class="coletivo">
                                <span>Pag. 3º Parcela</span>
                                <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_coletivo_03_parcela}}</span>
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="pagamento_quarta_parcela" class="coletivo">
                                <span>Pag. 4º Parcela</span>
                                <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_coletivo_04_parcela}}</span>
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="pagamento_quinta_parcela" class="coletivo">
                                <span>Pag. 5º Parcela</span>
                                <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_coletivo_05_parcela}}</span>
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="pagamento_sexta_parcela" class="coletivo">
                                <span>Pag. 6º Parcela</span>
                                <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_coletivo_06_parcela}}</span>
                            </li>
                            
                        </ul>
                    </div>

                    <div style="margin:0 0 20px 0;padding:0;background-color:#123449;border-radius:5px;">
                        <ul style="list-style:none;margin:0;padding:10px 0;" id="grupo_coletivo_concluido">
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="finalizado_coletivo" class="coletivo">
                                <span>Finalizado</span>
                                <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_coletivo_finalizados}}</span>
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="cancelado_coletivo" class="coletivo">
                                <span>Cancelados</span>
                                <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_coletivo_cancelados}}</span>
                            </li>   
                        </ul>
                    </div>





                </div>    
                <!--FIM COLUNA DA ESQUERDA-->


                <!--COLUNA DA CENTRAL-->
                <div style="flex-basis:53%;">
                    <div class="p-2" style="background-color:#123449;color:#FFF;border-radius:5px;">
                        <table id="tabela_coletivo" class="table display table-sm listardados">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Corretor</th>
                                    <th>Administradora</th>
                                    <th>Cliente</th>
                                    <th>Vencimento</th>
                                    <th>Status</th>
                                    <th>Ver</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>   
                    </div> 
                </div>  
                <!--FIM COLUNA DA CENTRAL-->


                <!--COLUNA DA DIREITA-->    
                <div class="mr-1 coluna-right aba_coletivo">
                    <section class="p-1" style="background-color:#123449;">
                        
                        <div class="d-flex mb-2">
                                
                            <div style="flex-basis:25%;">
                                <span class="text-white" style="font-size:0.81em;">Administradora:</span>
                                <input type="text" id="administradora_coletivo_view" class="form-control  form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:33%;margin:0 1%;">    
                                <span class="text-white" style="font-size:0.81em;">Tipo Plano:</span>
                                <input type="text" id="tipo_plano_coletivo_view" class="form-control  form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:40%;" id="status">
                                <span class="text-white" style="font-size:0.81em;">Status:</span>
                                <input type="text" id="estagio_contrato_coletivo_view" class="form-control form-control-sm" readonly>
                            </div>  

                        </div>

                        <div class="d-flex mb-2">
                            
                            <div style="flex-basis:40%;">
                                <span class="text-white" style="font-size:0.81em;">Cliente:</span>
                                <input type="text" id="cliente_coletivo_view" class="form-control form-control-sm" readonly>
                            </div>
                            
                            <div style="flex-basis:28%;margin:0 1%;">
                                <span class="text-white" style="font-size:0.81em;">Data Nascimento:</span>
                                <input type="text" id="data_nascimento_coletivo_view" class="form-control form-control-sm" readonly>
                            </div>
                            
                            <div style="flex-basis:30%;">
                                <span class="text-white" style="font-size:0.81em;">Codigo Externo:</span>
                                <input type="text" id="codigo_externo_coletivo_view" class="form-control  form-control-sm" readonly>
                            </div>    

                        </div>

                        <div class="d-flex mb-2">

                            <div style="flex-basis:28%;">
                                <span class="text-white" style="font-size:0.81em;">CPF:</span>
                                <input type="text" id="cpf_coletivo_view" class="form-control form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:38%;margin:0 1%;">
                                <span class="text-white" style="font-size:0.81em;">Responsavel Financeiro:</span>
                                <input type="text" id="responsavel_financeiro_coletivo" class="form-control  form-control-sm" readonly>
                            </div>
                            
                            <div style="flex-basis:32%;">
                                <span class="text-white" style="font-size:0.81em;">CPF Financeiro:</span>
                                <input type="text" id="cpf_financeiro_coletivo_view" class="form-control  form-control-sm" readonly>
                            </div>    

                        </div>

                        <div class="d-flex mb-2">
                            
                            <div style="flex-basis:28%;margin-right:1%;">
                                <span class="text-white" style="font-size:0.81em;">Celular:</span>
                                <input type="text" id="celular_coletivo_view" class="form-control form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:26%;margin-right:1%;">
                                <span class="text-white" style="font-size:0.81em;">Telefone:</span>
                                <input type="text" id="telefone_coletivo_view" class="form-control form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:46%;">
                                <span class="text-white" style="font-size:0.81em;">Email:</span>
                                <input type="text" id="email_coletivo_view" class="form-control form-control-sm" readonly>
                            </div>

                        </div>


                        <div class="d-flex mb-2">

                            <div style="flex-basis:22%;">
                                <span class="text-white" style="font-size:0.81em;">CEP:</span>
                                <input type="text" id="cep_coletivo_view" class="form-control form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:78%;margin:0 1%;">
                                <span class="text-white" style="font-size:0.81em;">Cidade:</span> 
                                <input type="text" id="cidade_coletivo_view" class="form-control  form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:10%;">
                                <span class="text-white" style="font-size:0.81em;">UF:</span>
                                <input type="text" id="uf_coletivo_view" class="form-control form-control-sm" readonly>
                            </div>

                        </div> 


                        <div class="d-flex mb-2">
                            
                              <div style="flex-basis:30%;">
                                <span class="text-white" style="font-size:0.81em;">Bairro:</span>
                                <input type="text" name="bairro_coletivo" id="bairro_coletivo_view" class="form-control form-control-sm" readonly>
                            </div>    
                    
                            <div style="flex-basis:30%;margin:0 1%;">
                                <span class="text-white" style="font-size:0.81em;">Rua:</span>
                                <input type="text" name="rua_coletivo" id="rua_coletivo_view" class="form-control form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:40%;">
                                <span class="text-white" style="font-size:0.81em;">Complemento:</span>
                                <input type="text" id="complemento_coletivo_view" class="form-control form-control-sm" readonly>
                            </div>

                        </div>

                    
                        <div class="d-flex mb-2">

                            <div style="flex-basis:31%;">
                                <span class="text-white" style="font-size:0.81em;">Data Contrato:</span>
                                <input type="text" name="data_contrato_coletivo" id="data_contrato_coletivo_view" class="form-control form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:31%;margin:0 1%;">
                                <span class="text-white" style="font-size:0.81em;">Valor Contrato:</span>
                                <input type="text" name="valor_contrato_coletivo" id="valor_contrato_coletivo_view" class="form-control  form-control-sm" readonly>
                            </div>

                             

                            <div style="flex-basis:31%;margin-right:1%;">
                                <span class="text-white" style="font-size:0.81em;">Valor Adesão:</span>
                                <input type="text" id="valor_adesao_coletivo_view" class="form-control  form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:7%">    
                                <span class="text-white" style="font-size:0.81em;">Vidas</span>
                                <input type="text" name="quantidade_vidas" id="quantidade_vidas_coletivo_cadastrar" class="form-control  form-control-sm" readonly>
                            </div>
                    
                        </div>


                         <div class="d-flex mb-2">

                            <div style="flex-basis:23%;">
                                <span class="text-white" style="font-size:0.81em;">Data Boleto:</span>
                                <input type="text" id="data_boleto_coletivo_view" class="form-control  form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:23%;margin:0 1%;">
                                <span class="text-white" style="font-size:0.81em;">Data Vigência:</span>
                                <input type="text" name="data_vigencia_coletivo" id="data_vigencia_coletivo_view" class="form-control  form-control-sm" readonly>
                            </div>
                            
                            <div style="flex-basis:54%;">
                                <span class="text-white" style="font-size:0.81em;">Plano Contratado:</span>
                                <input type="text" id="texto_descricao_coletivo_view" value="" class="form-control form-control-sm" readonly> 
                            </div>    
 
                            
                        </div>
                        
                        <div class="d-flex mb-2">  
                            <div style="flex-basis:33%;">
                                <span class="text-white" style="font-size:0.81em;">Desconto:</span>
                                <input type="text" id="desconto_coletivo" value="" class="form-control form-control-sm" readonly>
                            </div>    
                            <div style="flex-basis:32%;margin:0 1%;">
                                <span class="text-white" style="font-size:0.81em;">Desconto Corretora:</span>
                                <input type="text" id="desconto_corretora_coletivo" value="" class="form-control form-control-sm" readonly>
                            </div>
                            <div style="flex-basis:33%;">
                                <span class="text-white" style="font-size:0.81em;">Desconto Corretor:</span>
                                <input type="text" id="desconto_corretor_coletivo" value="" class="form-control form-control-sm" readonly>
                            </div>
                        </div>   



                    </section>    
                </div>

            </section>

       </main>

       <main id="aba_empresarial" class="ocultar">
           
            <section class="d-flex justify-content-between" style="flex-wrap: wrap;">

                <!--COLUNA DA ESQUERDA-->
                <div class="d-flex flex-column text-white ml-1" style="flex-basis:16%;border-radius:5px;">                    
                    

                    <div class="d-flex">
                        <!-- <button class="btn btn-success btn-block mb-2 estilo_btn_plus_ss">Criar Contrato</button> -->
                        <a href="{{route('contratos.create.empresarial')}}" class="btn btn-block" style="background-color:#123449;">
                            <span style="color:#FFF;">Criar Contrato</span>
                            
                        </a>

                    </div>


                    <select name="mudar_user_empresarial" id="mudar_user_empresarial" class="form-control my-1">
                        <option>----Escolher o Corretor----</option>    
                    </select>


                    <div style="margin:0 0 20px 0;padding:0;background-color:#123449;border-radius:5px;">
                        

                        <div class="text-center py-1 d-flex justify-content-between border-bottom textoforte-list" id="all_pendentes_empresarial">
                            <span class="w-50 d-flex justify-content-start ml-2">
                                Pendentes
                            </span>
                            <span class="d-flex justify-content-end badge badge-light mr-1 individual_quantidade_empresarial" style="width:45px;text-align:right;">
                                {{$qtd_empresarial_pendentes}}
                            </span>
                        </div>

                        



                        <ul style="margin:0;padding:0;list-style:none;" id="listar_empresarial">
                            
                           <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_em_analise_empresarial"  class="empresarial">
                                <span>Em Análise</span>
                               <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_empresarial_em_analise}}</span>                        
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_pagamento_1_parcela_empresarial" class="empresarial">
                                <span>Pag. 1º Parcela</span>
                               <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_empresarial_parcela_01}}</span>                        
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_pagamento_2_parcela_empresarial" class="empresarial">
                               <span>Pag. 2º Parcela</span>
                               <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_empresarial_parcela_02}}</span>                        
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_pagamento_3_parcela_empresarial" class="empresarial">
                               <span>Pag. 3º Parcela</span>
                               <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_empresarial_parcela_03}}</span>                        
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_pagamento_4_parcela_empresarial" class="empresarial">
                               <span>Pag. 4º Parcela</span>
                               <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_empresarial_parcela_04}}</span>                        
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_pagamento_5_parcela_empresarial" class="empresarial">
                               <span>Pag. 5º Parcela</span>
                               <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_empresarial_parcela_05}}</span>                        
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_pagamento_6_parcela_empresarial" class="empresarial">
                               <span>Pag. 6º Parcela</span>
                               <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_empresarial_parcela_06}}</span>                        
                            </li>
                            
                        </ul>
                    </div>


                    <div style="margin:0 0 20px 0;padding:0;background-color:#123449;border-radius:5px;">

                        <ul style="list-style:none;margin:0;padding:10px 0;" id="grupo_empresarial_concluido">
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_finalizado_empresarial" class="empresarial">
                                <span>Finalizado</span>
                                <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_empresarial_finalizado}}</span>                        
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_cancelado_empresarial" class="empresarial">
                                <span>Cancelado</span>
                                <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_empresarial_cancelado}}</span>                        
                            </li>
                        </ul>

                    </div>
                    
                    


                </div>
                <!--Fim Coluna da Esquerda  -->

                <!--COLUNA DA CENTRAL-->
                <div style="flex-basis:53%;">
                    <div class="p-2" style="background-color:#123449;color:#FFF;border-radius:5px;">
                        <table id="tabela_empresarial" class="table display table-sm listarempresarial">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Corretor</th>
                                    <th>Cliente</th>
                                    <th>Plano</th>
                                    <th>Valor</th>
                                    <th>Vencimento</th>
                                    <th>Ver</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>   
                    </div> 
                </div>  
                <!--FIM COLUNA DA CENTRAL-->

                <!---Coluna Direita--->
                <div class="mr-1 coluna-right aba_empresarial">
                    <section class="p-1" style="background-color:#123449;">

                        <div class="d-flex mb-2">
                            
                            <div style="flex-basis:33%;">
                                <span class="text-white" style="font-size:0.81em;">Vendedor:</span>
                                <input type="text" id="vendedor_view_empresarial" class="form-control form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:33%;margin:0 1%;">
                                <span class="text-white" style="font-size:0.81em;">Plano:</span> 
                                <input type="text" name="plano_view_empresarial" id="plano_view_empresarial" class="form-control  form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:33%;">
                                <span class="text-white" style="font-size:0.81em;">Tabela Origem:</span> 
                                <input type="text" name="tabela_origem_view_empresarial" id="tabela_origem_view_empresarial" class="form-control  form-control-sm" readonly>
                            </div>

                        </div>

                        
                        <div class="d-flex mb-2">
                            
                            
                            <div style="flex-basis:57%;">
                                <span class="text-white" style="font-size:0.81em;">Razão Social:</span>
                                <input type="text" id="razao_social_view_empresarial" class="form-control form-control-sm" readonly>
                            </div>
                                  
                            <div style="flex-basis:33%;margin:0 1%;">
                                <span class="text-white" style="font-size:0.81em;">CNPJ:</span>
                                <input type="text" id="cnpj_view" class="form-control form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:8%;">
                                <span class="text-white" style="font-size:0.81em;">Vidas:</span>
                                <input type="text" id="qtd_vidas" class="form-control form-control-sm" readonly>
                            </div>
                   
                        </div>

                        <div class="d-flex mb-2">
                            <div style="flex-basis:30%;">
                                <span class="text-white" style="font-size:0.81em;">Telefone:</span>
                                <input type="text" id="telefone_corretor_view_empresarial" class="form-control form-control-sm" readonly>
                            </div>    

                            <div style="flex-basis:30%;margin:0 1%;">
                                <span class="text-white" style="font-size:0.81em;">Celular:</span>
                                <input type="text" id="celular_corretor_view_empresarial" class="form-control form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:40%;">
                                <span class="text-white" style="font-size:0.81em;">Email:</span>
                                <input type="text" id="email_odonto_view_empresarial" class="form-control form-control-sm" readonly>
                            </div>
                            
                        </div>


                         <div class="d-flex mb-2">

                            <div style="flex-basis:30%;margin-right:1%;">
                                <span class="text-white" style="font-size:0.81em;">Responsavel:</span>
                                <input type="text" id="nome_corretor_view_empresarial" class="form-control form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:10%;margin-right:1%;">
                                <span class="text-white" style="font-size:0.81em;">UF:</span>
                                <input type="text" id="uf_cliente_view_empresarial" class="form-control form-control-sm" readonly>
                            </div> 

                            <div style="flex-basis:24%;margin-right:1%;">
                                <span class="text-white" style="font-size:0.81em;">Cidade:</span>
                                <input type="text" id="cidade_saude_view_empresarial" class="form-control form-control-sm" readonly>
                            </div>
                                                    
                            <div style="flex-basis:38%;">
                                <span class="text-white" style="font-size:0.81em;">Plano Contratado:</span>
                                <input type="text" id="plano_contratado_corretor_view_empresarial" class="form-control form-control-sm" readonly>
                            </div>

                        </div>              

                        <div class="d-flex mb-2">

                            <div style="flex-basis:24%;">
                                <span class="text-white" style="font-size:0.81em;">Cód.Corretora:</span>
                                <input type="text" id="cod_corretora_view_empresarial" class="form-control form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:24%;margin:0 1%;">
                                <span class="text-white" style="font-size:0.81em;">Codigo Saude:</span>
                                <input type="text" id="cod_saude_view_empresarial" class="form-control form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:24%;margin-right: 1%;">
                                <span class="text-white" style="font-size:0.81em;">Codigo Odonto:</span>
                                <input type="text" id="cod_odonto_view_empresarial" class="form-control form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:25%;">
                                <span class="text-white" style="font-size:0.81em;">Senha Cliente:</span>
                                <input type="text" id="senha_cliente_view_empresarial" class="form-control form-control-sm" readonly>
                            </div>

                        </div>                    

                        <div class="d-flex mb-2">

                            <div style="flex-basis:25%;margin-right:1%;">
                                <span class="text-white" style="font-size:0.81em;">Valor Saude:</span>
                                <input type="text" id="valor_plano_saude_view" class="form-control form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:25%;margin-right:1%;">
                                <span class="text-white" style="font-size:0.81em;">Valor Odonto:</span>
                                <input type="text" id="valor_plano_odonto_view" class="form-control form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:25%;margin-right:1%;">
                                <span class="text-white" style="font-size:0.81em;">Total Plano:</span>
                                <input type="text" id="valor_plano_view_empresarial" class="form-control form-control-sm" readonly>
                            
                            </div>

                            <div style="flex-basis:25%;">
                                <span class="text-white" style="font-size:0.81em;">Taxa Adesão:</span>
                                <input type="text" id="taxa_adesao_view_empresarial" class="form-control form-control-sm" readonly>
                            </div>

                        </div>


                        <div class="d-flex mb-1">
                            
                            <div style="flex-basis:24%;margin-right:1%;">
                                <span class="text-white" style="font-size:0.81em;">Plano c/Adesão:</span>
                                <input type="text" id="plano_adesao_view_empresarial" class="form-control form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:24%;">
                                <span class="text-white" style="font-size:0.81em;">Valor Boleto:</span>
                                <input type="text" id="valor_boleto_view_empresarial" class="form-control form-control-sm" value="" readonly>
                            </div>

                            <div style="flex-basis:25%;margin:0 1%;">
                                <span class="text-white" style="font-size:0.81em;">Venc. Boleto:</span>
                                <input type="text" id="vencimento_boleto_view_empresarial" class="form-control form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:25%;">
                                <span class="text-white" style="font-size:0.9em;">Data 1º Boleto:</span>
                                <input type="text" id="data_boleto_view_empresarial" class="form-control form-control-sm" readonly>
                            </div>                      

                        </div>
                        
                </div>
                <!---------FIM DIREITA----------->
           </section>    

       </main>
    </section>
   
@stop  

@section('js')
    <script src="{{asset('js/jquery.mask.min.js')}}"></script>   
   
    <script>
        $(document).ready(function(){      

            var default_formulario = $('.coluna-right.aba_individual').html();

            mudar_user_empresarial = "";

            $("#mudar_user_empresarial").on('change',function(){
                mudar_user_empresarial = $(this).val();
                if($(this).val() != "todos") {
                    table_empresarial.column(1).search($(this).val()).draw();
                } else {
                    var val = "";
                    table_empresarial.column(1).search(val).draw();
                    table_empresarial.column(1).search(val ? '^' + val + '$' : '', true, false).draw();
                }
            });



            
            usuario_individual = "";
            $("#select_usuario_individual").on('change',function(){
                usuario_individual = $(this).val();    
                if($(this).val() != "todos") {
                    taindividual.column(1).search($(this).val()).draw();
                } else {
                    var val = "";
                    taindividual.column(1).search(val).draw();
                    taindividual.column(1).search(val ? '^' + val + '$' : '', true, false).draw();
                }
            });
            
            
            
            administradora_selecionado = "";
            $("#select_coletivo").on('change',function(){
                administradora_selecionado = $(this).val();  
                if($(this).val() != "todos") {
                    teste.column(2).search($(this).val()).draw();
                } else {
                    var val = "";
                    teste.column(2).search(val).draw();
                    teste.column(2).search(val ? '^' + val + '$' : '', true, false).draw();
                }
            });
            
            usuario_selecionado = "";
            $("#select_usuario").on('change',function(){
                usuario_selecionado = $(this).val();    
                if($(this).val() != "todos") {
                    teste.column(1).search($(this).val()).draw();
                } else {
                    var val = "";
                    teste.column(1).search(val).draw();
                    teste.column(1).search(val ? '^' + val + '$' : '', true, false).draw();
                }
                return false;
            });


            let url = window.location.href.indexOf("?");
            if(url != -1) {
                var b =  window.location.href.substring(url);
                var alvo = b.split("=")[1];
                if(alvo == "coletivo") {
                    $('.list_abas li').removeClass('ativo');
                    $('.list_abas li:nth-child(2)').addClass("ativo");
                    $('.conteudo_abas main').addClass('ocultar');
                    $('#aba_coletivo').removeClass('ocultar');
                    var c = window.location.href.replace(b,"");
                    window.history.pushState({path:c},'',c);
                } 
                if(alvo == "empresarial") {
                    $('.list_abas li').removeClass('ativo');
                    $('.list_abas li:nth-child(3)').addClass("ativo");
                    $('.conteudo_abas main').addClass('ocultar');
                    $('#aba_empresarial').removeClass('ocultar');
                    var c = window.location.href.replace(b,"");
                    window.history.pushState({path:c},'',c);  
                }
            }

            String.prototype.ucWords = function () {
                let str = this.toLowerCase()
                let re = /(^([a-zA-Z\p{M}]))|([ -][a-zA-Z\p{M}])/g
                return str.replace(re, s => s.toUpperCase())
            }

            $('#cadastrarIndividualModal').on('hidden.bs.modal', function (event) {
                $('#cadastrar_pessoa_fisica_formulario_individual').each(function(){
                    this.reset();
                });
            })

            $('#cadastrarContratoModal').on('hidden.bs.modal', function (event) {
                $('#cadastrar_pessoa_fisica_formulario_modal_coletivo').each(function(){
                    this.reset();
                });
            });

            $("#cadastrarEmpresarial").on('hidden.bs.modal', function (event) {
                $('#cadastrar_dados_empresarial').each(function(){
                    this.reset();
                });
            });

            $("body").on('change','#dependente_individual',function(){
                if($(this).is(':checked')) {
                    $("#container_responsavel").removeClass('d-none');
                } else {
                    $("#container_responsavel").addClass('d-none');
                }
            });
            
            $("body").on('change','#dependente_coletivo',function(){
               if($(this).is(':checked')) {
                    $("#container_responsavel_coletivo").removeClass('d-none');
                } else {
                    $("#container_responsavel_coletivo").addClass('d-none');
                } 
            });

            $("#all_pendentes_individual").on('click',function(){
                $('#title_individual').html("<h4 style='font-size:1em;margin-top:10px;'>Pendentes</h4>");
                table_individual.ajax.url("{{ route('financeiro.individual.geralIndividualPendentes.contrato') }}").load();
                $("ul#listar_individual li.individual").removeClass('textoforte-list');                
                $("#grupo_individual_concluido li.individual").removeClass('textoforte-list');
                $(this).addClass('textoforte-list');
            });

            $("#all_pendentes_coletivo").on('click',function(){
                $('#title_coletivo_por_adesao_table').html("<h4 style='font-size:1em;margin-top:10px;'>Pendentes</h4>");
                table.ajax.url("{{ route('financeiro.individual.geralColetivoPendentes.contrato') }}").load();
                $("ul#listar li.coletivo").removeClass('textoforte-list');
                $("#grupo_coletivo_concluido li.individual").removeClass('textoforte-list');
                $(this).addClass('textoforte-list');
            });

            

            $("#all_pendentes_empresarial").on('click',function(){
                $("#title_empresarial").html("<h4 style='font-size:1em;margin-top:10px;'>Pendentes</h4>");
                tableempresarial.ajax.url('{{ route("contratos.listarEmpresarial.listarContratoEmpresaPendentes") }}').load();
                $("ul#listar_empresarial li.empresarial").removeClass('textoforte-list');
                $("ul#grupo_empresarial_concluido li.empresarial").removeClass('textoforte-list');
                $(this).addClass('textoforte-list');
            });

            

            $('#cnpj').mask('00.000.000/0000-00');
            $('#telefone_individual').mask('0000-0000');
            $('#celular_individual').mask('(00) 0 0000-0000');
            $('#celular').mask('(00) 0 0000-0000');
            $('#taxa_adesao').mask("#.##0,00", {reverse: true});
            $('#valor_plano').mask("#.##0,00", {reverse: true});
            $('#valor_total').mask("#.##0,00", {reverse: true});
            $('#valor_boleto').mask("#.##0,00", {reverse: true});
            $('#valor_plano_saude').mask("#.##0,00", {reverse: true});
            $('#valor_plano_saude').mask("#.##0,00", {reverse: true});
            $('#valor_plano_odonto').mask("#.##0,00", {reverse: true});
            $('#cpf_individual').mask('000.000.000-00');
            $('#cpf_financeiro_individual_cadastro').mask('000.000.000-00');            
            $('#cpf_coletivo').mask('000.000.000-00');  
            $('#cep_individual').mask('00000-000');          
            $('#cep_coletivo').mask('00000-000');          
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });   

            const taindividual = $(".listarindividual").DataTable({
                dom: '<"d-flex justify-content-between"<"#title_individual"><"estilizar_search"f>><t><"d-flex justify-content-between align-items-center"<"por_pagina"l><"estilizar_pagination"p>>',
                "language": {
                    "url": "{{asset('traducao/pt-BR.json')}}"
                },
                ajax: {
                    "url":"{{ route('financeiro.individual.geralIndividualPendentes') }}",
                    "dataSrc": ""
                },
                "lengthMenu": [50,100,150,200,300,500],
                "ordering": false,
                "paging": true,
                "searching": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                columns: [
                    {data:"created_at",name:"data",},
                    {data:"clientes.user.name",name:"corretor"},
                    {data:"clientes.nome",name:"cliente"},
                    {data:"comissao.comissao_atual_financeiro",name:"vencimento",
                        "createdCell": function(td,cellData,rowData,row,col) {
                            if(cellData == null) {
                                if(rowData.financeiro.id == 10) {                                    
                                    let alvo = rowData.comissao.comissao_atual_last.data.split("-").reverse().join("/");
                                    $(td).html(alvo);    
                                } else if(rowData.financeiro.id == 11) {
                                    $(td).html("Finalizado");
                                } else {
                                    $(td).html("Cancelado");    
                                }

                            } else {
                                let alvo = cellData.data.split("-").reverse().join("/");
                                $(td).html(alvo);
                            }
                        }
                    },                          
                    {data:"financeiro.nome",name:"financeiro"},
                    {data:"financeiro.nome",name:"detalhes"}
                ],
                "columnDefs": [
                    {
                        /** Data*/
                        "targets": 0,
                        "createdCell": function (td, cellData, rowData, row, col) {
                            let datas = cellData.split("T")[0]
                            let alvo = datas.split("-").reverse().join("/")
                            $(td).html(alvo)    
                        },
                        "width":"8%"
                    },
                    {
                        "targets": 1,
                        "width":"20%",
                        "createdCell": function (td, cellData, rowData, row, col) {
                            let palavra = cellData.split(" ");
                            if(palavra.length >= 3) {
                                $(td).html(palavra[0]+" "+palavra[1]+"...")
                            }
                        }
                    },
                    {
                        "targets": 2,
                        "width":"35%",
                        "createdCell":function(td,cellData,rowData,row,col) {
                            //let palavra = capitalizeFirstLetter(cellData);
                            let palavra = cellData.ucWords();
                            if(palavra.split(" ").length >= 3) {
                                let strings = palavra.split(" ");
                                $(td).html(strings[0]+" "+strings[1]+" "+strings[2]+"...")
                                
                            } else {
                                $(td).html(palavra)
                            }
                            //
                        }
                    },
                    {
                        "targets": 3,
                        "width":"8%",
                        "createdCell": function (td, cellData, rowData, row, col) {   
                            let alvo = cellData.split("-").reverse().join("/");
                            $(td).html(alvo);
                        }       
                    },
                    {
                        "targets": 4,
                        "width":"20%",
                        "createdCell": function (td, cellData, rowData, row, col) {
                            if(cellData == "Pagamento 1º Parcela") {
                                $(td).html("Pag. 1º Parcela");        
                            }
                            if(cellData == "Pagamento 2º Parcela") {
                                $(td).html("Pag. 2º Parcela");        
                            }
                            if(cellData == "Pagamento 3º Parcela") {
                                $(td).html("Pag. 3º Parcela");        
                            }
                            if(cellData == "Pagamento 4º Parcela") {
                                $(td).html("Pag. 4º Parcela");        
                            }
                            if(cellData == "Pagamento 5º Parcela") {
                                $(td).html("Pag. 5º Parcela");        
                            }
                            if(cellData == "Pagamento 6º Parcela") {
                                $(td).html("Pag. 6º Parcela");        
                            }
                        },
                    },
                    {
                        "targets": 5,
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).html("<div class='text-center'><i class='fas fa-eye div_info' data-id='"+rowData.id+"'></i></div>");
                        }
                    }
               ],
                
                "initComplete": function( settings, json ) {
                    $('#title_individual').html("<h4 style='font-size:1em;margin-top:10px;'>Pendentes</h4>");
                },
                "drawCallback":function(settings) {
                    
                    if(settings.sTableId == "tabela_individual") {
                        $("#select_usuario_individual").html('<option value="todos" class="text-center">---Escolher Corretor---</option>');
                        var selectUsuarioIndividual = $("#select_usuario_individual");
                        this.api()
                        .columns([1])
                        .every(function () {
                            var column = this;
                            column.data().unique().sort().each(function (d, j) {
                                if(usuario_individual == "todos" || usuario_individual == "") {
                                    selectUsuarioIndividual.append(`<option value="${d}">${d}</option>`);
                                } else {
                                    selectUsuarioIndividual.append(`<option  ${d == usuario_individual ? 'selected' : ''}  value="${d}">${d}</option>`);
                                }                          
                            })
                        })
                    }
                }
            });
            
            const teste = $(".listardados").DataTable({
                dom: '<"d-flex justify-content-between"<"#title_coletivo_por_adesao_table"><"estilizar_search"f>><t><"d-flex justify-content-between align-items-center"<"por_pagina"l><"estilizar_pagination"p>>',
                "language": {
                    "url": "{{asset('traducao/pt-BR.json')}}"
                },
                ajax: {
                    "url":"{{ route('financeiro.individual.geralColetivoPendentes.contrato') }}",
                    "dataSrc": ""
                },
                "lengthMenu": [50,100,150,200,300,500],
                "ordering": false,
                "paging": true,
                "searching": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                columns: [
                    {data:"created_at",name:"data"},
                    {data:"clientes.user.name",name:"corretor"},
                    {data:"administradora.nome",name:"administradora"},
                    {data:"clientes.nome",name:"cliente"},
                    {data:"comissao.comissao_atual_financeiro",name:"Vencimento",
                        "createdCell": function(td,cellData,rowData,row,col) {
                            if(cellData == null) {
                                if(rowData.financeiro.id == 10) {                                    
                                    let alvo = rowData.comissao.comissao_atual_last.data.split("-").reverse().join("/");
                                    $(td).html(alvo);    
                                } else if(rowData.financeiro.id == 11) {
                                    $(td).html("Finalizado");
                                } else {
                                    $(td).html("Cancelado");    
                                }
                            } else {
                                let alvo = cellData.data.split("-").reverse().join("/");
                                $(td).html(alvo);
                            }
                        },
                    },
                    {data:"financeiro.nome",name:"administradora"},
                    {data:"financeiro.nome",name:"ver"}
                ],
                "columnDefs": [
                    {
                        "width":"8%",
                        "targets": 0,
                        "createdCell": function (td, cellData, rowData, row, col) {
                            let datas = cellData.split("T")[0]
                            let alvo = datas.split("-").reverse().join("/")
                            $(td).html(alvo)    
                        }
                    },
                    {
                        "targets": 1,
                        "width":"25%",
                        "createdCell": function (td, cellData, rowData, row, col) {
                            let palavra = cellData.split(" ");
                            if(palavra.length >= 3) {
                                $(td).html(palavra[0]+" "+palavra[1]+"...")
                            }
                        }
                    },
                    {
                        "targets": 2,
                        "width":"10%"
                    },
                    {
                        "targets": 3,
                        "width":"25%"
                    },
                    {
                        "width":"8%",
                        "targets": 4,        
                        "createdCell": function (td, cellData, rowData, row, col) {
                            if(cellData) {
                                let alvo = cellData.split("-").reverse().join("/");
                                $(td).html(alvo);        
                            }
                            
                        },
                    },
                    {
                        "targets": 5,
                        "width":"20%",
                        "createdCell": function (td, cellData, rowData, row, col) {
                            if(cellData == "Pagamento Adesão") {
                                $(td).html("Pag. Adesão");        
                            }
                            if(cellData == "Pagamento Vigência") {
                                $(td).html("Pag. Vigência");        
                            }
                            if(cellData == "Pagamento 2º Parcela") {
                                $(td).html("Pag. 2º Parcela");        
                            }
                            if(cellData == "Pagamento 3º Parcela") {
                                $(td).html("Pag. 3º Parcela");        
                            }
                            if(cellData == "Pagamento 4º Parcela") {
                                $(td).html("Pag. 4º Parcela");        
                            }
                            if(cellData == "Pagamento 5º Parcela") {
                                $(td).html("Pag. 5º Parcela");        
                            }
                            if(cellData == "Pagamento 6º Parcela") {
                                $(td).html("Pag. 6º Parcela");        
                            }
                        },
                    },
                    {
                        "width":"4%",
                        "targets": 6,
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).html("<div class='text-center'><i class='fas fa-eye div_info' data-id='"+rowData.id+"'></i></div>");
                        }
                    }
               ],              
                "initComplete":function( settings, json ) {
                    $('#title_coletivo_por_adesao_table').html("<h4 style='font-size:1em;margin-top:10px;'>Pendentes</h4>");
                },
                "drawCallback":function(settings,json) {
                    if(settings.sTableId == "tabela_coletivo") {
                        $("#select_usuario").html('<option value="todos" class="text-center">---Escolher Corretor---</option>');
                        var selectUsuario = $("#select_usuario");
                        this.api()
                        .columns([1])
                        .every(function () {
                            var column = this;
                            column.data().unique().sort().each(function (d, j) {
                                if(usuario_selecionado == "todos" || usuario_selecionado == "") {
                                    selectUsuario.append(`<option value="${d}">${d}</option>`);
                                } else {
                                    selectUsuario.append(`<option  ${d == usuario_selecionado ? 'selected' : ''}  value="${d}">${d}</option>`);
                                }                          
                            })
                        })
                        $("#select_coletivo").html('<option value="todos" class="text-center">---Administradora---</option>')
                        this.api()
                       .columns([2])
                       .every(function () {
                            var column = this;
                            var selectAdministradora = $("#select_coletivo");
                            column.data().unique().sort().each(function (d, j) {
                                if(administradora_selecionado == "todos" || administradora_selecionado == "") {
                                    selectAdministradora.append(`<option value="${d}">${d}</option>`);
                                } else {
                                    selectAdministradora.append(`<option  ${d == administradora_selecionado ? 'selected' : ''}  value="${d}">${d}</option>`);
                                }
                            });
                        });
                    }                   
                }
            });

            var table = $('#tabela_coletivo').DataTable();
            $('#tabela_coletivo').on('click', 'tbody tr', function () {
                table.$('tr').removeClass('textoforte');
                $(this).closest('tr').addClass('textoforte');
                let data = table.row(this).data();
                let acomodacao_individual = data.acomodacao.nome;
                let coparticipacao_individual = data.coparticipacao;
                let odonto_individual = data.odonto;
                let texto = "";
                if(acomodacao_individual == "Apartamento" && coparticipacao_individual == 1 && odonto_individual == 1) {
                    texto = "Apartamento C/Copart + Odonto";
                } else if(acomodacao_individual == "Apartamento" && coparticipacao_individual == 1 && odonto_individual == 0) {
                    texto = "Apartamento C/Copart Sem Odonto";
                } else if(acomodacao_individual == "Apartamento" && coparticipacao_individual == 0 && odonto_individual == 0) {
                    texto = "Apartamento S/Copart Sem Odonto";
                } else if(acomodacao_individual == "Enfermaria" && coparticipacao_individual == 1 && odonto_individual == 1) {
                    texto = "Enfermaria C/Copart + Odonto";    
                } else if(acomodacao_individual == "Enfermaria" && coparticipacao_individual == 1 && odonto_individual == 0) {
                    texto = "Enfermaria C/Copart Sem Odonto";    
                } else if(acomodacao_individual == "Enfermaria" && coparticipacao_individual == 0 && odonto_individual == 0) {
                    texto = "Apartamento S/Copart Sem Odonto";    
                } else {
                    texto = "";
                }
                $("#texto_descricao_coletivo_view").val(texto);
                if(data.clientes.dependente) {
                    $("#responsavel_financeiro_coletivo").val(data.clientes.dependentes.nome);
                    $("#cpf_financeiro_coletivo_view").val(data.clientes.dependentes.cpf);
                } else {
                    $("#responsavel_financeiro_coletivo").val('');
                    $("#cpf_financeiro_coletivo_view").val('');
                }
                ///$('.div_info').attr('data-id',data.id);
                let criacao = data.created_at.split("T")[0].split("-").reverse().join("/");                
                let nascimento = data.clientes.data_nascimento.split("T")[0].split("-").reverse().join("/");
                let data_vigencia = data.data_vigencia.split("T")[0].split("-").reverse().join("/");
                let data_boleto = data.data_boleto.split("T")[0].split("-").reverse().join("/");
                let valor_contrato = Number(data.valor_plano).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});
                let valor_adesao = Number(data.valor_adesao).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});   
                $("#complemento_coletivo_view").val(data.clientes.complemento);
                $("#cliente_coletivo_view").val(data.clientes.nome);
                $("#cidade_coletivo_view").val(data.clientes.cidade);
                $("#estagio_contrato_coletivo_view").val(data.financeiro.nome);
                $("#telefone_coletivo_view").val(data.clientes.telefone);
                $("#celular_coletivo_view").val(data.clientes.celular);
                $("#email_coletivo_view").val(data.clientes.email);
                $("#data_nascimento_coletivo_view").val(nascimento);
                $("#cpf_coletivo_view").val(data.clientes.cpf);
                $("#cep_coletivo_view").val(data.clientes.cep);
                $("#bairro_coletivo_view").val(data.clientes.bairro)
                $("#rua_coletivo_view").val(data.clientes.rua);
                $("#uf_coletivo_view").val(data.clientes.uf);
                $("#administradora_coletivo_view").val(data.administradora.nome);
                $("#codigo_externo_coletivo_view").val(data.codigo_externo);              
                $("#data_contrato_coletivo_view").val(criacao);
                $("#valor_contrato_coletivo_view").val(valor_contrato);
                $("#data_vigencia_coletivo_view").val(data_vigencia);
                $("#data_boleto_coletivo_view").val(data_boleto);
                $("#valor_adesao_coletivo_view").val(valor_adesao);
                $("#coparticipacao_sim").attr("style","padding:0.21rem 0.75rem;");
                $("#coparticipacao_nao").attr("style","padding:0.21rem 0.75rem;");
                $("#odonto_sim").attr("style","padding:0.21rem 0.75rem;");
                $("#odonto_nao").attr("style","padding:0.21rem 0.75rem;");
                $("#desconto_corretora_coletivo").val(Number(data.desconto_corretora).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
                $("#desconto_corretor_coletivo").val(Number(data.desconto_corretor).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
                let desconto = data.valor_plano - data.valor_adesao;

                $("#desconto_coletivo").val(Number(desconto).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));    
                if(data.coparticipacao) {       
                    $("#coparticipacao_sim_coletivo").attr("style","padding:0.21rem 0.75rem;background-color:white;color:black;").attr("disabled",true);
                } else {
                    $("#coparticipacao_nao_coletivo").attr("style","padding:0.21rem 0.75rem;background-color:white;color:black;").attr("disabled",true);
                }
                if(data.odonto) {
                    $("#odonto_sim_coletivo").attr("style","padding:0.21rem 0.75rem;background-color:white;color:black;").attr("disabled",true);
                } else {
                    $("#odonto_nao_coletivo").attr("style","padding:0.21rem 0.75rem;background-color:white;color:black;").attr("disabled",true);
                }
                // $("#quantidade_vidas").val(vidas);
                $("#tipo_plano_coletivo_view").val(data.plano.nome);  
                $("#quantidade_vidas_coletivo_cadastrar").val(data.somar_cotacao_faixa_etaria[0].soma);                
                //comissoes_premiacoes(data.id,data.financeiro_id)
            });

            var table_individual = $('#tabela_individual').DataTable();
            $('#tabela_individual').on('click', 'tbody tr', function () {
                table_individual.$('tr').removeClass('textoforte');
                $(this).closest('tr').addClass('textoforte');
                let data = table_individual.row(this).data();   
                
                let acomodacao_individual = data.acomodacao.nome;
                let coparticipacao_individual = data.coparticipacao;
                let odonto_individual = data.odonto;
                let texto = "";

                if(acomodacao_individual == "Apartamento" && coparticipacao_individual == 1 && odonto_individual == 1) {
                    texto = "Apartamento C/Copart + Odonto";
                } else if(acomodacao_individual == "Apartamento" && coparticipacao_individual == 1 && odonto_individual == 0) {
                    texto = "Apartamento C/Copart Sem Odonto";
                } else if(acomodacao_individual == "Apartamento" && coparticipacao_individual == 0 && odonto_individual == 0) {
                    texto = "Apartamento S/Copart Sem Odonto";
                } else if(acomodacao_individual == "Enfermaria" && coparticipacao_individual == 1 && odonto_individual == 1) {
                    texto = "Enfermaria C/Copart + Odonto";    
                } else if(acomodacao_individual == "Enfermaria" && coparticipacao_individual == 1 && odonto_individual == 0) {
                    texto = "Enfermaria C/Copart Sem Odonto";    
                } else if(acomodacao_individual == "Enfermaria" && coparticipacao_individual == 0 && odonto_individual == 0) {
                    texto = "Apartamento S/Copart Sem Odonto";    
                } else {
                    texto = "";
                }
                $("#texto_descricao_individual_view").val(texto)

                if(data.clientes.dependente) {
                    $("#responsavel_financeiro").val(data.clientes.dependentes.nome);
                    $("#cpf_financeiro").val(data.clientes.dependentes.cpf);
                } else {
                    $("#responsavel_financeiro").val('');
                    $("#cpf_financeiro").val('');
                }

                if(data.comissao.cancelado) {
                    let data_cancelado = data.comissao.cancelado.data_baixa.split("-").reverse().join("/");
                    $("#observacao_cancelamento").val(data.comissao.cancelado.observacao);
                    $("#data_cancelamento").val(data_cancelado);
                    if(data.comissao.cancelado.motivo == 1) {
                        $("#motivo_cancelamento").val('Dados Incorretos');
                    } else if(data.comissao.cancelado.motivo == 2) {
                        $("#motivo_cancelamento").val('Cliente Desistiu do Plano');
                    } else if(data.comissao.cancelado.motivo == 3) {
                        $("#motivo_cancelamento").val('Cliente Trocou de Plano');
                    } else {
                        $("#motivo_cancelamento").val('Sem Espeficicação');
                    }
                } else {
                    $("#observacao_cancelamento").val('');
                    $("#data_cancelamento").val('');
                    $("#motivo_cancelamento").val('');
                }
                //$('.div_info').attr('data-id',data.id);
                $('.container_div_info').hide();
                let criacao = data.created_at.split("T")[0].split("-").reverse().join("/");                
                let nascimento = data.clientes.data_nascimento.split("T")[0].split("-").reverse().join("/");
                let data_vigencia = data.data_vigencia.split("T")[0].split("-").reverse().join("/");
                let data_boleto = data.data_boleto.split("T")[0].split("-").reverse().join("/");
                let valor_contrato = Number(data.valor_plano).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});
                let valor_adesao = Number(data.valor_adesao).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});       
                $("#cliente").val(data.clientes.nome);
                $("#cpf").val(data.clientes.cpf);
                $("#cidade").val(data.clientes.cidade);
                $("#status_individual_view").val(data.financeiro.nome);
                $("#telefone").val(data.clientes.celular);
                $("#email").val(data.clientes.email);
                $("#data_nascimento").val(nascimento);
                $("#cpf_coletivo").val(data.clientes.cpf);
                $("#cep_individual_cadastro").val(data.clientes.cep);
                $("#bairro_individual_cadastro").val(data.clientes.bairro)
                $("#rua_individual_cadastro").val(data.clientes.rua);
                $("#uf").val(data.clientes.uf);
                $("#administradora_individual").val(data.administradora.nome);
                $("#codigo_externo_individual").val(data.codigo_externo);              
                $("#data_contrato").val(criacao);
                $("#valor_contrato").val(valor_contrato);
                $("#data_vigencia").val(data_vigencia);
                $("#data_boleto").val(data_boleto);
                $("#valor_adesao").val(valor_adesao);
                $("#complemento_individual_cadastro").val(data.clientes.complemento);
                $("#celular_individual_view_input").val(data.clientes.celular);
                $("#telefone_individual_view_input").val(data.clientes.telefone);
                $("#coparticipacao_sim").attr("style","padding:0.21rem 0.75rem;");
                $("#coparticipacao_nao").attr("style","padding:0.21rem 0.75rem;");
                $("#odonto_sim").attr("style","padding:0.21rem 0.75rem;");
                $("#odonto_nao").attr("style","padding:0.21rem 0.75rem;");
                if(data.coparticipacao) {       
                    $("#coparticipacao_sim").attr("style","padding:0.21rem 0.75rem;background-color:white;color:black;").attr("disabled",true);
                } else {
                    $("#coparticipacao_nao").attr("style","padding:0.21rem 0.75rem;background-color:white;color:black;").attr("disabled",true);
                }
                if(data.odonto) {
                    $("#odonto_sim").attr("style","padding:0.21rem 0.75rem;background-color:white;color:black;").attr("disabled",true);
                } else {
                    $("#odonto_nao").attr("style","padding:0.21rem 0.75rem;background-color:white;color:black;").attr("disabled",true);
                }
                // $("#quantidade_vidas").val(vidas);
                $("#tipo_plano_individual").val(data.plano.nome); 
                $("#quantidade_vidas_individual_cadastrar").val(data.somar_cotacao_faixa_etaria[0].soma);                
            });
            

            const table_empresarial = $(".listarempresarial").DataTable({
                dom: '<"d-flex justify-content-between"<"#title_empresarial"><"estilizar_search"f>><t><"d-flex justify-content-between align-items-center"<"por_pagina"l><"estilizar_pagination"p>>',
                "language": {
                    "url": "{{asset('traducao/pt-BR.json')}}"
                },
                ajax: {
                    "url":"{{ route('contratos.listarEmpresarial.listarContratoEmpresaPendentes') }}",
                                     
                    "dataSrc": ""
                },
                "lengthMenu": [50,100,150,200,300,500],
                "ordering": false,
                "paging": true,
                "searching": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                columns: [
                    {data:"created_at",name:"created_at"},
                    {data:"usuario",name:"usuario"},
                    {data:"responsavel",name:"responsavel"},
                    {data:"plano",name:"plano"},
                    {data:"valor_plano",name:"valor_plano"},
                    {data:"comissao.comissao_atual_financeiro",name:"vencimento",
                        "createdCell": function(td,cellData,rowData,row,col) {
                            if(cellData == null) {
                                if(rowData.financeiro_id == 11) {
                                    $(td).html('Finalizado');
                                } else if(rowData.financeiro_id == 12) {
                                    $(td).html('Cancelado');
                                } else {
                                    let alvo = rowData.comissao.comissao_atual_last.data.split("-").reverse().join("/");
                                    $(td).html(alvo);    
                                }
                            } else {
                                let alvo = cellData.data.split("-").reverse().join("/");
                                $(td).html(alvo);
                            }
                        }
                    },
                    {data:"razao_social",name:"razao_social"},
                    
                ],
                "columnDefs": [
                    // <th>Data</th>
                    {
                        "targets": 0,
                        "width":"5%",
                        "createdCell":function(td,cellData,rowData,row,col) {
                            let datas = cellData.split("T")[0]
                            let alvo = datas.split("-").reverse().join("/")
                            $(td).html(alvo)    
                        }
                    },
                    // <th>Corretor</th>
                    {
                        "targets": 1,
                        "width":"25%"
                    },
                    // <th>Cliente</th>
                    {
                        "targets": 2,
                        "width":"25%"
                    },
                    // <th>Razão Social</th>
                    {
                        "targets": 3,
                        "width":"20%",
                        
                    },
                    // <th>Valor</th>
                    {
                        "targets": 4,
                        "width":"0%",
                        "createdCell": function (td, cellData, rowData, row, col) {
                            let formatado = Number(cellData).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});
                            // let datas = cellData.split("T")[0]
                            // let alvo = datas.split("-").reverse().join("/")
                            $(td).html(formatado);    
                        }
                        
                    },
                    // <th>Vencimento</th>
                    {
                        "targets": 5,
                        "createdCell": function (td, cellData, rowData, row, col) {
                            let alvo = cellData.split("-").reverse().join("/")
                            $(td).html(alvo);
                        }
                        
                    },
                    // <th>Ver</th> 
                    {
                        "targets": 6,
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).html("<div class='text-center'><i class='fas fa-eye div_info' data-id='"+rowData.id+"'></i></div>");
                        }
                    }
                ],                
                "initComplete": function( settings, json ) {
                    $('#title_empresarial').html("<h4>Empresarial</h4>");
                },
                "drawCallback":function(settings) {
                    if(settings.sTableId == "tabela_empresarial") {
                        $("#mudar_user_empresarial").html('<option value="todos" class="text-center">---Escolher Corretor---</option>');
                        var selectUsuarioEmpresarial = $("#mudar_user_empresarial");
                        this.api()
                        .columns([1])
                        .every(function () {
                            var column = this;
                            column.data().unique().sort().each(function (d, j) {
                                if(mudar_user_empresarial == "todos" || mudar_user_empresarial == "") {
                                    selectUsuarioEmpresarial.append(`<option value="${d}">${d}</option>`);
                                } else {
                                    selectUsuarioEmpresarial.append(`<option  ${d == mudar_user_empresarial ? 'selected' : ''}  value="${d}">${d}</option>`);
                                }                          
                            })
                        })
                    }
                }
            });


            var tableempresarial = $('#tabela_empresarial').DataTable();
            $('#tabela_empresarial').on('click', 'tbody tr', function () {
                tableempresarial.$('tr').removeClass('textoforte');
                $(this).closest('tr').addClass('textoforte');
                let data = tableempresarial.row(this).data();
                
                let valor_boleto = Number(data.valor_boleto).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});
                let valor_plano = Number(data.valor_plano).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});
                let valor_total = Number(data.valor_total).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});
                let taxa_adesao = Number(data.taxa_adesao).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});
                let valor_plano_saude = Number(data.valor_plano_saude).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});
                let valor_plano_odonto = Number(data.valor_plano_odonto).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});
                let vencimento_boleto = data.vencimento_boleto.split("-").reverse().join("/");
                let data_boleto = data.data_boleto.split("-").reverse().join("/");    
                $("#nome_corretor_view_empresarial").val(data.responsavel);
                $("#cidade_saude_view_empresarial").val(data.cidade);
                $("#email_odonto_view_empresarial").val(data.email);
                $("#uf_saude_view_empresarial").val(data.uf);
                $("#telefone_corretor_view_empresarial").val(data.telefone)
                $("#celular_corretor_view_empresarial").val(data.celular)
                let texto_empresarial = "";
                if(data.plano_contrado == 1) {
                    texto_empresarial = "C/ Copart + Odonto"
                } else if(data.plano_contrado == 2) {
                    texto_empresarial = "C/ Copart Sem Odonto"
                } else if(data.plano_contrado == 3) {
                    texto_empresarial = "Sem Copart + Odonto"
                    
                } else if(data.plano_contrado == 4){
                    texto_empresarial = "Sem Copart Sem Odonto"
                } else {
                    texto_empresarial = "";
                }

                //$('.div_info').attr('data-id',data.id);
                $("#plano_contratado_corretor_view_empresarial").val(texto_empresarial)
                $("#uf_cliente_view_empresarial").val(data.uf);
                $("#codigo_vendedor_empresarial_view").val(data.codigo_vendedor);
                $("#codigo_cliente_empresarial_view").val(data.codigo_cliente);
                $("#tabela_origem_view_empresarial").val(data.tabela_origem);
                $("#plano_view_empresarial").val(data.plano);
                $("#razao_social_view_empresarial").val(data.razao_social);
                $("#cnpj_view").val(data.cnpj);
                $("#qtd_vidas").val(data.quantidade_vidas);
                $("#valor_plano_view_empresarial").val(valor_plano);
                $("#valor_total_view_empresarial").val(valor_total);
                $("#taxa_adesao_view_empresarial").val(taxa_adesao);
                $("#vendedor_view_empresarial").val(data.usuario)
                $("#vencimento_boleto_view_empresarial").val(vencimento_boleto);
                $("#dia_vencimento_view_empresarial").val(data.dia_vencimento);
                $("#valor_plano_saude_view").val(valor_plano_saude);
                $("#valor_plano_odonto_view").val(valor_plano_odonto);               
                $("#cod_corretora_view_empresarial").val(data.codigo_corretora);
                $("#cod_saude_view_empresarial").val(data.codigo_saude);
                $("#cod_odonto_view_empresarial").val(data.codigo_odonto);
                $("#senha_cliente_view_empresarial").val(data.senha_cliente);
                $("#plano_adesao_view_empresarial").val(valor_total);
                $("#valor_boleto_view_empresarial").val(valor_boleto);
                $("#data_boleto_view_empresarial").val(data_boleto);
            });

            $("body").on('mouseover','.div_info',function(){
               let contrato = $(this).attr('data-id');
               let janela_ativa = $('#janela_ativa').val(); 
               $.ajax({
                    url:"{{route('contratos.info')}}",
                    data:"contrato="+contrato,
                    method:"POST",
                    success:function(res) {
                        $('.coluna-right.'+janela_ativa).html(res);
                        //$('.container_div_info').html(res);
                    }
                });
                $('.container_div_info').toggle();
                return false;
            });

            $("body").on('mouseout','.div_info',function(){
                let janela_ativa = $('#janela_ativa').val();
                $(".coluna-right."+janela_ativa).html(default_formulario);
            });

            // $(".div_info").on('click',function(){
            //     console.log("Olaaaaa");
            //     // let contrato = $(this).attr('data-id');
            //     // $.ajax({
            //     //     url:"{{route('contratos.info')}}",
            //     //     data:"contrato="+contrato,
            //     //     method:"POST",
            //     //     success:function(res) {
            //     //         $('.container_div_info').html(res);
            //     //     }
            //     // });
            //     // $('.container_div_info').toggle();
            //     return false;
            // });

            //  $("select[name='mudar_user_empresarial']").on('change',function(e){
            //     let user = $(this).val();
            //     $.ajax({
            //         url:"{{route('contratos.listarEmpresarialPorUser')}}",
            //         method:"POST",
            //         data:"user="+user,
            //         success:function(res) {
            //             tableempresarial.ajax.url(res).load();
            //         }
            //     });      
                
            // });

            $("ul#listar li.coletivo").on('click',function(){
                let id_lista = $(this).attr('id');
                
                if(id_lista == "em_analise_coletivo") {
                    $('#title_coletivo_por_adesao_table').html("<h4 style='font-size:1em;margin-top:10px;'>Em Análise</h4>");
                    table.ajax.url("{{ route('financeiro.coletivo.em_analise') }}").load();
                    $("ul#listar li.coletivo").removeClass('textoforte-list');
                    $("ul#grupo_coletivo_concluido li.coletivo").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list');
                    $("#all_pendentes_coletivo").removeClass('textoforte-list');
                    limparFormulario()
                } else if(id_lista == "emissao_boleto_coletivo") {
                    $('#title_coletivo_por_adesao_table').html("<h4 style='font-size:1em;margin-top:10px;'>Emissão Boleto</h4>");
                    table.ajax.url("{{ route('financeiro.coletivo.emissao_boleto') }}").load();
                    $("ul#listar li.coletivo").removeClass('textoforte-list');
                    $("ul#grupo_coletivo_concluido li.coletivo").removeClass('textoforte-list');
                    $("#all_pendentes_coletivo").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list');
                    limparFormulario()
                } else if(id_lista == "pagamento_adesao_coletivo") {
                    $('#title_coletivo_por_adesao_table').html("<h4 style='font-size:1em;margin-top:10px;'>Pagamento Adesão</h4>");
                    table.ajax.url("{{ route('financeiro.coletivo.pagamento_adesao') }}").load();
                    $("ul#listar li.coletivo").removeClass('textoforte-list');
                    $("ul#grupo_coletivo_concluido li.coletivo").removeClass('textoforte-list');
                    $("#all_pendentes_coletivo").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list');
                    limparFormulario()
                } else if(id_lista == "pagamento_vigencia_coletivo") {
                    $('#title_coletivo_por_adesao_table').html("<h4 style='font-size:1em;margin-top:10px;'>Pagamento Vigência</h4>");
                    table.ajax.url("{{ route('financeiro.coletivo.pagamento_vigencia') }}").load();
                    $("ul#listar li.coletivo").removeClass('textoforte-list');
                    $("ul#grupo_coletivo_concluido li.coletivo").removeClass('textoforte-list');
                    $("#all_pendentes_coletivo").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list'); 
                    limparFormulario();   
                } else if(id_lista == "pagamento_segunda_parcela") {
                    $('#title_coletivo_por_adesao_table').html("<h4 style='font-size:1em;margin-top:10px;'>Pagamento 2º Parcela</h4>");
                    table.ajax.url("{{ route('financeiro.coletivo.pagamento_segunda_parcela') }}").load();
                    $("ul#listar li.coletivo").removeClass('textoforte-list');
                    $("ul#grupo_coletivo_concluido li.coletivo").removeClass('textoforte-list');
                    $("#all_pendentes_coletivo").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list'); 
                    limparFormulario();  
                } else if(id_lista == "pagamento_terceira_parcela") {
                    $('#title_coletivo_por_adesao_table').html("<h4 style='font-size:1em;margin-top:10px;'>Pagamento 3º Parcela</h4>");
                    table.ajax.url("{{ route('financeiro.coletivo.pagamento_terceira_parcela') }}").load();
                    $("ul#listar li.coletivo").removeClass('textoforte-list');
                    $("ul#grupo_coletivo_concluido li.coletivo").removeClass('textoforte-list');
                    $("#all_pendentes_coletivo").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list');
                    limparFormulario();
                } else if(id_lista == "pagamento_quarta_parcela") {
                    $('#title_coletivo_por_adesao_table').html("<h4 style='font-size:1em;margin-top:10px;'>Pagamento 4º Parcela</h4>");
                    table.ajax.url("{{ route('financeiro.coletivo.pagamento_quarta_parcela') }}").load();
                    $("ul#listar li.coletivo").removeClass('textoforte-list');
                    $("ul#grupo_coletivo_concluido li.coletivo").removeClass('textoforte-list');
                    $("#all_pendentes_coletivo").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list');
                    limparFormulario();
                } else if(id_lista == "pagamento_quinta_parcela") {
                    $('#title_coletivo_por_adesao_table').html("<h4 style='font-size:1em;margin-top:10px;'>Pagamento 5º Parcela</h4>");
                    table.ajax.url("{{ route('financeiro.coletivo.pagamento_quinta_parcela') }}").load();
                    $("ul#listar li.coletivo").removeClass('textoforte-list');
                    $("ul#grupo_coletivo_concluido li.coletivo").removeClass('textoforte-list');
                    $("#all_pendentes_coletivo").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list');     
                    limparFormulario();
                } else if(id_lista == "pagamento_sexta_parcela") {
                    $('#title_coletivo_por_adesao_table').html("<h4 style='font-size:1em;margin-top:10px;'>Pagamento 6º Parcela</h4>");
                    table.ajax.url("{{ route('financeiro.coletivo.pagamento_sexta_parcela') }}").load();
                    $("ul#listar li.coletivo").removeClass('textoforte-list');
                    $("ul#grupo_coletivo_concluido li.coletivo").removeClass('textoforte-list');
                    $("#all_pendentes_coletivo").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list');     
                    limparFormulario();
                } else {

                }
            });      

            $("ul#listar_individual li.individual").on('click',function(){
                let id_lista = $(this).attr('id');
                if(id_lista == "aguardando_em_analise_individual") {
                    $('#title_individual').html("<h4 style='font-size:1em;margin-top:10px;'>Em Análise</h4>");
                    table_individual.ajax.url("{{ route('financeiro.individual.em_analise') }}").load();
                    $("ul#listar_individual li.individual").removeClass('textoforte-list'); 
                    $("ul#grupo_individual_concluido li.individual").removeClass('textoforte-list');
                    $("#all_pendentes_individual").removeClass('textoforte-list');   
                    $(this).addClass('textoforte-list');
                    $(".dados_cancelados").addClass("ocultar");
                    limparFormularioIndividual();
                } else if(id_lista == "aguardando_pagamento_1_parcela_individual") {
                    $('#title_individual').html("<h4 style='font-size:1em;margin-top:10px;'>Pagamento 1º Parcela</h4>");
                    table_individual.ajax.url("{{ route('financeiro.individual.pagamento_primeira_parcela') }}").load();
                    $("ul#listar_individual li.individual").removeClass('textoforte-list');  
                    $("ul#grupo_individual_concluido li.individual").removeClass('textoforte-list');     
                    $("#all_pendentes_individual").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list');
                    $(".dados_cancelados").addClass("ocultar");
                    limparFormularioIndividual();
                } else if(id_lista == "aguardando_pagamento_2_parcela_individual") {
                    $('#title_individual').html("<h4 style='font-size:1em;margin-top:10px;'>Pagamento 2º Parcela</h4>");
                    table_individual.ajax.url("{{ route('financeiro.individual.pagamento_segunda_parcela') }}").load();
                    $("ul#listar_individual li.individual").removeClass('textoforte-list');    
                    $("ul#grupo_individual_concluido li.individual").removeClass('textoforte-list');   
                    $("#all_pendentes_individual").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list');
                    $(".dados_cancelados").addClass("ocultar");
                    limparFormularioIndividual();
                } else if(id_lista == "aguardando_pagamento_3_parcela_individual") {
                    $('#title_individual').html("<h4 style='font-size:1em;margin-top:10px;'>Pagamento 3º Parcela</h4>");
                    table_individual.ajax.url("{{ route('financeiro.individual.pagamento_terceira_parcela') }}").load();
                    $("ul#listar_individual li.individual").removeClass('textoforte-list'); 
                    $("ul#grupo_individual_concluido li.individual").removeClass('textoforte-list');      
                    $("#all_pendentes_individual").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list');
                    $(".dados_cancelados").addClass("ocultar");
                    limparFormularioIndividual();
                } else if(id_lista == "aguardando_pagamento_4_parcela_individual") {
                    $('#title_individual').html("<h4 style='font-size:1em;margin-top:10px;'>Pagamento 4º Parcela</h4>");
                    table_individual.ajax.url("{{ route('financeiro.individual.pagamento_quarta_parcela') }}").load();
                    $("ul#listar_individual li.individual").removeClass('textoforte-list'); 
                    $("ul#grupo_individual_concluido li.individual").removeClass('textoforte-list'); 
                    $("#all_pendentes_individual").removeClass('textoforte-list');     
                    $(this).addClass('textoforte-list');
                    $(".dados_cancelados").addClass("ocultar");
                    limparFormularioIndividual();
                } else if(id_lista == "aguardando_pagamento_5_parcela_individual") {
                    $('#title_individual').html("<h4 style='font-size:1em;margin-top:10px;'>Pagamento 5º Parcela</h4>");
                    table_individual.ajax.url("{{ route('financeiro.individual.pagamento_quinta_parcela') }}").load();
                    $("ul#listar_individual li.individual").removeClass('textoforte-list'); 
                    $("ul#grupo_individual_concluido li.individual").removeClass('textoforte-list'); 
                    $("#all_pendentes_individual").removeClass('textoforte-list');     
                    $(this).addClass('textoforte-list');
                    $(".dados_cancelados").addClass("ocultar");
                    limparFormularioIndividual();
                } else if(id_lista == "aguardando_pagamento_6_parcela_individual") {
                    $('#title_individual').html("<h4 style='font-size:1em;margin-top:10px;'>Pagamento 6º Parcela</h4>");
                    table_individual.ajax.url("{{ route('financeiro.individual.pagamento_sexta_parcela') }}").load();
                    $("ul#listar_individual li.individual").removeClass('textoforte-list');
                    $("ul#grupo_individual_concluido li.individual").removeClass('textoforte-list');    
                    $("#all_pendentes_individual").removeClass('textoforte-list');   
                    $(this).addClass('textoforte-list');
                    $(".dados_cancelados").addClass("ocultar");
                    limparFormularioIndividual();
                }  else {

                }
            });  
           

            $("ul#listar_empresarial li.empresarial").on('click',function(){
                let id_lista = $(this).attr('id');
                if(id_lista == "aguardando_em_analise_empresarial") {
                    $("#title_empresarial").html("<h4 style='font-size:1em;margin-top:10px;'>Em Análise</h4>");
                    tableempresarial.ajax.url('{{route("contratos.listarEmpresarial.analise")}}').load();
                    $("ul#listar_empresarial li.empresarial").removeClass('textoforte-list');
                    $("ul#grupo_empresarial_concluido li.empresarial").removeClass('textoforte-list');  
                    $("#all_pendentes_empresarial").removeClass('textoforte-list');

                    $(this).addClass('textoforte-list');
                } else if(id_lista == "aguardando_pagamento_1_parcela_empresarial") {
                    $("#title_empresarial").html("<h4 style='font-size:1em;margin-top:10px;'>Pagamento 1º Parcela</h4>");
                    tableempresarial.ajax.url('{{route("contratos.listarEmpresarial.primeiraparcela")}}').load();
                    $("ul#listar_empresarial li.empresarial").removeClass('textoforte-list');   
                    $("ul#grupo_empresarial_concluido li.empresarial").removeClass('textoforte-list');
                    $("#all_pendentes_empresarial").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list');
                } else if(id_lista == "aguardando_pagamento_2_parcela_empresarial") {
                    $("#title_empresarial").html("<h4 style='font-size:1em;margin-top:10px;'>Pagamento 2º Parcela</h4>");
                    tableempresarial.ajax.url('{{route("contratos.listarEmpresarial.segundaparcela")}}').load();
                    $("ul#listar_empresarial li.empresarial").removeClass('textoforte-list');  
                    $("ul#grupo_empresarial_concluido li.empresarial").removeClass('textoforte-list');
                    $("#all_pendentes_empresarial").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list');
                } else if(id_lista == "aguardando_pagamento_3_parcela_empresarial") {
                    $("#title_empresarial").html("<h4 style='font-size:1em;margin-top:10px;'>Pagamento 3º Parcela</h4>");
                    tableempresarial.ajax.url('{{route("contratos.listarEmpresarial.terceiraparcela")}}').load();
                    $("ul#listar_empresarial li.empresarial").removeClass('textoforte-list');    
                    $("ul#grupo_empresarial_concluido li.empresarial").removeClass('textoforte-list');
                    $("#all_pendentes_empresarial").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list');
                } else if(id_lista == "aguardando_pagamento_4_parcela_empresarial") {
                    $("#title_empresarial").html("<h4 style='font-size:1em;margin-top:10px;'>Pagamento 4º Parcela</h4>");
                    tableempresarial.ajax.url('{{route("contratos.listarEmpresarial.quartaparcela")}}').load();
                    $("ul#listar_empresarial li.empresarial").removeClass('textoforte-list');  
                    $("ul#grupo_empresarial_concluido li.empresarial").removeClass('textoforte-list');
                    $("#all_pendentes_empresarial").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list');
                } else if(id_lista == "aguardando_pagamento_5_parcela_empresarial") {
                    $("#title_empresarial").html("<h4 style='font-size:1em;margin-top:10px;'>Pagamento 5º Parcela</h4>");
                    tableempresarial.ajax.url('{{route("contratos.listarEmpresarial.quintaparcela")}}').load();
                    $("ul#listar_empresarial li.empresarial").removeClass('textoforte-list');   
                    $("ul#grupo_empresarial_concluido li.empresarial").removeClass('textoforte-list');
                    $("#all_pendentes_empresarial").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list');
                } else if(id_lista == "aguardando_pagamento_6_parcela_empresarial") {
                    $("#title_empresarial").html("<h4 style='font-size:1em;margin-top:10px;'>Pagamento 6º Parcela</h4>");
                    tableempresarial.ajax.url('{{route("contratos.listarEmpresarial.sextaparcela")}}').load();
                    $("ul#listar_empresarial li.empresarial").removeClass('textoforte-list');                       
                    $("#all_pendentes_empresarial").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list');
                } else {

                }
            });
            
            $("ul#grupo_individual_concluido li.individual").on('click',function(){
                let id_lista = $(this).attr('id');
                if(id_lista == "finalizado_individual") { 
                    $('#title_individual').html("<h4 style='font-size:1em;margin-top:10px;'>Finalizado</h4>");
                    table_individual.ajax.url("{{ route('financeiro.individual.finalizado') }}").load();
                    $("ul#listar_individual li.individual").removeClass('textoforte-list'); 
                    $("ul#grupo_individual_concluido li.individual").removeClass('textoforte-list');
                    $("#all_pendentes_individual").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list');
                    $(".dados_cancelados").addClass("ocultar");
                    limparFormularioIndividual();
                } else {
                    $('#title_individual').html("<h4 style='font-size:1em;margin-top:10px;'>Cancelado</h4>");
                    table_individual.ajax.url("{{ route('financeiro.individual.cancelado') }}").load();
                    $("ul#listar_individual li.individual").removeClass('textoforte-list'); 
                    $("ul#grupo_individual_concluido li.individual").removeClass('textoforte-list');
                    $("#all_pendentes_individual").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list');
                    $(".dados_cancelados").removeClass("ocultar");
                    limparFormularioIndividual();
                }    
            });

            $("ul#grupo_coletivo_concluido li.coletivo").on('click',function(){
                let id_lista = $(this).attr('id');
                if(id_lista == "finalizado_coletivo") {
                    $('#title_coletivo_por_adesao_table').html("<h4 style='font-size:1em;margin-top:10px;'>Finalizado</h4>");
                    table.ajax.url("{{ route('financeiro.coletivo.finalizado') }}").load();
                    $("ul#grupo_coletivo_concluido li.coletivo").removeClass('textoforte-list');
                    $("ul#listar li.coletivo").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list');
                } else {
                    $('#title_coletivo_por_adesao_table').html("<h4 style='font-size:1em;margin-top:10px;'>Cancelado</h4>");
                    table.ajax.url("{{ route('financeiro.coletivo.cancelado') }}").load();
                    $("ul#grupo_coletivo_concluido li.coletivo").removeClass('textoforte-list');
                    $("ul#listar li.coletivo").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list');
                }
            });

            $("ul#grupo_empresarial_concluido li.empresarial").on('click',function(){
                let id_lista = $(this).attr('id');
                if(id_lista == "aguardando_finalizado_empresarial") {
                    $("#title_empresarial").html("<h4 style='font-size:1em;margin-top:10px;'>Finalizado</h4>");
                    $("ul#grupo_empresarial_concluido li.empresarial").removeClass('textoforte-list');
                    $("ul#listar_empresarial li.empresarial").removeClass('textoforte-list');  
                    $("#all_pendentes_empresarial").removeClass('textoforte-list');  
                    $(this).addClass('textoforte-list');
                    tableempresarial.ajax.url('{{route("contratos.listarEmpresarial.finalizado")}}').load();
                } else {
                    $("#title_empresarial").html("<h4 style='font-size:1em;margin-top:10px;'>Cancelado</h4>");
                    $("ul#grupo_empresarial_concluido li.empresarial").removeClass('textoforte-list');
                    $("ul#listar_empresarial li.empresarial").removeClass('textoforte-list'); 
                    $("#all_pendentes_empresarial").removeClass('textoforte-list');   
                    $(this).addClass('textoforte-list');
                    tableempresarial.ajax.url('{{route("contratos.listarEmpresarial.cancelado")}}').load();
                }
            });

            function limparTudo() {
                $('.coluna-right').find("input[type='text']").val('');
                $('tr').removeClass('textoforte');
                $('li').prop('data-id','');
                $('select').prop('selectedIndex',0);
            }

            function limparFormularioIndividual() {
                $("#administradora_individual").val('');
                $("#tipo_plano_individual").val('');
                $("#status_individual_view").val('');
                $("#cliente").val('');
                $("#data_nascimento").val('');
                $("#codigo_externo_individual").val('');
                $("#cpf").val('');
                $("#responsavel_financeiro").val('');
                $("#cpf_financeiro").val('');
                $("#celular_individual_view_input").val('');
                $("#telefone_individual_view_input").val('');
                $("#email").val('');
                $("#cep_individual_cadastro").val('');
                $("#cidade").val('');
                $("#uf").val('');
                $("#bairro_individual_cadastro").val('');
                $("#rua_individual_cadastro").val('');
                $("#complemento_individual_cadastro").val('');
                $("#data_contrato").val('');
                $("#valor_contrato").val('');
                $("#valor_adesao").val('');
                $("#quantidade_vidas_individual_cadastrar").val('');
                $("#data_boleto").val('');
                $("#data_vigencia").val('');
                $("#texto_descricao_individual_view").val('');
            }

            function limparFormulario() {
                $("#administradora_coletivo_view").val('');
                $("#tipo_plano_coletivo_view").val('');
                $("#estagio_contrato_coletivo_view").val('');
                $("#cliente_coletivo_view").val('');
                $("#data_nascimento_coletivo_view").val('');
                $("#codigo_externo_coletivo_view").val('');
                $("#cpf_coletivo_view").val('');
                $("#responsavel_financeiro_coletivo").val('');
                $("#cpf_financeiro_coletivo_view").val('');
                $("#celular_coletivo_view").val('');
                $("#telefone_coletivo_view").val('');
                $("#email_coletivo_view").val('');
                $("#cep_coletivo_view").val('');
                $("#cidade_coletivo_view").val('');
                $("#uf_coletivo_view").val('');
                $("#bairro_coletivo_view").val('');
                $("#rua_coletivo_view").val('');
                $("#complemento_coletivo_view").val('');
                $("#data_contrato_coletivo_view").val('');
                $("#valor_contrato_coletivo_view").val('');
                $("#valor_adesao_coletivo_view").val('');
                $("#quantidade_vidas_coletivo_cadastrar").val('');
                $("#data_boleto_coletivo_view").val('');
                $("#data_vigencia_coletivo_view").val('');
                $("#texto_descricao_coletivo_view").val('');
            }


            function limparEmpresarial() {
                $("#vendedor_view_empresarial").val('');
                $("#plano_view_empresarial").val('');
                $("#tabela_origem_view_empresarial").val('');
                $("#razao_social_view_empresarial").val('');
                $("#cnpj_view").val('');
                $("#qtd_vidas").val('');
                $("#telefone_corretor_view_empresarial").val('');
                $("#celular_corretor_view_empresarial").val('');
                $("#email_odonto_view_empresarial").val('');
                $("#nome_corretor_view_empresarial").val('');
                $("#uf_cliente_view_empresarial").val('');
                $("#cidade_saude_view_empresarial").val('');
                $("#plano_contratado_corretor_view_empresarial").val('');
                $("#cod_corretora_view_empresarial").val('');
                $("#cod_saude_view_empresarial").val('');
                $("#cod_odonto_view_empresarial").val('');
                $("#senha_cliente_view_empresarial").val('');
                $("#valor_plano_saude_view").val('');
                $("#valor_plano_odonto_view").val('');
                $("#valor_plano_view_empresarial").val('');
                $("#taxa_adesao_view_empresarial").val('');
                $("#plano_adesao_view_empresarial").val('');
                $("#valor_boleto_view_empresarial").val('');
                $("#vencimento_boleto_view_empresarial").val('');
                $("#data_boleto_view_empresarial").val('');






            }


            $(".list_abas li").on('click',function(){
                

                $('li').removeClass('ativo');
                $(this).addClass("ativo");
                let id = $(this).attr('data-id');
                
                if(id == "aba_coletivo") {

                    

                    


                    // $("#select_usuario").html('');
                    //const table_coletivo_ativa = $(".ativado").DataTable();
                    // // let dados = table_coletivo.columns[1];
                    // // console.log(dados);
                    // var selectUsuario = $("#select_usuario");
                    // table_coletivo_ativa
                    //    .columns([1])
                    //    .every(function () {
                    //         var column = this;
                    //         column.data().unique().sort().each(function (d, j) {
                    //             console.log(d);
                    //             //selectUsuario.append('<option value="' + d + '">' + d + '</option>');
                    //         })

                    //    })
                }
                
                
                $("#janela_ativa").val(id);

                default_formulario = $('.coluna-right.'+id).html();




                $('.conteudo_abas main').addClass('ocultar');
                $('#'+id).removeClass('ocultar');

                var formulario_default = $(".coluna-right."+id).html();

                $('#title_coletivo_por_adesao_table').html("<h4 style='font-size:1em;margin-top:10px;'>Pendentes</h4>");
                table.ajax.url("{{ route('financeiro.individual.geralColetivoPendentes.contrato') }}").load();
                
                $('#title_individual').html("<h4 style='font-size:1em;margin-top:10px;'>Pendentes</h4>");
                table_individual.ajax.url("{{ route('financeiro.individual.geralIndividualPendentes.contrato') }}").load();
                
                $("#title_empresarial").html("<h4 style='font-size:1em;margin-top:10px;'>Pendentes</h4>");
                tableempresarial.ajax.url('{{route("contratos.listarEmpresarial.listarContratoEmpresaPendentes")}}').load();
                
                $("ul#listar_individual li.individual").removeClass('textoforte-list'); 
                $("ul#grupo_individual_concluido li.individual").removeClass('textoforte-list');  
                $("ul#listar_empresarial li.empresarial").removeClass('textoforte-list');
                $("ul#grupo_empresarial_concluido li.empresarial").removeClass('textoforte-list');  
                $("ul#listar li.coletivo").removeClass('textoforte-list');
                $("ul#grupo_coletivo_concluido li.coletivo").removeClass('textoforte-list');

                $("#all_pendentes_individual").addClass("textoforte-list");
                $("#all_pendentes_coletivo").addClass("textoforte-list");
                $("#all_pendentes_empresarial").addClass("textoforte-list");

                limparFormularioIndividual();
                limparFormulario();
                limparEmpresarial();
            });

            

            



        });
    </script>
@stop


@section('css')
    <style>
        .ativo {background-color:#FFF !important;color: #000 !important;}
        .ocultar {display: none;}
        .list_abas {list-style: none;display: flex;border-bottom: 1px solid white;margin: 0;padding: 0;}
        .list_abas li {color: #fff;width: 150px;padding: 8px 5px;text-align:center;border-radius: 5px 5px 0 0;background-color:#123449;}
        .list_abas li:hover {cursor: pointer;}    
        .list_abas li:nth-of-type(2) {margin: 0 1%;}
        .textoforte {background-color:rgba(255,255,255,0.5) !important;color:black;}
        .textoforte-list {background-color:rgba(255,255,255,0.5);color:white;}
        .botao:hover {background-color: rgba(0,0,0,0.5) !important;color:#FFF !important;}
        .valores-acomodacao {background-color:#123449;color:#FFF;width:32%;box-shadow:rgba(0,0,0,0.8) 0.6em 0.7em 5px;}
        .valores-acomodacao:hover {cursor:pointer;box-shadow: none;}
        .table thead tr {background-color:#123449;color: white;}
        .destaque {border:4px solid rgba(36,125,157);}
        #coluna_direita {flex-basis:10%;background-color:#123449;border-radius: 5px;}
        #coluna_direita ul {list-style: none;margin: 0;padding: 0;}
        #coluna_direita li {color:#FFF;}
        .coluna-right {flex-basis:30%;flex-wrap: wrap;border-radius:5px;height:720px;}
        .container_div_info {display:flex;position:absolute;flex-basis:30%;right:0px;top:57px;display: none;z-index: 1;color: #FFF;}
        #padrao {width:50px;background-color:#FFF;color:#000;}
        th { font-size: 0.9em !important; }
        td { font-size: 0.8em !important; }       
        .dt-right {text-align: right !important;}
        .dt-center {text-align: center !important;}
        .estilizar_pagination .pagination {font-size: 0.8em !important;color:#FFF;}
        .estilizar_pagination .pagination li {height:10px;color:#FFF;}
        .por_pagina {font-size: 12px !important;color:#FFF;}
        .por_pagina #tabela_mes_atual_length {display: flex;align-items: center;align-self: center;margin-top: 8px;}
        .por_pagina #tabela_mes_diferente_length {display: flex;align-items: center;align-self: center;margin-top: 8px;}
        .por_pagina select {color:#FFF !important;}
        .estilizar_pagination #tabela_mes_atual_previous {color:#FFF !important;}
        .estilizar_pagination #tabela_mes_atual_next {color:#FFF !important;}
        .estilizar_pagination #tabela_mes_diferente_previous {color:#FFF !important;}
        .estilizar_pagination #tabela_mes_diferente_next {color:#FFF !important;}
        .estilizar_search input[type='search'] {background-color: #FFF !important;}



    </style>
@stop




