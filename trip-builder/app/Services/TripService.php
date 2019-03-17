<?php

namespace App\Services;

use App\Airline;
use App\Airport;
use App\Flight;
use App\Trip;
use Illuminate\Database\Eloquent\Collection;

/**
 * Created by PhpStorm.
 * User: gjust
 * Date: 2019-03-16
 * Time: 23:31
 */

class TripService
{
    public CONST SORT_DEFAULT_TYPE = 'price';
    public CONST SORT_DEFAULT_DIRECTION = 'asc';

    private $sortType = self::SORT_DEFAULT_TYPE;
    private $sortDirection = self::SORT_DEFAULT_DIRECTION;


    public function findFlightsAndPrices(Trip $trip): array {
        $flights = $this->findFlights(
            $trip->departureAirport,
            $trip->arrivalAirport,
            $trip->preferredAirline
        );
        if ($trip->is_round_trip) {
            $returnFlights = $this->findFlights(
                $trip->arrivalAirport,
                $trip->departureAirport,
                $trip->preferredAirline
            );
            $fightsAndPrices = $this->buildRoundTrips($flights, $returnFlights);
        } else {
            $fightsAndPrices = $this->buildTrips($flights);
        }

        return $this->sort($fightsAndPrices);
    }

    private function buildRoundTrips(Collection $flights, Collection $returnFlights): array {
        $trips = $flights->crossJoin($returnFlights);
        $fightsAndPrices = [];
        foreach ($trips as $tripFlights) {
            $fightsAndPrices[] = $this->buildFlightAndPrice($tripFlights);
        }

        return $fightsAndPrices;
    }

    private function buildTrips(Collection $trips): array {
        $fightsAndPrices = [];
        foreach ($trips as $flight) {
            $fightsAndPrices[] = $this->buildFlightAndPrice([$flight]);
        }

        return $fightsAndPrices;
    }

    private function buildFlightAndPrice(array $flights): array {
        $price = 0;
        foreach ($flights as $flight) {
            $price += $flight->price;
        }
        return [
            'flights' => $flights,
            'total_price' => $price,
        ];
    }

    private function findFlights(Airport $departureAirport, Airport $arrivalAirport, ?Airline $preferredAirline): Collection {
        /** @var \Illuminate\Database\Eloquent\Builder $query */
        $query = Flight::where('departure_airport_id', '=', $departureAirport->id)
            ->where('arrival_airport_id', '=', $arrivalAirport->id);
        if (null !== $preferredAirline) {
            $query->where('airline_id', '=', $preferredAirline->id);
        }
        return $query->get();
    }

    /**
     * @param array $fightsAndPrices
     *
     * @return array
     */
    private function sort(array $fightsAndPrices): array
    {
        usort($fightsAndPrices, function($firstTrip, $secondTrip) {
            $firstValue = $firstTrip['total_price'];
            $secondValue = $secondTrip['total_price'];

            if ($firstValue === $secondValue) {
                return 0;
            }

            if ($this->sortDirection === 'desc') {
                return ($firstValue > $secondValue) ? -1 : 1;
            }

            return ($firstValue < $secondValue) ? -1 : 1;
        });
        return $fightsAndPrices;
    }

    /**
     * @param string $sortDirection
     */
    public function setSortDirection(?string $sortDirection): void
    {
        $this->sortDirection = $sortDirection ?? self::SORT_DEFAULT_DIRECTION;
    }

    /**
     * @param string $sortType
     */
    public function setSortType(?string $sortType): void
    {
        $this->sortType = $sortType ?? self::SORT_DEFAULT_TYPE;
    }

    /**
     * @param array|null $sort
     */
    public function setSort(?array $sort): void
    {
        $this->sortType = $sort['type'] ?? self::SORT_DEFAULT_TYPE;
        $this->sortDirection = $sort['direction'] ?? self::SORT_DEFAULT_DIRECTION;
    }
}
