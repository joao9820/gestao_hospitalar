<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgendamentoRetiradaMedicamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendamento_retirada_medicamentos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('solicitacao_id');
            $table->unsignedBigInteger('unidade_id');
            $table->unsignedBigInteger('user_id');
            $table->dateTime('data_hora_retirada');
            $table->timestamps();

            $table->foreign('solicitacao_id')
                ->references('id')->on('solicitacoes')
                ->onUpdate('cascade')
                ->onDelete('cascade'); 

            $table->foreign('unidade_id')
                ->references('id')->on('unidades')
                ->onUpdate('cascade');

            $table->foreign('user_id')
                ->references('id')->on('users')
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
        Schema::dropIfExists('agendamento_retirada_medicamentos');
    }
}
