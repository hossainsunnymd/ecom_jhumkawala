<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProductDetailRequest extends FormRequest
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
            'product_id' => [
                'required',
                'exists:products,id',
                Rule::unique('product_details', 'product_id')->ignore($this->route('productDetail')),
            ],
            'description' => 'nullable|string',
            'image1' => $this->hasFile('image1') ? 'image|mimes:jpeg,png,jpg,webp' : 'nullable|string',
            'image2' => $this->hasFile('image2') ? 'image|mimes:jpeg,png,jpg,webp' : 'nullable|string',
            'image3' => $this->hasFile('image3') ? 'image|mimes:jpeg,png,jpg,webp' : 'nullable|string',
            'image4' => $this->hasFile('image4') ? 'image|mimes:jpeg,png,jpg,webp' : 'nullable|string',
        ];
    }
}
