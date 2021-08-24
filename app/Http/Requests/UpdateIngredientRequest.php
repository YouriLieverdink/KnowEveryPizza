<?php

namespace App\Http\Requests;

class UpdateIngredientRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // The title of the ingredient.
            'title' => [
                'string',
            ],
            // The unit in which the ingredient is measured.
            'unit' => [
                'string',
                'in:gram,millilitre,slice',
            ],
        ];
    }
}
