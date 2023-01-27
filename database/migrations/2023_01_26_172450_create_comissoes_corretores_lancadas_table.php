<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComissoesCorretoresLancadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comissoes_corretores_lancadas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('comissoes_id');
            $table->integer("parcela");
            $table->decimal("valor",10,2);
            $table->boolean("status");
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
        Schema::dropIfExists('comissoes_corretores_lancadas');
    }
}