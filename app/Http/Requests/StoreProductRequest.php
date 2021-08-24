<?php

namespace App\Http\Requests;

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
            // The identifiers of the ingreidents on the product.
            'ingredients' => [
                'array',
                'required',
                'min:1',
            ],
            'ingredients.*' => [
                'exists:ingredients,id',
            ],
        ];
    }
}
