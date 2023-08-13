<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexLocationRequest;
use App\Http\Resources\LocationResource;
use Illuminate\Http\Resources\Json\JsonResource;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexLocationRequest $request): JsonResource
    {
        $data = $request->validated();

        $indexer = app('index_location_'.$data['unit']);

        $locations = $indexer->getLocations(
            $data['latitude'],
            $data['longitude'],
            $data['radius']
        );

        $transformedLocations = LocationResource::collection($locations);

        return $transformedLocations;
    }
}
