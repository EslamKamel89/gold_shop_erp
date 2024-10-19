<?php
declare(strict_types=1);
namespace App\Helpers;
use App\Models\Product;
class InvocieHelper {
	public function addPriceToEachOrder( array $orders ): array {
		foreach ( $orders as $k => $order ) {
			$orders[ $k ]['total_price'] = $order['quantity'] * $order['unit_price'];
		}
		return $orders;
	}

	public function getTotalInvoicePrice( array $orders ): float {
		$invoicePrice = 0;
		foreach ( $orders as $k => $order ) {
			$invoicePrice += $order['total_price'];
		}
		return $invoicePrice;
	}


}
