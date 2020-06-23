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
            EXECUTE PROCEDURE update_item_solicitacao()
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
