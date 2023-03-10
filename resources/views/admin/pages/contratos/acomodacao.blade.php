@if(count($valores)>=1)
<h4 class="py-2 text-white">Nossos Planos</h4>  
<section class="d-flex justify-content-between">
    @foreach($valores as $v)
    <div class="d-flex justify-content-center flex-column rounded valores-acomodacao mb-3 py-2 border border-dark" style="width:30%;color:white;background-color:#C5D4EB;color:black;">
        
        <div class="d-flex">
            <h4 class="text-center w-25 d-flex ml-2" style="background-color:#fff;border:2px solid black;border-radius:5px;">
                <img src="{{asset($v->operadora)}}" class="d-flex align-self-center p-1" alt="" width="100%" height="100%">
            </h4>
            <div class="d-flex w-75 flex-column align-self-center align-items-end align-content-center flex-wrap">    
                <div class="d-flex flex-column">
                    <p class="text-center" style="margin:0;padding:0;font-size:1.2em;">{{$v->plano}}</p> 
                    <p class="text-center tipo" style="margin:0;padding:0;font-size:1.2em;">{{$v->modelo}}</p>   
                </div>            
                
            </div>
        </div>

        <div class="d-flex border-bottom border-top border-dark">
            <div class="col-6 border-right border-dark">
                <p class="text-center h-100 my-auto py-2">{{$v->coparticipacao}}</p>
            </div>
            <div class="col-6">
                <p class="text-center h-100 my-auto py-2">{{$v->odonto}}</p>
            </div>
        </div>
        <div id="erros">
            <div class="errordatavigente"></div>
            <div class="errordataboleto"></div>
            <div class="errorvaloradesao"></div>
        </div>
        <div class="d-flex my-2" style="padding:0px;">
                <div class="ml-2">
                    <div class="form-group">
                        <p style="margin:0;padding:0;">Data Vigencia:</p>
                        <input type="text" name="vigente" id="vigente_{{strtolower($v->modelo)}}"  value="" class="form-control form-control-sm vigente">
                        <!-- <input type="text" name="vigente" id="vigente"  value="" class="form-control form-control-sm vigente"> -->
                        <!-- <input type="date" step="10" value="{{date('Y')}}-{{date('M')}}-05"> -->
                    </div>
                </div>    
                <div class="mx-1">
                    <div class="form-group">
                        <p style="margin:0;padding:0;">Data Boleto:</p>
                        <input type="date" name="boleto" id="boleto_{{strtolower($v->modelo)}}" value="" placeholder="Data Boleto" class="form-control form-control-sm boleto">
                    </div>
                    
                </div>
                <div class="mr-2">
                    <div class="form-group">
                        <p style="margin:0;padding:0;">Valor Ades??o:</p>
                        <input type="text" name="adesao" id="adesao_{{strtolower($v->modelo)}}" placeholder="R$" class="form-control form-control-sm valor_adesao">
                    </div>
                </div>
        </div>

        <div class="d-flex align-items-center mx-auto mb-2" style="width:80%;border-radius:10px;">
            <table class="table table-sm table-borderless table-dark" style="border-radius:10px;">
                <thead>
                    <tr>
                        <th>Faixas</th>
                        <th>Vidas</th>
                        <th>Valor</th>
                        <th class="text-center">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($faixas as $f)
                        @if($f->modelo == $v->modelo)
                        <tr>
                            <td>{{$f->faixas}}</td>
                            <td>{{$f->quantidade}}</td>
                            <td>{{number_format($f->valor,2,",",".")}}</td>
                            <td class="text-right">{{number_format($f->total,2,",",".")}}</td>
                        </tr>    
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="text-white py-2" style="clear: both;border-top:1px solid black;">
            <p class="text-center valor_plano" style="font-weight:bold;margin:auto auto;color:black;">R$ {{number_format($v->total,2,",",".")}}</p>
        </div>
    </div>
    @endforeach 
</section>
<input type="hidden" name="valor" id="valor" value="">
<input type="hidden" name="data_vigencia" id="data_vigencia" value="">
<input type="hidden" name="data_boleto" id="data_boleto" value="">
<input type="hidden" name="valor_adesao" id="valor_adesao" value="">
<input type="hidden" name="acomodacao" id="acomodacao" value="">
<input type="hidden" name="contrato" id="contrato" value="{{$contrato}}">
<input type="hidden" name="user" id="user" value="{{$user}}">
<input type="hidden" name="tabela_origem" id="tabela_origem" value="{{$tabela_origem}}">
<input type="hidden" name="administradora" id="administradora" value="{{$administradora ?? ''}}">



<input type="hidden" name="cliente" id="cliente" value="{{$cliente}}">








<div id="btn_submit"></div>
@else
    <h3 class="text-center py-3">N??o h?? planos com esses par??metros, tente outros</h3>
@endif
<script>
    $(function(){
        // $(".valores-acomodacao").css("background-color","red");
        $('.valor_adesao').mask("#.##0,00", {reverse: true});




    });
</script> 