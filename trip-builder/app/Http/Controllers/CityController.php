<?php

namespace App\Http\Controllers;

use App\Http\Requests\CityRequest;
use Illuminate\Http\Request;
use App\City;

class CityController extends Controller
{
    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function index(Request $request)
    {
        return City::paginate($request->get('limit', 15));
    }

    /**
     * @param City $city
     *
     * @return City
     */
    public function show(City $city): City
    {
        return $city;
    }

    /**
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
