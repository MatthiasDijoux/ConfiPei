<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ProducerModel;
use App\ProductModel;
use Faker\Generator as Faker;

$factory->define(ProductModel::class, function (Faker $faker) {


    return [
        "name" => $faker->firstname,
        "id_producer" => factory(ProducerModel::class),
        "image" => "uv1EkQOFDRSGAZOt.jpg",
        "prix" => rand(10, 100)
    ];
});
