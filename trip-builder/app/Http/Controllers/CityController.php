<?php

namespace App\Http\Controllers;

use App\Http\Requests\CityRequest;
use Illuminate\Http\Request;
use App\City;

class CityController extends Controller
{
    /**
     * @OA\Get(
     *      path="/cities",
     *      operationId="getCitiesList",
     *      tags={"Cities"},
     *      summary="Get list of cities",
     *      description="Returns list of cities",
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
        return City::paginate($request->get('limit', 15));
    }

    /**
     *
     * @OA\Get(
     *      path="/cities/{city}",
     *      operationId="getCityById",
     *      tags={"Cities"},
     *      summary="Get city information",
     *      description="Returns city data",
     *      @OA\Parameter(
     *          name="id",
     *          description="City id",
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
     * @param City $city
     *
     * @return City
     */
    public function show(City $city): City
    {
        return $city;
    }

    /**
     *
     * @OA\Post(
     *      path="/cities",
     *      operationId="postCity",
     *      tags={"Cities"},
     *      summary="Store city",
     *      description="Create new city",
     *      security={{"Bearer": {}}},
     *      @OA\RequestBody(
     *         description="City object",
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/City")
     *         )
     *      ),
     *      @OA\Response(response=200, description="successful operation", @OA\JsonContent()),
     *      @OA\Response(response=400, description="Bad request"),
     * )
     *
     * @param CityRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CityRequest $request): \Illuminate\Http\JsonResponse
    {
        $city = City::create($request->all());

        return response()->json($city, 201);
    }

    /**
     *
     * @OA\Put(
     *      path="/cities/{city}",
     *      operationId="putCity",
     *      tags={"Cities"},
     *      summary="Update city",
     *      description="update an city",
     *      security={{"Bearer": {}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="City id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *         description="City object",
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/City")
     *         )
     *      ),
     *      @OA\Response(response=200, description="successful operation", @OA\JsonContent()),
     *      @OA\Response(response=400, description="Bad request"),
     * )
     *
     * @param CityRequest $request
     * @param City        $city
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CityRequest $request, City $city): \Illuminate\Http\JsonResponse
    {
        $city->update($request->all());

        return response()->json($city, 200);
    }

    /**
     *
     * @OA\Delete(
     *      path="/cities/{city}",
     *      operationId="deleteCity",
     *      tags={"Cities"},
     *      summary="Delete city",
     *      description="delete an city",
     *      security={{"Bearer": {}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="City id",
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
     * @param City $city
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(City $city): \Illuminate\Http\JsonResponse
    {
        $city->delete();

        return response()->json(null, 204);
    }
}
