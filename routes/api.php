<?php

use App\Http\Controllers\Api\ShopController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProducerController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\GoldPriceController;
use App\Http\Controllers\Api\CreditorController;
use App\Http\Controllers\Api\InvoiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get( '/user', function (Request $request) {
	return $request->user();
} )->middleware( 'auth:sanctum' );

Route::middleware( [ 'auth:sanctum' ] )->group( function () {
	Route::apiResource( '/shops', ShopController::class);
	Route::apiResource( '/categories', CategoryController::class);
	Route::apiResource( '/producers', ProducerController::class);
	Route::apiResource( '/products', ProductController::class);
	Route::apiResource( '/items', ItemController::class);
	Route::apiResource( '/gold-prices', GoldPriceController::class);
	Route::apiResource( '/invoices', InvoiceController::class);
} );
