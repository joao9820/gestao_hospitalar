<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunctionDeleteSolicitacoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
        CREATE OR REPLACE FUNCTION delete_item_solicitacao()
        RETURNS trigger AS
        $$
            BEGIN
                UPDATE unidade_medicamentos uni_med SET uni_med.quantidade = (uni_med.quantidade + itens.quantidade_item) FROM uni_med INNER JOIN solicitacoes ON solicitacoes.unidade_id = uni_med.unidade_id INNER JOIN solicitacao_itens itens ON itens.solicitacao_id = solicitacoes.id AND itens.medicamento_id = uni_med.medicamento_id
            WHERE itens.solicitacao_id = OLD.id;

            RETURN NULL;

            END
        $$ LANGUAGE plpgsql;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP FUNCTION update_item_solicitacao');
    }
}
