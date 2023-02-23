@extends('adminlte::page')
@section('title', 'Financeiro')
@section('plugins.Sweetalert2',true)
@section('plugins.Datatables', true)

@section('content_top_nav_right')
    <li class="nav-item mostrar_comissao"><a href="" class="nav-link div_info text-white">
        <i class='fas fa-eye'></i>
    </a></li>
    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt text-white"></i>
    </a>
    
@stop

@section('content_header')
    <ul class="list_abas">
        <li data-id="aba_individual" class="ativo">Individual</li>
        <li data-id="aba_coletivo">Coletivo</li>
        <li data-id="aba_empresarial">Empresarial</li>
    </ul>
@stop

@section('content')
    <input type="hidden" id="janela_atual" value="aba_individual">
    <div id="container_mostrar_comissao" class="ocultar"></div>

    <!-- Modal -->
    <div class="modal fade" id="cancelarModal" tabindex="-1" aria-labelledby="cancelarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelarModalLabel">Cancelados</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" name="formulario_cancelados" id="formulario_cancelados">
                        <input type="hidden" name="comissao_id_cancelado" id="comissao_id_cancelado">
                        <div class="form-group">
                            <label for="">Data Baixa:</label>
                            <input type="date" name="date" id="date" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="motivo">Motivo Cancelamento:</label>
                            <select name="motivo" id="motivo" class="form-control">
                                <option value="">--Escolher o Motivo--</option>
                                
                                @foreach($motivo_cancelados as $mm) 
                                    <option value="{{$mm->id}}">{{$mm->nome}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="obs">Observação:</label> 
                            <textarea name="obs" id="obs" cols="30" rows="4" class="form-control"></textarea>
                        </div>

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>

                    </form>
                </div>            
            </div>
        </div>
    </div>

    <div class="modal fade" id="dataBaixaModal" tabindex="-1" role="dialog" aria-labelledby="dataBaixaModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dataBaixaModalLabel">Data Da Baixa?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" name="data_da_baixa" id="data_da_baixa" method="POST">
                    <input type="date" name="data_baixa" id="data_baixa" class="form-control form-control-sm">
                    <input type="hidden" name="comissao_id" id="comissao_id_baixa">                   
                    <div id="error_data_baixa">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
            </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="dataBaixaIndividualModal" tabindex="-1" role="dialog" aria-labelledby="dataBaixaIndividualLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dataBaixaIndividualLabel">Data Da Baixa?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" name="data_da_baixa_individual" id="data_da_baixa_individual" method="POST">
                    <input type="date" name="date_baixa_individual" id="date_baixa_individual" class="form-control form-control-sm">
                    <input type="hidden" name="comissao_id_baixa_individual" id="comissao_id_baixa_individual">                   
                    <div id="error_data_baixa_individual">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
            </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="dataBaixaEmpresarialModal" tabindex="-1" role="dialog" aria-labelledby="dataBaixaEmpresarialLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dataBaixaEmpresarialLabel">Data Da Baixa?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" name="data_da_baixa_empresarial" id="data_da_baixa_empresarial" method="POST">
                    <input type="date" name="date_baixa_empresarial" id="date_baixa_empresarial" class="form-control form-control-sm">
                                       
                    <div id="error_data_baixa_individual">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
            </form>
            </div>
        </div>
    </div>









    <section class="conteudo_abas">
        <!--------------------------------------INDIVIDUAL------------------------------------------>
        <main id="aba_individual">
           
            <section class="d-flex justify-content-between" style="flex-wrap: wrap;align-content: flex-start;">
            
                <!--COLUNA DA ESQUERDA-->
                <div class="d-flex flex-column text-white ml-1" style="flex-basis:16%;border-radius:5px;">                    

                    <div class="mb-1">
                        <span class="btn btn-block" style="background-color:#123449;color:#FFF;font-size:1.2em;">Financeiro</span>
                    </div>

                    <div class="mb-1">
                        <select id="select_usuario_individual" class="form-control">
                            <option value="todos" class="text-center">---Escolher Corretor---</option>
                            
                        </select>
                    </div>

                    <div style="margin:0 0 20px 0;padding:0;background-color:#123449;border-radius:5px;">
                        
                        <div class="text-center py-1 d-flex justify-content-between border-bottom" id="all_pendentes_individual">
                            <span class="w-50 d-flex justify-content-start ml-2">
                                Pendentes
                            </span>
                            <span class="d-flex justify-content-end badge badge-light mr-1" style="width:45px;text-align:right;">
                                4
                            </span>
                        </div>


                        <ul style="margin:0;padding:0;list-style:none;" id="listar_individual">
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_em_analise_individual" class="individual">
                                <span>Em Análise</span>
                               <span class="badge badge-light individual_quantidade_em_analise" style="width:45px;text-align:right;">{{$qtd_individual_em_analise}}</span>                        
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_pagamento_1_parcela_individual" class="individual">
                                <span>Pagamento 1º Parcela</span>
                               <span class="badge badge-light individual_quantidade_1_parcela" style="width:45px;text-align:right;">{{$qtd_individual_parcela_01}}</span>                        
                            </li>

                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_pagamento_2_parcela_individual" class="individual">
                               <span>Pagamento 2º Parcela</span>
                               <span class="badge badge-light individual_quantidade_2_parcela" style="width:45px;text-align:right;">{{$qtd_individual_parcela_02}}</span>                        
                            </li>

                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_pagamento_3_parcela_individual" class="individual">
                               <span>Pagamento 3º Parcela</span>
                               <span class="badge badge-light individual_quantidade_3_parcela" style="width:45px;text-align:right;">{{$qtd_individual_parcela_03}}</span>                        
                            </li>

                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_pagamento_4_parcela_individual" class="individual">
                               <span>Pagamento 4º Parcela</span>
                               <span class="badge badge-light individual_quantidade_4_parcela" style="width:45px;text-align:right;">{{$qtd_individual_parcela_04}}</span>                        
                            </li>

                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_pagamento_5_parcela_individual" class="individual">
                               <span>Pagamento 5º Parcela</span>
                               <span class="badge badge-light individual_quantidade_5_parcela" style="width:45px;text-align:right;">{{$qtd_individual_parcela_05}}</span>                        
                            </li>

                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_pagamento_6_parcela_individual" class="individual">
                               <span>Pagamento 6º Parcela</span>
                               <span class="badge badge-light individual_quantidade_6_parcela" style="width:45px;text-align:right;">{{$qtd_individual_parcela_06}}</span>                        
                            </li>

                            
                        </ul>
                    </div>


                    <div style="background-color:#123449;border-radius:5px;">   
                        <ul style="list-style:none;margin:0;padding:10px 0;" id="grupo_finalizados_individual">

                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="finalizado_individual" class="individual">
                                <span>Finalizado</span>
                                <span class="badge badge-light individual_quantidade_finalizado" style="width:45px;text-align:right;">{{$qtd_individual_finalizado}}</span>  
                            </li>
                        
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="cancelado_individual" class="individual">
                                <span>Cancelados</span>
                                <span class="badge badge-light individual_quantidade_cancelado" style="width:45px;text-align:right;">{{$qtd_individual_cancelado}}</span>
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

                            <div style="flex-basis:33%;margin:0 1%;">    
                                <span class="text-white" style="font-size:0.875em;">Tipo Plano:</span>
                                <input type="text" name="tipo_plano" id="tipo_plano_individual" class="form-control  form-control-sm" readonly>
                            </div>

                            <div style="flex-basis:40%;margin-top:1%;" id="status">
                                <span class="text-white" style="margin:0;padding:0;font-size:0.875em;display:flex;">
                                    <span style="flex-basis:50%;">
                                        Status:        
                                    </span>
                                    
                                    <div class="container_edit" style="flex-basis:50%;font-size:0.9em;">
                                        <i class="fas fa-edit text-white editar_btn_individual"></i>
                                    </div> 
                                
                                </span>
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
                            
                            <input type="hidden" id="cliente_id_alvo_individual" />

                        </div>                
                    </section>                    

                    <div class="button_individual mt-1">
                        <button class="btn btn-danger w-50 mr-2 excluir_individual" data-comissao="">Excluir</button>
                        <button class="btn btn-success w-50 next_individual">Conferido</button>
                    </div>




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
                            <span class="btn btn-block" style="background-color:#123449;color:#FFF;font-size:1.2em;">Financeiro</span>
                        </div>
                        <select class="my-1 form-control" style="flex-basis:80%;" id="select_coletivo">
                            <option value="todos" class="text-center">---Administradora---</option>      
                        </select>
                        <select class="form-control" style="flex-basis:80%;" id="select_usuario">
                            <option value="todos" class="text-center">---Escolher Corretor---</option>
                        </select>
                    </div>
                    
                    <div style="margin:0 0 20px 0;padding:0;background-color:#123449;border-radius:5px;">
                        
                            
                        <div class="text-center py-1 d-flex justify-content-between border-bottom" id="all_pendentes_coletivo">
                            <span class="w-50 d-flex justify-content-start ml-2">
                                Pendentes
                            </span>                         
                            <span class="d-flex justify-content-end badge badge-light mr-1" style="width:45px;text-align:right;">
                                3
                            </span>
                        </div>




                        
                        
                        <ul style="margin:0;padding:0;list-style:none;" id="listar">
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="em_analise_coletivo" class="fundo coletivo ">
                                <span>Em Analise</span>
                                <span class="badge badge-light coletivo_quantidade_em_analise" style="width:45px;text-align:right;vertical-align: middle;">{{$qtd_coletivo_em_analise}}</span>                        
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="emissao_boleto_coletivo" class="coletivo">
                                <span>Emissão Boleto</span>
                                <span class="badge badge-light coletivo_quantidade_emissao_boleto" style="width:45px;text-align:right;">{{$qtd_coletivo_emissao_boleto}}</span>
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="pagamento_adesao_coletivo" class="coletivo">
                                <span>Pagamento Adesão</span>
                                <span class="badge badge-light coletivo_quantidade_pagamento_adesao" style="width:45px;text-align:right;">{{$qtd_coletivo_pg_adesao}}</span>
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="pagamento_vigencia_coletivo" class="coletivo">
                                <span>Pagamento Vigência</span>
                                <span class="badge badge-light coletivo_quantidade_pagamento_vigencia" style="width:45px;text-align:right;">{{$qtd_coletivo_pg_vigencia}}</span>
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="pagamento_segunda_parcela" class="coletivo">
                                <span>Pagamento 2º Parcela</span>
                                <span class="badge badge-light coletivo_quantidade_segunda_parcela" style="width:45px;text-align:right;">{{$qtd_coletivo_02_parcela}}</span>
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="pagamento_terceira_parcela" class="coletivo">
                                <span>Pagamento 3º Parcela</span>
                                <span class="badge badge-light coletivo_quantidade_terceira_parcela" style="width:45px;text-align:right;">{{$qtd_coletivo_03_parcela}}</span>
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="pagamento_quarta_parcela" class="coletivo">
                                <span>Pagamento 4º Parcela</span>
                                <span class="badge badge-light coletivo_quantidade_quarta_parcela" style="width:45px;text-align:right;">{{$qtd_coletivo_04_parcela}}</span>
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="pagamento_quinta_parcela" class="coletivo">
                                <span>Pagamento 5º Parcela</span>
                                <span class="badge badge-light coletivo_quantidade_quinta_parcela" style="width:45px;text-align:right;">{{$qtd_coletivo_05_parcela}}</span>
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="pagamento_sexta_parcela" class="coletivo">
                                <span>Pagamento 6º Parcela</span>
                                <span class="badge badge-light coletivo_quantidade_sexta_parcela" style="width:45px;text-align:right;">{{$qtd_coletivo_06_parcela}}</span>
                            </li>
                            
                        </ul>
                    </div>

                    <div style="background-color:#123449;border-radius:5px;">   
                        <ul style="list-style:none;margin:0;padding:10px 0;" id="grupo_finalizados">
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="finalizado_coletivo" class="coletivo">
                                <span>Finalizado</span>
                                <span class="badge badge-light quantidade_coletivo_finalizado" style="width:45px;text-align:right;">{{$qtd_coletivo_finalizados}}</span>
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="cancelado_coletivo" class="coletivo">
                                <span>Cancelados</span>
                                <span class="badge badge-light quantidade_coletivo_cancelados" style="width:45px;text-align:right;">{{$qtd_coletivo_cancelados}}</span>
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

                            <div style="flex-basis:40%;margin-top:1%;" id="status">
                                <span class="text-white" style="margin:0;padding:0;font-size:0.875em;display:flex;">
                                    
                                    <span style="flex-basis:50%;">  
                                        Status:
                                    </span>
                                    
                                    <div class="container_edit" style="flex-basis:50%;font-size:0.9em;">
                                        <i class="fas fa-edit text-white editar_btn"></i>
                                    </div> 

                                </span>
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
 
                            <input type="hidden" id="cliente_id_alvo" />
                        </div>                
                    </section>    
                
                    <div class="buttons mt-1">
                        <button class="btn btn-danger w-50 mr-2 excluir_coletivo">Excluir</button>
                        <button class="btn btn-success w-50 next">Conferido</button>
                    </div>

                </div>

            </section>

       </main>

       <main id="aba_empresarial" class="ocultar">
           
            <section class="d-flex justify-content-between" style="flex-wrap: wrap;">

                <!--COLUNA DA ESQUERDA-->
                <div class="d-flex flex-column text-white ml-1" style="flex-basis:16%;border-radius:5px;">                    
                    

                    <div class="d-flex">
                        <span class="btn btn-block" style="background-color:#123449;color:#FFF;font-size:1.2em;">Financeiro</span>
                    </div>


                    <select name="mudar_user_empresarial" id="mudar_user_empresarial" class="form-control my-1">
                        <option>----Escolher o Corretor----</option>    
                    </select>


                    <div style="margin:0 0 20px 0;padding:0;background-color:#123449;border-radius:5px;">
                        <h5 class="text-center d-flex align-items-center justify-content-center py-2 border-bottom">Pendentes</h5>

                        <ul style="margin:0;padding:0;list-style:none;" id="listar_empresarial">
                            
                           <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_em_analise_empresarial"  class="empresarial">
                                <span>Em Análise</span>
                               <span class="badge badge-light empresarial_quantidade_em_analise" style="width:45px;text-align:right;">{{$qtd_empresarial_em_analise}}</span>                        
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_pagamento_1_parcela_empresarial" class="empresarial">
                                <span>Pagamento 1º Parcela</span>
                               <span class="badge badge-light empresarial_quantidade_1_parcela" style="width:45px;text-align:right;">{{$qtd_empresarial_parcela_01}}</span>                        
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_pagamento_2_parcela_empresarial" class="empresarial">
                               <span>Pagamento 2º Parcela</span>
                               <span class="badge badge-light empresarial_quantidade_2_parcela" style="width:45px;text-align:right;">{{$qtd_empresarial_parcela_02}}</span>                        
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_pagamento_3_parcela_empresarial" class="empresarial">
                               <span>Pagamento 3º Parcela</span>
                               <span class="badge badge-light empresarial_quantidade_3_parcela" style="width:45px;text-align:right;">{{$qtd_empresarial_parcela_03}}</span>                        
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_pagamento_4_parcela_empresarial" class="empresarial">
                               <span>Pagamento 4º Parcela</span>
                               <span class="badge badge-light empresarial_quantidade_4_parcela" style="width:45px;text-align:right;">{{$qtd_empresarial_parcela_04}}</span>                        
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_pagamento_5_parcela_empresarial" class="empresarial">
                               <span>Pagamento 5º Parcela</span>
                               <span class="badge badge-light empresarial_quantidade_5_parcela" style="width:45px;text-align:right;">{{$qtd_empresarial_parcela_05}}</span>                        
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_pagamento_6_parcela_empresarial" class="empresarial">
                               <span>Pagamento 6º Parcela</span>
                               <span class="badge badge-light empresarial_quantidade_6_parcela" style="width:45px;text-align:right;">{{$qtd_empresarial_parcela_06}}</span>                        
                            </li>
                        </ul>
                    </div>


                    <div style="background-color:#123449;border-radius:5px;">   
                        <ul style="list-style:none;margin:0;padding:10px 0;" id="grupo_finalizados_empresarial">
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_finalizado_empresarial" class="empresarial">
                               <span>Finalizado</span>
                               <span class="badge badge-light empresarial_quantidade_finalizado" style="width:45px;text-align:right;">{{$qtd_empresarial_finalizado}}</span>                        
                            </li>
                            <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_cancelado_empresarial" class="empresarial">
                               <span>Cancelado</span>
                               <span class="badge badge-light empresarial_quantidade_cancelado" style="width:45px;text-align:right;">{{$qtd_empresarial_cancelado}}</span>                        
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

                        
                        </section>      

                        <div class="button_empresarial mt-1">
                            <button class="btn btn-danger w-50 mr-2 excluir_empresarial">Excluir</button>
                            <button class="btn btn-success w-50 next_empresarial">Conferido</button>
                        </div>  
                        
                </div>

                
                
                <!---------FIM DIREITA----------->
           
           
           
           

       </main>
    </section>
   
@stop  

@section('js')

    <script>
        $(function(){  

            




           $("body").on('click','.excluir_coletivo',function(){
                if($(this).attr('data-cliente-excluir')) {
                    Swal.fire({
                        title: 'Você tem certeza que deseja realizar essa operação?',
                        showDenyButton: true,
                        confirmButtonText: 'Sim',
                        denyButtonText: `Cancelar`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let id_cliente = $(this).attr('data-cliente-excluir');
                            $.ajax({
                                url:"{{route('financeiro.excluir.cliente')}}",
                                method:"POST",
                                data:"id_cliente="+id_cliente,
                                success:function(res) {
                                    if(res != "error") {
                                        $(".coletivo_quantidade_em_analise").html(res.qtd_coletivo_em_analise);    
                                        $(".coletivo_quantidade_emissao_boleto").html(res.qtd_coletivo_emissao_boleto);
                                        $(".coletivo_quantidade_pagamento_adesao").html(res.qtd_coletivo_pg_adesao);
                                        $(".coletivo_quantidade_pagamento_vigencia").html(res.qtd_coletivo_pg_vigencia);
                                        $(".coletivo_quantidade_segunda_parcela").html(res.qtd_coletivo_02_parcela);
                                        $(".coletivo_quantidade_terceira_parcela").html(res.qtd_coletivo_03_parcela);
                                        $(".coletivo_quantidade_quarta_parcela").html(res.qtd_coletivo_04_parcela);
                                        $(".coletivo_quantidade_quinta_parcela").html(res.qtd_coletivo_05_parcela);
                                        $(".coletivo_quantidade_sexta_parcela").html(res.qtd_coletivo_06_parcela);
                                        $(".quantidade_coletivo_finalizado").html(res.qtd_coletivo_finalizado);
                                        table.ajax.reload();
                                        limparFormulario();
                                        $(".excluir_coletivo").removeAttr('data-cliente-excluir');
                                    } else {
                                        Swal.fire('Opss', 'Erro ao excluir o cliente', 'error')  
                                    }
                                }
                            });    
                        } else if (result.isDenied) {
                            //
                        }
                    })
                }
           }); 

           $("body").on('click','.excluir_individual',function(){
                if($(this).attr('data-cliente-excluir-individual')) {
                    Swal.fire({
                        title: 'Você tem certeza que deseja realizar essa operação?',
                        showDenyButton: true,
                        confirmButtonText: 'Sim',
                        denyButtonText: `Cancelar`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let id_cliente = $(this).attr('data-cliente-excluir-individual');
                            $.ajax({
                                url:"{{route('financeiro.excluir.cliente.individual')}}",
                                method:"POST",
                                data:"id_cliente="+id_cliente,
                                success:function(res) {
                                    if(res != "error") {
                                        $(".individual_quantidade_em_analise").html(res.qtd_individual_em_analise);    
                                        $(".individual_quantidade_1_parcela").html(res.qtd_individual_01_parcela);
                                        $(".individual_quantidade_2_parcela").html(res.qtd_individual_02_parcela);
                                        $(".individual_quantidade_3_parcela").html(res.qtd_individual_03_parcela);
                                        $(".individual_quantidade_4_parcela").html(res.qtd_individual_04_parcela);
                                        $(".individual_quantidade_5_parcela").html(res.qtd_individual_05_parcela);
                                        $(".individual_quantidade_6_parcela").html(res.qtd_individual_06_parcela);
                                        $(".individual_quantidade_finalizado").html(res.qtd_individual_finalizado);
                                        $(".individual_quantidade_cancelado").html(res.qtd_individual_cancelado);
                                        
                                        table_individual.ajax.reload();
                                        limparFormularioIndividual();
                                    } else {
                                        Swal.fire('Opss', 'Erro ao excluir o cliente', 'error')  
                                    }
                                }
                            });    
                        } else if (result.isDenied) {
                            //
                        }
                    })
                }
           });
           
           $("body").on('click','.excluir_empresarial',function(){
                
                if($(this).attr('data-cliente-excluir-individual')) {

                    Swal.fire({
                        title: 'Você tem certeza que deseja realizar essa operação?',
                        showDenyButton: true,
                        confirmButtonText: 'Sim',
                        denyButtonText: `Cancelar`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let id_contrato = $(this).attr('data-cliente-excluir-individual');
                            $.ajax({
                                url:"{{route('financeiro.excluir.cliente.individual')}}",
                                method:"POST",
                                data:"id_contrato="+id_contrato,
                                success:function(res) {
                                    console.log(res);
                                    // if(res != "error") {
                                    //     $(".individual_quantidade_em_analise").html(res.qtd_individual_em_analise);    
                                    //     $(".individual_quantidade_1_parcela").html(res.qtd_individual_01_parcela);
                                    //     $(".individual_quantidade_2_parcela").html(res.qtd_individual_02_parcela);
                                    //     $(".individual_quantidade_3_parcela").html(res.qtd_individual_03_parcela);
                                    //     $(".individual_quantidade_4_parcela").html(res.qtd_individual_04_parcela);
                                    //     $(".individual_quantidade_5_parcela").html(res.qtd_individual_05_parcela);
                                    //     $(".individual_quantidade_6_parcela").html(res.qtd_individual_06_parcela);
                                    //     $(".individual_quantidade_finalizado").html(res.qtd_individual_finalizado);
                                    //     $(".individual_quantidade_cancelado").html(res.qtd_individual_cancelado);
                                        
                                    //     table_individual.ajax.reload();
                                    //     limparFormularioIndividual();
                                    // } else {
                                    //     Swal.fire('Opss', 'Erro ao excluir o cliente', 'error')  
                                    // }
                                }
                            });    
                        } else if (result.isDenied) {
                            //
                        }
                    })
                }
               let excluir_empresarial = $(this).attr('data-cliente-excluir-individual');
                return false;
           }); 







           $("body").on('click','.cancelar_individual',function(){
                $('#cancelarModal').modal('show')
           });

           $("body").on('click','.cancelar',function(){
                $('#cancelarModal').modal('show')
            });

            
           $('form[name="formulario_cancelados"]').on('submit',function(){
                $.ajax({
                    url:"{{route('financeiro.contrato.cancelados')}}",
                    method:"POST",
                    data:$(this).serialize(),
                    success:function(res) {
                        
                        if(res == "error") {

                        } else {
                            
                            if(res.plano == "coletivo") {

                                $(".coletivo_quantidade_em_analise").html(res.dados.qtd_coletivo_em_analise);    
                                $(".coletivo_quantidade_emissao_boleto").html(res.dados.qtd_coletivo_emissao_boleto);
                                $(".coletivo_quantidade_pagamento_adesao").html(res.dados.qtd_coletivo_pg_adesao);
                                $(".coletivo_quantidade_pagamento_vigencia").html(res.dados.qtd_coletivo_pg_vigencia);
                                $(".coletivo_quantidade_segunda_parcela").html(res.dados.qtd_coletivo_02_parcela);
                                $(".coletivo_quantidade_terceira_parcela").html(res.dados.qtd_coletivo_03_parcela);
                                $(".coletivo_quantidade_quarta_parcela").html(res.dados.qtd_coletivo_04_parcela);
                                $(".coletivo_quantidade_quinta_parcela").html(res.dados.qtd_coletivo_05_parcela);
                                $(".coletivo_quantidade_sexta_parcela").html(res.dados.qtd_coletivo_06_parcela);
                                $(".quantidade_coletivo_finalizado").html(res.dados.qtd_coletivo_finalizado);
                                $(".quantidade_coletivo_cancelados").html(res.dados.qtd_coletivo_cancelado);
                                $("#cancelarModal").modal('hide');
                                table.ajax.reload();
                                limparFormulario();
                            } else {
                                $(".individual_quantidade_em_analise").html(res.dados.qtd_individual_em_analise);    
                                $(".individual_quantidade_1_parcela").html(res.dados.qtd_individual_01_parcela);
                                $(".individual_quantidade_2_parcela").html(res.dados.qtd_individual_02_parcela);
                                $(".individual_quantidade_3_parcela").html(res.dados.qtd_individual_03_parcela);
                                $(".individual_quantidade_4_parcela").html(res.dados.qtd_individual_04_parcela);
                                $(".individual_quantidade_5_parcela").html(res.dados.qtd_individual_05_parcela);
                                $(".individual_quantidade_6_parcela").html(res.dados.qtd_individual_06_parcela);
                                $(".individual_quantidade_finalizado").html(res.dados.qtd_individual_finalizado);
                                $(".individual_quantidade_cancelado").html(res.dados.qtd_individual_cancelado);
                                $("#cancelarModal").modal('hide');
                                table_individual.ajax.reload();
                                limparFormularioIndividual();
                            }
                        }
                    }
                });
                return false;
           });     

            $(".mostrar_comissao").on('mouseenter',function(){   
                if($("#janela_atual").val() == "aba_individual") {
                    var janela  = "aba_individual";
                    var id_contrato = $('.next_individual').attr('data-contrato');
                } else if($("#janela_atual").val() == "aba_coletivo") {
                    var janela  = "aba_coletivo";
                    var id_contrato = $('.next').attr('data-contrato');
                } else {
                    var janela  = "aba_empresarial";
                    var id_contrato = $('.next_empresarial').attr('data-contrato');
                }
                               
                if(janela && id_contrato) {
                    $.ajax({
                        url:"{{route('financeiro.ver.contrato')}}",
                        method:"POST",
                        data:"contrato_id="+id_contrato+"&janela="+janela,
                        success:function(res) {
                            $("#container_mostrar_comissao").html(res).removeClass('ocultar');        
                        }
                    });
                }
            }).on('mouseleave',function(){
                $("#container_mostrar_comissao").html('').addClass('ocultar'); 
            });
            
            String.prototype.ucWords = function () {
                let str = this.toLowerCase()
                let re = /(^([a-zA-Z\p{M}]))|([ -][a-zA-Z\p{M}])/g
                return str.replace(re, s => s.toUpperCase())
            }

            $(".list_abas li").on('click',function(){
                $('li').removeClass('ativo');
                $(this).addClass("ativo");
                let id = $(this).attr('data-id');
                $("#janela_atual").val(id);
                $('.conteudo_abas main').addClass('ocultar');
                $('#'+id).removeClass('ocultar');
                $('.next').attr('data-cliente','');
                $('.next').attr('data-contrato','');
                $('tr').removeClass('textoforte');

                table.ajax.url("{{ route('financeiro.coletivo.em_analise') }}").load();
                table_individual.ajax.url("{{ route('financeiro.individual.em_analise') }}").load();
                tableempresarial.ajax.url('{{route("contratos.listarEmpresarial.analise")}}').load();

                $('#title_coletivo_por_adesao_table').html("<h4>Em Análise</h4>");
                $('#title_individual').html("<h4>Em Análise</h4>");
                $("#title_empresarial").html("<h4>Em Análise</h4>");

                $("#cliente_id_alvo").val('');
                $("#cliente_id_alvo_individual").val('');
                limparFormularioIndividual();
                limparFormulario();
                limparEmpresarial();
                adicionarReadonly();
                adicionarReadonlyIndividual();

                $("#all_pendentes_individual").removeClass('textoforte-list');

                $("ul#listar li.coletivo").removeClass('textoforte-list');
                $("ul#grupo_finalizados li.coletivo").removeClass('textoforte-list');


                $("ul#listar_individual li.individual").removeClass('textoforte-list');
                $("ul#grupo_finalizados_individual li.individual").removeClass('textoforte-list');


                $("ul#listar_empresarial li.empresarial").removeClass('textoforte-list');
                $("ul#grupo_finalizados_empresarial li.empresarial").removeClass('textoforte-list');


                //limparTudo();
            });


            $('.editar_btn').on('click',function(){
                let params = $("#cliente_coletivo_view").prop('readonly');
                if(!params) {
                    adicionarReadonly();
                } else {
                    removeReadonly();
                }             
            });

            $('.editar_btn_individual').on('click',function(){
                let params = $("#cliente").prop('readonly');
                if(!params) {
                    adicionarReadonlyIndividual();
                } else {
                    removeReadonlyIndividual();
                }
            });


            $("body").on('change','.editar_campo',function(){
                let alvo = $(this).attr('id');
                let valor = $("#"+alvo).val();
                let id_cliente = $("#cliente_id_alvo").val();
                $.ajax({
                    url:"{{route('financeiro.editar.campoIndividualmente')}}",
                    method:"POST",
                    data:"alvo="+alvo+"&valor="+valor+"&id_cliente="+id_cliente,
                    success:function(res) {
                        table.ajax.reload();
                    }
                });
            });

            $("body").on('change','.editar_campo_individual',function(){
                let alvo = $(this).attr('id');
                let valor = $("#"+alvo).val();

                let id_cliente = $("#cliente_id_alvo_individual").val();
                $.ajax({
                    url:"{{route('financeiro.editar.individual.campoIndividualmente')}}",
                    method:"POST",
                    data:"alvo="+alvo+"&valor="+valor+"&id_cliente="+id_cliente,
                    success:function(res) {
                        table_individual.ajax.reload();
                    }
                });
            });
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });    

            $("form[name='data_da_baixa']").on('submit',function(){
                let id_cliente = $('.next').attr('data-cliente');
                let id_contrato = $('.next').attr('data-contrato');
                $.ajax({
                    url:"{{route('financeiro.baixa.data')}}",
                    method:"POST",
                    data: {
                        "id_cliente": id_cliente,
                        "id_contrato": id_contrato,
                        "data_baixa": $("#data_baixa").val(),
                        "comissao_id": $("#comissao_id_baixa").val()
                    },  
                    beforeSend:function() {
                        if($("#data_baixa").val() == "") {
                            $("#error_data_baixa").html('<p class="alert alert-danger">O campo data é campo obrigatório</p>');
                            return false;
                        } else {
                            $("#error_data_baixa").html('');
                        }
                    },
                    success:function(res) {
                        $(".coletivo_quantidade_em_analise").html(res.qtd_coletivo_em_analise);    
                        $(".coletivo_quantidade_emissao_boleto").html(res.qtd_coletivo_emissao_boleto);
                        $(".coletivo_quantidade_pagamento_adesao").html(res.qtd_coletivo_pg_adesao);
                        $(".coletivo_quantidade_pagamento_vigencia").html(res.qtd_coletivo_pg_vigencia);
                        $(".coletivo_quantidade_segunda_parcela").html(res.qtd_coletivo_02_parcela);
                        $(".coletivo_quantidade_terceira_parcela").html(res.qtd_coletivo_03_parcela);
                        $(".coletivo_quantidade_quarta_parcela").html(res.qtd_coletivo_04_parcela);
                        $(".coletivo_quantidade_quinta_parcela").html(res.qtd_coletivo_05_parcela);
                        $(".coletivo_quantidade_sexta_parcela").html(res.qtd_coletivo_06_parcela);
                        $(".quantidade_coletivo_finalizado").html(res.qtd_coletivo_finalizado);
                        table.ajax.reload();
                        limparFormulario();
                        $('#dataBaixaModal').modal('hide');
                        $('#data_baixa').val('');
                    }
                })
                return false;
            });

            $("form[name='data_da_baixa_individual']").on('submit',function(){
                let id_cliente = $('.next_individual').attr('data-cliente');
                let id_contrato = $('.next_individual').attr('data-contrato');                
                $.ajax({
                    url:"{{route('financeiro.baixa.data.individual')}}",
                    method:"POST",
                    data: {
                        "id_cliente": id_cliente,
                        "id_contrato": id_contrato,
                        "data_baixa": $("#date_baixa_individual").val(),
                        "comissao_id": $("#comissao_id_baixa_individual").val()
                    },  
                    beforeSend:function() {
                        // if($("#data_baixa").val() == "") {
                        //     $("#error_data_baixa").html('<p class="alert alert-danger">O campo data é campo obrigatório</p>');
                        //     return false;
                        // } else {
                        //     $("#error_data_baixa").html('');
                        // }
                    },
                    success:function(res) {
                        $('#dataBaixaIndividualModal').modal('hide');
                        $(".individual_quantidade_em_analise").html(res.qtd_individual_em_analise);    
                        $(".individual_quantidade_1_parcela").html(res.qtd_individual_01_parcela);
                        $(".individual_quantidade_2_parcela").html(res.qtd_individual_02_parcela);
                        $(".individual_quantidade_3_parcela").html(res.qtd_individual_03_parcela);
                        $(".individual_quantidade_4_parcela").html(res.qtd_individual_04_parcela);
                        $(".individual_quantidade_5_parcela").html(res.qtd_individual_05_parcela);
                        $(".individual_quantidade_6_parcela").html(res.qtd_individual_06_parcela);
                        $(".individual_quantidade_finalizado").html(res.qtd_individual_finalizado);
                        table_individual.ajax.reload();
                        limparFormulario();
                        $('#dataBaixaIndividualModal').modal('hide');
                        $('#date_baixa_individual').val('');
                    }
                });
                return false;
            });

            $("form[name='data_da_baixa_empresarial']").on('submit',function(){
                let id_contrato = $('.next_empresarial').attr('data-contrato');    
                let date_baixa_empresarial = $("input[name='date_baixa_empresarial']").val();    
                $.ajax({
                    url:"{{route('financeiro.baixa.data.empresarial')}}",
                    method:"POST",
                    data:"id_contrato="+id_contrato+"&data_baixa="+date_baixa_empresarial,
                    success:function(res) {
                        $('#dataBaixaEmpresarialModal').modal('hide');
                        $(".empresarial_quantidade_em_analise").html(res.qtd_empresarial_em_analise);    
                        $(".empresarial_quantidade_1_parcela").html(res.qtd_empresarial_01_parcela);
                        $(".empresarial_quantidade_2_parcela").html(res.qtd_empresarial_02_parcela);
                        $(".empresarial_quantidade_3_parcela").html(res.qtd_empresarial_03_parcela);
                        $(".empresarial_quantidade_4_parcela").html(res.qtd_empresarial_04_parcela);
                        $(".empresarial_quantidade_5_parcela").html(res.qtd_empresarial_05_parcela);
                        $(".empresarial_quantidade_6_parcela").html(res.qtd_empresarial_06_parcela);
                        $(".empresarial_quantidade_finalizado").html(res.qtd_empresarial_finalizado);
                        $(".empresarial_quantidade_cancelado").html(res.qtd_empresarial_cancelado);
                        tableempresarial.ajax.reload();
                        limparFormulario();
                        $('#date_baixa_empresarial').val('');
                    }
                });    
                return false;
            })

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
                    $('#title_individual').html("<h4>Em Análise</h4>");
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
                    "url":"{{ route('financeiro.coletivo.em_analise') }}",
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
                    {data:"financeiro.nome",name:"administradora"}
                    
                ],
                "columnDefs": [
                    {
                        /**Data*/
                        "targets": 0,
                        "createdCell": function (td, cellData, rowData, row, col) {
                            let datas = cellData.split("T")[0]
                            let alvo = datas.split("-").reverse().join("/")
                            $(td).html(alvo)    
                        }
                    },
                    /**Corretor*/
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
                        "width":"28%",
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
                    }
                ],              
                "initComplete": function( settings, json ) {
                    $('#title_coletivo_por_adesao_table').html("<h4>Em Análise</h4>");
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
                if(data.financeiro_id == 4) {
                    $("#data_vigencia_coletivo_view").removeAttr('readonly');
                } else {
                    $("#data_vigencia_coletivo_view").prop('readonly',true);
                }
                $('#comissao_id_cancelado').val(data.comissao.id);
                $(".next").attr('data-cliente',data.clientes.id).attr('data-contrato',data.id);
                $("#cliente_id_alvo").val(data.clientes.id);
                $("#comissao_id_baixa").val(data.comissao.id);

                $(".excluir_coletivo").attr('data-cliente-excluir',data.clientes.id);

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

            $('body').on('change','#data_vigencia_coletivo_view',function(){
                let valor = $(this).val();
                let cliente = $("#cliente_id_alvo").val();
                $.ajax({
                    url:"{{route('financeiro.mudarVigenciaColetivo')}}",
                    method:"POST",
                    data:"data="+valor+"&cliente_id="+cliente,
                });
            });

            var table_individual = $('#tabela_individual').DataTable();
            $('#tabela_individual').on('click', 'tbody tr', function () {
                table_individual.$('tr').removeClass('textoforte');
                $(this).closest('tr').addClass('textoforte');
                let data = table_individual.row(this).data();   
                $("#cliente_id_alvo_individual").val(data.clientes.id);
                $('#comissao_id_cancelado').val(data.comissao.id);
                $(".excluir_individual").attr('data-cliente-excluir-individual',data.clientes.id);
                $(".next_individual").attr('data-cliente',data.clientes.id).attr('data-contrato',data.id);
                $('#comissao_id_baixa_individual').val(data.comissao.id);
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
                    $('#title_empresarial').html("<h4>Em Analise</h4>");
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

                $(".next_empresarial").attr('data-financeiro',data.financeiro_id).attr('data-contrato',data.id);
                $(".excluir_empresarial").attr('data-cliente-excluir-individual',data.id);
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

            $("body").on('click','.next',function(){
                if($(this).attr('data-cliente') && $(this).attr('data-contrato')) {
                    let id_cliente = $(this).attr('data-cliente');
                    let id_contrato = $(this).attr('data-contrato');
                    $.ajax({
                        url:"{{route('financeiro.mudarStatusColetivo')}}",
                        data:"id_cliente="+id_cliente+"&id_contrato="+id_contrato,
                        method:"POST",
                        success:function(res) {
                            if(res == "abrir_modal") {
                                $('#dataBaixaModal').modal('show');                      
                            } else {
                                $(".coletivo_quantidade_em_analise").html(res.qtd_coletivo_em_analise);    
                                $(".coletivo_quantidade_emissao_boleto").html(res.qtd_coletivo_emissao_boleto);
                                $(".coletivo_quantidade_pagamento_adesao").html(res.qtd_coletivo_pg_adesao);
                                $(".coletivo_quantidade_pagamento_vigencia").html(res.qtd_coletivo_pg_vigencia);
                                $(".coletivo_quantidade_segunda_parcela").html(res.qtd_coletivo_02_parcela);
                                $(".coletivo_quantidade_terceira_parcela").html(res.qtd_coletivo_03_parcela);
                                $(".coletivo_quantidade_quarta_parcela").html(res.qtd_coletivo_04_parcela);
                                $(".coletivo_quantidade_quinta_parcela").html(res.qtd_coletivo_05_parcela);
                                $(".coletivo_quantidade_sexta_parcela").html(res.qtd_coletivo_06_parcela);
                                $(".quantidade_coletivo_finalizado").html(res.qtd_coletivo_finalizado);
                                table.ajax.reload();
                                limparFormulario();
                            }
                        }
                    });
                } else {                     
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        type: "error",
                        width: '400px',
                        html: "Tem que selecionar um item da tabela, para mudar de status"
                    })
                }
            });

            $("body").on('click','.next_individual',function(){
                if($(this).attr('data-cliente') && $(this).attr('data-contrato')) {
                    
                    let id_cliente = $(this).attr('data-cliente');
                    let id_contrato = $(this).attr('data-contrato');

                    $.ajax({
                        url:"{{route('financeiro.mudarStatusIndividual')}}",
                        data:"id_cliente="+id_cliente+"&id_contrato="+id_contrato,
                        method:"POST",
                        success:function(res) {
                            
                            if(res == "abrir_modal_individual") {
                                //$('#dataBaixaModal').modal('show');                      
                                $("#dataBaixaIndividualModal").modal('show');
                            } else {
                                
                                $(".individual_quantidade_em_analise").html(res.qtd_individual_em_analise);    
                                $(".individual_quantidade_1_parcela").html(res.qtd_individual_01_parcela);
                                $(".individual_quantidade_2_parcela").html(res.qtd_individual_02_parcela);
                                $(".individual_quantidade_3_parcela").html(res.qtd_individual_03_parcela);
                                $(".individual_quantidade_4_parcela").html(res.qtd_individual_04_parcela);
                                $(".individual_quantidade_5_parcela").html(res.qtd_individual_05_parcela);
                                $(".individual_quantidade_6_parcela").html(res.qtd_individual_06_parcela);
                                $(".individual_quantidade_finalizado").html(res.qtd_individual_finalizado);
                                
                                taindividual.ajax.reload();
                                limparFormulario();
                            }
                        }
                    });
                } else {                     
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        type: "error",
                        width: '400px',
                        html: "Tem que selecionar um item da tabela, para mudar de status"
                    })
                }
            });


            $("body").on('click','.next_empresarial',function(){
                
                if($(this).attr('data-contrato') && $(this).attr('data-financeiro')) {
                    let id_contrato = $(this).attr('data-contrato');
                    let financeiro = $(this).attr('data-financeiro');

                    $.ajax({
                        url:"{{route('financeiro.mudarStatusEmpresarial')}}",
                        data:"financeiro="+financeiro+"&id_contrato="+id_contrato,
                        method:"POST",
                        success:function(res) {
                            
                            if(res == "abrir_modal_empresarial") {
                                //$('#dataBaixaModal').modal('show');                      
                                $("#dataBaixaEmpresarialModal").modal('show');
                            } else {
                                $(".empresarial_quantidade_em_analise").html(res.qtd_empresarial_em_analise);    
                                $(".empresarial_quantidade_1_parcela").html(res.qtd_empresarial_01_parcela);
                                $(".empresarial_quantidade_2_parcela").html(res.qtd_empresarial_02_parcela);
                                $(".empresarial_quantidade_3_parcela").html(res.qtd_empresarial_03_parcela);
                                $(".empresarial_quantidade_4_parcela").html(res.qtd_empresarial_04_parcela);
                                $(".empresarial_quantidade_5_parcela").html(res.qtd_empresarial_05_parcela);
                                $(".empresarial_quantidade_6_parcela").html(res.qtd_empresarial_06_parcela);
                                $(".empresarial_quantidade_finalizado").html(res.qtd_empresarial_finalizado);
                                $(".empresarial_quantidade_cancelado").html(res.qtd_empresarial_cancelado);
                                tableempresarial.ajax.reload();
                                // limparFormulario();
                            }
                        }
                    });
                }
            });

            $("ul#listar li.coletivo").on('click',function(){
                let id_lista = $(this).attr('id');
                
                if(id_lista == "em_analise_coletivo") {
                    $('#title_coletivo_por_adesao_table').html("<h4>Em Análise</h4>");
                    table.ajax.url("{{ route('financeiro.coletivo.em_analise') }}").load();
                    $('.buttons').empty().html(
                        '<button class="btn btn-danger w-50 mr-2 excluir_coletivo">Excluir</button>'+
                        '<button class="btn btn-success w-50 next">Conferido</button>'
                    );   
                    $(".container_edit").removeClass('ocultar');
                    $("ul#listar li.coletivo").removeClass('textoforte-list');
                    $("ul#grupo_finalizados li.coletivo").removeClass('textoforte-list');
                    $("#all_pendentes_coletivo").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list');                   
                    limparFormulario()

                } else if(id_lista == "emissao_boleto_coletivo") {
                    $('#title_coletivo_por_adesao_table').html("<h4>Emissão Boleto</h4>");
                    table.ajax.url("{{ route('financeiro.coletivo.emissao_boleto') }}").load();
                    $('.buttons').empty().html(
                        '<button class="btn btn-danger w-50 mr-2 excluir_coletivo">Excluir</button>'+
                        '<button class="btn btn-success w-50 next">Emitiu Boleto</button>'
                    );                      
                    $(".container_edit").addClass('ocultar');
                    $("ul#listar li.coletivo").removeClass('textoforte-list');
                    $("ul#grupo_finalizados li.coletivo").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list');
                    adicionarReadonly();
                    limparFormulario();
                } else if(id_lista == "pagamento_adesao_coletivo") {
                    $('#title_coletivo_por_adesao_table').html("<h4>Pagamento Adesão</h4>");
                    table.ajax.url("{{ route('financeiro.coletivo.pagamento_adesao') }}").load();
                    $('.buttons').empty().html(
                        '<button class="btn btn-danger w-50 mr-2 cancelar">Cancelar</button>'+
                        '<button class="btn btn-success w-50 pagamento_adesao next">Pagou Adesão</button>'
                    );
                    $(".container_edit").addClass('ocultar');
                    $("ul#listar li.coletivo").removeClass('textoforte-list');
                    $("ul#grupo_finalizados li.coletivo").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list');
                    adicionarReadonly();
                    limparFormulario();

                } else if(id_lista == "pagamento_vigencia_coletivo") {

                    $('#title_coletivo_por_adesao_table').html("<h4>Pagamento Vigência</h4>");
                    table.ajax.url("{{ route('financeiro.coletivo.pagamento_vigencia') }}").load();
                    $('.buttons').empty().html(
                        '<button class="btn btn-danger w-50 mr-2 cancelar">Cancelar</button>'+
                        '<button class="btn btn-success w-50 pagamento_vegencia next">Pagou Vigência</button>'
                    );
                    $(".container_edit").addClass('ocultar');
                    
                    $("ul#listar li.coletivo").removeClass('textoforte-list');
                    $("ul#grupo_finalizados li.coletivo").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list');

                    adicionarReadonly();
                    limparFormulario();
                } else if(id_lista == "pagamento_segunda_parcela") {
                    $('#title_coletivo_por_adesao_table').html("<h4>Pagamento 2º Parcela</h4>");
                    table.ajax.url("{{ route('financeiro.coletivo.pagamento_segunda_parcela') }}").load();
                    $('.buttons').empty().html(
                        '<button class="btn btn-danger w-50 mr-2 cancelar">Cancelar</button>'+
                        '<button class="btn btn-success w-50 pagamento_segunda_parcela next">2º Parcela Paga</button>'
                    );
                    $(".container_edit").addClass('ocultar');

                    $("ul#listar li.coletivo").removeClass('textoforte-list');
                    $("ul#grupo_finalizados li.coletivo").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list');
                    
                    adicionarReadonly();
                    limparFormulario();
                } else if(id_lista == "pagamento_terceira_parcela") {
                    $('#title_coletivo_por_adesao_table').html("<h4>Pagamento 3º Parcela</h4>");
                    table.ajax.url("{{ route('financeiro.coletivo.pagamento_terceira_parcela') }}").load();
                    $('.buttons').empty().html(
                        '<button class="btn btn-danger w-50 mr-2 cancelar">Cancelar</button>'+
                        '<button class="btn btn-success w-50 pagamento_terceira_parcela next">3º Parcela Paga</button>'
                    );
                    $(".container_edit").addClass('ocultar');

                    $("ul#listar li.coletivo").removeClass('textoforte-list');
                    $("ul#grupo_finalizados li.coletivo").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list');
                    
                    adicionarReadonly();
                    limparFormulario();
                } else if(id_lista == "pagamento_quarta_parcela") {
                    $('#title_coletivo_por_adesao_table').html("<h4>Pagamento 4º Parcela</h4>");
                    table.ajax.url("{{ route('financeiro.coletivo.pagamento_quarta_parcela') }}").load();
                    $('.buttons').empty().html(
                        '<button class="btn btn-danger w-50 mr-2 cancelar">Cancelar</button>'+
                        '<button class="btn btn-success w-50 pagamento_quarta_parcela next">4º Parcela Paga</button>'
                    );
                    $(".container_edit").addClass('ocultar');
                    $("ul#listar li.coletivo").removeClass('textoforte-list');
                    $("ul#grupo_finalizados li.coletivo").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list');
                    adicionarReadonly();
                    limparFormulario();
                } else if(id_lista == "pagamento_quinta_parcela") {
                    $('#title_coletivo_por_adesao_table').html("<h4>Pagamento 5º Parcela</h4>");
                    table.ajax.url("{{ route('financeiro.coletivo.pagamento_quinta_parcela') }}").load();
                    $('.buttons').empty().html(
                        '<button class="btn btn-danger w-50 mr-2 cancelar">Cancelar</button>'+
                        '<button class="btn btn-success w-50 pagamento_quinta_parcela next">5º Parcela Paga</button>'
                    );
                    $(".container_edit").addClass('ocultar');
                    $("ul#listar li.coletivo").removeClass('textoforte-list');
                    $("ul#grupo_finalizados li.coletivo").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list');
                    adicionarReadonly();
                    limparFormulario();
                } else if(id_lista == "pagamento_sexta_parcela") {
                    $('#title_coletivo_por_adesao_table').html("<h4>Pagamento 6º Parcela</h4>");
                    table.ajax.url("{{ route('financeiro.coletivo.pagamento_sexta_parcela') }}").load();
                    $('.buttons').empty().html(
                        '<button class="btn btn-danger w-50 mr-2 cancelar">Cancelar</button>'+
                        '<button class="btn btn-success w-50 pagamento_sexta_parcela next">6º Parcela Paga</button>'
                    );
                    $(".container_edit").addClass('ocultar');
                    $("ul#listar li.coletivo").removeClass('textoforte-list');
                    $("ul#grupo_finalizados li.coletivo").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list');
                    adicionarReadonly();
                    limparFormulario();
                } else if(id_lista == "finalizado_coletivo") {
                    $('#title_coletivo_por_adesao_table').html("<h4>Finalizado</h4>");
                    table.ajax.url("{{ route('financeiro.coletivo.pagamento_sexta_parcela') }}").load();
                    $('.buttons').empty().html();
                    $(".container_edit").addClass('ocultar');
                    $("ul#listar li.coletivo").removeClass('textoforte-list');
                    $("ul#grupo_finalizados li.coletivo").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list');                   
                    adicionarReadonly();
                    limparFormulario();

                } else if(id_lista == "cancelado_coletivo") {
                    $('#title_coletivo_por_adesao_table').html("<h4>Cancelado</h4>");
                    table.ajax.url("{{ route('financeiro.coletivo.pagamento_sexta_parcela') }}").load();
                    $('.buttons').empty().html();
                    $(".container_edit").addClass('ocultar');
                    $("ul#listar li.coletivo").removeClass('textoforte-list');
                    $("ul#grupo_finalizados li.coletivo").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list');
                    adicionarReadonly();
                    limparFormulario();
                } else {

                }
            });  

            $("#all_pendentes_individual").on('click',function(){
                $('#title_individual').html("<h4>Geral Individual</h4>");
                table_individual.ajax.url("{{ route('financeiro.individual.geralIndividualPendentes') }}").load();
                $("ul#listar_individual li.individual").removeClass('textoforte-list');
                $(this).addClass('textoforte-list');
            });
            
            $("#all_pendentes_coletivo").on('click',function(){
                $('#title_coletivo_por_adesao_table').html("<h4>Geral Coletivo</h4>");
                table.ajax.url("{{ route('financeiro.coletivo.em_geral') }}").load();
                //$("ul#listar_individual li.individual").removeClass('textoforte-list');
                $("ul#listar li.coletivo").removeClass('textoforte-list');
                $("ul#grupo_finalizados li.coletivo").removeClass('textoforte-list');
                $(this).addClass('textoforte-list');
            });



            $("ul#listar_individual li.individual").on('click',function(){
                let id_lista = $(this).attr('id');
                if(id_lista == "aguardando_em_analise_individual") {
                    $('#title_individual').html("<h4>Em Análise</h4>");
                    table_individual.ajax.url("{{ route('financeiro.individual.em_analise') }}").load();
                    $('.button_individual').empty().html(
                        '<button class="btn btn-danger w-50 mr-2 excluir_individual">Excluir</button>'+
                        '<button class="btn btn-success w-50 next_individual">Conferido</button>'
                    );                      
                    $(".container_edit").removeClass('ocultar')
                    $("ul#listar_individual li.individual").removeClass('textoforte-list');
                    $("#all_pendentes_individual").removeClass('textoforte-list');
                    $("ul#grupo_finalizados_individual li.individual").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list');
                    limparFormulario()
                } else if(id_lista == "aguardando_pagamento_1_parcela_individual") {
                    $('#title_individual').html("<h4>Pag. 1º Parcela</h4>");
                    table_individual.ajax.url("{{ route('financeiro.individual.pagamento_primeira_parcela') }}").load();
                    $('.button_individual').empty().html(
                        '<button class="btn btn-danger w-50 mr-2 cancelar_individual">Cancelar</button>'+
                        '<button class="btn btn-success w-50 emissao_boleto next_individual">1º Parcela Paga</button>'
                    );                      
                    $(".container_edit").addClass('ocultar')
                    adicionarReadonly();
                    $("ul#listar_individual li.individual").removeClass('textoforte-list');
                    $("#all_pendentes_individual").removeClass('textoforte-list');
                    $("ul#grupo_finalizados_individual li.individual").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list');
                    limparFormulario();
                } else if(id_lista == "aguardando_pagamento_2_parcela_individual") {
                    $('#title_individual').html("<h4>Pag. 2º Parcela</h4>");
                    table_individual.ajax.url("{{ route('financeiro.individual.pagamento_segunda_parcela') }}").load();
                    $('.button_individual').empty().html(
                        '<button class="btn btn-danger w-50 mr-2 cancelar_individual">Cancelar</button>'+
                        '<button class="btn btn-success w-50 pagamento_adesao next_individual">2º Parcela Paga</button>'
                    );
                    $(".container_edit").addClass('ocultar')
                    adicionarReadonly();
                    $("ul#listar_individual li.individual").removeClass('textoforte-list');
                    $("#all_pendentes_individual").removeClass('textoforte-list');
                    $("ul#grupo_finalizados_individual li.individual").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list');
                    limparFormulario();
                } else if(id_lista == "aguardando_pagamento_3_parcela_individual") {
                    $('#title_individual').html("<h4>Pag. 3º Parcela</h4>");
                    table_individual.ajax.url("{{ route('financeiro.individual.pagamento_terceira_parcela') }}").load();
                    $('.button_individual').empty().html(
                        '<button class="btn btn-danger w-50 mr-2 cancelar_individual">Cancelar</button>'+
                        '<button class="btn btn-success w-50 pagamento_vegencia next_individual">3º Parcela Paga</button>'
                    );
                    $(".container_edit").addClass('ocultar')
                    adicionarReadonly();
                    $("ul#listar_individual li.individual").removeClass('textoforte-list');
                    $("#all_pendentes_individual").removeClass('textoforte-list');
                    $("ul#grupo_finalizados_individual li.individual").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list');
                    limparFormulario();
                } else if(id_lista == "aguardando_pagamento_4_parcela_individual") {
                    $('#title_individual').html("<h4>Pag. 4º Parcela</h4>");
                    table_individual.ajax.url("{{ route('financeiro.individual.pagamento_quarta_parcela') }}").load();
                    $('.button_individual').empty().html(
                        '<button class="btn btn-danger w-50 mr-2 cancelar_individual">Cancelar</button>'+
                        '<button class="btn btn-success w-50 pagamento_segunda_parcela next_individual">4º Parcela Paga</button>'
                    );
                    $(".container_edit").addClass('ocultar')
                    adicionarReadonly();
                    $("ul#listar_individual li.individual").removeClass('textoforte-list');
                    $("#all_pendentes_individual").removeClass('textoforte-list');
                    $("ul#grupo_finalizados_individual li.individual").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list');
                    limparFormulario();
                } else if(id_lista == "aguardando_pagamento_5_parcela_individual") {
                    $('#title_individual').html("<h4>Pag. 5º Parcela</h4>");
                    table_individual.ajax.url("{{ route('financeiro.individual.pagamento_quinta_parcela') }}").load();
                    $('.button_individual').empty().html(
                        '<button class="btn btn-danger w-50 mr-2 cancelar_individual">Cancelar</button>'+
                        '<button class="btn btn-success w-50 pagamento_terceira_parcela next_individual">5º Parcela Paga</button>'
                    );
                    $(".container_edit").addClass('ocultar')
                    adicionarReadonly();
                    $("ul#listar_individual li.individual").removeClass('textoforte-list');
                    $("#all_pendentes_individual").removeClass('textoforte-list');
                    $("ul#grupo_finalizados_individual li.individual").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list');
                    limparFormulario();
                } else if(id_lista == "aguardando_pagamento_6_parcela_individual") {
                    $('#title_individual').html("<h4>Pag. 6º Parcela</h4>");
                    table_individual.ajax.url("{{ route('financeiro.individual.pagamento_sexta_parcela') }}").load();
                    $('.button_individual').empty().html(
                        '<button class="btn btn-danger w-50 mr-2 cancelar_individual">Cancelar</button>'+
                        '<button class="btn btn-success w-50 pagamento_quarta_parcela next_individual">6º Parcela Paga</button>'
                    );
                    $(".container_edit").addClass('ocultar')
                    adicionarReadonly();
                    $("ul#listar_individual li.individual").removeClass('textoforte-list');
                    $("#all_pendentes_individual").removeClass('textoforte-list');
                    $("ul#grupo_finalizados_individual li.individual").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list');
                    limparFormulario();
                }  else {

                }
            });  

            $("ul#grupo_finalizados li.coletivo").on('click',function(){
                let id_lista = $(this).attr('id');
                if(id_lista == "finalizado_coletivo") {
                    $('#title_coletivo_por_adesao_table').html("<h4>Finalizado</h4>");
                    table.ajax.url("{{ route('financeiro.coletivo.finalizado') }}").load();
                    $('.buttons').empty().html();
                    $(".container_edit").addClass('ocultar');
                    $("ul#listar li.coletivo").removeClass('textoforte-list');
                    $("ul#grupo_finalizados li.coletivo").removeClass('textoforte-list');
                    $("#all_pendentes_coletivo").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list');
                    adicionarReadonly();
                    limparFormulario();
                } else if(id_lista == "cancelado_coletivo") {
                    $('#title_coletivo_por_adesao_table').html("<h4>Cancelado</h4>");
                    table.ajax.url("{{ route('financeiro.coletivo.cancelado') }}").load();
                    $('.buttons').empty().html();
                    $(".container_edit").addClass('ocultar');
                    $("ul#listar li.coletivo").removeClass('textoforte-list');
                    $("ul#grupo_finalizados li.coletivo").removeClass('textoforte-list');
                    $("#all_pendentes_coletivo").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list');
                    adicionarReadonly();
                    limparFormulario();
                } else {

                }
            });

            $("ul#grupo_finalizados_individual li.individual").on('click',function(){
                let id_lista = $(this).attr('id');
                if(id_lista == "finalizado_individual") {
                    $('#title_individual').html("<h4>Finalizado</h4>");
                    table_individual.ajax.url("{{ route('financeiro.individual.finalizado') }}").load();
                    $('.button_individual').empty().html('');
                    $(".container_edit").addClass('ocultar');

                    $("ul#listar_individual li.individual").removeClass('textoforte-list');
                    $("#all_pendentes_individual").removeClass('textoforte-list');
                    $("ul#grupo_finalizados_individual li.individual").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list');


                    adicionarReadonly();
                    limparFormulario();
                } else if(id_lista == "cancelado_individual") {
                    $('#title_individual').html("<h4>Cancelado</h4>");
                    table_individual.ajax.url("{{ route('financeiro.individual.cancelado') }}").load();
                    $('.button_individual').empty().html('');
                    $(".container_edit").addClass('ocultar');

                    $("ul#listar_individual li.individual").removeClass('textoforte-list');
                    $("#all_pendentes_individual").removeClass('textoforte-list');
                    $("ul#grupo_finalizados_individual li.individual").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list');


                    adicionarReadonly();
                    limparFormulario();
                } else {


                }
            });

            $("ul#grupo_finalizados_empresarial li.empresarial").on('click',function(){
                let id_lista = $(this).attr('id');
                console.log(id_lista);
                if(id_lista == "aguardando_finalizado_empresarial") {
                    $('#title_empresarial').html("<h4>Finalizado</h4>");
                    table_individual.ajax.url("{{ route('financeiro.individual.finalizado') }}").load();
                    $('.button_individual').empty().html('');
                    $(".container_edit").addClass('ocultar');

                    $("ul#grupo_finalizados_empresarial li.empresarial").removeClass('textoforte-list');
                    $("ul#listar_empresarial li.empresarial").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list');

                    //adicionarReadonly();
                    //limparFormulario();
                } else if(id_lista == "aguardando_cancelado_empresarial") {
                    $('#title_empresarial').html("<h4>Cancelado</h4>");
                    table_individual.ajax.url("{{ route('financeiro.individual.cancelado') }}").load();
                    $('.button_individual').empty().html('');
                    $(".container_edit").addClass('ocultar');

                    $("ul#grupo_finalizados_empresarial li.empresarial").removeClass('textoforte-list');
                    $("ul#listar_empresarial li.empresarial").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list');

                    //adicionarReadonly();
                    //limparFormulario();
                } else {


                }
            });

            $("ul#listar_empresarial li.empresarial").on('click',function(){
                let id_lista = $(this).attr('id');
                
                if(id_lista == "aguardando_em_analise_empresarial") {
                    $("#title_empresarial").html("<h4>Em Análise</h4>");
                    $('.button_empresarial').empty().html(
                        '<button class="btn btn-danger w-50 mr-2 excluir_empresarial">Excluir</button>'+
                        '<button class="btn btn-success w-50 next_empresarial">Conferido</button>'
                    );
                    
                    //$("ul#listar li.coletivo").removeClass('textoforte-list');
                    $("ul#listar_empresarial li.empresarial").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list');    




                    tableempresarial.ajax.url('{{route("contratos.listarEmpresarial.analise")}}').load();
                } else if(id_lista == "aguardando_pagamento_1_parcela_empresarial") {
                    $("#title_empresarial").html("<h4>Pagamento 1º Parcela</h4>");
                    $('.button_empresarial').empty().html(
                        '<button class="btn btn-danger w-50 mr-2 cancelar_empresarial">Cancelar</button>'+
                        '<button class="btn btn-success w-50 emissao_boleto next_empresarial">1º Parcela Paga</button>'
                    );                      

                    $("ul#listar_empresarial li.empresarial").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list');    



                    tableempresarial.ajax.url('{{route("contratos.listarEmpresarial.primeiraparcela")}}').load();
                } else if(id_lista == "aguardando_pagamento_2_parcela_empresarial") {
                    $("#title_empresarial").html("<h4>Pagamento 2º Parcela</h4>");
                    $('.button_empresarial').empty().html(
                        '<button class="btn btn-danger w-50 mr-2 cancelar_empresarial">Cancelar</button>'+
                        '<button class="btn btn-success w-50 emissao_boleto next_empresarial">2º Parcela Paga</button>'
                    );  
                    
                    $("ul#listar_empresarial li.empresarial").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list');        



                    tableempresarial.ajax.url('{{route("contratos.listarEmpresarial.segundaparcela")}}').load();
                } else if(id_lista == "aguardando_pagamento_3_parcela_empresarial") {
                    $("#title_empresarial").html("<h4>Pagamento 3º Parcela</h4>");
                    $('.button_empresarial').empty().html(
                        '<button class="btn btn-danger w-50 mr-2 cancelar_empresarial">Cancelar</button>'+
                        '<button class="btn btn-success w-50 emissao_boleto next_empresarial">3º Parcela Paga</button>'
                    );    
                    
                    $("ul#listar_empresarial li.empresarial").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list');        


                    tableempresarial.ajax.url('{{route("contratos.listarEmpresarial.terceiraparcela")}}').load();
                } else if(id_lista == "aguardando_pagamento_4_parcela_empresarial") {
                    $("#title_empresarial").html("<h4>Pagamento 4º Parcela</h4>");
                    $('.button_empresarial').empty().html(
                        '<button class="btn btn-danger w-50 mr-2 cancelar_empresarial">Cancelar</button>'+
                        '<button class="btn btn-success w-50 emissao_boleto next_empresarial">4º Parcela Paga</button>'
                    );  
                    
                    $("ul#listar_empresarial li.empresarial").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list');


                    tableempresarial.ajax.url('{{route("contratos.listarEmpresarial.quartaparcela")}}').load();
                } else if(id_lista == "aguardando_pagamento_5_parcela_empresarial") {
                    $("#title_empresarial").html("<h4>Pagamento 5º Parcela</h4>");
                    $('.button_empresarial').empty().html(
                        '<button class="btn btn-danger w-50 mr-2 cancelar_empresarial">Cancelar</button>'+
                        '<button class="btn btn-success w-50 emissao_boleto next_empresarial">5º Parcela Paga</button>'
                    );  
                    
                    $("ul#listar_empresarial li.empresarial").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list');


                    tableempresarial.ajax.url('{{route("contratos.listarEmpresarial.quintaparcela")}}').load();
                } else if(id_lista == "aguardando_pagamento_6_parcela_empresarial") {
                    $("#title_empresarial").html("<h4>Pagamento 6º Parcela</h4>");
                    $('.button_empresarial').empty().html(
                        '<button class="btn btn-danger w-50 mr-2 cancelar_empresarial">Cancelar</button>'+
                        '<button class="btn btn-success w-50 emissao_boleto next_empresarial">6º Parcela Paga</button>'
                    );                

                    $("ul#listar_empresarial li.empresarial").removeClass('textoforte-list');
                    $(this).addClass('textoforte-list');


                    tableempresarial.ajax.url('{{route("contratos.listarEmpresarial.sextaparcela")}}').load();
                } else if(id_lista == "aguardando_finalizado_empresarial") {
                    $("#title_empresarial").html("<h4>Finalizado</h4>");
                    $('.button_empresarial').empty().html('');                
                    tableempresarial.ajax.url('{{route("contratos.listarEmpresarial.finalizado")}}').load();
                } else if(id_lista == "aguardando_cancelado_empresarial") {
                    $("#title_empresarial").html("<h4>Cancelado</h4>");
                    tableempresarial.ajax.url('{{route("contratos.listarEmpresarial.cancelado")}}').load();
                } else {

                }
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

            function removeReadonly() {
                $("#cliente_coletivo_view").removeAttr('readonly').addClass('editar_campo');
                $("#data_nascimento_coletivo_view").removeAttr('readonly').addClass('editar_campo');
                $("#cpf_coletivo_view").removeAttr('readonly').addClass('editar_campo')
                $("#responsavel_financeiro_coletivo").removeAttr('readonly').addClass('editar_campo');
                $("#cpf_financeiro_coletivo_view").removeAttr('readonly').addClass('editar_campo');
                $("#celular_coletivo_view").removeAttr('readonly').addClass('editar_campo');
                $("#telefone_coletivo_view").removeAttr('readonly').addClass('editar_campo');
                $("#email_coletivo_view").removeAttr('readonly').addClass('editar_campo');
                $("#cep_coletivo_view").removeAttr('readonly').addClass('editar_campo');
                $("#cidade_coletivo_view").removeAttr('readonly').addClass('editar_campo');
                $("#uf_coletivo_view").removeAttr('readonly').addClass('editar_campo');
                $("#bairro_coletivo_view").removeAttr('readonly').addClass('editar_campo');
                $("#rua_coletivo_view").removeAttr('readonly').addClass('editar_campo');
                $("#complemento_coletivo_view").removeAttr('readonly').addClass('editar_campo');
            }

            function adicionarReadonly() {               
                $("#cliente_coletivo_view").attr('readonly',true).removeClass('editar_campo');
                $("#data_nascimento_coletivo_view").attr('readonly',true).removeClass('editar_campo');
                $("#cpf_coletivo_view").attr('readonly',true).removeClass('editar_campo');
                $("#responsavel_financeiro_coletivo").attr('readonly',true).removeClass('editar_campo');
                $("#cpf_financeiro_coletivo_view").attr('readonly',true).removeClass('editar_campo');
                $("#celular_coletivo_view").attr('readonly',true).removeClass('editar_campo');
                $("#telefone_coletivo_view").attr('readonly',true).removeClass('editar_campo');
                $("#email_coletivo_view").attr('readonly',true).removeClass('editar_campo')
                $("#cep_coletivo_view").attr('readonly',true).removeClass('editar_campo')
                $("#cidade_coletivo_view").attr('readonly',true).removeClass('editar_campo');
                $("#uf_coletivo_view").attr('readonly',true).removeClass('editar_campo')
                $("#bairro_coletivo_view").attr('readonly',true).removeClass('editar_campo')
                $("#rua_coletivo_view").attr('readonly',true).removeClass('editar_campo')
                $("#complemento_coletivo_view").attr('readonly',true).removeClass('editar_campo')
            }

            function adicionarReadonlyIndividual() {
                $("#cliente").attr('readonly',true).removeClass('editar_campo_individual')
                $("#data_nascimento").attr('readonly',true).removeClass('editar_campo_individual')
                $("#cpf").attr('readonly',true).removeClass('editar_campo_individual')
                $("#responsavel_financeiro").attr('readonly',true).removeClass('editar_campo_individual')
                $("#cpf_financeiro").attr('readonly',true).removeClass('editar_campo_individual')
                $("#celular_individual_view_input").attr('readonly',true).removeClass('editar_campo_individual')
                $("#telefone_individual_view_input").attr('readonly',true).removeClass('editar_campo_individual')
                $("#email").attr('readonly',true).removeClass('editar_campo_individual')
                $("#cep_individual_cadastro").attr('readonly',true).removeClass('editar_campo_individual')
                $("#cidade").attr('readonly',true).removeClass('editar_campo_individual')
                $("#uf").attr('readonly',true).removeClass('editar_campo_individual')
                $("#bairro_individual_cadastro").attr('readonly',true).removeClass('editar_campo_individual')
                $("#rua_individual_cadastro").attr('readonly',true).removeClass('editar_campo_individual')
                $("#complemento_individual_cadastro").attr('readonly',true).removeClass('editar_campo_individual')
            }

            function removeReadonlyIndividual() {
                $("#cliente").removeAttr('readonly',true).addClass('editar_campo_individual');
                $("#data_nascimento").removeAttr('readonly',true).addClass('editar_campo_individual');
                $("#cpf").removeAttr('readonly',true).addClass('editar_campo_individual');
                $("#responsavel_financeiro").removeAttr('readonly',true).addClass('editar_campo_individual');
                $("#cpf_financeiro").removeAttr('readonly',true).addClass('editar_campo_individual');
                $("#celular_individual_view_input").removeAttr('readonly',true).addClass('editar_campo_individual');
                $("#telefone_individual_view_input").removeAttr('readonly',true).addClass('editar_campo_individual');
                $("#email").removeAttr('readonly',true).addClass('editar_campo_individual');
                $("#cep_individual_cadastro").removeAttr('readonly',true).addClass('editar_campo_individual');
                $("#cidade").removeAttr('readonly',true).addClass('editar_campo_individual');
                $("#uf").removeAttr('readonly',true).addClass('editar_campo_individual');
                $("#bairro_individual_cadastro").removeAttr('readonly',true).addClass('editar_campo_individual');
                $("#rua_individual_cadastro").removeAttr('readonly',true).addClass('editar_campo_individual');
                $("#complemento_individual_cadastro").removeAttr('readonly',true).addClass('editar_campo_individual');
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






        });
    </script>
@stop


@section('css')
    <style>
        #container_mostrar_comissao {width:439px;height:555px;background-color: #123449;position: absolute;right:5px;border-radius: 5px;}
        .container_edit {display:flex;justify-content:end;}
        .ativo {background-color:#FFF !important;color: #000 !important;}
        .ocultar {display: none;}
        .list_abas {list-style: none;display: flex;border-bottom: 1px solid white;margin: 0;padding: 0;}
        .list_abas li {color: #fff;width: 150px;padding: 8px 5px;text-align:center;border-radius: 5px 5px 0 0;background-color:#123449;}
        .list_abas li:hover {cursor: pointer;}    
        .list_abas li:nth-of-type(2) {margin: 0 1%;}
        .textoforte {background-color:rgba(255,255,255,0.5);color:black;}
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
        .container_div_info {background-color:rgba(0,0,0,1);position:absolute;width:500px;right:0px;top:57px;min-height: 700px;display: none;z-index: 1;color: #FFF;}
        #padrao {width:50px;background-color:#FFF;color:#000;}
        .buttons {display: flex;}
        .button_individual {display:flex;}
        .button_empresarial {display: flex;}
    </style>
@stop




