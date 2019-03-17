<?php

namespace Tests\Feature;

use App\Airport;
use App\City;
use App\User;
use Faker\Factory;
use Tests\TestCase;

class AirportTest extends TestCase
{

    public function testsAirportsAreCreatedCorrectly()
    {
        $faker = Factory::create();
        $airportData = [
            'name' => $faker->name,
            'code' => $faker->unique()->word,
            'latitude' => $faker->latitude,
            'longitude' => $faker->longitude,
            'timezone' => $faker->timezone,
            'created_by' => factory(User::class)->create()->id,
            'city_id' => factory(City::class)->create()->id,
        ];

        $this->json('POST', '/api/v1/airports', $airportData, $this->getHeaders())
            ->assertStatus(201)
            ->assertJson([
                'name' => $airportData['name'],
                'code' => $airportData['code'],
            ]);
    }

    public function testsAirportsTryToCreate()
    {
        $faker = Factory::create();
        $airportData = [
            'name' => $faker->name,
            'code' => $faker->unique()->word,
            'latitude' => $faker->latitude,
        ];

        $this->json('POST', '/api/v1/airports', $airportData, $this->getHeaders())
            ->assertStatus(400)
            ->assertJson([
                'success' => false,
            ])
            ->assertJsonStructure(['success', 'status', 'message']);
    }

    public function testsAirportsAreUpdatedCorrectly()
    {
        $airport = factory(Airport::class)->create();

        $faker = Factory::create();
        $airportData = [
            'name' => $faker->name,
            'code' => $faker->unique()->word,
            'latitude' => $faker->latitude,
            'longitude' => $faker->longitude,
            'timezone' => $faker->timezone,
            'created_by' => factory(User::class)->create()->id,
            'city_id' => factory(City::class)->create()->id,
        ];

        $this->json('PUT', '/api/v1/airports/' . $airport->id, $airportData, $this->getHeaders())
            ->assertStatus(200)
            ->assertJson([
                'name' => $airportData['name'],
                'code' => $airportData['code'],
            ]);
    }

    public function testsArtilcesAreDeletedCorrectly()
    {
        $airport = factory(Airport::class)->create();

        $this->json('DELETE', '/api/v1/airports/' . $airport->id, [], $this->getHeaders())
            ->assertStatus(204);
    }


    public function testAirportsAreListedCorrectly()
    {
        $airport1 = factory(Airport::class)->create();
        $airport2 = factory(Airport::class)->create();

        $this->json('GET', '/api/v1/airports', [], $this->getHeaders())
            ->assertStatus(200)
            ->assertJson(['data' => [
                [ 'name' => $airport1->name, 'code' => $airport1->code],
                [ 'name' => $airport2->name, 'code' => $airport2->code]
            ]])
            ->assertJsonStructure(['data' => [
                '*' => ['id', 'name', 'code', 'created_at', 'updated_at', 'created_by'],
            ]]);
    }
}
