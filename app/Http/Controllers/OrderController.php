<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreOrder;
use App\Order;
use App\OrderItem;
use App\Product;
use App\Size;
use App\User;

class OrderController extends Controller
{
    const DELIVERY_PRICE = 2;

    public function index()
    {
        // $orders = 
        return response()->json(Order::where('user_id', '=', auth()->user()->id)->with('orderItems.product')->with('orderItems.size')->get());
    }

    public function store(StoreOrder $request)
    {
        if ($user = User::where('id', '=', $request->user_id)->first()) {
            $userId = $user->id;
        } else {
            $userId = NULL;
        }

        $order = new Order();
        $order->name = $request->get('name');
        $order->address = $request->get('address');
        $order->phone = $request->get('phone');
        $order->email = $request->get('email');
        $order->total_price = $request->get('total_price') + self::DELIVERY_PRICE;
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

        return response()->json(['message' => 'You have successfully completed order!']);
    }
}
