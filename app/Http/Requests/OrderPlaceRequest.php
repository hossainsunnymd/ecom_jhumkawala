<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Address;

class OrderPlaceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
public function rules()
{
    $hasDefault = Address::where('user_id', auth()->user()->id)
                         ->where('is_default', 1)
                         ->exists();

    return $hasDefault ? [] : [
        'name'      => 'required|string|max:255',
        'phone'     => 'required|string|min:11|max:11',
        'pincode'   => 'required|string|max:6',
        'state'     => 'required|string|max:255',
        'city'      => 'required|string|max:255',
        'address'   => 'required|string|max:255',
        'locality'  => 'required|string|max:255',
        'landmark'  => 'nullable|string|max:255',
    ];
}

}
