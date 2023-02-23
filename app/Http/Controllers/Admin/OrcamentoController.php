<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\FaixaEtaria;
use App\Models\TabelaOrigens;

class OrcamentoController extends Controller
{
    public function index()
    {
        $faixaEtaria = FaixaEtaria::all();
        $tabelaOrigem = TabelaOrigens::all();

        return view('admin.pages.orcamento.index',[
            "faixaEtaria" => $faixaEtaria,
            "cidades" => $tabelaOrigem
        ]);
    }

    public function montarOrcamento(Request $request)
    {
        
        $sql = "";
        $chaves = [];
        foreach($request->faixas[0] as $k => $v) {
            if($v != null) {
                $sql .= "WHEN (SELECT id FROM faixa_etarias WHERE faixa_etarias.id = fora.faixa_etaria_id) = $k THEN $v ";
                $chaves[] = $k; 
            }
        }


        $chaves = implode(",",$chaves);

        $cidade = $request->tabela_origem;

        $dados = DB::select("SELECT 
            nome,id_faixas,admin_logo,cidade,admin_id,plano,titulos,card,admin_nome,quantidade,apartamento_com_coparticipacao,apartamento_com_coparticipacao_total,
    enfermaria_com_coparticipacao,enfermaria_com_coparticipacao_total,apartamento_sem_coparticipacao,apartamento_sem_coparticipacao_total,enfermaria_sem_coparticipacao,
    enfermaria_sem_coparticipacao_total
            FROM (
                SELECT 
                    
     (SELECT nome FROM faixa_etarias WHERE faixa_etarias.id = fora.faixa_etaria_id) AS nome, 
                    (SELECT id FROM faixa_etarias WHERE faixa_etarias.id = fora.faixa_etaria_id) AS id_faixas,          
                    CASE
                        $sql
                        ELSE 0
                    END AS quantidade,
                    (SELECT logo FROM administradoras as aa WHERE aa.id = fora.administradora_id) AS admin_logo,
                    (SELECT nome FROM administradoras as aa WHERE aa.id = fora.administradora_id) AS admin_nome,
                    (SELECT id FROM administradoras as aa WHERE aa.id = fora.administradora_id) AS admin_id,
     (SELECT nome FROM tabela_origens as cc WHERE cc.id = fora.tabela_origens_id) AS cidade,
     (SELECT nome FROM planos as pp WHERE pp.id = fora.plano_id) AS plano,
     (SELECT if(dentro.odonto = 0,'Sem Odonto','Com Odonto') AS odontos  FROM tabelas AS dentro WHERE dentro.administradora_id = fora.administradora_id AND dentro.plano_id = fora.plano_id AND dentro.coparticipacao = fora.coparticipacao AND dentro.odonto = fora.odonto AND dentro.tabela_origens_id = fora.tabela_origens_id AND dentro.faixa_etaria_id = fora.faixa_etaria_id LIMIT 1) AS titulos,
     (SELECT CONCAT((SELECT nome FROM administradoras as aa WHERE aa.id = dentro.administradora_id),'_',dentro.plano_id,'_',dentro.tabela_origens_id,'_',dentro.coparticipacao,'_',dentro.odonto) FROM tabelas AS dentro WHERE dentro.administradora_id = fora.administradora_id AND dentro.plano_id = fora.plano_id AND dentro.coparticipacao = fora.coparticipacao AND dentro.odonto = fora.odonto AND dentro.tabela_origens_id = fora.tabela_origens_id AND dentro.faixa_etaria_id = fora.faixa_etaria_id LIMIT 1) AS card,
     
                    (SELECT valor FROM tabelas AS dentro where dentro.administradora_id = fora.administradora_id AND dentro.plano_id = fora.plano_id AND dentro.tabela_origens_id = fora.tabela_origens_id AND acomodacao_id = 1 AND dentro.faixa_etaria_id = fora.faixa_etaria_id AND dentro.coparticipacao = 1 AND dentro.odonto = fora.odonto GROUP BY dentro.coparticipacao) AS apartamento_com_coparticipacao,
     (SELECT valor * quantidade FROM tabelas AS dentro where dentro.administradora_id = fora.administradora_id AND dentro.plano_id = fora.plano_id AND dentro.tabela_origens_id = fora.tabela_origens_id AND acomodacao_id = 1 AND dentro.faixa_etaria_id = fora.faixa_etaria_id AND dentro.coparticipacao = 1 AND dentro.odonto = fora.odonto GROUP BY dentro.coparticipacao) AS apartamento_com_coparticipacao_total,
                    
                    (SELECT valor FROM tabelas AS dentro where dentro.administradora_id = fora.administradora_id AND dentro.plano_id = fora.plano_id AND dentro.tabela_origens_id = fora.tabela_origens_id AND acomodacao_id = 2 AND dentro.faixa_etaria_id = fora.faixa_etaria_id AND dentro.coparticipacao = 1 AND dentro.odonto = fora.odonto GROUP BY dentro.coparticipacao) AS enfermaria_com_coparticipacao,
                    (SELECT valor * quantidade FROM tabelas AS dentro where dentro.administradora_id = fora.administradora_id AND dentro.plano_id = fora.plano_id AND dentro.tabela_origens_id = fora.tabela_origens_id AND acomodacao_id = 2 AND dentro.faixa_etaria_id = fora.faixa_etaria_id AND dentro.coparticipacao = 1 AND dentro.odonto = fora.odonto GROUP BY dentro.coparticipacao) AS enfermaria_com_coparticipacao_total,
                    
                    (SELECT valor FROM tabelas AS dentro where dentro.administradora_id = fora.administradora_id AND dentro.plano_id = fora.plano_id AND dentro.tabela_origens_id = fora.tabela_origens_id AND acomodacao_id = 1 AND dentro.faixa_etaria_id = fora.faixa_etaria_id AND dentro.coparticipacao = 0 AND dentro.odonto = fora.odonto GROUP BY dentro.coparticipacao) AS apartamento_sem_coparticipacao,
                    (SELECT valor * quantidade FROM tabelas AS dentro where dentro.administradora_id = fora.administradora_id AND dentro.plano_id = fora.plano_id AND dentro.tabela_origens_id = fora.tabela_origens_id AND acomodacao_id = 1 AND dentro.faixa_etaria_id = fora.faixa_etaria_id AND dentro.coparticipacao = 0 AND dentro.odonto = fora.odonto GROUP BY dentro.coparticipacao) AS apartamento_sem_coparticipacao_total,
                                                      
                    (SELECT valor FROM tabelas AS dentro where dentro.administradora_id = fora.administradora_id AND dentro.plano_id = fora.plano_id AND dentro.tabela_origens_id = fora.tabela_origens_id AND acomodacao_id = 2 AND dentro.faixa_etaria_id = fora.faixa_etaria_id AND dentro.coparticipacao = 0 AND dentro.odonto = fora.odonto GROUP BY dentro.coparticipacao) AS enfermaria_sem_coparticipacao,
                    (SELECT valor * quantidade FROM tabelas AS dentro where dentro.administradora_id = fora.administradora_id AND dentro.plano_id = fora.plano_id AND dentro.tabela_origens_id = fora.tabela_origens_id AND acomodacao_id = 2 AND dentro.faixa_etaria_id = fora.faixa_etaria_id AND dentro.coparticipacao = 0 AND dentro.odonto = fora.odonto GROUP BY dentro.coparticipacao) AS enfermaria_sem_coparticipacao_total
     from tabelas AS fora 
     WHERE fora.faixa_etaria_id IN($chaves) AND tabela_origens_id =  $cidade 
     GROUP BY faixa_etaria_id,administradora_id,plano_id,tabela_origens_id,odonto ORDER BY id
                    ) 
AS full_tabela");

        return view('admin.pages.orcamento.montarPlanos',[
            "planos" => $dados,
            'card_inicial' => $dados[0]->card
        ]);    
        



        

    }


}
