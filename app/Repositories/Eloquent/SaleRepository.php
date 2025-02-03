<?php

namespace App\Repositories\Eloquent;

use App\Interfaces\SaleInterface;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;

class SaleRepository implements SaleInterface
{

    public function createSale(array $data)
    {
        DB::beginTransaction();

        $venta = Sale::create([
            'codigo' => Str::uuid(),
            'client_id' => $data['client_id'],
            'user_id' => auth()->id(),
            'monto_total' => 0,
            'fecha_hora_venta' => now(),
        ]);

        $montoTotal = 0;

        foreach ($data['productos'] as $producto) {

            $productFinded = Product::findOrFail($producto['id']);

            if ($productFinded->stock <= $producto['cantidad']) {
                throw new \Exception("Stock insuficiente para {$productFinded->nombre} ");
            }

            if ($productFinded->state_id == 2) {
                throw new \Exception("El producto {$productFinded->nombre} esta deshabillitado");
            }

            $venta->products()->attach($productFinded->id, [
                'cantidad' => json_encode($producto['cantidad']),
                'precio_unitario' => $productFinded->precio_unitario,
                'sub_total' => $producto['cantidad'] * $productFinded->precio_unitario,
            ]);

            $productFinded->decrement('stock', $producto['cantidad']);

            $montoTotal += $productFinded->precio_unitario * $producto['cantidad'];
        }

        $venta->update(['monto_total' => $montoTotal]);

        DB::commit();

        return $venta;
    }


    public function detailSale(string $code) {
        $venta = Sale::with('products','client')->where('codigo', $code)->first();

        return $venta;
    }
}
