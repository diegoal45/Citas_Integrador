<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateServicesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            
            "name" => ["required", "string"],
            "description" => ["required", "string"],
            "duration_minutes" => ["required", "string"],
            "price" => ["required", "string"],
            "id_salon" => ["required", "integer"],
            "description" => ["required", "string"],
            "active" => ["required", "boolean"],
        ];
    }
}
