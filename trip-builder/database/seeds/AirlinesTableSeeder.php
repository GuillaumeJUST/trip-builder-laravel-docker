<?php

use App\Airline;
use App\User;
use Illuminate\Database\Seeder;

class AirlinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Airline::truncate();

        Airline::create([
            'code' => 'AC',
            'name' => 'Air Canada',
            'created_by' => User::get()->first()->id,
        ]);
    }
}
