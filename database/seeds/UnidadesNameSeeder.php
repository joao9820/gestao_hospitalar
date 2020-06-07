<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UnidadesNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->unidades = [
                ['name' => 'Unidade de Ceilândia', 'cidade' => 'Ceilândia', 'telefone' => '(61) 4042-6773', 'email' => 'ceafceilandia@gmail.com', 'endereco' => 'EQNM 18/20, blocos A e C – Praça do Cidadão, Ceilândia/DF'], 
                ['name' => 'Unidade da Asa Sul', 'cidade' => 'Asa Sul', 'telefone' => '(61) 4042-6774', 'email' => 'gemex.ses@gmail.com', 'endereco' => 'Estação 102 Sul do Metrô, Subsolo – Ala Comercial, Asa Sul, Brasília/DF'],
                ['name' => 'Unidade do Gama', 'cidade' => 'Gama', 'telefone' => '(61) 4042-6771', 'email' => 'nfcegama@gmail.com', 'endereco' => 'Praça 1, s/n – Setor Leste, Gama/DF']];

        foreach ($this->unidades as $unidade):
            DB::table('unidades')->insert([
                'name' => $unidade['name'],
                'cidade' => $unidade['cidade'],
                'telefone' => $unidade['telefone'],
                'email' => $unidade['email'],
                'endereco' => $unidade['endereco'],
                'primeiro_turno_inicio' => '07:00:00',
                'primeiro_turno_fim' => '12:00:00',
                'segundo_turno_inicio' => '13:00:00',
                'segundo_turno_fim' => '19:00:00',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        endforeach;

        $this->command->info(count($this->unidades) . ' unidades created');
    }
}
