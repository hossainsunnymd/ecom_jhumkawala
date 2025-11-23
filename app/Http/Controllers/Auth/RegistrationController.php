<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;

class RegistrationController extends Controller
{
    //register page
    public function registerPage(){
        return Inertia::render('Frontend/Register');
    }

    //register
    public function register(RegisterRequest $request){
        try{
            User::create($request->validated());
            return redirect()->back()->with(['status' => true, 'message' => 'Registration successful']);
        }catch(Exception $e){
            return redirect()->back()->with(['status' => false, 'message' => $e->getMessage()]);
        }
    }

}
