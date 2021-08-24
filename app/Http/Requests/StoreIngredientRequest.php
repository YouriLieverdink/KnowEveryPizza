<?php

namespace App\Http\Requests;

class StoreIngredientRequest extends BaseFormRequest
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
                'required',
            ],
            // The unit in which the ingredient is measured.
            'unit' => [
                'string',
                'required',
                'in:gram,millilitre,slice',
            ],
        ];
    }
}
