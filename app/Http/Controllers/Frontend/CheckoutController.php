<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Inertia\Inertia;
use App\Models\ProductCart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;



class CheckoutController extends Controller
{
    //checkout page
    public function index(Request $request)
    {
        $customerCart = ProductCart::where('user_id', $request->user()->id)->with('product')->get();
        $cartTotal = $customerCart->sum(function ($cart) {
            return $cart->product->price * $cart->quantity;
        });

        $cartDiscount = $customerCart->sum(function ($cart) {
            return $cart->product->discount * $cart->quantity;
        });


        return Inertia::render('Frontend/Checkout', compact('cartTotal', 'customerCart', 'cartDiscount'));

    }

}
