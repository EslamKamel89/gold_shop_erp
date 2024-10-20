<?php

namespace App\Http\Controllers\Api;
use App\Helpers\InvocieHelper;
use App\Helpers\ItemCountHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;
use App\Models\Item;
use App\Traits\ApiResponse;
use App\Traits\InvoiceTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class InvoiceController extends Controller {
	use ApiResponse, InvoiceTrait;

	public function __construct(
		private InvocieHelper $invoiceHelper,
	) {
	}
	/**
	 * Display a listing of the resource.
	 */
	public function index( Request $requesdt ) {
		return $this->success(
			InvoiceResource::collection(
				Invoice::paginate( request()->get( 'limit' ) ?? 10 )
			)
		);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store( Request $request ) {
		Gate::authorize( 'create', Invoice::class);
		try {
			//? validate invoice data
			$inoviceValidated = $this->validateInoviceData();
			//? validate that the orders are recieved and there are at least one order
			$orders = $this->validateOrdersKeyExist();
			//? validate if each product are unique and there are no duplicats
			$this->validateProductsAreUnique( $orders );
			//? validate the orders
			$validatedOrders = $this->validateOrders( $orders );
			//? validate items codes to make sure that the code exist and the item are not sold
			$this->validateItemsCodes( $validatedOrders );
			//? add product price to each order
			$validatedOrders = $this->invoiceHelper->addPriceToEachOrder( $validatedOrders );
			//? calcuate invoice total price and merge it with the invoiceValidated array
			$inoviceValidated['total_price'] = $this->invoiceHelper->getTotalInvoicePrice( $validatedOrders );
			// info( 'inoviceValidated', [ $inoviceValidated ] );

			// info( 'validatedOrders', [ $validatedOrders ] );
			// return $this->success( [
			// 	'invoiceValidated' => $inoviceValidated,
			// 	'validatedOrders' => $validatedOrders,
			// ] );
			// return;
			$invoice = Invoice::create( $inoviceValidated );
			foreach ( $validatedOrders as $order ) {
				$invoice->products()->attach(
					$order['product_id'],
					[ 
						"quantity" => $order["quantity"],
						"unit_price" => $order["unit_price"],
					],
				);
				foreach ( $order['codes'] as $code ) {
					$item = Item::where( 'code', $code )->first();
					ItemCountHelper::decrementItemCount( $item, $invoice->id );
				}
			}

			return $this->success( new InvoiceResource( $invoice ), message: "Order Placed Successfully" );
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
		return $this->success( new InvoiceResource( $invoice ) );
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
