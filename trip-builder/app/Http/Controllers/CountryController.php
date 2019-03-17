<?php

namespace App\Http\Controllers;

use App\Http\Requests\CountryRequest;
use Illuminate\Http\Request;
use App\Country;

class CountryController extends Controller
{
    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function index(Request $request)
    {
        return Country::paginate($request->get('limit', 15));
    }

    /**
     * @param Country $country
     *
     * @return Country
     */
    public function show(Country $country): Country
    {
        return $country;
    }

    /**
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
