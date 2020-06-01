<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnidadeMedicamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidade_medicamentos', function (Blueprint $table) {
            $table->unsignedBigInteger('unidade_id');
            $table->unsignedBigInteger('medicamento_id');

            $table->foreign('unidade_id')
                ->references('id')->on('unidades')
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
        Schema::dropIfExists('unidade_medicamentos');
    }
}
