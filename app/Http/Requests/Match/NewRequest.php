<?php

namespace App\Http\Requests\Match;

use App\Http\Requests\BaseFormRequest;

class NewRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // The identifiers of the categories to include.
            'categories' => [
                'array',
                'present',
            ],
            'categories.*' => [
                'integer',
                'exists:categories,id',
            ],
            // The identifiers of the products to exclude.
            'exclude' => [
                'array',
                'present',
            ],
            'exclude.*' => [
                'integer',
                'exists:products,id',
            ],
        ];
    }
}
