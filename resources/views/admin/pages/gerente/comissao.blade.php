@extends('adminlte::page')
@section('title', 'Gerenciavel')

@section('plugins.Datatables', true)


@section('content_header')
    <h1 class=" border-bottom border-dark">Comissões Corretor</h1>
@stop

@section('content')
    <input type="hidden" id="cliente_id" value="{{$id}}">
    <section class="d-flex" style="align-items: flex-start;align-content: flex-start;">
        <div style="flex-basis:16%;background-color:#123449;border-radius:5px;">
            <h2 class="text-white text-center">Mês</h2>  
            <div class="mb-1" id="selecionar_mes">
                <select id="select_mes" class="form-control">
                    <option value="todos" class="text-center">---Escolher Mês---</option>
                    
                </select>
            </div>

            <div>
                <h6 class="border-top border-bottom text-white text-center py-2">{{$usuario}}</h6>
            </div>

            <div>
                <h6 class="text-white text-center border-bottom pb-2">Previsão da Comissão: {{number_format($total_comissao,2,",",".")}}</h6>
            </div>

            <div>
                <ul style="margin:0;padding:0;list-style:none;">
                    
                    <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;align-items: center;" id="aguardando_pagamento_3_parcela_individual" class="individual">
                        <span class="text-white w-25">Comissão</span>
                        <input type="text" class="form-control-sm w-50" placeholder="Comissão" id="valor_comissao" disabled>                        
                    </li>

                    <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;align-items: center;" id="aguardando_pagamento_3_parcela_individual" class="individual">
                        <span class="text-white w-25">Salario</span>
                        <input type="text" class="form-control-sm w-50" placeholder="Salario">
                    </li>

                    <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;align-items: center;" id="aguardando_pagamento_3_parcela_individual" class="individual">
                        <span class="text-white w-25">Premiação</span>
                        <input type="text" class="form-control-sm w-50" placeholder="Premiação">
                    </li>
                    
                </ul>
            </div>

            <div class="separador"></div>

            <div style="color:#FFF;display:flex;justify-content: space-between;padding:5px;border-radius:5px;">
                
                    <span class="ml-2">Total:</span>
                    <span class="mr-2">R$ 5555</span>
                
            </div>

            <div class="separador"></div>

            <div style="background-color:#C5D4EB">
                <button class="btn btn-block btn-success">Finalizar</button>
            </div>

            <div class="separador"></div>
            
            <div style="background-color:#C5D4EB">
                <button class="btn btn-block btn-info">PDF</button>
            </div>

        </div>


        <div style="flex-basis:41%;margin:0 1%;background-color:#123449;color:#FFF;padding:8px;border-radius:5px;">

                <table id="tabela_mes_atual" class="table table-sm listarcomissaomesatual" >
                    <thead>
                        <tr>
                            <th>Admin</th>
                            <th>Cliente</th>
                            <th align="center">Vencimento</th>
                            <th>Baixa</th>
                            <th>Comissão</th>
                            <th>Mês</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
              
        </div>

        <div style="flex-basis:41%;margin:0 1%;background-color:#123449;color:#FFF;padding:8px;border-radius:5px;">
            
            <table id="tabela_mes_diferente" class="table table-sm listarcomissaomesdiferente" >
                <thead>
                    <tr>
                        <th>Admin</th>
                        <th>Cliente</th>
                        <th align="center">Vencimento</th>
                        <th>Baixa</th>
                        <th align="center">Comissão</th>
                        <th>Mês</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>

        </div>
       





    </section>
@stop




@section('js')
    <script>

        $(function(){

            let id = $("#cliente_id").val();


            var listarcomissaomesatual = $(".listarcomissaomesatual").DataTable({
                dom: '<"d-flex justify-content-between"<"#title_comissao_atual"><"estilizar_search"f>><t><"d-flex justify-content-between align-items-center"<"por_pagina"l><"estilizar_pagination"p>>',
                "language": {
                    "url": "{{asset('traducao/pt-BR.json')}}"
                },
                ajax: {
                    "url":`{{ url('/admin/gerente/listagem/comissao_mes_atual/${id}') }}`,
                    "dataSrc": "",
                    
                    
                },
                "lengthMenu": [50,100,150,200,300,500],
                // "lengthMenu": [1,2,3,4,5,6],
                "ordering": false,
                "paging": true,
                "searching": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                
                columns: [
                    {data:"administradora",name:"administradora",width:"20%"},
                    {data:"cliente",name:"cliente",width:"65%"},
                    {data:"data",name:"data",width:"5%"},
                    {data:"data_baixa_gerente",name:"baixa",width:"5%"},
                    {data:"valor",name:"valor",width:"5%",
                        render: $.fn.dataTable.render.number('.', ',', 2, 'R$ '),
                        className: 'dt-center'
                    },
                    {data:"mes_atual",name:"mes",width:"5%",
                        "createdCell": function (td, cellData, rowData, row, col) {
                            let selected = $('<select />', {
                                name: 'test',
                                on: {
                                    change: function() { 
                                        //let valor = parseFloat($(this).closest("tr").find("td:eq(4)").text().replace("R$ ","").replace(",","."));
                                        //let first_valor = valor_proximo.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});
                                        if($("#valor_comissao").val() == "") {
                                            let teste = $(this).closest("tr").find("td:eq(4)").text();
                                            
                                            //teste = parseFloat(teste);
                                            //let first_teste = teste.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});
                                            //console.log(typeof(teste));
                                            $("#valor_comissao").val(teste);
                                        } else {
                                            let valor_input = "";
                                            let valor_click = "";
                                            let valor_proximo = "";
                                            let f = "";
                                            valor_input = $("#valor_comissao").val().replace(/[^0-9][$]/,'').replace(",",".");
                                            valor_click = $(this).closest("tr").find("td:eq(4)").text().replace(/[^0-9][$]/,'').replace(",",".");
                                            
                                            let n1 = parseFloat(valor_input);
                                            let n2 = parseFloat(valor_click);
                                            valor_proximo = n1 + n2;
                                            f = valor_proximo.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});
                                            $("#valor_comissao").val(f);
                                            
                                        }
                                    }
                                },
                                append : [
                                    $('<option />', {value : "1", text : cellData}),
                                    $('<option />', {value : "2", text : "Pagar"}),
                                ]
                            });
                            $(td).html(selected)
                        }
                    
                    }                   
                ],
                "initComplete": function( settings, json ) {
                    $('#title_comissao_atual').html("<h4>Liquidados</h4>");
                }
            });    

            var listarcomissaomesdfirente = $(".listarcomissaomesdiferente").DataTable({
                
                

                dom: '<"d-flex justify-content-between"<"#title_comissao_diferente"><"estilizar_search"f>><t><"d-flex justify-content-between align-items-center"<"por_pagina"l><"estilizar_pagination"p>>',


                "language": {
                    "url": "{{asset('traducao/pt-BR.json')}}"
                },
                ajax: {
                    "url":`{{ url('/admin/gerente/listagem/comissao_mes_diferente/${id}') }}`,
                    "dataSrc": "",
                    
                    
                },
                "lengthMenu": [50,100,150,200,300,500],
                "ordering": false,
                "paging": true,
                "searching": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                columns: [
                    {data:"administradora",name:"administradora"},
                    {data:"cliente",name:"cliente"},
                    {data:"data",name:"data",className: 'dt-center'},
                    {data:"data_baixa_gerente",name:"baixa"},
                    {data:"valor",name:"valor",render: $.fn.dataTable.render.number('.', ',', 2, 'R$ '),
                        className: 'dt-center'
                    },
                    {data:"mes_atual",name:"mes",
                        width:"5%"
                    }                          
                ],
                "initComplete": function( settings, json ) {
                    $('#title_comissao_diferente').html("<h4>A Receber</h4>");
                    
                }
            });    











        });


        
    </script>    
@stop


@section('css')
    <style>
        .separador {width:100%;height:15px;border:1px solid #C5D4EB;background-color:#C5D4EB;}
        th { font-size: 1em !important; }
        td { font-size: 0.8em !important; }
        #valor_comissao {
            color:#FFF;
        }
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