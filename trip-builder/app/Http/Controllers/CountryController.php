<?php

namespace App\Http\Controllers;

use App\Http\Requests\CountryRequest;
use Illuminate\Http\Request;
use App\Country;

class CountryController extends Controller
{
    /**
     * @OA\Get(
     *      path="/countries",
     *      operationId="getCountriesList",
     *      tags={"Countries"},
     *      summary="Get list of countries",
     *      description="Returns list of countries",
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
        return Country::paginate($request->get('limit', 15));
    }

    /**
     *
     * @OA\Get(
     *      path="/countries/{country}",
     *      operationId="getCountryById",
     *      tags={"Countries"},
     *      summary="Get country information",
     *      description="Returns country data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Country id",
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
     * @param Country $country
     *
     * @return Country
     */
    public function show(Country $country): Country
    {
        return $country;
    }

    /**
     *
     * @OA\Post(
     *      path="/countries",
     *      operationId="postCountry",
     *      tags={"Countries"},
     *      summary="Store country",
     *      description="Create new country",
     *      security={{"Bearer": {}}},
     *      @OA\RequestBody(
     *         description="Country object",
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/Country")
     *         )
     *      ),
     *      @OA\Response(response=200, description="successful operation", @OA\JsonContent()),
     *      @OA\Response(response=400, description="Bad request"),
     * )
     *
     * @param CountryRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CountryRequest $request): \Illuminate\Http\JsonResponse
    {
        $country = Country::create($request->all());

        return response()->json($country, 201);
    }

    /**
     *
     * @OA\Put(
     *      path="/countries/{country}",
     *      operationId="putCountry",
     *      tags={"Countries"},
     *      summary="Update country",
     *      description="update an country",
     *      security={{"Bearer": {}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="Country id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *         description="Country object",
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/Country")
     *         )
     *      ),
     *      @OA\Response(response=200, description="successful operation", @OA\JsonContent()),
     *      @OA\Response(response=400, description="Bad request"),
     * )
     *
     * @param CountryRequest $request
     * @param Country        $country
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CountryRequest $request, Country $country): \Illuminate\Http\JsonResponse
    {
        $country->update($request->all());

        return response()->json($country, 200);
    }

    /**
     *
     * @OA\Delete(
     *      path="/countries/{country}",
     *      operationId="deleteCountry",
     *      tags={"Countries"},
     *      summary="Delete country",
     *      description="delete an country",
     *      security={{"Bearer": {}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="Country id",
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
     * @param Country $country
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Country $country): \Illuminate\Http\JsonResponse
    {
        $country->delete();

        return response()->json(null, 204);
    }
}
