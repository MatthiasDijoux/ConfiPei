<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\product_has_fruit;
use App\ProductModel;
use App\RewardModel;
use Faker\Generator as Faker;

$factory->define(product_has_fruit::class, function (Faker $faker) {
    return [
        "id_product" => factory(ProductModel::class),
        "id_fruit" => factory(RewardModel::class)
    ];
});
