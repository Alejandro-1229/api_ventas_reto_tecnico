<?php

namespace App\Interfaces;

interface ProductInterface
{
    public function getAll();
    public function findBySku($sku);
    public function create(array $data);
    public function update($sku, array $data);
    public function delete($sku);
    public function disable(String $sku);
    public function enable(String $sku);
}
