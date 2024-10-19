<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void {
		Schema::create( 'products', function (Blueprint $table) {
			$table->id();
			$table->foreignId( 'category_id' )->nullable()->constrained()->nullOnDelete();
			$table->foreignId( 'producer_id' )->nullable()->constrained()->nullOnDelete();
			$table->foreignId( 'creditor_id' )->nullable()->constrained()->nullOnDelete();
			$table->string( 'name' );
			$table->float( 'price' );
			$table->string( 'standard' );
			$table->boolean( 'in_stock' )->default( false );
			$table->integer( 'quantity' )->default( 0 );
			$table->float( 'tax' )->nullable();
			$table->timestamps();
		} );
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::dropIfExists( 'products' );
	}
};
