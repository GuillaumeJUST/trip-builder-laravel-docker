<?php

namespace Tests\Unit;

use App\Airline;
use App\Airport;
use App\Flight;
use App\Services\TripService;
use App\Trip;
use Tests\TestCase;

class TripServiceTest extends TestCase
{
    /**
     * @var TripService
     */
    private $service;

    public function setUp(): void
    {
        $this->service = new TripService();
        parent::setUp();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testOneWayFlightOneFlightFound(): void
    {
        $departureAirport = factory(Airport::class)->create();
        $arrivalAirport = factory(Airport::class)->create();

        factory(Flight::class)->create([
            'departure_airport_id' => $departureAirport->id,
            'arrival_airport_id' => $arrivalAirport->id,
            'price' => 10,
        ]);

        $trip = factory(Trip::class)->create([
            'departure_airport_id' => $departureAirport->id,
            'arrival_airport_id' => $arrivalAirport->id,
            'is_round_trip' => false
        ]);

        $flightsAndPrices = $this->service->findFlightsAndPrices($trip);
        $this->assertCount(1, $flightsAndPrices);
        $this->assertEquals(10, $flightsAndPrices[0]['total_price']);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testOneWayFlightTwoFlightFound(): void
    {
        $departureAirport = factory(Airport::class)->create();
        $arrivalAirport = factory(Airport::class)->create();

        factory(Flight::class, 2)->create([
            'departure_airport_id' => $departureAirport->id,
            'arrival_airport_id' => $arrivalAirport->id,
            'price' => 10,
        ]);

        factory(Flight::class)->create([
            'departure_airport_id' => $departureAirport->id,
            'price' => 12,
        ]);

        $trip = factory(Trip::class)->create([
            'departure_airport_id' => $departureAirport->id,
            'arrival_airport_id' => $arrivalAirport->id,
            'is_round_trip' => false
        ]);

        $flightsAndPrices = $this->service->findFlightsAndPrices($trip);
        $this->assertCount(2, $flightsAndPrices);
        $this->assertEquals(10, $flightsAndPrices[0]['total_price']);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRoundTripFlight(): void
    {
        $departureAirport = factory(Airport::class)->create();
        $arrivalAirport = factory(Airport::class)->create();

        $flightMaxIndex = 5;
        $flightPrice = 10;
        $flightReturnPrice = 12;
        $FlightReturnMaxIndex = 7;

        factory(Flight::class, $flightMaxIndex)->create([
            'departure_airport_id' => $departureAirport->id,
            'arrival_airport_id' => $arrivalAirport->id,
            'price' => $flightPrice,
        ]);

        factory(Flight::class, $FlightReturnMaxIndex)->create([
            'departure_airport_id' => $arrivalAirport->id,
            'arrival_airport_id' => $departureAirport->id,
            'price' => $flightReturnPrice,
        ]);

        factory(Flight::class)->create([
            'departure_airport_id' => $departureAirport->id,
            'price' => 14,
        ]);

        $trip = factory(Trip::class)->create([
            'departure_airport_id' => $departureAirport->id,
            'arrival_airport_id' => $arrivalAirport->id,
            'is_round_trip' => true
        ]);

        $flightsAndPrices = $this->service->findFlightsAndPrices($trip);
        $this->assertCount($flightMaxIndex * $FlightReturnMaxIndex, $flightsAndPrices);
        $this->assertEquals($flightPrice + $flightReturnPrice, $flightsAndPrices[0]['total_price']);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testOneWayFlightOnePreferredAirline(): void
    {
        $preferredAirline = factory(Airline::class)->create();
        $departureAirport = factory(Airport::class)->create();
        $arrivalAirport = factory(Airport::class)->create();

        factory(Flight::class, 2)->create([
            'departure_airport_id' => $departureAirport->id,
            'arrival_airport_id' => $arrivalAirport->id,
            'airline_id' => $preferredAirline->id,
        ]);

        factory(Flight::class, 5)->create([
            'departure_airport_id' => $departureAirport->id,
            'arrival_airport_id' => $arrivalAirport->id,
        ]);

        $trip = factory(Trip::class)->create([
            'departure_airport_id' => $departureAirport->id,
            'arrival_airport_id' => $arrivalAirport->id,
            'preferred_airline_id' => $preferredAirline->id,
            'is_round_trip' => false
        ]);

        $flightsAndPrices = $this->service->findFlightsAndPrices($trip);
        $this->assertCount(2, $flightsAndPrices);
    }



    /**
     * A basic test example.
     *
     * @return void
     */
    public function testOneWayFlightOneSortPrice(): void
    {
        $departureAirport = factory(Airport::class)->create();
        $arrivalAirport = factory(Airport::class)->create();

        factory(Flight::class)->create([
            'departure_airport_id' => $departureAirport->id,
            'arrival_airport_id' => $arrivalAirport->id,
            'price' => 12
        ]);

        factory(Flight::class)->create([
            'departure_airport_id' => $departureAirport->id,
            'arrival_airport_id' => $arrivalAirport->id,
            'price' => 10
        ]);

        factory(Flight::class)->create([
            'departure_airport_id' => $departureAirport->id,
            'arrival_airport_id' => $arrivalAirport->id,
            'price' => 15
        ]);

        factory(Flight::class)->create([
            'departure_airport_id' => $departureAirport->id,
            'price' => 20
        ]);


        $trip = factory(Trip::class)->create([
            'departure_airport_id' => $departureAirport->id,
            'arrival_airport_id' => $arrivalAirport->id,
            'is_round_trip' => false
        ]);

        $this->service->setSort(['type' => 'price', 'direction' => 'asc']);
        $flightsAndPrices = $this->service->findFlightsAndPrices($trip);
        $this->assertCount(3, $flightsAndPrices);
        $this->assertEquals(10, $flightsAndPrices[0]['total_price']);
        $this->assertEquals(15, $flightsAndPrices[\count($flightsAndPrices) - 1]['total_price']);

        $this->service->setSort(['type' => 'price', 'direction' => 'desc']);
        $flightsAndPrices = $this->service->findFlightsAndPrices($trip);
        $this->assertCount(3, $flightsAndPrices);
        $this->assertEquals(15, $flightsAndPrices[0]['total_price']);
        $this->assertEquals(10, $flightsAndPrices[\count($flightsAndPrices) - 1]['total_price']);
    }
}
