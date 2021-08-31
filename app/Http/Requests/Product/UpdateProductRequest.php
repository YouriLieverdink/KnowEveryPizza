<?php

namespace App\Http\Requests\Product;

use Illuminate\Validation\Rule;
use App\Http\Requests\BaseFormRequest;

class UpdateProductRequest extends BaseFormRequest
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
                Rule::unique('products')->ignore($this->route('product')),
            ],
            // The photo of the product.
            'photo' => [
                'image',
            ],
            // The identifiers and amounts of the ingreidents on the product.
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
