<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreOrder;
use App\Order;
use App\Http\Services\OrderService;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
        return response()->json(Order::where('user_id', '=', auth()->user()->id)->with('orderItems.product')->with('orderItems.size')->get());
    }

    public function store(StoreOrder $request)
    {
        $this->orderService->storeOrder($request);

        return response()->json(['message' => 'You have successfully completed order!']);
    }
}
