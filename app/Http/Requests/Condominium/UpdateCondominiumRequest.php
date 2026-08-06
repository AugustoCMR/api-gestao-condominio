<?php

namespace App\Http\Requests\Condominium;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCondominiumRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'max:255'],
            'cnpj' => ['sometimes', 'string'],
            'address' => ['sometimes', 'string'],
            'phone' => ['sometimes', 'string'],
            'complement' => ['sometimes', 'string'],
            'neighborhood' => ['sometimes', 'string'],
            'city' => ['sometimes', 'string'],
            'state' => ['sometimes', 'string'],
            'zip_code' => ['sometimes', 'string'],
            'email' => ['sometimes', 'string', 'email'],
        ];
    }
}
