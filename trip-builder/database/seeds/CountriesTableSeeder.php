<?php

use App\Country;
use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::truncate();

        Country::create([
            'code' => 'CA',
            'name' => 'Canada',
        ]);
    }
}
