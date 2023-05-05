@extends('adminlte::page')
@section('title', 'Gerenciavel - Baixas')
@section('plugins.Datatables', true)

@section('content_top_nav_right')
   
    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt text-white"></i>
    </a>
    
@stop

@section('content_header')
    <h1 class=" border-bottom border-dark">Detalhe</h1>
@stop


<input type="hidden" id="id_plano" value={{$id_plano}}>
<input type="hidden" id="id_tipo" value={{$id_tipo}}>



@section('content')
    <div style="flex-basis:83%;">
        <div class="p-2" style="background-color:#123449;color:#FFF;border-radius:5px;">
            <table id="tabela_individual" class="table table-sm listardados">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Orçamento</th>
                        <th>Corretor</th>
                        <th>Cliente</th>
                        <th>CPF</th>
                        <th>Vidas</th>
                        <th>Valor</th>
                        <th>Vencimento</th>                                  
                        <th>Status</th>
                        
                    </tr>
                </thead>
                <tbody></tbody>
                
            </table>   
        </div>
    </div>  
@stop

@section('js')
    <script>
        $(function(){

            String.prototype.ucWords = function () {
                let str = this.toLowerCase()
                let re = /(^([a-zA-Z\p{M}]))|([ -][a-zA-Z\p{M}])/g
                return str.replace(re, s => s.toUpperCase())
            }

            var id_plano = $("#id_plano").val();
            var id_tipo = $("#id_tipo").val();

            var url = `http://localhost:8000/admin/gerente/show/${id_plano}/${id_tipo}`;
            console.log(url);

            var taindividual = $(".listardados").DataTable({
                dom: '<"d-flex justify-content-between"<"#title_individual">ft><t><"d-flex justify-content-between"lp>',
                order: [[0, 'desc']],
                "language": {
                    "url": "{{asset('traducao/pt-BR.json')}}"
                },
                ajax: {
                    "url":`http://localhost:8000/admin/gerente/show/${id_plano}/${id_tipo}`,
                    "dataSrc": ""
                },
                "lengthMenu": [50,100,150,200,300,500],
                "ordering": true,
                "paging": true,
                "searching": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
               
                columns: [
                    {data:"created_at",name:"data",
                        "createdCell": function (td, cellData, rowData, row, col) {
                            let datas = cellData.split("T")[0]
                            let alvo = datas.split("-").reverse().join("/")
                            $(td).html(alvo)    
                        },
                       
                    },
                    {
                        data:"codigo_externo",name:"codigo_externo"
                    },
                    {data:"clientes.user.name",name:"corretor",
                        "createdCell": function (td, cellData, rowData, row, col) {
                            let palavra = cellData.split(" ");
                            if(palavra.length >= 3) {
                                $(td).html(palavra[0]+" "+palavra[1]+"...")
                            }
                        }
                    },
                    
                    
                    {data:"clientes.nome",name:"cliente",
                        "createdCell":function(td,cellData,rowData,row,col) {
                            let palavras = cellData.ucWords();
                            let dados = palavras.split(" ");
                            if(dados.length >= 4) {
                                $(td).html(dados[0]+" "+dados[1]+" "+dados[2]+"...");
                            }
                            
                        }
                    },


                    {data:"clientes.cpf",name:"cpf",
                        "createdCell": function (td, cellData, rowData, row, col) {
                            let cpf = cellData.substr(0,3)+"."+cellData.substr(3,3)+"."+cellData.substr(6,3)+"-"+cellData.substr(9,2);
                            $(td).html(cpf);
                        }
                    },

                    {data:"clientes.quantidade_vidas",name:"vidas",
                        
                    },
                    
                    {
                        data:"valor_plano",name:"valor_plano",
                        
                        render: $.fn.dataTable.render.number('.', ',', 2, 'R$ ')
                        
                    },
                    {data:"comissao.ultima_comissao_paga",name:"vencimento",
                        "createdCell": function(td,cellData,rowData,row,col) {
                            if(cellData == null) {
                                let alvo = rowData.data_vigencia.split("-").reverse().join("/");
                                $(td).html(alvo);
                            } else {
                                let alvo = cellData.data.split("-").reverse().join("/");
                                $(td).html(alvo);
                            }
                        }
                    },
                    {data:"financeiro.nome",name:"financeiro"},
                    
                ],
                "columnDefs": [
                
                    {
                        "targets": 0,   
                        "width":"2%"
                    },
                    {
                        "targets": 1,   
                        "width":"5%",
                    },                 
                    {
                        "targets": 2,
                        "width":"13%",
                    },
                    {
                        "targets": 3,
                        "width":"20%",  
                    },
                    {
                        "targets": 4,
                        "width":"10%",      
                    },
                    {
                        "targets": 5,
                        "width":"5%",       
                    },
                    {
                        "targets":6,
                        "width":"8%",        
                    },
                    {
                        "targets":7,
                        "width":"5%",        
                    },
                    {
                        "targets": 8,
                        "width":"10%",
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
                    },
                    
                   
               ],

               "drawCallback": function( settings ) {
                    
                    
                },
                "initComplete": function( settings, json ) {
                    $('#title_individual').html("<h4 style='font-size:1em;margin-top:10px;'>Contratos</h4>");
                    
                        


                },
                footerCallback: function (row, data, start, end, display) {
                   
 
           
                }
            });




        });
    </script>
@stop