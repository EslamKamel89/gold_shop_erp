<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Order extends Model {
	use HasFactory;
	protected $table = 'orders';
	protected $fillable = [ 
		'product_id',
		'invoice_id',
		'quantity',
		'description',
		"unit_price"
	];

	//! Relatioships
	public function product(): BelongsTo {
		return $this->belongsTo( Product::class);
	}
	public function invoice(): BelongsTo {
		return $this->belongsTo( Invoice::class);
	}
}
