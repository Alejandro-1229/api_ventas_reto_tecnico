<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductosMasVendidosExport implements FromCollection, WithHeadings
{
    protected $fechaInicio;
    protected $fechaFin;

    public function __construct($fechaInicio, $fechaFin)
    {
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
    }

    public function collection()
    {
        return Product::select(
            'products.id',
            'products.sku',
            'products.nombre',
            DB::raw('SUM(sale_details.cantidad) as total_vendido'),
            DB::raw('SUM(sale_details.sub_total) as monto_total')
            )
            ->join('sale_details', 'products.id', '=', 'sale_details.product_id')
            ->join('sales', 'sale_details.sale_id', '=', 'sales.id')
            ->whereBetween('sales.fecha_hora_venta', [$this->fechaInicio, $this->fechaFin])
            ->groupBy('products.id', 'products.sku', 'products.nombre')
            ->orderByDesc('total_vendido') // Ordena de mayor a menor cantidad vendida
            ->limit(20)
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'SKU',
            'Nombre del Producto',
            'Total Vendido',
            'Monto Total',
        ];
    }
}
