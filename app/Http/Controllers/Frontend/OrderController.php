<?php

namespace App\Http\Controllers\Frontend;

use Exception;
use Inertia\Inertia;
use App\Models\Order;
use App\Models\Address;
use App\Models\OrderItem;
use App\Models\ProductCart;
use App\Models\OrderAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\OrderPlaceRequest;

class OrderController extends Controller
{
    public function index(Request $request){
        $orders = Order::where('user_id', $request->user()->id)->with('user')->orderBy('id', 'desc')->paginate(10);
        return Inertia::render('Frontend/AccountOrders', compact('orders'));
    }

    //order detail
    public function orderDetails(Order $order){
        $order->load('orderItems.product.category','orderItems.product.brand','user','orderAddress');

        $order->orderItems->each(function($orderItem){
            $orderItem->product->image = $orderItem->product->getFirstMediaUrl('products')??null;
        });
        return Inertia::render('Frontend/AccountOrdersDetails', compact('order'));
    }


        //order place
    public function orderPlace(OrderPlaceRequest $request)
    {

        $defaultAddress = Address::where('user_id', $request->user()->id)->where('is_default', 1)->first();

        if (!$defaultAddress) {
            $orderAddress = [
                'user_id' => $request->user()->id,
                'name' => $request->name,
                'phone' => $request->phone,
                'pincode' => $request->pincode,
                'state' => $request->state,
                'city' => $request->city,
                'address' => $request->address,
                'locality' => $request->locality,
                'landmark' => $request->landmark,
            ];

            Address::create($orderAddress);
        } else {
            $orderAddress = [
                'user_id' => $request->user()->id,
                'name' => $defaultAddress->name,
                'phone' => $defaultAddress->phone,
                'pincode' => $defaultAddress->pincode,
                'state' => $defaultAddress->state,
                'city' => $defaultAddress->city,
                'address' => $defaultAddress->address,
                'locality' => $defaultAddress->locality,
                'landmark' => $defaultAddress->landmark,
            ];
        }
        $productCarts = ProductCart::where('user_id', $request->user()->id)->with('product')->get();

        if ($productCarts->isEmpty()) {
            return redirect()->back()->with(['status' => false, 'message' => 'Cart is empty']);
        }
        DB::beginTransaction();
        try {
            $subtotal = $productCarts->sum(function ($cart) {
                return $cart->product->price * $cart->quantity;
            });

            $discount = $productCarts->sum(function ($cart) {
                return $cart->product->discount * $cart->quantity;
            });

            $total = $subtotal - $discount;


            $order = [
                'user_id' => $request->user()->id,
                'subtotal' => $subtotal,
                'discount' => $discount,
                'shipping_charge' => 80,
                'total' => $total,
            ];

            $order = Order::create($order);

            foreach ($productCarts as $cart) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                    'color' => $cart->color,
                    'size' => $cart->size,
                    'qty' => $cart->quantity,
                    'price' => $cart->product->price,
                ]);
            }

            $orderAddress['order_id'] = $order->id;

            OrderAddress::create($orderAddress);

            ProductCart::where('user_id', $request->user()->id)->delete();
            DB::commit();
            return redirect("/customer/order/{$order->id}/details")->with(['status' => true, 'message' => 'Order placed successfully']);

        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['status' => false, 'message' => $e->getMessage()]);
        }

    }
}
