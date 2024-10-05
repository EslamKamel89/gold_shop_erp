<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Creditor;
use App\Models\Producer;
use App\Models\Product;
use App\Models\Shop;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
	/**
	 * Seed the application's database.
	 */
	public function run(): void {
		for ( $i = 1; $i <= 10; $i++ ) {

			$shop = Shop::create( [ 'name' => 'Shop gold ' . $i ] );
			$category = Category::create( [ 'name' => 'Category gold ' . $i ] );
			$producer = Producer::create( [ 'name' => 'Producer gold ' . $i ] );
			$creditor = Creditor::create( [ 
				'name' => 'Creditor gold ' . $i,
				'phone' => 'Creditor gold phone ' . $i,
				'address' => 'Creditor gold address ' . $i,
				'money_balance' => 100 * $i,
				'gold_balance' => 100 * $i,
			] );
			$product = Product::create( [ 
				'category_id' => $category->id,
				'producer_id' => $producer->id,
				'creditor_id' => $creditor->id,
				'name' => 'Product gold ' . $i,
				"price" => 100 * $i,
				'standard' => "24_gold",
				'in_Stock' => true,
				'quantity' => 80 + $i,
				'tax' => 7 / $i,
			] );

		}
	}
}
