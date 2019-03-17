<?php

namespace App\Http\Controllers;

use App\Http\Requests\FlightRequest;
use Illuminate\Http\Request;
use App\Flight;

class FlightController extends Controller
{
    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function index(Request $request)
    {
        return Flight::paginate($request->get('limit', 15));
    }

    /**
     * @param Flight $flight
     *
     * @return Flight
     */
    public function show(Flight $flight): Flight
    {
        return $flight;
    }

    /**
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
