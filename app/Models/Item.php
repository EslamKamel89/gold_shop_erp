<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model {
	use HasFactory;
	protected $fillable = [ 
		'product_id',
		'creditor_id',
		'invoice_id',
		'shop_id',
		'code',
		'sold'
	];

	//! casts
	protected function casts(): array {
		return [ 
			'sold' => 'boolean',
		];
	}


	//! Relationships
	public function product(): BelongsTo {
		return $this->belongsTo( Product::class);
	}
	public function creditor(): BelongsTo {
		return $this->belongsTo( Creditor::class);
	}
	public function shop(): BelongsTo {
		return $this->belongsTo( Shop::class);
	}
	public function invoice(): BelongsTo {
		return $this->belongsTo( Invoice::class);
	}

}
