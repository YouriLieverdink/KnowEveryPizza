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
                'required',
            ],
            // The photo of the product.
            'photo' => [
                'file',
                'required',
                'mimes:jpg,bmp,png',
            ],
            // The identifiers of the ingreidents on the product.
            'ingredients' => [
                'array',
                'required',
            ],
            'ingredients.*' => [
                'exists:ingredients,id',
                'integer',
            ],
        ];
    }
}
