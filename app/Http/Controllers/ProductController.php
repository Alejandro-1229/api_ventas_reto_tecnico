<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Client\Request;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{

    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function getAllProducts()
    {
        $products = $this->productService->getAllProducts();
        return response()->json(ProductResource::collection($products), 200);
    }

    public function getProduct($sku){
        return $this->productService->getProduct($sku);
    }

    public function createProduct(ProductRequest $request)
    {
        try {

            $newProduct = $this->productService->createProduct($request->validated());
            return response()->json($newProduct, 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error del servidor',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function updateProduct(UpdateProductRequest $request, $sku)
    {

        try {

            $this->productService->updateProduct($sku, $request->validated());
            return response()->json([
                "mensaje" => "Actualizado Satisfactoriamente",
                "data" => $request->validated()
            ], 200); 

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error del servidor',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function disableProduct(String $sku)
    {
        return $this->productService->disableProduct($sku);
    }

    public function enableProduct(String $sku)
    {
        return $this->productService->enableProduct($sku);
    }

    public function deleteProduct(String $sku)
    {
        $this->productService->deleteProduct($sku);
    }
}
