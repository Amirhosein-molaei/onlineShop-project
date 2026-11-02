<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => 'required|string|max:255|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ?؟]+$/u',
            'tags' => 'required|string|max:255|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹+،ء-ي., ?؟]+$/u',
            'brand_id' => 'required|numeric|exists:brands,id',
            'product_category_id' => 'required|numeric|exists:product_categories,id',
            'status' => 'required|in:0,1',
            'marketable' => 'required|in:0,1',
            'description' => 'required|string|min:10|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ?؟]+$/u',
            'image' => 'required|image|mimes:png,jpg,jpeg,gif',
            'weight' => 'nullable|numeric|gt:0',
            'height' => 'nullable|numeric|gt:0',
            'length' => 'nullable|numeric|gt:0',
            'width' => 'nullable|numeric|gt:0',
            'price' => 'required|numeric|gt:0',
            'marketable_number' => 'nullable|numeric|gt:0',
        ];
    }
}
