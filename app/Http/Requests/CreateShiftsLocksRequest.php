<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateShiftsLocksRequest extends FormRequest
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
            "date" => ["required", "string"],
            "start_time" => ["required", "string"],
            "end_time" => ["required", "string"],
            "reason" => ["required", "string"],
        ];
    }
}
