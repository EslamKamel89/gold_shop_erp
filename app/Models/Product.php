<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model {
	use HasFactory;
	protected $fillable = [ 
		'category_id',
		'producer_id',
		'name',
		'price',
		'standard',
		'in_stock',
		'quantity',
		'tax',
		'weight',
		'manufacture_cost',
	];

	protected function casts(): array {
		return [ 
			'in_stock' => 'boolean',
		];
	}

	//! Relationships
	public function category(): BelongsTo {
		return $this->belongsTo( Category::class);
	}
	public function producer(): BelongsTo {
		return $this->belongsTo( Producer::class);
	}
	public function items(): HasMany {
		return $this->hasMany( Item::class);
	}
	public function invoices(): BelongsToMany {
		return $this->belongsToMany(
			related: Invoice::class,
			table: 'orders',
			foreignPivotKey: 'product_id',
			relatedPivotKey: 'invoice_id',
		)->withPivot( 'quantity', 'description' )
			->withTimestamps();
	}
}
