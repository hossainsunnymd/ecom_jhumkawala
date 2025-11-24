<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderSaveRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'order_no' => 'required',
            'name' => 'required|string',
            'phone' => 'required|string|min:11|max:11',
            'subtotal' => 'required|numeric',
            'total' => 'required|numeric',
            'tax' => 'required|numeric',
            'order_status' => 'required|string',
            'order_date' => 'required|string',
            'total_items' => 'required|numeric',
            'delivered_on'=>'nullable|string',
            'cancelled_on'=>'nullable|string',

        ];
    }
}
