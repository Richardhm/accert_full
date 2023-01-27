<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');            
            $table->string("nome");          
            $table->string("cidade");
            $table->string("celular")->nullable();
            $table->string("email")->nullable()->unique();
            $table->string("cpf")->nullable()->unique();   
            $table->date("data_nascimento")->nullable(); 
            $table->string("cep")->nullable();  
            $table->string("rua")->nullable();
            $table->string("bairro")->nullable();
            $table->string("complemento")->nullable();
            $table->string("uf")->nullable();
            $table->string("cnpj")->nullable()->unique();
            $table->boolean('pessoa_fisica');
            $table->boolean('pessoa_juridica');
            $table->boolean('dependente');
            $table->foreign('user_id')->references('id')->on('users')->onDelete("cascade");
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
        Schema::dropIfExists('clientes');
    }
}
