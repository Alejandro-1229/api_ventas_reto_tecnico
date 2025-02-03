<?php

namespace App\Services;

use App\Interfaces\ProductInterface;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductInterface $productInterface)
    {
        $this->productRepository = $productInterface;
    }

    public function getAllProducts()
    {
        return $this->productRepository->getAll();
    }

    public function getProduct($sku)
    {
        return $this->productRepository->findBySku($sku);
    }

    public function createProduct(array $data)
    {
        return $this->productRepository->create($data);
    }

    public function updateProduct($sku, array $data)
    {
        return $this->productRepository->update($sku, $data);
    }

    public function deleteProduct($sku)
    {
        return $this->productRepository->delete($sku);
    }

    public function disableProduct(String $sku)
    {
        $this->productRepository->disable($sku);
        return "El producto se ha deshabilitado";
    }

    public function enableProduct(String $sku)
    {
        $this->productRepository->enable($sku);
        return "El producto se ha habilitado";
    }
}
