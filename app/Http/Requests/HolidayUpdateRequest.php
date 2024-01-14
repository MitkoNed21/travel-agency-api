<?php

namespace App\Http\Requests;

use App\Models\Holiday;
use App\Models\Location;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HolidayUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "id" => Rule::exists((new Holiday)->getTable(), "id"),
            "title" => "string",
            "start_date" => "date_format:Y-m-d",
            "duration" => "integer|min:1",
            "price" => "numeric",
            "free_slots" => "integer|min:1",
            "location_id" => Rule::exists((new Location)->getTable(), "id"),
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            "start_date" => $this->startDate,
            "free_slots" => $this->freeSlots,
            "location_id" => $this->location,
        ]);

        unset(
            $this['startDate'],
            $this['freeSlots'],
            $this['location']
        );
    }
}
