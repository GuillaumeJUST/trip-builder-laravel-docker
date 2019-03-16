<?php

use App\City;
use App\Region;
use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::truncate();

        City::create([
            'code' => 'YMQ',
            'name' => 'Quebec',
            'region_id' => Region::findByCode('QC')->id,
        ]);

        City::create([
            'code' => 'YVR',
            'name' => 'Vancouver',
            'region_id' => Region::findByCode('BC')->id,
        ]);
    }
}
