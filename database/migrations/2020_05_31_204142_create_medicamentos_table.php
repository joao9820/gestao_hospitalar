<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicamentos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('forma_farmaceutica_id');
            $table->unsignedBigInteger('status_id');
            $table->string('nome');
            $table->text('descricao')->nullable();
            $table->smallInteger('quantidade');
            $table->decimal('valor', 8, 2);
            $table->integer('estoque_min');
            $table->timestamps();

            $table->foreign('forma_farmaceutica_id')
                ->references('id')->on('formas_farmaceuticas')
                ->onUpdate('cascade');

            $table->foreign('status_id')
                ->references('id')->on('status')
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
        Schema::dropIfExists('medicamentos');
    }
}
