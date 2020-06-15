<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MedicamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->data = file_get_contents("http://pacific-ravine-94784.herokuapp.com/medicamentos.json");

        $this->dados = json_decode($this->data);

        foreach ($this->dados as $med):

            DB::table('medicamentos')->insert([
                'id' => $med->id,
                'forma_farmaceutica_id' => $med->forma_farmaceutica_id,
                'status_id' => $med->status_id,
                'nome' => $med->nome,
                'descricao' => $med->descricao,
                'quantidade' => $med->quantidade,
                'valor' => $med->valor,
                'estoque_min' => $med->estoque_min,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        endforeach;

        $this->command->info(count($this->dados) . ' medicamentos created');

    }
}
