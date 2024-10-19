<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Creditor;
use App\Models\GoldPrice;
use App\Models\Item;
use App\Models\Producer;
use App\Models\Product;
use App\Models\Shop;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Value;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
	/**
	 * Seed the application's database.
	 */
	public function run(): void {
		User::create( [ 
			'name' => 'admin',
			'email' => 'admin@gmail.com',
			'role' => 'admin',
			'password' => '123456789',
		] );
		GoldPrice::insert( [ 
			[ 
				'standard' => ' 24 Karat Gold',
				'description' => 'description ',
				'price' => 36000,
			], [ 
				'standard' => ' 18 Karat Gold',
				'description' => 'description ',
				'price' => 3300,
			], [ 
				'standard' => ' 14 Karat Gold',
				'description' => 'description ',
				'price' => 3200,
			], [ 
				'standard' => ' 10 Karat Gold',
				'description' => 'description ',
				'price' => 3000,
			],
		] );
		Shop::create( [ 'name' => 'Shop gold 1' ] );
		Shop::create( [ 'name' => 'Shop gold 2' ] );
		Value::create( [ 'tax' => 10 ] );
		for ( $i = 1; $i <= 50; $i++ ) {
			Category::create( [ 'name' => "category " . fake()->words( 3, true ) ] );
			Producer::create( [ 'name' => "Producer " . fake()->words( 3, true ) ] );
			Creditor::create( [ 
				'name' => fake()->name(),
				'phone' => fake()->phoneNumber(),
				'address' => fake()->address(),
				'money_balance' => fake()->numberBetween( 1000, 10000 ),
				'gold_balance' => fake()->numberBetween( 1000, 10000 ),
			] );
			$product = Product::create( [ 
				'category_id' => $i,
				'producer_id' => $i,
				'name' => 'Product  ' . fake()->words( 3, true ),
				"price" => fake()->numberBetween( 1000, 10000 ),
				'standard' => fake()->randomElement( [ " 24 Karat Gold", "18 Karat Gold", "14 Karat Gold", "10 Karat Gold" ] ),
				// 'in_Stock' => ,
				// 'quantity' => 80 + $i,
				// 'tax' => 7 / $i,
			] );
			for ( $k = 1; $k <= 10; $k++ ) {
				Item::create( [ 
					'product_id' => $i,
					'creditor_id' => $i,
					'shop_id' => fake()->randomElement( [ 1, 2 ] ),
					"invoice_id" => null,
					'code' => "code-product-$i-item-$k",
					'sold' => false,
				] );
			}
		}
	}
}
