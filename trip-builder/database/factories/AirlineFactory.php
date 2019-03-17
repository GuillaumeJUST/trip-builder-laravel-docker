<?php

use App\Airline;
use App\User;
use Faker\Generator as Faker;

$factory->define(Airline::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'code' => $faker->unique()->word,
        'created_by' => factory(User::class)->create()->id,
    ];
});
