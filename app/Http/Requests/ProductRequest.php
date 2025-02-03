<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'sku' => 'required|string|unique:products,sku',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio_unitario' => 'required|numeric|min:0|max:9999.99',
            'stock' => 'required|integer|min:0',
            'state_id' => 'required|exists:states,id',
        ];
    }

    public function messages()
    {
        return [
            'sku.required' => 'El SKU es obligatorio.',
            'sku.unique' => 'El SKU ya está en uso.',
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.max' => 'El nombre no puede tener más de 255 caracteres.',
            'precio_unitario.required' => 'El precio unitario es obligatorio.',
            'precio_unitario.numeric' => 'El precio unitario debe ser un número.',
            'precio_unitario.min' => 'El precio unitario debe ser al menos 0.',
            'precio_unitario.max' => 'El precio unitario no puede ser mayor a 9999.99.',
            'stock.required' => 'El stock es obligatorio.',
            'stock.integer' => 'El stock debe ser un número entero.',
            'stock.min' => 'El stock debe ser al menos 0.',
            'state_id.required' => 'El estado es obligatorio.',
            'state_id.exists' => 'El estado seleccionado no es válido.',
        ];
    }
}
