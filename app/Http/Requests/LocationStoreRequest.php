<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocationStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "street" => "string",
            "number" => "string",
            "city" => "string",
            "country" => "string",
            "image_url" => "url|nullable"
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            "image_url" => $this->imageUrl,
        ]);

        unset($this['imageUrl']);
    }
}
