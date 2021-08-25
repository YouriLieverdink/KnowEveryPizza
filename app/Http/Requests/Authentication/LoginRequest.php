<?php

namespace App\Http\Requests\Authentication;

use App\Http\Requests\BaseFormRequest;

class LoginRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // The email address associated with the account.
            'email' => [
                'string',
                'required',
            ],
            // The credential code received via email.
            'code' => [
                'string',
                'required',
            ],
        ];
    }
}
