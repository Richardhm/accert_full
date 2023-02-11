<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Planos;
use App\Models\Administradoras;
use App\Models\Acomodacao;
use App\Models\FaixaEtaria;
use App\Models\TabelaOrigens;
use App\Models\Tabela;


class TabelaController extends Controller
{
    public function index()
    {
        $administradoras = Administradoras::all();
        $planos = Planos::all();
        $acomodacao = Acomodacao::all();
        $faixas = FaixaEtaria::all();

        $tabela_origem = TabelaOrigens::all();

        return view('admin.pages.tabelas.index',[
            "administradoras" => $administradoras,
            "planos" => $planos,
            "acomodacao" => $acomodacao,
            "faixas" => $faixas,
            "tabela_origem" => $tabela_origem
        ]);
    }

    public function store(Request $request) 
    {

         foreach($request->faixa_etaria_id_apartamento as $k => $v) {
                $tabela = new Tabela();
                
                $tabela->administradora_id = $request->administradora;
                $tabela->plano_id = $request->planos;
                $tabela->tabela_origens_id = $request->tabela_origem;
                $tabela->acomodacao_id = 1;
                
                $tabela->coparticipacao = ($request->coparticipacao == "sim" ? true : false);
                $tabela->odonto = ($request->odonto == "sim" ? true : false);
                $tabela->faixa_etaria_id = $request->faixa_etaria_id_apartamento[$k];
                $tabela->valor = str_replace([".",","],["","."],$request->valor_apartamento[$k]);
                $tabela->save();
            }

            foreach($request->faixa_etaria_id_enfermaria as $k => $v) {
                $tabela = new Tabela();

                $tabela->administradora_id = $request->administradora;
                $tabela->plano_id = $request->planos;
                $tabela->tabela_origens_id = $request->tabela_origem;
                $tabela->acomodacao_id = 2;
                
                $tabela->coparticipacao = ($request->coparticipacao == "sim" ? true : false);
                $tabela->odonto = ($request->odonto == "sim" ? true : false);

                $tabela->faixa_etaria_id = $request->faixa_etaria_id_enfermaria[$k];
                $tabela->valor = str_replace([".",","],["","."],$request->valor_enfermaria[$k]);
                
                $tabela->save();
            }

            foreach($request->faixa_etaria_id_ambulatorial as $k => $v) {
                $tabela = new Tabela();
                
                $tabela->administradora_id = $request->administradora;
                $tabela->plano_id = $request->planos;
                $tabela->tabela_origens_id = $request->tabela_origem;
                $tabela->acomodacao_id = 3;
                
                $tabela->coparticipacao = ($request->coparticipacao == "sim" ? true : false);
                $tabela->odonto = ($request->odonto == "sim" ? true : false);

                $tabela->faixa_etaria_id = $request->faixa_etaria_id_ambulatorial[$k];
                $tabela->valor = str_replace([".",","],["","."],$request->valor_ambulatorial[$k]);


                $tabela->save();
            }

            return redirect()->route('tabela.index')->with('success',"A tabela foi cadastrada com sucesso");




    }



}
