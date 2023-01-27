<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePremiacoesCorretoresConfiguracoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('premiacoes_corretores_configuracoes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('premiacoes_id');
            $table->integer("parcela");
            $table->decimal("porcentagens",10,2);
            $table->foreign('premiacoes_id')->references('id')->on('premiacoes')->onDelete('cascade');
            
            

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
        Schema::dropIfExists('premiacoes_corretores_configuracoes');
    }
}
