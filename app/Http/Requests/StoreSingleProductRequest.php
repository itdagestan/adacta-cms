<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSingleProductRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('products')->ignore($this->route('id'))
            ],
            'price_old' => 'nullable|numeric',
            'price_new' => 'nullable|numeric',
            'category_id' => 'required|integer|exists:product_categories,id',
            'description' => 'nullable|string',
            'thumbnail_file' => 'image|mimes:jpeg,png,jpg|max:2048',
            'is_active' => 'nullable|string',
        ];
    }
}
