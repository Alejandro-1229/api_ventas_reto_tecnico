<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'nombre' => 'string|max:255',
            'descripcion' => 'string',
            'precio_unitario' => 'numeric|min:0|max:9999.99',
            'stock' => 'integer|min:0',
            'state_id' => 'exists:states,id',
        ];
    }
}
