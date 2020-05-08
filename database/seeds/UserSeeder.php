<?php

use App\User;
use App\UserModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
  
    public function run()
    {
        $array = [
            [
                "id" => 1,
                "username" => "admin",
                "mail" => "admin@test.com",
                "password" => "admin",
                "id_role" => "1"


            ]
        ];

        DB::table('users')->insert(
            $array
        );
        factory(User::class, 3)->create();
    }
    
}
