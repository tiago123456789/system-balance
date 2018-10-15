<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($indice = 0; $indice < 10; $indice++) {
            \App\User::create([
               "name" => "userteste" . $indice,
               "email" => "userteste" . $indice . "@gmail.com",
               "password" => bcrypt("userteste" . $indice)
            ]);
        }
    }
}
