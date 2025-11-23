<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductSaveRequest extends FormRequest
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
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'discount_price' => 'nullable|numeric',
            'SKU' => 'required|string|max:255',
            'stock_status' => 'required|in:instock,outofstock',
            'featured' => 'nullable|boolean',
            'flash_sales' => 'nullable|boolean',
            'popular' => 'nullable|boolean',
            'quantity' => 'required|integer',
            // 'image' => $this->hasFile('image')?'image|mimes:jpeg,png,jpg,gif|max:2048':'nullable|string',
        ];
    }
}
