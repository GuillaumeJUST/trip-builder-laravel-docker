<?php

namespace Tests\Feature;

use App\Airline;
use App\Airport;
use App\Flight;
use App\User;
use Faker\Factory;
use Tests\TestCase;

class FlightTest extends TestCase
{

    public function testsFlightsAreCreatedCorrectly(): void
    {
        $faker = Factory::create();
        $flightData = [
            'number' => $faker->numberBetween(100, 10000),
            'departure_time' => $faker->time('H:i'),
            'departure_airport_id' => factory(Airport::class)->create()->id,
            'arrival_time' => $faker->time('H:i'),
            'arrival_airport_id' => factory(Airport::class)->create()->id,
            'airline_id' => factory(Airline::class)->create()->id,
            'price' => $faker->numberBetween(10, 1000),
            'created_by' => factory(User::class)->create()->id,
        ];

        $this->json('POST', '/api/v1/flights', $flightData, $this->getHeaders())
            ->assertStatus(201)
            ->assertJson([
                'number' => $flightData['number'],
                'price' => $flightData['price'],
            ]);
    }

    public function testsFlightsTryToCreate(): void
    {
        $faker = Factory::create();
        $flightData = [
            'number' => $faker->numberBetween(100, 10000),
            'departure_time' => $faker->time(),
        ];

        $this->json('POST', '/api/v1/flights', $flightData, $this->getHeaders())
            ->assertStatus(400)
            ->assertJson([
                'success' => false,
            ])
            ->assertJsonStructure(['success', 'status', 'message']);
    }

    public function testsFlightsAreUpdatedCorrectly(): void
    {
        $flight = factory(Flight::class)->create();

        $faker = Factory::create();
        $flightData = [
            'number' => $faker->numberBetween(100, 10000),
            'departure_time' => $faker->time('H:i'),
            'departure_airport_id' => factory(Airport::class)->create()->id,
            'arrival_time' => $faker->time('H:i'),
            'arrival_airport_id' => factory(Airport::class)->create()->id,
            'airline_id' => factory(Airline::class)->create()->id,
            'price' => $faker->numberBetween(10, 1000),
            'created_by' => factory(User::class)->create()->id,
        ];

        $this->json('PUT', '/api/v1/flights/' . $flight->id, $flightData, $this->getHeaders())
            ->assertStatus(200)
            ->assertJson([
                'number' => $flightData['number'],
                'price' => $flightData['price'],
            ]);
    }

    public function testsArtilcesAreDeletedCorrectly(): void
    {
        $flight = factory(Flight::class)->create();

        $this->json('DELETE', '/api/v1/flights/' . $flight->id, [], $this->getHeaders())
            ->assertStatus(204);
    }


    public function testFlightsAreListedCorrectly(): void
    {
        $flight1 = factory(Flight::class)->create();
        $flight2 = factory(Flight::class)->create();

        $this->json('GET', '/api/v1/flights', [], $this->getHeaders())
            ->assertStatus(200)
            ->assertJson(['data' => [
                [ 'number' => $flight1->number, 'price' => $flight1->price],
                [ 'number' => $flight2->number, 'price' => $flight2->price]
            ]])
            ->assertJsonStructure(['data' => [
                '*' => ['number', 'departure_time', 'arrival_time', 'price', 'updated_at', 'created_by'],
            ]]);
    }
}
