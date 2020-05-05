<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\RewardModel;
use Faker\Generator as Faker;

$factory->define(RewardModel::class, function (Faker $faker) {
    return [
        'name' => $faker->firstname,
    ];
});
