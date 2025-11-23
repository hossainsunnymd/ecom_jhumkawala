<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderSaveRequest;

class OrderController extends Controller
{
    //order list page
    public function index(Request $request)
    {
        $orders=Order::with('orderItems','user','orderAddress')->get();
        return Inertia::render('Backend/Order/OrderPage',compact('orders'));
    }

    //order details
    public function orderDetails(Order $order){

        $order->load('orderItems.product.category','orderItems.product.brand','user','orderAddress');
        return Inertia::render('Backend/Order/OrderDetailPage',compact('order'));
    }

    //order edit
    public function edit (Order $order){

        $order->load('orderItems','user');
        return Inertia::render('Backend/Order/OrderSavePage',compact('order'));
    }

    //order update
    public function update(OrderSaveRequest $request,Order $order){

    }
}
