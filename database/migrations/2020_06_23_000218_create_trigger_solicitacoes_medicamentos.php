<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerSolicitacoesMedicamentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
        CREATE TRIGGER Tgr_insert_solicitacao_medicamento AFTER INSERT ON solicitacao_itens FOR EACH ROW
            EXECUTE PROCEDURE insert_item_solicitacao()
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         DB::unprepared('DROP TRIGGER Tgr_insert_solicitacao_medicamento');
    }
}
