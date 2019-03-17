<?php

use App\Country;
use App\Region;
use Faker\Generator as Faker;

$factory->define(Region::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'code' => $faker->unique()->word,
        'country_id' => factory(Country::class)->create()->id,
    ];
});

