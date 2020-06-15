<?php

use Illuminate\Database\Seeder;
use App\Status;
use Carbon\Carbon;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$this->cont = 0;

         $status = new Status([
    		'nome' => 'Disponível',
    		'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
    	]);

         if($status->save())
         	$this->cont++;

          $this->command->info($this->cont . ' Status created');
    }
}
