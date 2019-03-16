<?php

use App\Airline;
use App\Airport;
use App\Flight;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class FlightsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Flight::truncate();

        Flight::create([
            'number' => 301,
            'departure_time' => Carbon::createFromTime(07, 35),
            'arrival_time' => Carbon::createFromTime(10, 05),
            'price' => 273.23,
            'airline_id' => Airline::findByCode('AC')->id,
            'departure_airport_id' => Airport::findByCode('YUL')->id,
            'arrival_airport_id' => Airport::findByCode('YVR')->id,
            'created_by' => User::get()->first()->id,
        ]);

        Flight::create([
            'number' => 302,
            'departure_time' => Carbon::createFromTime(11, 30),
            'arrival_time' => Carbon::createFromTime(19, 11),
            'price' => 220.63,
            'airline_id' => Airline::findByCode('AC')->id,
            'departure_airport_id' => Airport::findByCode('YVR')->id,
            'arrival_airport_id' => Airport::findByCode('YUL')->id,
            'created_by' => User::get()->first()->id,
        ]);
    }
}
