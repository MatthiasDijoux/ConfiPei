<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\FruitModel;
use Faker\Generator as Faker;

$factory->define(FruitModel::class, function (Faker $faker) {
    return [
        "name" => $faker->firstname,
    ];
});
