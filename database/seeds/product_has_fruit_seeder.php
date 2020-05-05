<?php

use App\product_has_fruit;
use Illuminate\Database\Seeder;

class product_has_fruit_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(product_has_fruit::class, 3)->create();
    }
}
