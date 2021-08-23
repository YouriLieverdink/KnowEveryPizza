<?php

namespace App\Http\Requests;

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
                'required',
                'string',
            ],
            // The invitation code received via email.
            'code' => [
                'required',
                'string',
            ],
        ];
    }
}
