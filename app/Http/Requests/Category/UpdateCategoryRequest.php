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
                'unique:categories',
            ],
            // The photo of the category.
            'photo' => [
                'image',
            ],
            // The identifiers of the products in the category.
            'products' => [
                'array',
            ],
            'products.*' => [
                'integer',
                'exists:products,id',
            ],
        ];
    }
}
