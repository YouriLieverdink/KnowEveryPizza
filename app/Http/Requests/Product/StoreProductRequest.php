<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\BaseFormRequest;

class StoreProductRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // The title of the product.
            'title' => [
                'string',
                'unique:products',
                'required',
            ],
            // The photo of the product.
            'photo' => [
                'image',
            ],
            // The identifiers of the ingredients on the product.
            'ingredients' => [
                'array',
            ],
            'ingredients.*' => [
                'integer',
                'exists:ingredients,id',
            ],
        ];
    }
}
