<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateDatesRequest extends FormRequest
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
            
            "id_user" => ["required", "integer"],
            "id_professional" => ["required", "integer"],
            "id_service" => ["required", "integer"],
            "confirmation_code" => ["required", "string"],
            "date" => ["required", "string"],
            "start_time" => ["required", "string"],
            "date" => ["required", "string"],
            "start_time" => ["required", "string"],
            "end_time" => ["required", "string"],
            "active" => ["required", "boolean"],
            "final_price" => ["required", "string"],
            "notes" => ["required", "string"],
        ];
        
    }
}
