<?php

namespace App\Http\Controllers\Api;

use App\Helpers\InvoiceHelper;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Traits\ApiResponse;
use App\Traits\InvoiceTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class InvoiceController extends Controller {
	use ApiResponse, InvoiceTrait;
	/**
	 * Display a listing of the resource.
	 */
	public function index() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store( Request $request ) {
		Gate::authorize( 'create', Invoice::class);
		try {
			//? validate invoice data
			$this->validateInoviceData();
			//? validate that the orders are recieved and there are at least one order
			$orders = $this->validateOrdersKeyExist();
			//? validate if each product are unique and there are no duplicats
			$this->validateProductsAreUnique( $orders );
			//? validate the orders
			$validatedOrders = $this->validateOrders( $orders );
			//? validate items codes to make sure that the code exist and the item are not sold
			$this->validateItemsCodes( $validatedOrders );
			return $this->success( [], message: "Order Placed Successfully" );
		} catch (ValidationException $validationException) {
			throw $validationException;
		} catch (\Throwable $th) {
			return $this->failure( $th->getMessage() );
		}
	}



	/**
	 * Display the specified resource.
	 */
	public function show( Invoice $invoice ) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update( Request $request, Invoice $invoice ) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy( Invoice $invoice ) {
		//
	}
}
