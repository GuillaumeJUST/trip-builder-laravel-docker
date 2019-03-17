<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegionRequest;
use Illuminate\Http\Request;
use App\Region;

class RegionController extends Controller
{
    public function index(Request $request)
    {
        return Region::paginate($request->get('limit', 15));
    }

    /**
     * @param Region $region
     *
     * @return Region
     */
    public function show(Region $region): Region
    {
        return $region;
    }

    /**
     * @param RegionRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RegionRequest $request): \Illuminate\Http\JsonResponse
    {
        $region = Region::create($request->all());

        return response()->json($region, 201);
    }

    /**
     * @param RegionRequest $request
     * @param Region        $region
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RegionRequest $request, Region $region): \Illuminate\Http\JsonResponse
    {
        $region->update($request->all());

        return response()->json($region, 200);
    }

    /**
     * @param Region $region
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Region $region): \Illuminate\Http\JsonResponse
    {
        $region->delete();

        return response()->json(null, 204);
    }
}
