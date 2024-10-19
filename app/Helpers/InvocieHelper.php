<?php
declare(strict_types=1);
namespace App\Helpers;
use App\Models\Product;
class InvocieHelper {
	public function addPriceToEachOrder( array $orders ): array {
		$orderPrice = 0;
		foreach ( $orders as $k => $order ) {
			$productPrice = Product::find( $order["product_id"] )->price;
			$orderPrice += $order["quantity"] * $productPrice;
			$orders[ $k ]['total_price'] = $orderPrice;
			$orders[ $k ]['unit_price'] = $productPrice;
			$orderPrice = 0;
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

	static function ordersCollectionResource( $orders ): array {
		$ordersCollection = [];
		foreach ( $orders as $k => $order ) {
			$ordersCollection[] = [ 
				'id' => $order->id,
				'productId' => $order->product_id,
				'invoiceId' => $order->invoice_id,
				'quantity' => $order->quantity,
				'unitPrice' => $order->unit_price,
				'createdAt' => $order->created_at,
				'updatedAt' => $order->updated_at,
			];
		}
		return $ordersCollection;
	}
}
