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
            // The identifiers and amounts of the ingredients on the product.
            'ingredients' => [
                'array',
            ],
            'ingredients.*.id' => [
                'integer',
                'exists:ingredients,id',
                'required',
            ],
            'ingredients.*.medium' => [
                'numeric',
                'min:0',
                'required',
            ],
            'ingredients.*.italian' => [
                'numeric',
                'min:0',
            ],
            'ingredients.*.large' => [
                'numeric',
                'min:0',
            ],
            'ingredients.*.family' => [
                'numeric',
                'min:0',
            ],
        ];
    }
}
