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





                        <ul style="margin:0;padding:0;list-style:none;" id="listar">
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_boleto_coletivo" class="fundo">
                                <span>Em Análise</span>
                               <span class="badge badge-light" style="width:45px;text-align:right;">1</span>                        
                            </li>

                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_boleto_coletivo" class="fundo">
                                <span>Pagamento 1º Parcela</span>
                               <span class="badge badge-light" style="width:45px;text-align:right;">100</span>                        
                            </li>

                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_boleto_coletivo" class="fundo">
                               <span>Pagamento 2º Parcela</span>
                               <span class="badge badge-light" style="width:45px;text-align:right;">1000</span>                        
                            </li>

                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_boleto_coletivo" class="fundo">
                               <span>Pagamento 3º Parcela</span>
                               <span class="badge badge-light" style="width:45px;text-align:right;">10000</span>                        
                            </li>

                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_boleto_coletivo" class="fundo">
                               <span>Pagamento 4º Parcela</span>
                               <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_individual_parcela_04}}</span>                        
                            </li>

                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_boleto_coletivo" class="fundo">
                               <span>Pagamento 5º Parcela</span>
                               <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_individual_parcela_05}}</span>                        
                            </li>

                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_boleto_coletivo" class="fundo">
                               <span>Pagamento 6º Parcela</span>
                               <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_individual_parcela_06}}</span>                        
                            </li>

                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_boleto_coletivo" class="fundo">
                               <span>Finalizado</span>
                               <span class="badge badge-light" style="width:45px;text-align:right;">0</span>                        
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
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_boleto_coletivo" class="fundo">
                                <span>Em Analise</span>
                                <span class="badge badge-light" style="width:45px;text-align:right;vertical-align: middle;">10</span>                        
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_pagamento_adesao_coletivo">
                                <span>Emissão Boleto</span>
                                <span class="badge badge-light" style="width:45px;text-align:right;">20</span>
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_pagamento_vigencia">
                                <span>Pagamento Adesão</span>
                                <span class="badge badge-light" style="width:45px;text-align:right;">30</span>
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_pagamento_vigencia">
                                <span>Pagamento Vigência</span>
                                <span class="badge badge-light" style="width:45px;text-align:right;">30</span>
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_pagamento_vigencia">
                                <span>Pagamento 2º Parcela</span>
                                <span class="badge badge-light" style="width:45px;text-align:right;">30</span>
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_pagamento_vigencia">
                                <span>Pagamento 3º Parcela</span>
                                <span class="badge badge-light" style="width:45px;text-align:right;">30</span>
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_pagamento_vigencia">
                                <span>Pagamento 4º Parcela</span>
                                <span class="badge badge-light" style="width:45px;text-align:right;">30</span>
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_pagamento_vigencia">
                                <span>Pagamento 5º Parcela</span>
                                <span class="badge badge-light" style="width:45px;text-align:right;">30</span>
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_pagamento_vigencia">
                                <span>Pagamento 6º Parcela</span>
                                <span class="badge badge-light" style="width:45px;text-align:right;">30</span>
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="finalizado_coletivo">
                                <span>Finalizado</span>
                                <span class="badge badge-light" style="width:45px;text-align:right;">30</span>
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

                        



                        <ul style="margin:0;padding:0;list-style:none;" id="listar">
                            
                           <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_boleto_coletivo"  style="">
                                <span>Em Análise</span>
                               <span class="badge badge-light" style="width:45px;text-align:right;">1</span>                        
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_boleto_coletivo" class="fundo">
                                <span>Pagamento Adesão</span>
                               <span class="badge badge-light" style="width:45px;text-align:right;">100</span>                        
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_boleto_coletivo" class="fundo">
                               <span>Pagamento 2º Parcela</span>
                               <span class="badge badge-light" style="width:45px;text-align:right;">1000</span>                        
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_boleto_coletivo" class="fundo">
                               <span>Pagamento 3º Parcela</span>
                               <span class="badge badge-light" style="width:45px;text-align:right;">10000</span>                        
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_boleto_coletivo" class="fundo">
                               <span>Pagamento 4º Parcela</span>
                               <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_individual_parcela_04}}</span>                        
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_boleto_coletivo" class="fundo">
                               <span>Pagamento 5º Parcela</span>
                               <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_individual_parcela_05}}</span>                        
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_boleto_coletivo" class="fundo">
                               <span>Pagamento 6º Parcela</span>
                               <span class="badge badge-light" style="width:45px;text-align:right;">{{$qtd_individual_parcela_06}}</span>                        
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_boleto_coletivo" class="fundo">
                               <span>Finalizado</span>
                               <span class="badge badge-light" style="width:45px;text-align:right;">0</span>                        
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
                    "url":"{{ route('contratos.listarIndividual') }}",
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
                        "width":"15%"
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
                       .columns([3])
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
                dom: '<"d-flex justify-content-between"<"#title_ladingpage">ft><t><"d-flex justify-content-between"lp>',
                "language": {
                    "url": "{{asset('traducao/pt-BR.json')}}"
                },
                ajax: {
                    "url":"{{ route('contratos.listarEmpresarial') }}",
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
                    $('#title_ladingpage').html("<h4>Listagem Empresarial</h4>");
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

            $('.estilo_btn_plus_coletivo').on('click',function(){
                $('#cadastrarContratoModal').modal('show');
            });

            $('.estilo_btn_plus_individual').on('click',function(){
                $("#cadastrarIndividualModal").modal('show');
            });

            $('.estilo_btn_plus_ss').on('click',function(){
                $("#cadastrarEmpresarial").modal('show'); 
            });

           


            




                  
            //$('#valor_adesao').mask("#.##0,00", {reverse: true});
            $("#cpf").on('change',function(){
                if($(this).val != "" && TestaCPF($(this).val())) {
                    $('.errorcpf').html("");
                }
            });
            
            $("#data_nascimento").on('change',function(){
                if($(this).val() != "") {
                    $('.errordatanascimento').html("");
                }
            });

            $("#operadora").on('change',function(){
                if($(this).val() != "") {
                    $(".erroroperadora").html("");
                } 
            });

            $("#administradora").on('change',function(){
                if($(this).val() != "") {
                    $(".erroradministradora").html("");
                }
            })
           
            
            /** Quando clicar no card pegar os campos valor do plano e tipo(Apartamento,Enfermaria...) */
            $('body').on('click','.valores-acomodacao',function(e){
                let valor_plano = $(this).find('.valor_plano').text().replace("R$ ","");
                let tipo = $(this).find('.tipo').text();
                $("#valor").val(valor_plano);
                $("#acomodacao").val(tipo);
                if(!$(this).hasClass('destaque')) {
                    $('#data_vigencia').val('')
                    $('#data_boleto').val('');
                    $('#valor_adesao').val('');
                }
                $(".valores-acomodacao").removeClass('destaque');
                $(this).addClass('destaque');
                $('#animate').animate({
                    scrollTop:$(window).scrollTop() + $(window).height(),
                },1500);
                $("#btn_submit").html("<button type='submit' class='btn btn-block btn-light my-4 salvar_contrato'>Salvar Contrato</button>")
                $('.valores-acomodacao').not('.destaque').each(function(i,e){
                    $(e).find('.vigente').val('')
                    $(e).find('.boleto').val('')
                    $(e).find('.valor_adesao').val('')
                });
                if($(e.target).is('.form-control')) {
                    return;
                } 
            });


            

            $("#administradora").on('change',function(){
               let id = $(this).val();
               $.ajax({
                    url:"",
                    data:"administradora="+id,
                    method:"POST",
                    success:function(res) {
                        if(res.planos.length >= 1) {
                            let selecionado = null;
                            if($("#plano").val()) {
                                selecionado = $("#plano").val();
                            } 
                            $("#plano").html("");
                            $("#plano").prepend("<option value=''>--Escolher um Plano--</option>");
                            $(res.planos).each(function(index,value){
                                $("#plano").append($(`<option ${value.id == selecionado ? 'selected' : ''}>`).val(value.id).text(value.nome));
                            });
                        } else {
                            $("#plano").html("");
                            $("#plano").append('<option value="">--Esta administradora não possui planos cadastradas--</option>');
                        }
                    }    
               });
            });

           
                       
            

            
            $('body').on('click','#coparticipacao_sim > #coparticipacao_radio_sim',function(){
                $("#change_coparticipacao").val($(this).val()).trigger('change');
            });
            $('body').on('click','#coparticipacao_nao > #coparticipacao_radio_nao',function(){
                $("#change_coparticipacao").val($(this).val()).trigger('change');
            });
            $('body').on('click','#odonto_sim > #odonto_radio_sim',function(){
                $("#change_odonto").val($(this).val()).trigger('change');
            });
            $('body').on('click','#odonto_nao > #odonto_radio_nao',function(){
                $("#change_odonto").val($(this).val()).trigger('change');
            });    



            /****Mostrar Plano Inidividual****/

            $("body").find('form[name="cadastrar_pessoa_fisica_formulario_individual"]').on("click","#mostrar_plano_individual",function(){

                if($("#users_individual").val() == "") {
                    toastr["error"]("Corretor é campo obrigatório")
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    return false;
                }

                if($("#tabela_origem_individual").val() == "") {
                    toastr["error"]("Tabela Origem é campo obrigatório")
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    return false;
                }



                if($("#nome_individual").val() == "") {
                    toastr["error"]("Titular é campo obrigatório")
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    return false;
                 }

                 if($("#cpf_individual").val() == "") {
                    toastr["error"]("CPF é obrigatório")
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    return false;
                 }

                 if($("#data_nascimento_individual").val() == "") {
                    toastr["error"]("Data Nascimento campo obrigatório")
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    return false;
                 }

                 if($("#email_individual").val() == "") {
                    toastr["error"]("Email campo obrigatório")
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    return false;
                 }

                 if($("#telefone_individual").val() == "") {
                    toastr["error"]("Celular é campo obrigatório")
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    return false;
                }

                if($("#tabela_origem_individual").val() == "") {
                    toastr["error"]("Tabela Origem campo obrigatório")
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    return false;
                 }
                
                 
                 if($("#cep_individual").val() == "") {
                    toastr["error"]("Cep é campo obrigatório")
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    return false;
                 }

                  if($("#bairro_individual").val() == "") {
                    toastr["error"]("Bairro é campo obrigatório")
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    return false;
                 }

                 if($("#rua_individual").val() == "") {
                    toastr["error"]("Rua é campo obrigatório")
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    return false;
                 }

                  if($("#cidade_origem_individual").val() == "") {
                    toastr["error"]("Cidade é campo obrigatório")
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    return false;
                 }

                 if($("#uf_individual").val() == "") {
                    toastr["error"]("UF é campo obrigatório")
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    return false;
                 }

                 if($("#codigo_externo_individual_cadastrar").val() == "") {
                    toastr["error"]("Codigo Externo é campo obrigatório")
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    return false;
                 }

                if(!$('input:radio[name=coparticipacao_individual]').is(':checked')) {
                    toastr["error"]("Coparticipação é campo obrigatório")
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    return false;  
                } 

                if(!$('input:radio[name=odonto_individual]').is(':checked')) {
                    toastr["error"]("Odonto é campo obrigatório")
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    return false;  
                } 

                if(
                    $("#faixa-input-0-18_individual").val() == "" && 
                    $("#faixa-input-19-23_individual").val() == "" && 
                    $("#faixa-input-24-28_individual").val() == "" && 
                    $("#faixa-input-29-33_individual").val() == "" && 
                    $("#faixa-input-34-38_individual").val() == "" && 
                    $("#faixa-input-39-43_individual").val() == "" && 
                    $("#faixa-input-44-48_individual").val() == "" && 
                    $("#faixa-input-49-53_individual").val() == "" && 
                    $("#faixa-input-54-58_individual").val() == "" && 
                    $("#faixa-input-59_individual").val() == ""
                ) {
                    toastr["error"]("Preencher pelo menos 1 faixa etaria")
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    return false;  
                }    

                let data = {
                    user:$("#users_individual").val(),
                    tabela_origens_id:$("#tabela_origem_individual").val(),
                    nome:$("#nome_individual").val(),
                    cpf:$("#cpf_individual").val(),
                    data_nascimento:$("#data_nascimento_individual").val(),
                    email:$("#email_individual").val(),
                    celular:$('#telefone_individual').val(),
                    cep:$("#cep_individual").val(),
                    cidade:$("#cidade_origem_individual").val(),
                    bairro:$("#bairro_individual").val(),
                    rua:$("#rua_individual").val(),
                    complemento:$("#complemento_individual").val(),
                    uf:$("#uf_individual").val(),
                    dependente:$('#dependente_individual').is(':checked'),
                    responsavel_financeiro:$("#responsavel_financeiro_individual_cadastro").val(),
                    cpf_responsavel_financeiro:$("#cpf_financeiro_individual_cadastro").val(),
                    codigo_externo:$("#codigo_externo_individual_cadastrar").val(),
                    coparticipacao: $("input:radio[name=coparticipacao_individual]:checked").val(),
                    odonto: $('input:radio[name=odonto_individual]:checked').val(), 
                    faixas: {'1': $("#faixa-input-0-18_individual").val(), '2': $("#faixa-input-19-23_individual").val(),'3': $("#faixa-input-24-28_individual").val(),'4': $("#faixa-input-29-33_individual").val(),'5': $("#faixa-input-34-38_individual").val(),'6': $("#faixa-input-39-43_individual").val(),'7': $("#faixa-input-44-48_individual").val(),'8': $("#faixa-input-49-53_individual").val(),'9': $("#faixa-input-54-58_individual").val(),'10': $("#faixa-input-59_individual").val()}
                };
                montarValoresIndividual(data);
                return false;
            });

            /****Fim Mostrar Plano Inidividual****/

            $("body").find('form[name="cadastrar_pessoa_fisica_formulario_modal_coletivo"]').on("click","#mostrar_plano_coletivo",function(){
                 if($("#nome_coletivo").val() == "") {
                    toastr["error"]("Titular é campo obrigatório")
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    return false;
                 }

                 if($("#cpf_coletivo").val() == "") {
                    toastr["error"]("CPF é obrigatório")
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    return false;
                 }

                 if($("#data_nascimento_coletivo").val() == "") {
                    toastr["error"]("Data Nascimento campo obrigatório")
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    return false;
                 }

                 if($("#email_coletivo").val() == "") {
                    toastr["error"]("Email campo obrigatório")
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    return false;
                 }

                 if($("#tabela_origem_coletivo").val() == "") {
                    toastr["error"]("Tabela Origem campo obrigatório")
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    return false;
                 }


                 if($("#administradora_coletivo").val() == "") {
                    toastr["error"]("Administradora é campo obrigatório")
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    return false;
                 }

                if($("#plano_coletivo").val() == "") {
                    toastr["error"]("Plano é campo obrigatório")
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    return false;
                 }
                 
                 if($("#cep_coletivo").val() == "") {
                    toastr["error"]("Cep é campo obrigatório")
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    return false;
                 }

                  if($("#bairro_coletivo").val() == "") {
                    toastr["error"]("Bairro é campo obrigatório")
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    return false;
                 }

                 if($("#rua_coletivo").val() == "") {
                    toastr["error"]("Rua é campo obrigatório")
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    return false;
                 }

                  if($("#cidade_coletivo").val() == "") {
                    toastr["error"]("Cidade é campo obrigatório")
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    return false;
                 }

                 if($("#uf_coletivo").val() == "") {
                    toastr["error"]("UF é campo obrigatório")
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    return false;
                 }

                 if($("#codigo_externo_coletivo").val() == "") {
                    toastr["error"]("Codigo Externo é campo obrigatório")
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    return false;
                 }

                if(!$('input:radio[name=coparticipacao_coletivo]').is(':checked')) {
                    toastr["error"]("Coparticipação é campo obrigatório")
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    return false;  
                } 

                if(!$('input:radio[name=odonto_coletivo]').is(':checked')) {
                    toastr["error"]("Odonto é campo obrigatório")
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    return false;  
                } 

                if(
                    $("#faixa-input-0-18_coletivo").val() == "" && 
                    $("#faixa-input-19-23_coletivo").val() == "" && 
                    $("#faixa-input-24-28_coletivo").val() == "" && 
                    $("#faixa-input-29-33_coletivo").val() == "" && 
                    $("#faixa-input-34-38_coletivo").val() == "" && 
                    $("#faixa-input-39-43_coletivo").val() == "" && 
                    $("#faixa-input-44-48_coletivo").val() == "" && 
                    $("#faixa-input-49-53_coletivo").val() == "" && 
                    $("#faixa-input-54-58_coletivo").val() == "" && 
                    $("#faixa-input-59_coletivo").val() == ""
                ) {
                    toastr["error"]("Preencher pelo menos 1 faixa etaria")
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    return false;  
                }    

                let data = {
                    user:$("#usuario_coletivo_switch").val(),
                    administradora: $("#administradora_coletivo :checked").val(),
                    tabela_origens_id:$("#tabela_origem_coletivo").val(),
                    nome:$("#nome_coletivo").val(),
                    cpf:$("#cpf_coletivo").val(),
                    data_nascimento:$("#data_nascimento_coletivo").val(),
                    email:$("#email_coletivo").val(),
                    celular:$("#celular").val(),
                    cep:$("#cep_coletivo").val(),
                    cidade:$("#cidade_origem_coletivo").val(),
                    bairro:$("#bairro_coletivo").val(),
                    rua:$("#rua_coletivo").val(),
                    complemento:$("#complemento_coletivo").val(),
                    uf: $("#uf_coletivo").val(),
                    codigo_externo:$("#codigo_externo_coletivo").val(),
                    dependente:$('#dependente_coletivo').is(':checked'),
                    responsavel_nome:$("#responsavel_financeiro_coletivo_cadastrar_nome").val(),
                    responsavel_cpf:$("#responsavel_financeiro_coletivo_cadastrar_cpf").val(),   
                    coparticipacao: $("input:radio[name=coparticipacao_coletivo]:checked").val(),
                    odonto: $('input:radio[name=odonto_coletivo]:checked').val(), 
                    plano:$("#plano_coletivo").val(),
                    faixas: {'1': $("#faixa-input-0-18_coletivo").val(), '2': $("#faixa-input-19-23_coletivo").val(),'3': $("#faixa-input-24-28_coletivo").val(),'4': $("#faixa-input-29-33_coletivo").val(),'5': $("#faixa-input-34-38_coletivo").val(),'6': $("#faixa-input-39-43_coletivo").val(),'7': $("#faixa-input-44-48_coletivo").val(),'8': $("#faixa-input-49-53_coletivo").val(),'9': $("#faixa-input-54-58_coletivo").val(),'10': $("#faixa-input-59_coletivo").val()}
                };
 
                //console.log(data);
                montarValores(data);

                 
                 



            //     $("#change_plano").val($(this).val());

            //     if($("#nome").val() == "") {
            //         $("#change_plano").val($(this).val())
                    
            //         toastr["error"]("Nome do Titular e campo obrigatório")
            //             toastr.options = {
            //                 "closeButton": false,
            //                 "debug": false,
            //                 "newestOnTop": false,
            //                 "progressBar": false,
            //                 "positionClass": "toast-top-right",
            //                 "preventDuplicates": false,
            //                 "onclick": null,
            //                 "showDuration": "300",
            //                 "hideDuration": "1000",
            //                 "timeOut": "5000",
            //                 "extendedTimeOut": "1000",
            //                 "showEasing": "swing",
            //                 "hideEasing": "linear",
            //                 "showMethod": "fadeIn",
            //                 "hideMethod": "fadeOut"
            //             }
            //             return false;


            //         return false;
            //     } else {
            //         $('.errorcliente').html("");
            //     }
                
            //     if($("#cpf").val() == "") {
            //         $("#change_plano").val($(this).val())
            //         $('.errorcpf').html("<p class='alert alert-danger'>CPF é obrigatório<p>");
            //         return false;
            //     } else {
            //         $('.errorcpf').html("");
            //     }             
                
            //     // if(!TestaCPF($("#cpf").val())) {
            //     //     $("#change_plano").val($(this).val())
            //     //     $('.errorcpf').html("<p class='alert alert-danger'>CPF Invalido<p>");
            //     //     return false;
            //     // } else {
            //     //     $('.errorcpf').html("");            
            //     // }

            //     if($("#data_nascimento").val() == "") {
            //         $("#change_plano").val($(this).val())
            //         //$(this).val('');
            //         $('.errordatanascimento').html("<p class='alert alert-danger'>Data é obrigatório<p>");
            //         return false;
            //     } else {
            //         $('.errordatanascimento').html("");
            //     }

            //     if($("#email").val() == "") {
            //         $("#change_plano").val($(this).val())
            //         //$(this).val('');
            //         $('.erroremail').html("<p class='alert alert-danger'>Email é obrigatório</p>")
            //         return false;
            //     } else {
            //         $(".erroremail").html("");
            //     }

            //     if($("#cidade").val() == "") {
            //         $("#change_plano").val($(this).val())
            //         //$(this).val('');
            //         $('.errorcidade').html("<p class='alert alert-danger'>Cidade é obrigatório<p>");
            //         return false;
            //     } else {
            //         $('.change_cidade').val($("#cidade").val());
            //         $(".errorcidade").html("");
            //     }

                

            //     if($("#administradora").val() == "") {
            //         $("#change_plano").val($(this).val())
            //         //$(this).val('');
            //         $('.erroradministradora').html("<p class='alert alert-danger' style='font-size:0.8em;'>Administradora é obrigatório<p>");
            //         return false;
            //     } else {
            //         $('#change_administradora').val($("#administradora").val());
            //         $('.erroradministradora').html("");
            //     }

            //     // if($("#responsavel_financeiro").val() == "") {
            //     //     $("#change_plano").val($(this).val())
            //     //     //$(this).val('');
            //     //     $('.errorresponsavelfinanceiro').html("<p class='alert alert-danger'>Este e campo obrigatório</p>")
            //     //     return false;
            //     // } else {
            //     //     $(".errorresponsavelfinanceiro").html("");
            //     // }

            //     // if($("#cpf_financeiro").val() == "") {
            //     //     $("#change_plano").val($(this).val())
            //     //     //$(this).val('');
            //     //     $('.errorcpfresponsavelfinanceiro').html("<p class='alert alert-danger'>Este e campo obrigatório</p>")
            //     //     return false;
            //     // } else {
            //     //     $(".errorcpfresponsavelfinanceiro").html("");
            //     // }

            //     if($("#cep").val() == "") {
                    
            //         $('.errorcep').html("<p class='alert alert-danger'>CEP é obrigatório</p>")
            //         return false;
            //     } else {
            //         $(".errorcep").html("");
            //     }

            //     if($("#bairro").val() == "") {
                    
            //         $('.errorbairro').html("<p class='alert alert-danger'>Bairro é obrigatório</p>")
            //         return false;
            //     } else {
            //         $(".errorbairro").html("");
            //     }

            //     if($("#rua").val() == "") {
            //         $('.errorlogradouro').html("<p class='alert alert-danger'>Rua é obrigatório</p>")
            //         return false;
            //     } else {
            //         $(".errorlogradouro").html("");
            //     }

            //     if($("#rua").val() == "") {
            //         $('.errorlogradouro').html("<p class='alert alert-danger'>Rua é obrigatório</p>")
            //         return false;
            //     } else {
            //         $(".errorlogradouro").html("");
            //     }

            //     if($("#uf").val() == "") {
            //         $('.erroruf').html("<p class='alert alert-danger'>UF é obrigatório</p>")
            //         return false;
            //     } else {
            //         $(".erroruf").html("");
            //     }

            //     if($("#plano").val() == "") {
            //         //$("#change_plano").val($(this).val())
            //         //$(this).val('');
            //         $('.errorplano').html("<p class='alert alert-danger'>Plano é obrigatório</p>")
            //         return false;
            //     } else {
            //         $(".errorplano").html("");
            //     }

                

                

            //     if($("#codigo_externo").val() == "") {
            //         $("#change_plano").val($(this).val())
            //         //$(this).val('');
            //         $('.errorcodigo').html("<p class='alert alert-danger'>Código é obrigatório<p>");
            //         return false;
            //     } else {
            //         $('.errorcodigo').html('');
            //     }

            //     if(
            //         $("#faixa-input-0-18").val() == "" && 
            //         $("#faixa-input-19-23").val() == "" && 
            //         $("#faixa-input-24-28").val() == "" && 
            //         $("#faixa-input-29-33").val() == "" && 
            //         $("#faixa-input-34-38").val() == "" && 
            //         $("#faixa-input-39-43").val() == "" && 
            //         $("#faixa-input-44-48").val() == "" && 
            //         $("#faixa-input-49-53").val() == "" && 
            //         $("#faixa-input-54-58").val() == "" && 
            //         $("#faixa-input-59").val() == ""
            //     ) {
            //         $("#change_plano").val($(this).val())
            //         //$(this).val('');
            //         $('.errorfaixas').html("<p class='alert alert-danger'>Pelo Menos 1 faixa etária deve ser preenchida</p>")
            //         return false;
            //     } else {
            //         $("#change_faixa_0_18").val($("#faixa-input-0-18").val())    
            //         $("#change_faixa_19_23").val($("#faixa-input-19-23").val())    
            //         $("#change_faixa_24_28").val($("#faixa-input-24-28").val())    
            //         $("#change_faixa_29_33").val($("#faixa-input-29-33").val())    
            //         $("#change_faixa_34_38").val($("#faixa-input-34-38").val())    
            //         $("#change_faixa_39_43").val($("#faixa-input-39-43").val())    
            //         $("#change_faixa_44_48").val($("#faixa-input-44-48").val())    
            //         $("#change_faixa_49_53").val($("#faixa-input-49-53").val())    
            //         $("#change_faixa_54_58").val($("#faixa-input-54-58").val())    
            //         $("#change_faixa_59").val($("#faixa-input-59").val())    
            //         $('.errorfaixas').html("");
            //     }


            //     if(!$('input:radio[name=coparticipacao]').is(':checked')) {
            //         $("#change_plano").val($(this).val())
            //         //$(this).val('');
            //         $('.errorcoparticipacao').html("<p class='alert alert-danger'>Marque Sim/Não Coparticipaão</p>")
            //         return false;
            //     } else {                    
            //         $('.errorcoparticipacao').html("");
            //     }

            //     if(!$('input:radio[name=odonto]').is(':checked')) {
            //         $("#change_plano").val($(this).val())
            //         $('.errorodonto').html("<p class='alert alert-danger'>Marque Sim/Não Odonto</p>");
            //         return false;
            //     } else {
            //         $('.errorodonto').html("");
            //     }

            //     let data = {
            //         cliente_id:$("#cliente_id").val(),
            //         data_boleto:$("#data_boleto").val(),
            //         data_vigencia:$("#data_vigente").val(),
            //         uf: $("#uf").val(),
            //         cidade:$("#cidade").val(),
            //         operadora: $("#operadora").val(),
            //         administradora: $("#administradora").val(),
            //         coparticipacao: $("input:radio[name=coparticipacao]:checked").val(),
            //         odonto: $('input:radio[name=odonto]:checked').val(), 
            //         plano:$("#plano").val(),
            //         faixas: {'1': $("#faixa-input-0-18").val(), '2': $("#faixa-input-19-23").val(),'3': $("#faixa-input-24-28").val(),'4': $("#faixa-input-29-33").val(),'5': $("#faixa-input-34-38").val(),'6': $("#faixa-input-39-43").val(),'7': $("#faixa-input-44-48").val(),'8': $("#faixa-input-49-53").val(),'9': $("#faixa-input-54-58").val(),'10': $("#faixa-input-59").val()}
            //     };
            //     //console.log(data);
            //     montarValores(data);

            //     $("#vigente").datepicker({
            //     dateFormat: "dd/mm/yy",
            //     beforeShowDay: function (d) {
            //         var day = d.getDate();
            //         return [day == 5 || day == 10 || day == 15];
            //     },
            // });  



                return false;
            });


            // $("body").on('change','#acomodacao',function(){
            //     let valor = $(this).attr('data-valor');
            //     let atual = $(this);                
            //     if(atual.closest('.valores-acomodacao').find('#vigente').val() == "") {
            //         $("#change_plano").val($(this).val())
            //         atual.closest('.valores-acomodacao').find('.errordatavigente').html("<p class='alert alert-danger' style='font-size:0.79em;'>Este e campo obrigatório</p>");
            //         atual.prop('checked', false);
            //         return false;
            //     } else {
            //         atual.closest('.valores-acomodacao').find(".errordatavigente").html("");
            //     }

            //     if(atual.closest('.valores-acomodacao').find('#boleto').val() == "") {
            //         $("#change_plano").val($(this).val())
            //         atual.closest('.valores-acomodacao').find('.errordataboleto').html("<p class='alert alert-danger' style='font-size:0.79em;'>Este e campo obrigatório</p>");
            //         atual.prop('checked', false);
            //         return false;
            //     } else {
            //         atual.closest('.valores-acomodacao').find('.errordataboleto').html("");
            //     }

            //     if(atual.closest('.valores-acomodacao').find("#adesao").val() == "") {
            //         $("#change_plano").val($(this).val())
            //         atual.closest('.valores-acomodacao').find('.errorvaloradesao').html("<p class='alert alert-danger'>Este e campo obrigatório</p>");
            //         atual.prop('checked', false);
            //         return false;
            //     } else {
            //         atual.closest('.valores-acomodacao').find(".errorvaloradesao").html("");
            //     }


            //     $("#valor").val(valor);
            //     $('body,html').animate({
            //         scrollTop:"900px"
            //     },1000);
            //     $('.valores-acomodacao').css({"box-shadow":"none"});
            //     $(this).closest('.valores-acomodacao').css({"box-shadow": "10px 5px 5px black"})
            //     $("#btn_submit").html("<button type='submit' class='btn btn-block btn-outline-secondary my-4 salvar_contrato'>Salvar Contrato</button>")
            // }); 
            
            


            // $("body").on('change','#vigente',function(){                
            //     let data_vigencia = $(this).val();
            //     $("#data_vigencia").val(data_vigencia);
            // });

            $("body").on('change','input[name="boleto"]',function(){
                let data_boleto = $(this).val();
                
                $(this).closest('form').find('#data_boleto').val(data_boleto);

                //$("#data_boleto").val(data_boleto);
            });

            $("body").on('change','input[name="adesao"]',function(){
                let valor_adesao = $(this).val();
                $(this).closest('form').find('#valor_adesao').val(valor_adesao);
                
            });


            // $('body').on('change','.change_valores',function(){
            //     let data = {
            //         cliente_id:$("#cliente_id").val(),
            //         data_boleto:$("#data_boleto").val(),
            //         data_vigencia:$("#data_vigente").val(),
            //         cidade:$("#cidade").val(),
            //         operadora: $("#operadora").val(),
            //         administradora: $("#administradora").val(),
            //         coparticipacao: $("input[name='change_coparticipacao']").val(),
            //         odonto: $("input[name='change_odonto']").val(), 
            //         plano:$("#plano").val(),
            //         faixas: {'1': $("#faixa-input-0-18").val(), '2': $("#faixa-input-19-23").val(),'3': $("#faixa-input-24-28").val(),'4': $("#faixa-input-29-33").val(),'5': $("#faixa-input-34-38").val(),'6': $("#faixa-input-39-43").val(),'7': $("#faixa-input-44-48").val(),'8': $("#faixa-input-49-53").val(),'9': $("#faixa-input-54-58").val(),'10': $("#faixa-input-59").val()}
            //     };
            //     montarValores(data);
            // });

            // $('body').on('change','.change_plano',function(){
            //     let data = {
            //         cliente_id:$("#cliente_id").val(),
            //         data_boleto:$("#data_boleto").val(),
            //         data_vigencia:$("#data_vigente").val(),
            //         cidade:$("#cidade").val(),
            //         operadora: $("#operadora").val(),
            //         administradora: $("#administradora").val(),
            //         coparticipacao: $("input[name='change_coparticipacao']").val(),
            //         odonto: $("input[name='change_odonto']").val(), 
            //         plano:$("#plano").val(),
            //         faixas: {'1': $("#faixa-input-0-18").val(), '2': $("#faixa-input-19-23").val(),'3': $("#faixa-input-24-28").val(),'4': $("#faixa-input-29-33").val(),'5': $("#faixa-input-34-38").val(),'6': $("#faixa-input-39-43").val(),'7': $("#faixa-input-44-48").val(),'8': $("#faixa-input-49-53").val(),'9': $("#faixa-input-54-58").val(),'10': $("#faixa-input-59").val()}
            //     };
            //     montarValores(data);
            // });

            // $('body').on('change','.mudar_coparticipacao',function(){
            //     let data = {
            //         cliente_id:$("#cliente_id").val(),
            //         data_boleto:$("#data_boleto").val(),
            //         data_vigencia:$("#data_vigente").val(),
            //         cidade:$("#cidade").val(),
            //         operadora: $("#operadora").val(),
            //         administradora: $("#administradora").val(),
            //         coparticipacao: $("input[name='change_coparticipacao']").val(),
            //         odonto: $("input[name='change_odonto']").val(), 
            //         plano:$("#plano").val(),
            //         faixas: {
            //             '1': $("#faixa-input-0-18").val(), 
            //             '2': $("#faixa-input-19-23").val(),
            //             '3': $("#faixa-input-24-28").val(),
            //             '4': $("#faixa-input-29-33").val(),
            //             '5': $("#faixa-input-34-38").val(),
            //             '6': $("#faixa-input-39-43").val(),
            //             '7': $("#faixa-input-44-48").val(),
            //             '8': $("#faixa-input-49-53").val(),
            //             '9': $("#faixa-input-54-58").val(),
            //             '10': $("#faixa-input-59").val()}
            //     };
            //     montarValores(data);             
            // });

            // $('body').on('change','.mudar_odonto',function(){
            //     let data = {
            //         cliente_id:$("#cliente_id").val(),
            //         data_boleto:$("#data_boleto").val(),
            //         data_vigencia:$("#data_vigente").val(),
            //         cidade:$("#cidade").val(),
            //         operadora: $("#operadora").val(),
            //         administradora: $("#administradora").val(),
            //         coparticipacao: $("input[name='change_coparticipacao']").val(),
            //         odonto: $("input[name='change_odonto']").val(), 
            //         plano:$("#plano").val(),
            //         faixas: {'1': $("#faixa-input-0-18").val(), '2': $("#faixa-input-19-23").val(),'3': $("#faixa-input-24-28").val(),'4': $("#faixa-input-29-33").val(),'5': $("#faixa-input-34-38").val(),'6': $("#faixa-input-39-43").val(),'7': $("#faixa-input-44-48").val(),'8': $("#faixa-input-49-53").val(),'9': $("#faixa-input-54-58").val(),'10': $("#faixa-input-59").val()}
            //     };
            //     montarValores(data);             
            // });

            /*********************************************************** */
            // $('body').on('click','.change_valores_faixas',function(){
            //     let campo = $(this).closest(".content").find('input[type="tel"]').attr('data-change');
            //     let valor = $(this).closest(".content").find('input[type="tel"]').val();
            //     if(valor>0) {
            //         $('input[name="'+campo+'"]').val(valor);
            //     } else {
            //         $('input[name="'+campo+'"]').val('');
            //     }
            //     let data = {
            //         cliente_id:$("#cliente_id").val(),
            //         data_boleto:$("#data_boleto").val(),
            //         data_vigencia:$("#data_vigente").val(),
            //         cidade:$("#cidade").val(),
            //         operadora: $("#operadora").val(),
            //         administradora: $("#administradora").val(),
            //         coparticipacao: $("input[name='change_coparticipacao']").val(),
            //         odonto: $("input[name='change_odonto']").val(), 
            //         plano:$("#plano").val(),
            //         faixas: {'1': $("#change_faixa_0_18").val(), '2': $("#change_faixa_19_23").val(),'3': $("#change_faixa_24_28").val(),'4': $("#change_faixa_29_33").val(),'5': $("#change_faixa_34_38").val(),'6': $("#change_faixa_39_43").val(),'7': $("#change_faixa_44_48").val(),'8': $("#change_faixa_49_53").val(),'9': $("#change_faixa_54_58").val(),'10': $("#change_faixa_59").val()}
            //     };
            //     montarValores(data);      
            // });

            function adicionaZero(numero){
                if (numero <= 9) 
                    return "0" + numero;
                else
                    return numero; 
            }

            function montarValoresIndividual(data) {
                
                $.ajax({
                    url:"{{route('contratos.montarPlanosIndividual')}}",
                    method:"POST",
                    data: data,
                    success(res) {
                        $("#resultado_individual").slideUp().html(res).delay(100).slideToggle(100,function(){
                            $('#cadastrarIndividualModal').animate({
                                scrollTop:$(window).scrollTop() + $(window).height(),
                            },1500);
                        });

                        $("body").find('.vigente').datepicker({
                            onSelect: function() { 
                                var dateObject = $(this).datepicker('getDate'); 
                                let dataFormatada = (dateObject.getFullYear() + "-" + adicionaZero(((dateObject.getMonth() + 1))) + "-" + adicionaZero((dateObject.getDate()))) ;     
                                $("form[name='cadastrar_pessoa_fisica_formulario_individual']").find("#data_vigencia").attr("value",dataFormatada);   
                            }
                        });

                    }
                });    
            }




            function montarValores(data) {
                
                $.ajax({
                    url:"{{route('contratos.montarPlanos')}}",
                    method:"POST",
                    data: data,
                    success(res) {
                           
                        $("#resultado_coletivo").slideUp().html(res).delay(100).slideToggle(100,function(){
                            $('body,html').animate({
                                scrollTop:$(window).scrollTop() + $(window).height(),
                            },1500);
                        });

                        $("body").find('.vigente').datepicker({
                            onSelect: function() { 
                                var dateObject = $(this).datepicker('getDate'); 
                                let dataFormatada = (dateObject.getFullYear() + "-" + adicionaZero(((dateObject.getMonth() + 1))) + "-" + adicionaZero((dateObject.getDate()))) ;     
                                $("form[name='cadastrar_pessoa_fisica_formulario_modal_coletivo']").find("#data_vigencia").attr("value",dataFormatada);   
                            }
                        });


                //         // if(data.plano == "3" || data.plano == "4") {
                //         //     if(data.uf == "GO") {
                //         //         $("body").find('.vigente').datepicker({
                //         //             beforeShowDay: function (d) {
                //         //                 var day = d.getDate();
                //         //                 return [day == 5 || day == 10 || day == 15];
                //         //             }
                //         //         })
                //         //     } else if(data.uf == "MT") {
                //         //         $("body").find('.vigente').datepicker({
                //         //             beforeShowDay: function (d) {
                //         //                 var day = d.getDate();
                //         //                 return [day == 1 || day == 10 || day == 20];
                //         //             }
                //         //         })
                //         //     } else {
                //         //         $("body").find('.vigente').datepicker({
                //         //             beforeShowDay: function (d) {
                //         //                 var day = d.getDate();
                //         //                 return [day == 5 || day == 10 || day == 15];
                //         //             }
                //         //         })
                //         //     }
                //         // } else {
                //         //     $("body").find('.vigente').datepicker()
                //         // }
                        
                        
                        



                    }
                });
                return false;
            }

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

                // $('#tabela_individual').DataTable().ajax.url("{{route('contratos.listarIndividual')}}").load();
                $('.listarindividual').DataTable().ajax.url("{{route('contratos.listarIndividual')}}").load();

                //table.ajax.url("{{route('contratos.listarIndividual')}}").load();
                //table_individual.ajax.url("{{route('contratos.listarIndividual')}}").load();

                //taindividual.ajax.url("{{route('contratos.listarIndividual')}}").load();
                
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




