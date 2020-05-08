<?php

use App\OrderModel;
use App\ProductModel;
use App\User;
use App\UserModel;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(OrderModel::class, 5)->create()
            ->each(function ($u) {
                $u->products()->saveMany(factory(ProductModel::class, 1)->make()
                )
            ->each(function ($p) {
                $p->users()->saveMany(factory(User::class, 1)->make());
                });
            });
    }
}
