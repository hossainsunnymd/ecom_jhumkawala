<?php

namespace App\Http\Controllers\Frontend;

use Exception;
use App\Models\Product;
use App\Models\ProductCart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Inertia\Inertia;

class CartController extends Controller
{
    //cart list
    public function index(Request $request)
    {

        $cartList = ProductCart::where('user_id', $request->user()->id)->with('product')->get()->map(function ($cart) {
            $cart->product->image = $cart->product->getFirstMediaUrl('products');
            return $cart;
        });

        $cartTotal = $cartList->sum(function ($cart) {
            return $cart->product->price * $cart->quantity;
        });

        $cartDiscount = $cartList->sum(function ($cart) {
            return $cart->product->discount * $cart->quantity;
        });
        return Inertia::render('Frontend/Cart', compact('cartList', 'cartTotal', 'cartDiscount'));
    }

    //add to cart
    public function addToCart(Request $request)
    {

        try {

            //check is prodduct already in cart
            if (ProductCart::where('product_id', $request->product_id)->where('user_id', $request->user()->id)->exists()) {
                return redirect()->back()->with(['status' => false, 'message' => 'Product already in cart']);
            }

            if(!$request->filled('quantity')){
                return redirect()->back()->with(['status' => false, 'message' => 'Quantity is required']);
            }

            $product = Product::findOrFail($request->product_id);
            if ($product->quantity < $request->quantity) {
                return redirect()->back()->with(['status' => false, 'message' => 'quantity is not available']);
            }

            if ($product->discount && $product->discount_price > 0) {
                $price = $product->discount_price;
            } else {
                $price = $product->price;
            }

            ProductCart::create([
                'user_id' => $request->user()->id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'price' => $price
            ]);

            return redirect()->back()->with(['status' => true, 'message' => 'Product added to cart']);
        } catch (Exception $e) {
            return redirect()->back()->with(['status' => false, 'message' => $e->getMessage()]);
        }

    }

    //remove to cart
    public function removeFromCart(Request $request, $id)
    {
        try {
            ProductCart::where('product_id', $id)->where('user_id', $request->user()->id)->delete();
            return redirect()->back()->with(['status' => true, 'message' => 'Product removed from cart']);
        } catch (Exception $e) {
            return redirect()->back()->with(['status' => false, 'message' => $e->getMessage()]);
        }
    }
}
