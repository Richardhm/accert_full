<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use App\Models\Administradoras;
use Illuminate\Http\Request;

use PDF;

use App\Models\FaixaEtaria;
use App\Models\TabelaOrigens;
use App\Models\Corretora;
use App\Models\User;
use Illuminate\Support\Str;

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

    public function criarPDF(Request $request)
    {

        

        
        $odonto = $request->odonto == "Com Odonto" ? 1 : 0;
        $cidade = $request->tabela_origem;
        $administradora = $request->administradora_id;
        $plano_id = $request->plano_id;

        $plano = "";
        $plano_nome = "";
        $administradora_search = Administradoras::find($administradora);
        
        // if($administradora_search->nome == "Hapvida" || $administradora_search->nome == "hapvida") {
        //     $plano = "Indidivual";
        // } else {
        //     $plano = "Coletivo";
        // }

        if($plano_id == 1) {
            $plano = "Individual";
            $plano_nome = "individual";
        } else if($plano_id == 2) {
            $plano = "Corpore";
            $plano_nome = "corpore";
        } else if($plano_id == 3) {
            $plano = "Coletivo por Adesão";
            $plano_nome = "coletivo";
        } else if($plano_id == 4) {
            $plano = "PME";
            $plano_nome = "pme";
        } else if($plano_id == 5) {
            $plano = "Super Simples";
            $plano_nome = "Super Simples";
        } else if($plano_id == 6) {
            $plano = "Sindicato - Sindipão";
            $plano_nome = "Sindicato";
        } else {
            $plano = "";
        }




        $sql = "";
        $chaves = [];
        foreach($request->faixas[0] as $k => $v) {
            if($v != null) {
                $sql .= "WHEN (SELECT id FROM faixa_etarias WHERE faixa_etarias.id = fora.faixa_etaria_id) = $k THEN $v ";
                $chaves[] = $k; 
            }
        }
        $chaves = implode(",",$chaves);

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
     WHERE fora.faixa_etaria_id IN($chaves) AND tabela_origens_id =  $cidade AND administradora_id = $administradora AND odonto = $odonto AND plano_id = $plano_id
     GROUP BY faixa_etaria_id,administradora_id,plano_id,tabela_origens_id,odonto ORDER BY id
                    ) 
AS full_tabela");
            
        $pdf = Corretora::first();
        $site = $pdf->site;
        $endereco = $pdf->endereco;

        $icone_site_oficial = 'data:image/png;base64,'.base64_encode(file_get_contents(public_path("storage/01.png")));
        $icone_boleto = 'data:image/png;base64,'.base64_encode(file_get_contents(public_path("storage/02.png")));
        $icone_marcar_consulta = 'data:image/png;base64,'.base64_encode(file_get_contents(public_path("storage/03.png")));
        $icone_rede_atendimento = 'data:image/png;base64,'.base64_encode(file_get_contents(public_path("storage/04.png")));
        $icone_clinica = 'data:image/png;base64,'.base64_encode(file_get_contents(public_path("storage/05.png")));
        $icone_hospital = 'data:image/png;base64,'.base64_encode(file_get_contents(public_path("storage/06.png")));
        $icone_lupa = 'data:image/png;base64,'.base64_encode(file_get_contents(public_path("storage/07.png")));
        $icone_endereco = 'data:image/png;base64,'.base64_encode(file_get_contents(public_path("storage/08.png")));
        $icone_zap_footer = 'data:image/png;base64,'.base64_encode(file_get_contents(public_path("storage/telefone-consultar.png")));
        // $logo = 'data:image/png;base64,'.base64_encode(file_get_contents(public_path("storage/logo.png")));
        $logo = 'data:image/png;base64,'.base64_encode(file_get_contents(public_path("storage/".$pdf->logo)));

        $cidade_nome = TabelaOrigens::find($cidade)->nome;
            
        $img = $pdf->logo;

        $linha01 = "";
        $linha02 = "";
        $linha03 = "";

        $consultas_eletivas = 0;
        $consultas_de_urgencia = 0;
        $exames_simples = 0;
        $exames_complexos = 0;    
        $terapias = 0;    



        if($administradora_search->nome == "Hapvida" || $administradora_search->nome == "hapvida" || $administradora_search->nome == "PME" || $administradora_search->nome == "Super Simples" || $administradora_search->nome == "Sindicato - Sindipão") {
            
            $linha01 = $pdf->linha_01_individual;
            $linha02 = $pdf->linha_02_individual;
            $linha03 = $pdf->linha_03_individual;

            $consultas_eletivas     = $pdf->consultas_eletivas_individual;
            $consultas_de_urgencia  = $pdf->consultas_urgencia_individual;
            $exames_simples         = $pdf->exames_simples_individual;
            $exames_complexos       = $pdf->exames_complexos_individual;
            $terapias               = $pdf->terapias_individual;

            
            
            $nome_pdf = "orcamento ".$administradora_search->nome." ".$plano_nome."_".date('d/m/Y')."_".date('H:i').".pdf";

        } else {
            $linha01 = $pdf->linha_01_coletivo;
            $linha02 = $pdf->linha_02_coletivo;
            $linha03 = $pdf->linha_03_coletivo;

            $consultas_eletivas = $pdf->consultas_eletivas_coletivo;
            $consultas_de_urgencia = $pdf->consultas_urgencia_coletivo;
            $exames_simples = $pdf->exames_simples_coletivo;
            $exames_complexos = $pdf->exames_complexos_coletivo;
            $terapias               = $pdf->terapias_coletivo;

            $nome_pdf = "orcamento ".$administradora_search->nome." ".$plano_nome."_".date('d/m/Y')."_".date('H:i').".pdf";

        }

        $user = User::find(auth()->user()->id);
       
       if($user) {
                       
            $nome = $user->name;
            
            if($user->celular) {
                $telefone_user = $user->celular;
                $telefone_whattsap = str_replace([" ","(",")","-"],"",$user->celular);
            } else {
                $telefone_user = $pdf->celular;
                $telefone_whattsap = "";
            }

            if($user->image) {
                $image_user = 'data:image/png;base64,'.base64_encode(file_get_contents(public_path("storage/".$user->image)));
            } else {
                $image_user = null;
            }

       }
        
       
       if(auth()->user()->name == "Felipe Barros") {
            $frase_consultor = "Supervisor Comercial";
       } else {
            $frase_consultor = "Consultor de Vendas";
       }




        $pdf = PDF::loadView('admin.pages.orcamento.pdf',[
            "frase_consultor" => $frase_consultor,
            "planos" => $dados,
            "nome" => $nome,
            "administradoras" => $administradora,
            "telefone" => $telefone_user,
            "telefone_whattsap" => $telefone_whattsap,
            "image"=>$image_user,
            "plano" => $plano,
            "icone_site_oficial"=>$icone_site_oficial,
            "icone_boleto"=>$icone_boleto,
            "icone_marcar_consulta" => $icone_marcar_consulta,
            "icone_rede_atendimento" => $icone_rede_atendimento,
            "icone_clinica" => $icone_clinica,
            "icone_hospital" => $icone_hospital,
            "icone_lupa" => $icone_lupa,
            "icone_endereco" => $icone_endereco,
            "icone_zap_footer" => $icone_zap_footer,
            "logo" => $logo,
            "nome_cidade" => $cidade_nome,
            "consultas_eletivas" => $consultas_eletivas,
            "consultas_de_urgencia" => $consultas_de_urgencia,
            "exames_simples" => $exames_simples,
            "exames_complexos" => $exames_complexos,
            "linha01" => $linha01,
            "linha02" => $linha02,
            "linha03" => $linha03,
            "site" => $site,
            "endereco" => $endereco,
            "terapias" => $terapias
        ]);
       
        return $pdf->download(Str::kebab($nome_pdf));
    }




    public function montarOrcamento(Request $request)
    {
        if(count(array_filter($request->faixas[0])) >= 7) {
            return "error_pdf";
        }




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
            nome,id_faixas,admin_logo,cidade,admin_id,plano,plano_id,titulos,card,admin_nome,quantidade,apartamento_com_coparticipacao,apartamento_com_coparticipacao_total,
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
                    (SELECT id FROM planos as pp WHERE pp.id = fora.plano_id) AS plano_id,
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
            'card_inicial' => count($dados) >= 1 ? $dados[0]->card : ""
        ]);    
        



        

    }


}
