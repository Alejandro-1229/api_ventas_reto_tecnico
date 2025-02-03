<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'codigo' => $this->codigo,
            'nombre_cliente' => $this->client->nombre,
            'monto_total' => $this->monto_total,
            'fecha_hora' => $this->fecha_hora_venta,
            'productos' => $this->products->map(function ($producto) {
                return [
                    'nombre' => $producto->nombre,
                    'cantidad' => $producto->pivot->cantidad,
                    'precio_unitario' => $producto->pivot->precio_unitario,
                ];
            }),
            ];
    }
}
