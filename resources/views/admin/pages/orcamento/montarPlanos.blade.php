@if(count($planos) >= 1) 
@php 
        $ii=0;         
        $total_apartamento_coparticipacao = 0;
        $total_enfermaria_coparticipacao = 0;
        $total_ambulatorial_coparticipacao =  0;
        $total_apartamento_sem_coparticipacao = 0;
        $total_enfermaria_sem_coparticipacao = 0;
        $total_ambulatorial_sem_coparticipacao = 0;
        $total_apartamento_odonto_final = 0;
        $total_enfermaria_odonto_final = 0;
        $total_ambulatorial_odonto_final =  0;
        $total_apartamento_sem_odonto_final = 0;
        $total_enfermaria_sem_odonto_final = 0;
        $total_ambulatorial_sem_odonto_final = 0;
      @endphp
      <div class="d-flex" style="flex-wrap:wrap;">
        @for($i=0;$i < count($planos); $i++) 
          @if($planos[$i]->card == $card_inicial)
            @if($ii==0)
              <div class="card shadow card_plano">
                <div class="card-body" style="box-shadow:rgba(0,0,0,0.8) 0.6em 0.7em 5px;padding:0.6rem;">
                <input type="hidden" name="administradora_id" id="administradora_id" value="{{$planos[$i]->admin_id}}"> 
                <input type="hidden" name="plano_id" id="plano_id" value="{{$planos[$i]->plano_id}}"> 
                  <div class="d-flex mb-2">
                    <div style="flex-basis:30%;background-color:#fff;padding:10px;border-radius:10px;max-height:52px;display:flex;align-items: center;">
                      <img class="mx-auto" src="{{asset($planos[$i]->admin_logo)}}"  alt="{{$planos[$i]->admin_nome}}" width="100%;" height="100%">
                    </div>
                   <div class="d-flex justify-content-center align-items-center" style="flex-basis:70%;">
                      <div class="d-flex flex-column text-center">
                        <span style="font-size:1.1em;" style="background-color:rgba(0,0,0,0.9)">{{$planos[$i]->plano}}</span>
                        <span style="font-size:1.1em;" id="plano_com_sem_odonto">{{$planos[$i]->titulos}}</span>
                        
                      </div>
                    </div>
                 </div>
                 <table class="">                 
                      <tr>
                          <td rowspan="2" style="vertical-align:middle;background-color:rgba(0,0,0,0.8);text-align:center;font-size:0.875em;border-right:1px solid #FFF;border-bottom:1px solid #FFF;">Faixa Etária</td>
                          <td colspan="2" style="text-align:center;font-size:0.875em;border-bottom:1px solid #FFF;border-right:1px solid #FFF;" class="">Com Copar</td>
                          <td colspan="2" style="text-align:center;background-color:rgba(0,0,0,0.8);font-size:0.875em;border-bottom:1px solid #FFF;" class="">Sem Copar</td>
                      </tr>
                      <tr>
                          <td style="text-align:center;font-size:0.875em;border-right:1px solid #FFF;border-bottom:1px solid #FFF;" class="">APART</td>
                          <td style="text-align:center;font-size:0.875em;border-right:1px solid #FFF;border-bottom:1px solid #FFF;" class="">ENFER</td>
                          <td style="text-align:center;background-color:rgba(0,0,0,0.8);color:orange;font-size:0.875em;border-bottom:1px solid #FFF;border-right:1px solid #FFF;" class="">APART</td>
                          <td style="text-align:center;background-color:rgba(0,0,0,0.8);color:orange;font-size:0.875em;border-bottom:1px solid #FFF;" class="">ENFER</td>
                      </tr>
                  </thead>
                  <tbody>
                  @endif
                  <tr> 
                          <td style="background-color:rgba(0,0,0,0.8);font-size:0.875em;border-right:1px solid #FFF;border-right:1px solid #FFF;">
                              <span style="margin-left:20px;">{{$planos[$i]->nome == "59+" ? "Acima ".$planos[$i]->nome." Anos" : $planos[$i]->nome." Anos"}}</span>
                          </td>
                          <td style="text-align:right;font-size:0.875em;border-right:1px solid #FFF;" class="">
                            <span style="margin-right:6px;">{{number_format($planos[$i]->apartamento_com_coparticipacao_total,2,",",".")}}</span>
                            @php
                              $total_apartamento_coparticipacao += $planos[$i]->apartamento_com_coparticipacao_total;
                            @endphp
                          </td>
                          <td style="text-align:right;font-size:0.875em;border-right:1px solid #FFF;" class="">
                          <span style="margin-right:6px;">{{number_format($planos[$i]->enfermaria_com_coparticipacao_total,2,",",".")}}</span>
                            @php
                              $total_enfermaria_coparticipacao += $planos[$i]->enfermaria_com_coparticipacao_total;
                            @endphp
                          </td>
                          </td>
                          <td style="text-align:right;background-color:rgba(0,0,0,0.8);color:orange;font-size:0.875em;border-right:1px solid white" class="">
                          <span style="margin-right:6px;">{{number_format($planos[$i]->apartamento_sem_coparticipacao_total,2,",",".")}}</span>
                            @php
                              $total_apartamento_sem_coparticipacao += $planos[$i]->apartamento_sem_coparticipacao_total
                            @endphp
                          </td>
                          <td style="text-align:right;background-color:rgba(0,0,0,0.8);color:orange;font-size:0.875em;" class="">
                          <span style="margin-right:6px;">{{number_format($planos[$i]->enfermaria_sem_coparticipacao_total,2,",",".")}}</span>
                            @php
                              $total_enfermaria_sem_coparticipacao += $planos[$i]->enfermaria_sem_coparticipacao_total
                            @endphp
                          </td>
                          
                      </tr>   
                    @php $ii++; @endphp
                @else
                  @php $card_inicial = $planos[$i]->card; $ii=0; $i--;@endphp
                  </tbody>
                  <tfoot>
                    <tr>
                      <td style="background-color:rgba(0,0,0,0.8);border-right:1px solid #FFF;border-top:1px solid white;" class="">
                        <span style="margin-left:20px;">Total</span>
                      </td>
                      <td style="text-align:right;font-size:0.875em;border-right:1px solid #FFF;border-top:1px solid white;" class="">
                      <span style="margin-right:6px;">{{isset($total_apartamento_coparticipacao) ? number_format($total_apartamento_coparticipacao,2,",",".") : 0}}</span>
                      </td>
                      <td style="text-align:right;font-size:0.875em;border-right:1px solid #FFF;border-top:1px solid white;" class="">
                      <span style="margin-right:6px;">{{isset($total_enfermaria_coparticipacao) ? number_format($total_enfermaria_coparticipacao,2,",",".") : 0}}</span>
                      </td>
                      
                      <td style="text-align:right;color:orange;background-color:rgba(0,0,0,0.8);font-size:0.875em;border-right:1px solid white;border-top:1px solid white;" class="">
                      <span style="margin-right:6px;">{{isset($total_apartamento_sem_coparticipacao) ? number_format($total_apartamento_sem_coparticipacao,2,",",".") : 0}}</span>
                      </td>
                      <td style="text-align:right;color:orange;background-color:rgba(0,0,0,0.8);font-size:0.875em;border-top:1px solid white;" class="">
                      <span style="margin-right:6px;">{{isset($total_enfermaria_sem_coparticipacao) ? number_format($total_enfermaria_sem_coparticipacao,2,",",".") : 0}}</span>
                      </td>
                      
                    </tr>
                  </tfoot>
                 
                  </table>
                  @php 
                    $total_apartamento_coparticipacao = 0;
                    $total_enfermaria_coparticipacao = 0;
                    $total_ambulatorial_coparticipacao =  0;
                    $total_apartamento_sem_coparticipacao = 0;
                    $total_enfermaria_sem_coparticipacao = 0;
                    $total_ambulatorial_sem_coparticipacao = 0;
                  @endphp
                </div>    
              
          @endif
          </div>        
        @endfor
        
      <tfoot>
        <tr>
          <td style="font-size:0.875em;border-right:1px solid white;background-color:rgba(0,0,0,0.8);border-top:1px solid white;">
              <span style="margin-left:20px;">Total</span>
          </td>
          <td style="text-align:right;font-size:0.875em;border-right:1px solid white;border-top:1px solid white;" class="">{{isset($total_apartamento_coparticipacao) ? number_format($total_apartamento_coparticipacao,2,",",".") : 0}}</td>
          <td style="text-align:right;font-size:0.875em;border-right:1px solid white;border-top:1px solid white;" class="">{{isset($total_enfermaria_coparticipacao) ? number_format($total_enfermaria_coparticipacao,2,",",".") : 0}}</td>
          <!-- <td style="text-align:center;" class="">{{isset($total_ambulatorial_coparticipacao) ? number_format($total_ambulatorial_coparticipacao,2,",",".") : 0}}</td> -->
          <td style="text-align:right;font-size:0.875em;border-right:1px solid white;background-color:rgba(0,0,0,0.8);border-top:1px solid white;" class="">{{isset($total_apartamento_sem_coparticipacao) ? number_format($total_apartamento_sem_coparticipacao,2,",",".") : 0}}</td>
          <td style="text-align:right;font-size:0.875em;border-right:1px solid white;background-color:rgba(0,0,0,0.8);border-top:1px solid white;" class="">{{isset($total_enfermaria_sem_coparticipacao) ? number_format($total_enfermaria_sem_coparticipacao,2,",",".") : 0}}</td>
          <!-- <td style="text-align:center;" class="">{{isset($total_ambulatorial_sem_coparticipacao) ? number_format($total_ambulatorial_sem_coparticipacao,2,",",".") : 0}}</td> -->
          
          
        </tr>

        <tr>
        </tr>
      </tfoot>   
      </div>      
@else 
  <h3 class="text-center alert alert-info">Sem Resultados para essa pesquisa =/</h3>
@endif