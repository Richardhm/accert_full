<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\{
    Contrato,Cliente,TabelaOrigens,Administradoras,Planos,Acomodacao,CotacaoFaixaEtaria,User,PlanoEmpresarial,ContratoEmpresarial,  
    Comissoes,ComissoesCorretoresLancadas,ComissoesCorretoraConfiguracoes,ComissoesCorretoralancadas,ComissoesCorretoresConfiguracoes,
    Premiacoes,PremiacoesCorretoraLancadas,PremiacoesCorretoresLancadas,PremiacoesCorretoraConfiguracoes,PremiacoesCorretoresConfiguracoes,
    Dependentes
};
use Illuminate\Support\Facades\DB;

class ContratoController extends Controller
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

        return view('admin.pages.contratos.index',[
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

    public function listarEmpresarialPorUser(Request $request)
    {
        if($request->ajax()) {
            $user_id = User::where("name",$request->user)->first()->id;
            return ContratoEmpresarial
                ::selectRaw("(SELECT name FROM users WHERE users.id = contrato_empresarial.user_id) as usuario")
                ->selectRaw("(SELECT nome FROM plano_empresarial WHERE plano_empresarial.id = contrato_empresarial.plano_empresarial_id) as plano")
                ->selectRaw("quantidade_vidas,cnpj,razao_social,codigo_vendedor,codigo_cliente,codigo_corretora,taxa_adesao,valor_plano,valor_total,vencimento_boleto,valor_boleto,codigo_cliente")
                ->whereRaw("user_id = 2")
                ->get();
        }        
    }

    public function montarPlanos(Request $request)
    {
        
        $cliente = new Cliente();
        $cliente->user_id = $request->user;
        // $cliente->nome = $request->nome;
        // $cliente->cidade = $request->cidade;
        // $cliente->celular = $request->celular;
        // $cliente->email = $request->email;
        // $cliente->cpf = $request->cpf;
        // $cliente->data_nascimento = date('Y-m-d',strtotime($request->data_nascimento));
        // $cliente->cep = $request->cep;
        // $cliente->rua = $request->rua;
        // $cliente->bairro = $request->bairro;
        // $cliente->complemento = $request->complemento;
        // $cliente->uf = $request->uf;
        // $cliente->pessoa_fisica = 1;
        // $cliente->pessoa_juridica = 0;
        // $cliente->dependente = ($request->dependente == "on" ? 1 : 0);    
        $cliente->save();
        // if($cliente->dependente == "true") {
        //     $dependente = new Dependentes();
        //     $dependente->cliente_id = $cliente->id;
        //     $dependente->nome = $request->responsavel_nome; 
        //     $dependente->cpf = $request->responsavel_cpf;
        //     $dependente->save();
        // }
        $contrato = new Contrato();
        $contrato->cliente_id = $cliente->id;
        $contrato->administradora_id = $request->administradora;
        $contrato->tabela_origens_id = $request->tabela_origens_id;
        $contrato->plano_id = (!empty($request->plano) ? $request->plano : 3);
        $contrato->financeiro_id = 1;
        $contrato->coparticipacao = ($request->coparticipacao == "sim" ? 1 : 0);
        $contrato->odonto = ($request->odonto == "sim" ? 1 : 0);
        $contrato->codigo_externo = $request->codigo_externo;
        $contrato->save();
        $faixas = $request->faixas;
        foreach($faixas as $k => $v) {
            if($v != 0) {
                $orcamentoFaixaEtaria = new CotacaoFaixaEtaria();
                $orcamentoFaixaEtaria->contrato_id = $contrato->id;
                $orcamentoFaixaEtaria->faixa_etaria_id = $k;
                $orcamentoFaixaEtaria->quantidade = $v;
                $orcamentoFaixaEtaria->save();
            } 
        }

        $cot = $contrato;
        $valores = DB::table("cotacao_faixa_etarias")
        ->join("tabelas","tabelas.faixa_etaria_id","=","cotacao_faixa_etarias.faixa_etaria_id")
        ->selectRaw("sum(valor * (SELECT quantidade FROM cotacao_faixa_etarias WHERE contrato_id = ".$cot->id." AND cotacao_faixa_etarias.faixa_etaria_id = tabelas.faixa_etaria_id)) AS total")
        ->selectRaw("(SELECT id FROM acomodacoes WHERE tabelas.acomodacao_id = acomodacoes.id) AS id_acomodacao")
        ->selectRaw("(SELECT nome FROM acomodacoes WHERE acomodacoes.id = tabelas.acomodacao_id) as modelo")
        ->selectRaw("(SELECT nome FROM planos WHERE tabelas.plano_id = planos.id) AS plano")
        ->selectRaw("if(coparticipacao = 0,'Sem Coparticipacao','Com Coparticipacao') AS coparticipacao")
        ->selectRaw("if(odonto = 0,'Sem Odonto','Com Odonto') AS odonto")
        ->selectRaw("(SELECT logo FROM administradoras WHERE administradoras.id = tabelas.administradora_id) AS operadora")
        ->whereRaw("tabelas.tabela_origens_id = ".$request->tabela_origens_id." AND tabelas.administradora_id = ".$request->administradora." AND odonto = ".($request->odonto == "sim" ? 1 : 0)." AND coparticipacao = ".($request->coparticipacao == "sim" ? 1 : 0)." AND tabelas.plano_id = ".(!empty($request->plano) ? $request->plano : 3)." AND cotacao_faixa_etarias.contrato_id = ".$cot->id)
        ->groupBy('acomodacao_id')
        ->get();
        

        $faixas_etarias = DB::table("cotacao_faixa_etarias")
        ->join("tabelas","tabelas.faixa_etaria_id","=","cotacao_faixa_etarias.faixa_etaria_id")
        ->selectRaw("(SELECT nome FROM faixa_etarias WHERE faixa_etarias.id = cotacao_faixa_etarias.faixa_etaria_id) AS faixas")
        ->selectRaw("quantidade,valor")
        ->selectRaw("(SELECT nome FROM acomodacoes WHERE acomodacoes.id = tabelas.acomodacao_id) as modelo")
        ->selectRaw("(cotacao_faixa_etarias.quantidade * tabelas.valor) AS total")
        ->whereRaw("contrato_id = ? AND administradora_id = ? AND tabela_origens_id = ? AND odonto = ? AND coparticipacao = ? AND plano_id = ?",[$cot->id,$request->administradora,$request->tabela_origens_id,($request->odonto == "sim" ? 1 : 0),($request->coparticipacao == "sim" ? 1 : 0),(!empty($request->plano) ? $request->plano : 3)])
        ->get();

        return view("admin.pages.contratos.acomodacao",[
            "valores" => $valores,
            "faixas" => $faixas_etarias,
            "contrato" => $cot->id,
            "user" => $request->user,
            "tabela_origem" => $request->tabela_origens_id,
            "administradora" => $request->administradora,
            "cliente" => $cliente->id
        ]);
    }


    public function montarPlanosIndividual(Request $request)
    {
        
        $cliente = new Cliente();
        $cliente->user_id = $request->user;
        $cliente->save();
        $contrato = new Contrato();
        $contrato->cliente_id = $cliente->id;
        $contrato->administradora_id = 4;
        $contrato->tabela_origens_id = $request->tabela_origens_id;
        $contrato->plano_id = 1;
        $contrato->financeiro_id = 1;
        $contrato->coparticipacao = ($request->coparticipacao == "sim" ? 1 : 0);
        $contrato->odonto = ($request->odonto == "sim" ? 1 : 0);
        $contrato->codigo_externo = $request->codigo_externo;
        $contrato->save();
        $faixas = $request->faixas;
        foreach($faixas as $k => $v) {
            if($v != 0) {
                $orcamentoFaixaEtaria = new CotacaoFaixaEtaria();
                $orcamentoFaixaEtaria->contrato_id = $contrato->id;
                $orcamentoFaixaEtaria->faixa_etaria_id = $k;
                $orcamentoFaixaEtaria->quantidade = $v;
                $orcamentoFaixaEtaria->save();
            } 
        }

        $cot = $contrato;
        $valores = DB::table("cotacao_faixa_etarias")
        ->join("tabelas","tabelas.faixa_etaria_id","=","cotacao_faixa_etarias.faixa_etaria_id")
        ->selectRaw("sum(valor * (SELECT quantidade FROM cotacao_faixa_etarias WHERE contrato_id = ".$cot->id." AND cotacao_faixa_etarias.faixa_etaria_id = tabelas.faixa_etaria_id)) AS total")
        ->selectRaw("(SELECT id FROM acomodacoes WHERE tabelas.acomodacao_id = acomodacoes.id) AS id_acomodacao")
        ->selectRaw("(SELECT nome FROM acomodacoes WHERE acomodacoes.id = tabelas.acomodacao_id) as modelo")
        ->selectRaw("(SELECT nome FROM planos WHERE tabelas.plano_id = planos.id) AS plano")
        ->selectRaw("if(coparticipacao = 0,'Sem Coparticipacao','Com Coparticipacao') AS coparticipacao")
        ->selectRaw("if(odonto = 0,'Sem Odonto','Com Odonto') AS odonto")
        ->selectRaw("(SELECT logo FROM administradoras WHERE administradoras.id = tabelas.administradora_id) AS operadora")
        ->whereRaw("tabelas.administradora_id = 4")
        ->whereRaw("tabelas.tabela_origens_id = ".$request->tabela_origens_id." AND  odonto = ".($request->odonto == "sim" ? 1 : 0)." AND coparticipacao = ".($request->coparticipacao == "sim" ? 1 : 0)." AND tabelas.plano_id = ".(!empty($request->plano) ? $request->plano : 1)." AND cotacao_faixa_etarias.contrato_id = ".$cot->id)
        ->groupBy('acomodacao_id')
        ->get();
        $faixas_etarias = DB::table("cotacao_faixa_etarias")
        ->join("tabelas","tabelas.faixa_etaria_id","=","cotacao_faixa_etarias.faixa_etaria_id")
        ->selectRaw("(SELECT nome FROM faixa_etarias WHERE faixa_etarias.id = cotacao_faixa_etarias.faixa_etaria_id) AS faixas")
        ->selectRaw("quantidade,valor")
        ->selectRaw("(SELECT nome FROM acomodacoes WHERE acomodacoes.id = tabelas.acomodacao_id) as modelo")
        ->selectRaw("(cotacao_faixa_etarias.quantidade * tabelas.valor) AS total")
        ->whereRaw("administradora_id = 4")
        ->whereRaw("contrato_id = ? AND tabela_origens_id = ? AND odonto = ? AND coparticipacao = ? AND plano_id = ?",[$cot->id,$request->tabela_origens_id,($request->odonto == "sim" ? 1 : 0),($request->coparticipacao == "sim" ? 1 : 0),(!empty($request->plano) ? $request->plano : 1)])
        ->get();
        return view("admin.pages.contratos.acomodacao",[
            "valores" => $valores,
            "faixas" => $faixas_etarias,
            "contrato" => $cot->id,
            "user" => $request->user,
            "tabela_origem" => $request->tabela_origens_id,
            "dependente" => ($request->dependente == "true" ? 1 : 0),
            "cliente" => $cliente->id
        ]);

    }


    public function storeIndividual(Request $request)
    {  

        $valor = str_replace([".",","],["","."],$request->valor); 
        
        $cliente = Cliente::find($request->cliente);
        $cliente->nome = $request->nome_individual;
        $cliente->cidade = $request->cidade_origem_individual;
        $cliente->celular = $request->celular_individual;
        $cliente->telefone = $request->telefone_individual;
        $cliente->email = $request->email_individual;
        $cliente->cpf = $request->cpf_individual;
        $cliente->data_nascimento = date('Y-m-d',strtotime($request->data_nascimento_individual));
        $cliente->cep = $request->cep_individual;
        $cliente->rua = $request->rua_individual;
        $cliente->bairro = $request->bairro_individual;
        $cliente->complemento = $request->complemento_individual;
        $cliente->uf = $request->uf_individual;
        $cliente->pessoa_fisica = 1;
        $cliente->pessoa_juridica = 0;
        $cliente->dependente = ($request->dependente_individual == "on" ? 1 : 0);  
        $cliente->save();

        if($cliente->dependente) {
            $dependente = new Dependentes();
            $dependente->cliente_id = $cliente->id;
            $dependente->nome = $request->responsavel_financeiro_individual_cadastro; 
            $dependente->cpf = $request->cpf_financeiro_individual_cadastro;
            $dependente->save();
        }

        $acomodacao = $request->acomodacao;
        $acomodacao_id = Acomodacao::selectRaw('id')->whereRaw("nome LIKE '%{$acomodacao}%'")->first()->id;
        $data_vigencia = $request->data_vigencia;
        $data_boleto = $request->data_boleto;
        $valor_adesao = str_replace([".",","],["","."],$request->valor_adesao);
        $valor_plano = str_replace([".",","],["","."],$request->valor);
        $contrato = Contrato::find($request->contrato);        
        $contrato->acomodacao_id = $acomodacao_id;
        $contrato->financeiro_id = 1;
        $contrato->data_vigencia = $data_vigencia;
        $contrato->data_boleto = $data_boleto;
        $contrato->valor_adesao = $valor_adesao;
        $contrato->valor_plano = $valor_plano;
        $contrato->save();

        CotacaoFaixaEtaria::where("contrato_id",$contrato->id)->delete();
        $totalVidas = 0;
        $faixas = $request->faixas_etarias;
        foreach($faixas as $k => $v) {
            if($v != 0) {
                $orcamentoFaixaEtaria = new CotacaoFaixaEtaria();
                $orcamentoFaixaEtaria->contrato_id = $contrato->id;
                $orcamentoFaixaEtaria->faixa_etaria_id = $k;
                $orcamentoFaixaEtaria->quantidade = $v;
                $orcamentoFaixaEtaria->save();
                $totalVidas += $v;
            } 
        }       

        $comissao = new Comissoes();
        $comissao->contrato_id = $contrato->id;
        // $comissao->cliente_id = $contrato->cliente_id;
        $comissao->user_id = $request->user;
        // $comissao->status = 1;
        $comissao->plano_id = 1;
        $comissao->administradora_id = 4;
        $comissao->tabela_origens_id = $request->tabela_origem;
        $comissao->data = date('Y-m-d');
        $comissao->save();

        /* Comissao Corretor */
        $comissoes_configuradas_corretor = ComissoesCorretoresConfiguracoes
        ::where("plano_id",1)
        ->where("administradora_id",4)
        ->where("user_id",$request->user)
        ->where("tabela_origens_id",$request->tabela_origem)
        ->get();

        $comissao_corretor_contagem = 0;
        if(count($comissoes_configuradas_corretor) >= 1) {
            foreach($comissoes_configuradas_corretor as $c) {
                $comissaoVendedor = new ComissoesCorretoresLancadas();
                $comissaoVendedor->comissoes_id = $comissao->id;
                //$comissaoVendedor->user_id = auth()->user()->id;
                $comissaoVendedor->parcela = $c->parcela;
                if($comissao_corretor_contagem == 0) {
                    $comissaoVendedor->data = date('Y-m-d',strtotime($request->data_boleto));
                } else {
                    $comissaoVendedor->data = date("Y-m-d",strtotime($request->data_boleto."+{$comissao_corretor_contagem}month"));
                }
                $comissaoVendedor->valor = ($valor * $c->valor) / 100;
                $comissaoVendedor->save();  
                $comissao_corretor_contagem++;  
            }
        }

        /** Comissao Corretora */   
        $comissoes_configurada_corretora = ComissoesCorretoraConfiguracoes::where("administradora_id",4)
        ->where('plano_id',1)
        ->where('tabela_origens_id',$request->tabela_origem)
        ->get();
        $comissoes_corretora_contagem=0;
        if(count($comissoes_configurada_corretora)>=1) {
            foreach($comissoes_configurada_corretora as $cc) {                
                $comissaoCorretoraLancadas = new ComissoesCorretoraLancadas();
                $comissaoCorretoraLancadas->comissoes_id = $comissao->id;            
                $comissaoCorretoraLancadas->parcela = $cc->parcela;
                if($comissoes_corretora_contagem == 0) {
                    $comissaoCorretoraLancadas->data = date('Y-m-d',strtotime($request->data_boleto));
                } else {
                    $comissaoCorretoraLancadas->data = date("Y-m-d",strtotime($request->data_boleto."+{$comissoes_corretora_contagem}month"));
                }
                $comissaoCorretoraLancadas->valor = ($valor * $cc->valor) / 100;
                $comissaoCorretoraLancadas->save();
                $comissoes_corretora_contagem++;
            }
        }
        

        $premiacao = new Premiacoes();
        $premiacao->contrato_id = $contrato->id;
        $premiacao->user_id = $request->user;
        $premiacao->plano_id = 1;
        $premiacao->administradora_id = 4;
        $premiacao->tabela_origens_id = $request->tabela_origem;
        $premiacao->data = date('Y-m-d');
        $premiacao->save();


        $premiacao_configurada_corretor = PremiacoesCorretoresConfiguracoes
        ::where("plano_id",1)
        ->where("administradora_id",4)
        ->where("user_id",$request->user)
        ->where("tabela_origens_id",$request->tabela_origem)
        ->get();


        $premiacao_corretor_contagem = 0;
        if(count($premiacao_configurada_corretor)>=1) {
            foreach($premiacao_configurada_corretor as $k => $p) {
                $premiacaoCorretoresLancados = new PremiacoesCorretoresLancadas();
                $premiacaoCorretoresLancados->premiacoes_id = $premiacao->id;
                $premiacaoCorretoresLancados->parcela = $p->parcela;
                
                if($premiacao_corretor_contagem == 0) {
                    $premiacaoCorretoresLancados->data = date('Y-m-d',strtotime($request->data_boleto));
                } else {
                    $premiacaoCorretoresLancados->data = date("Y-m-d",strtotime($request->data_boleto."+{$premiacao_corretor_contagem}month"));
                }
                $premiacaoCorretoresLancados->valor = $p->valor * $totalVidas;
                $premiacaoCorretoresLancados->save();
                $premiacao_corretor_contagem++;
            }
        }

        


        /** Premiação Corretora */
        $premiacao_configurada_corretora = PremiacoesCorretoraConfiguracoes
        ::where("plano_id",1)
        ->where("administradora_id",4)
        //->where("user_id",$request->user)
        ->where("tabela_origens_id",$request->tabela_origem)
        ->get();



        $premiacao_corretora_contagem = 0;
        if(count($premiacao_configurada_corretora)>=1) {
            foreach($premiacao_configurada_corretora as $k => $p) {
                $premiacaoCorretoraLancados = new PremiacoesCorretoraLancadas();
                $premiacaoCorretoraLancados->premiacoes_id = $premiacao->id;
                $premiacaoCorretoraLancados->parcela = $p->parcela;
                if($premiacao_corretor_contagem == 0) {
                    $premiacaoCorretoraLancados->data = date('Y-m-d',strtotime($request->data_boleto));
                } else {
                    $premiacaoCorretoraLancados->data = date("Y-m-d",strtotime($request->data_boleto."+{$premiacao_corretora_contagem}month"));
                }
                $premiacaoCorretoraLancados->valor = $p->valor * $totalVidas;
                $premiacaoCorretoraLancados->save();
                $premiacao_corretora_contagem++;
            }
        }                


        return "cadastrado";
    }


    public function listarContratoEmpresarial(Request $request)
    {
        if($request->ajax()) {
            return ContratoEmpresarial
                ::selectRaw("(SELECT name FROM users WHERE users.id = contrato_empresarial.user_id) as usuario")
                ->selectRaw("(SELECT nome FROM plano_empresarial WHERE plano_empresarial.id = contrato_empresarial.plano_empresarial_id) as plano")
                ->selectRaw("(SELECT nome FROM tabela_origens WHERE tabela_origens.id = contrato_empresarial.tabela_origens_id) as tabela_origem")
                ->selectRaw("responsavel,email,telefone,celular,cidade,uf,quantidade_vidas,cnpj,razao_social,codigo_vendedor,codigo_cliente,codigo_corretora,taxa_adesao,valor_plano,valor_total,vencimento_boleto,valor_boleto,codigo_cliente,valor_plano_odonto,valor_plano_saude,senha_cliente,codigo_saude,codigo_odonto,plano_contrado,data_boleto")
                ->get();
        }
    }



    public function store(Request $request)
    {

        $valor = str_replace([".",","],["","."],$request->valor);        
        $cliente = Cliente::find($request->cliente);
        $cliente->nome = $request->nome_coletivo;
        $cliente->cidade = $request->cidade_origem_coletivo;
        $cliente->celular = $request->celular;
        $cliente->telefone = $request->telefone;
        $cliente->email = $request->email_coletivo;
        $cliente->cpf = $request->cpf_coletivo;
        $cliente->data_nascimento = date('Y-m-d',strtotime($request->data_nascimento_coletivo));
        $cliente->cep = $request->cep_coletivo;
        $cliente->rua = $request->rua_coletivo;
        $cliente->bairro = $request->bairro_coletivo;
        $cliente->complemento = $request->complemento_coletivo;
        $cliente->uf = $request->uf_coletivo;
        $cliente->pessoa_fisica = 1;
        $cliente->pessoa_juridica = 0;
        $cliente->dependente = ($request->dependente_coletivo == "on" ? 1 : 0);  
        $cliente->save();

        if($cliente->dependente) {
            $dependente = new Dependentes();
            $dependente->cliente_id = $cliente->id;
            $dependente->nome = $request->responsavel_financeiro_coletivo_cadastrar_nome; 
            $dependente->cpf = $request->responsavel_financeiro_coletivo_cadastrar_cpf;
            $dependente->save();
        }

        $acomodacao = $request->acomodacao;
        $acomodacao_id = Acomodacao::selectRaw('id')->whereRaw("nome LIKE '%{$acomodacao}%'")->first()->id;
        $data_vigencia = $request->data_vigencia;
        $data_boleto = $request->data_boleto;
        $valor_adesao = str_replace([".",","],["","."],$request->valor_adesao);
        $valor_plano = str_replace([".",","],["","."],$request->valor);
        
        $contrato = Contrato::find($request->contrato);        
        $contrato->acomodacao_id = $acomodacao_id;
        $contrato->financeiro_id = 1;
        $contrato->data_vigencia = $data_vigencia;

        $contrato->data_boleto = $data_boleto;
        $contrato->valor_adesao = $valor_adesao;
        $contrato->valor_plano = $valor_plano;
        $contrato->save();

        CotacaoFaixaEtaria::where("contrato_id",$contrato->id)->delete();
        $totalVidas = 0;
        $faixas = $request->faixas_etarias;
        foreach($faixas as $k => $v) {
            if($v != 0) {
                $orcamentoFaixaEtaria = new CotacaoFaixaEtaria();
                $orcamentoFaixaEtaria->contrato_id = $contrato->id;
                $orcamentoFaixaEtaria->faixa_etaria_id = $k;
                $orcamentoFaixaEtaria->quantidade = $v;
                $orcamentoFaixaEtaria->save();
                $totalVidas += $v;
            } 
        }       

        $comissao = new Comissoes();
        $comissao->contrato_id = $contrato->id;
        // $comissao->cliente_id = $contrato->cliente_id;
        $comissao->user_id = $request->user;
        // $comissao->status = 1;
        $comissao->plano_id = 3;
        $comissao->administradora_id = $request->administradora;
        $comissao->tabela_origens_id = $request->tabela_origem;
        $comissao->data = date('Y-m-d');
        $comissao->save();

        /* Comissao Corretor */
        $comissoes_configuradas_corretor = ComissoesCorretoresConfiguracoes
        ::where("plano_id",3)
        ->where("administradora_id",$request->administradora)
        ->where("user_id",$request->user)
        ->where("tabela_origens_id",$request->tabela_origem)
        ->get();

        $comissao_corretor_contagem = 0;
        if(count($comissoes_configuradas_corretor) >= 1) {
            foreach($comissoes_configuradas_corretor as $c) {
                $comissaoVendedor = new ComissoesCorretoresLancadas();
                $comissaoVendedor->comissoes_id = $comissao->id;
                //$comissaoVendedor->user_id = auth()->user()->id;
                $comissaoVendedor->parcela = $c->parcela;
                if($comissao_corretor_contagem == 0) {
                    $comissaoVendedor->data = date('Y-m-d',strtotime($request->data_boleto));
                } else {
                    $comissaoVendedor->data = date("Y-m-d",strtotime($request->data_boleto."+{$comissao_corretor_contagem}month"));
                }
                $comissaoVendedor->valor = ($valor * $c->valor) / 100;
                $comissaoVendedor->save();  
                $comissao_corretor_contagem++;  
            }
        }

        /** Comissao Corretora */   
        $comissoes_configurada_corretora = ComissoesCorretoraConfiguracoes::where("administradora_id",$request->administradora_coletivo)
        ->where('plano_id',3)
        ->where('tabela_origens_id',$request->tabela_origem)
        ->get();
        $comissoes_corretora_contagem=0;
        if(count($comissoes_configurada_corretora)>=1) {
            foreach($comissoes_configurada_corretora as $cc) {                
                $comissaoCorretoraLancadas = new ComissoesCorretoraLancadas();
                $comissaoCorretoraLancadas->comissoes_id = $comissao->id;            
                $comissaoCorretoraLancadas->parcela = $cc->parcela;
                if($comissoes_corretora_contagem == 0) {
                    $comissaoCorretoraLancadas->data = date('Y-m-d',strtotime($request->data_boleto));
                } else {
                    $comissaoCorretoraLancadas->data = date("Y-m-d",strtotime($request->data_boleto."+{$comissoes_corretora_contagem}month"));
                }
                $comissaoCorretoraLancadas->valor = ($valor * $cc->valor) / 100;
                $comissaoCorretoraLancadas->save();
                $comissoes_corretora_contagem++;
            }
        }
        

        $premiacao = new Premiacoes();
        $premiacao->contrato_id = $contrato->id;
        $premiacao->user_id = $request->user;
        $premiacao->plano_id = 3;
        $premiacao->administradora_id = $request->administradora;
        $premiacao->tabela_origens_id = $request->tabela_origem;
        $premiacao->data = date('Y-m-d');
        $premiacao->save();


        $premiacao_configurada_corretor = PremiacoesCorretoresConfiguracoes
        ::where("plano_id",3)
        ->where("administradora_id",$request->administradora)
        ->where("user_id",$request->user)
        ->where("tabela_origens_id",$request->tabela_origem)
        ->get();






        $premiacao_corretor_contagem = 0;
        if(count($premiacao_configurada_corretor)>=1) {
            foreach($premiacao_configurada_corretor as $k => $p) {
                $premiacaoCorretoresLancados = new PremiacoesCorretoresLancadas();
                $premiacaoCorretoresLancados->premiacoes_id = $premiacao->id;
                $premiacaoCorretoresLancados->parcela = $p->parcela;
                
                if($premiacao_corretor_contagem == 0) {
                    $premiacaoCorretoresLancados->data = date('Y-m-d',strtotime($request->data_boleto));
                } else {
                    $premiacaoCorretoresLancados->data = date("Y-m-d",strtotime($request->data_boleto."+{$premiacao_corretor_contagem}month"));
                }
                $premiacaoCorretoresLancados->valor = $p->valor * $totalVidas;
                $premiacaoCorretoresLancados->save();
                $premiacao_corretor_contagem++;
            }
        }

        


        /** Premiação Corretora */
        $premiacao_configurada_corretora = PremiacoesCorretoraConfiguracoes
        ::where("plano_id",3)
        ->where("administradora_id",$request->administradora)
        //->where("user_id",$request->user)
        ->where("tabela_origens_id",$request->tabela_origem_coletivo)
        ->get();



        $premiacao_corretora_contagem = 0;
        if(count($premiacao_configurada_corretora)>=1) {
            foreach($premiacao_configurada_corretora as $k => $p) {
                $premiacaoCorretoraLancados = new PremiacoesCorretoraLancadas();
                $premiacaoCorretoraLancados->premiacoes_id = $premiacao->id;
                $premiacaoCorretoraLancados->parcela = $p->parcela;
                if($premiacao_corretor_contagem == 0) {
                    $premiacaoCorretoraLancados->data = date('Y-m-d',strtotime($request->data_boleto));
                } else {
                    $premiacaoCorretoraLancados->data = date("Y-m-d",strtotime($request->data_boleto."+{$premiacao_corretora_contagem}month"));
                }
                $premiacaoCorretoraLancados->valor = $p->valor * $totalVidas;
                $premiacaoCorretoraLancados->save();
                $premiacao_corretora_contagem++;
            }
        }   
        return "cadastrado";             
        //return redirect('admin/contratos?ac=coletivo')->with('success',"Contrato com ".$request->nome." cadastrado com sucesso");
    }

    public function listarIndividual(Request $request)
    {
        $fisica = 1;
        $contratos = Contrato::
            where("plano_id",1)
            
            
            ->with(['administradora','financeiro','cidade','acomodacao','plano','somarCotacaoFaixaEtaria','clientes','clientes.user','clientes.dependentes'])
            ->orderBy("id","desc")
            ->get();
        return $contratos;           
    }

    public function listarColetivoPorAdesao(Request $request)
    {
        $fisica = 1;
        $contratos = Contrato
            ::where("plano_id",3)        
            ->with(['administradora','financeiro','cidade','acomodacao','plano','somarCotacaoFaixaEtaria','clientes','clientes.user','clientes.dependentes'])
            ->orderBy("id","desc")
            ->get();
        return $contratos;           
    }

    public function storeEmpresarial(Request $request)
    {
        $dados = $request->all();
       
        $dados['taxa_adesao'] = str_replace([".",","],["","."],$request->taxa_adesao);
        $dados['valor_plano'] = str_replace([".",","],["","."],$request->valor_plano);
        $dados['valor_plano_saude'] = str_replace([".",","],["","."],$request->valor_plano_saude);
        $dados['valor_plano_odonto'] = str_replace([".",","],["","."],$request->valor_plano_odonto);
        $dados['valor_plano'] = $dados['valor_plano_saude'] + $dados['valor_plano_odonto'];
        $dados['valor_total'] = $dados['valor_plano'] + $dados['taxa_adesao'];
        $dados['valor_boleto'] = str_replace([".",","],["","."],$request->valor_boleto);  
        $dados['data_boleto'] = date('Y-m-d',strtotime($request->data_boleto)); 

        ContratoEmpresarial::create($dados);
        //return redirect()->route('contratos.index')->with('success',"Contrato cadastrado com sucesso");           
        return redirect('admin/contratos?ac=empresarial')->with('success','Contrato cadastrado com sucesso');
    }

    public function contratoInfo(Request $request)
    {
        $id = $request->contrato;
        $contrato = Contrato
            ::where("id",$id)
            ->with(['clientes','comissao','comissao.comissoesLancadas','premiacao','premiacao.premiacoesLancadas'])
            ->first();
       return view('admin.pages.contratos.historicoFinanceiro',[
            "contrato" => $contrato
        ]);    

    }


    public function formCreate()
    {
        $users = User::where("id","!=",auth()->user()->id)->get();
        $origem_tabela = TabelaOrigens::all();



        return view('admin.pages.contratos.cadastrar',[
            'users' => $users,
            'origem_tabela' => $origem_tabela
        ]);
    }


    public function formCreateColetivo()
    {
        $users = User::where("id","!=",auth()->user()->id)->get();
        $origem_tabela = TabelaOrigens::all();
        $administradoras = Administradoras::whereRaw("id != (SELECT id FROM administradoras WHERE nome LIKE '%hapvida%')")->get();


        return view('admin.pages.contratos.cadastrar-coletivo',[
            'users' => $users,
            'cidades' => $origem_tabela,
            'administradoras' => $administradoras
        ]);   
    }


    public function formCreateEmpresarial()
    {
        $users = User::where("id","!=",auth()->user()->id)->get();
        $plano_empresarial = PlanoEmpresarial::all();
        $tabela_origem = TabelaOrigens::all();
        
        return view('admin.pages.contratos.cadastrar-empresa',[
            "users" => $users,
            "planos_empresarial" => $plano_empresarial,
            "origem_tabela" =>  $tabela_origem
        ]);
    }



}
