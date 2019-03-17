<?php

namespace App\Http\Controllers;

use App\Http\Requests\TripRequest;
use App\Services\TripService;
use App\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{
    private $tripService;

    /**
     * TripController constructor.
     *
     * @param TripService $tripService
     */
    public function __construct(TripService $tripService)
    {
        $this->tripService = $tripService;
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function index(Request $request)
    {
        return Trip::paginate($request->get('limit', 15));
    }

    /**
     * @param Request $request
     * @param Trip    $trip
     *
     * @return array
     */
    public function show(Request $request, Trip $trip): array
    {
        $this->tripService->setSort($request->get('sort'));
        return [
            'trip' => $trip,
            'flights' => $this->tripService->findFlightsAndPrices($trip),
        ];
    }

    /**
     * @param TripRequest $request
     *
     * @return array
     */
    public function store(TripRequest $request): array
    {
        $trip = Trip::create($request->all());
        $this->tripService->setSortType($request->get('sort_type', TripService::SORT_DEFAULT_TYPE));
        $this->tripService->setSortDirection($request->get('sort_direction', TripService::SORT_DEFAULT_DIRECTION));
        return [
            'trip' => $trip,
            'flights' => $this->tripService->findFlightsAndPrices($trip),
        ];
    }

}
