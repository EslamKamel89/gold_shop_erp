<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model {
	use HasFactory;
	protected $fillable = [ 
		'product_id',
		'code',
	];

	//! Relationships
	public function product(): BelongsTo {
		return $this->belongsTo( Product::class);
	}

}
