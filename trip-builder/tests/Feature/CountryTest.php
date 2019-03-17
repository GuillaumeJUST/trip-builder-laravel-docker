<?php

namespace Tests\Feature;

use App\Country;
use Faker\Factory;
use Tests\TestCase;

class CountryTest extends TestCase
{

    public function testsCountriesAreCreatedCorrectly()
    {
        $faker = Factory::create();
        $countryData = [
            'name' => $faker->name,
            'code' => $faker->unique()->name,
        ];

        $this->json('POST', '/api/v1/countries', $countryData, $this->getHeaders())
            ->assertStatus(201)
            ->assertJson([
                'name' => $countryData['name'],
                'code' => $countryData['code'],
            ]);
    }

    public function testsCountriesTryToCreate()
    {
        $faker = Factory::create();
        $countryData = [
            'code' => $faker->unique()->name,
        ];

        $this->json('POST', '/api/v1/countries', $countryData, $this->getHeaders())
            ->assertStatus(400)
            ->assertJson([
                'success' => false,
            ])
            ->assertJsonStructure(['success', 'status', 'message']);
    }

    public function testsCountriesAreUpdatedCorrectly()
    {
        $country = factory(Country::class)->create();

        $faker = Factory::create();
        $countryData = [
            'name' => $faker->name,
            'code' => $faker->unique()->name,
        ];

        $this->json('PUT', '/api/v1/countries/' . $country->id, $countryData, $this->getHeaders())
            ->assertStatus(200)
            ->assertJson([
                'name' => $countryData['name'],
                'code' => $countryData['code'],
            ]);
    }

    public function testsArtilcesAreDeletedCorrectly()
    {
        $country = factory(Country::class)->create();

        $this->json('DELETE', '/api/v1/countries/' . $country->id, [], $this->getHeaders())
            ->assertStatus(204);
    }


    public function testCountriesAreListedCorrectly()
    {
        $country1 = factory(Country::class)->create();
        $country2 = factory(Country::class)->create();

        $this->json('GET', '/api/v1/countries', [], $this->getHeaders())
            ->assertStatus(200)
            ->assertJson(['data' => [
                [ 'name' => $country1->name, 'code' => $country1->code],
                [ 'name' => $country2->name, 'code' => $country2->code]
            ]])
            ->assertJsonStructure(['data' => [
                '*' => ['id', 'name', 'code', 'created_at', 'updated_at'],
            ]]);
    }
}
