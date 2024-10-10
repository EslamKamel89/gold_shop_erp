<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void {
		Schema::table( 'products', function (Blueprint $table) {
			//
			$table->float( 'weight' )->nullable();
			$table->float( 'manufacture_cost' )->nullable();
		} );
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::table( 'products', function (Blueprint $table) {
			$table->dropColumn( 'weight' );
			$table->dropColumn( 'manufacture_cost' );
		} );
	}
};
