<?php

namespace App\Http\Requests\Ingredient;

use Illuminate\Validation\Rule;
use App\Http\Requests\BaseFormRequest;

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
                Rule::unique('ingredients')->ignore($this->route('ingredient')),
            ],
            // The unit in which the ingredient is measured.
            'unit' => [
                'string',
                'in:gram,millilitre,slice',
            ],
        ];
    }
}
