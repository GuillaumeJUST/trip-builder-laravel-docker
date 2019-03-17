<?php

namespace App\Http\Controllers;

use App\Http\Requests\AirportRequest;
use Illuminate\Http\Request;
use App\Airport;

class AirportController extends Controller
{
    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function index(Request $request)
    {
        return Airport::paginate($request->get('limit', 15));
    }

    /**
     * @param Airport $airport
     *
     * @return Airport
     */
    public function show(Airport $airport): Airport
    {
        return $airport;
    }

    /**
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
