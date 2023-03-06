<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{
    Contrato,Cliente,TabelaOrigens,Administradoras,Planos,Acomodacao,CotacaoFaixaEtaria,User,PlanoEmpresarial,ContratoEmpresarial,  
    Comissoes,ComissoesCorretoresLancadas,ComissoesCorretoraConfiguracoes,ComissoesCorretoraLancadas,ComissoesCorretoresConfiguracoes,
    Dependentes,Cancelado,MotivoCancelados,
    Premiacoes,PremiacoesCorretoraLancadas,PremiacoesCorretoresLancadas,PremiacoesCorretoraConfiguracoes,PremiacoesCorretoresConfiguracoes,
};
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class GerenteController extends Controller
{
    public function index()
    {
        // $contrato = Contrato::where("id",203)
        // ->with(['administradora','financeiro','cidade','comissao','acomodacao','plano','somarCotacaoFaixaEtaria','clientes','clientes.user','clientes.dependentes','comissao.comissoesAprovadasFinanceira','comissao.comissoesLancadas','comissao.comissaoAtual','comissao.comissoesLancadasCorretora'])
        // ->first();
        
        $users = DB::select(
            "SELECT id,name,
            (SELECT if(SUM(valor)>0,SUM(valor),0) FROM comissoes_corretores_lancadas WHERE status_financeiro = 1 AND status_gerente = 1 
            AND MONTH(DATA) = MONTH(NOW()) AND comissoes_id 
      IN(SELECT id FROM comissoes WHERE user_id = users.id AND comissoes.administradora_id = 1)) AS valor_allcare,
      (SELECT if(SUM(valor)>0,SUM(valor),0) FROM comissoes_corretores_lancadas WHERE status_financeiro = 1 AND status_gerente = 1 
            AND MONTH(DATA) = MONTH(NOW()) AND comissoes_id 
      IN(SELECT id FROM comissoes WHERE user_id = users.id AND comissoes.administradora_id = 2)) AS valor_alter,
            (SELECT if(SUM(valor)>0,SUM(valor),0) FROM comissoes_corretores_lancadas WHERE status_financeiro = 1 AND status_gerente = 1 
            AND MONTH(DATA) = MONTH(NOW()) AND comissoes_id 
      IN(SELECT id FROM comissoes WHERE user_id = users.id AND comissoes.administradora_id = 3)) AS valor_qualicorp,
            (SELECT if(SUM(valor)>0,SUM(valor),0) FROM comissoes_corretores_lancadas WHERE status_financeiro = 1 AND status_gerente = 1 
            AND MONTH(DATA) = MONTH(NOW()) AND comissoes_id 
      IN(SELECT id FROM comissoes WHERE user_id = users.id AND comissoes.administradora_id = 4)) AS valor_hapvida,
          (SELECT if(SUM(valor)>0,SUM(valor),0) FROM comissoes_corretores_lancadas WHERE status_financeiro = 1 AND status_gerente = 1 
            AND MONTH(DATA) = MONTH(NOW()) AND comissoes_id 
      IN(SELECT id FROM comissoes WHERE user_id = users.id)) AS valor,

      (SELECT if(COUNT(*)>0,0,users.id) FROM comissoes_corretores_lancadas WHERE status_financeiro = 1 AND status_gerente = 1 AND status_comissao = 1
		AND MONTH(DATA) = MONTH(NOW()) AND comissoes_id 
  IN(SELECT id FROM comissoes WHERE user_id = users.id)) AS status



    FROM users WHERE cargo_id IS NOT NULL"
        );

        $quat_comissao_a_receber = ComissoesCorretoraLancadas::where("status_financeiro",1)->where("status_gerente",0)->count();
        $quat_comissao_recebido = ComissoesCorretoraLancadas::where("status_financeiro",1)->where("status_gerente",1)->count();

        $valor_quat_comissao_a_receber = ComissoesCorretoraLancadas
            ::selectRaw("sum(valor) as total")
            ->where("status_financeiro",1)
            ->where("status_gerente",0)->first()->total;

        $valor_quat_comissao_recebido = ComissoesCorretoresLancadas
            ::selectRaw("sum(valor) as total")
            ->where("status_financeiro",1)
            ->where("status_gerente",1)->first()->total;
        
        //$datas_select = DB::select("SELECT data_baixa_gerente FROM comissoes_corretora_lancadas WHERE status_financeiro = 1 AND status_gerente = 1 GROUP BY MONTH(data_baixa_gerente)");
        
        $datas_select = DB::select("SELECT data_baixa_gerente FROM comissoes_corretora_lancadas WHERE status_financeiro = 1 AND status_gerente = 1 GROUP BY MONTH(data_baixa_gerente)");

        $total_mes_comissoes = DB::select(
            "SELECT SUM(valor) AS total FROM comissoes_corretores_lancadas WHERE status_financeiro = 1 AND status_gerente = 1 AND MONTH(DATA) = MONTH(NOW())"
        );

        $administradoras_mes = DB::select(
            "SELECT 
            SUM(valor) AS total,
            (SELECT nome FROM administradoras WHERE id = comissoes.administradora_id) AS administradora
            FROM comissoes_corretores_lancadas 
            INNER JOIN comissoes ON comissoes.id = comissoes_id
            WHERE comissoes_corretores_lancadas.status_financeiro = 1 AND comissoes_corretores_lancadas.status_gerente = 1 
            AND MONTH(comissoes_corretores_lancadas.data) = MONTH(NOW())
            GROUP BY comissoes.administradora_id"

        );

        
        
        
        

        

        // <option value="{{date('Y-m',strtotime($d->data_baixa_gerente))}}">{{date('m/Y',strtotime($d->data_baixa_gerente))}}</option> 



        // $dados = Cliente::with(['contrato','contrato.comissao','contrato.administradora','user','contrato.cidade','','contrato.financeiro','contrato.plano'])
        // ->whereHas('contrato.comissao.comissoesLancadas',function($query){
        //     $query->where("status_financeiro",1);
        //     $query->where("status_gerente",1);
        // })->get();

        // $dados = Cliente::with([
        //         'contrato',
        //         'contrato.comissao',
        //         'contrato.administradora',
        //         'user',
        //         'contrato.cidade',
        //         'contrato.financeiro',
        //         'contrato.plano',
        //         'contrato.comissao.comissaoAtual'
        //         ])
        //         ->whereHas('contrato.comissao.comissoesLancadas',function($query){
        //             $query->where("status_financeiro",1);
        //             $query->where("status_gerente",1);
        //         })
            
        
        
        //     ->toSql();
        // dd($dados);     


        //dd($dados);     


        // $dados = DB::select(
        //     "
        //     SELECT
		//     (SELECT nome FROM administradoras WHERE id = (SELECT administradora_id FROM contratos WHERE contratos.cliente_id = clientes.id)) AS administradora,
	    //     (SELECT NAME FROM users WHERE users.id = clientes.user_id) AS corretor,
	    //     (SELECT nome FROM planos WHERE id = (SELECT plano_id FROM contratos WHERE contratos.plano_id = planos.id)) AS plano,
	    //     (SELECT nome FROM tabela_origens WHERE id = (SELECT tabela_origens_id FROM contratos WHERE contratos.tabela_origens_id = tabela_origens.id)) AS tabela_origens,
	    //     nome,
	    //     (SELECT codigo_externo FROM contratos WHERE contratos.cliente_id = clientes.id) AS codigo_externo,
	    //     (
	    //         select COUNT(*) from `comissoes_corretores_lancadas` where `comissoes_corretores_lancadas`.`comissoes_id` =  
	    //         (SELECT id FROM comissoes WHERE contrato_id = (SELECT id FROM contratos WHERE contratos.cliente_id = clientes.id))
	    //         and `status_financeiro` = 1 and `status_gerente` = 1
	    //     ) AS quantidade
        //     from `clientes` 
        //     where exists (select * from `contratos` where `clientes`.`id` = `contratos`.`cliente_id` AND 
        //     exists (select * from `comissoes` where `contratos`.`id` = `comissoes`.`contrato_id` AND 
        //     exists (select * from `comissoes_corretores_lancadas` where `comissoes`.`id` = `comissoes_corretores_lancadas`.`comissoes_id` and `status_financeiro` = 1 and `status_gerente` = 1)))"
        //     );

        // dd($dados);    

        // $dados = Cliente::with(['contrato','contrato.comissao','contrato.administradora','user','contrato.cidade','contrato.financeiro','contrato.plano'])
        // ->whereHas('contrato.comissao.comissoesLancadas',function($query){
        //     $query->where("status_financeiro",1);
        //     $query->where("status_gerente",1);
        // })->get();

        // dd($dados);

        // $dados = Cliente::with(['contrato','contrato.comissao','contrato.administradora','user','contrato.cidade','contrato.financeiro','contrato.comissao.comissaoAtual','contrato.plano'])
        // ->whereHas('contrato.comissao.comissoesLancadas',function($query){
        //     $query->where("status_financeiro",1);
        //     $query->where("status_gerente",0);
        // })->get();
        // dd($dados); 
        return view('admin.pages.gerente.index',[
            "quat_comissao_a_receber" => $quat_comissao_a_receber,
            "quat_comissao_recebido" => $quat_comissao_recebido,
            "valor_quat_comissao_a_receber" => $valor_quat_comissao_a_receber,
            "valor_quat_comissao_recebido" => $valor_quat_comissao_recebido,
            "datas_select" => $datas_select,
            "total_mes_comissao" => $total_mes_comissoes[0]->total,
            "administradoras_mes" => $administradoras_mes

        ]);
    }

    public function listagem()
    {
        // $dados = Cliente::with(['contrato','contrato.comissao','contrato.administradora','user','contrato.cidade','contrato.financeiro','contrato.comissao.comissaoAtual','contrato.plano'])
        // ->whereHas('contrato.comissao.comissoesLancadas',function($query){
        //     $query->where("status_financeiro",1);
        //     $query->where("status_gerente",0);
        // })->get();

        $dados = DB::select(
            "
            SELECT
            (SELECT nome FROM administradoras WHERE id = (SELECT administradora_id FROM contratos WHERE contratos.cliente_id = clientes.id)) AS administradora,
            (SELECT NAME FROM users WHERE users.id = clientes.user_id) AS corretor,
            (SELECT nome FROM planos WHERE id = (SELECT plano_id FROM contratos WHERE contratos.cliente_id = clientes.id)) AS plano,
            (SELECT nome FROM tabela_origens WHERE id = (SELECT tabela_origens_id FROM contratos WHERE contratos.cliente_id = clientes.id)) AS tabela_origens,
            nome,
            (SELECT codigo_externo FROM contratos WHERE contratos.cliente_id = clientes.id) AS codigo_externo,
            (
              select valor from `comissoes_corretora_lancadas` where `comissoes_corretora_lancadas`.`comissoes_id` =  
              (SELECT id FROM comissoes WHERE contrato_id = (SELECT id FROM contratos WHERE contratos.cliente_id = clientes.id))
              and `status_financeiro` = 1 and `status_gerente` = 0
            ) AS valor,
            (
              select data_baixa from `comissoes_corretora_lancadas` where `comissoes_corretora_lancadas`.`comissoes_id` =  
              (SELECT id FROM comissoes WHERE contrato_id = (SELECT id FROM contratos WHERE contratos.cliente_id = clientes.id))
              and `status_financeiro` = 1 and `status_gerente` = 0
            ) AS data_baixa,
            (
              select parcela from `comissoes_corretores_lancadas` where `comissoes_corretores_lancadas`.`comissoes_id` =  
              (SELECT id FROM comissoes WHERE contrato_id = (SELECT id FROM contratos WHERE contratos.cliente_id = clientes.id))
              and `status_financeiro` = 1 and `status_gerente` = 0
            ) AS parcela,
            (
                select data from `comissoes_corretores_lancadas` where `comissoes_corretores_lancadas`.`comissoes_id` =  
                (SELECT id FROM comissoes WHERE contrato_id = (SELECT id FROM contratos WHERE contratos.cliente_id = clientes.id))
                and `status_financeiro` = 1 and `status_gerente` = 0
             ) AS vencimento,
            (SELECT id FROM contratos WHERE contratos.cliente_id = clientes.id) AS contrato_id
                from `clientes` 
                where exists (select * from `contratos` where `clientes`.`id` = `contratos`.`cliente_id` AND 
                exists (select * from `comissoes` where `contratos`.`id` = `comissoes`.`contrato_id` AND 
                exists (select * from `comissoes_corretores_lancadas` where `comissoes`.`id` = `comissoes_corretores_lancadas`.`comissoes_id` and `status_financeiro` = 1 and `status_gerente` = 0)))");
            
        return $dados;     
    }

    public function listarComissao($id)
    {
       $user = User::find($id);


       $comissao_valor = DB::select(
            "SELECT 
            SUM(valor) as total
            FROM comissoes_corretores_lancadas 
            INNER JOIN comissoes ON comissoes.id = comissoes_corretores_lancadas.comissoes_id
        
            WHERE comissoes_corretores_lancadas.status_financeiro = 1 AND 
            comissoes_corretores_lancadas.status_gerente = 1 AND 
            MONTH(comissoes_corretores_lancadas.data) = MONTH(NOW()) AND
            comissoes.user_id = $id"
       );

       
       
        // $dados = DB::select("
        //     SELECT 
        //     comissoes_id,
        //     (SELECT administradora_id FROM comissoes WHERE comissoes.id = comissoes_corretores_lancadas.comissoes_id) AS administradora,
        //     (SELECT nome FROM administradoras WHERE administradoras.id = (SELECT administradora_id FROM comissoes WHERE comissoes.id = comissoes_corretores_lancadas.comissoes_id)) AS nome_administradora,
        //     parcela,data,valor
        
        //     FROM comissoes_corretores_lancadas
        //     WHERE status_financeiro = 1 AND status_gerente = 1 ORDER BY nome_administradora,parcela
        // ");

        // $inicial = $dados[0]->nome_administradora;

       


        
        return view('admin.pages.gerente.comissao',[
            "usuario" => $user->name,
            "id" => $user->id,
            "total_comissao" => $comissao_valor[0]->total
        ]);
        
        
        
    }


    public function comissaoMesAtual(Request $request)
    {
        $id = $request->id;
        

        $dados = DB::select("
            SELECT 
            comissoes_corretores_lancadas.id,
            comissoes_corretores_lancadas.comissoes_id,
            DATE_FORMAT(comissoes_corretores_lancadas.data,'%d/%m/%Y') AS data,
            comissoes_corretores_lancadas.valor,
            DATE_FORMAT(comissoes_corretores_lancadas.data_baixa_gerente,'%d/%m/%Y') AS data_baixa_gerente,
            (SELECT nome FROM clientes WHERE id = ((SELECT cliente_id FROM contratos WHERE contratos.id = comissoes.contrato_id))) AS cliente,
            (SELECT nome FROM administradoras WHERE administradoras.id = comissoes.administradora_id) AS administradora,
            CONCAT(UPPER(SUBSTR(MONTHNAME(comissoes_corretores_lancadas.data),1,1)),LOWER(SUBSTR(MONTHNAME(comissoes_corretores_lancadas.data),2))) AS mes_atual
            FROM comissoes_corretores_lancadas 
            INNER JOIN comissoes ON comissoes.id = comissoes_corretores_lancadas.comissoes_id
            WHERE comissoes_corretores_lancadas.status_financeiro = 1 AND 
            comissoes_corretores_lancadas.status_gerente = 1 AND 
            MONTH(comissoes_corretores_lancadas.data) = MONTH(NOW()) AND
            comissoes.user_id = {$id}
            ORDER BY comissoes.administradora_id
        ");

        return $dados;
    }

    public function comissaoMesDiferente(Request $request)
    {
        $id = $request->id;

        $dados = DB::select("
                SELECT 
                comissoes_corretores_lancadas.id,
                comissoes_corretores_lancadas.comissoes_id,
                DATE_FORMAT(comissoes_corretores_lancadas.data,'%d/%m/%Y') AS data, 
                comissoes_corretores_lancadas.valor,
                DATE_FORMAT(comissoes_corretores_lancadas.data_baixa_gerente,'%d/%m/%Y') AS data_baixa_gerente,
                (SELECT nome FROM clientes WHERE id = ((SELECT cliente_id FROM contratos WHERE contratos.id = comissoes.contrato_id))) AS cliente,
                (SELECT nome FROM administradoras WHERE administradoras.id = comissoes.administradora_id) AS administradora,
                CONCAT(UPPER(SUBSTR(MONTHNAME(comissoes_corretores_lancadas.data),1,1)),LOWER(SUBSTR(MONTHNAME(comissoes_corretores_lancadas.data),2))) AS mes_atual
                FROM comissoes_corretores_lancadas 
                INNER JOIN comissoes ON comissoes.id = comissoes_corretores_lancadas.comissoes_id
                WHERE comissoes_corretores_lancadas.status_financeiro = 1 AND 
                comissoes_corretores_lancadas.status_gerente = 1 AND 
                MONTH(comissoes_corretores_lancadas.data) != MONTH(NOW()) AND
                comissoes.user_id = {$id}
                ORDER BY comissoes.administradora_id
        ");

        return $dados;

    }








    public function listagemRecebido()
    {
        $dados = DB::select(
            "
            SELECT
            (SELECT nome FROM administradoras WHERE id = (SELECT administradora_id FROM comissoes WHERE comissoes_corretores_lancadas.comissoes_id = comissoes.id)) AS administradora,
            (SELECT NAME FROM users WHERE id = (SELECT user_id FROM comissoes WHERE comissoes_corretores_lancadas.comissoes_id = comissoes.id)) AS corretor,
            (SELECT nome FROM planos WHERE id = (SELECT plano_id FROM contratos WHERE id = (SELECT contrato_id FROM comissoes WHERE comissoes_corretores_lancadas.comissoes_id = comissoes.id))) AS plano,
            (SELECT nome FROM tabela_origens WHERE id = (SELECT tabela_origens_id FROM contratos WHERE id = (SELECT contrato_id FROM comissoes WHERE comissoes_corretores_lancadas.comissoes_id = comissoes.id))) AS tabela_origens,
            (SELECT nome FROM clientes WHERE id = (SELECT cliente_id FROM contratos WHERE id = (SELECT contrato_id FROM comissoes WHERE comissoes_corretores_lancadas.comissoes_id = comissoes.id))) AS nome,
            (SELECT codigo_externo FROM contratos WHERE id = (SELECT contrato_id FROM comissoes WHERE comissoes_corretores_lancadas.comissoes_id = comissoes.id)) AS codigo_externo,
            valor,
            parcela,
            data_baixa_gerente as data_baixa,
            DATA AS vencimento,
            (SELECT id FROM contratos WHERE id = (SELECT contrato_id FROM comissoes WHERE comissoes_corretores_lancadas.comissoes_id = comissoes.id)) AS contrato_id
            from `comissoes_corretores_lancadas`
            WHERE status_financeiro = 1 AND status_gerente = 1
            "
            );
            
        return $dados;     
    }



    // public function comissao()
    // {
    //     $dados = DB::select(
    //         "
    //         SELECT
	// 	    (SELECT nome FROM administradoras WHERE id = (SELECT administradora_id FROM contratos WHERE contratos.cliente_id = clientes.id)) AS administradora,
    //         (SELECT NAME FROM users WHERE users.id = clientes.user_id) AS corretor,
    //         (SELECT nome FROM planos WHERE id = (SELECT plano_id FROM contratos WHERE contratos.cliente_id = clientes.id)) AS plano,
    //         (SELECT nome FROM tabela_origens WHERE id = (SELECT tabela_origens_id FROM contratos WHERE contratos.cliente_id = clientes.id)) AS tabela_origens,
    //         nome,
    //         (SELECT codigo_externo FROM contratos WHERE contratos.cliente_id = clientes.id) AS codigo_externo,
    //         (
    //         select COUNT(*) from `comissoes_corretores_lancadas` where `comissoes_corretores_lancadas`.`comissoes_id` =  
    //         (SELECT id FROM comissoes WHERE contrato_id = (SELECT id FROM contratos WHERE contratos.cliente_id = clientes.id))
    //         and `status_financeiro` = 1 and `status_gerente` = 1
    //         ) AS quantidade,
    //         (SELECT id FROM comissoes WHERE contrato_id = (SELECT id FROM contratos WHERE contratos.cliente_id = clientes.id)) AS comissao
    //         from `clientes` 
    //         where exists (select * from `contratos` where `clientes`.`id` = `contratos`.`cliente_id` AND 
    //         exists (select * from `comissoes` where `contratos`.`id` = `comissoes`.`contrato_id` AND 
    //         exists (select * from `comissoes_corretores_lancadas` where `comissoes`.`id` = `comissoes_corretores_lancadas`.`comissoes_id` and `status_financeiro` = 1 and `status_gerente` = 1)))"
    //         );
    //     return $dados;     
    // }

    public function detalhe($id) 
    {
        // $contrato = Contrato::where("id",$id)
        // ->with(['administradora','financeiro','cidade','comissao','acomodacao','plano','somarCotacaoFaixaEtaria','clientes','clientes.user','clientes.dependentes','comissao.comissoesAprovadasFinanceira','comissao.comissoesLancadas','comissao.comissaoAtual','comissao.comissoesLancadasCorretora','comissao.comissoesLancadas'])
        // ->first();

        $contrato = Contrato::where("id",$id)
        ->with(['administradora','financeiro','cidade','comissao','acomodacao','plano','somarCotacaoFaixaEtaria','clientes','clientes.user','clientes.dependentes','comissao.comissoesAprovadasFinanceira','comissao.comissoesLancadas','comissao.comissaoAtual','comissao.comissoesLancadasCorretora'])
        ->first();

        $comissao_id = Comissoes::where("contrato_id",$contrato->id)->first()->id;
       

        $total_corretora_pago = DB::select(
            "SELECT SUM(valor) as total FROM comissoes_corretora_lancadas WHERE status_gerente = 1 AND comissoes_id = {$comissao_id}"
        );

        $total_corretora_nao_paga = DB::select(
            "SELECT  SUM(valor) as total FROM comissoes_corretora_lancadas WHERE status_gerente = 0 AND comissoes_id = {$comissao_id}"
        );

        $total_corretores_pago = DB::select(
            "SELECT SUM(valor) as total FROM comissoes_corretores_lancadas WHERE  status_financeiro = 1 AND comissoes_id = {$comissao_id}"
        );

        $total_corretores_nao_paga = DB::select(
            "SELECT SUM(valor) as total FROM comissoes_corretores_lancadas WHERE  status_financeiro = 0 AND comissoes_id = {$comissao_id}"
        );
        

        if(isset($contrato->acomodacao->nome) && !empty($contrato->acomodacao->nome)) {
            if($contrato->acomodacao->nome == "Apartamento" && $contrato->coparticipacao == 1 && $contrato->odonto == 1) {
                $texto = "Apartamento C/Copart + Odonto";
            } else if($contrato->acomodacao->nome == "Apartamento" && $contrato->coparticipacao == 1 && $contrato->odonto == 0) {
                $texto = "Apartamento C/Copart Sem Odonto";
            } else if($contrato->acomodacao->nome == "Apartamento" && $contrato->coparticipacao == 0 && $contrato->odonto == 0) {
                $texto = "Apartamento S/Copart Sem Odonto";
            } else if($contrato->acomodacao->nome == "Enfermaria" && $contrato->coparticipacao == 1 && $contrato->odonto == 1) {
                $texto = "Enfermaria C/Copart + Odonto";    
            } else if($contrato->acomodacao->nome == "Enfermaria" && $contrato->coparticipacao == 1 && $contrato->odonto == 0) {
                $texto = "Enfermaria C/Copart Sem Odonto";    
            } else if($contrato->acomodacao->nome == "Enfermaria" && $contrato->coparticipacao == 0 && $contrato->odonto == 0) {
                $texto = "Apartamento S/Copart Sem Odonto";    
            } else {
                $texto = "";
            } 
        } else {
            $texto = "";
        }

        
        
        //dd($contrato);
        
        return view('admin.pages.gerente.detalhe',[
            "contrato" => $contrato,
            "texto" => $texto,
            "plano" => $contrato->plano_id,
            "total_corretora_pago" => $total_corretora_pago[0]->total,
            "total_corretora_nao_pago" => $total_corretora_nao_paga[0]->total,
            "total_corretores_pago" => $total_corretores_pago[0]->total,
            "total_corretores_nao_paga" => $total_corretores_nao_paga[0]->total
        ]);
        
    }


    public function mudarStatus(Request $request) {
        $contrato = Contrato::find($request->id);
        $comissao_id = Comissoes::where("contrato_id",$contrato->id)->first()->id;

        if($contrato->plano_id == 3) {

            switch($contrato->financeiro_id) {

                case 3: 
                    $contrato->financeiro_id = 4;
                    $contrato->save();
                    
                    $comissaoCorretor = ComissoesCorretoresLancadas
                        ::where("comissoes_id",$comissao_id)
                        ->where("parcela",1)            
                        ->first();
                    if($comissaoCorretor) {                    
                        $comissaoCorretor->status_gerente = 1;
                        $comissaoCorretor->data_baixa_gerente = $request->data_baixa; 
                        $comissaoCorretor->save();
                    }

                    $comissaoCorretora = ComissoesCorretoraLancadas
                        ::where('comissoes_id',$comissao_id)
                        ->where('parcela',1)
                        ->first();
                    if(isset($comissaoCorretora) && $comissaoCorretora) {
                        $comissaoCorretora->status_gerente = 1;
                        $comissaoCorretora->data_baixa_gerente = $request->data_baixa;
                        $comissaoCorretora->save();
                    } 
                break;

                case 4:
                    $contrato->financeiro_id = 6;
                    $contrato->save();
                    
                    $comissao = ComissoesCorretoresLancadas
                        ::where("comissoes_id",$comissao_id)
                        ->where("parcela",2)            
                        ->first();
                    if($comissao) {
                        $comissao->status_gerente = 1;
                        $comissao->data_baixa_gerente = $request->data_baixa;
                        $comissao->save();  
                    }
    
                    $comissaoCorretora = ComissoesCorretoraLancadas
                        ::where('comissoes_id',$comissao_id)
                        ->where('parcela',2)
                        ->first();
                    if(isset($comissaoCorretora) && $comissaoCorretora) {
                        $comissaoCorretora->status_gerente = 1;
                        $comissaoCorretora->data_baixa_gerente = $request->data_baixa;
                        $comissaoCorretora->save();
                    } 
        
                break;    

                case 6:
                    $contrato->financeiro_id = 7;
                    $contrato->save();
                    //$contrato->data_baixa = $request->data_baixa;
                    $comissao = ComissoesCorretoresLancadas
                        ::where("comissoes_id",$comissao_id)
                        ->where("parcela",3)            
                        ->first();
                    if($comissao) {
                        $comissao->status_gerente = 1;
                        $comissao->data_baixa_gerente = $request->data_baixa;
                        $comissao->save();   
                    }
    
                    $comissaoCorretora = ComissoesCorretoraLancadas
                        ::where('comissoes_id',$comissao_id)
                        ->where('parcela',3)
                        ->first();
                    if(isset($comissaoCorretora) && $comissaoCorretora) {
                        $comissaoCorretora->status_gerente = 1;
                        $comissaoCorretora->data_baixa_gerente = $request->data_baixa;
                        $comissaoCorretora->save();
                    } 
        
                break;   
                
                case 7:
                    $contrato->financeiro_id = 8;
                    $contrato->save();
                    //$contrato->data_baixa = $request->data_baixa;
                    $comissao = ComissoesCorretoresLancadas
                        ::where("comissoes_id",$comissao_id)
                        ->where("parcela",4)            
                        ->first();               
                    if($comissao) {
                        $comissao->status_gerente = 1;
                        $comissao->data_baixa_gerente = $request->data_baixa;
                        $comissao->save();   
                    }
                    
                    $comissaoCorretora = ComissoesCorretoraLancadas
                        ::where('comissoes_id',$comissao_id)
                        ->where('parcela',4)
                        ->first();
                    if(isset($comissaoCorretora) && $comissaoCorretora) {
                        $comissaoCorretora->status_gerente = 1;
                        $comissaoCorretora->data_baixa_gerente = $request->data_baixa;
                        $comissaoCorretora->save();
                    }     
    
                break;    
            
                case 8:
                    $contrato->financeiro_id = 9;
                    $contrato->save();
                    //$contrato->data_baixa = $request->data_baixa;
                    $comissao = ComissoesCorretoresLancadas
                        ::where("comissoes_id",$comissao_id)
                        ->where("parcela",5)            
                        ->first();
                    if($comissao) {
                        $comissao->status_gerente = 1;
                        $comissao->data_baixa_gerente = $request->data_baixa;
                        $comissao->save();
                    }
    
                    $comissaoCorretora = ComissoesCorretoraLancadas
                        ::where('comissoes_id',$comissao_id)
                        ->where('parcela',5)
                        ->first();
                    if(isset($comissaoCorretora) && $comissaoCorretora) {
                        $comissaoCorretora->status_gerente = 1;
                        $comissaoCorretora->data_baixa_gerente = $request->data_baixa;
                        $comissaoCorretora->save();
                    } 
        
                break;    

                case 9:
                    $contrato->financeiro_id = 10;
                    $contrato->save();
                    //$contrato->data_baixa = $request->data_baixa;
                    $comissao = ComissoesCorretoresLancadas
                        ::where("comissoes_id",$comissao_id)
                        ->where("parcela",6)            
                        ->first();
                    if($comissao) {
                        $comissao->status_gerente = 1;
                        $comissao->data_baixa_gerente = $request->data_baixa;
                        $comissao->save();
                    }
    
                    $comissaoCorretora = ComissoesCorretoraLancadas
                        ::where('comissoes_id',$comissao_id)
                        ->where('parcela',6)
                        ->first();
                    if(isset($comissaoCorretora) && $comissaoCorretora) {
                        $comissaoCorretora->status_gerente = 1;
                        $comissaoCorretora->data_baixa_gerente = $request->data_baixa;
                        $comissaoCorretora->save();
                    } 
                break;   
                
                case 10:
                    $contrato->financeiro_id = 11;
                    $contrato->save();
                    //$contrato->data_baixa = $request->data_baixa;
                    $comissao = ComissoesCorretoresLancadas
                        ::where("comissoes_id",$comissao_id)
                        ->where("parcela",7)            
                        ->first();

                    if($comissao) {
                        $comissao->status_gerente = 1;
                        $comissao->data_baixa_gerente = $request->data_baixa;
                        $comissao->save();  
                    }
    
                    $comissaoCorretora = ComissoesCorretoraLancadas
                        ::where('comissoes_id',$comissao_id)
                        ->where('parcela',7)
                        ->first();
                    if(isset($comissaoCorretora) && $comissaoCorretora) {
                        $comissaoCorretora->status_gerente = 1;
                        $comissaoCorretora->data_baixa_gerente = $request->data_baixa;
                        $comissaoCorretora->save();
                    } 
                break;

            }
            
        }

        if($contrato->plano_id == 1) {

            switch($contrato->financeiro_id) {

                case 5: 
                    $contrato->financeiro_id = 6;
                    $contrato->save();

                    $comissao = ComissoesCorretoresLancadas
                    ::where("comissoes_id",$comissao_id)
                    ->where("parcela",1)            
                    ->first();
                    if($comissao) {                    
                        $comissao->status_gerente = 1;
                        $comissao->data_baixa_gerente = $request->data_baixa;
                        $comissao->save();
                    }   
                
                    $comissaoCorretora = ComissoesCorretoraLancadas
                        ::where('comissoes_id',$comissao_id)
                        ->where('parcela',1)
                        ->first();
                    if(isset($comissaoCorretora) && $comissaoCorretora) {
                        $comissaoCorretora->status_gerente = 1;
                        $comissaoCorretora->data_baixa_gerente = $request->data_baixa;
                        $comissaoCorretora->save();
                    } 
                break;
                
                case 6: 
                    $contrato->financeiro_id = 7;
                    $contrato->save();

                    $comissao = ComissoesCorretoresLancadas
                    ::where("comissoes_id",$comissao_id)
                    ->where("parcela",2)            
                    ->first();
                    if($comissao) {                    
                        $comissao->status_gerente = 1;
                        $comissao->data_baixa_gerente = $request->data_baixa;
                        $comissao->save();
                    }   
                    $comissaoCorretora = ComissoesCorretoraLancadas
                        ::where('comissoes_id',$comissao_id)
                        ->where('parcela',2)
                        ->first();
                    if(isset($comissaoCorretora) && $comissaoCorretora) {
                        $comissaoCorretora->status_gerente = 1;
                        $comissaoCorretora->data_baixa_gerente = $request->data_baixa;
                        $comissaoCorretora->save();
                    } 
                break;   
                
                case 7: 
                    $contrato->financeiro_id = 8;
                    $contrato->save();

                    $comissao = ComissoesCorretoresLancadas
                    ::where("comissoes_id",$comissao_id)
                    ->where("parcela",3)            
                    ->first();
                    if($comissao) {                    
                        $comissao->status_gerente = 1;
                        $comissao->data_baixa_gerente  = $request->data_baixa;
                        $comissao->save();
                    }   
                    $comissaoCorretora = ComissoesCorretoraLancadas
                        ::where('comissoes_id',$comissao_id)
                        ->where('parcela',3)
                        ->first();
                    if(isset($comissaoCorretora) && $comissaoCorretora) {
                        $comissaoCorretora->status_gerente = 1;
                        $comissaoCorretora->data_baixa_gerente  = $request->data_baixa;
                        $comissaoCorretora->save();
                    } 
                break;   
                
                case 8: 
                    $contrato->financeiro_id = 9;
                    $contrato->save();

                    $comissao = ComissoesCorretoresLancadas
                    ::where("comissoes_id",$comissao_id)
                    ->where("parcela",4)            
                    ->first();
                    if($comissao) {                    
                        $comissao->status_gerente = 1;
                        $comissao->data_baixa_gerente = $request->data_baixa;
                        $comissao->save();
                    }   
                    $comissaoCorretora = ComissoesCorretoraLancadas
                        ::where('comissoes_id',$comissao_id)
                        ->where('parcela',4)
                        ->first();
                    if(isset($comissaoCorretora) && $comissaoCorretora) {
                        $comissaoCorretora->status_gerente = 1;
                        $comissaoCorretora->data_baixa_gerente = $request->data_baixa;
                        $comissaoCorretora->save();
                    } 
                break;  
                
                case 9: 
                    $contrato->financeiro_id = 10;
                    $contrato->save();

                    $comissao = ComissoesCorretoresLancadas
                    ::where("comissoes_id",$comissao_id)
                    ->where("parcela",5)            
                    ->first();
                    if($comissao) {                    
                        $comissao->status_gerente = 1;
                        $comissao->data_baixa_gerente = $request->data_baixa;
                        $comissao->save();
                    }   
                    $comissaoCorretora = ComissoesCorretoraLancadas
                        ::where('comissoes_id',$comissao_id)
                        ->where('parcela',5)
                        ->first();
                    if(isset($comissaoCorretora) && $comissaoCorretora) {
                        $comissaoCorretora->status_gerente = 1;
                        $comissaoCorretora->data_baixa_gerente = $request->data_baixa;
                        $comissaoCorretora->save();
                    } 
                break;   
                
                case 10: 
                    $contrato->financeiro_id = 11;
                    $contrato->save();

                    $comissao = ComissoesCorretoresLancadas
                    ::where("comissoes_id",$comissao_id)
                    ->where("parcela",6)            
                    ->first();
                    if($comissao) {                    
                        $comissao->status_gerente = 1;
                        $comissao->data_baixa_gerente = $request->data_baixa;
                        $comissao->save();
                    }   
                    $comissaoCorretora = ComissoesCorretoraLancadas
                        ::where('comissoes_id',$comissao_id)
                        ->where('parcela',6)
                        ->first();
                    if(isset($comissaoCorretora) && $comissaoCorretora) {
                        $comissaoCorretora->status_gerente = 1;
                        $comissaoCorretora->data_baixa_gerente = $request->data_baixa;
                        $comissaoCorretora->save();
                    } 
                break;    
            }
        }

        $datas_select = DB::select("SELECT data_baixa_gerente FROM comissoes_corretora_lancadas WHERE status_financeiro = 1 AND status_gerente = 1 GROUP BY MONTH(data_baixa_gerente)");
        $select = "";
        foreach($datas_select as $v) {
            $valor = date('Y-m',strtotime($v->data_baixa_gerente));
            $texto = date('m/Y',strtotime($v->data_baixa_gerente));
            $select .= "<option value=".$valor.">".$texto."</option>"; 
        } 
        
        $valor_quat_comissao_a_receber = ComissoesCorretoraLancadas
            ::selectRaw("sum(valor) as total")
            ->where("status_financeiro",1)
            ->where("status_gerente",0)->first()->total;

        $valor_quat_comissao_recebido = ComissoesCorretoresLancadas
            ::selectRaw("sum(valor) as total")
            ->where("status_financeiro",1)
            ->where("status_gerente",1)->first()->total;

        $administradoras = DB::select("SELECT nome FROM administradoras WHERE id IN (SELECT administradora_id FROM comissoes WHERE id IN(SELECT comissoes_id FROM comissoes_corretora_lancadas WHERE status_financeiro = 1 AND status_gerente = 1 GROUP BY comissoes_id) GROUP BY administradora_id)");    
        


        return [
            "quat_comissao_a_receber" => ComissoesCorretoraLancadas::where("status_financeiro",1)->where("status_gerente",0)->count(),
            "quat_comissao_recebido"  => ComissoesCorretoraLancadas::where("status_financeiro",1)->where("status_gerente",1)->count(),
            'datas_select'            => $select ,
            'valor_quat_comissao_a_receber' => number_format($valor_quat_comissao_a_receber,2,",","."),
            'valor_quat_comissao_recebido' => number_format($valor_quat_comissao_recebido,2,",","."),  
        ];

    }

    public function listarUserComissoesAll()
    {
        $users = DB::select(
            "SELECT id,name,
            (SELECT if(SUM(valor)>0,SUM(valor),0) FROM comissoes_corretores_lancadas WHERE status_financeiro = 1 AND status_gerente = 1 
            AND MONTH(DATA) = MONTH(NOW()) AND comissoes_id 
      IN(SELECT id FROM comissoes WHERE user_id = users.id AND comissoes.administradora_id = 1)) AS valor_allcare,
      (SELECT if(SUM(valor)>0,SUM(valor),0) FROM comissoes_corretores_lancadas WHERE status_financeiro = 1 AND status_gerente = 1 
            AND MONTH(DATA) = MONTH(NOW()) AND comissoes_id 
      IN(SELECT id FROM comissoes WHERE user_id = users.id AND comissoes.administradora_id = 2)) AS valor_alter,
            (SELECT if(SUM(valor)>0,SUM(valor),0) FROM comissoes_corretores_lancadas WHERE status_financeiro = 1 AND status_gerente = 1 
            AND MONTH(DATA) = MONTH(NOW()) AND comissoes_id 
      IN(SELECT id FROM comissoes WHERE user_id = users.id AND comissoes.administradora_id = 3)) AS valor_qualicorp,
            (SELECT if(SUM(valor)>0,SUM(valor),0) FROM comissoes_corretores_lancadas WHERE status_financeiro = 1 AND status_gerente = 1 
            AND MONTH(DATA) = MONTH(NOW()) AND comissoes_id 
      IN(SELECT id FROM comissoes WHERE user_id = users.id AND comissoes.administradora_id = 4)) AS valor_hapvida,
          (SELECT if(SUM(valor)>0,SUM(valor),0) FROM comissoes_corretores_lancadas WHERE status_financeiro = 1 AND status_gerente = 1 
            AND MONTH(DATA) = MONTH(NOW()) AND comissoes_id 
      IN(SELECT id FROM comissoes WHERE user_id = users.id)) AS valor,

      (SELECT COUNT(*) FROM comissoes_corretores_lancadas WHERE status_financeiro = 1 AND status_gerente = 1 AND status_comissao = 1
		AND MONTH(DATA) = MONTH(NOW()) AND comissoes_id 
        IN(SELECT id FROM comissoes WHERE user_id = users.id)) AS status     



    FROM users WHERE cargo_id IS NOT NULL"
        );
        return $users;
    }








}
