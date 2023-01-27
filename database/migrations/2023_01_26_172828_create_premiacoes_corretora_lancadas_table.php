<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePremiacoesCorretoraLancadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('premiacoes_corretora_lancadas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('premiacoes_id');
            $table->integer("parcela");
            $table->decimal("valor",10,2);
            $table->boolean("status");
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
        Schema::dropIfExists('premiacoes_corretora_lancadas');
    }
}
