<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource {
	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray( Request $request ): array {
		return [ 
			'id' => $this->id,
			'name' => $this->name,
			'price' => $this->price,
			'standard' => $this->standard,
			'inStock' => $this->in_stock,
			'quantity' => $this->quantity,
			'tax' => $this->tax,
			'weight' => $this->weight,
			'manufactureCost' => $this->manufacture_cost,
			'category' => new CategoryResource( $this->whenLoaded( 'category' ) ),
			'producer' => new ProducerResource( $this->whenLoaded( 'producer' ) ),
			'creditor' => new CreditorResource( $this->whenLoaded( 'creditor' ) ),
			'createdAt' => $this->created_at,
		];
	}
}
