<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerUpdateSolicitacoesMedicamentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
        CREATE TRIGGER Tgr_update_solicitacao_medicamento AFTER UPDATE ON solicitacao_itens FOR EACH ROW
            BEGIN
            UPDATE unidade_medicamentos SET quantidade = ((quantidade + OLD.quantidade_item) - NEW.quantidade_item)
                WHERE unidade_id = (SELECT unidade_id FROM solicitacoes WHERE id = NEW.solicitacao_id) AND medicamento_id = NEW.medicamento_id;
            END
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         DB::unprepared('DROP TRIGGER Tgr_update_solicitacao_medicamento');
    }
}
