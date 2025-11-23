<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Inertia\Inertia;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProductSaveRequest;

class ProductController extends Controller
{
    //list product
    public function index()
    {
        $products = Product::with('category', 'brand')->get()
            ->map(function ($product) {
                $product->image = $product->getFirstMediaUrl('products');
                return $product;
            });
        return Inertia::render('Backend/Product/ProductPage', compact('products'));
    }

    public function store(ProductSaveRequest $request)
    {

        try {
            $product = Product::create(
                [
                    'name' => $request->name,
                    'slug' => Str::slug($request->name),
                    'price' => $request->price,
                    'discount' => $request->discount,
                    'discount_price' => $request->discount_price,
                    'short_description' => $request->short_description,
                    'SKU' => $request->SKU,
                    'stock_status' => $request->stock_status,
                    'featured' => $request->featured,
                    'flash_sales' => $request->flash_sales,
                    'popular' => $request->popular,
                    'quantity' => $request->quantity,
                    'category_id' => $request->category_id,
                    'brand_id' => $request->brand_id,
                ]
            );

            if ($request->hasFile('image')) {
                $product->addMediaFromRequest('image')->toMediaCollection('products');
            }
            return redirect()->back()->with(['status' => true, 'message' => 'Product created successfully']);
        } catch (Exception $e) {
            return redirect()->back()->with(['status' => false, 'message' => $e->getMessage()]);
        }

    }

    //product save page
    public function productSavePage(Request $request)
    {
        $product = Product::find($request->id);
        if ($product) {
            $product->image = $product->getFirstMediaUrl('products');
        }

        $brands = Brand::all();
        $categories = Category::all();
        return Inertia::render('Backend/Product/ProductSavePage', compact('product', 'brands', 'categories'));
    }

    //product update
    public function update(ProductSaveRequest $request, Product $product)
    {
        try {
            $product->update(
                [
                    'name' => $request->name,
                    'slug' => Str::slug($request->name),
                    'price' => $request->price,
                    'discount' => $request->discount,
                    'discount_price' => $request->discount_price,
                    'short_description' => $request->short_description,
                    'SKU' => $request->SKU,
                    'stock_status' => $request->stock_status,
                    'flash_sales' => $request->flash_sales,
                    'featured' => $request->featured,
                    'popular' => $request->popular,
                    'quantity' => $request->quantity,
                    'category_id' => $request->category_id,
                    'brand_id' => $request->brand_id,
                ]
            );

            if ($request->hasFile('image')) {
                $product->clearMediaCollection('products');
                $product->addMediaFromRequest('image')->toMediaCollection('products');
            }

            return redirect()->back()->with(['status' => true, 'message' => 'Product updated successfully']);
        } catch (Exception $e) {
            return redirect()->back()->with(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    //delete product
    public function destroy(Product $product)
    {
        try {
            $product->delete();
            return redirect()->back()->with(['status' => true, 'message' => 'Product deleted successfully']);
        } catch (Exception $e) {
            return redirect()->back()->with(['status' => false, 'message' => $e->getMessage()]);
        }
    }
}
