<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ProducerModel;
use Faker\Generator as Faker;

$factory->define(ProducerModel::class, function (Faker $faker) {
    return [
        "name" => $faker->firstname,
        "id_user"=>rand(1,5)
    ];
});
