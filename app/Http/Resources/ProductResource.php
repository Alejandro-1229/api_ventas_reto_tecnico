<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'sku'               => $this->sku,
            'nombre'            => $this->nombre,
            'descripcion'       => $this->descripcion,
            'precio_unitario'   => $this->precio_unitario,
            'stock'             => $this->stock,
            'estado'            => $this->state->product_status,
        ];
    }
}
