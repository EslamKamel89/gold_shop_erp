<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
			'invoiceCreator' => new UserResource( $this->whenLoaded( 'invoiceCreator' ) ),
			'invoiceUpdater' => new UserResource( $this->whenLoaded( 'invoiceUpdater' ) ),
			'createdInShop' => new ShopResource( $this->whenLoaded( 'createdInShop' ) ),
			'updatedInShop' => new ShopResource( $this->whenLoaded( 'updatedInShop' ) ),
		];
	}
}
