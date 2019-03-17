<?php

use App\Airline;
use App\Airport;
use App\Flight;
use App\User;
use Faker\Generator as Faker;

$factory->define(Flight::class, function (Faker $faker) {
    return [
        'number' => $faker->numberBetween(100, 10000),
        'departure_time' => $faker->time('H:i'),
        'departure_airport_id' => factory(Airport::class)->create()->id,
        'arrival_time' => $faker->time('H:i'),
        'arrival_airport_id' => factory(Airport::class)->create()->id,
        'airline_id' => factory(Airline::class)->create()->id,
        'price' => $faker->numberBetween(10, 1000),
        'created_by' => factory(User::class)->create()->id,
    ];
});

