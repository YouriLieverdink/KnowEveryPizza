<?php

namespace App\Http\Requests\Product;

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
            ],
            // The identifiers of the ingreidents on the product.
            'ingredients' => [
                'array',
                'present',
            ],
            'ingredients.*' => [
                'exists:ingredients,id',
            ],
        ];
    }
}
