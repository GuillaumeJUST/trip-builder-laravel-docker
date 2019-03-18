<?php

namespace App\Http\Controllers;

use App\Http\Requests\AirlineRequest;
use Illuminate\Http\Request;
use App\Airline;

class AirlineController extends Controller
{
    /**
     *
     * @OA\Get(
     *      path="/airlines",
     *      operationId="getAirlinesList",
     *      tags={"Airlines"},
     *      summary="Get list of airlines",
     *      description="Returns list of airlines",
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
        return Airline::paginate($request->get('limit', 15));
    }

    /**
     *
     * @OA\Get(
     *      path="/airlines/{airline}",
     *      operationId="getAirlineById",
     *      tags={"Airlines"},
     *      summary="Get airline information",
     *      description="Returns airline data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Airline id",
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
     * @param Airline $airline
     *
     * @return Airline
     */
    public function show(Airline $airline): Airline
    {
        return $airline;
    }

    /**
     *
     * @OA\Post(
     *      path="/airlines",
     *      operationId="postAirline",
     *      tags={"Airlines"},
     *      summary="Store airline",
     *      description="Create new airline",
     *      security={
     *         {"Authorization": {}}
     *      },
     *      @OA\RequestBody(
     *         description="airline object",
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(ref="#/components/schemas/Airline")
     *         )
     *      ),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     * )
     *
     * @param AirlineRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(AirlineRequest $request): \Illuminate\Http\JsonResponse
    {
        $airline = Airline::create($request->all());

        return response()->json($airline, 201);
    }

    /**
     *
     * @OA\Put(
     *      path="/airlines/{airline}",
     *      operationId="putAirline",
     *      tags={"Airlines"},
     *      summary="Update airline",
     *      description="update an airline",
     *      security={{"Bearer": {}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="Airline id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *         description="airline object",
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/Airline")
     *         )
     *      ),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     * )
     *
     * @param Request $request
     * @param Airline $airline
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Airline $airline): \Illuminate\Http\JsonResponse
    {
        $airline->update($request->all());

        return response()->json($airline, 200);
    }

    /**
     *
     * @OA\Delete(
     *      path="/airlines/{airline}",
     *      operationId="deleteAirline",
     *      tags={"Airlines"},
     *      summary="Delete airline",
     *      description="delete an airline",
     *      security={{"Bearer": {}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="Airline id",
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
     * @param Airline $airline
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Airline $airline): \Illuminate\Http\JsonResponse
    {
        $airline->delete();

        return response()->json(null, 204);
    }
}
