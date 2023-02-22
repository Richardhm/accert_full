@extends('adminlte::page')
@section('title', 'Contrato')
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
    <li class="nav-item"><a href="" class="nav-link div_info"><i class="fas fa-cogs text-white"></i></a></li>
    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt text-white"></i>
    </a>
@stop





@section('content')

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
                        <h5 class="text-center d-flex align-items-center justify-content-center py-2 border-bottom">Pendentes</h5>

                        <ul style="margin:0;padding:0;list-style:none;" id="listar_individual">
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_em_analise_individual" class="individual">
                                <span>Em Análise</span>
                               <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_individual_em_analise}}</span>                        
                            </li>

                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_pagamento_1_parcela_individual" class="individual">
                                <span>Pagamento 1º Parcela</span>
                               <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_individual_parcela_01}}</span>                        
                            </li>

                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_pagamento_2_parcela_individual" class="individual">
                               <span>Pagamento 2º Parcela</span>
                               <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_individual_parcela_02}}</span>                        
                            </li>

                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_pagamento_3_parcela_individual" class="individual">
                               <span>Pagamento 3º Parcela</span>
                               <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_individual_parcela_03}}</span>                        
                            </li>

                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_pagamento_4_parcela_individual" class="individual">
                               <span>Pagamento 4º Parcela</span>
                               <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_individual_parcela_04}}</span>                        
                            </li>

                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_pagamento_5_parcela_individual" class="individual">
                               <span>Pagamento 5º Parcela</span>
                               <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_individual_parcela_05}}</span>                        
                            </li>

                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_pagamento_6_parcela_individual" class="individual">
                               <span>Pagamento 6º Parcela</span>
                               <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_individual_parcela_06}}</span>                        
                            </li>

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
                        <table id="tabela_individual" class="table table-sm listarindividual">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Corretor</th>
                                    
                                    <th>Cliente</th>
                                    <th>Vencimento</th>                                  
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>   
                    </div>
                </div>  
                <!--FIM COLUNA DA CENTRAL-->

                <!---------DIREITA-------------->    
                <div class="mr-1 coluna-right">
                    <section class="p-1" style="background-color:#123449;border-radius: 5px;">


                        <div class="d-flex mb-2">
                                
                            <div style="flex-basis:25%;">
                                <span class="text-white" style="font-size:0.875em;">Administradora:</span>
                                <input type="text" name="administradora_individual" id="administradora_individual" class="form-control  form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:28%;margin:0 1%;">    
                                <span class="text-white" style="font-size:0.875em;">Tipo Plano:</span>
                                <input type="text" name="tipo_plano" id="tipo_plano_individual" class="form-control  form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:45%;" id="status">
                                <span class="text-white" style="font-size:0.875em;">Status:</span>
                                <input type="text" id="status_individual_view" class="form-control form-control-sm" readonly>
                            </div>    


                        </div>

                        <div class="d-flex mb-2">
                            
                            <div style="flex-basis:43%;">
                                <span class="text-white" style="font-size:0.875em;">Cliente:</span>
                                <input type="text" name="cliente" id="cliente" class="form-control form-control-sm" readonly>
                            </div>
                            
                            <div style="flex-basis:25%;margin:0 1%;">
                                <span class="text-white" style="font-size:0.875em;">Data Nascimento:</span>
                                <input type="text" name="data_nascimento" id="data_nascimento" class="form-control form-control-sm" readonly>
                            </div>
                            
                            <div style="flex-basis:30%;">
                                <span class="text-white" style="font-size:0.875em;">Codigo Externo:</span>
                                <input type="text" name="codigo_externo" id="codigo_externo_individual" class="form-control  form-control-sm" readonly>
                            </div>    

                        </div>

                        <div class="d-flex mb-2">
                            <div style="flex-basis:28%;">
                                <span class="text-white" style="font-size:0.875em;">CPF:</span>
                                <input type="text" id="cpf" class="form-control form-control-sm" readonly>
                            </div>
                            <div style="flex-basis:38%;margin:0 1%;">
                                <span class="text-white" style="font-size:0.875em;">Responsavel Financeiro:</span>
                                <input type="text" id="responsavel_financeiro" class="form-control  form-control-sm" readonly>
                            </div>
                            <div style="flex-basis:32%;">
                                <span class="text-white" style="font-size:0.875em;">CPF Financeiro:</span>
                                <input type="text" id="cpf_financeiro" class="form-control  form-control-sm" readonly>
                            </div>    
                        </div>


                        <div class="d-flex mb-2">
                            
                            <div style="flex-basis:28%;margin-right:1%;">
                                <span class="text-white" style="font-size:0.875em;">Celular:</span>
                                <input type="text" id="celular_individual_view_input" class="form-control form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:25%;margin-right:1%;">
                                <span class="text-white" style="font-size:0.875em;">Telefone:</span>
                                <input type="text" id="telefone_individual_view_input" class="form-control form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:45%;">
                                <span class="text-white" style="font-size:0.875em;">Email:</span>
                                <input type="text" id="email" class="form-control form-control-sm" readonly>
                            </div>


                        </div>


                        <div class="d-flex mb-2">
                            <div style="flex-basis:22%;">
                                <span class="text-white" style="font-size:0.875em;">CEP:</span>
                                <input type="text" name="cep" id="cep_individual_cadastro" class="form-control form-control-sm" readonly>
                            </div>
                            <div style="flex-basis:78%;margin:0 1%;">
                                <span class="text-white" style="font-size:0.875em;">Cidade:</span> 
                                <input type="text" id="cidade" class="form-control  form-control-sm" readonly>
                            </div>
                            <div style="flex-basis:10%;">
                                <span class="text-white" style="font-size:0.875em;">UF:</span>
                                <input type="text" id="uf" class="form-control form-control-sm" readonly>
                            </div>                         
                        </div>

                        <div class="d-flex mb-2">
                            
                            <div style="flex-basis:30%;">
                                <span class="text-white" style="font-size:0.875em;">Bairro:</span>
                                <input type="text" id="bairro_individual_cadastro" class="form-control form-control-sm" readonly>
                            </div>    

                            <div style="flex-basis:40%;margin:0 1%;">
                                <span class="text-white" style="font-size:0.875em;">Rua:</span>
                                <input type="text" id="rua_individual_cadastro" class="form-control form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:29%;">
                                <span class="text-white" style="font-size:0.875em;">Complemento:</span>
                                <input type="text" id="complemento_individual_cadastro" class="form-control form-control-sm" readonly>
                            </div>



                        </div>

                       
                        <div class="d-flex mb-2">
                            <div style="flex-basis:32%;">
                                <span class="text-white" style="font-size:0.875em;">Data Contrato:</span>
                                <input type="text" name="data_contrato" id="data_contrato" class="form-control form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:32%;margin:0 1%;">
                                <span class="text-white" style="font-size:0.875em;">Valor Contrato:</span>
                                <input type="text" name="valor_contrato" id="valor_contrato" class="form-control  form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:32%;">
                                <span class="text-white" style="font-size:0.875em;">Valor Adesão:</span>
                                <input type="text" name="valor_adesao" id="valor_adesao" class="form-control  form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:8%;margin-left:1%;">    
                                <span class="text-white" style="font-size:0.875em;">Vidas</span>
                                <input type="text" name="quantidade_vidas" id="quantidade_vidas_individual_cadastrar" class="form-control  form-control-sm" readonly>
                            </div>
                             
                        </div>

                        <div class="d-flex mb-2">

                            <div style="flex-basis:23%;">
                                <span class="text-white" style="font-size:0.875em;">Data Boleto:</span>
                                <input type="text" name="data_boleto" id="data_boleto" class="form-control  form-control-sm" readonly>
                            </div>

                             <div style="flex-basis:23%;margin:0 1%;">
                                <span class="text-white" style="font-size:0.875em;">Data Vigência:</span>
                                <input type="text" name="data_vigencia" id="data_vigencia" class="form-control  form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:53%;">
                                <span class="text-white" style="font-size:0.875em;">Plano Contratado:</span>
                                <input type="text" id="texto_descricao_individual_view" value="" class="form-control form-control-sm" readonly>     
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
                        <h5 class="text-center d-flex align-items-center justify-content-center py-2 border-bottom">Pendentes</h5>
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
                                <span>Pagamento Adesão</span>
                                <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_coletivo_pg_adesao}}</span>
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="pagamento_vigencia_coletivo" class="coletivo">
                                <span>Pagamento Vigência</span>
                                <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_coletivo_pg_vigencia}}</span>
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="pagamento_segunda_parcela" class="coletivo">
                                <span>Pagamento 2º Parcela</span>
                                <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_coletivo_02_parcela}}</span>
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="pagamento_terceira_parcela" class="coletivo">
                                <span>Pagamento 3º Parcela</span>
                                <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_coletivo_03_parcela}}</span>
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="pagamento_quarta_parcela" class="coletivo">
                                <span>Pagamento 4º Parcela</span>
                                <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_coletivo_04_parcela}}</span>
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="pagamento_quinta_parcela" class="coletivo">
                                <span>Pagamento 5º Parcela</span>
                                <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_coletivo_05_parcela}}</span>
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="pagamento_sexta_parcela" class="coletivo">
                                <span>Pagamento 6º Parcela</span>
                                <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_coletivo_06_parcela}}</span>
                            </li>
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
                        <table id="tabela_coletivo" class="table table-sm listardados">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Corretor</th>
                                    <th>Administradora</th>
                                    <th>Cliente</th>
                                    <th>Vencimento</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>   
                    </div> 
                </div>  
                <!--FIM COLUNA DA CENTRAL-->


                <!--COLUNA DA DIREITA-->    
                <div class="mr-1 coluna-right">
                    <section class="p-1" style="background-color:#123449;">
                        
                        <div class="d-flex mb-2">
                                
                            <div style="flex-basis:25%;">
                                <span class="text-white" style="font-size:0.875em;">Administradora:</span>
                                <input type="text" id="administradora_coletivo_view" class="form-control  form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:33%;margin:0 1%;">    
                                <span class="text-white" style="font-size:0.875em;">Tipo Plano:</span>
                                <input type="text" id="tipo_plano_coletivo_view" class="form-control  form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:40%;" id="status">
                                <span class="text-white" style="font-size:0.875em;">Status:</span>
                                <input type="text" id="estagio_contrato_coletivo_view" class="form-control form-control-sm" readonly>
                            </div>  

                        </div>

                        <div class="d-flex mb-2">
                            
                            <div style="flex-basis:43%;">
                                <span class="text-white" style="font-size:0.875em;">Cliente:</span>
                                <input type="text" id="cliente_coletivo_view" class="form-control form-control-sm" readonly>
                            </div>
                            
                            <div style="flex-basis:25%;margin:0 1%;">
                                <span class="text-white" style="font-size:0.875em;">Data Nascimento:</span>
                                <input type="text" id="data_nascimento_coletivo_view" class="form-control form-control-sm" readonly>
                            </div>
                            
                            <div style="flex-basis:30%;">
                                <span class="text-white" style="font-size:0.875em;">Codigo Externo:</span>
                                <input type="text" id="codigo_externo_coletivo_view" class="form-control  form-control-sm" readonly>
                            </div>    

                        </div>

                        <div class="d-flex mb-2">

                            <div style="flex-basis:28%;">
                                <span class="text-white" style="font-size:0.875em;">CPF:</span>
                                <input type="text" id="cpf_coletivo_view" class="form-control form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:38%;margin:0 1%;">
                                <span class="text-white" style="font-size:0.875em;">Responsavel Financeiro:</span>
                                <input type="text" id="responsavel_financeiro_coletivo" class="form-control  form-control-sm" readonly>
                            </div>
                            
                            <div style="flex-basis:32%;">
                                <span class="text-white" style="font-size:0.875em;">CPF Financeiro:</span>
                                <input type="text" id="cpf_financeiro_coletivo_view" class="form-control  form-control-sm" readonly>
                            </div>    

                        </div>

                        <div class="d-flex mb-2">
                            
                            <div style="flex-basis:28%;margin-right:1%;">
                                <span class="text-white" style="font-size:0.875em;">Celular:</span>
                                <input type="text" id="celular_coletivo_view" class="form-control form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:26%;margin-right:1%;">
                                <span class="text-white" style="font-size:0.875em;">Telefone:</span>
                                <input type="text" id="telefone_coletivo_view" class="form-control form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:46%;">
                                <span class="text-white" style="font-size:0.875em;">Email:</span>
                                <input type="text" id="email_coletivo_view" class="form-control form-control-sm" readonly>
                            </div>

                        </div>


                        <div class="d-flex mb-2">

                            <div style="flex-basis:22%;">
                                <span class="text-white" style="font-size:0.875em;">CEP:</span>
                                <input type="text" id="cep_coletivo_view" class="form-control form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:78%;margin:0 1%;">
                                <span class="text-white" style="font-size:0.875em;">Cidade:</span> 
                                <input type="text" id="cidade_coletivo_view" class="form-control  form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:10%;">
                                <span class="text-white" style="font-size:0.875em;">UF:</span>
                                <input type="text" id="uf_coletivo_view" class="form-control form-control-sm" readonly>
                            </div>

                        </div> 


                        <div class="d-flex mb-2">
                            
                              <div style="flex-basis:30%;">
                                <span class="text-white" style="font-size:0.875em;">Bairro:</span>
                                <input type="text" name="bairro_coletivo" id="bairro_coletivo_view" class="form-control form-control-sm" readonly>
                            </div>    
                    
                            <div style="flex-basis:30%;margin:0 1%;">
                                <span class="text-white" style="font-size:0.875em;">Rua:</span>
                                <input type="text" name="rua_coletivo" id="rua_coletivo_view" class="form-control form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:40%;">
                                <span class="text-white" style="font-size:0.875em;">Complemento:</span>
                                <input type="text" id="complemento_coletivo_view" class="form-control form-control-sm" readonly>
                            </div>

                        </div>

                    
                        <div class="d-flex mb-2">

                            <div style="flex-basis:31%;">
                                <span class="text-white" style="font-size:0.875em;">Data Contrato:</span>
                                <input type="text" name="data_contrato_coletivo" id="data_contrato_coletivo_view" class="form-control form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:31%;margin:0 1%;">
                                <span class="text-white" style="font-size:0.875em;">Valor Contrato:</span>
                                <input type="text" name="valor_contrato_coletivo" id="valor_contrato_coletivo_view" class="form-control  form-control-sm" readonly>
                            </div>

                             

                            <div style="flex-basis:31%;margin-right:1%;">
                                <span class="text-white" style="font-size:0.875em;">Valor Adesão:</span>
                                <input type="text" id="valor_adesao_coletivo_view" class="form-control  form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:7%">    
                                <span class="text-white" style="font-size:0.875em;">Vidas</span>
                                <input type="text" name="quantidade_vidas" id="quantidade_vidas_coletivo_cadastrar" class="form-control  form-control-sm" readonly>
                            </div>
                    
                        </div>


                         <div class="d-flex mb-2">

                            <div style="flex-basis:23%;">
                                <span class="text-white" style="font-size:0.875em;">Data Boleto:</span>
                                <input type="text" id="data_boleto_coletivo_view" class="form-control  form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:23%;margin:0 1%;">
                                <span class="text-white" style="font-size:0.875em;">Data Vigência:</span>
                                <input type="text" name="data_vigencia_coletivo" id="data_vigencia_coletivo_view" class="form-control  form-control-sm" readonly>
                            </div>
                            
                            <div style="flex-basis:54%;margin-right:1%;">
                                <span class="text-white" style="font-size:0.875em;">Plano Contratado:</span>
                                <input type="text" id="texto_descricao_coletivo_view" value="" class="form-control form-control-sm" readonly> 
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
                        <h5 class="text-center d-flex align-items-center justify-content-center py-2 border-bottom">Pendentes</h5>

                        



                        <ul style="margin:0;padding:0;list-style:none;" id="listar_empresarial">
                            
                           <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_em_analise_empresarial"  class="empresarial">
                                <span>Em Análise</span>
                               <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_empresarial_em_analise}}</span>                        
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_pagamento_1_parcela_empresarial" class="empresarial">
                                <span>Pagamento 1º Parcela</span>
                               <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_empresarial_parcela_01}}</span>                        
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_pagamento_2_parcela_empresarial" class="empresarial">
                               <span>Pagamento 2º Parcela</span>
                               <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_empresarial_parcela_02}}</span>                        
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_pagamento_3_parcela_empresarial" class="empresarial">
                               <span>Pagamento 3º Parcela</span>
                               <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_empresarial_parcela_03}}</span>                        
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_pagamento_4_parcela_empresarial" class="empresarial">
                               <span>Pagamento 4º Parcela</span>
                               <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_empresarial_parcela_04}}</span>                        
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_pagamento_5_parcela_empresarial" class="empresarial">
                               <span>Pagamento 5º Parcela</span>
                               <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_empresarial_parcela_05}}</span>                        
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_pagamento_6_parcela_empresarial" class="empresarial">
                               <span>Pagamento 6º Parcela</span>
                               <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_empresarial_parcela_06}}</span>                        
                            </li>
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
                        <table id="tabela_empresarial" class="table table-sm listarempresarial">
                            <thead>
                                <tr>
                                    <th>Usuario</th>
                                    <th>Razão Social</th>
                                    <th>Valor</th>
                                    <th>Vencimento</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>   
                    </div> 
                </div>  
                <!--FIM COLUNA DA CENTRAL-->

                <!---Coluna Direita--->
                <div class="mr-1 coluna-right">
                    <section class="p-1" style="background-color:#123449;">

                        <div class="d-flex mb-2">
                            
                            <div style="flex-basis:33%;">
                                <span class="text-white" style="font-size:0.875em;">Vendedor:</span>
                                <input type="text" id="vendedor_view_empresarial" class="form-control form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:33%;margin:0 1%;">
                                <span class="text-white" style="font-size:0.875em;">Plano:</span> 
                                <input type="text" name="plano_view_empresarial" id="plano_view_empresarial" class="form-control  form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:33%;">
                                <span class="text-white" style="font-size:0.875em;">Tabela Origem:</span> 
                                <input type="text" name="tabela_origem_view_empresarial" id="tabela_origem_view_empresarial" class="form-control  form-control-sm" readonly>
                            </div>

                        </div>

                        
                        <div class="d-flex mb-2">
                            
                            
                            <div style="flex-basis:57%;">
                                <span class="text-white" style="font-size:0.875em;">Razão Social:</span>
                                <input type="text" id="razao_social_view_empresarial" class="form-control form-control-sm" readonly>
                            </div>
                                  
                            <div style="flex-basis:33%;margin:0 1%;">
                                <span class="text-white" style="font-size:0.875em;">CNPJ:</span>
                                <input type="text" id="cnpj_view" class="form-control form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:8%;">
                                <span class="text-white" style="font-size:0.875em;">Vidas:</span>
                                <input type="text" id="qtd_vidas" class="form-control form-control-sm" readonly>
                            </div>
                   
                        </div>



                       


                        <div class="d-flex mb-2">
                            <div style="flex-basis:30%;">
                                <span class="text-white" style="font-size:0.875em;">Telefone:</span>
                                <input type="text" id="telefone_corretor_view_empresarial" class="form-control form-control-sm" readonly>
                            </div>    

                            <div style="flex-basis:30%;margin:0 1%;">
                                <span class="text-white" style="font-size:0.875em;">Celular:</span>
                                <input type="text" id="celular_corretor_view_empresarial" class="form-control form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:40%;">
                                <span class="text-white" style="font-size:0.875em;">Email:</span>
                                <input type="text" id="email_odonto_view_empresarial" class="form-control form-control-sm" readonly>
                            </div>


                            
                        </div>




                         <div class="d-flex mb-2">

                            <div style="flex-basis:30%;margin-right:1%;">
                                <span class="text-white" style="font-size:0.875em;">Responsavel:</span>
                                <input type="text" id="nome_corretor_view_empresarial" class="form-control form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:10%;margin-right:1%;">
                                <span class="text-white" style="font-size:0.875em;">UF:</span>
                                <input type="text" id="uf_cliente_view_empresarial" class="form-control form-control-sm" readonly>
                            </div> 

                            <div style="flex-basis:24%;margin-right:1%;">
                                <span class="text-white" style="font-size:0.875em;">Cidade:</span>
                                <input type="text" id="cidade_saude_view_empresarial" class="form-control form-control-sm" readonly>
                            </div>

                                                    
                            <div style="flex-basis:38%;">
                                <span class="text-white" style="font-size:0.875em;">Plano Contratado:</span>
                                <input type="text" id="plano_contratado_corretor_view_empresarial" class="form-control form-control-sm" readonly>
                            </div>


                        </div>              


                                




                        

                        


                        <div class="d-flex mb-2">

                            <div style="flex-basis:24%;">
                                <span class="text-white" style="font-size:0.875em;">Cód.Corretora:</span>
                                <input type="text" id="cod_corretora_view_empresarial" class="form-control form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:24%;margin:0 1%;">
                                <span class="text-white" style="font-size:0.875em;">Codigo Saude:</span>
                                <input type="text" id="cod_saude_view_empresarial" class="form-control form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:24%;margin-right: 1%;">
                                <span class="text-white" style="font-size:0.875em;">Codigo Odonto:</span>
                                <input type="text" id="cod_odonto_view_empresarial" class="form-control form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:25%;">
                                <span class="text-white" style="font-size:0.875em;">Senha Cliente:</span>
                                <input type="text" id="senha_cliente_view_empresarial" class="form-control form-control-sm" readonly>
                            </div>


                        </div>                    







                        <div class="d-flex mb-2">

                            <div style="flex-basis:25%;margin-right:1%;">
                                <span class="text-white" style="font-size:0.875em;">Valor Saude:</span>
                                <input type="text" id="valor_plano_saude_view" class="form-control form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:25%;margin-right:1%;">
                                <span class="text-white" style="font-size:0.875em;">Valor Odonto:</span>
                                <input type="text" id="valor_plano_odonto_view" class="form-control form-control-sm" readonly>
                            </div>

                            

                            <div style="flex-basis:25%;margin-right:1%;">
                                <span class="text-white" style="font-size:0.875em;">Total Plano:</span>
                                <input type="text" id="valor_plano_view_empresarial" class="form-control form-control-sm" readonly>
                            
                            </div>

                            <div style="flex-basis:25%;">
                                <span class="text-white" style="font-size:0.875em;">Taxa Adesão:</span>
                                <input type="text" id="taxa_adesao_view_empresarial" class="form-control form-control-sm" readonly>
                            </div>

                        </div>


                        <div class="d-flex mb-1">
                            
                            <div style="flex-basis:24%;margin-right:1%;">
                                <span class="text-white" style="font-size:0.875em;">Plano c/Adesão:</span>
                                <input type="text" id="plano_adesao_view_empresarial" class="form-control form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:24%;">
                                <span class="text-white" style="font-size:0.875em;">Valor Boleto:</span>
                                <input type="text" id="valor_boleto_view_empresarial" class="form-control form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:25%;margin:0 1%;">
                                <span class="text-white" style="font-size:0.875em;">Venc. Boleto:</span>
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
        $(function(){

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
                    //$("#coparticipacao_sim").removeClass('active');
                    //$("#coparticipacao_nao").removeClass('active');

                    //let dados = $("body").find('#coparticipacao_sim');


                });
            })

            $('#cadastrarContratoModal').on('hidden.bs.modal', function (event) {
                $('#cadastrar_pessoa_fisica_formulario_modal_coletivo').each(function(){
                    this.reset();
                    //$("#coparticipacao_sim").removeClass('active');
                    //$("#coparticipacao_nao").removeClass('active');

                    //let dados = $("body").find('#coparticipacao_sim');


                });
            });

            $("#cadastrarEmpresarial").on('hidden.bs.modal', function (event) {
                $('#cadastrar_dados_empresarial').each(function(){
                    this.reset();
                    //$("#coparticipacao_sim").removeClass('active');
                    //$("#coparticipacao_nao").removeClass('active');

                    //let dados = $("body").find('#coparticipacao_sim');


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

            $(".list_abas li").on('click',function(){
                $('li').removeClass('ativo');
                $(this).addClass("ativo");
                let id = $(this).attr('data-id');
                $('.conteudo_abas main').addClass('ocultar');
                $('#'+id).removeClass('ocultar');
                limparTudo();
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


            var taindividual = $(".listarindividual").DataTable({
                dom: '<"d-flex justify-content-between"<"#title_individual">ft><t><"d-flex justify-content-between"lp>',
                "language": {
                    "url": "{{asset('traducao/pt-BR.json')}}"
                },
                ajax: {
                    "url":"{{ route('financeiro.individual.em_analise') }}",
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
                    {data:"clientes.nome",name:"cliente"},
                    {data:"data_boleto",name:"Vencimento"},
                    {data:"financeiro.nome",name:"financeiro"},
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
                            let palavras = cellData.ucWords();
                            $(td).html(palavras)
                        }
                    },
                    {
                        "targets": 3,
                        "width":"15%",
                        "createdCell": function (td, cellData, rowData, row, col) {
                            
                            let alvo = cellData.split("-").reverse().join("/");
                            $(td).html(alvo);
                        }
                            
                    },
                    {
                        "targets": 4,
                        "width":"15%",
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
                    }
               ],
                
                "initComplete": function( settings, json ) {
                    $('#title_individual').html("<h4>Individual</h4>");

                     this.api()
                       .columns([1])
                       .every(function () {
                            var column = this;
                            var selectUsuarioIndividual = $("#select_usuario_individual");
                            selectUsuarioIndividual.on('change',function(){
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                if(val != "todos") {
                                    column.search(val ? '^' + val + '$' : '', true, false).draw();    
                                } else {
                                    var val = "";
                                    column.search(val ? '^' + val + '$' : '', true, false).draw();
                                }
                                
                            });

                            column.data().unique().sort().each(function (d, j) {
                                selectUsuarioIndividual.append('<option value="' + d + '">' + d + '</option>');
                            });
                       })
                }
            });

            $(".listardados").DataTable({
                dom: '<"d-flex justify-content-between"<"#title_coletivo_por_adesao_table">ft><t><"d-flex justify-content-between"lp>',
                "language": {
                    "url": "{{asset('traducao/pt-BR.json')}}"
                },
                ajax: {
                    "url":"{{ route('contratos.listarColetivoPorAdesao') }}",
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
                    {data:"data_boleto",name:"Vencimento"},
                    {data:"financeiro.nome",name:"administradora"},
                ],
                "columnDefs": [
                    {
                        /** Data*/
                        "targets": 0,
                        "createdCell": function (td, cellData, rowData, row, col) {
                            let datas = cellData.split("T")[0]
                            let alvo = datas.split("-").reverse().join("/")
                            $(td).html(alvo)    
                        }
                        
                    },
                    /*Corretor*/
                    {
                        "targets": 1,
                        "width":"30%",
                        "createdCell": function (td, cellData, rowData, row, col) {
                            let palavra = cellData.split(" ");
                            if(palavra.length >= 3) {
                                $(td).html(palavra[0]+" "+palavra[1]+"...")
                            }
                        }
                    },
                    /*Administradora*/
                    {
                        "targets": 2
                    },
                    /*Cliente*/
                    {
                        "targets": 3,
                        "width":"30%"
                        
                    },
                    /*Vencimento*/
                    {
                        "targets": 4,        
                        "createdCell": function (td, cellData, rowData, row, col) {
                            if(cellData) {
                                let alvo = cellData.split("-").reverse().join("/");
                                $(td).html(alvo);        
                            }
                            
                        },
                    },
                    /*Status*/
                    {
                        "targets": 5,
                        "width":"28%"
                    },
               ],              
                "initComplete": function( settings, json ) {
                    $('#title_coletivo_por_adesao_table').html("<h4>Coletivo Por Adesão</h4>");
                    this.api()
                       .columns([1])
                       .every(function () {
                            var column = this;
                            var selectUsuario = $("#select_usuario");
                            selectUsuario.on('change',function(){
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                if(val != "todos") {
                                    column.search(val ? '^' + val + '$' : '', true, false).draw();    
                                } else {
                                    var val = "";
                                    column.search(val ? '^' + val + '$' : '', true, false).draw();
                                }
                                
                            });

                            column.data().unique().sort().each(function (d, j) {
                                selectUsuario.append('<option value="' + d + '">' + d + '</option>');
                            });
                       })


                    this.api()
                       .columns([2])
                       .every(function () {
                            var column = this;
                            var selectAdministradora = $("#select_coletivo");
                            selectAdministradora.on('change',function(){
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                if(val != "todos") {
                                    column.search(val ? '^' + val + '$' : '', true, false).draw();    
                                } else {
                                    var val = "";
                                    column.search(val ? '^' + val + '$' : '', true, false).draw();
                                }
                                
                            });

                            column.data().unique().sort().each(function (d, j) {
                                selectAdministradora.append('<option value="' + d + '">' + d + '</option>');
                            });
                       })


                }
            });

            var table = $('#tabela_coletivo').DataTable();
            $('#tabela_coletivo').on('click', 'tbody tr', function () {
                table.$('tr').removeClass('textoforte');
                $(this).closest('tr').addClass('textoforte');
                let data = table.row(this).data();
                console.log(data);
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

                $('.div_info').attr('data-id',data.id);
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
            

            $(".listarempresarial").DataTable({
                dom: '<"d-flex justify-content-between"<"#title_empresarial">ft><t><"d-flex justify-content-between"lp>',
                "language": {
                    "url": "{{asset('traducao/pt-BR.json')}}"
                },
                ajax: {
                    "url":"{{ route('contratos.listarEmpresarial.analise') }}",
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
                    {data:"usuario",name:"usuario"},
                    {data:"razao_social",name:"razao_social"},
                    {data:"valor_plano",name:"valor_plano"},
                    {data:"vencimento_boleto",name:"vencimento"},
                ],
                "columnDefs": [
                    {
                        "targets": 0,
                        "width":"30%"
                    },

                    {
                        "targets": 0,
                        "width":"30%"
                    },


                    {
                        "targets": 2,
                        "width":"20%",
                        "createdCell": function (td, cellData, rowData, row, col) {
                            let formatado = Number(cellData).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});
                            // let datas = cellData.split("T")[0]
                            // let alvo = datas.split("-").reverse().join("/")
                            $(td).html(formatado);    
                        }
                    },
                    {
                        "targets": 3,
                        "width":"20%",
                        "createdCell": function (td, cellData, rowData, row, col) {
                            
                            let alvo = cellData.split("-").reverse().join("/")
                            $(td).html(alvo);
                        }
                    },
               ],
                
                "initComplete": function( settings, json ) {
                    $('#title_empresarial').html("<h4>Empresarial</h4>");
                     this.api()
                       .columns([0])
                       .every(function () {
                            var column = this;
                            var selectUsuarioIndividual = $("#mudar_user_empresarial");
                            selectUsuarioIndividual.on('change',function(){
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                if(val != "todos") {
                                    column.search(val ? '^' + val + '$' : '', true, false).draw();    
                                } else {
                                    var val = "";
                                    column.search(val ? '^' + val + '$' : '', true, false).draw();
                                }
                                
                            });

                            column.data().unique().sort().each(function (d, j) {
                                selectUsuarioIndividual.append('<option value="' + d + '">' + d + '</option>');
                            });
                       })
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

            $(".div_info").on('click',function(){
                let contrato = $(this).attr('data-id');
                $.ajax({
                    url:"{{route('contratos.info')}}",
                    data:"contrato="+contrato,
                    method:"POST",
                    success:function(res) {
                        $('.container_div_info').html(res);
                    }
                });
                $('.container_div_info').toggle();
                return false;
            });

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
                console.log(id_lista);
                if(id_lista == "em_analise_coletivo") {
                    $('#title_coletivo_por_adesao_table').html("<h4>Em Análise</h4>");
                    table.ajax.url("{{ route('financeiro.coletivo.em_analise') }}").load();
                    //limparFormulario()
                } else if(id_lista == "emissao_boleto_coletivo") {
                    $('#title_coletivo_por_adesao_table').html("<h4>Emissão Boleto</h4>");
                    table.ajax.url("{{ route('financeiro.coletivo.emissao_boleto') }}").load();
                    //limparFormulario();
                } else if(id_lista == "pagamento_adesao_coletivo") {
                    $('#title_coletivo_por_adesao_table').html("<h4>Pagamento Adesão</h4>");
                    table.ajax.url("{{ route('financeiro.coletivo.pagamento_adesao') }}").load();
                    //limparFormulario();
                  
                } else if(id_lista == "pagamento_vigencia_coletivo") {
                    $('#title_coletivo_por_adesao_table').html("<h4>Pagamento Vigência</h4>");
                    table.ajax.url("{{ route('financeiro.coletivo.pagamento_vigencia') }}").load();
                    
                //     limparFormulario();
                } else if(id_lista == "pagamento_segunda_parcela") {
                    $('#title_coletivo_por_adesao_table').html("<h4>Pagamento 2º Parcela</h4>");
                    table.ajax.url("{{ route('financeiro.coletivo.pagamento_segunda_parcela') }}").load();
                    
                //     limparFormulario();
                } else if(id_lista == "pagamento_terceira_parcela") {
                    $('#title_coletivo_por_adesao_table').html("<h4>Pagamento 3º Parcela</h4>");
                    table.ajax.url("{{ route('financeiro.coletivo.pagamento_terceira_parcela') }}").load();
                    
                    
                //     limparFormulario();
                } else if(id_lista == "pagamento_quarta_parcela") {
                    $('#title_coletivo_por_adesao_table').html("<h4>Pagamento 4º Parcela</h4>");
                    table.ajax.url("{{ route('financeiro.coletivo.pagamento_quarta_parcela') }}").load();
                   
                    
                //     limparFormulario();
                } else if(id_lista == "pagamento_quinta_parcela") {
                    $('#title_coletivo_por_adesao_table').html("<h4>Pagamento 5º Parcela</h4>");
                    table.ajax.url("{{ route('financeiro.coletivo.pagamento_quinta_parcela') }}").load();
                    
                //     limparFormulario();
                } else if(id_lista == "pagamento_sexta_parcela") {
                    $('#title_coletivo_por_adesao_table').html("<h4>Pagamento 6º Parcela</h4>");
                    table.ajax.url("{{ route('financeiro.coletivo.pagamento_sexta_parcela') }}").load();
                    
                    
                //     limparFormulario();
                } else if(id_lista == "finalizado_coletivo") {
                    $('#title_coletivo_por_adesao_table').html("<h4>Finalizado</h4>");
                    table.ajax.url("{{ route('financeiro.coletivo.pagamento_sexta_parcela') }}").load();
                    
                //     limparFormulario();

                } else if(id_lista == "cancelado_coletivo") {
                    $('#title_coletivo_por_adesao_table').html("<h4>Cancelado</h4>");
                    table.ajax.url("{{ route('financeiro.coletivo.pagamento_sexta_parcela') }}").load();
                    
                //     limparFormulario();
                // }
                } else {

                }
            });      


            $("ul#listar_individual li.individual").on('click',function(){
                let id_lista = $(this).attr('id');
                
                if(id_lista == "aguardando_em_analise_individual") {
                    $('#title_individual').html("<h4>Em Análise</h4>");
                    table_individual.ajax.url("{{ route('financeiro.individual.em_analise') }}").load();
                    
                    //limparFormulario()
                } else if(id_lista == "aguardando_pagamento_1_parcela_individual") {
                    $('#title_individual').html("<h4>Pag. 1º Parcela</h4>");
                    table_individual.ajax.url("{{ route('financeiro.individual.pagamento_primeira_parcela') }}").load();
                    // $('.button_individual').empty().html(
                    //     '<button class="btn btn-danger w-50 mr-2 cancelar_individual">Cancelar</button>'+
                    //     '<button class="btn btn-success w-50 emissao_boleto next_individual">Pag. 1º Parcela</button>'
                    // );                      
                    // $(".container_edit").addClass('ocultar')
                    // adicionarReadonly();
                    // limparFormulario();
                } else if(id_lista == "aguardando_pagamento_2_parcela_individual") {
                    $('#title_individual').html("<h4>Pag. 2º Parcela</h4>");
                    table_individual.ajax.url("{{ route('financeiro.individual.pagamento_segunda_parcela') }}").load();
                    // $('.button_individual').empty().html(
                    //     '<button class="btn btn-danger w-50 mr-2 cancelar_individual">Cancelar</button>'+
                    //     '<button class="btn btn-success w-50 pagamento_adesao next_individual">Pag. 2º Parcela</button>'
                    // );
                    // $(".container_edit").addClass('ocultar')
                    // adicionarReadonly();
                    // limparFormulario();
                } else if(id_lista == "aguardando_pagamento_3_parcela_individual") {
                    $('#title_individual').html("<h4>Pag. 3º Parcela</h4>");
                    table_individual.ajax.url("{{ route('financeiro.individual.pagamento_terceira_parcela') }}").load();
                    // $('.button_individual').empty().html(
                    //     '<button class="btn btn-danger w-50 mr-2 cancelar_individual">Cancelar</button>'+
                    //     '<button class="btn btn-success w-50 pagamento_vegencia next_individual">Pag. 3º Parcela</button>'
                    // );
                    // $(".container_edit").addClass('ocultar')
                    // adicionarReadonly();
                    // limparFormulario();
                } else if(id_lista == "aguardando_pagamento_4_parcela_individual") {
                    $('#title_individual').html("<h4>Pag. 4º Parcela</h4>");
                    table_individual.ajax.url("{{ route('financeiro.individual.pagamento_quarta_parcela') }}").load();
                    // $('.button_individual').empty().html(
                    //     '<button class="btn btn-danger w-50 mr-2 cancelar_individual">Cancelar</button>'+
                    //     '<button class="btn btn-success w-50 pagamento_segunda_parcela next_individual">Pag. 4º Parcela</button>'
                    // );
                    // $(".container_edit").addClass('ocultar')
                    // adicionarReadonly();
                    // limparFormulario();
                } else if(id_lista == "aguardando_pagamento_5_parcela_individual") {
                    $('#title_individual').html("<h4>Pag. 5º Parcela</h4>");
                    table_individual.ajax.url("{{ route('financeiro.individual.pagamento_quinta_parcela') }}").load();
                    // $('.button_individual').empty().html(
                    //     '<button class="btn btn-danger w-50 mr-2 cancelar_individual">Cancelar</button>'+
                    //     '<button class="btn btn-success w-50 pagamento_terceira_parcela next_individual">Pag. 5º Parcela</button>'
                    // );
                    // $(".container_edit").addClass('ocultar')
                    // adicionarReadonly();
                    // limparFormulario();
                } else if(id_lista == "aguardando_pagamento_6_parcela_individual") {
                    $('#title_individual').html("<h4>Pag. 6º Parcela</h4>");
                    table_individual.ajax.url("{{ route('financeiro.individual.pagamento_sexta_parcela') }}").load();
                    // $('.button_individual').empty().html(
                    //     '<button class="btn btn-danger w-50 mr-2 cancelar_individual">Cancelar</button>'+
                    //     '<button class="btn btn-success w-50 pagamento_quarta_parcela next_individual">Pag. 6º Parcela</button>'
                    // );
                    // $(".container_edit").addClass('ocultar')
                    // adicionarReadonly();
                    // limparFormulario();
                } else if(id_lista == "finalizado_individual") {
                    $('#title_individual').html("<h4>Finalizado</h4>");
                    table_individual.ajax.url("{{ route('financeiro.individual.finalizado') }}").load();
                } else if(id_lista == "cancelado_individual") {
                    $('#title_individual').html("<h4>Cancelado</h4>");
                    table_individual.ajax.url("{{ route('financeiro.individual.cancelado') }}").load();
                } else {

                }
            });  
           

            $("ul#listar_empresarial li.empresarial").on('click',function(){
                let id_lista = $(this).attr('id');

                if(id_lista == "aguardando_em_analise_empresarial") {
                    $("#title_empresarial").html("<h4>Em Análise</h4>");
                    tableempresarial.ajax.url('{{route("contratos.listarEmpresarial.analise")}}').load();
                } else if(id_lista == "aguardando_pagamento_1_parcela_empresarial") {
                    $("#title_empresarial").html("<h4>Pagamento 1º Parcela</h4>");
                    tableempresarial.ajax.url('{{route("contratos.listarEmpresarial.primeiraparcela")}}').load();
                } else if(id_lista == "aguardando_pagamento_2_parcela_empresarial") {
                    $("#title_empresarial").html("<h4>Pagamento 2º Parcela</h4>");
                    tableempresarial.ajax.url('{{route("contratos.listarEmpresarial.segundaparcela")}}').load();
                } else if(id_lista == "aguardando_pagamento_3_parcela_empresarial") {
                    $("#title_empresarial").html("<h4>Pagamento 3º Parcela</h4>");
                    tableempresarial.ajax.url('{{route("contratos.listarEmpresarial.terceiraparcela")}}').load();
                } else if(id_lista == "aguardando_pagamento_4_parcela_empresarial") {
                    $("#title_empresarial").html("<h4>Pagamento 4º Parcela</h4>");
                    tableempresarial.ajax.url('{{route("contratos.listarEmpresarial.quartaparcela")}}').load();
                } else if(id_lista == "aguardando_pagamento_5_parcela_empresarial") {
                    $("#title_empresarial").html("<h4>Pagamento 5º Parcela</h4>");
                    tableempresarial.ajax.url('{{route("contratos.listarEmpresarial.quintaparcela")}}').load();
                } else if(id_lista == "aguardando_pagamento_6_parcela_empresarial") {
                    $("#title_empresarial").html("<h4>Pagamento 6º Parcela</h4>");
                    tableempresarial.ajax.url('{{route("contratos.listarEmpresarial.sextaparcela")}}').load();
                } else if(id_lista == "aguardando_finalizado_empresarial") {
                    $("#title_empresarial").html("<h4>Finalizado</h4>");
                    tableempresarial.ajax.url('{{route("contratos.listarEmpresarial.finalizado")}}').load();
                } else if(id_lista == "aguardando_cancelado_empresarial") {
                    $("#title_empresarial").html("<h4>Cancelado</h4>");
                    tableempresarial.ajax.url('{{route("contratos.listarEmpresarial.cancelado")}}').load();
                } else {

                }



                
            });
            




                  
            
           
            


            function limparTudo() {
                $('.coluna-right').find("input[type='text']").val('');
                $('tr').removeClass('textoforte');
                $('li').prop('data-id','');
                $('select').prop('selectedIndex',0);
                //table.ajax.reload();

                //table_individual.ajax.reload();
                //taindividual.ajax.reload();

                //table_individual.api().ajax.reload();
                //table_individual.api().ajax.reload();
                //taindividual.ajax.reload();    
                //table_individual.ajax.reload();

                // $('#tabela_individual').DataTable().ajax.reload();
                // $('#tabela_individual').DataTable().ajax.reload()

                // $('#tabela_individual').dataTable().api().ajax.reload();

                // taindividual.ajax.reload( null, false );
                // table_individual.ajax.reload( null, false );

                
                
                //tableempresarial.ajax.reload();
            }







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
        .textoforte {background-color:rgba(255,255,255,0.5);color:black;}
        .botao:hover {background-color: rgba(0,0,0,0.5) !important;color:#FFF !important;}
        .valores-acomodacao {background-color:#123449;color:#FFF;width:32%;box-shadow:rgba(0,0,0,0.8) 0.6em 0.7em 5px;}
        .valores-acomodacao:hover {cursor:pointer;box-shadow: none;}
        .table thead tr {background-color:#123449;color: white;}
        .destaque {border:4px solid rgba(36,125,157);}
        #coluna_direita {flex-basis:10%;background-color:#123449;border-radius: 5px;}
        #coluna_direita ul {list-style: none;margin: 0;padding: 0;}
        #coluna_direita li {color:#FFF;}
        .coluna-right {flex-basis:30%;flex-wrap: wrap;border-radius:5px;height:720px;}
        .container_div_info {
            background-color:rgba(0,0,0,1);position:absolute;width:500px;right:0px;top:57px;min-height: 700px;
            display: none;z-index: 1;color: #FFF;
        }
        #padrao {
            width:50px;background-color:#FFF;color:#000;
        }
    </style>
@stop




