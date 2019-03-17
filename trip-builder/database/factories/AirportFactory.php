<?php

use App\Airport;
use App\City;
use App\User;
use Faker\Generator as Faker;

$factory->define(Airport::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'code' => $faker->unique()->word,
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude,
        'timezone' => $faker->timezone,
        'created_by' => factory(User::class)->create()->id,
        'city_id' => factory(City::class)->create()->id,
    ];
});

