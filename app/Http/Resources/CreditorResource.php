<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CreditorResource extends JsonResource {
	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray( Request $request ): array {
		return [ 
			'id' => $this->id,
			'name' => $this->name,
			'phone' => $this->phone,
			'address' => $this->address,
			'moneyBalance' => $this->money_balance,
			'goldBalance' => $this->gold_balance,
			'items' => ItemResource::collection( $this->whenLoaded( 'items' ) ),

		];
	}
}
