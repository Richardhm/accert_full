@extends('adminlte::page')
@section('title', 'Pesquisar')
@section('content_header')
    <!-- <h1>Resultado pesquisa</h1> -->
    
        
    
@stop

@section('content_top_nav_right')


@stop






@section('content')
    

    <!-----CARD SEARCH------->
    
    



    
   <!-----FIM CARD SEARCH------->

    @php
        $inicial = $card_inicial;
        $atual = "";
        $ii=0;$cadeado = true;
    @endphp
    <div id="resultado" style="display:flex;flex-wrap:wrap;">

    @for($i=0;$i < count($tabelas); $i++) 
            
                @if($ii==0)
                    <div class="card" style="flex-basis:32%;padding:7px;background-color:#123449;color:#FFF;margin-right:1%;">
                   

                    <div class="d-flex" style="flex-wrap:wrap;">
                        <div class="w-25 my-auto bg-white rounded p-2" style="max-height:52px;">
                            <img src="{{asset($tabelas[$i]->administradora)}}" class="d-flex align-self-center p-1" alt="" width="100%" height="100%">
                        </div>

                        <div class="w-75 d-flex flex-column text-center">
                            <span>{{$tabelas[$i]->plano}}</span>
                            <span>{{$tabelas[$i]->odontos}}</span>
                        </div>

                        <div class="w-100 text-center border-top border-left border-right mt-1 p-2">
                            <span>{{$tabelas[$i]->cidade}}</span>
                        </div>
                    </div>            





                    <table class="border-left border-right border-bottom">
                            <thead class="border-top border-bottom">
                                <tr>
                                    <td class="text-nowrap border-right" rowspan="2" style="width:5%;text-align:center;vertical-align: middle;background-color:rgba(0,0,0,0.8);">Faixas</td>
                                    <td colspan="2" class="text-center border-right">Com Copar</td>
                                    <td colspan="2" class="text-center" style="background-color:rgba(0,0,0,0.8);">Sem Copar.</td>
                                </tr>
                                <tr>
                                    
                                    <td class="text-nowrap text-center" style="width:5%;">ENFER</td>
                                    <td class="text-nowrap text-center border-right" style="width:5%;">APART</td>
                                    <td class="text-nowrap text-center" style="width:5%;background-color:rgba(0,0,0,0.8);color:orange;">ENFER</td>
                                    <td class="text-nowrap text-center" style="width:5%;background-color:rgba(0,0,0,0.8);color:orange;">APART</td>
                                    
                                </tr>
                            </thead>
                            <tbody>
                @endif
                @if($tabelas[$i]->card == $inicial)
                    
                    <tr>
                        <td class="text-nowrap border-right" style="width:5%;background-color:rgba(0,0,0,0.8);">
                            <span style="margin-left:8px;">{{$tabelas[$i]->faixas == "59+" ? "Acima 59 anos" : $tabelas[$i]->faixas." anos"}}</span>
                        </td>
                        <td class="text-nowrap" style="width:5%;">
                            <span style="margin-left:10px;">{{number_format($tabelas[$i]->enfermaria_com_coparticipacao_com_odonto,2,",",".")}}</span>
                        </td>
                        <td class="text-nowrap border-right" style="width:5%;">
                            <span style="margin-left:10px;">{{number_format($tabelas[$i]->apartamento_com_coparticipacao_com_odonto,2,",",".")}}</span>
                        </td>
                        <td class="text-nowrap" style="width:5%;background-color:rgba(0,0,0,0.8);color:orange;">
                            <span style="margin-left:10px;">{{number_format($tabelas[$i]->enfermaria_sem_coparticipacao_com_odonto,2,",",".")}}</span>
                        </td>
                        <td class="text-nowrap" style="width:5%;background-color:rgba(0,0,0,0.8);color:orange;">
                            <span style="margin-left:10px;">{{number_format($tabelas[$i]->apartamento_sem_coparticipacao_com_odonto,2,",",".")}}</span>
                        </td>
                        
                    </tr>
                    @php $ii++ @endphp
            @else
                    </tbody>
                </table>
                </div>

                @php
                    $ii=0;
                    $inicial = $tabelas[$i]->card;
                    $i--;
                @endphp

            @endif

        @endfor





 
    </div>
        




   

   

    
 
@stop

@section('css')
    <style>
        /* table tbody tr:nth-child(even) {
            background-color:#696969;
            color:#FFF;
        } */
        .form-search {
            display:none;
        }
        .btns {
            
            display: flex;
            justify-content: end;
            padding:5px 0; 
        }
        .btn-search {
            border:none;
            background-color: white;
        }

    </style>   
@stop



@section('js')
    <script src="{{asset('js/jquery.mask.min.js')}}"></script>
    <script>
        $(function(){

           
        });
    </script>    
@stop
