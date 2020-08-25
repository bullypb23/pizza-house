<?php

namespace App\Http\Services;

use App\Order;
use App\OrderItem;
use App\Product;
use App\Size;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;

class OrderService
{
	const DELIVERY_PRICE = 2;

	public function storeOrder($request)
	{
		if ($user = User::where('id', '=', $request->user_id)->first()) {
			$userId = $user->id;
		} else {
			$userId = NULL;
		}

		$order = new Order();
		$order->name = $request->name;
		$order->address = $request->address;
		$order->phone = $request->phone;
		$order->email = $request->email;
		$order->total_price = $request->total_price + self::DELIVERY_PRICE;
		$order->user_id = $userId;

		$order->save();

		foreach ($request->get('order_items') as $reqOrderItem) {
			$product = Product::where('id', '=', $reqOrderItem['product_id'])->first();
			$size = Size::where('size', '=', $reqOrderItem['size'])->first();

			$orderItem = new OrderItem();
			$orderItem->price = $reqOrderItem['price'];
			$orderItem->quantity = $reqOrderItem['quantity'];
			$orderItem->order_id = $order->id;
			$orderItem->product_id = $product->id;
			$orderItem->size_id = $size->id;
			$orderItem->save();
		}

		// Mail::to($request->email)->send(new OrderMail($order));
	}
}
