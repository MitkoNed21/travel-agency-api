<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "contactName" => $this->contact_name,
            "phoneNumber" => $this->phone_number,
            "holiday" => (new HolidayResource($this->holiday))->toArray($request),
        ];
    }
}
