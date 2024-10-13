<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource {
	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray( Request $request ): array {
		return [ 
			'id' => $this->id,
			'code' => $this->code,
			'sold' => $this->sold,
			'createdAt' => $this->created_at,
			'updatedAt' => $this->updated_at,
			'product' => new ProductResource( $this->whenLoaded( 'product' ) ),
			'creditor' => new CreditorResource( $this->whenLoaded( 'creditor' ) ),
			'shop' => new ShopResource( $this->whenLoaded( 'shop' ) ),
		];
	}
}
