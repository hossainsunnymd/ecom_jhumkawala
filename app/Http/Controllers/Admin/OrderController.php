<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderSaveRequest;
use Exception;

class OrderController extends Controller
{
    //order list page
    public function index(Request $request)
    {
        $orders = Order::with('orderItems', 'user', 'orderAddress')->get();
        return Inertia::render('Backend/Order/OrderPage', compact('orders'));
    }

    //order details
    public function orderDetails(Order $order)
    {

        $order->load('orderItems.product.category', 'orderItems.product.brand', 'user', 'orderAddress');
        return Inertia::render('Backend/Order/OrderDetailPage', compact('order'));
    }

    //order edit
    public function edit(Order $order)
    {

        $order->load('orderItems', 'user');
        return Inertia::render('Backend/Order/OrderSavePage', compact('order'));
    }

    //order update
    public function update(OrderSaveRequest $request, Order $order)
    {
        try {
            if ($request->filled('order_status')) {
                if ($request->order_status == 'delivered') {
                    $order->update([
                        'delivery_date' => now(),
                        'order_status' => $request->order_status,
                        'cancel_date' => null
                    ]);
                } else if ($request->order_status == 'cancelled') {
                    $order->update([
                        'cancel_date' => now(),
                        'order_status' => $request->order_status,
                        'delivery_date' => null
                    ]);
                } else {
                    $order->update([
                        'order_status' => $request->order_status,
                        'cancel_date' => null,
                        'delivery_date' => null
                    ]);
                }
            }

            if ($request->filled('payment_status')) {
                $order->update([
                    'payment_status' => $request->payment_status,
                ]);
            }

            if ($request->filled('payment_method')) {
                $order->update([
                    'payment_method' => $request->payment_method,
                ]);

            }
            return redirect()->back()->with(['status' => true, 'message' => 'Order updated successfully']);
        } catch (Exception $e) {
            return redirect()->back()->with(['status' => false, 'message' => $e->getMessage()]);
        }
    }
}
