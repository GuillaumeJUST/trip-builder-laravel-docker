<?php

namespace App\Http\Controllers;

use App\Http\Requests\FlightRequest;
use Illuminate\Http\Request;
use App\Flight;

class FlightController extends Controller
{
    /**
     * @OA\Get(
     *      path="/flights",
     *      operationId="getFlightsList",
     *      tags={"Flights"},
     *      summary="Get list of flights",
     *      description="Returns list of flights",
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
        return Flight::paginate($request->get('limit', 15));
    }

    /**
     *
     * @OA\Get(
     *      path="/flights/{flight}",
     *      operationId="getFlightById",
     *      tags={"Flights"},
     *      summary="Get flight information",
     *      description="Returns flight data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Flight id",
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
     * @param Flight $flight
     *
     * @return Flight
     */
    public function show(Flight $flight): Flight
    {
        return $flight;
    }

    /**
     *
     * @OA\Post(
     *      path="/flights",
     *      operationId="postFlight",
     *      tags={"Flights"},
     *      summary="Store flight",
     *      description="Create new flight",
     *      security={{"Bearer": {}}},
     *      @OA\RequestBody(
     *         description="Flight object",
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/Flight")
     *         )
     *      ),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     * )
     *
     * @param FlightRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(FlightRequest $request): \Illuminate\Http\JsonResponse
    {
        $flight = Flight::create($request->all());

        return response()->json($flight, 201);
    }

    /**
     *
     * @OA\Put(
     *      path="/flights/{flight}",
     *      operationId="putFlight",
     *      tags={"Flights"},
     *      summary="Update flight",
     *      description="update an flight",
     *      security={{"Bearer": {}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="Flight id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *         description="Flight object",
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/Flight")
     *         )
     *      ),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     * )
     *
     * @param FlightRequest $request
     * @param Flight        $flight
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(FlightRequest $request, Flight $flight): \Illuminate\Http\JsonResponse
    {
        $flight->update($request->all());

        return response()->json($flight, 200);
    }

    /**
     *
     * @OA\Delete(
     *      path="/flights/{flight}",
     *      operationId="deleteFlight",
     *      tags={"Flights"},
     *      summary="Delete flight",
     *      description="delete an flight",
     *      security={{"Bearer": {}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="Flight id",
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
     * @param Flight $flight
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Flight $flight): \Illuminate\Http\JsonResponse
    {
        $flight->delete();

        return response()->json(null, 204);
    }
}
