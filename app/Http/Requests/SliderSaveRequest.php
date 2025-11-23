<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderSaveRequest extends FormRequest
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
            'tagline' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'rank' => 'required|integer|unique:sliders,rank,' . $this->route('slider')?->id,
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }
}
