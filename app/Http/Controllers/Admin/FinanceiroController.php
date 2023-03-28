<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\{
    Contrato,Cliente,TabelaOrigens,Administradoras,Planos,Acomodacao,CotacaoFaixaEtaria,User,PlanoEmpresarial,ContratoEmpresarial,  
    Comissoes,ComissoesCorretoresLancadas,ComissoesCorretoraConfiguracoes,ComissoesCorretoraLancadas,ComissoesCorretoresConfiguracoes,
    Dependentes,Cancelado,MotivoCancelados,
    Premiacoes,PremiacoesCorretoraLancadas,PremiacoesCorretoresLancadas,PremiacoesCorretoraConfiguracoes,PremiacoesCorretoresConfiguracoes,
};
use Illuminate\Support\Facades\DB;



class FinanceiroController extends Controller
{
    

    public function index()
    {

        $contratos_coletivo_pendentes = Contrato
        ::where("plano_id",3)        
        ->count();
        // $contratos = Contrato
        //     ::where("plano_id",1)        
        //     ->where("financeiro_id",1)
        //     ->with(['administradora','financeiro','cidade','comissao','acomodacao','plano','comissao.comissaoAtualFinanceiro','somarCotacaoFaixaEtaria','clientes','clientes.user','clientes.dependentes'])
        //     //->whereRaw("data_boleto >= date_add(data_boleto, interval 1 day)")
        //     //->whereRaw("NOW() > date_add(updated_at, INTERVAL 30 SECOND)")
        //     // ->whereRaw("tempo >= now()")
        //     ->orderBy("id","desc")
        //     ->get();
        // dd($contratos);
        
        $cidades = TabelaOrigens::all();
        $administradoras = Administradoras::whereRaw("id != (SELECT id FROM administradoras WHERE nome LIKE '%hapvida%')")->get();

        $motivo_cancelados = MotivoCancelados::all();

        $planos = Planos::all();
        $plano_empresarial = PlanoEmpresarial::all();

        $users = User::where("id","!=",auth()->user()->id)->get();
        $tabela_origem = TabelaOrigens::all();

        $qtd_individual_pendentes = Contrato
            ::where("plano_id",1)        
            ->count();
        
        $qtd_individual_em_analise = Contrato::where("financeiro_id",1)
            ->where("plano_id",1)
            ->count();

        $qtd_individual_parcela_01 = Contrato
            ::where("plano_id",1)        
            ->where("financeiro_id",5)
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro",0);
                $query->where("status_gerente",0);
                $query->where("parcela",1);
                $query->whereRaw("data_baixa IS NULL");
            })
            ->count();
        
        $qtd_individual_parcela_02 = Contrato
            ::where("plano_id",1)        
            ->where("financeiro_id",6)
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro",0);
                $query->where("status_gerente",0);
                $query->where("parcela",2);
                $query->whereRaw("data_baixa IS NULL");
            })
            ->count();  
        
        $qtd_individual_parcela_03 = Contrato
            ::where("plano_id",1)        
            ->where("financeiro_id",7)
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro","=",0);
                $query->where("status_gerente",0);
                $query->where("parcela",3);
                $query->whereRaw("data_baixa IS NULL");
            })
            ->count();        
        
        $qtd_individual_parcela_04 = Contrato
            ::where("plano_id",1)        
            ->where("financeiro_id",8)
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro","=",0);
                $query->where("status_gerente",0);
                $query->where("parcela",4);
                $query->whereRaw("data_baixa IS NULL");
            })
            ->count();   
        
        $qtd_individual_parcela_05 = Contrato
            ::where("plano_id",1)        
            ->where("financeiro_id",9)
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro","=",0);
                $query->where("status_gerente",0);
                $query->where("parcela",5);
                $query->whereRaw("data_baixa IS NULL");
            })
            ->count();  
         
        $qtd_individual_parcela_06 = Contrato
            ::where("plano_id",1)        
            ->where("financeiro_id",10)
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro","=",0);
                $query->where("status_gerente",0);
                $query->where("parcela",6);
                $query->whereRaw("data_baixa IS NULL");
            })
            ->count();           
                
            
        $qtd_individual_finalizado = Contrato::where("financeiro_id",11)
            ->where("plano_id",1)
            ->count(); 
            
        $qtd_individual_cancelado = Contrato::where("financeiro_id",12)
            ->where("plano_id",1)
            ->count();     


            
        $qtd_coletivo_em_analise = Contrato::where("financeiro_id",1)
            ->where("plano_id",3)
            ->count();

        $qtd_coletivo_emissao_boleto = Contrato::where("financeiro_id",2)
            ->where("plano_id",3)
            ->count();

        $qtd_coletivo_pg_adesao = Contrato::where('financeiro_id',3)
            ->where("plano_id",3)
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro",0);
                $query->where("status_gerente",0);
                $query->where("parcela",1);
                $query->whereRaw("data_baixa IS NULL");
            })
            ->count();
            //->whereRaw("NOW() > date_add(updated_at, INTERVAL 30 SECOND)")
            // ->whereRaw("tempo >= now()")
            //->count(); 
        
        $qtd_coletivo_pg_vigencia = Contrato::where('financeiro_id',4)
            ->where("plano_id",3)
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro",0);
                $query->where("status_gerente",0);
                $query->where("parcela",2);
                $query->whereRaw("data_baixa IS NULL");
            })
            ->count();
            //->whereRaw("NOW() > date_add(updated_at, INTERVAL 30 SECOND)")
            // ->whereRaw("tempo >= now()")
            

        $qtd_coletivo_02_parcela = Contrato::where('financeiro_id',6)
            ->where("plano_id",3)
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro",0);
                $query->where("status_gerente",0);
                $query->where("parcela",3);
                $query->whereRaw("data_baixa IS NULL");
            })
            //->whereRaw("NOW() > date_add(updated_at, INTERVAL 30 SECOND)")
            //->whereRaw("data_boleto >= date_add(data_boleto, interval 1 day)")
            // ->whereRaw("tempo >= now()")
            ->count();

        $qtd_coletivo_03_parcela = Contrato::where('financeiro_id',7)
            ->where("plano_id",3)
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro",0);
                $query->where("status_gerente",0);
                $query->where("parcela",4);
                $query->whereRaw("data_baixa IS NULL");
            })
            //->whereRaw("data_boleto >= date_add(data_boleto, interval 1 day)")
            //->whereRaw("NOW() > date_add(updated_at, INTERVAL 30 SECOND)")
            // ->whereRaw("tempo >= now()")
            ->count();

        $qtd_coletivo_04_parcela = Contrato::where('financeiro_id',8)
            ->where("plano_id",3)
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro",0);
                $query->where("status_gerente",0);
                $query->where("parcela",5);
                $query->whereRaw("data_baixa IS NULL");
            })
            //->whereRaw("data_boleto >= date_add(data_boleto, interval 1 day)")
            //->whereRaw("NOW() > date_add(updated_at, INTERVAL 30 SECOND)")
            // ->whereRaw("tempo >= now()")
            ->count();

        $qtd_coletivo_05_parcela = Contrato::where('financeiro_id',9)
            ->where("plano_id",3)
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro",0);
                $query->where("status_gerente",0);
                $query->where("parcela",6);
                $query->whereRaw("data_baixa IS NULL");
            })
            //->whereRaw("data_boleto >= date_add(data_boleto, interval 1 day)")
            //->whereRaw("NOW() > date_add(updated_at, INTERVAL 30 SECOND)")
            // ->whereRaw("tempo >= now()")
            ->count();

        $qtd_coletivo_06_parcela = Contrato::where('financeiro_id',10)
            ->where("plano_id",3)
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro",0);
                $query->where("status_gerente",0);
                $query->where("parcela",7);
                $query->whereRaw("data_baixa IS NULL");
            })
            //->whereRaw("data_boleto >= date_add(data_boleto, interval 1 day)")
            //->whereRaw("NOW() > date_add(updated_at, INTERVAL 30 SECOND)")
            // ->whereRaw("tempo >= now()")
            ->count();

        $total = $qtd_coletivo_em_analise + $qtd_coletivo_emissao_boleto + $qtd_coletivo_pg_adesao + $qtd_coletivo_pg_vigencia + $qtd_coletivo_02_parcela + $qtd_coletivo_03_parcela + $qtd_coletivo_04_parcela + $qtd_coletivo_05_parcela + $qtd_coletivo_06_parcela;
        
        $qtd_coletivo_finalizados = Contrato::where('financeiro_id',11)
            ->where("plano_id",3)
            //->whereRaw("data_boleto >= date_add(data_boleto, interval 1 day)")
            //->whereRaw("NOW() > date_add(updated_at, INTERVAL 30 SECOND)")
            // ->whereRaw("tempo >= now()")
            ->count();
        
        $qtd_coletivo_cancelados = Contrato::where('financeiro_id',12)
            ->where("plano_id",3)
            //->whereRaw("data_boleto >= date_add(data_boleto, interval 1 day)")
            //->whereRaw("NOW() > date_add(updated_at, INTERVAL 30 SECOND)")
            // ->whereRaw("tempo >= now()")
            ->count();   
            
        
        $qtd_empresarial_pendentes = ContratoEmpresarial::count();        


        $qtd_empresarial_em_analise = ContratoEmpresarial::where("financeiro_id",1)->count();
        $qtd_empresarial_parcela_01 = ContratoEmpresarial
        ::with("comissao")
        ->whereHas('comissao.comissoesLancadas',function($query){
            $query->where("status_financeiro",0);
            $query->where("status_gerente",0);
            $query->where("parcela",1);
            $query->whereRaw("data_baixa IS NULL");
        })
       
        ->where("financeiro_id",5)
        ->count();

        $qtd_empresarial_parcela_02 = ContratoEmpresarial
        ::with("comissao")
        ->whereHas('comissao.comissoesLancadas',function($query){
            $query->where("status_financeiro",0);
            $query->where("status_gerente",0);
            $query->where("parcela",2);
            $query->whereRaw("data_baixa IS NULL");
        })
       
        ->where("financeiro_id",6)
        ->count();


        
        
        $qtd_empresarial_parcela_03 = ContratoEmpresarial
        ::with("comissao")
        ->whereHas('comissao.comissoesLancadas',function($query){
            $query->where("status_financeiro",0);
            $query->where("status_gerente",0);
            $query->where("parcela",3);
            $query->whereRaw("data_baixa IS NULL");
        })
       
        ->where("financeiro_id",7)
        ->count();        
        
        $qtd_empresarial_parcela_04 = ContratoEmpresarial
        ::with("comissao")
        ->whereHas('comissao.comissoesLancadas',function($query){
            $query->where("status_financeiro",0);
            $query->where("status_gerente",0);
            $query->where("parcela",4);
            $query->whereRaw("data_baixa IS NULL");
        })
        ->where("financeiro_id",8)
        ->count();
        
        $qtd_empresarial_parcela_05 = ContratoEmpresarial
        ::with("comissao")
        ->whereHas('comissao.comissoesLancadas',function($query){
            $query->where("status_financeiro",0);
            $query->where("status_gerente",0);
            $query->where("parcela",5);
            $query->whereRaw("data_baixa IS NULL");
        })
        ->where("financeiro_id",9)
        ->count();


        $qtd_empresarial_parcela_06 = ContratoEmpresarial
        ::with("comissao")
        ->whereHas('comissao.comissoesLancadas',function($query){
            $query->where("status_financeiro",0);
            $query->where("status_gerente",0);
            $query->where("parcela",6);
            $query->whereRaw("data_baixa IS NULL");
        })
        ->where("financeiro_id",10)->count();

        $qtd_empresarial_finalizado = ContratoEmpresarial::where("financeiro_id",11)->count();
        
        $qtd_empresarial_cancelado = ContratoEmpresarial::where("financeiro_id",12)->count();




        return view('admin.pages.financeiro.index',[
            "cidades" => $cidades,
            "administradoras" => $administradoras,
            "planos" => $planos,
            "planos_empresarial" => $plano_empresarial,
            "users" => $users,
            "origem_tabela" => $tabela_origem,


            "qtd_individual_pendentes" => $qtd_individual_pendentes,
            "qtd_individual_parcela_01" => $qtd_individual_parcela_01,
            "qtd_individual_parcela_02" => $qtd_individual_parcela_02,
            "qtd_individual_parcela_03" => $qtd_individual_parcela_03,
            "qtd_individual_parcela_04" => $qtd_individual_parcela_04,
            "qtd_individual_parcela_05" => $qtd_individual_parcela_05,
            "qtd_individual_parcela_06" => $qtd_individual_parcela_06,
            "qtd_individual_em_analise" => $qtd_individual_em_analise,
            "qtd_individual_finalizado" => $qtd_individual_finalizado,
            "qtd_individual_cancelado" => $qtd_individual_cancelado,

            "qtd_coletivo_em_analise" => $qtd_coletivo_em_analise,
            "qtd_coletivo_emissao_boleto" => $qtd_coletivo_emissao_boleto,
            "qtd_coletivo_pg_adesao" => $qtd_coletivo_pg_adesao,
            "qtd_coletivo_pg_vigencia" => $qtd_coletivo_pg_vigencia,
            "qtd_coletivo_02_parcela" => $qtd_coletivo_02_parcela,
            "qtd_coletivo_03_parcela" => $qtd_coletivo_03_parcela,
            "qtd_coletivo_04_parcela" => $qtd_coletivo_04_parcela,
            "qtd_coletivo_05_parcela" => $qtd_coletivo_05_parcela,
            "qtd_coletivo_06_parcela" => $qtd_coletivo_06_parcela,
            "qtd_coletivo_finalizados" => $qtd_coletivo_finalizados,
            "qtd_coletivo_cancelados" => $qtd_coletivo_cancelados,
            "contratos_coletivo_pendentes" => $contratos_coletivo_pendentes,


            "qtd_empresarial_pendentes" => $qtd_empresarial_pendentes,
            "qtd_empresarial_parcela_01" => $qtd_empresarial_parcela_01,
            "qtd_empresarial_parcela_02" => $qtd_empresarial_parcela_02,
            "qtd_empresarial_parcela_03" => $qtd_empresarial_parcela_03,
            "qtd_empresarial_parcela_04" => $qtd_empresarial_parcela_04,
            "qtd_empresarial_parcela_05" => $qtd_empresarial_parcela_05,
            "qtd_empresarial_parcela_06" => $qtd_empresarial_parcela_06,
            "qtd_empresarial_em_analise" => $qtd_empresarial_em_analise,
            "qtd_empresarial_finalizado" => $qtd_empresarial_finalizado,
            "qtd_empresarial_cancelado" => $qtd_empresarial_cancelado,

            "total" => $total,

            "motivo_cancelados" => $motivo_cancelados

        ]);
    }

    public function coletivoEmAnalise(Request $request)
    {
        $contratos = Contrato
            ::where("plano_id",3)        
            ->where("financeiro_id",1)
            ->with(['administradora','financeiro','cidade','comissao','acomodacao','comissao.comissaoAtualFinanceiro','plano','somarCotacaoFaixaEtaria','clientes','clientes.user','clientes.dependentes'])
            ->orderBy("id","desc")
            ->get();
        return $contratos;
    }

    public function coletivoEmAnaliseCorretor(Request $request)
    {
        $contratos = Contrato
            ::where("plano_id",3)        
            ->where("financeiro_id",1)
            ->whereHas('clientes',function($query){
                $query->where('user_id',auth()->user()->id);
            })
            ->with(['administradora','financeiro','cidade','comissao','acomodacao','comissao.comissaoAtualFinanceiro','plano','somarCotacaoFaixaEtaria','clientes','clientes.user','clientes.dependentes'])
            ->orderBy("id","desc")
            ->get();
        return $contratos;
    }



    public function coletivoEmGeral(Request $request)
    {
        $contratos = Contrato
            ::where("plano_id",3)        
            // ->where("financeiro_id",1)
            ->with(['administradora','financeiro','cidade','comissao','comissao.comissaoAtualFinanceiro','acomodacao','plano','somarCotacaoFaixaEtaria','clientes','clientes.user','clientes.dependentes'])
            ->orderBy("id","desc")
            ->get();
        return $contratos;
    }

    public function coletivoEmGeralCorretor(Request $request)
    {
        $contratos = Contrato
            ::where("plano_id",3)  
            ->whereHas('clientes',function($query){
                $query->where('user_id',auth()->user()->id);
            })     
            // ->where("financeiro_id",1)
            ->with(['administradora','financeiro','cidade','comissao','comissao.comissaoAtualFinanceiro','acomodacao','plano','somarCotacaoFaixaEtaria','clientes','clientes.user','clientes.dependentes'])
            ->orderBy("id","desc")
            ->get();
        return $contratos;
    }




    public function empresarialEmGeral(Request $request)
    {
        
    }

    public function emAnaliseIndividual(Request $request)
    {
        $contratos = Contrato
            ::where("plano_id",1)        
            ->where("financeiro_id",1)
            ->with(['administradora','financeiro','cidade','comissao','acomodacao','plano','comissao.comissaoAtualFinanceiro','somarCotacaoFaixaEtaria','clientes','clientes.user','clientes.dependentes'])
            ->orderBy("id","desc")
            ->get();
        return $contratos;
    }

    public function emAnaliseIndividualCorretor(Request $request)
    {
        $contratos = Contrato
            ::where("plano_id",1)        
            ->where("financeiro_id",1)
            ->whereHas('clientes',function($query){
                $query->where("user_id",auth()->user()->id);
            })
            ->with(['administradora','financeiro','cidade','comissao','acomodacao','plano','comissao.comissaoAtualFinanceiro','somarCotacaoFaixaEtaria','clientes','clientes.user','clientes.dependentes'])
            ->orderBy("id","desc")
            ->get();
        return $contratos;
    }




    public function geralIndividualPendentes(Request $request)
    {
        $contratos = Contrato
            ::where("plano_id",1)        
            ->with(['administradora','financeiro','cidade','comissao','acomodacao','plano','comissao.comissaoAtualFinanceiro','somarCotacaoFaixaEtaria','clientes','clientes.user','clientes.dependentes'])
            ->orderBy("id","desc")
            ->get();
        return $contratos;
    }




    public function coletivoEmissaoBoleto(Request $request)
    {
        $contratos = Contrato
            ::where("plano_id",3)        
            ->where("financeiro_id",2)
            ->with(['administradora','financeiro','cidade','comissao','acomodacao','plano','comissao.comissaoAtualFinanceiro','somarCotacaoFaixaEtaria','clientes','clientes.user','clientes.dependentes'])
            ->orderBy("id","desc")
            ->get();
        return $contratos;
    }
                    
    public function coletivoEmissaoBoletoCorretor(Request $request)
    {
        $contratos = Contrato
            ::where("plano_id",3)        
            ->whereHas('clientes',function($query){
                $query->where("user_id",auth()->user()->id);
            })
            ->where("financeiro_id",2)
            ->with(['administradora','financeiro','cidade','comissao','acomodacao','plano','comissao.comissaoAtualFinanceiro','somarCotacaoFaixaEtaria','clientes','clientes.user','clientes.dependentes'])
            ->orderBy("id","desc")
            ->get();
        return $contratos;
    }






    public function coletivoPagamentoAdesao(Request $request)
    {
        $contratos = Contrato
            ::where("plano_id",3)        
            ->where("financeiro_id",3)
            ->with(['administradora','financeiro','cidade','comissao','acomodacao','plano','comissao.comissaoAtualFinanceiro','somarCotacaoFaixaEtaria','clientes','clientes.user','clientes.dependentes'])
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro",0);
                $query->where("status_gerente",0);
                $query->where("parcela",1);
                $query->whereRaw("data_baixa IS NULL");
            })
            //->whereRaw("data_boleto >= date_add(data_boleto, interval 1 day)")
            //->whereRaw("NOW() > date_add(updated_at, INTERVAL 30 SECOND)")
            // ->whereRaw("tempo >= now()")
            ->orderBy("id","desc")
            ->get();
        return $contratos;
    }

    public function coletivoPagamentoAdesaoCorretor(Request $request)
    {
        $contratos = Contrato
            ::where("plano_id",3)        
            ->where("financeiro_id",3)
            ->whereHas('clientes',function($query){
                $query->where("user_id",auth()->user()->id);
            })
            ->with(['administradora','financeiro','cidade','comissao','acomodacao','plano','comissao.comissaoAtualFinanceiro','somarCotacaoFaixaEtaria','clientes','clientes.user','clientes.dependentes'])
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro",0);
                $query->where("status_gerente",0);
                $query->where("parcela",1);
                $query->whereRaw("data_baixa IS NULL");
            })
            ->whereRaw("NOW() > date_add(updated_at, INTERVAL 30 SECOND)")
            ->orderBy("id","desc")
            ->get();
        return $contratos;
    }





    public function coletivoPagamentoVigencia(Request $request)
    {
        $contratos = Contrato
            ::where("plano_id",3)        
            ->where("financeiro_id",4)
            ->with(['administradora','financeiro','cidade','comissao','acomodacao','plano','comissao.comissaoAtualFinanceiro','somarCotacaoFaixaEtaria','clientes','clientes.user','clientes.dependentes'])
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro",0);
                $query->where("status_gerente",0);
                $query->where("parcela",2);
                $query->whereRaw("data_baixa IS NULL");
            })
            //->whereRaw("NOW() > date_add(updated_at, INTERVAL 30 SECOND)")
            ->orderBy("id","desc")
            ->get();
        return $contratos;
    }

    public function coletivoPagamentoVigenciaCorretor(Request $request)
    {
        $contratos = Contrato
            ::where("plano_id",3)        
            ->where("financeiro_id",4)
            ->with(['administradora','financeiro','cidade','comissao','acomodacao','plano','comissao.comissaoAtualFinanceiro','somarCotacaoFaixaEtaria','clientes','clientes.user','clientes.dependentes'])
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro",0);
                $query->where("status_gerente",0);
                $query->where("parcela",2);
                $query->whereRaw("data_baixa IS NULL");
            })
            ->whereHas('clientes',function($query){
                $query->where('user_id',auth()->user()->id);
            })
            ->whereRaw("NOW() > date_add(updated_at, INTERVAL 30 SECOND)")
            ->orderBy("id","desc")
            
            ->get();
        return $contratos;
    }

    public function individualPagamentoPrimeiraParcela(Request $request)
    {
        $contratos = Contrato
            ::where("plano_id",1)        
            ->where("financeiro_id",5)
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro",0);
                $query->where("status_gerente",0);
                $query->where("parcela",1);
                $query->whereRaw("data_baixa IS NULL");
            })
            ->with(['administradora','financeiro','cidade','comissao','acomodacao','plano','comissao.comissaoAtualFinanceiro','somarCotacaoFaixaEtaria','clientes','clientes.user','clientes.dependentes'])
            ->orderBy("id","desc")
            ->get();
        return $contratos;
    }

    public function individualPagamentoPrimeiraParcelaCorretor(Request $request)
    {
        $contratos = Contrato
            ::where("plano_id",1)        
            ->where("financeiro_id",5)
            ->whereHas('clientes',function($query){
                $query->where('user_id',auth()->user()->id);
            })
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro",0);
                $query->where("status_gerente",0);
                $query->where("parcela",1);
                $query->whereRaw("data_baixa IS NULL");
            })
            ->with(['administradora','financeiro','cidade','comissao','acomodacao','plano','comissao.comissaoAtualFinanceiro','somarCotacaoFaixaEtaria','clientes','clientes.user','clientes.dependentes'])
            ->orderBy("id","desc")
            ->get();
        return $contratos;
    }


    public function coletivoPagamentoSegundaParcela(Request $request)
    {
        $contratos = Contrato
            ::where("plano_id",3)        
            ->where("financeiro_id",6)
            ->with(['administradora','financeiro','cidade','comissao','acomodacao','plano','comissao.comissaoAtualFinanceiro','somarCotacaoFaixaEtaria','clientes','clientes.user','clientes.dependentes'])
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro",0);
                $query->where("status_gerente",0);
                $query->where("parcela",3);
                $query->whereRaw("data_baixa IS NULL");
                
            })
            //->whereRaw("NOW() > date_add(updated_at, INTERVAL 30 SECOND)")
            ->with('comissao.comissaoAtualFinanceiro')
            ->orderBy("id","desc")
            ->get();
        return $contratos;
    }

    public function coletivoPagamentoSegundaParcelaCorretor(Request $request)
    {
        $contratos = Contrato
            ::where("plano_id",3)        
            ->where("financeiro_id",6)
            ->with(['administradora','financeiro','cidade','comissao','acomodacao','plano','comissao.comissaoAtualFinanceiro','somarCotacaoFaixaEtaria','clientes','clientes.user','clientes.dependentes'])
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro",0);
                $query->where("status_gerente",0);
                $query->where("parcela",3);
                $query->whereRaw("data_baixa IS NULL");
                
            })
            ->whereHas('clientes',function($query){
                $query->where("user_id",auth()->user()->id);
            })
            ->whereRaw("NOW() > date_add(updated_at, INTERVAL 30 SECOND)")
            ->with('comissao.comissaoAtualFinanceiro')
            ->orderBy("id","desc")
            ->get();
        return $contratos;
    }

    public function individualPagamentoSegundaParcela(Request $request)
    {
        $contratos = Contrato
            ::where("plano_id",1)        
            ->where("financeiro_id",6)
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro",0);
                $query->where("status_gerente",0);
                $query->where("parcela",2);
                $query->whereRaw("data_baixa IS NULL");
            })
            ->whereRaw("NOW() > date_add(updated_at, INTERVAL 30 SECOND)")
            ->with(['administradora','financeiro','cidade','comissao','acomodacao','plano','comissao.comissaoAtualFinanceiro','somarCotacaoFaixaEtaria','clientes','clientes.user','clientes.dependentes'])
            ->orderBy("id","desc")
            ->get();
        return $contratos;
    }

    public function individualPagamentoSegundaParcelaCorretor(Request $request)
    {
        $contratos = Contrato
            ::where("plano_id",1)        
            ->where("financeiro_id",6)
            ->whereHas('clientes',function($query){
                $query->where('user_id',auth()->user()->id);
            })
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro",0);
                $query->where("status_gerente",0);
                $query->where("parcela",2);
                $query->whereRaw("data_baixa IS NULL");
            })
            ->whereRaw("NOW() > date_add(updated_at, INTERVAL 30 SECOND)")
            ->with(['administradora','financeiro','cidade','comissao','acomodacao','plano','comissao.comissaoAtualFinanceiro','somarCotacaoFaixaEtaria','clientes','clientes.user','clientes.dependentes'])
            ->orderBy("id","desc")
            ->get();
        return $contratos;
    }




    public function coletivoPagamentoTerceiraParcela(Request $request)
    {
        $contratos = Contrato
            ::where("plano_id",3)        
            ->where("financeiro_id",7)
            ->with(['administradora','financeiro','cidade','comissao','acomodacao','plano','comissao.comissaoAtualFinanceiro','somarCotacaoFaixaEtaria','clientes','clientes.user','clientes.dependentes'])
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro",0);
                $query->where("status_gerente",0);
                $query->where("parcela",4);
                $query->whereRaw("data_baixa IS NULL");
            })
            ->with('comissao.comissaoAtualFinanceiro')
            //->whereRaw("NOW() > date_add(updated_at, INTERVAL 30 SECOND)")
            //->whereRaw("data_boleto >= date_add(data_boleto, interval 1 day)")
            //->whereRaw("NOW() > date_add(updated_at, INTERVAL 30 SECOND)")
            // ->whereRaw("tempo >= now()")
            ->orderBy("id","desc")
            ->get();
        return $contratos;
    }

    public function coletivoPagamentoTerceiraParcelaCorretor(Request $request)
    {
        $contratos = Contrato
            ::where("plano_id",3)        
            ->where("financeiro_id",7)
            ->with(['administradora','financeiro','cidade','comissao','acomodacao','plano','comissao.comissaoAtualFinanceiro','somarCotacaoFaixaEtaria','clientes','clientes.user','clientes.dependentes'])
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro",0);
                $query->where("status_gerente",0);
                $query->where("parcela",4);
                $query->whereRaw("data_baixa IS NULL");
            })
            ->whereHas('clientes',function($query){
                $query->where("user_id",auth()->user()->id);
            })
            ->with('comissao.comissaoAtualFinanceiro')
            //->whereRaw("data_boleto >= date_add(data_boleto, interval 1 day)")
            ->whereRaw("NOW() > date_add(updated_at, INTERVAL 30 SECOND)")
            // ->whereRaw("tempo >= now()")
            ->orderBy("id","desc")
            ->get();
        return $contratos;
    }

    public function individualPagamentoTerceiraParcela(Request $request)
    {
        $contratos = Contrato
            ::where("plano_id",1)        
            ->where("financeiro_id",7)
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro","=",0);
                $query->where("status_gerente",0);
                $query->where("parcela",3);
                $query->whereRaw("data_baixa IS NULL");
            })
            ->with(['administradora','financeiro','cidade','comissao','acomodacao','plano','comissao.comissaoAtualFinanceiro','somarCotacaoFaixaEtaria','clientes','clientes.user','clientes.dependentes'])
            ->orderBy("id","desc")
            ->get();
        return $contratos;
    }

    public function individualPagamentoTerceiraParcelaCorretor(Request $request)
    {
        $contratos = Contrato
            ::where("plano_id",1)        
            ->where("financeiro_id",7)
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro","=",0);
                $query->where("status_gerente",0);
                $query->where("parcela",3);
                $query->whereRaw("data_baixa IS NULL");
            })
            ->whereHas('clientes',function($query){
                $query->where('user_id',auth()->user()->id);
            })
            ->with(['administradora','financeiro','cidade','comissao','acomodacao','plano','comissao.comissaoAtualFinanceiro','somarCotacaoFaixaEtaria','clientes','clientes.user','clientes.dependentes'])
            ->orderBy("id","desc")
            ->get();
        return $contratos;
    }




    public function coletivoPagamentoQuartaParcela(Request $request)
    {
        $contratos = Contrato
            ::where("plano_id",3)        
            ->where("financeiro_id",8)
            ->with(['administradora','financeiro','cidade','comissao','acomodacao','plano','comissao.comissaoAtualFinanceiro','somarCotacaoFaixaEtaria','clientes','clientes.user','clientes.dependentes'])
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro",0);
                $query->where("status_gerente",0);
                $query->where("parcela",5);
                $query->whereRaw("data_baixa IS NULL");
            })
            ->with('comissao.comissaoAtualFinanceiro')
            //->whereRaw("data_boleto >= date_add(data_boleto, interval 1 day)")
            //->whereRaw("NOW() > date_add(updated_at, INTERVAL 30 SECOND)")
            // ->whereRaw("tempo >= now()")
            ->orderBy("id","desc")
            ->get();
        return $contratos;
    }

    public function coletivoPagamentoQuartaParcelaCorretor(Request $request)
    {
        $contratos = Contrato
            ::where("plano_id",3)        
            ->where("financeiro_id",8)
            ->with(['administradora','financeiro','cidade','comissao','acomodacao','plano','comissao.comissaoAtualFinanceiro','somarCotacaoFaixaEtaria','clientes','clientes.user','clientes.dependentes'])
            ->whereHas('clientes',function($query){
                $query->where("user_id",auth()->user()->id);
            })
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro",0);
                $query->where("status_gerente",0);
                $query->where("parcela",5);
                $query->whereRaw("data_baixa IS NULL");
            })
            ->with('comissao.comissaoAtualFinanceiro')
            //->whereRaw("data_boleto >= date_add(data_boleto, interval 1 day)")
            ->whereRaw("NOW() > date_add(updated_at, INTERVAL 30 SECOND)")
            // ->whereRaw("tempo >= now()")
            ->orderBy("id","desc")
            ->get();
        return $contratos;
    }







    public function individualPagamentoQuartaParcela(Request $request)
    {
        $contratos = Contrato
            ::where("plano_id",1)        
            ->where("financeiro_id",8)
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro","=",0);
                $query->where("status_gerente",0);
                $query->where("parcela",4);
                $query->whereRaw("data_baixa IS NULL");
            })
            ->with(['administradora','financeiro','cidade','comissao','acomodacao','plano','comissao.comissaoAtualFinanceiro','somarCotacaoFaixaEtaria','clientes','clientes.user','clientes.dependentes'])
            ->orderBy("id","desc")
            ->get();
        return $contratos;
    }

    public function individualPagamentoQuartaParcelaCorretor(Request $request)
    {
        $contratos = Contrato
            ::where("plano_id",1)        
            ->where("financeiro_id",8)
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro","=",0);
                $query->where("status_gerente",0);
                $query->where("parcela",4);
                $query->whereRaw("data_baixa IS NULL");
            })
            ->whereHas('clientes',function($query){
                $query->where('user_id',auth()->user()->id);
            })
            ->with(['administradora','financeiro','cidade','comissao','acomodacao','plano','comissao.comissaoAtualFinanceiro','somarCotacaoFaixaEtaria','clientes','clientes.user','clientes.dependentes'])
            ->orderBy("id","desc")
            ->get();
        return $contratos;
    }

    public function coletivoPagamentoQuintaParcela(Request $request)
    {
        $contratos = Contrato
            ::where("plano_id",3)        
            ->where("financeiro_id",9)
            ->with(['administradora','financeiro','cidade','comissao','acomodacao','plano','comissao.comissaoAtualFinanceiro','somarCotacaoFaixaEtaria','clientes','clientes.user','clientes.dependentes'])
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro",0);
                $query->where("status_gerente",0);
                $query->where("parcela",6);
                $query->whereRaw("data_baixa IS NULL");
            })
            ->with('comissao.comissaoAtualFinanceiro')
            //->whereRaw("data_boleto >= date_add(data_boleto, interval 1 day)")
            //->whereRaw("NOW() > date_add(updated_at, INTERVAL 30 SECOND)")
            // ->whereRaw("tempo >= now()")
            ->orderBy("id","desc")
            ->get();
        return $contratos;
    }

    public function coletivoPagamentoQuintaParcelaCorretor(Request $request)
    {
        $contratos = Contrato
            ::where("plano_id",3)        
            ->where("financeiro_id",9)
            ->with(['administradora','financeiro','cidade','comissao','acomodacao','plano','comissao.comissaoAtualFinanceiro','somarCotacaoFaixaEtaria','clientes','clientes.user','clientes.dependentes'])
            ->whereHas('clientes',function($query){
                $query->where('user_id',auth()->user()->id);
            })
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro",0);
                $query->where("status_gerente",0);
                $query->where("parcela",6);
                $query->whereRaw("data_baixa IS NULL");
            })
            ->with('comissao.comissaoAtualFinanceiro')
            //->whereRaw("data_boleto >= date_add(data_boleto, interval 1 day)")
            ->whereRaw("NOW() > date_add(updated_at, INTERVAL 30 SECOND)")
            // ->whereRaw("tempo >= now()")
            ->orderBy("id","desc")
            ->get();
        return $contratos;
    }





    public function individualPagamentoQuintaParcela(Request $request)
    {
        $contratos = Contrato
        ::where("plano_id",1)        
        ->where("financeiro_id",9)
        ->whereHas('comissao.comissoesLancadas',function($query){
            $query->where("status_financeiro","=",0);
            $query->where("status_gerente",0);
            $query->where("parcela",5);
            $query->whereRaw("data_baixa IS NULL");
        })
        ->with(['administradora','financeiro','cidade','comissao','acomodacao','plano','comissao.comissaoAtualFinanceiro','somarCotacaoFaixaEtaria','clientes','clientes.user','clientes.dependentes'])
        ->orderBy("id","desc")
        ->get();
        return $contratos;
    }

    public function individualPagamentoQuintaParcelaCorretor(Request $request)
    {
        $contratos = Contrato
        ::where("plano_id",1)        
        ->where("financeiro_id",9)
        ->whereHas('clientes',function($query){
            $query->where("user_id",auth()->user()->id);
        })
        ->whereHas('comissao.comissoesLancadas',function($query){
            $query->where("status_financeiro","=",0);
            $query->where("status_gerente",0);
            $query->where("parcela",5);
            $query->whereRaw("data_baixa IS NULL");
        })
        ->with(['administradora','financeiro','cidade','comissao','acomodacao','plano','comissao.comissaoAtualFinanceiro','somarCotacaoFaixaEtaria','clientes','clientes.user','clientes.dependentes'])
        ->orderBy("id","desc")
        ->get();
        return $contratos;
    }

    public function coletivoPagamentoSextaParcela(Request $request)
    {
        $contratos = Contrato
            ::where("plano_id",3)        
            ->where("financeiro_id",10)
            ->with(['administradora','financeiro','cidade','comissao','acomodacao','plano','comissao.comissaoAtualFinanceiro','somarCotacaoFaixaEtaria','clientes','clientes.user','clientes.dependentes'])
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro",0);
                $query->where("status_gerente",0);
                $query->where("parcela",7);
                $query->whereRaw("data_baixa IS NULL");
            })
            ->with('comissao.comissaoAtualFinanceiro')
            //->whereRaw("data_boleto >= date_add(data_boleto, interval 1 day)")
            //->whereRaw("NOW() > date_add(updated_at, INTERVAL 30 SECOND)")
            // ->whereRaw("tempo >= now()")
            ->orderBy("id","desc")
            ->get();
        return $contratos;
    }

    public function coletivoPagamentoSextaParcelaCorretor(Request $request)
    {
        $contratos = Contrato
            ::where("plano_id",3)        
            ->where("financeiro_id",10)
            ->with(['administradora','financeiro','cidade','comissao','acomodacao','plano','comissao.comissaoAtualFinanceiro','somarCotacaoFaixaEtaria','clientes','clientes.user','clientes.dependentes'])
            ->whereHas('clientes',function($query){
                $query->where('user_id',auth()->user()->id);
            })
            
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro",0);
                $query->where("status_gerente",0);
                $query->where("parcela",7);
                $query->whereRaw("data_baixa IS NULL");
            })
            ->with('comissao.comissaoAtualFinanceiro')
            //->whereRaw("data_boleto >= date_add(data_boleto, interval 1 day)")
            ->whereRaw("NOW() > date_add(updated_at, INTERVAL 30 SECOND)")
            // ->whereRaw("tempo >= now()")
            ->orderBy("id","desc")
            ->get();
        return $contratos;
    }




    public function individualPagamentoSextaParcela(Request $request)
    {
        $contratos = Contrato
            ::where("plano_id",1)        
            ->where("financeiro_id",10)
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro",0);
                $query->where("status_gerente",0);
                $query->where("parcela",6);
                $query->whereRaw("data_baixa IS NULL");
            })
            ->with(['administradora','financeiro','cidade','comissao','acomodacao','plano','comissao.comissaoAtualFinanceiro','somarCotacaoFaixaEtaria','clientes','clientes.user','clientes.dependentes'])
            ->orderBy("id","desc")
            ->get();
        return $contratos;
    }

    public function individualPagamentoSextaParcelaCorretor(Request $request)
    {
        $contratos = Contrato
            ::where("plano_id",1)        
            ->where("financeiro_id",10)
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro",0);
                $query->where("status_gerente",0);
                $query->where("parcela",6);
                $query->whereRaw("data_baixa IS NULL");
            })
            ->whereHas('clientes',function($query){
                $query->where('user_id',auth()->user()->id);
            })
            ->with(['administradora','financeiro','cidade','comissao','acomodacao','plano','comissao.comissaoAtualFinanceiro','somarCotacaoFaixaEtaria','clientes','clientes.user','clientes.dependentes'])
            ->orderBy("id","desc")
            ->get();
        return $contratos;
    }

    public function coletivoFinalizado(Request $request)
    {
        $contratos = Contrato
            ::where("plano_id",3)        
            ->where("financeiro_id",11)
            ->with(['administradora','financeiro','cidade','comissao','acomodacao','plano','comissao.comissaoAtualFinanceiro','somarCotacaoFaixaEtaria','clientes','clientes.user','clientes.dependentes'])
            //->whereRaw("data_boleto >= date_add(data_boleto, interval 1 day)")
            //->whereRaw("NOW() > date_add(updated_at, INTERVAL 30 SECOND)")
            // ->whereRaw("tempo >= now()")
            ->orderBy("id","desc")
            ->get();
        return $contratos;
    }

    public function coletivoFinalizadoCorretor(Request $request)
    {
        $contratos = Contrato
            ::where("plano_id",3)        
            ->where("financeiro_id",11)
            ->whereHas('clientes',function($query){
                $query->where("user_id",auth()->user()->id);
            })
            ->with(['administradora','financeiro','cidade','comissao','acomodacao','plano','comissao.comissaoAtualFinanceiro','somarCotacaoFaixaEtaria','clientes','clientes.user','clientes.dependentes'])
            //->whereRaw("data_boleto >= date_add(data_boleto, interval 1 day)")
            //->whereRaw("NOW() > date_add(updated_at, INTERVAL 30 SECOND)")
            // ->whereRaw("tempo >= now()")
            ->orderBy("id","desc")
            ->get();
        return $contratos;
    }





    public function coletivoFinalizadoColetivo(Request $request) 
    {
        $contratos = Contrato
            ::where("plano_id",3) 
            ->whereHas("clientes",function($query){
                $query->where("user_id",auth()->user()->id);
            })       
            ->where("financeiro_id",11)
            ->with(['administradora','financeiro','cidade','comissao','acomodacao','plano','comissao.comissaoAtualFinanceiro','somarCotacaoFaixaEtaria','clientes','clientes.user','clientes.dependentes'])
            //->whereRaw("data_boleto >= date_add(data_boleto, interval 1 day)")
            //->whereRaw("NOW() > date_add(updated_at, INTERVAL 30 SECOND)")
            // ->whereRaw("tempo >= now()")
            ->orderBy("id","desc")
            ->get();
        return $contratos;
    }




    public function individualFinalizado(Request $request)
    {
        $contratos = Contrato
            ::where("plano_id",1)        
            ->where("financeiro_id",11)
            ->with(['administradora','financeiro','cidade','comissao','acomodacao','plano','comissao.comissaoAtualFinanceiro','somarCotacaoFaixaEtaria','clientes','clientes.user','clientes.dependentes'])
            //->whereRaw("data_boleto >= date_add(data_boleto, interval 1 day)")
            //->whereRaw("NOW() > date_add(updated_at, INTERVAL 30 SECOND)")
            // ->whereRaw("tempo >= now()")
            ->orderBy("id","desc")
            ->get();
        return $contratos;
    }

    public function individualFinalizadoCorretor(Request $request)
    {
        $contratos = Contrato
            ::where("plano_id",1)        
            ->where("financeiro_id",11)
            ->whereHas('clientes',function($query){
                $query->where('user_id',auth()->user()->id);
            })
            ->with(['administradora','financeiro','cidade','comissao','acomodacao','plano','comissao.comissaoAtualFinanceiro','somarCotacaoFaixaEtaria','clientes','clientes.user','clientes.dependentes'])
            //->whereRaw("data_boleto >= date_add(data_boleto, interval 1 day)")
            //->whereRaw("NOW() > date_add(updated_at, INTERVAL 30 SECOND)")
            // ->whereRaw("tempo >= now()")
            ->orderBy("id","desc")
            ->get();
        return $contratos;
    }





    public function coletivoCancelados(Request $request)
    {
        $contratos = Contrato
            ::where("plano_id",3)        
            ->where("financeiro_id",12)
            ->with(['administradora','financeiro','cidade','comissao','acomodacao','plano','somarCotacaoFaixaEtaria','clientes','clientes.user','clientes.dependentes'])
            //->whereRaw("data_boleto >= date_add(data_boleto, interval 1 day)")
            //->whereRaw("NOW() > date_add(updated_at, INTERVAL 30 SECOND)")
            //->whereRaw("tempo >= now()")
            ->orderBy("id","desc")
            ->get();
        return $contratos;
    }

    public function coletivoCanceladosCorretor(Request $request)
    {
        $contratos = Contrato
            ::where("plano_id",3)        
            ->where("financeiro_id",12)
            ->whereHas('clientes',function($query){
                $query->where("user_id",auth()->user()->id);
            })
            ->with(['administradora','financeiro','cidade','comissao','acomodacao','plano','somarCotacaoFaixaEtaria','clientes','clientes.user','clientes.dependentes'])
            //->whereRaw("data_boleto >= date_add(data_boleto, interval 1 day)")
            //->whereRaw("NOW() > date_add(updated_at, INTERVAL 30 SECOND)")
            //->whereRaw("tempo >= now()")
            ->orderBy("id","desc")
            ->get();
        return $contratos;
    }



    

    public function individualCancelados(Request $request)
    {
        $contratos = Contrato
            ::where("plano_id",1)        
            ->where("financeiro_id",12)
            ->with(['administradora','financeiro','cidade','comissao','comissao.cancelado','acomodacao','plano','comissao.comissaoAtualFinanceiro','somarCotacaoFaixaEtaria','clientes','clientes.user','clientes.dependentes'])
            //->whereRaw("data_boleto >= date_add(data_boleto, interval 1 day)")
            //->whereRaw("NOW() > date_add(updated_at, INTERVAL 30 SECOND)")
            //->whereRaw("tempo >= now()")
            ->orderBy("id","desc")
            ->get();
        return $contratos;
    }

    public function individualCanceladosCorretor(Request $request)
    {
        $contratos = Contrato
            ::where("plano_id",1)        
            ->where("financeiro_id",12)
            ->whereHas('clientes',function($query){
                $query->where('user_id',auth()->user()->id);
            })
            ->with(['administradora','financeiro','cidade','comissao','comissao.cancelado','acomodacao','plano','comissao.comissaoAtualFinanceiro','somarCotacaoFaixaEtaria','clientes','clientes.user','clientes.dependentes'])
            //->whereRaw("data_boleto >= date_add(data_boleto, interval 1 day)")
            //->whereRaw("NOW() > date_add(updated_at, INTERVAL 30 SECOND)")
            //->whereRaw("tempo >= now()")
            ->orderBy("id","desc")
            ->get();
        return $contratos;
    }





    public function mudarDataVivenciaColetivo(Request $request) 
    {
        $data = implode("-",array_reverse(explode("/",$request->data)));

        $contrato = Contrato::where("cliente_id",$request->cliente_id)->first();
        $contrato->data_vigencia = $data;
        if($contrato->save()) {
            return "sucesso";
        } else {
            return "error";
        }
    }


    public function mudarEstadosColetivo(Request $request)
    {
        $id_cliente = $request->id_cliente;
        $id_contrato = $request->id_contrato;
        $contrato = Contrato::find($id_contrato);
        switch ($contrato->financeiro_id) {
            case 1:
                $contrato->financeiro_id = 2;
            break;
            case 2:
                $contrato->financeiro_id = 3;
            break;      
            default:
                return "abrir_modal";     
            break;
        }
        $contrato->save();
        return $this->recalcularColetivo();
    }

    public function mudarEstadosIndividual(Request $request)
    {
        $id_cliente = $request->id_cliente;
        $id_contrato = $request->id_contrato;
        $contrato = Contrato::find($id_contrato);
        switch ($contrato->financeiro_id) {
            case 1:
                $contrato->financeiro_id = 5;
            break;
            default:
                return "abrir_modal_individual";     
            break;    
        }
        $contrato->save();
        return $this->recalcularIndividual();
     }

    public function mudarEstadosEmpresarial(Request $request)
    {
        
        // $id_cliente = $request->id_cliente;
        $id_contrato = $request->id_contrato;
        $contrato = ContratoEmpresarial::where("id",$id_contrato)->first();
        
        switch ($contrato->financeiro_id) {
            case 1:
                $contrato->financeiro_id = 5;
            break;
            default:
                return "abrir_modal_empresarial";     
            break;    
        }
        $contrato->save();
        return $this->recalcularEmpresarial();
     }





    public function verContrato(Request $request)
    {   

        //return $request->all();

        // if($request->financeiro_id == 1) {

        // } else {

        // }

        if($request->janela != "aba_empresarial") {
            $plano_id = Contrato::where("id",$request->contrato_id)->first()->plano_id;
            $id_comissao = Comissoes::where("contrato_id",$request->contrato_id)->first()->id;
            $comissoes = DB::table('comissoes_corretores_lancadas')
            ->selectRaw('parcela')
            ->selectRaw('DATA AS vencimento')
            ->selectRaw('data_baixa AS data_baixa')
            ->selectRaw('(SELECT valor_plano FROM contratos WHERE id = (SELECT contrato_id FROM comissoes WHERE comissoes.id = comissoes_corretores_lancadas.comissoes_id)) AS valor')
            ->selectRaw('DATEDIFF(data, data_baixa) as dias_faltando')
            ->selectRaw('(SELECT nome FROM clientes WHERE id = (SELECT cliente_id FROM contratos WHERE id = (SELECT contrato_id FROM comissoes WHERE comissoes.id = comissoes_corretores_lancadas.comissoes_id))) AS cliente')
            ->whereRaw("comissoes_id = ?",$id_comissao)
            ->get();



        } else {
            $plano_id = "";
            $id_comissao = Comissoes::where("contrato_empresarial_id",$request->contrato_id)->first()->id;

            $comissoes = DB::table('comissoes_corretores_lancadas')
            ->selectRaw('parcela')
            ->selectRaw('DATA AS vencimento')
            ->selectRaw('data_baixa AS data_baixa')
            ->selectRaw('(SELECT valor_plano FROM contrato_empresarial WHERE id = (SELECT contrato_empresarial_id FROM comissoes WHERE comissoes.id = comissoes_corretores_lancadas.comissoes_id)) AS valor')
            ->selectRaw('DATEDIFF(data, data_baixa) as dias_faltando')
            ->selectRaw('(SELECT responsavel FROM contrato_empresarial WHERE id = (SELECT contrato_empresarial_id FROM comissoes WHERE comissoes.id = comissoes_corretores_lancadas.comissoes_id)) AS cliente')
            ->whereRaw("comissoes_id = ?",$id_comissao)
            ->get();
            
            
        }    

        
        
        
        
        
        

        //return $comissoes;
            



        return view('admin.pages.comissao.ver',[
            "comissoes" => $comissoes,
            "cliente" => $comissoes[0]->cliente,
            "plano_id" => $plano_id
        ]);
    }

    public function cancelarContrato(Request $request) 
    {      
        
        $contrato_id = Comissoes::where("id",$request->comissao_id_cancelado)->first()->contrato_id;
        $contrato = Contrato::where("id",$contrato_id)->first();
        // $deletado = Cliente::where("id",$cliente)->delete();

        // if($deletado) {
        //     return $this->recalcularColetivo();
        // } else {
        //     return "error";
        // }

        $comissaoLancadas = ComissoesCorretoresLancadas
            ::where('comissoes_id',$request->comissao_id_cancelado)
            ->where('data_baixa',null)
            ->update(['cancelados' => 1]);
        if(!$comissaoLancadas) {
            return "error";
        }

        $dados = [];
        $dados['comissoes_id'] = $request->comissao_id_cancelado;
        $dados['data_baixa'] = $request->date;
        $dados['motivo'] = $request->motivo;
        $dados['observacao'] = $request->obs;
        $cancelados = Cancelado::create($dados);    
        if(!$cancelados) {
            return "error";
        }
        // $comissao = Comissoes::find($request->comissao_id_cancelado)->contrato_id;
        $contrato = Contrato::where("id",$contrato->id)->update(['financeiro_id'=>12]);
        if(!$contrato) {
            return "error";
        }

        if(Contrato::where("id",$contrato_id)->first()->plano_id == 3) {
            return [
                "plano" => "coletivo",
                "dados" => $this->recalcularColetivo()
            ]; 
                
        } else {
            return [
                "plano" => "individual",
                "dados" => $this->recalcularIndividual()
            ];
        }
        
    }

    public function excluirCliente(Request $request)
    {
        if($request->ajax()) {
            $id_cliente = $request->id_cliente;
            if($id_cliente != null) {
                $d = Cliente::where("id",$id_cliente)->delete();
                if($d) {
                    return $this->recalcularColetivo();
                } else {
                    return "error";
                }
            }
        }
        
    }

    public function excluirClienteIndividual(Request $request)
    {
        if($request->ajax()) {
            $id_cliente = $request->id_cliente;
            if($id_cliente != null) {
                $d = Cliente::where("id",$id_cliente)->delete();
                if($d) {
                    return $this->recalcularIndividual();
                } else {
                    return "error";
                }
            }
        }
        
    }

    public function excluirClienteEmpresarial(Request $request)
    {
        if($request->ajax()) {
            $id_contrato = $request->id_contrato;
            if($id_contrato != null) {
                $d = ContratoEmpresarial::find($id_contrato);
                if($d) {
                    return $this->recalcularEmpresarial();
                } else {
                    return "error";
                }
            }
        }
    }

    public function importarDados(Request $request)
    {
        $arquivo = $request->importar_arquivo;
        $handle = fopen($arquivo, "r");
        $row=0;
        $dados=[];
        $dd = "";
        
        $map = array(
            chr(0x8A) => chr(0xA9),
            chr(0x8C) => chr(0xA6),
            chr(0x8D) => chr(0xAB),
            chr(0x8E) => chr(0xAE),
            chr(0x8F) => chr(0xAC),
            chr(0x9C) => chr(0xB6),
            chr(0x9D) => chr(0xBB),
            chr(0xA1) => chr(0xB7),
            chr(0xA5) => chr(0xA1),
            chr(0xBC) => chr(0xA5),
            chr(0x9F) => chr(0xBC),
            chr(0xB9) => chr(0xB1),
            chr(0x9A) => chr(0xB9),
            chr(0xBE) => chr(0xB5),
            chr(0x9E) => chr(0xBE),
            chr(0x80) => '&euro;',
            chr(0x82) => '&sbquo;',
            chr(0x84) => '&bdquo;',
            chr(0x85) => '&hellip;',
            chr(0x86) => '&dagger;',
            chr(0x87) => '&Dagger;',
            chr(0x89) => '&permil;',
            chr(0x8B) => '&lsaquo;',
            chr(0x91) => '&lsquo;',
            chr(0x92) => '&rsquo;',
            chr(0x93) => '&ldquo;',
            chr(0x94) => '&rdquo;',
            chr(0x95) => '&bull;',
            chr(0x96) => '&ndash;',
            chr(0x97) => '&mdash;',
            chr(0x99) => '&trade;',
            chr(0x9B) => '&rsquo;',
            chr(0xA6) => '&brvbar;',
            chr(0xA9) => '&copy;',
            chr(0xAB) => '&laquo;',
            chr(0xAE) => '&reg;',
            chr(0xB1) => '&plusmn;',
            chr(0xB5) => '&micro;',
            chr(0xB6) => '&para;',
            chr(0xB7) => '&middot;',
            chr(0xBB) => '&raquo;',
        );

        

        $resultado = [];
        $cpfs = [];
       
     
        while (!feof($handle)) {
            $line = fgetcsv($handle, 0, ",");
            if($line != "") {
                $row++;
                if($row == 0 || $row == 1 || $row == 2 || $row == 3 || $row == 4)  continue;                
                if(isset($line[0]) && !empty($line[0])) $dd = explode(";",$line[0]);
                $cpf = mb_strlen($dd[4]) == 11 ? $dd[4] : str_pad($dd[4], 11, "000", STR_PAD_LEFT);
                // echo html_entity_decode(mb_convert_encoding(strtr($dd[5], $map),"UTF-8", 'ISO-8859-2'), ENT_QUOTES, 'UTF-8')." - ".$cpf."<br />";
                
                $url = "https://api-hapvida.sensedia.com/wssrvonline/v1/beneficiario?cpf=$cpf";
                $ch = curl_init($url);
                curl_setopt($ch,CURLOPT_URL,$url);
                curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
                $resultado[$cpf] = (array) json_decode(curl_exec($ch),true);
                if($resultado[$cpf]) {
                    
                    if(!in_array($cpf,$cpfs)) {
                        $dia = str_pad($dd[16], 2, "0", STR_PAD_LEFT);
                        $data_boleto = date("Y-m-".$dia);
                        array_push($cpfs,$cpf);
                        $key = array_search("SAUDE",array_column($resultado[$cpf], 'tipoPlanoC'));
                        
                        $user_id = User::where('codigo_vendedor',$dd[2])->first()->id;                    
                        $cliente = new Cliente();
                        $cliente->user_id = $user_id;
                        $cliente->nome = mb_convert_case($dd[5], MB_CASE_TITLE, "UTF-8");
                        $cliente->cidade = mb_convert_case($resultado[$cpf][$key]['cidadeEndereco'], MB_CASE_TITLE, "UTF-8");
                        $cliente->celular = $dd[7];
                        
                        $cliente->cpf = $cpf;
                        $cliente->data_nascimento = implode("-",array_reverse(explode("/",$dd[6])));
                        $cliente->cep = $resultado[$cpf][$key]['cepEndereco'];
                        $cliente->rua = $resultado[$cpf][$key]['ruaEndereco'];
                        $cliente->bairro =  mb_convert_case($resultado[$cpf][$key]['bairroEndereco'], MB_CASE_TITLE, "UTF-8");
                        $cliente->complemento = ($resultado[$cpf][$key]['complementoEndereco'] != null ? mb_convert_case($resultado[$cpf][$key]['complementoEndereco'], MB_CASE_TITLE, "UTF-8") : null);
                        $cliente->uf = $resultado[$cpf][$key]['ufEndereco'];
                        $cliente->pessoa_fisica = 1;
                        $cliente->pessoa_juridica = 0;
                        $cliente->nm_plano = $resultado[$cpf][$key]['nmPlano'];
                        $cliente->numero_registro_plano = $resultado[$cpf][$key]['nuRegistroPlano'];
                        $cliente->rede_plano = $resultado[$cpf][$key]['redePlano'];
                        $cliente->tipo_acomodacao_plano = $resultado[$cpf][$key]['tipoAcomodacaoPlano'];
                        $cliente->segmentacao_plano = $resultado[$cpf][$key]['segmentacaoPlano'];
                        $cliente->cateirinha = $resultado[$cpf][$key]['cdUsuario'];
                        $cliente->quantidade_vidas = $dd[15];
                        $cliente->email =  "teste@gmail.com";
                        $cliente->save();

                        $acomodacao = mb_convert_case($resultado[$cpf][$key]['tipoAcomodacaoPlano'], MB_CASE_TITLE, "UTF-8");
                        $acomodacao = $acomodacao == "Sem Acomodacao" ? "Ambulatorial" : $acomodacao;
                        $acomodacao_id = Acomodacao::selectRaw('id')->whereRaw("nome LIKE '%{$acomodacao}%'")->first()->id;
                        $data_vigencia = implode("-",explode("/",$dd[17]));
                       
                        $contrato = new Contrato();
                        $contrato->acomodacao_id = $acomodacao_id;
                        $contrato->cliente_id = $cliente->id;
                        $contrato->administradora_id = 4;
                        $contrato->tabela_origens_id = 2;
                        $contrato->plano_id = 1;
                        $contrato->financeiro_id = 1;
                        $contrato->data_vigencia = implode("-",array_reverse(explode("/",$dd[17])));
                        $contrato->codigo_externo = $dd[0];
                        $contrato->data_boleto = implode("-",array_reverse(explode("/",$dd[17])));
                        $contrato->valor_adesao = $dd[12];
                        $contrato->valor_plano = $dd[12];
                        $contrato->coparticipacao = 1;
                        $contrato->odonto = 0;
                        $contrato->created_at = $data_vigencia;
                        $contrato->desconto_corretor = "0,00";
                        $contrato->desconto_corretora = "0,00";
                        $contrato->save();
                        $comissao = new Comissoes();
                        $comissao->contrato_id = $contrato->id;
                        // $comissao->cliente_id = $contrato->cliente_id;
                        $comissao->user_id = $user_id;
                        // $comissao->status = 1;
                        $comissao->plano_id = 1;
                        $comissao->administradora_id = 4;
                        $comissao->tabela_origens_id = 2;
                        $comissao->data = date('Y-m-d');
                        $comissao->save();
            
                        // /* Comissao Corretor */
                        $comissoes_configuradas_corretor = ComissoesCorretoresConfiguracoes
                        ::where("plano_id",1)
                        ->where("administradora_id",4)
                        ->where("user_id",$user_id)
                        ->where("tabela_origens_id",2)
                        ->get();
                        $comissao_corretor_contagem = 0;
                        if(count($comissoes_configuradas_corretor) >= 1) {
                            foreach($comissoes_configuradas_corretor as $c) {
                                $comissaoVendedor = new ComissoesCorretoresLancadas();
                                $comissaoVendedor->comissoes_id = $comissao->id;
                                //$comissaoVendedor->user_id = auth()->user()->id;
                                $comissaoVendedor->parcela = $c->parcela;
                                if($comissao_corretor_contagem == 0) {
                                    $comissaoVendedor->data = date('Y-m-d',strtotime($data_boleto)); 
                                } else {
                                    $comissaoVendedor->data = date("Y-m-d",strtotime($data_boleto."+{$comissao_corretor_contagem}month"));
                                }
                                $comissaoVendedor->valor = ($dd[12] * $c->valor) / 100;
                                $comissaoVendedor->save();  
                                $comissao_corretor_contagem++;  
                            }
                        }
                    }                    
                }      
            }
        }
        fclose($handle);

        return redirect()->route('financeiro.index');





    }



    public function baixaDaData(Request $request) 
    {
        $id_cliente = $request->id_cliente;
        $id_contrato = $request->id_contrato;
        $contrato = Contrato::find($id_contrato);        
        switch ($contrato->financeiro_id) {
            case 3:

                //$contrato->financeiro_id = 4;
                $contrato->data_baixa = $request->data_baixa;
                $comissaoCorretor = ComissoesCorretoresLancadas
                    ::where("comissoes_id",$request->comissao_id)
                    ->where("parcela",1)            
                    ->first();
                if($comissaoCorretor) {                    
                    $comissaoCorretor->status_financeiro = 1;
                    $comissaoCorretor->data_baixa = $request->data_baixa;
                    $comissaoCorretor->save();
                }

                $comissaoCorretora = ComissoesCorretoraLancadas
                    ::where('comissoes_id',$request->comissao_id)
                    ->where('parcela',1)
                    ->first();
                if(isset($comissaoCorretora) && $comissaoCorretora) {
                    $comissaoCorretora->status_financeiro = 1;
                    $comissaoCorretora->data_baixa = $request->data_baixa;
                    $comissaoCorretora->save();
                } 

            break;
            
            case 4:

                //$contrato->financeiro_id = 6;
                $contrato->data_baixa = $request->data_baixa;
                $comissao = ComissoesCorretoresLancadas
                    ::where("comissoes_id",$request->comissao_id)
                    ->where("parcela",2)            
                    ->first();
                if($comissao) {
                    $comissao->status_financeiro = 1;
                    $comissao->data_baixa = $request->data_baixa;
                    $comissao->save();  
                }

                $comissaoCorretora = ComissoesCorretoraLancadas
                    ::where('comissoes_id',$request->comissao_id)
                    ->where('parcela',2)
                    ->first();
                if(isset($comissaoCorretora) && $comissaoCorretora) {
                    $comissaoCorretora->status_financeiro = 1;
                    $comissaoCorretora->data_baixa = $request->data_baixa;
                    $comissaoCorretora->save();
                } 





            break;
            
            case 6:

                //$contrato->financeiro_id = 7;
                $contrato->data_baixa = $request->data_baixa;
                $comissao = ComissoesCorretoresLancadas
                    ::where("comissoes_id",$request->comissao_id)
                    ->where("parcela",3)            
                    ->first();
                if($comissao) {
                    $comissao->status_financeiro = 1;
                    $comissao->data_baixa = $request->data_baixa;
                    $comissao->save();   
                }

                $comissaoCorretora = ComissoesCorretoraLancadas
                    ::where('comissoes_id',$request->comissao_id)
                    ->where('parcela',3)
                    ->first();
                if(isset($comissaoCorretora) && $comissaoCorretora) {
                    $comissaoCorretora->status_financeiro = 1;
                    $comissaoCorretora->data_baixa = $request->data_baixa;
                    $comissaoCorretora->save();
                } 






            break;

            case 7:

                //$contrato->financeiro_id = 8;
                $contrato->data_baixa = $request->data_baixa;
                $comissao = ComissoesCorretoresLancadas
                    ::where("comissoes_id",$request->comissao_id)
                    ->where("parcela",4)            
                    ->first();               
                if($comissao) {
                    $comissao->status_financeiro = 1;
                    $comissao->data_baixa = $request->data_baixa;
                    $comissao->save();   
                }
                
                $comissaoCorretora = ComissoesCorretoraLancadas
                    ::where('comissoes_id',$request->comissao_id)
                    ->where('parcela',4)
                    ->first();
                if(isset($comissaoCorretora) && $comissaoCorretora) {
                    $comissaoCorretora->status_financeiro = 1;
                    $comissaoCorretora->data_baixa = $request->data_baixa;
                    $comissaoCorretora->save();
                }     

            break;

            case 8:

                //$contrato->financeiro_id = 9;
                $contrato->data_baixa = $request->data_baixa;
                $comissao = ComissoesCorretoresLancadas
                    ::where("comissoes_id",$request->comissao_id)
                    ->where("parcela",5)            
                    ->first();
                if($comissao) {
                    $comissao->status_financeiro = 1;
                    $comissao->data_baixa = $request->data_baixa;
                    $comissao->save();
                }

                $comissaoCorretora = ComissoesCorretoraLancadas
                    ::where('comissoes_id',$request->comissao_id)
                    ->where('parcela',5)
                    ->first();
                if(isset($comissaoCorretora) && $comissaoCorretora) {
                    $comissaoCorretora->status_financeiro = 1;
                    $comissaoCorretora->data_baixa = $request->data_baixa;
                    $comissaoCorretora->save();
                } 





            break;

            case 9:

                //$contrato->financeiro_id = 10;
                $contrato->data_baixa = $request->data_baixa;
                $comissao = ComissoesCorretoresLancadas
                    ::where("comissoes_id",$request->comissao_id)
                    ->where("parcela",6)            
                    ->first();
                if($comissao) {
                    $comissao->status_financeiro = 1;
                    $comissao->data_baixa = $request->data_baixa;
                    $comissao->save();
                }

                $comissaoCorretora = ComissoesCorretoraLancadas
                    ::where('comissoes_id',$request->comissao_id)
                    ->where('parcela',6)
                    ->first();
                if(isset($comissaoCorretora) && $comissaoCorretora) {
                    $comissaoCorretora->status_financeiro = 1;
                    $comissaoCorretora->data_baixa = $request->data_baixa;
                    $comissaoCorretora->save();
                } 

            break;

            case 10:

                //$contrato->financeiro_id = 11;
                $contrato->data_baixa = $request->data_baixa;
                $comissao = ComissoesCorretoresLancadas
                    ::where("comissoes_id",$request->comissao_id)
                    ->where("parcela",7)            
                    ->first();
                if($comissao) {
                    $comissao->status_financeiro = 1;
                    $comissao->data_baixa = $request->data_baixa;
                    $comissao->save();  
                }

                $comissaoCorretora = ComissoesCorretoraLancadas
                    ::where('comissoes_id',$request->comissao_id)
                    ->where('parcela',7)
                    ->first();
                if(isset($comissaoCorretora) && $comissaoCorretora) {
                    $comissaoCorretora->status_financeiro = 1;
                    $comissaoCorretora->data_baixa = $request->data_baixa;
                    $comissaoCorretora->save();
                } 




            break;
                           
                        
            default:
                return "error";     
            break;
        }
        $contrato->save();
        return $this->recalcularColetivo();
    }

    public function baixaDaDataIndividual(Request $request) 
    {
        $id_cliente = $request->id_cliente;
        $id_contrato = $request->id_contrato;
        $contrato = Contrato::find($id_contrato);   

        switch ($contrato->financeiro_id) {
            case 5:
                //$contrato->financeiro_id = 6;
                $contrato->data_baixa = $request->data_baixa;
                $comissao = ComissoesCorretoresLancadas
                    ::where("comissoes_id",$request->comissao_id)
                    ->where("parcela",1)            
                    ->first();
                if($comissao) {                    
                    $comissao->status_financeiro = 1;
                    $comissao->data_baixa = $request->data_baixa;
                    $comissao->save();
                }   
                
                $comissaoCorretora = ComissoesCorretoraLancadas
                    ::where('comissoes_id',$request->comissao_id)
                    ->where('parcela',1)
                    ->first();
                if(isset($comissaoCorretora) && $comissaoCorretora) {
                    $comissaoCorretora->status_financeiro = 1;
                    $comissaoCorretora->data_baixa = $request->data_baixa;
                    $comissaoCorretora->save();
                } 


            break;
            
            case 6:
                //$contrato->financeiro_id = 7;
                $contrato->data_baixa = $request->data_baixa;
                $comissao = ComissoesCorretoresLancadas
                    ::where("comissoes_id",$request->comissao_id)
                    ->where("parcela",2)            
                    ->first();
                if($comissao) {
                    $comissao->status_financeiro = 1;
                    $comissao->data_baixa = $request->data_baixa;
                    $comissao->save();  
                }  
                
                $comissaoCorretora = ComissoesCorretoraLancadas
                    ::where('comissoes_id',$request->comissao_id)
                    ->where('parcela',2)
                    ->first();
                if(isset($comissaoCorretora) && $comissaoCorretora) {
                    $comissaoCorretora->status_financeiro = 1;
                    $comissaoCorretora->data_baixa = $request->data_baixa;
                    $comissaoCorretora->save();
                }     




            break;
            
            case 7:
                //$contrato->financeiro_id = 8;
                $contrato->data_baixa = $request->data_baixa;
                $comissao = ComissoesCorretoresLancadas
                    ::where("comissoes_id",$request->comissao_id)
                    ->where("parcela",3)            
                    ->first();
                if($comissao) {
                    $comissao->status_financeiro = 1;
                    $comissao->data_baixa = $request->data_baixa;
                    $comissao->save();   
                }

                $comissaoCorretora = ComissoesCorretoraLancadas
                    ::where('comissoes_id',$request->comissao_id)
                    ->where('parcela',3)
                    ->first();
                if(isset($comissaoCorretora) && $comissaoCorretora) {
                    $comissaoCorretora->status_financeiro = 1;
                    $comissaoCorretora->data_baixa = $request->data_baixa;
                    $comissaoCorretora->save();
                }     



            break;

            case 8:
                //$contrato->financeiro_id = 9;
                $contrato->data_baixa = $request->data_baixa;
                $comissao = ComissoesCorretoresLancadas
                    ::where("comissoes_id",$request->comissao_id)
                    ->where("parcela",4)            
                    ->first();
                if($comissao) {
                    $comissao->status_financeiro = 1;
                    $comissao->data_baixa = $request->data_baixa;
                    $comissao->save();   
                }

                $comissaoCorretora = ComissoesCorretoraLancadas
                    ::where('comissoes_id',$request->comissao_id)
                    ->where('parcela',4)
                    ->first();
                if(isset($comissaoCorretora) && $comissaoCorretora) {
                    $comissaoCorretora->status_financeiro = 1;
                    $comissaoCorretora->data_baixa = $request->data_baixa;
                    $comissaoCorretora->save();
                }     


            break;    

            case 9:
                //$contrato->financeiro_id = 10;
                $contrato->data_baixa = $request->data_baixa;
                $comissao = ComissoesCorretoresLancadas
                    ::where("comissoes_id",$request->comissao_id)
                    ->where("parcela",5)            
                    ->first();
                if($comissao) {
                    $comissao->status_financeiro = 1;
                    $comissao->data_baixa = $request->data_baixa;
                    $comissao->save();   
                }
                $comissaoCorretora = ComissoesCorretoraLancadas
                    ::where('comissoes_id',$request->comissao_id)
                    ->where('parcela',5)
                    ->first();
                if(isset($comissaoCorretora) && $comissaoCorretora) {
                    $comissaoCorretora->status_financeiro = 1;
                    $comissaoCorretora->data_baixa = $request->data_baixa;
                    $comissaoCorretora->save();
                }     




            break;   
            
            case 10:
                //$contrato->financeiro_id = 11;
                $contrato->data_baixa = $request->data_baixa;
                $comissao = ComissoesCorretoresLancadas
                    ::where("comissoes_id",$request->comissao_id)
                    ->where("parcela",6)            
                    ->first();
                if($comissao) {
                    $comissao->status_financeiro = 1;
                    $comissao->data_baixa = $request->data_baixa;
                    $comissao->save();   
                }

                $comissaoCorretora = ComissoesCorretoraLancadas
                    ::where('comissoes_id',$request->comissao_id)
                    ->where('parcela',6)
                    ->first();
                if(isset($comissaoCorretora) && $comissaoCorretora) {
                    $comissaoCorretora->status_financeiro = 1;
                    $comissaoCorretora->data_baixa = $request->data_baixa;
                    $comissaoCorretora->save();
                }     


            break;    
        }
        $contrato->save();
        return $this->recalcularIndividual();
    }

    public function baixaDaDataEmpresarial(Request $request)
    {
        $id_contrato = $request->id_contrato;
        $contrato = ContratoEmpresarial::find($id_contrato);  
        $comissao_id = Comissoes::where("contrato_empresarial_id",$contrato->id)->first()->id;
        
        switch ($contrato->financeiro_id) {
            case 5:
                
                $contrato->data_baixa = $request->data_baixa;
                $comissao = ComissoesCorretoresLancadas
                    ::where("comissoes_id",$comissao_id)
                    ->where("parcela",1)            
                    ->first();
                if($comissao) {                    
                    $comissao->status_financeiro = 1;
                    $comissao->data_baixa = $request->data_baixa;
                    $comissao->save();
                }   
                
                $comissaoCorretora = ComissoesCorretoraLancadas
                    ::where('comissoes_id',$comissao_id)
                    ->where('parcela',1)
                    ->first();
                if(isset($comissaoCorretora) && $comissaoCorretora) {
                    $comissaoCorretora->status_financeiro = 1;
                    $comissaoCorretora->data_baixa = $request->data_baixa;
                    $comissaoCorretora->save();
                } 




                
            break;

            case 6:
                //$contrato->financeiro_id = 7;
                $contrato->data_baixa = $request->data_baixa;
                $comissao = ComissoesCorretoresLancadas
                    ::where("comissoes_id",$comissao_id)
                    ->where("parcela",2)            
                    ->first();
                if($comissao) {
                    $comissao->status_financeiro = 1;
                    $comissao->data_baixa = $request->data_baixa;
                    $comissao->save();  
                } 
                
                $comissaoCorretora = ComissoesCorretoraLancadas
                    ::where('comissoes_id',$comissao_id)
                    ->where('parcela',2)
                    ->first();
                if(isset($comissaoCorretora) && $comissaoCorretora) {
                    $comissaoCorretora->status_financeiro = 1;
                    $comissaoCorretora->data_baixa = $request->data_baixa;
                    $comissaoCorretora->save();
                } 


            break;    

            case 7:
                
                $contrato->data_baixa = $request->data_baixa;
                $comissao = ComissoesCorretoresLancadas
                    ::where("comissoes_id",$comissao_id)
                    ->where("parcela",3)            
                    ->first();
                if($comissao) {
                    $comissao->status_financeiro = 1;
                    $comissao->data_baixa = $request->data_baixa;
                    $comissao->save();   
                }

                $comissaoCorretora = ComissoesCorretoraLancadas
                ::where('comissoes_id',$comissao_id)
                ->where('parcela',3)
                ->first();
            if(isset($comissaoCorretora) && $comissaoCorretora) {
                $comissaoCorretora->status_financeiro = 1;
                $comissaoCorretora->data_baixa = $request->data_baixa;
                $comissaoCorretora->save();
            } 



            break;

            case 8:
                
                $contrato->data_baixa = $request->data_baixa;
                $comissao = ComissoesCorretoresLancadas
                    ::where("comissoes_id",$comissao_id)
                    ->where("parcela",4)            
                    ->first();
                if($comissao) {
                    $comissao->status_financeiro = 1;
                    $comissao->data_baixa = $request->data_baixa;
                    $comissao->save();   
                }

                $comissaoCorretora = ComissoesCorretoraLancadas
                ::where('comissoes_id',$comissao_id)
                ->where('parcela',4)
                ->first();
            if(isset($comissaoCorretora) && $comissaoCorretora) {
                $comissaoCorretora->status_financeiro = 1;
                $comissaoCorretora->data_baixa = $request->data_baixa;
                $comissaoCorretora->save();
            } 



            break;    

            case 9:
                
                $contrato->data_baixa = $request->data_baixa;
                $comissao = ComissoesCorretoresLancadas
                    ::where("comissoes_id",$comissao_id)
                    ->where("parcela",5)            
                    ->first();
                if($comissao) {
                    $comissao->status_financeiro = 1;
                    $comissao->data_baixa = $request->data_baixa;
                    $comissao->save();   
                }

                $comissaoCorretora = ComissoesCorretoraLancadas
                ::where('comissoes_id',$comissao_id)
                ->where('parcela',5)
                ->first();
            if(isset($comissaoCorretora) && $comissaoCorretora) {
                $comissaoCorretora->status_financeiro = 1;
                $comissaoCorretora->data_baixa = $request->data_baixa;
                $comissaoCorretora->save();
            } 



            break;   
            
            case 10:
                
                $contrato->data_baixa = $request->data_baixa;
                $comissao = ComissoesCorretoresLancadas
                    ::where("comissoes_id",$comissao_id)
                    ->where("parcela",6)            
                    ->first();
                if($comissao) {
                    $comissao->status_financeiro = 1;
                    $comissao->data_baixa = $request->data_baixa;
                    $comissao->save();   
                }

                $comissaoCorretora = ComissoesCorretoraLancadas
                ::where('comissoes_id',$comissao_id)
                ->where('parcela',6)
                ->first();
            if(isset($comissaoCorretora) && $comissaoCorretora) {
                $comissaoCorretora->status_financeiro = 1;
                $comissaoCorretora->data_baixa = $request->data_baixa;
                $comissaoCorretora->save();
            } 


            break;    





        }
        $contrato->save();
        return $this->recalcularEmpresarial();
    }






    public function editarCampoIndividualmente(Request $request)
    {
        $cliente = Cliente::where("id",$request->id_cliente)->first();
        $dependente = Dependentes::where('cliente_id',$request->id_cliente)->first();

        switch($request->alvo) {
            
            case "cliente_coletivo_view":

                $cliente->nome = $request->valor;
                $cliente->save();

            break;
            
            case "data_nascimento_coletivo_view":

                $data = implode("-",array_reverse(explode("/",$request->valor)));
                $cliente->data_nascimento = $data;
                $cliente->save();

            break;

            case "cpf_coletivo_view":
                
                $cliente->cpf = $request->valor;
                $cliente->save();

            break;  

            case "responsavel_financeiro_coletivo":

                if(!$dependente) {
                    
                    $cad = new Dependentes();
                    $cad->cliente_id = $request->id_cliente;
                    $cad->nome = $request->valor;
                    $cad->save();                  
                } else {
                    $dependente->nome = $request->valor;
                    $dependente->save();
                }






                

            break;
            
            case "cpf_financeiro_coletivo_view":

                if(!$dependente) {
                    $cad = new Dependentes();
                    $cad->cliente_id = $request->id_cliente;
                    $cad->cpf = $request->valor;
                    $cad->save();
                } else {
                    $dependente->cpf = $request->valor;
                    $dependente->save();
                }

                

            break;
            
            case "celular_coletivo_view":

                $cliente->celular = $request->valor; 
                $cliente->save();

            break; 
            
            case "telefone_coletivo_view":

                $cliente->telefone = $request->valor;
                $cliente->save();

            break;

            case "cep_coletivo_view":

                $cliente->cep = $request->valor;
                $cliente->save();

            break;        

            
            case "email_coletivo_view":

                $cliente->email = $request->valor;
                $cliente->save();

            break;

            case "cidade_coletivo_view":

                $cliente->cidade = $request->valor;
                $cliente->save();

            break;
            
            case "uf_coletivo_view":

                $cliente->uf = $request->valor;
                $cliente->save();

            break;  
            
            case "bairro_coletivo_view":

                $cliente->bairro = $request->valor;
                $cliente->save();

            break;
            
            case "rua_coletivo_view":

                $cliente->rua = $request->valor;
                $cliente->save();

            break;
            
            case "complemento_coletivo_view":

                $cliente->complemento = $request->valor;
                $cliente->save();

            break;    
            
            default:

            break;

            //$cliente->save();

        }
    }


    public function editarIndividualCampoIndividualmente(Request $request)
    {
        
        $cliente = Cliente::where("id",$request->id_cliente)->first();
        $dependente = Dependentes::where('cliente_id',$request->id_cliente)->first();
        
        switch($request->alvo) {
            
            case "cliente":

                $cliente->nome = $request->valor;
                $cliente->save();

            break;
            
            case "data_nascimento":

                $data = implode("-",array_reverse(explode("/",$request->valor)));
                $cliente->data_nascimento = $data;
                $cliente->save();

            break;

            case "cpf":
                
                $cliente->cpf = $request->valor;
                $cliente->save();

            break;  

            case "responsavel_financeiro":
                
                $dependente->nome = $request->valor;
                $dependente->save();

            break;
            
            case "cpf_financeiro":
                
                $dependente->cpf = $request->valor;
                $dependente->save();

            break;
            
            case "celular_individual_view_input":

                $cliente->celular = $request->valor; 
                $cliente->save();

            break; 
            
            case "telefone_individual_view_input":

                $cliente->telefone = $request->valor;
                $cliente->save();

            break;

            case "cep_individual_cadastro":

                $cliente->cep = $request->valor;
                $cliente->save();

            break;        

            
            case "email":

                $cliente->email = $request->valor;
                $cliente->save();

            break;

            case "cidade":

                $cliente->cidade = $request->valor;
                $cliente->save();

            break;
            
            case "uf":

                $cliente->uf = $request->valor;
                $cliente->save();

            break;  
            
            case "bairro_individual_cadastro":

                $cliente->bairro = $request->valor;
                $cliente->save();

            break;
            
            case "rua_individual_cadastro":

                $cliente->rua = $request->valor;
                $cliente->save();

            break;
            
            case "complemento_individual_cadastro":

                $cliente->complemento = $request->valor;
                $cliente->save();

            break;    
            
            default:

            break;

            $cliente->save();

        }
    }




    public function recalcularColetivo()
    {
       

        $qtd_coletivo_em_analise = Contrato::where("financeiro_id",1)
            ->where("plano_id",3)
            ->count();

        $qtd_coletivo_emissao_boleto = Contrato::where("financeiro_id",2)
            ->where("plano_id",3)
            ->count();

        $qtd_coletivo_pg_adesao = Contrato::where('financeiro_id',3)
            ->where("plano_id",3)
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro",0);
                $query->where("status_gerente",0);
                $query->where("parcela",1);
                $query->whereRaw("data_baixa IS NULL");
            })
            ->count();
            
        
        $qtd_coletivo_pg_vigencia = Contrato::where('financeiro_id',4)
            ->where("plano_id",3)
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro",0);
                $query->where("status_gerente",0);
                $query->where("parcela",2);
                $query->whereRaw("data_baixa IS NULL");
            })
            ->count();
            
            

        $qtd_coletivo_02_parcela = Contrato::where('financeiro_id',6)
            ->where("plano_id",3)
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro",0);
                $query->where("status_gerente",0);
                $query->where("parcela",3);
                $query->whereRaw("data_baixa IS NULL");
            })
            ->count();

        $qtd_coletivo_03_parcela = Contrato::where('financeiro_id',7)
            ->where("plano_id",3)
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro",0);
                $query->where("status_gerente",0);
                $query->where("parcela",4);
                $query->whereRaw("data_baixa IS NULL");
            })
            ->count();

        $qtd_coletivo_04_parcela = Contrato::where('financeiro_id',8)
            ->where("plano_id",3)
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro",0);
                $query->where("status_gerente",0);
                $query->where("parcela",5);
                $query->whereRaw("data_baixa IS NULL");
            })
            ->count();

        $qtd_coletivo_05_parcela = Contrato::where('financeiro_id',9)
            ->where("plano_id",3)
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro",0);
                $query->where("status_gerente",0);
                $query->where("parcela",6);
                $query->whereRaw("data_baixa IS NULL");
            })
            ->count();

        $qtd_coletivo_06_parcela = Contrato::where('financeiro_id',10)
            ->where("plano_id",3)
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro",0);
                $query->where("status_gerente",0);
                $query->where("parcela",7);
                $query->whereRaw("data_baixa IS NULL");
            })
            ->count();

        $qtd_coletivo_finalizado = Contrato::where('financeiro_id',11)->where("plano_id",3)->count();
        $qtd_coletivo_cancelado = Contrato::where('financeiro_id',12)->where("plano_id",3)->count();

        return [
            "qtd_coletivo_em_analise" => $qtd_coletivo_em_analise,
            "qtd_coletivo_emissao_boleto" => $qtd_coletivo_emissao_boleto,
            "qtd_coletivo_pg_adesao" => $qtd_coletivo_pg_adesao,
            "qtd_coletivo_pg_vigencia" => $qtd_coletivo_pg_vigencia,
            "qtd_coletivo_02_parcela" => $qtd_coletivo_02_parcela,
            "qtd_coletivo_03_parcela" => $qtd_coletivo_03_parcela, 
            "qtd_coletivo_04_parcela" =>  $qtd_coletivo_04_parcela,
            "qtd_coletivo_05_parcela" => $qtd_coletivo_05_parcela,
            "qtd_coletivo_06_parcela" => $qtd_coletivo_06_parcela,
            "qtd_coletivo_finalizado" => $qtd_coletivo_finalizado,
            "qtd_coletivo_cancelado" => $qtd_coletivo_cancelado
        ];
    }

    public function recalcularIndividual()
    {
        $qtd_individual_pendentes = Contrato::where("plano_id",1)->count();



        $qtd_individual_em_analise = Contrato::where("financeiro_id",1)->where("plano_id",1)->count();
        $qtd_individual_01_parcela = Contrato
            ::where("plano_id",1)        
            ->where("financeiro_id",5)
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro",0);
                $query->where("status_gerente",0);
                $query->where("parcela",1);
                $query->whereRaw("data_baixa IS NULL");
            })->count();
        
        $qtd_individual_02_parcela = Contrato
            ::where("plano_id",1)        
            ->where("financeiro_id",6)
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro",0);
                $query->where("status_gerente",0);
                $query->where("parcela",2);
                $query->whereRaw("data_baixa IS NULL");
            })
            ->count();  
        
        $qtd_individual_03_parcela = Contrato
            ::where("plano_id",1)        
            ->where("financeiro_id",7)
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro",0);
                $query->where("status_gerente",0);
                $query->where("parcela",3);
                $query->whereRaw("data_baixa IS NULL");
            })
            ->count();        
        
        $qtd_individual_04_parcela = Contrato
            ::where("plano_id",1)        
            ->where("financeiro_id",8)
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro",0);
                $query->where("status_gerente",0);
                $query->where("parcela",4);
                $query->whereRaw("data_baixa IS NULL");
            })
            ->count();   
        
        $qtd_individual_05_parcela = Contrato
            ::where("plano_id",1)        
            ->where("financeiro_id",9)
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro","=",0);
                $query->where("status_gerente",0);
                $query->where("parcela",5);
                $query->whereRaw("data_baixa IS NULL");
            })
            ->count();  
         
        $qtd_individual_06_parcela = Contrato
            ::where("plano_id",1)        
            ->where("financeiro_id",10)
            ->whereHas('comissao.comissoesLancadas',function($query){
                $query->where("status_financeiro",0);
                $query->where("status_gerente",0);
                //$query->where("parcela",6);
                //$query->whereRaw("data_baixa IS NULL");
            })
            ->count();           

        $qtd_individual_finalizado = Contrato::where('financeiro_id',11)->where("plano_id",1)->count();
        $qtd_individual_cancelado = Contrato::where('financeiro_id',12)->where("plano_id",1)->count();
       
        return [
            "qtd_individual_em_analise" => $qtd_individual_em_analise,
            "qtd_individual_01_parcela" => $qtd_individual_01_parcela,
            "qtd_individual_02_parcela" => $qtd_individual_02_parcela,
            "qtd_individual_03_parcela" => $qtd_individual_03_parcela, 
            "qtd_individual_04_parcela" =>  $qtd_individual_04_parcela,
            "qtd_individual_05_parcela" => $qtd_individual_05_parcela,
            "qtd_individual_06_parcela" => $qtd_individual_06_parcela,
            "qtd_individual_finalizado" => $qtd_individual_finalizado,
            "qtd_individual_cancelado" => $qtd_individual_cancelado,
            "qtd_individual_pendentes" => $qtd_individual_pendentes
        ];
    }

    public function recalcularEmpresarial()
    {
        $qtd_empresarial_em_analise = ContratoEmpresarial::where("financeiro_id",1)->count();
        
        $qtd_empresarial_em_analise = ContratoEmpresarial::where("financeiro_id",1)->count();
        $qtd_empresarial_parcela_01 = ContratoEmpresarial
        ::with("comissao")
        ->whereHas('comissao.comissoesLancadas',function($query){
            $query->where("status_financeiro",0);
            $query->where("status_gerente",0);
            $query->where("parcela",1);
            $query->whereRaw("data_baixa IS NULL");
        })
       
        ->where("financeiro_id",5)
        ->count();

        $qtd_empresarial_parcela_02 = ContratoEmpresarial
        ::with("comissao")
        ->whereHas('comissao.comissoesLancadas',function($query){
            $query->where("status_financeiro",0);
            $query->where("status_gerente",0);
            $query->where("parcela",2);
            $query->whereRaw("data_baixa IS NULL");
        })
       
        ->where("financeiro_id",6)
        ->count();


        
        
        $qtd_empresarial_parcela_03 = ContratoEmpresarial
        ::with("comissao")
        ->whereHas('comissao.comissoesLancadas',function($query){
            $query->where("status_financeiro",0);
            $query->where("status_gerente",0);
            $query->where("parcela",3);
            $query->whereRaw("data_baixa IS NULL");
        })
       
        ->where("financeiro_id",7)
        ->count();        
        
        $qtd_empresarial_parcela_04 = ContratoEmpresarial
        ::with("comissao")
        ->whereHas('comissao.comissoesLancadas',function($query){
            $query->where("status_financeiro",0);
            $query->where("status_gerente",0);
            $query->where("parcela",4);
            $query->whereRaw("data_baixa IS NULL");
        })
        ->where("financeiro_id",8)
        ->count();
        
        $qtd_empresarial_parcela_05 = ContratoEmpresarial
        ::with("comissao")
        ->whereHas('comissao.comissoesLancadas',function($query){
            $query->where("status_financeiro",0);
            $query->where("status_gerente",0);
            $query->where("parcela",5);
            $query->whereRaw("data_baixa IS NULL");
        })
        ->where("financeiro_id",9)
        ->count();


        $qtd_empresarial_parcela_06 = ContratoEmpresarial
        ::with("comissao")
        ->whereHas('comissao.comissoesLancadas',function($query){
            $query->where("status_financeiro",0);
            $query->where("status_gerente",0);
            $query->where("parcela",6);
            $query->whereRaw("data_baixa IS NULL");
        })
        ->where("financeiro_id",10)->count();

        $qtd_empresarial_finalizado = ContratoEmpresarial::where("financeiro_id",11)->count();
        
        $qtd_empresarial_cancelado = ContratoEmpresarial::where("financeiro_id",12)->count();    
      
       
        return [
            "qtd_empresarial_em_analise" => $qtd_empresarial_em_analise,
            "qtd_empresarial_01_parcela" => $qtd_empresarial_parcela_01,
            "qtd_empresarial_02_parcela" => $qtd_empresarial_parcela_02,
            "qtd_empresarial_03_parcela" => $qtd_empresarial_parcela_03, 
            "qtd_empresarial_04_parcela" => $qtd_empresarial_parcela_04,
            "qtd_empresarial_05_parcela" => $qtd_empresarial_parcela_05,
            "qtd_empresarial_06_parcela" => $qtd_empresarial_parcela_06,
            "qtd_empresarial_finalizado" => $qtd_empresarial_finalizado,
            "qtd_empresarial_cancelado" => $qtd_empresarial_cancelado
        ];
    }










}
