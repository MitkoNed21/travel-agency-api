<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationStoreRequest;
use App\Http\Requests\ReservationUpdateRequest;
use App\Http\Resources\ReservationCollection;
use App\Http\Resources\ReservationResource;
use App\Models\Reservation;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class ReservationController extends Controller
{
    public function index()
    {
        return new ReservationCollection(Reservation::all());
    }

    public function show($id)
    {
        $location = Reservation::find($id);
        if (!$location) {
            return new JsonResponse(["Reservation not found"], 400);
        }

        return new JsonResponse(new ReservationResource($location));
    }

    public function store(ReservationStoreRequest $request)
    {
        $validationData = $request->all();
        $data = $request->validated();

        if (count($data) !== count($validationData)) {
            return new JsonResponse(["Failed to create reservation. Invalid data"], 400);
        }

        $reservation = new Reservation($data);

        try {
            $reservation->holiday()->associate($data["holiday_id"]);
            $reservation->save();
        } catch (Throwable $th) {
            return new JsonResponse(["Failed to create reservation. Database error"], 400);
        }

        return new JsonResponse(new ReservationResource($reservation));
    }

    public function update(ReservationUpdateRequest $request, Reservation $reservation)
    {
        $validationData = $request->all();
        $data = $request->validated();

        if (count($data) !== count($validationData)) {
            return new JsonResponse(["Failed to update reservation. Invalid data"], 400);
        }

        $reservation = Reservation::find($data["id"]);

        try {
            $reservation->update($data);
            $reservation->holiday()->associate($data["holiday_id"]);
            $reservation->save();
        } catch (Throwable $th) {
            return new JsonResponse(["Failed to create reservation. Database error"], 400);
        }

        return new JsonResponse(new ReservationResource($reservation));
    }

    public function destroy($id)
    {
        try {
            $deletedCount = Reservation::destroy($id);
            return new JsonResponse($deletedCount === 1);
        } catch (Throwable $th) {
            return new JsonResponse(["Failed to delete reservation. Database error"], 400);
        }
    }
}
