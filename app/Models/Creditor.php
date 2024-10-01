<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Creditor extends Model {
	use HasFactory;
	protected $fillable = [ 
		'name',
		'phone',
		'address',
		'money_balance',
		'gold_balance',
	];

	//! Relationships
	public function Products(): HasMany {
		return $this->hasMany( Product::class);
	}
}
