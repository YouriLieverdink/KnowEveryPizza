<?php

namespace App\Http\Requests\Ingredient;

use App\Http\Requests\BaseFormRequest;

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
                'unique:ingredients',
                'required',
            ],
            // The unit in which the ingredient is measured.
            'unit' => [
                'string',
                'in:gram,millilitre,slice',
                'required',
            ],
        ];
    }
}
