<?php

use App\Country;
use App\Region;
use Illuminate\Database\Seeder;

class RegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Region::truncate();

        Region::create([
            'code' => 'QC',
            'name' => 'Quebec',
            'country_id' => Country::findByCode('CA')->id,
        ]);

        Region::create([
            'code' => 'BC',
            'name' => 'Colombie-Britannique',
            'country_id' => Country::findByCode('CA')->id,
        ]);
    }
}
