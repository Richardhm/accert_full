<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComissoesCorretoraConfiguracoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comissoes_corretora_configuracoes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('comissoes_id');
            $table->integer("parcela");
            $table->decimal("porcentagem",10,2);
            $table->foreign('comissoes_id')->references('id')->on('comissoes')->onDelete('cascade');
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
        Schema::dropIfExists('comissoes_corretora_configuracoes');
    }
}
