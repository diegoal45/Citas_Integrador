<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateReviewsRequest extends FormRequest
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
            
            "id_cita" => ["required", "integer"],
            "id_cliente" => ["required", "integer"],
            "id_professional" => ["required", "integer"],
            "id_service" => ["required", "integer"],
            "qualification" => ["required", "string"],
            "comment" => ["required", "string"],
            "professional_response" => ["required", "string"],
        ];
    }
}
