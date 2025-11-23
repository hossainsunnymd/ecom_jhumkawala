<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Inertia\Inertia;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CouponSaveRequest;

class CouponController extends Controller
{
    //list coupon
    public function index(){

        $coupons=Coupon::all();
        return Inertia::render('Backend/Coupon/CouponPage', compact('coupons'));
    }

    //coupon save page
    public function couponSavePage(Request $request){
        $coupon=Coupon::find($request->id);
        return Inertia::render('Backend/Coupon/CouponSavePage', compact('coupon'));
    }

    //store coupon
    public function store(CouponSaveRequest $request){
        try{
            Coupon::create($request->validated());
            return redirect()->back()->with(['status' => true, 'message' => 'Coupon created successfully']);
        }catch(Exception $e){
            return redirect()->back()->with(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    //update coupon
    public function update(CouponSaveRequest $request, Coupon $coupon){
        try{
            $coupon->update($request->validated());
            return redirect()->back()->with(['status' => true, 'message' => 'Coupon updated successfully']);
        }catch(Exception $e){
            return redirect()->back()->with(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    //delete coupon
    public function destroy(Coupon $coupon){
        try {
            $coupon->delete();
            return redirect()->back()->with(['status' => true, 'message' => 'Coupon deleted successfully']);
        } catch (Exception $e) {
            return redirect()->back()->with(['status' => false, 'message' => $e->getMessage()]);
        }
    }
}
