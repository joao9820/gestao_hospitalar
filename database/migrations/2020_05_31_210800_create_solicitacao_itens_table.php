<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitacaoItensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitacao_itens', function (Blueprint $table) {
            $table->unsignedBigInteger('solicitacao_id');
            $table->unsignedBigInteger('medicamento_id');
            $table->integer('quantidade_item');

             $table->foreign('solicitacao_id')
                ->references('id')->on('solicitacoes')
                ->onUpdate('cascade')
                ->onDelete('cascade'); 

            $table->foreign('medicamento_id')
                ->references('id')->on('medicamentos')
                ->onUpdate('cascade');               

            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitacao_itens');
    }
}
