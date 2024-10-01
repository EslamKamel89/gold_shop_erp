<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Invoice extends Model {
	use HasFactory;
	protected $fillable = [ 
		'user_id',
		'shop_id',
		'code',
		'total_price',
		'customer_name',
		'customer_phone',
		'update_user_id',
		'update_shop_id',
	];

	//!Relationships
	public function products(): BelongsToMany {
		return $this->belongsToMany(
			related: Product::class,
			table: 'orders',
			foreignPivotKey: 'invoice_id',
			relatedPivotKey: 'product_id',
		)->withPivot( 'quantity', 'description' )
			->withTimestamps();
	}
	public function invoiceCreator(): BelongsTo {
		return $this->belongsTo( User::class, 'user_id' );
	}
	public function invoiceUpdater(): BelongsTo {
		return $this->belongsTo( User::class, 'update_user_id' );
	}

	public function createdInShop(): BelongsTo {
		return $this->belongsTo( Shop::class, 'shop_id' );
	}

	public function updatedInShop(): BelongsTo {
		return $this->belongsTo( Shop::class, 'update_shop_id' );
	}
}
