<?php

namespace App\Http\Controllers;

use App\Exports\ProductosMasVendidosExport;
use App\Http\Requests\ReportDateRequest;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function getProductosMasVendidos(ReportDateRequest $request)
    {
        $fechaInicio = $request->validated()['fecha_inicio'];
        $fechaFin = $request->validated()['fecha_fin'];

        return Product::select(
            'products.id',
            'products.sku',
            'products.nombre',
            DB::raw('SUM(sale_details.cantidad) as total_vendido'),
            DB::raw('SUM(sale_details.sub_total) as monto_total')
        )
            ->join('sale_details', 'products.id', '=', 'sale_details.product_id')
            ->join('sales', 'sale_details.sale_id', '=', 'sales.id')
            ->whereBetween('sales.fecha_hora_venta', [$fechaInicio, $fechaFin])
            ->groupBy('products.id', 'products.sku', 'products.nombre')
            ->orderByDesc('total_vendido') 
            ->limit(20)
            ->get();
    }

    public function exportProductosMasVendidos(ReportDateRequest $request)
    {
        $fechaInicio = $request->validated()['fecha_inicio'];
        $fechaFin = $request->validated()['fecha_fin'];


        return Excel::download(new ProductosMasVendidosExport($fechaInicio, $fechaFin), 'productos_mas_vendidos_'.now().'.xlsx');
    }

    public function getReporteVentas(Request $request)
    {
        $tipoAgrupacion = $request->query('tipo', 'diario'); 
        $clienteId = $request->query('cliente_id');
        $vendedorId = $request->query('vendedor_id');

        switch ($tipoAgrupacion) {
            case 'semanal':
                $groupBy = DB::raw("YEARWEEK(sales.fecha_hora_venta)"); 
                $selectFecha = DB::raw("YEARWEEK(sales.fecha_hora_venta) as periodo");
                break;
            case 'mensual':
                $groupBy = DB::raw("DATE_FORMAT(sales.fecha_hora_venta, '%Y-%m')"); 
                $selectFecha = DB::raw("DATE_FORMAT(sales.fecha_hora_venta, '%Y-%m') as periodo");
                break;
            case 'diario':
            default:
                $groupBy = DB::raw("DATE(sales.fecha_hora_venta)"); 
                $selectFecha = DB::raw("DATE(sales.fecha_hora_venta) as periodo");
                break;
        }

        $ventas = Sale::select(
                'sales.codigo',
                'clients.nombre as nombre_cliente',
                DB::raw("CONCAT(clients.type_of_id_id, ' ', clients.numero_identidad) as identificacion_cliente"),
                'clients.correo as correo_cliente',
                DB::raw('COUNT(sale_details.id) as cantidad_productos'),
                DB::raw('SUM(sale_details.sub_total) as monto_total'),
                $selectFecha 
            )
            ->join('clients', 'sales.client_id', '=', 'clients.id')
            ->join('sale_details', 'sales.id', '=', 'sale_details.sale_id')
            ->leftJoin('products', 'sale_details.product_id', '=', 'products.id') 
            ->when($clienteId, function ($query, $clienteId) {
                return $query->where('sales.client_id', $clienteId);
            })
            ->when($vendedorId, function ($query, $vendedorId) {
                return $query->where('sales.user_id', $vendedorId);
            })
            ->groupBy($groupBy, 'sales.codigo', 'clients.nombre', 'clients.type_of_id_id', 'clients.numero_identidad', 'clients.correo')
            ->orderByDesc('periodo') 
            ->get();

        return response()->json($ventas);
    }
}
