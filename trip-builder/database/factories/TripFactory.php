<?php

use App\Airport;
use App\Trip;
use Faker\Generator as Faker;

$factory->define(Trip::class, function (Faker $faker) {
    return [
        'departure_datetime' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+1 years'),
        'departure_airport_id' => factory(Airport::class)->create()->id,
        'arrival_airport_id' => factory(Airport::class)->create()->id,
        'is_round_trip' => $faker->boolean,
    ];
});

