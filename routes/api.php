<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;



Route::post('register', [AuthController::class, 'registerUser']);
Route::post('logIn', [AuthController::class, 'logInUser']);


Route::middleware('auth:sanctum')->group(function () {

    Route::post('logOut', [AuthController::class, 'logOutUser']);

    Route::prefix('/v1/products')->group(function () {
        Route::get('/', [ProductController::class, 'getAllProducts']);
        Route::post('/', [ProductController::class, 'createProduct']);
        Route::get('/{sku}', [ProductController::class, 'getProduct'])->middleware('checkRole');
        Route::put('/{sku}', [ProductController::class, 'updateProduct']);
        Route::delete('/{sku}', [ProductController::class, 'deleteProduct'])->middleware('checkRole');
        Route::patch('/disable/{sku}', [ProductController::class, 'disableProduct'])->middleware('checkRole');
        Route::patch('/enable/{sku}', [ProductController::class, 'enableProduct'])->middleware('checkRole');
    });

    Route::prefix('/v1/sales')->group(function () {
        Route::post('/', [SaleController::class, 'registerSale'])->middleware('checkRole');
        Route::get('/{code}', [SaleController::class, 'showDetail'])->middleware('checkRole');
    });

    Route::prefix('/v1/report')->group(function () {
        Route::get('/productos-mas-vendidos', [ReportController::class, 'getproductosMasVendidos'])->middleware('checkRole')->middleware('checkRole');
        Route::get('/export-productos-mas-vendidos', [ReportController::class, 'exportProductosMasVendidos'])->middleware('checkRole');
        Route::get('/reporte-ventas', [ReportController::class, 'getReporteVentas'])->middleware('checkRole');
    });
});


