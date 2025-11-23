<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductDetail;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductDetailRequest;

class ProductDetailController extends Controller
{
    //list product detail
    public function index()
    {
        $productDetails = ProductDetail::with('product')->get()->map(function ($productDetail) {

            $productDetail->image1 = $productDetail->getFirstMediaUrl('product_details1')??null;
            $productDetail->image2 = $productDetail->getFirstMediaUrl('product_details2')??null;
            $productDetail->image3 = $productDetail->getFirstMediaUrl('product_details3')??null;
            $productDetail->image4 = $productDetail->getFirstMediaUrl('product_details4')??null;

            return $productDetail;

        });
        return Inertia::render('Backend/ProductDetail/ProductDetailPage', compact('productDetails'));
    }

    //store product detail
    public function store(ProductDetailRequest $request)
    {
        try {
            $productDetail = ProductDetail::create([
                'product_id' => $request->product_id,
                'description' => $request->description
            ]);

            if ($request->hasFile('image1')) {
                $productDetail->addMediaFromRequest('image1')
                    ->toMediaCollection('product_details1');
            }
            if ($request->hasFile('image2')) {
                $productDetail->addMediaFromRequest('image2')
                    ->toMediaCollection('product_details2');
            }
            if ($request->hasFile('image3')) {
                $productDetail->addMediaFromRequest('image3')
                    ->toMediaCollection('product_details3');
            }
            if ($request->hasFile('image4')) {
                $productDetail->addMediaFromRequest('image4')
                    ->toMediaCollection('product_details4');
            }

            return redirect()->back()->with(['status' => true, 'message' => 'Product detail created successfully']);

        } catch (Exception $e) {
            return redirect()->back()->with(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    //product detail save page
    public function productDetailSavePage(Request $request)
    {

        $productDetail = ProductDetail::find($request->id);
        $products = Product::all();
        if ($productDetail) {
            $productDetail->image1 = $productDetail->getFirstMediaUrl('product_details1');
            $productDetail->image2 = $productDetail->getFirstMediaUrl('product_details2');
            $productDetail->image3 = $productDetail->getFirstMediaUrl('product_details3');
            $productDetail->image4 = $productDetail->getFirstMediaUrl('product_details4');
        }
        return Inertia::render('Backend/ProductDetail/ProductDetailSavePage', compact('productDetail', 'products'));
    }

    //update product detail
    public function update(ProductDetailRequest $request, ProductDetail $productDetail)
    {
        try {
            $productDetail->update([
                'product_id' => $request->product_id,
                'description' => $request->description
            ]);

            if ($request->hasFile('image1')) {
                $productDetail->clearMediaCollection('product_details1');
                $productDetail->addMediaFromRequest('image1')
                    ->toMediaCollection('product_details1');
            }
            if ($request->hasFile('image2')) {
                $productDetail->clearMediaCollection('product_details2');
                $productDetail->addMediaFromRequest('image2')
                    ->toMediaCollection('product_details2');
            }
            if ($request->hasFile('image3')) {
                $productDetail->clearMediaCollection('product_details3');
                $productDetail->addMediaFromRequest('image3')
                    ->toMediaCollection('product_details3');
            }
            if ($request->hasFile('image4')) {
                $productDetail->clearMediaCollection('product_details4');
                $productDetail->addMediaFromRequest('image4')
                    ->toMediaCollection('product_details4');
            }

            return redirect()->back()->with(['status' => true, 'message' => 'Product detail updated successfully']);

        } catch (Exception $e) {
            return redirect()->back()->with(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    //destroy product detail
    public function destroy(ProductDetail $productDetail)
    {
        try {
            $productDetail->delete();
            return redirect()->back()->with(['status' => true, 'message' => 'Product detail deleted successfully']);
        } catch (Exception $e) {
            return redirect()->back()->with(['status' => false, 'message' => $e->getMessage()]);
        }
    }
}
