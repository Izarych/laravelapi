<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCurriculumRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'lectures' => 'required|array',
            'lectures.*.id' => 'required|exists:lectures,id',
            'lectures.*.theme' => 'required|string',
            'lectures.*.description' => 'nullable|string',
            'class_id' => 'required|exists:classes,id',
            'order' => 'integer'
        ];
    }
}
