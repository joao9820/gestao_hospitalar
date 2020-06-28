<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class UnidadesMedicamentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //$this->data = file_get_contents("http://pacific-ravine-94784.herokuapp.com/unidade_medicamentos.json");

        $this->data = Storage::get('public/unidade_medicamentos.json');

        $this->dados = json_decode($this->data);

        foreach ($this->dados as $med):

            DB::table('unidade_medicamentos')->insert([
                'unidade_id' => $med->unidade_id,
                'medicamento_id' => $med->medicamento_id
            ]);
        endforeach;

        $this->command->info(count($this->dados) . 'unidades medicamentos created');
    }
}
