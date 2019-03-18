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
     *
     * @OA\Get(
     *      path="/trips",
     *      operationId="getTripsList",
     *      tags={"Trips"},
     *      summary="Get list of trips",
     *      description="Returns list of trips",
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     * )
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function index(Request $request)
    {
        return Trip::paginate($request->get('limit', 15));
    }

    /**
     *
     * @OA\Get(
     *      path="/trips/{trip}",
     *      operationId="getTripById",
     *      tags={"Trips"},
     *      summary="Get trip information",
     *      description="Returns trip data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Trip id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     * )
     *
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
     *
     * @OA\Post(
     *      path="/trips",
     *      operationId="postTrip",
     *      tags={"Trips"},
     *      summary="Store trip",
     *      description="Create new trip",
     *      @OA\RequestBody(
     *         description="Trip object",
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/Trip")
     *         )
     *      ),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     * )
     *
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
