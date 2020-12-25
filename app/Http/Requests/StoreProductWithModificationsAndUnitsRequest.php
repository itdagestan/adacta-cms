<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductWithModificationsAndUnitsRequest extends FormRequest
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
            'price_new' => 'required|numeric',
            'category_id' => 'required|integer|exists:product_categories,id',
            'description' => 'nullable|string',
            'thumbnail_file' => 'image|mimes:jpeg,png,jpg|max:2048',
            'product_unit.count.*' => 'integer',
            'product_unit.unit_type.*' => 'string|max:255',
            'product_unit.price.*' => 'numeric',
            'product_modification.name.*' => 'string|max:255',
            'product_modification.price.*' => 'numeric',
            'product_modification.price_type.*' => 'string|max:255',
        ];
    }
}
