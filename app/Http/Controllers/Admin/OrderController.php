<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Inertia\Inertia;

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
}
