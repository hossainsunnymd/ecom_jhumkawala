<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserSaveRequest;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    //list user
    public function index(){

        $users=User::all();
        return Inertia::render('Backend/User/UserPage', compact('users'));
    }

    //user save page
    public function userSavePage(Request $request){

        $user=User::find($request->id);
        return Inertia::render('Backend/User/UserSavePage', compact('user'));
    }

    //store
    public function store(UserSaveRequest $request){

        try{
            User::create($request->validated());
            return redirect()->back()->with(['status' => true, 'message' => 'User created successfully']);
        }catch(Exception $e){
            return redirect()->back()->with(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    //update user
    public function update(UserSaveRequest $request, User $user){

        try{
            $user->update($request->only('name', 'email', 'phone','user_type'));
            if($request->filled('password')){
                $user->update(['password' => Hash::make($request->password)]);
            }
            return redirect()->back()->with(['status' => true, 'message' => 'User updated successfully']);
        }catch(Exception $e){
            return redirect()->back()->with(['status' => false, 'message' => $e->getMessage()]);
        }
    }
}
