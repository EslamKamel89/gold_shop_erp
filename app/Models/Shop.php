<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Shop extends Model {
	use HasFactory;
	protected $fillable = [ 
		'name',
	];
	//! Relationships
	public function invoices(): HasMany {
		return $this->hasMany( Invoice::class);
	}

	public function updateInvoices(): HasMany {
		return $this->hasMany( User::class, 'update_shop_id' );
	}
}
