<?php

namespace Tests\Feature;

use App\Airline;
use App\User;
use Faker\Factory;
use Tests\TestCase;

class AirlineTest extends TestCase
{

    public function testsAirlinesAreCreatedCorrectly()
    {
        $faker = Factory::create();
        $airlineData = [
            'name' => $faker->name,
            'code' => $faker->unique()->name,
            'created_by' => factory(User::class)->create()->id,
        ];

        $this->json('POST', '/api/v1/airlines', $airlineData, $this->getHeaders())
            ->assertStatus(201)
            ->assertJson([
                'name' => $airlineData['name'],
                'code' => $airlineData['code'],
            ]);
    }

    public function testsAirlinesTryToCreate()
    {
        $faker = Factory::create();
        $airlineData = [
            'code' => $faker->unique()->name,
            'created_by' => factory(User::class)->create()->id,
        ];

        $this->json('POST', '/api/v1/airlines', $airlineData, $this->getHeaders())
            ->assertStatus(400)
            ->assertJson([
                'success' => false,
            ])
            ->assertJsonStructure(['success', 'status', 'message']);
    }

    public function testsAirlinesAreUpdatedCorrectly()
    {
        $airline = factory(Airline::class)->create();

        $faker = Factory::create();
        $airlineData = [
            'name' => $faker->name,
            'code' => $faker->unique()->name,
            'created_by' => factory(User::class)->create()->id,
        ];

        $this->json('PUT', '/api/v1/airlines/' . $airline->id, $airlineData, $this->getHeaders())
            ->assertStatus(200)
            ->assertJson([
                'name' => $airlineData['name'],
                'code' => $airlineData['code'],
            ]);
    }

    public function testsArtilcesAreDeletedCorrectly()
    {
        $airline = factory(Airline::class)->create();

        $this->json('DELETE', '/api/v1/airlines/' . $airline->id, [], $this->getHeaders())
            ->assertStatus(204);
    }


    public function testAirlinesAreListedCorrectly()
    {
        $airline1 = factory(Airline::class)->create();
        $airline2 = factory(Airline::class)->create();

        $this->json('GET', '/api/v1/airlines', [], $this->getHeaders())
            ->assertStatus(200)
            ->assertJson(['data' => [
                [ 'name' => $airline1->name, 'code' => $airline1->code],
                [ 'name' => $airline2->name, 'code' => $airline2->code]
            ]])
            ->assertJsonStructure(['data' => [
                '*' => ['id', 'name', 'code', 'created_at', 'updated_at', 'created_by'],
            ]]);
    }
}
