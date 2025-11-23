<?php

namespace App\Http\Controllers\Auth;

use Exception;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //login page
    public function loginPage(){
        return Inertia::render('Frontend/Login');
    }

    //login
    public function login(LoginRequest $request){
        try{
            if(Auth::attempt($request->only('phone', 'password'))){
                return redirect()->back()->with(['status' => true, 'message' => 'Login successful']);
            }
            return redirect()->back()->with(['status' => false, 'message' => 'Login failed']);
        }catch(Exception $e){
            return redirect()->back()->with(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    //logout
    public function logout(Request $request){

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
