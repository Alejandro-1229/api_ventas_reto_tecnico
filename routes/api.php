<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;



Route::post('register', [AuthController::class, 'registerUser']);
Route::post('logIn', [AuthController::class, 'logInUser']);


Route::middleware(['auth:sanctum','checkRole:1,2'])->group(function () {

    Route::post('logOut', [AuthController::class, 'logOutUser']);

    Route::prefix('/v1/products')->group(function () {
        Route::get('/', [ProductController::class, 'getAllProducts']);;
        Route::post('/', [ProductController::class, 'createProduct']);
        Route::get('/{sku}', [ProductController::class, 'getProduct']);
        Route::put('/{sku}', [ProductController::class, 'updateProduct']);
        Route::delete('/{sku}', [ProductController::class, 'deleteProduct']);
        Route::patch('/disable/{sku}', [ProductController::class, 'disableProduct']);
        Route::patch('/enable/{sku}', [ProductController::class, 'enableProduct']);
    });

    Route::prefix('/v1/sales')->group(function () {
        Route::post('/', [SaleController::class, 'registerSale']);
        Route::get('/{code}', [SaleController::class, 'showDetail']);
    });

    Route::prefix('/v1/report')->group(function () {
        Route::get('/productos-mas-vendidos', [ReportController::class, 'getproductosMasVendidos']);
        Route::get('/export-productos-mas-vendidos', [ReportController::class, 'exportProductosMasVendidos']);
        Route::get('/reporte-ventas', [ReportController::class, 'getReporteVentas']);
    });
});


