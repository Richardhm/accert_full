<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\{
    Contrato,Cliente,TabelaOrigens,Administradoras,Planos,Acomodacao,CotacaoFaixaEtaria,User,PlanoEmpresarial,ContratoEmpresarial,  
    Comissoes,ComissoesCorretoresLancadas,ComissoesCorretoraConfiguracoes,ComissoesCorretoralancadas,ComissoesCorretoresConfiguracoes,
    Premiacoes,PremiacoesCorretoraLancadas,PremiacoesCorretoresLancadas,PremiacoesCorretoraConfiguracoes,PremiacoesCorretoresConfiguracoes,
};
use Illuminate\Support\Facades\DB;



class FinanceiroController extends Controller
{
    

    public function index()
    {
        $cidades = TabelaOrigens::all();
        $administradoras = Administradoras::whereRaw("id != (SELECT id FROM administradoras WHERE nome LIKE '%hapvida%')")->get();
        
        $planos = Planos::all();
        $plano_empresarial = PlanoEmpresarial::all();

        $users = User::where("id","!=",auth()->user()->id)->get();
        $tabela_origem = TabelaOrigens::all();

        $qtd_individual_parcela_01 = Comissoes
            ::where("user_id",auth()->user()->id)
            ->whereHas('comissoesLancadas',function($query){
                $query->where("parcela",1);
                $query->where("status",0);
            })->count();

        $qtd_individual_parcela_02 = Comissoes
            ::where("user_id",auth()->user()->id)
            ->whereHas('comissoesLancadas',function($query){
                $query->where("parcela",2);
                $query->where("status",0);
            })->count();  

        $qtd_individual_parcela_03 = Comissoes
            ::where("user_id",auth()->user()->id)
            ->whereHas('comissoesLancadas',function($query){
                $query->where("parcela",3);
                $query->where("status",0);
            })->count();      

        $qtd_individual_parcela_04 = Comissoes
            ::where("user_id",auth()->user()->id)
            ->whereHas('comissoesLancadas',function($query){
                $query->where("parcela",4);
                $query->where("status",0);
            })->count(); 
            
        $qtd_individual_parcela_05 = Comissoes
            ::where("user_id",auth()->user()->id)
            ->whereHas('comissoesLancadas',function($query){
                $query->where("parcela",5);
                $query->where("status",0);
            })->count();    

        $qtd_individual_parcela_06 = Comissoes
            ::where("user_id",auth()->user()->id)
            ->whereHas('comissoesLancadas',function($query){
                $query->where("parcela",6);
                $query->where("status",0);
            })->count();    

        return view('admin.pages.financeiro.index',[
            "cidades" => $cidades,
            "administradoras" => $administradoras,
            "planos" => $planos,
            "planos_empresarial" => $plano_empresarial,
            "users" => $users,
            "origem_tabela" => $tabela_origem,
            "qtd_individual_parcela_01" => $qtd_individual_parcela_01,
            "qtd_individual_parcela_02" => $qtd_individual_parcela_02,
            "qtd_individual_parcela_03" => $qtd_individual_parcela_03,
            "qtd_individual_parcela_04" => $qtd_individual_parcela_04,
            "qtd_individual_parcela_05" => $qtd_individual_parcela_05,
            "qtd_individual_parcela_06" => $qtd_individual_parcela_06
        ]);
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
            case 3:
                $contrato->financeiro_id = 4;
            break;
            case 4:
                $contrato->financeiro_id = 6;
            break;
            
            case 6:
                $contrato->financeiro_id = 7;
            break;
            case 7:
                $contrato->financeiro_id = 8;
            break;
            case 8:
                $contrato->financeiro_id = 9;
            break;
             case 9:
                $contrato->financeiro_id = 10;
            break;        
            default:
                // code...
            break;
        }
        $contrato->save();






    }




}
