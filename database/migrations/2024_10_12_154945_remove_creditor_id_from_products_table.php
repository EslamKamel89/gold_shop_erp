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
			$table->dropForeign( 'products_creditor_id_foreign' );
			$table->dropColumn( 'creditor_id' );
		} );
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::table( 'products', function (Blueprint $table) {
			//
		} );
	}
};
