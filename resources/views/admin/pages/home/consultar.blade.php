@extends('adminlte::page')

@section('title', 'Funcionario')

@section('content_header')
@stop

@section('content_top_nav_right')

    
@stop

@section('content')
    <div>
        <form action="{{route('consultar.carteirinha')}}" method="POST">
            @csrf
            <label for="carteirinha" class="text-white">Carteirinha:</label>
            <input type="text" name="carteirinha" id="carteirinha" class="form-control" placeholder="Digite o numero da carteirinha">
            <input type="submit" value="Consultar" class="btn btn-block btn-info">
        </form>
    </div>
    <div id="resultado" class="mt-2">
    </div> 
@stop
@section('js')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });    

        $('form').on('submit',function(){
           let cart = $("#carteirinha").val();
            $.ajax({
                url:"",
                method:"POST",
                data:"carteirinha="+cart,
                success:function(res) {
                    if(res != "error") {
                        $("#resultado").html(res);
                        $("#carteirinha").val('');
                    } else {
                        $("#resultado").html("<p class='alert alert-danger'>Sem resultado para essa CA</p>");
                    }                    
                }
           });
           return false;
        });
    </script>
@stop

@section('css')
    <style>
        #resultado {
            width:800px;
            margin:0 auto;
        }    
    </style>    
    
@stop