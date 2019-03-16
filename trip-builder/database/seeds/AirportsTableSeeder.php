<?php

use App\Airport;
use App\City;
use App\User;
use Illuminate\Database\Seeder;

class AirportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Airport::truncate();

        Airport::create([
            'code' => 'YUL',
            'name' => 'Pierre Elliott Trudeau International',
            'latitude' => 45.457714,
            'longitude' => -73.749908,
            'timezone' => 'America/Montreal',
            'city_id' => City::findByCode('YMQ')->id,
            'created_by' => User::get()->first()->id,
        ]);


        Airport::create([
            'code' => 'YVR',
            'name' => 'Vancouver International',
            'longitude' => 49.194698,
            'latitude' => -123.179192,
            'timezone' => 'America/Vancouver',
            'city_id' => City::findByCode('YVR')->id,
            'created_by' => User::get()->first()->id,
        ]);
    }
}
