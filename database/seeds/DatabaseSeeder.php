<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call([
            RoleSeeder::class,
            OrderSeeder::class,
            RewardSeeder::class,
            FruitSeeder::class,
            UserSeeder::class,
            ProductSeeder::class,
            product_has_fruit_seeder::class,
            ]);
    }
}
