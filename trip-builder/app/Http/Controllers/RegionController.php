<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegionRequest;
use Illuminate\Http\Request;
use App\Region;

class RegionController extends Controller
{
    /**
     *
     * @OA\Get(
     *      path="/regions",
     *      operationId="getRegionsList",
     *      tags={"Regions"},
     *      summary="Get list of regions",
     *      description="Returns list of regions",
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
        return Region::paginate($request->get('limit', 15));
    }

    /**
     *
     * @OA\Get(
     *      path="/regions/{region}",
     *      operationId="getRegionById",
     *      tags={"Regions"},
     *      summary="Get region information",
     *      description="Returns region data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Region id",
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
     * @param Region $region
     *
     * @return Region
     */
    public function show(Region $region): Region
    {
        return $region;
    }

    /**
     *
     * @OA\Post(
     *      path="/regions",
     *      operationId="postRegion",
     *      tags={"Regions"},
     *      summary="Store region",
     *      description="Create new region",
     *      security={{"Bearer": {}}},
     *      @OA\RequestBody(
     *         description="Region object",
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/Region")
     *         )
     *      ),
     *      @OA\Response(response=200, description="successful operation", @OA\JsonContent()),
     *      @OA\Response(response=400, description="Bad request"),
     * )
     *
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
     *
     * @OA\Put(
     *      path="/regions/{region}",
     *      operationId="putRegion",
     *      tags={"Regions"},
     *      summary="Update region",
     *      description="update an region",
     *      security={{"Bearer": {}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="Region id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *         description="Region object",
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/Region")
     *         )
     *      ),
     *      @OA\Response(response=200, description="successful operation", @OA\JsonContent()),
     *      @OA\Response(response=400, description="Bad request"),
     * )
     *
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
     *
     * @OA\Delete(
     *      path="/regions/{region}",
     *      operationId="deleteRegion",
     *      tags={"Regions"},
     *      summary="Delete region",
     *      description="delete an region",
     *      security={{"Bearer": {}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="Region id",
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
