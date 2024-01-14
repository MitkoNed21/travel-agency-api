<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HolidayResource extends JsonResource
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
            "location" => (new LocationResource($this->location))->toArray($request),
            "title" => $this->title,
            "startDate" => $this->start_date,
            "duration" => $this->duration,
            "price" => $this->price,
            "freeSlots" => $this->free_slots,
        ];
    }
}
