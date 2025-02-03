<?php
namespace App\Services;

use App\Interfaces\SaleInterface;

class SaleService
{
    protected $saleInterface;

    public function __construct(SaleInterface $saleInterface) {
        $this->saleInterface = $saleInterface;
    }


    public function createSale(array $data){
        $venta = $this->saleInterface->createSale($data);

        // Enviar correo en segundo plano
        //dispatch(new EnviarCorreoVentaJob($venta));
        return $venta;
    }

    public function showSaleDetail(String $codeSale){
        return $this->saleInterface->detailSale($codeSale);
    }
}