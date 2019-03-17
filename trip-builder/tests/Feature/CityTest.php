<?php

namespace Tests\Feature;

use App\City;
use App\Region;
use Faker\Factory;
use Tests\TestCase;

class CityTest extends TestCase
{

    public function testsCountriesAreCreatedCorrectly()
    {
        $faker = Factory::create();
        $cityData = [
            'name' => $faker->name,
            'code' => $faker->unique()->name,
            'region_id' => factory(Region::class)->create()->id,
        ];

        $this->json('POST', '/api/v1/cities', $cityData, $this->getHeaders())
            ->assertStatus(201)
            ->assertJson([
                'name' => $cityData['name'],
                'code' => $cityData['code'],
            ]);
    }

    public function testsCountriesTryToCreate()
    {
        $faker = Factory::create();
        $cityData = [
            'code' => $faker->unique()->name,
        ];

        $this->json('POST', '/api/v1/cities', $cityData, $this->getHeaders())
            ->assertStatus(400)
            ->assertJson([
                'success' => false,
            ])
            ->assertJsonStructure(['success', 'status', 'message']);
    }

    public function testsCountriesAreUpdatedCorrectly()
    {
        $city = factory(City::class)->create();

        $faker = Factory::create();
        $cityData = [
            'name' => $faker->name,
            'code' => $faker->unique()->name,
            'region_id' => factory(Region::class)->create()->id,
        ];

        $this->json('PUT', '/api/v1/cities/' . $city->id, $cityData, $this->getHeaders())
            ->assertStatus(200)
            ->assertJson([
                'name' => $cityData['name'],
                'code' => $cityData['code'],
            ]);
    }

    public function testsArtilcesAreDeletedCorrectly()
    {
        $city = factory(City::class)->create();

        $this->json('DELETE', '/api/v1/cities/' . $city->id, [], $this->getHeaders())
            ->assertStatus(204);
    }


    public function testCountriesAreListedCorrectly()
    {
        $city1 = factory(City::class)->create();
        $city2 = factory(City::class)->create();

        $this->json('GET', '/api/v1/cities', [], $this->getHeaders())
            ->assertStatus(200)
            ->assertJson(['data' => [
                [ 'name' => $city1->name, 'code' => $city1->code],
                [ 'name' => $city2->name, 'code' => $city2->code]
            ]])
            ->assertJsonStructure(['data' => [
                '*' => ['id', 'name', 'code', 'created_at', 'updated_at'],
            ]]);
    }
}
