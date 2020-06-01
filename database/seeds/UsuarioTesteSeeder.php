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

    $this->cont = 0;

    public function run()
    {
        $user = new User([
    		'name' => 'Admin',
    		'email' => 'admin@gmail.com',
            'is_admin' => true,
    		'password' => bcrypt('123456'),
    		'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
    	]);

        if($user->save())
            $this->cont++;

        $user = new User([
            'name' => 'Teste',
            'email' => 'teste@gmail.com',
            'password' => bcrypt('123456'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        if($user->save())
            $this->cont++;

        $this->command->info($this->cont . ' User(s) created');
    }
}
