<?php

namespace App\Http\Controllers\Frontend;

use Inertia\Inertia;
use App\Models\Brand;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductVariant;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function about()
    {
        return Inertia::render('Frontend/About');
    }


    public function accountReview()
    {
        return Inertia::render('Frontend/AccountReview');
    }

    public function accountWishList()
    {
        return Inertia::render('Frontend/AccountWishList');
    }

    public function cart()
    {
        return Inertia::render('Frontend/Cart');
    }

    public function checkout()
    {
        return Inertia::render('Frontend/Checkout');
    }

    public function contact()
    {
        return Inertia::render('Frontend/Contact');
    }

    public function productDetails($slug)
    {
        $product = Product::where('slug', $slug)->with('details', 'category', 'brand', 'reviews.user:id,name')->first();
        $product->image = $product->getFirstMediaUrl('products');

        $relatedProducts = Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)->with('details:id,product_id,image1')->latest()->get()->map(function ($product) {
            $product->image = $product->getFirstMediaUrl('products');
            if($product->details){
                $product->details->image1 = $product->details->getFirstMediaUrl('product_details1') ?? null;
            }
            return $product;
        });

        if ($product->details) {
            $product->details->image1 = $product->details->getFirstMediaUrl('product_details1') ?? null;
            $product->details->image2 = $product->details->getFirstMediaUrl('product_details2') ?? null;
            $product->details->image3 = $product->details->getFirstMediaUrl('product_details3') ?? null;
            $product->details->image4 = $product->details->getFirstMediaUrl('product_details4') ?? null;
        }

        return Inertia::render('Frontend/Details', compact('product', 'relatedProducts'));
    }

    public function home()
    {
        $categories = Category::latest()->get()->map(function ($category) {
            $category->image = $category->getFirstMediaUrl('categories');
            return $category;
        });

        $flashSales = Product::whereNotNull('discount_price')->where('flash_sales', 1)->with('details')->latest()->get()->map(function ($product) {
            $product->image = $product->getFirstMediaUrl('products');

            if ($product->details && $product->details->getFirstMediaUrl('product_details1')) {
                $product->details->image1 = $product->details->getFirstMediaUrl('product_details1');
            }

            return $product;
        });

        $featuredProducts = Product::where('featured', 1)->with('details')->latest()->get()->map(function ($product) {
            $product->image = $product->getFirstMediaUrl('products');

            if ($product->details && $product->details->getFirstMediaUrl('product_details1')) {
                $product->details->image1 = $product->details->getFirstMediaUrl('product_details1');
            }
            return $product;
        });

        $sliders=Slider::get()->map(function($slider){
            $slider->image=$slider->getFirstMediaUrl('sliders');
            return $slider;
        });

        return Inertia::render('Frontend/Home', compact('categories', 'flashSales', 'featuredProducts','sliders'));
    }

    public function login()
    {
        return Inertia::render('Frontend/Login');
    }

    public function register()
    {
        return Inertia::render('Frontend/Register');
    }

    public function orderConfirmation()
    {
        return Inertia::render('Frontend/OrderConfirmation');
    }

    public function privacyPolicy()
    {
        return Inertia::render('Frontend/PrivacyPolicy');
    }

    public function profile()
    {
        return Inertia::render('Frontend/Profile');
    }

    public function shop()
    {
        $products = Product::with('category', 'details')->latest()->get()->map(function ($product) {
            $product->image = $product->getFirstMediaUrl('products');
            if ($product->details) {

                $product->details->image1 = $product->details->getFirstMediaUrl('product_details1') ?? null;
                $product->details->image2 = $product->details->getFirstMediaUrl('product_details2') ?? null;
                $product->details->image3 = $product->details->getFirstMediaUrl('product_details3') ?? null;
                $product->details->image4 = $product->details->getFirstMediaUrl('product_details4') ?? null;

                return $product;
            }
            return $product;
        });

        $categories = Category::orderBy('name')->get();
        $brands = Brand::orderBy('name')->get();
        return Inertia::render('Frontend/Shop', compact('products', 'categories', 'brands'));
    }

    public function termsAndCondition()
    {
        return Inertia::render('Frontend/TermsAndCondition');
    }

    public function wishList()
    {
        return Inertia::render('Frontend/WishList');
    }
}
