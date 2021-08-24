<?php

namespace App\Http\Requests\Category;

use App\Http\Requests\BaseFormRequest;

class UpdateCategoryRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // The title of the category.
            'title' => [
                'string',
            ],
            // The identifiers of the products in the category.
            'products' => [
                'array',
            ],
            'products.*' => [
                'exists:products,id',
                'integer',
            ],
        ];
    }
}
