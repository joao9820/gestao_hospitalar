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
        $this->unidades = ['Ceilândia', 'Asa Sul', 'Asa Norte'];

        foreach ($this->unidades as $unidade):
            DB::table('unidades')->insert([
                'name' => $unidade,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        endforeach;

        $this->command->info(count($this->unidades) . ' unidades created');
    }
}
