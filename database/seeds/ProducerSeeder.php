<?php

use App\FruitModel;
use App\ProducerModel;
use App\ProductModel;
use App\RewardModel;
use Illuminate\Database\Seeder;

class ProducerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ProducerModel::class, 5)->create()
        ->each(function($u){
            $u->products()->saveMany(factory(ProductModel::class,1)->make()
        )
        ->each(function($p){
                $p->rewards()->saveMany(factory(RewardModel::class,1)->make());
        })
        ->each(function($p){
            $p->fruits()->saveMany(factory(FruitModel::class,1)->make());
    });
        });
        
    }
}
