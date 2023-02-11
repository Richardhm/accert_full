<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratoEmpresarialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contrato_empresarial', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plano_empresarial_id')->nullable();
            $table->unsignedBigInteger('tabela_origens_id');
            $table->unsignedBigInteger('user_id');
            


            $table->date('data');

            $table->string('codigo_corretora');
            $table->string('codigo_vendedor');
            $table->string('cnpj');
            $table->string('razao_social');
            $table->integer('quantidade_vidas');

            $table->decimal('taxa_adesao',10,2);
            $table->decimal('valor_plano',10,2);
            $table->decimal('valor_total',10,2);

            $table->date('vencimento_boleto');
            $table->decimal('valor_boleto',10,2);            
            $table->string('codigo_cliente');
            $table->string('senha_cliente');
            $table->integer('dia_vencimento');

            $table->foreign('plano_empresarial_id')->references('id')->on('plano_empresarial');
            $table->foreign('tabela_origens_id')->references('id')->on('tabela_origens');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contrato_empresarial');
    }
}
