<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterSaleRequest;
use App\Http\Resources\SaleDetailResource;
use App\Models\Sale;
use App\Services\SaleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SaleController extends Controller
{
    protected $saleService;

    public function __construct(SaleService $saleService) {
        $this->saleService = $saleService;
    }

    public function registerSale(RegisterSaleRequest $request)
    {

        try {

            $venta = $this->saleService->createSale($request->validated());

            return response()->json(['message' => 'Venta registrada con éxito', 'venta' => $venta]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function showDetail(String $code)
    {
        try {
            $detalelVenta = $this->saleService->showSaleDetail($code); 
            return new SaleDetailResource($detalelVenta);
        } catch (\Throwable $th) {
            //throw $th;
        }

        //return $detalelVenta;
    }

}
