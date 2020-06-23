<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunctionInsertSolicitacoesMedicamentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
        CREATE OR REPLACE FUNCTION insert_item_solicitacao()
        RETURNS trigger AS
            BEGIN
                UPDATE unidade_medicamentos SET quantidade = (quantidade - NEW.quantidade_item)
                WHERE unidade_id = (SELECT unidade_id FROM solicitacoes WHERE id = NEW.solicitacao_id) AND medicamento_id = NEW.medicamento_id;

                RETURN NEW;

            END;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP FUNCTION insert_item_solicitacao');
    }
}
