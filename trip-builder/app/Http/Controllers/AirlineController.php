<?php

namespace App\Http\Controllers;

use App\Http\Requests\AirlineRequest;
use Illuminate\Http\Request;
use App\Airline;

class AirlineController extends Controller
{
    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function index(Request $request)
    {
        return Airline::paginate($request->get('limit', 15));
    }

    /**
     * @param Airline $airline
     *
     * @return Airline
     */
    public function show(Airline $airline): Airline
    {
        return $airline;
    }

    /**
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
