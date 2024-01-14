<?php

namespace App\Http\Controllers;

use App\Http\Requests\HolidayStoreRequest;
use App\Http\Requests\HolidayUpdateRequest;
use App\Http\Resources\HolidayCollection;
use App\Http\Resources\HolidayResource;
use App\Models\Holiday;
use App\Http\Controllers\Controller;
use App\Models\Location;
use Database\Factories\HolidayFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Throwable;

class HolidayController extends Controller
{
    public function index(Request $request)
    {
        $locationCityOrCountry = Str::lower($request->get("location"));
        $startDate = $request->get("startDate");
        $duration = $request->get("duration");

        $holidays = Holiday::query();

        if ($locationCityOrCountry) {
            $holidays = $holidays->whereHas("location", function($q) use ($locationCityOrCountry) {
                $q->where(DB::raw("LOWER(city)"), "like", "%$locationCityOrCountry%")
                  ->orWhere(DB::raw("LOWER(country)"), "like", "%$locationCityOrCountry%");
            });
        }

        if ($startDate) {
            $holidays = $holidays->where("start_date", $startDate);
        }

        if ($duration) {
            $holidays = $holidays->where("duration", $duration);
        }
        
        $holidays = $holidays->orderBy('start_date', 'asc')
            ->where('start_date', '>=', Carbon::today())
            ->get();

        return new HolidayCollection($holidays);
    }

    public function show($id)
    {
        $holiday = Holiday::find($id);
        if (!$holiday) {
            return new JsonResponse(["Holiday not found"], 400);
        }

        return new JsonResponse(new HolidayResource($holiday));
    }

    public function store(HolidayStoreRequest $request)
    {
        $validationData = $request->all();
        $data = $request->validated();

        if (count($data) !== count($validationData)) {
            return new JsonResponse(["Failed to create holiday. Invalid data"], 400);
        }

        $holiday = new Holiday($data);

        try {
            $holiday->location()->associate($data["location_id"]);
            $holiday->save();
        } catch (Throwable $th) {
            return new JsonResponse(["Failed to create holiday. Database error"], 400);
        }

        return new JsonResponse(new HolidayResource($holiday));
    }
    
    public function update(HolidayUpdateRequest $request)
    {
        $validationData = $request->all();
        $data = $request->validated();
        
        if (count($data) !== count($validationData)) {
            return new JsonResponse(["Failed to update holiday. Invalid data"], 400);
        }

        $holiday = Holiday::find($data["id"]);

        try {
            $holiday->update($data);
            $holiday->location()->associate($data["location_id"]);
            $holiday->save();
        } catch (Throwable $th) {
            return new JsonResponse(["Failed to update holiday. Database error"], 400);
        }

        return new JsonResponse(new HolidayResource($holiday));
    }

    public function destroy($id)
    {
        try {
            $deletedCount = Holiday::destroy($id);
            return new JsonResponse($deletedCount === 1);
        } catch (Throwable $th) {
            return new JsonResponse(["Failed to delete holiday. Database error"], 400);
        }
    }
}
