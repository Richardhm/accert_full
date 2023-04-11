@extends('adminlte::page')

@section('title', 'Consultar')

@section('content_header')
@stop

<div class="ajax_load">
    <div class="ajax_load_box">
        <div class="ajax_load_box_circle"></div>
        <p class="ajax_load_box_title">Aguarde, carregando...</p>
    </div>
</div>

@section('content_top_nav_right')
    <li class="nav-item"><a class="nav-link text-white" href="{{route('orcamento.search.home')}}">Tabela de Preço</a></li>
    <a class="nav-link" data-widget="fullscreen" href="#" role="button"><i class="fas fa-expand-arrows-alt text-white"></i></a>
@stop

@section('content')
    <div>
        <form action="" method="POST">
            @csrf
            <label for="cpf" class="text-white">CPF:</label>
            <input type="text" name="cpf" id="cpf" class="form-control" placeholder="CPF">
            <input type="submit" value="Consultar" class="btn btn-block btn-info">
        </form>
    </div>
    <div id="resultado" class="mt-2">
    </div> 
@stop
@section('js')
    <script src="{{asset('js/jquery.mask.min.js')}}"></script> 
    <script>

        $(function(){
            $('#cpf').mask('000.000.000-00');
            function TestaCPF(strCPF) {
                var Soma;
                var Resto;
                Soma = 0;
                
                if (strCPF == "00000000000") return false;
                for (i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
                Resto = (Soma * 10) % 11;
                if ((Resto == 10) || (Resto == 11))  Resto = 0;
                if (Resto != parseInt(strCPF.substring(9, 10)) ) return false;
                Soma = 0;
                for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
                Resto = (Soma * 10) % 11;
                if ((Resto == 10) || (Resto == 11))  Resto = 0;
                if (Resto != parseInt(strCPF.substring(10, 11) ) ) return false;
                return true;
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });    

            $('form').on('submit',function(){
                let cpf = $("#cpf").val();
                var load = $(".ajax_load");
                $.ajax({
                    url:"{{route('consultar.carteirinha')}}",
                    method:"POST",
                    data:"cpf="+cpf,
                    beforeSend: function () {
                        load.fadeIn(200).css("display", "flex");
                    },
                    success:function(res) {
                        
                        load.fadeOut(200,function(){
                            $("#resultado").html(res);
                        });
                        
                    }
                });
                return false;
            });




        })



        
       
        
        
    </script>
@stop

@section('css')
    <style>
        #resultado {
            /* width:800px; */
            /* margin:0 auto; */
            display:flex;
            flex-wrap: wrap;
            justify-content: space-between;
        } 
        .ajax_load {display:none;position:fixed;left:0;top:0;width:100%;height:100%;background:rgba(0,0,0,.5);z-index:1000;}
        .ajax_load_box{margin:auto;text-align:center;color:#fff;font-weight:var(700);text-shadow:1px 1px 1px rgba(0,0,0,.5)}
        .ajax_load_box_circle{border:16px solid #e3e3e3;border-top:16px solid #61DDBC;border-radius:50%;margin:auto;width:80px;height:80px;-webkit-animation:spin 1.2s linear infinite;-o-animation:spin 1.2s linear infinite;animation:spin 1.2s linear infinite}
        @-webkit-keyframes spin{0%{-webkit-transform:rotate(0deg)}100%{-webkit-transform:rotate(360deg)}}
        @keyframes spin{0%{transform:rotate(0deg)}100%{transform:rotate(360deg)}}   
    </style>    
    
@stop