<?php

namespace App\Repositories\Eloquent;

use App\Interfaces\ProductInterface;
use App\Models\Product;

class ProductRepository implements ProductInterface
{
    public function getAll()
    {
        return Product::all();
    }

    public function findBySku($sku)
    {
        return Product::where("sku", $sku)->firstOrFail();
    }

    public function create(array $data)
    {
        return Product::create($data);
    }

    public function update($sku, array $data)
    {
        $product = $this->findBySku($sku);

        $product->update($data);

        return $product;
    }
    public function delete($sku)
    {
        $product = $this->findBySku($sku);
        
        return  $product->delete() ?  true :  false;
    }

    public function disable(String $sku)
    {
        $product = $this->findBySku($sku);

        $product->update([
            'state_id' => 2
        ]);
    }
    public function enable(String $sku)
    {
        $product = $this->findBySku($sku);

        $product->update([
            'state_id' => 1
        ]);
    }
}
