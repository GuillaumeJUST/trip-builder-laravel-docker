<?php

namespace App\Http\Controllers;

use App\Http\Requests\AirportRequest;
use Illuminate\Http\Request;
use App\Airport;

class AirportController extends Controller
{
    /**
     * @OA\Get(
     *      path="/airports",
     *      operationId="getAirportsList",
     *      tags={"Airports"},
     *      summary="Get list of airports",
     *      description="Returns list of airports",
     *      @OA\Response(response=200, description="successful operation", @OA\JsonContent()),
     *      @OA\Response(response=400, description="Bad request"),
     * )
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function index(Request $request)
    {
        return Airport::paginate($request->get('limit', 15));
    }

    /**
     *
     * @OA\Get(
     *      path="/airports/{airport}",
     *      operationId="getAirportById",
     *      tags={"Airports"},
     *      summary="Get airport information",
     *      description="Returns airport data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Airport id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(response=200, description="successful operation", @OA\JsonContent()),
     *      @OA\Response(response=400, description="Bad request"),
     * )
     *
     * @param Airport $airport
     *
     * @return Airport
     */
    public function show(Airport $airport): Airport
    {
        return $airport;
    }

    /**
     *
     * @OA\Post(
     *      path="/airports",
     *      operationId="postAirport",
     *      tags={"Airports"},
     *      summary="Store airport",
     *      description="Create new airport",
     *      security={{"Bearer": {}}},
     *      @OA\RequestBody(
     *         description="Airport object",
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/Airport")
     *         )
     *      ),
     *      @OA\Response(response=200, description="successful operation", @OA\JsonContent()),
     *      @OA\Response(response=400, description="Bad request"),
     * )
     *
     * @param AirportRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(AirportRequest $request): \Illuminate\Http\JsonResponse
    {
        $airport = Airport::create($request->all());

        return response()->json($airport, 201);
    }

    /**
     *
     * @OA\Put(
     *      path="/airports/{airport}",
     *      operationId="putAirport",
     *      tags={"Airports"},
     *      summary="Update airport",
     *      description="update an airport",
     *      security={{"Bearer": {}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="Airport id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *         description="Airport object",
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/Airport")
     *         )
     *      ),
     *      @OA\Response(response=200, description="successful operation", @OA\JsonContent()),
     *      @OA\Response(response=400, description="Bad request"),
     * )
     *
     * @param AirportRequest $request
     * @param Airport        $airport
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(AirportRequest $request, Airport $airport): \Illuminate\Http\JsonResponse
    {
        $airport->update($request->all());

        return response()->json($airport, 200);
    }

    /**
     *
     * @OA\Delete(
     *      path="/airports/{airport}",
     *      operationId="deleteAirport",
     *      tags={"Airports"},
     *      summary="Delete airport",
     *      description="delete an airport",
     *      security={{"Bearer": {}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="Airport id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(response=200, description="successful operation", @OA\JsonContent()),
     *      @OA\Response(response=400, description="Bad request"),
     * )
     *
     * @param Airport $airport
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Airport $airport): \Illuminate\Http\JsonResponse
    {
        $airport->delete();

        return response()->json(null, 204);
    }
}
