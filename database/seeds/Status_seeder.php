<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Status_seeder extends Seeder
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
                "key" => "processing",
                "name" => "En cours",

            ],
            [
                "id" => 2,
                "key" => "done",
                "name" => "Effectué",
            ],
            [
                "id" => 3,
                "key" => "refund",
                "name" => "Remboursé",
            ],
        ];

        DB::table('status')->insert(
            $array
        );
    }
}
