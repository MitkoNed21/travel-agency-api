<?php

namespace App\Http\Requests;

use App\Models\Holiday;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReservationStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */ 
    public function rules(): array
    {
        return [
            "contact_name" => "string",
            "phone_number" => "string",
            "holiday_id" => Rule::exists((new Holiday)->getTable(), "id"),
        ];
    }

    
    public function prepareForValidation()
    {
        $this->merge([
            "contact_name" => $this->contactName,
            "phone_number" => $this->phoneNumber,
            "holiday_id" => $this->holiday,
        ]);

        unset($this['holiday']);
        unset($this['contactName']);
        unset($this['phoneNumber']);
    }
}
