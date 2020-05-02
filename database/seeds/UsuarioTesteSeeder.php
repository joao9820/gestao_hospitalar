<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\User;

class UsuarioTesteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User([
    		'name' => 'Teste',
    		'email' => 'teste@gmail.com',
    		'password' => bcrypt('123456'),
    		'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
    	]);

        $user->save();

        $this->command->info('1 user created');
    }
}
