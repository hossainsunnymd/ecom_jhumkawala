<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\ProductReview;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductReviewRequest;

class ProductReviewController extends Controller
{
    //product review list
    public function index()
    {

        $productReviews = ProductReview::with('product', 'user')->paginate(100);

        return Inertia::render('Backend/ProductReview/ProductReviewPage', compact('productReviews'));
    }

    //store product review
    public function store(ProductReviewRequest $request)
    {

        try {
            ProductReview::updateOrCreate(
                [
                    'product_id' => $request->product_id,
                    'user_id' => $request->user_id,
                ]
                ,
                [
                    'rating' => $request->rating,
                    'description' => $request->description
                ]
            );
            return redirect()->back()->with(['status' => true, 'message' => 'Product review created successfully']);
        } catch (Exception $e) {
            return redirect()->back()->with(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    //product review save page

    public function productReviewSavePage(Request $request)
    {
        $productReview = ProductReview::find($request->id);
        return Inertia::render('Backend/ProductReview/ProductReviewSavePage', compact('productReview'));
    }

    //product review update
    public function update(ProductReviewRequest $request, ProductReview $productReview)
    {
        try {
            $productReview->update([
                'rating' => $request->rating,
                'description' => $request->description
            ]);
            return redirect()->back()->with(['status' => true, 'message' => 'Product review updated successfully']);
        } catch (Exception $e) {
            return redirect()->back()->with(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    //destroy product review
    public function destroy(ProductReview $productReview)
    {
        try {
            $productReview->delete();
            return redirect()->back()->with(['status' => true, 'message' => 'Product review deleted successfully']);
        } catch (Exception $e) {
            return redirect()->back()->with(['status' => false, 'message' => $e->getMessage()]);
        }
    }


}
