<?php

use App\City;
use App\Region;
use Faker\Generator as Faker;

$factory->define(City::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'code' => $faker->unique()->word,
        'region_id' => factory(Region::class)->create()->id,
    ];
});

