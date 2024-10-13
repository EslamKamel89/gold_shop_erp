<?php

use App\Http\Controllers\Api\AuthController;
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


Route::prefix( '/auth' )->group( function () {
	Route::post( '/login', [ AuthController::class, 'login' ] )
		->name( 'apiLogin' );
	Route::post( '/register', [ AuthController::class, 'register' ] )
		->name( 'apiRegister' );
	Route::get( '/forget-password', [ AuthController::class, 'forgetPassword' ] )
		->name( 'apiForgetPassword' )->middleware( [ 'auth:sanctum' ] );
} );

Route::middleware( [ 'auth:sanctum' ] )->group( function () {
	Route::apiResource( '/shops', ShopController::class);
	Route::apiResource( '/categories', CategoryController::class);
	Route::apiResource( '/producers', ProducerController::class);
	Route::apiResource( '/products', ProductController::class);
	Route::apiResource( '/items', ItemController::class);
	Route::apiResource( '/gold-prices', GoldPriceController::class);
	Route::apiResource( '/invoices', InvoiceController::class);
	Route::apiResource( '/creditors', CreditorController::class);
} );
