@extends('adminlte::page')
@section('title', 'Gerenciavel')

@section('content_top_nav_right')
   
    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt text-white"></i>
    </a>
    
@stop

@section('content_header')
    <h1 class=" border-bottom border-dark">Histórico</h1>
@stop


@section('content')

    <main class="container_full_cards">

        <section class="p-1 card_info">
                                    
            <div class="d-flex mb-2">
                    
                <div style="flex-basis:25%;">
                    <span class="text-white" style="font-size:0.8em;">Administradora:</span>
                    <input type="text" id="administradora_coletivo_view" class="form-control  form-control-sm font-small" value="{{$contrato->administradora->nome}}" readonly>
                </div>

                <div style="flex-basis:33%;margin:0 1%;">    
                    <span class="text-white" style="font-size:0.8em;">Tipo Plano:</span>
                    <input type="text" id="tipo_plano_coletivo_view" class="form-control  form-control-sm font-small" value="{{$contrato->plano->nome}}" readonly>
                </div>

                <div style="flex-basis:40%;" id="status">
                    <span class="text-white" style="margin:4px 0 0 0;padding:0;font-size:0.8em;display:flex;">Status:</span>
                    <input type="text" id="estagio_contrato_coletivo_view" class="form-control form-control-sm font-small" value="Parc {{$contrato->comissao->comissaoAtual->parcela}}" readonly>
                </div>  

            </div>

            <div class="d-flex mb-2">
                
                <div style="flex-basis:43%;">
                    <span class="text-white" style="font-size:0.8em;">Cliente:</span>
                    <input type="text" id="cliente_coletivo_view" class="form-control form-control-sm font-small" value="{{$contrato->clientes->nome}}" readonly>
                </div>
                
                <div style="flex-basis:25%;margin:0 1%;">
                    <span class="text-white" style="font-size:0.8em;">Data Nasc:</span>
                    <input type="text" id="data_nascimento_coletivo_view" class="form-control form-control-sm font-small" value="{{date('d/m/Y',strtotime($contrato->clientes->data_nascimento))}}" readonly>
                </div>
                
                <div style="flex-basis:30%;">
                    <span class="text-white" style="font-size:0.8em;">Codigo Externo:</span>
                    <input type="text" id="codigo_externo_coletivo_view" class="form-control  form-control-sm font-small" value="{{$contrato->codigo_externo}}" readonly>
                </div>    

            </div>

            <div class="d-flex mb-2">

                <div style="flex-basis:28%;">
                    <span class="text-white" style="font-size:0.8em;">CPF:</span>
                    <input type="text" id="cpf_coletivo_view" class="form-control form-control-sm font-small" value="{{$contrato->clientes->cpf}}" readonly>
                </div>

                <div style="flex-basis:38%;margin:0 1%;">
                    <span class="text-white" style="font-size:0.8em;">Responsavel Financeiro:</span>
                    <input type="text" id="responsavel_financeiro_coletivo" class="form-control  form-control-sm font-small" readonly>
                </div>
                
                <div style="flex-basis:32%;">
                    <span class="text-white" style="font-size:0.8em;">CPF Financeiro:</span>
                    <input type="text" id="cpf_financeiro_coletivo_view" class="form-control  form-control-sm font-small" readonly>
                </div>    

            </div>

            <div class="d-flex mb-2">
                
                <div style="flex-basis:28%;margin-right:1%;">
                    <span class="text-white" style="font-size:0.8em;">Celular:</span>
                    <input type="text" id="celular_coletivo_view" class="form-control form-control-sm font-small" value="{{$contrato->clientes->celular}}" readonly>
                </div>

                <div style="flex-basis:26%;margin-right:1%;">
                    <span class="text-white" style="font-size:0.8em;">Telefone:</span>
                    <input type="text" id="telefone_coletivo_view" class="form-control form-control-sm font-small" value="{{$contrato->clientes->telefone}}" readonly>
                </div>

                <div style="flex-basis:46%;">
                    <span class="text-white" style="font-size:0.8em;">Email:</span>
                    <input type="text" id="email_coletivo_view" class="form-control form-control-sm font-small" value="{{$contrato->clientes->email}}" readonly>
                </div>

            </div>


            <div class="d-flex mb-2">

                <div style="flex-basis:22%;">
                    <span class="text-white" style="font-size:0.8em;">CEP:</span>
                    <input type="text" id="cep_coletivo_view" class="form-control form-control-sm font-small" value="{{$contrato->clientes->cep}}" value="cep" readonly>
                </div>

                <div style="flex-basis:78%;margin:0 1%;">
                    <span class="text-white" style="font-size:0.8em;">Cidade:</span> 
                    <input type="text" id="cidade_coletivo_view" class="form-control  form-control-sm font-small" value="{{$contrato->clientes->cidade}}" readonly>
                </div>

                <div style="flex-basis:10%;">
                    <span class="text-white" style="font-size:0.8em;">UF:</span>
                    <input type="text" id="uf_coletivo_view" class="form-control form-control-sm font-small" value="{{$contrato->clientes->uf}}" readonly>
                </div>

            </div> 


            <div class="d-flex mb-2">
                
                    <div style="flex-basis:30%;">
                    <span class="text-white" style="font-size:0.8em;">Bairro:</span>
                    <input type="text" id="bairro_coletivo_view" class="form-control form-control-sm font-small" value="{{$contrato->clientes->bairro}}" readonly>
                </div>    
        
                <div style="flex-basis:30%;margin:0 1%;">
                    <span class="text-white" style="font-size:0.8em;">Rua:</span>
                    <input type="text" id="rua_coletivo_view" class="form-control form-control-sm font-small" value="{{$contrato->clientes->rua}}" readonly>
                </div>

                <div style="flex-basis:40%;">
                    <span class="text-white" style="font-size:0.8em;">Complemento:</span>
                    <input type="text" id="complemento_coletivo_view" class="form-control form-control-sm font-small" value="{{$contrato->clientes->complemento}}" readonly>
                </div>

            </div>

        
            <div class="d-flex mb-2">

                <div style="flex-basis:31%;">
                    <span class="text-white" style="font-size:0.8em;">Data Contrato:</span>
                    <input type="text" id="data_contrato_coletivo_view" value="{{date('d/m/Y',strtotime($contrato->created_at))}}" class="form-control form-control-sm font-small" readonly>
                </div>

                <div style="flex-basis:31%;margin:0 1%;">
                    <span class="text-white" style="font-size:0.8em;">Valor Contrato:</span>
                    <input type="text" id="valor_contrato_coletivo_view" value="{{number_format($contrato->valor_plano,2,',','.')}}" class="form-control  form-control-sm font-small" readonly>
                </div>

                    

                <div style="flex-basis:31%;margin-right:1%;">
                    <span class="text-white" style="font-size:0.8em;">Valor Adesão:</span>
                    <input type="text" id="valor_adesao_coletivo_view" class="form-control  form-control-sm font-small" value="{{number_format($contrato->valor_adesao,2,',','.')}}" readonly>
                </div>

                <div style="flex-basis:7%">    
                    <span class="text-white" style="font-size:0.8em;">Vidas</span>
                    <input type="text" id="quantidade_vidas_coletivo_cadastrar" value="{{$contrato->somarCotacaoFaixaEtaria[0]->soma}}" class="form-control  form-control-sm font-small" readonly>
                </div>
        
            </div>


                <div class="d-flex mb-2">

                <div style="flex-basis:23%;">
                    <span class="text-white" style="font-size:0.8em;">Data Boleto:</span>
                    <input type="text" id="data_boleto_coletivo_view" class="form-control  form-control-sm font-small" value="{{date('d/m/Y',strtotime($contrato->data_boleto))}}" readonly>
                </div>

                <div style="flex-basis:23%;margin:0 1%;">
                    <span class="text-white" style="font-size:0.8em;">Data Vigência:</span>
                    <input type="text" id="data_vigencia_coletivo_view" class="form-control  form-control-sm font-small" value="{{date('d/m/Y',strtotime($contrato->data_vigencia))}}" readonly>
                </div>
                
                <div style="flex-basis:54%;">
                    <span class="text-white" style="font-size:0.8em;">Plano Contratado:</span>
                    <input type="text" id="texto_descricao_coletivo_view" class="form-control form-control-sm font-small" value="{{$texto}}" readonly> 
                </div>    

                
            </div>                
        </section>   
        
        
        @php 
            if($plano == 3) {
                $dados = ["Pag Adesao","Parc 2","Parc 3","Parc 4","Parc 5","Parc 6","Parc 7"];
            }
        @endphp



        <section class="historico_corretora">
            <h5 class="text-center d-flex align-items-center align-self-center justify-content-center mt-1">Corretora</h5>

            <table class="table table-sm">
                <thead>
                    <tr>
                        <th style="font-size:0.875em;">Parcela</th>
                        <th style="font-size:0.875em;">Valor</th>
                        <th style="font-size:0.875em;">Vencimento</th>
                        <th style="font-size:0.875em;">Baixa</th>
                        <th style="font-size:0.875em;">Dias Atr</th>
                        <th style="font-size:0.875em;">Comissão</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($contrato->comissao->comissoesLancadasCorretora as $k => $co)
                        <tr>
                            <td class="text-center" style="font-size:0.875em;">
                               @if($plano == 3)
                                    {{$dados[$k]}}
                               @else
                                    {{$co->parcela}}     
                               @endif
                            </td>
                            <td style="font-size:0.875em;">{{number_format($co->valor_plano,2,',','.')}}</td>
                            <td style="font-size:0.875em;">{{date('d/m/Y',strtotime($co->data))}}</td>
                            <td style="font-size:0.875em;">{{empty($co->data_baixa_gerente) ? '---' :  date('d/m/Y',strtotime($co->data_baixa_gerente))}}</td>
                            <td class="text-center" style="font-size:0.875em;">{{$co->quantidade_dias}}</td>
                            <td style="font-size:0.875em;" align="right">
                                <span style="margin-right:15px;">{{number_format($co->valor,2,',','.')}}</span>
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-around">
                <span>Total Recebido: R$ {{number_format($total_corretora_pago,2,",",".")}}</span>
                <span>Total a Receber: R$ {{number_format($total_corretora_nao_pago,2,",",".")}}</span>
            </div>


        </section> 
        
        <section class="historico_corretor">
            <h5 class="text-center d-flex align-items-center align-self-center justify-content-center mt-1">Corretor</h5>

            <table class="table table-sm">
                <thead>
                    <tr>
                        <th style="font-size:0.875em;">Parcela</th>
                        <th style="font-size:0.875em;">Vencimento</th>
                        <th style="font-size:0.875em;">Baixa</th>
                        <th style="font-size:0.875em;">Dias Atr</th>
                        <th style="font-size:0.875em;">Comissão</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contrato->comissao->comissoesLancadas as $kk => $cr)
                        <tr>
                            <td class="text-center" style="font-size:0.875em;">
                                @if($plano == 3)
                                    {{$dados[$kk]}}
                               @else
                                    {{$cr->parcela}}     
                               @endif
                            </td>
                            <td style="font-size:0.875em;">{{date('d/m/Y',strtotime($cr->data))}}</td>
                            <td style="font-size:0.875em;">{{empty($cr->data_baixa) ? '---' :  date('d/m/Y',strtotime($cr->data_baixa))}}</td>
                            <td style="font-size:0.875em;">{{$cr->quantidade_dias}}</td>
                            <td style="font-size:0.875em;" align="right">
                                <span style="margin-right:15px;">{{number_format($cr->valor,2,',','.')}}</span>
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-between">
                <span style="margin-left:28px;">Total Pago: R$ {{number_format($total_corretores_pago,2,",",".")}}</span>
                <span style="margin-right:25px;">Total a Pagar: R$ {{number_format($total_corretores_nao_paga,2,",",".")}}</span>
            </div>



        </section>    


        

    </main>            

    <a href="{{route('gerente.index')}}" class="btn btn-block btn-lg mt-3 text-white" style="background-color:#123449;">Voltar</a>
@stop

@section('css')

    <style>

        .container_full_cards {display: flex;}
        .card_info {background-color:#123449;flex-basis: 33%;border-radius: 5px;}
        .historico_pagamento {background-color:#123449;flex-basis: 19%;margin-left:1%;color:#FFF;border-radius: 5px;}
        .historico_pagamento h3 {color:#FFF;border-bottom: 1px solid #FFF;text-align: center;padding:5px 0;}
        .historico_corretora {background-color:#123449;flex-basis: 33%;margin-left:1%;color:#FFF;border-radius: 5px;}
        .historico_corretor {background-color:#123449;flex-basis: 33%;margin-left:1%;color:#FFF;border-radius: 5px;}
        

    </style>


@stop