<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'string',
                'max:255',
                'nullable'
            ],
            'price' => [
                'array',
                'nullable'
            ],
            'bedrooms' => [
                'integer',
                'min:1',
                'max:5',
                'nullable'
            ],
            'bathrooms' => [
                'integer',
                'min:1',
                'max:5',
                'nullable'
            ],
            'storeys' => [
                'integer',
                'min:1',
                'max:5',
                'nullable'
            ],
            'garages'  => [
                'integer',
                'min:1',
                'max:5',
                'nullable'
            ],
        ];
    }
}
