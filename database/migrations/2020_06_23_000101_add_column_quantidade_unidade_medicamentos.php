<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnQuantidadeUnidadeMedicamentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('unidade_medicamentos', function (Blueprint $table) {
            $table->integer("quantidade")->default(20)->nullable()->after("medicamento_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('unidade_medicamentos', function (Blueprint $table) {
            //
        });
    }
}
