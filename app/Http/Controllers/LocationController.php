<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationStoreRequest;
use App\Http\Requests\LocationUpdateRequest;
use App\Http\Resources\LocationCollection;
use App\Http\Resources\LocationResource;
use App\Models\Location;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class LocationController extends Controller
{
    public function index()
    {
        return new LocationCollection(Location::all());
    }

    public function show($id)
    {
        $location = Location::find($id);
        if (!$location) {
            return new JsonResponse(["Location not found"], 400);
        }

        return new JsonResponse(new LocationResource($location));
    }

    public function store(LocationStoreRequest $request)
    {
        $validationData = $request->all();
        $data = $request->validated();
        
        if (count($data) !== count($validationData)) {
            return new JsonResponse(["Failed to create holiday. Invalid data"], 400);
        }

        $data['image_url'] ??= \Faker\Factory::create()->imageUrl();

        $location = new Location($data);

        try {
            $location->save();
        } catch (Throwable $th) {
            return new JsonResponse(["Failed to create location. Database error"], 400);
        }

        return new JsonResponse(new LocationResource($location));
    }

    public function update(LocationUpdateRequest $request)
    {
        $validationData = $request->all();
        $data = $request->validated();
        
        if (count($data) !== count($validationData)) {
            return new JsonResponse(["Failed to update location. Invalid data"], 400);
        }

        $location = Location::find($request->id);

        $data['image_url'] ??= \Faker\Factory::create()->imageUrl();

        try {
            $location->update($data);
        } catch (Throwable $th) {
            return new JsonResponse(["Failed to update holiday. Database error"], 400);
        }


        return new JsonResponse(new LocationResource($location));
    }

    public function destroy($id)
    {
        try {
            $deletedCount = Location::destroy($id);
            return new JsonResponse($deletedCount === 1);
        } catch (Throwable $th) {
            return new JsonResponse(["Failed to delete location. Database error"], 400);
        }
    }
}
