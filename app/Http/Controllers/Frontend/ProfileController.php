<?php

namespace App\Http\Controllers\Frontend;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Exception;

class ProfileController extends Controller
{
    //user profile
    public function profilePage(Request $request){

        $user=$request->user();
        return Inertia::render('Frontend/AccountDetails', compact('user'));

    }

    //update profile
    public function updateProfile(ProfileUpdateRequest $request){
        try{
            $request->user()->update($request->validated());
            return redirect()->back()->with(['status' => true, 'message' => 'Profile updated successfully']);
        }catch(Exception $e){
            return redirect()->back()->with(['status' => false, 'message' => $e->getMessage()]);
        }
    }
}
