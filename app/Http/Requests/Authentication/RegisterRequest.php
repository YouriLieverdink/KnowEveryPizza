<?php

namespace App\Http\Requests\Authentication;

use App\Http\Requests\BaseFormRequest;

class RegisterRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // The email address the user would like to use.
            'email' => [
                'string',
                'required',
            ],
            // The invitation code received via email.
            'code' => [
                'string',
                'required',
            ],
        ];
    }
}
