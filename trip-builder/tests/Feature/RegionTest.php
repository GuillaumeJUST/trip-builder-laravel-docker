<?php

namespace Tests\Feature;

use App\Country;
use App\Region;
use Faker\Factory;
use Tests\TestCase;

class RegionTest extends TestCase
{

    public function testsCountriesAreCreatedCorrectly()
    {
        $faker = Factory::create();
        $regionData = [
            'name' => $faker->name,
            'code' => $faker->unique()->name,
            'country_id' => factory(Country::class)->create()->id,
        ];

        $this->json('POST', '/api/v1/regions', $regionData, $this->getHeaders())
            ->assertStatus(201)
            ->assertJson([
                'name' => $regionData['name'],
                'code' => $regionData['code'],
            ]);
    }

    public function testsCountriesTryToCreate()
    {
        $faker = Factory::create();
        $regionData = [
            'code' => $faker->unique()->name,
        ];

        $this->json('POST', '/api/v1/regions', $regionData, $this->getHeaders())
            ->assertStatus(400)
            ->assertJson([
                'success' => false,
            ])
            ->assertJsonStructure(['success', 'status', 'message']);
    }

    public function testsCountriesAreUpdatedCorrectly()
    {
        $region = factory(Region::class)->create();

        $faker = Factory::create();
        $regionData = [
            'name' => $faker->name,
            'code' => $faker->unique()->name,
            'country_id' => factory(Country::class)->create()->id,
        ];

        $this->json('PUT', '/api/v1/regions/' . $region->id, $regionData, $this->getHeaders())
            ->assertStatus(200)
            ->assertJson([
                'name' => $regionData['name'],
                'code' => $regionData['code'],
            ]);
    }

    public function testsArtilcesAreDeletedCorrectly()
    {
        $region = factory(Region::class)->create();

        $this->json('DELETE', '/api/v1/regions/' . $region->id, [], $this->getHeaders())
            ->assertStatus(204);
    }


    public function testCountriesAreListedCorrectly()
    {
        $region1 = factory(Region::class)->create();
        $region2 = factory(Region::class)->create();

        $this->json('GET', '/api/v1/regions', [], $this->getHeaders())
            ->assertStatus(200)
            ->assertJson(['data' => [
                    [ 'name' => $region1->name, 'code' => $region1->code],
                    [ 'name' => $region2->name, 'code' => $region2->code]
            ]])
            ->assertJsonStructure(['data' => [
                    '*' => ['id', 'name', 'code', 'created_at', 'updated_at'],
            ]]);
    }
}
