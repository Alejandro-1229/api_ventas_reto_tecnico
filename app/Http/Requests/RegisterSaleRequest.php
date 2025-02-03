<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterSaleRequest extends FormRequest
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
            'client_id' => 'required|exists:clients,id',
            'productos' => 'required|array|min:1',
            'productos.*.id' => 'exists:products,id',
            'productos.*.cantidad' => 'integer|min:1'
        ];
    }

    public function messages()
    {
        return [
            'client_id.required' => 'El ID del cliente es obligatorio.',
            'client_id.exists' => 'El cliente seleccionado no existe.',
            'productos.required' => 'La lista de productos es obligatoria.',
            'productos.array' => 'La lista de productos debe ser un arreglo.',
            'productos.*.id.exists' => 'El producto seleccionado no es válido.',
            'productos.*.cantidad.integer' => 'La cantidad del producto debe ser un número entero.',
            'productos.*.cantidad.min' => 'La cantidad del producto debe ser al menos 1.',
        ];
    }
}
