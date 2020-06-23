<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerDeleteSolicitacoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
        CREATE TRIGGER Tgr_delete_solicitacoes BEFORE DELETE ON solicitacoes FOR EACH ROW
            BEGIN
                UPDATE unidade_medicamentos uni_med INNER JOIN solicitacoes ON solicitacoes.unidade_id = uni_med.unidade_id INNER JOIN solicitacao_itens itens ON itens.solicitacao_id = solicitacoes.id AND itens.medicamento_id = uni_med.medicamento_id SET uni_med.quantidade = (uni_med.quantidade + itens.quantidade_item) 
            WHERE itens.solicitacao_id = OLD.id;
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
         DB::unprepared('DROP TRIGGER Tgr_delete_solicitacoes');
    }
}
