<?php

namespace App\Http\Controllers\Frontend;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ProductReview;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CustomerReviewSaveRequest;

class ReviewController extends Controller
{
    //store customer review
    public function store(CustomerReviewSaveRequest $request)
    {
        try {
            ProductReview::updateOrCreate(
                [
                    'product_id' => $request->product_id,
                    'user_id' => $request->user()->id,
                ],
                [
                    'rating' => $request->rating,
                    'description' => $request->description
                ]
                );
            return back()->with(['status' => true, 'message' => 'Review Submitted successfully']);
        } catch (Exception $e) {
            return back()->with(['status' => false, 'message' => $e->getMessage()]);
        }
    }
}
