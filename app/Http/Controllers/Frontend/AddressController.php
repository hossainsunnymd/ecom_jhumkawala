<?php

namespace App\Http\Controllers\Frontend;

use Inertia\Inertia;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddressSaveRequest;
use Exception;

class AddressController extends Controller
{
    //list address
    public function index(Request $request)
    {

        $addressList = Address::where('user_id', $request->user()->id)->get();
        return Inertia::render('Frontend/AccountAddress', compact('addressList'));
    }

    //address save
    public function addressSavePage(Request $request)
    {

        $address = Address::find($request->id);
        return Inertia::render('Frontend/AccountAddressSave', compact('address'));
    }

    //create new address
    public function store(AddressSaveRequest $request)
    {

        try {
            $isDefault = Address::where('user_id', $request->user()->id)->where('is_default', 1)->first();
            if ($isDefault) {
                $isDefault->is_default = 0;
                $isDefault->save();
            }
            Address::create([
                'user_id' => $request->user()->id,
                'name' => $request->name,
                'phone' => $request->phone,
                'pincode' => $request->pincode,
                'state' => $request->state,
                'city' => $request->city,
                'address' => $request->address,
                'locality' => $request->locality,
                'landmark' => $request->landmark,
                'is_default' => $request->is_default,
            ]);
            return redirect()->back()->with(['status' => true, 'message' => 'Address added successfully']);
        } catch (Exception $e) {
            return redirect()->back()->with(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    //update address
    public function update(AddressSaveRequest $request, Address $address)
    {
        try {
            $address->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'pincode' => $request->pincode,
                'state' => $request->state,
                'city' => $request->city,
                'address' => $request->address,
                'locality' => $request->locality,
                'landmark' => $request->landmark,
                'is_default' => $request->is_default,
            ]);
            return redirect()->back()->with(['status' => true, 'message' => 'Address updated successfully']);
        } catch (Exception $e) {
            return redirect()->back()->with(['status' => false, 'message' => $e->getMessage()]);
        }
    }
}
