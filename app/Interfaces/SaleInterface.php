<?php

namespace App\Interfaces;

interface SaleInterface
{
    public function createSale(array $data);
    public function detailSale(string $code);
}
