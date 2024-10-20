<?php

namespace App\Http\Resources;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class InvoiceResource extends JsonResource {
	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray( Request $request ): array {
		return [ 
			'id' => $this->id,
			'userId' => $this->user_id,
			'shopId' => $this->shop_id,
			'code' => $this->code,
			'totalPrice' => $this->total_price,
			'customerName' => $this->customer_name,
			'customerPhone' => $this->customer_phone,
			'updateUserId' => $this->update_user_id,
			'updateShopId' => $this->update_shop_id,
			'createdAt' => $this->created_at,
			'updatedAt' => $this->updated_at,
			'products' => ProductResource::collection( $this->products ),
			'orders' => OrderResource::collection(
				Order::where( 'invoice_id', $this->id )->get()
			),
			'items' => ItemResource::collection( $this->items ),
			'invoiceCreator' => new UserResource( $this->invoiceCreator ),
			'invoiceUpdater' => new UserResource( $this->invoiceUpdater ),
			'createdInShop' => new ShopResource( $this->createdInShop ),
			'updatedInShop' => new ShopResource( $this->updatedInShop ),

		];
	}
}
