<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateShiftsRequest extends FormRequest
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
            
            "id_professional" => ["required", "integer"],
            "day_week" => ["required", "string"],
            "start_time" => ["required", "string"],
            "end_time" => ["required", "string"],
            "effective_start_date" => ["required", "string"],
            "effective_end_date" => ["required", "string"],
            "active" => ["required", "boolean"],
            
        ];
    }
}
