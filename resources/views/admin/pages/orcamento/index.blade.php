@extends('adminlte::page')
@section('title', 'Orçamento')
@section('content_header')
	<h3 class="text-white">Orçamento</h3>
@stop

@section('content')
	 <div class="card shadow" style="background-color:#123449;color:#FFF;">
		<div class="card-body" style="box-shadow: rgba(0,0,0,0.8) 0.6em 0.7em 5px;">
			<form action="" method="post" class="px-3">
        		@csrf 

		        <div class="form-group">
		        	<p>Tabela Origem:</p>
		            <select name="origem_cidade" id="origem_cidade" class="form-control">
		                <option value="">--Escolher a cidade--</option>
		               	@foreach($cidades as $c)
		               		<option value="{{$c->id}}">{{$c->nome}}</option>
		               	@endforeach
		            </select>
		            <div class="error_origem_cidade"></div>    
		        </div>


		        <div class="d-flex">

		            <div  style="flex-basis:10%;">
		                <span class="text-white">0-18</span>
		                <div class="border border-white rounded">
		                    <div class="d-flex content">
		                        <button type="button" class="d-flex justify-content-center minus bg-danger" id="faixa-0-18" style="border:none;width:30%;" aria-label="−" tabindex="0">
		                            <span class="text-white font-weight-bold" style="font-size:1.5em;">－</span>
		                        </button>
		                        <input type="tel" data-change="change_faixa_0_18" name="faixas_etarias[1]" value="{{isset($colunas) && in_array(1,$colunas) ? $faixas[array_search(1, array_column($faixas, 'faixa_etaria_id'))]['faixa_quantidade'] : ''}}" id="faixa-input-0-18" class="text-center font-weight-bold flex-fill faixas_etarias" style="border:none;width:40%;font-size:1.2em;" value="" step="1" min="0" class="text-center" />
		                        <button type="button" class="d-flex justify-content-center plus" style="border:none;background-color:rgb(17,117,185);width:30%;" aria-label="+" tabindex="0">
		                            <span class="text-white font-weight-bold" style="font-size:1.5em;">＋</span>
		                        </button>
		                    </div>
		                </div>  
		            </div>      


		            <div  style="flex-basis:10%;margin:0 10px;">
		                <span class="text-white">19-23</span>
		                <div class="border border-white rounded">
		                    <div class="d-flex content">
		                        <button type="button" class="d-flex justify-content-center minus bg-danger" id="faixa-19-23" style="border:none;background:#FF0000;width:30%;" aria-label="−" tabindex="0">
		                            <span class="text-white font-weight-bold" style="font-size:1.5em">－</span>
		                        </button>
		                        <input type="tel" data-change="change_faixa_19_23" name="faixas_etarias[2]" value="{{isset($colunas) && in_array(2,$colunas) ? $faixas[array_search(2, array_column($faixas, 'faixa_etaria_id'))]['faixa_quantidade'] : ''}}" id="faixa-input-19-23" class="text-center font-weight-bold faixas_etarias" style="border:none;width:40%;font-size:1.2em;" value="" step="1" min="0" class="text-center" />
		                        <button type="button" class="d-flex justify-content-center plus" style="border:none;background-color:#00FF00;width:30%;" aria-label="+" tabindex="0">
		                            <span class="text-white font-weight-bold" style="font-size:1.5em">＋</span>
		                        </button>
		                    </div>
		                </div>  
		            </div>      

		            <div  style="flex-basis:10%;">
		                <span class="text-white">24-28</span>
		                <div class="border border-white rounded">
		                    <div class="d-flex content">
		                        <button type="button" class="d-flex justify-content-center minus bg-danger" id="faixa-24-28" style="border:none;width:30%;" aria-label="−" tabindex="0">
		                            <span class="text-white font-weight-bold" style="font-size:1.5em">－</span>
		                        </button>
		                        <input type="tel" data-change="change_faixa_24_28" name="faixas_etarias[3]" value="{{isset($colunas) && in_array(3,$colunas) ? $faixas[array_search(3, array_column($faixas, 'faixa_etaria_id'))]['faixa_quantidade'] : ''}}" id="faixa-input-24-28" class="text-center font-weight-bold faixas_etarias" style="border:none;width:40%;font-size:1.2em;" value="" step="1" min="0" class="text-center" />
		                        <button type="button" class="plus d-flex justify-content-center" style="border:none;background-color:rgb(17,117,185);width:30%;" aria-label="+" tabindex="0">
		                            <span class="text-white font-weight-bold" style="font-size:1.5em">＋</span>
		                        </button>
		                    </div>
		                </div>  
		            </div>      

		            <div  style="flex-basis:10%;margin:0 10px;">
		                <span class="text-white">29-33</span>
		                <div class="border border-white rounded">
		                    <div class="d-flex content">
		                        <button type="button" class="minus d-flex justify-content-center bg-danger" id="faixa-29-33" style="border:none;width:30%;" aria-label="−" tabindex="0">
		                            <span class="text-white font-weight-bold" style="font-size:1.5em;">－</span>
		                        </button>
		                        <input type="tel" data-change="change_faixa_29_33" name="faixas_etarias[4]" value="{{isset($colunas) && in_array(4,$colunas) ? $faixas[array_search(4, array_column($faixas, 'faixa_etaria_id'))]['faixa_quantidade'] : ''}}" id="faixa-input-29-33" class="text-center font-weight-bold faixas_etarias" style="border:none;width:40%;font-size:1.2em;" value="" step="1" min="0" class="text-center" />
		                        <button type="button" class="plus  d-flex justify-content-center" style="border:none;background-color:rgb(17,117,185);width:30%;" aria-label="+" tabindex="0">
		                            <span class="text-white font-weight-bold" style="font-size:1.5em;">＋</span>
		                        </button>
		                    </div>
		                </div>  
		            </div>      

		            <div  style="flex-basis:10%;">
		                <span class="text-white">34-38</span>
		                <div class="border border-white rounded">
		                    <div class="d-flex content">
		                        <button type="button" class="minus d-flex justify-content-center bg-danger" id="faixa-34-38" style="border:none;width:30%;" aria-label="−" tabindex="0">
		                            <span class="text-white font-weight-bold" style="font-size:1.5em;">－</span>
		                        </button>
		                        <input type="tel" name="faixas_etarias[5]" data-change="change_faixa_34_38" value="{{isset($colunas) && in_array(5,$colunas) ? $faixas[array_search(5, array_column($faixas, 'faixa_etaria_id'))]['faixa_quantidade'] : ''}}" id="faixa-input-34-38" class="text-center font-weight-bold faixas_etarias" style="border:none;width:40%;font-size:1.2em;" value="" step="1" min="0" />
		                        <button type="button" class="plus d-flex justify-content-center" style="border:none;background-color:rgb(17,117,185);width:30%;" aria-label="+" tabindex="0">
		                            <span class="text-white font-weight-bold" style="font-size:1.5em;">＋</span>
		                        </button>
		                    </div>
		                </div>  
		            </div> 
		                        

		            <div  style="flex-basis:10%;margin:0 10px;">
		                <span class="text-white">39-43</span>
		                <div class="border border-white rounded">
		                    <div class="d-flex content">
		                        <button type="button" class="minus d-flex justify-content-center bg-danger" id="faixa-39-43" style="border:none;width:30%;" aria-label="−" tabindex="0">
		                            <span class="text-white font-weight-bold" style="font-size:1.5em;">－</span>
		                        </button>
		                        <input type="tel" name="faixas_etarias[6]" data-change="change_faixa_39_43" value="{{isset($colunas) && in_array(6,$colunas) ? $faixas[array_search(6, array_column($faixas, 'faixa_etaria_id'))]['faixa_quantidade'] : ''}}" id="faixa-input-39-43" class="text-center font-weight-bold flex-fill w-25 faixas_etarias" style="border:none;width:40%;font-size:1.2em;" value="" step="1" min="0" class="text-center" />
		                        <button type="button" class="plus d-flex justify-content-center" style="border:none;background-color:rgb(17,117,185);width:30%;" aria-label="+" tabindex="0">
		                            <span class="text-white font-weight-bold" style="font-size:1.5em;">＋</span>
		                        </button>
		                    </div>
		                </div>  
		            </div>      


		            <div  style="flex-basis:10%;">
		                <span class="text-white">44-48</span>
		                <div class="border border-white rounded">
		                    <div class="d-flex content">
		                        <button type="button" class="minus d-flex justify-content-center bg-danger" id="faixa-44-48" style="border:none;width:30%;" aria-label="−" tabindex="0">
		                            <span class="text-white font-weight-bold" style="font-size:1.5em;">－</span>
		                        </button>
		                        <input type="tel" name="faixas_etarias[7]" data-change="change_faixa_44_48" value="{{isset($colunas) && in_array(7,$colunas) ? $faixas[array_search(7, array_column($faixas, 'faixa_etaria_id'))]['faixa_quantidade'] : ''}}" id="faixa-input-44-48" class="text-center font-weight-bold faixas_etarias" style="border:none;width:40%;font-size:1.2em;" value="" step="1" min="0" />
		                        <button type="button" class="plus d-flex justify-content-center" style="border:none;background-color:rgb(17,117,185);width:30%;" aria-label="+" tabindex="0">
		                            <span class="text-white font-weight-bold" style="font-size:1.5em;">＋</span>
		                        </button>
		                    </div>
		                </div>  
		            </div>      

		            <div  style="flex-basis:10%;margin:0 10px;">
		                <span class="text-white">49-53</span>
		                <div class="border border-white rounded">
		                    <div class="d-flex content">
		                        <button type="button" class="minus d-flex justify-content-center bg-danger" id="faixa-49-53" style="border:none;width:30%;" aria-label="−" tabindex="0">
		                            <span class="text-white font-weight-bold" style="font-size:1.5em;">－</span>
		                        </button>
		                        <input type="tel" name="faixas_etarias[8]" data-change="change_faixa_49_53" value="{{isset($colunas) && in_array(8,$colunas) ? $faixas[array_search(8, array_column($faixas, 'faixa_etaria_id'))]['faixa_quantidade'] : ''}}" id="faixa-input-49-53" class="text-center font-weight-bold faixas_etarias" style="border:none;width:40%;font-size:1.2em;" value="" step="1" min="0" />
		                        <button type="button" class="plus d-flex justify-content-center" style="border:none;background-color:rgb(17,117,185);width:30%;" aria-label="+" tabindex="0">
		                            <span class="text-white font-weight-bold" style="font-size:1.5em;">＋</span>
		                        </button>
		                    </div>
		                </div>  
		            </div>      

		            <div style="flex-basis:10%;margin:0 10px 0 0;">
		                <span class="text-white">54-58</span>
		                <div class="border border-white rounded">
		                    <div class="d-flex content">
		                        <button type="button" class="minus d-flex justify-content-center bg-danger" id="faixa-54-58" style="border:none;width:30%;" aria-label="−" tabindex="0">
		                            <span class="text-white font-weight-bold" style="font-size:1.5em;">－</span>
		                        </button>
		                        <input type="tel" name="faixas_etarias[9]" data-change="change_faixa_54_58" value="{{isset($colunas) && in_array(9,$colunas) ? $faixas[array_search(9, array_column($faixas, 'faixa_etaria_id'))]['faixa_quantidade'] : ''}}" id="faixa-input-54-58"  class="text-center font-weight-bold faixas_etarias d-flex" style="border:none;width:40%;font-size:1.2em;" value="" step="1" min="0" />
		                        <button type="button" class="plus d-flex justify-content-center" style="border:none;background-color:rgb(17,117,185);width:30%;" aria-label="+" tabindex="0">
		                            <span class="text-white font-weight-bold" style="font-size:1.5em;">＋</span>
		                        </button>
		                    </div>
		                </div>  
		            </div>      

			        <div style="flex-basis:10%;">
			            <span class="text-white">59+</span>
			            <div class="border border-white rounded">
			                <div class="d-flex content">
			                    <button type="button" class="minus d-flex justify-content-center bg-danger"  id="faixa-59" style="border:none;width:30%;" aria-label="−" tabindex="0">
			                        <span class="text-white font-weight-bold" style="font-size:1.5em;">－</span>
			                    </button>
			                    <input type="tel" data-change="change_faixa_59" name="faixas_etarias[10]" value="{{isset($colunas) && in_array(10,$colunas) ? $faixas[array_search(10, array_column($faixas, 'faixa_etaria_id'))]['faixa_quantidade'] : ''}}" id="faixa-input-59" class="text-center font-weight-bold faixas_etarias d-flex" style="border:none;width:40%;font-size:1.2em;" value="" step="1" min="0" />
			                    
			                    <button type="button" class="plus d-flex justify-content-center" style="border:none;background-color:rgb(17,117,185);width:30%;" aria-label="+" tabindex="0">
			                        <span class="text-white font-weight-bold" style="font-size:1.5em;">＋</span>
			                    </button>
			                </div>
			            </div>  
			        </div>
			    </div>
	        	<input type="submit" class="btn btn-block btn-light my-3" value="Ver Planos" name="verPlanos" />
    		</form>
		</div>
	</div>            

	<div id="aquiPlano"></div>


@stop 


@section('js')
	<script>
		$(function(){

			$.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });



			let plus = $(".plus");
            let minus = $(".minus");
            $(plus).on('click',function(e){
                let alvo = e.target;
                let pai = alvo.closest('.content');
                let input = $(pai).find('input'); 
                if(input.val() == "") {
                    input.val(0);
                }
                let newValue = parseInt(input.val()) + 1;
                if(newValue >= 0) {
                    input.val(newValue);
                }
            });

            $(minus).on('click',function(e){
                let alvo = e.target;
                let pai = alvo.closest('.content');
                let input = $(pai).find('input');
                let newValue = parseInt(input.val()) - 1;
                if(newValue >= 0) {
                    input.val(newValue);
                }
            });



			$('body').on('click','input[name="verPlanos"]',function(e){	
				e.preventDefault();
				let tabela_origem = $("#origem_cidade").val();
				$.ajax({
				 	url:"{{route('orcamento.montarOrcamento')}}",
                    method:"POST",
                    data:{
                    	"tabela_origem": tabela_origem,
                    	"faixas" : [{
                            '1' : $('#faixa-input-0-18').val(),
                            '2' : $('#faixa-input-19-23').val(),
                            '3' : $('#faixa-input-24-28').val(),
                            '4' : $('#faixa-input-29-33').val(),
                            '5' : $('#faixa-input-34-38').val(),
                            '6' : $('#faixa-input-39-43').val(),
                            '7' : $('#faixa-input-44-48').val(),
                            '8' : $('#faixa-input-49-53').val(),
                            '9' : $('#faixa-input-54-58').val(),
                            '10' : $('#faixa-input-59').val()
                        }]
                    },
                    success:function(res) {

                    	$("#aquiPlano").html(res);


                    	
                    }
				 });
				return false;
			});
		});

	</script>
@stop


@section('css')
<style>
        .cards_destaque_links {text-align:center;display:flex;align-items: center;justify-content: center;min-height:50px;display:flex;}
        .cards {cursor: pointer;}
        div p {margin-bottom:0px !important;}
		* {margin:0;padding:0;box-sizing:border-box;}       
        .container_planos_section {display:flex;flex-wrap:wrap;justify-content: space-between;}
        .planos {margin-bottom:15px;border:2px solid black;border-radius: 10px;display:flex;flex-wrap:wrap;flex-basis: 49%;box-shadow: 5px 5px 5px 5px black;}
        .logo {display:flex;flex-basis:100%;justify-content: center;}
        .coparticipacao_odonto {display:flex;margin:0 auto;flex-basis:90%;font-size:1em;margin-right:10px;align-items: center;justify-content: center;}
        .coparticipacao_odonto p {font-weight:bold;font-size:1.1em;text-decoration: underline;}
        .faixas_etarias_container {margin-left:8px;}
        .faixas_etarias_title {background-color:rgb(49,134,155);padding:16px 0;color:#FFF;border-right: 1px solid black;}
        .faixas_etarias_nome {border:1px solid black;padding:5px;box-sizing:border-box;}
        .faixas_total_plano {background-color:rgb(49,134,155);color:#FFF;padding:10px 5px;border-right:1px solid black;}
        div.apartamento,div.enfermaria,div.ambulatorial {display: flex;flex-direction: column;flex-basis: 25%;}
        div.apartamento .plano_container_header,div.enfermaria .plano_container_header {border-right:1px solid black;} 
        .plano_container_header_acomodacao {display: block;text-align: center;color:#FFF;}
        .plano_container_header {background-color:rgb(49,134,155);padding:5px;}
        .plano_total {border:1px solid black;padding:5px;box-sizing:border-box;text-align: center;}
        .total_somado {background-color:rgb(49,134,155);font-weight: bold;text-align: center;color:#FFF;padding:10px 5px;}
        div.apartamento .total_somado,div.enfermaria .total_somado {border-right:1px solid black;}
        .plano_container_header_title {font-size: 0.9em;text-align: center;display: block;color:#FFF;}
        .planos:hover {box-shadow: inset 0 0 1em black, 0 0 1em #808080;cursor:pointer;}
        .imagem-operadora a {margin-left:10px;}
        .imagem-operadora a:hover img {box-shadow: 5px 5px 5px 5px black;padding:10px;}
        .card_plano {flex-basis:31.5%;margin:0 1.8% 2% 0;background-color:#123449;color:#FFF;}
        .card_plano:hover {cursor: pointer;}
        table {border: 1px solid #FFF;width: 100%;border-collapse: collapse;}
        td {padding: 3.5px;}
    </style>        
@stop


