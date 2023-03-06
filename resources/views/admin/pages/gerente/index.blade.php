@extends('adminlte::page')
@section('title', 'Financeiro')

@section('plugins.Datatables', true)

@section('content_top_nav_right')
   
    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt text-white"></i>
    </a>
    
@stop

@section('content_header')
    <ul class="list_abas">
        <li data-id="aba_individual" class="ativo">Gerência</li>
        <li data-id="aba_comissao" class="menu-inativo">Comissão</li>
        <li data-id="aba_relatorio" class="menu-inativo">Relatório</li>
    </ul>
@stop

@section('content')

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
                    <input type="hidden" name="id" id="id">  
                                 
                    
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
                        <span class="btn btn-block" style="background-color:#123449;color:#FFF;font-size:1.2em;">Contratos</span>
                    </div>

                    <div class="mb-1">
                        <select id="select_administradora" class="form-control">
                            <option value="todos" class="text-center">---Escolher Administradora---</option>
                        </select>
                    </div>

                    <div class="mb-1">
                        <select id="select_vendedor" class="form-control">
                            <option value="todos" class="text-center">---Escolher Vendedor---</option>
                        </select>
                    </div>

                    <div class="mb-1">
                        <select id="select_plano" class="form-control">
                            <option value="todos" class="text-center">---Escolher Plano---</option>
                            
                        </select>
                    </div>

                    


                    <div style="background-color:#123449;border-radius:5px;">

                        <ul style="margin:0;padding:0;list-style:none;" id="listar_gerenciavel">
                            <li style="padding:10px;display:flex;justify-content:space-between;" id="container_a_recebido">
                                <span style="flex-basis:35%;font-size:0.875em;">A Receber</span>
                                <span style="flex-basis:65%;background-color:#FFF;color:#000;border-radius:3px;display:flex;justify-content:space-between;">
                                    
                                    <span class="ml-2" id="quat_comissao_a_receber" style="font-size:0.875em;">
                                        {{$quat_comissao_a_receber}}
                                    </span>
                                        
                                    <span class="mr-2 valor_quat_comissao_a_receber" style="font-size:0.875em;">
                                        R$ {{number_format($valor_quat_comissao_a_receber,2,",",".")}}
                                    </span>    

                                </span>                        
                            </li>

                            <div style="width:100%;height:3px;border:1px solid #C5D4EB;background-color:#C5D4EB;"></div>

                            <!-- <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;">
                                <span>A Receber Mês</span>
                               <span class="badge badge-light" style="width:45px;text-align:right;">00</span>                        
                            </li> -->
                            <li style="padding:10px;display:flex;justify-content:space-between;flex-direction:column;border-radius:5px;" id="container_recebido">

                                <div class="mb-1" id="selecionar_mes">
                                    <select id="select_mes" class="form-control">
                                        <option value="todos" class="text-center">---Escolher Vigente---</option>
                                        @foreach($datas_select as $d)
                                            <option value="{{date('Y-m',strtotime($d->data_baixa_gerente))}}">{{date('F/Y',strtotime($d->data_baixa_gerente))}}</option> 
                                        @endforeach
                                    </select>
                                </div>
                                <span style="flex-basis:35%;font-size:0.875em;">Recebido</span>
                                <span style="flex-basis:65%;background-color:#FFF;color:#000;border-radius:3px;display:flex;justify-content:space-between;">
                                    <span class="ml-2" id="quat_comissao_recebido" style="font-size:0.875em;">
                                        {{$quat_comissao_recebido}}
                                    </span>
                                    <span class="mr-2 valor_quat_comissao_recebido" style="font-size:0.875em;">
                                        R$ {{number_format($valor_quat_comissao_recebido,2,",",".")}}
                                    </span>        

                                </span>                        

                            </li>                            
                        </ul>

                    </div>

                </div>
                <!--Fim Coluna da Esquerda  -->
                <!--COLUNA DA CENTRAL-->
                <div style="flex-basis:83%;">
                    <div class="p-2" style="background-color:#123449;color:#FFF;border-radius:5px;">
                    <table id="tabela_coletivo" class="table table-sm listardados">
                        <thead>
                            <tr>
                                <th>Admin</th>
                                <th>Corretor</th>
                                <th>Plano</th>
                                <th>Origem</th>
                                <th>Cliente</th>
                                <th>Cod. Externo</th>
                                <th>Parcela</th>
                                <th>Valor</th>
                                <th>Vencimento</th>
                                <th>Data Baixa</th>
                                <th>Detalhe</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>   
                    </div>
                </div>  
                <!--FIM COLUNA DA CENTRAL-->

                  
            </section>
       </main><!-------------------------------------DIV FIM Individial------------------------------------->     
       
       <main id="aba_comissao" class="ocultar aba_comissao_container">
            <div class="menu_aba_comissao">

                <div class="my-2 mr-2 ml-2">
                    <select name="mes_search" id="mes_search" class="form-control">
                        <option value="" class="text-center">--Escolher o Mês--</option>
                    </select>
                </div>


                <h4 class="text-center text-white my-2">Total Folha</h4>

                <p class="total_mes_comissao">R$ {{number_format($total_mes_comissao,2,",",".")}}</p>   

                <div class="list_administradoras border-bottom border-top py-2">
                    
                    <ul style="margin:0;padding:0;list-style:none;" id="listar_individual">
                        @foreach($administradoras_mes as $ad)
                                <li style="padding:0px 5px;display:flex;justify-content:space-between;margin-bottom:5px;" id="aguardando_pagamento_3_parcela_individual" class="individual">
                                    <span>{{$ad->administradora}}</span>
                                    <span class="badge badge-light individual_quantidade_3_parcela" style="width:45px;text-align:right;">{{number_format($ad->total,2,",",".")}}</span>                        
                                </li>
                        @endforeach

                    </ul>
                    
                </div>

                <div class="d-flex justify-content-center my-3 mr-2 ml-2">
                    <button class="btn btn-info btn-block">Gerar PDF</button>
                </div>


            </div>

            <div class="p-2 aba_comissao_table" style="background-color:#123449;color:#FFF;border-radius:5px;">
                <table id="tabela_coletivo_comissao" class="table table-sm listarcomissao">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Allcare</th>
                            <th>Alter</th>
                            <th>Qualicorp</th>
                            <th>Hapvida</th>
                            <th>Valor</th>
                            <th>Detalhe</th>
                            
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>   
            </div>

       </main>  

       <main id="aba_relatorio" class="ocultar">
            Relatorio
       </main>  
    </section>
   
@stop  

@section('css')
    <style>

        .aba_comissao_container {
            display:flex;
            justify-content: space-between;
            align-content: flex-start;
        }

        .aba_comissao_table {
            flex-basis: 83%;
        }
        .menu_aba_comissao {
            flex-basis: 16%;
            background-color: #123449;
            margin-right: 1%;
            border-radius:5px;
        }

        .list_administradoras {
            display:flex;
            flex-direction: column;
            color:#fff;
            justify-content: center;
        }

        .total_mes_comissao {
            color:#FFF;
            text-align: center;
        }

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
        .menu-inativo {background-color: #123449;color:#FFF;}
        .btn_recebido {background-color:green;color:#FFF;border:none;}
        
    </style>
@stop






@section('js')

    <script>
        $(function(){  

            $(".list_abas li").on('click',function(){                
                $('li').removeClass('ativo').addClass('menu-inativo');
                $(this).addClass("ativo").removeClass('menu');
                let id = $(this).attr('data-id');
                $("#janela_atual").val(id);
                $('.conteudo_abas main').addClass('ocultar');
                $('#'+id).removeClass('ocultar');
                //limparTudo();
            });
                       
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });    
            
            

            
            var table = $(".listardados").DataTable({
                dom: '<"d-flex justify-content-between"<"#title_coletivo_por_adesao_table">ft><t><"d-flex justify-content-between"lp>',
                "language": {
                    "url": "{{asset('traducao/pt-BR.json')}}"
                },
                ajax: {
                    "url":"{{ route('gerente.listagem.em_geral') }}",
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
                    {data:"administradora",name:"administradora"},
                    {data:"corretor",name:"corretor","width":"10%",},
                    {data:"plano",name:"plano"},
                    {data:"tabela_origens",name:"cidade"},
                    {data:"nome",name:"cliente","width":"15%"},                   
                    {data:"codigo_externo",name:"codigo_externo"},
                    {data:"parcela",name:"financeiro_id",
                        
                    },
                    {data:"valor",name:"valor_plano",

                        render: $.fn.dataTable.render.number('.', ',', 2, '')
                    },
                    {data:"vencimento",name:"data_boleto",
                        "createdCell":function(td,cellData,rowData,row,col) {
                            let alvo = cellData.split("-").reverse().join("/");
                            $(td).html(alvo);        
                        }
                    },
                    {data:"data_baixa",name:"tabela_origens_id",
                        "createdCell":function(td,cellData,rowData,row,col) {
                            let alvo = cellData.split("-").reverse().join("/");
                            $(td).html(alvo);        
                        }
                    },                   
                    {data:"contrato_id",name:"detalhe",
                        "createdCell":function(td,cellData,rowData,row,col) {
                            $(td).css({"text-align":"center"}).html("<a href='/admin/gerente/detalhe/"+cellData+"' class='text-white'><i class='fas fa-eye'></i></a>")
                        }
                    },
                    {data:"contrato_id",name:"check",
                        "createdCell":function(td,cellData,rowData,row,col) {
                            //$(td).css({"text-align":"center"}).html('<input type="checkbox" data-id="'+cellData+'" id="mudar_status_gerenciavel_individual">');
                            $(td).html('<button class="btn_recebido" data-id="'+cellData+'">Recebido</button>');
                            
                        }
                    },
                ],
                "columnDefs": [
                    
                    
                ],  
                
                

                "initComplete": function( settings, json ) {
                    $('#title_coletivo_por_adesao_table').html("<h4>Corretora</h4>");
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
                            var selectPlano = $("#select_plano");
                            selectPlano.on('change',function(){
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                if(val != "todos") {
                                    column.search(val ? '^' + val + '$' : '', true, false).draw();    
                                } else {
                                    var val = "";
                                    column.search(val ? '^' + val + '$' : '', true, false).draw();
                                }
                            });
                            column.data().unique().sort().each(function (d, j) {
                                selectPlano.append('<option value="' + d + '">' + d + '</option>');
                            });
                       })
                       this.api()
                       .columns([0])
                       .every(function () {
                            var column = this;
                            var selectAdministradora = $("#select_administradora");
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
                       this.api()
                       .columns([1])
                       .every(function () {
                            var column = this;
                            var selectVendedor = $("#select_vendedor");
                            selectVendedor.on('change',function(){
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                if(val != "todos") {
                                    column.search(val ? '^' + val + '$' : '', true, false).draw();    
                                } else {
                                    var val = "";
                                    column.search(val ? '^' + val + '$' : '', true, false).draw();
                                }
                            });
                            column.data().unique().sort().each(function (d, j) {
                                selectVendedor.append('<option value="' + d + '">' + d + '</option>');
                            });
                       })
                }
            });    

            var tabela_coletivo = $('#tabela_coletivo').DataTable();
            $('#tabela_coletivo').on('click', 'tbody tr', function () {
                tabela_coletivo.$('tr').removeClass('textoforte');
                $(this).closest('tr').addClass('textoforte');
                let data = tabela_coletivo.row(this).data();
                $("#id").val(data.contrato_id);
            });            

            $('body').on('click','.btn_recebido',function(){
                $('#dataBaixaModal').modal('show');
            });

            var listarcomissao = $(".listarcomissao").DataTable({
                dom: '<"d-flex justify-content-between"<"#title_comissao">ft><t><"d-flex justify-content-between"lp>',
                //dom: '<"d-flex"<"row"<"col"B><"col"l><"col"f>>>tr<"container-fluid"<"row"<"col"i> <"col"p>>>',
                "language": {
                    "url": "{{asset('traducao/pt-BR.json')}}"
                },
                ajax: {
                    "url":"{{ route('gerente.listagem.comissao') }}",
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
                    {data:"name",name:"name"},
                    {data:"valor_allcare",name:"allcare",
                        render: $.fn.dataTable.render.number('.', ',', 2, '')
                    },
                    {data:"valor_alter",name:"alter",
                        render: $.fn.dataTable.render.number('.', ',', 2, '')
                    },
                    {data:"valor_qualicorp",name:"qualicorp",
                        render: $.fn.dataTable.render.number('.', ',', 2, '')
                    },
                    {data:"valor_hapvida",name:"qualicorp",
                        render: $.fn.dataTable.render.number('.', ',', 2, '')
                    },
                    {data:"valor",name:"valor",
                        render: $.fn.dataTable.render.number('.', ',', 2, '')
                        
                    },
                    {data:"id",name:"detalhe",
                        "createdCell":function(td,cellData,rowData,row,col) {
                            $(td).html(`<a style="margin-left:25px;"  href='/admin/gerente/comissao/${cellData}' class='text-white'>
                                <i class='fas fa-eye'></i>
                            </a>`)       
                        }
                    
                    },
                   
                ],
                "columnDefs": [],              
                "initComplete": function( settings, json ) {
                    $('#title_comissao').html("<h4>Comissão</h4>");
                }
                // footerCallback: function (row, data, start, end, display) {
                    
                    
                //     var api = this.api();
                //     var intVal = function (i) {
                //         return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                //     };
                //     total = api
                //         .column(1)
                //         .data()
                //         .reduce(function (a, b) {
                //             return intVal(a) + intVal(b);
                //         }, 0);

                //         pageTotal = api
                //             .column(1, { page: 'current' })
                //             .data()
                //             .reduce(function (a, b) {
                //             return intVal(a) + intVal(b);
                //         }, 0);    
                //     // console.log(pageTotal);    


                //     $(api.column(1).footer()).html('R$ ' + pageTotal);




                // }
            });
            
            // $("body").on('change','#mudar_status_gerenciavel_individual',function(){
            //     if($(this).is(":checked")) {
            //         let id = $(this).attr('data-id');
            //         $.ajax({
            //             url:"{{route('gerente.mudar_status')}}",
            //             method:"POST",
            //             data:"id="+id,
            //             success:function(res) {
            //                 table.ajax.reload();
            //                 listarcomissao.ajax.reload();
            //             }
            //         })
            //     } 
            // });

            $('form[name="data_da_baixa"]').on('submit',function(){
                let dados = $(this).serialize();
                $.ajax({
                    url:"{{route('gerente.mudar_status')}}",
                    method:"POST",
                    data:dados,
                    success:function(res) {
                        var select_mes =  $("#select_mes");
                        
                        select_mes.html('');
                        select_mes.prepend('<option value="todos" class="text-center">---Escolher Mes---</option>');
                        select_mes.append(res.datas_select);
                        
                        table.ajax.reload();
                        listarcomissao.ajax.reload();
                        $('#dataBaixaModal').modal('hide');
                        $("#quat_comissao_a_receber").text(res.quat_comissao_a_receber);
                        $("#quat_comissao_recebido").text(res.quat_comissao_recebido);

                        $(".valor_quat_comissao_a_receber").html("R$ "+res.valor_quat_comissao_a_receber);
                        $(".valor_quat_comissao_recebido").html("R$ "+res.valor_quat_comissao_recebido);

                        $("#data_baixa").val('');

                    }
                })
                return false;
            });
               

            $("#listar_gerenciavel li").on('click',function(){
                $("#listar_gerenciavel li").removeClass('textoforte');
                $(this).addClass('textoforte');
            });

            $("#container_recebido").on('click',function(){
                tabela_coletivo.ajax.url("{{ route('gerente.listagem.recebido') }}").load();
                var column01 = table.column(10);
                var column02 = table.column(11);
                column01.visible(false);
                column02.visible(false);
                $("#selecionar_mes").removeClass('ocultar');
            });
            

            $("#container_a_recebido").on('click',function(){
                var val = "";
                table
                .column(9)
                .search(val)
                .draw();
                table.column(9).search(val ? '^' + val + '$' : '', true, false).draw();
                tabela_coletivo.ajax.url("{{ route('gerente.listagem.em_geral') }}").load();
                var column01 = table.column(10);
                var column02 = table.column(11);
                column01.visible(true);
                column02.visible(true);
                
                //$("#selecionar_mes").addClass('ocultar');
            });

            

            $("#select_mes").on('change',function(){
                if($(this).val() != "todos") {
                    table
                    .column(9)
                    .search($(this).val())
                    .draw();
                } else {
                    var val = "";
                    table
                    .column(9)
                    .search(val)
                    .draw();
                    table.column(9).search(val ? '^' + val + '$' : '', true, false).draw();
                }
                
            });


        });
    </script>
@stop






