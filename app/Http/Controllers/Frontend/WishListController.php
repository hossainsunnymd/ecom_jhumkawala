<?php

namespace App\Http\Controllers\Frontend;

use Exception;
use Inertia\Inertia;
use App\Models\ProductWish;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WishListController extends Controller
{

    //user wish list
    public function index(Request $request)
    {
        $wishLists = ProductWish::with('product.details','product.category')->where('user_id', $request->user()->id)->get()->map(function ($wishList) {
            $wishList->product->details->image1 = $wishList->product->details->getFirstMediaUrl('product_details1') ?? null;
            $wishList->product->details->image2 = $wishList->product->details->getFirstMediaUrl('product_details2') ?? null;
            $wishList->product->details->image3 = $wishList->product->details->getFirstMediaUrl('product_details3') ?? null;
            $wishList->product->details->image4 = $wishList->product->details->getFirstMediaUrl('product_details4') ?? null;
            return $wishList;
        });
        return Inertia::render('Frontend/AccountWishList', ['wishLists' => $wishLists]);
    }

    //add to wish list
    public function store(Request $request)
    {
        try{
            $productWish = ProductWish::where('product_id', $request->product_id)->where('user_id', $request->user()->id)->first();
            if ($productWish) {
                return redirect()->back()->with(['status' => false, 'message' => 'Product already in wish list']);
            }
            ProductWish::create([
                'product_id' => $request->product_id,
                'user_id' => $request->user()->id,
            ]);
            return redirect()->back()->with(['status' => true, 'message' => 'Product added to wish list successfully']);
        }catch(Exception $e){
            return redirect()->back()->with(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    //remove from wish list
    public function destroy(Request $request,$productId){
        try{
            ProductWish::where('product_id', $productId)->where('user_id', $request->user()->id)->delete();
            return redirect()->back()->with(['status' => true, 'message' => 'Product removed from wish list successfully']);
        }catch(Exception $e){
            return redirect()->back()->with(['status' => false, 'message' => $e->getMessage()]);
        }
    }
}
