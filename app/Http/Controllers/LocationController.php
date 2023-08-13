<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexLocationRequest;
use App\Http\Resources\LocationResource;
use App\Interfaces\IndexLocationInterface;
use Illuminate\Http\Resources\Json\JsonResource;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexLocationRequest $request, IndexLocationInterface $indexer): JsonResource
    {
        $data = $request->validated();

        $locations = $indexer->getLocations(
            $data['latitude'],
            $data['longitude'],
            $data['radius']
        );

        return LocationResource::collection($locations);
    }
}
