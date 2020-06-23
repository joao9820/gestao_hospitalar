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
           EXECUTE PROCEDURE delete_item_solicitacao()
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
