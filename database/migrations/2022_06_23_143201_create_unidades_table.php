<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidades', function(Blueprint $table) {
            $table->id();
            $table->string('unidade', 5); //cm, mm, kg
            $table->string('descricao', 30);
            $table->timestamps();
        });

        //Adicionar relacionamento com tabela produtos
        Schema::table('produtos', function (Blueprint $table) {
            $table->unsignedBigInteger('unidade_id');
            $table->foreign('unidade_id')->references('id')->on('unidades');
        });

        //Adicionar relacionamento com tabela produto_detalhes
        Schema::table('produto_detalhes', function (Blueprint $table) {
            $table->unsignedBigInteger('unidade_id');
            $table->foreign('unidade_id')->references('id')->on('unidades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        //Remover relacionamento com tabela produto_detalhes
        Schema::table('produto_detalhes', function (Blueprint $table) {
            //remover primeiro a FK
            $table->dropForeign('produto_detalhes_unidade_id_foreign');
            //depois remover a coluna
            $table->dropColumn('unidade_id');
        });

        //Remover relacionamento com tabela produtos
        Schema::table('produtos', function (Blueprint $table) {
             //remover primeiro a FK
             $table->dropForeign('produtos_unidade_id_foreign');
             //depois remover a coluna
             $table->dropColumn('unidade_id');
        });

        Schema::dropIfExists('unidades');
    }
};
