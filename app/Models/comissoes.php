<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comissoes extends Model
{
    use HasFactory;

    protected $fillable = ["data","plano_id","user_id","administradora_id","tabela_origens_id","contrato_id","contrato_empresarial_id","empresarial"];

    protected $casts = [
        'empresarial' => 'boolean',
    ];


    public function plano()
    {
        return $this->belongsTo(Planos::class);
    }

    



    public function comissoesLancadas()
    {
        return $this->hasMany(ComissoesCorretoresLancadas::class)->selectRaw("
            id,
            comissoes_id,
            parcela,
            data,
            valor,
            status_financeiro,
            status_gerente,
            data_baixa,
            data_baixa_gerente,
            valor_pago,
            cancelados,
            if(DATEDIFF(data_baixa,DATA) >= 1,DATEDIFF(data_baixa,DATA),0) AS quantidade_dias
            ");
    }

    public function cancelado()
    {
        return $this->belongsTo(Cancelado::class,"id","comissoes_id");
    }




    // public function comissoesLancadasLiquidados()
    // {
    //     // return $this->hasMany(ComissoesCorretoresLancadas::class)->where('status_financeiro',1)->where('status_gerente',1);
    //     return $this->hasMany(ComissoesCorretoresLancadas::class)->where('status_financeiro',1)->where('status_gerente',1);
    // }





    public function comissoesLancadasCorretora()
    {
        return $this->hasMany(ComissoesCorretoraLancadas::class)
            ->selectRaw("
                id,
                comissoes_id,
                parcela,
                data,
                valor,
                status_financeiro,
                status_gerente,
                data_baixa,
                data_baixa_gerente,
                DATEDIFF(data_baixa_gerente,data) AS quantidade_dias,
                (SELECT valor_plano FROM contratos WHERE id = (SELECT contrato_id FROM comissoes WHERE comissoes.id = comissoes_corretora_lancadas.comissoes_id)) AS valor_plano
        ");
        
    }

    public function comissaoAtual() 
    {
        return $this->hasOne(ComissoesCorretoresLancadas::class)->where('status_financeiro',1)->where('status_gerente',0);
    }

    public function comissaoAtualLast() 
    {
        return $this->hasOne(ComissoesCorretoresLancadas::class)
            ->where('status_financeiro',1)
            ->where('status_gerente',0)->orderBy("id","desc");
    }


    public function comissaoAtualFinanceiro()
    {
        return $this->hasOne(ComissoesCorretoresLancadas::class)->where('status_financeiro',0)->where('status_gerente',0);
    }

    public function somarComissoesParcelasAtivas() 
    {
        return $this->hasMany(ComissoesCorretoresLancadas::class)
        ->selectRaw("SUM(valor)")
        ->where('status_financeiro',1)
        ->where('status_gerente',1);
    }

    public function ultimaComissaoPaga()
    {
        return $this->hasOne(ComissoesCorretoresLancadas::class)->where('status_financeiro',1)->where('status_gerente',1)->orderBy("id","desc");
    }



    public function administradoras() 
    {
        // return $this->hasOne
    }



    public function comissaoAtualPagaLast() 
    {
        return $this->hasOne(ComissoesCorretoresLancadas::class)
            ->where('status_financeiro',1)
            ->where('status_gerente',1)
            ->orderBy('id','desc')
            ->take(1)
            ->as('subscription');
    }


    public function comissoesLancadasCorretoraQuantidade()
    {
        // return ComissoesCorretoresLancadas::withCount(['comissoes' => function($query){
        //     $query->where('status_financeiro',1);
        //     $query->where('status_gerente',1);           
        // }])->get();
            
        return $this->hasMany(ComissoesCorretoresLancadas::class,'comissoes_id')->where('status_financeiro',1)->where('status_gerente',1);
        //return $this->hasManyThrough(ComissoesCorretoresLancadas::class,comissoes::class)->where('status_financeiro',1)->where('status_gerente',1);
    }

    public function comissoesAprovadasFinanceira()
    {
        return $this->hasMany(ComissoesCorretoresLancadas::class)
            ->where('status_financeiro',1)
            ->where('status_gerente',0)
            ->where('valor','!=',0);
    }

    public function comissoesCorretorasAprovadasFinanceira()
    {
        return $this->hasMany(ComissoesCorretoraLancadas::class)
            ->where('status_financeiro',1)
            ->where('status_gerente',0)
            ->where('valor','!=',0);
            
    }



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getEmpresarialAttribute($value) : bool
    {
        return $value ? 1 : 0;
    }

    // public function contrato()
    // {
    //     return $this->belongsTo(Contrato::class);   
    // }

    public function contrato()
    {
        
        return $this->empresarial;
        //if($this->empresarial) {
            //return $this->belongsTo(ContratoEmpresarial::class,"contrato_empresarial_id","id");
        //} else {
            //return $this->belongsTo(Contrato::class);
        //}
        //return $this->belongsTo(ContratoEmpresarial::class,"contrato_empresarial_id","id");
        // if($this->belongsTo(ContratoEmpresarial::class,"id","contrato_empresarial_id")) {
        //     return $this->belongsTo(ContratoEmpresarial::class,"id","contrato_empresarial_id");
        // } else {
        //     return $this->belongsTo(Contrato::class);
        // }
        //return $this->teste();
    }




    public function teste()
    {
        // if($this->empresarial) {
        //     return true;
        // } else {
        //     return false;
        // }
        return $this->belongsTo(Planos::class,"plano_id","id");
    }


    





}
