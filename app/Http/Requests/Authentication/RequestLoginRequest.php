<?php

namespace App\Http\Requests\Authentication;

use App\Http\Requests\BaseFormRequest;

class RequestLoginRequest extends BaseFormRequest
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
                'required',
                'string',
            ],
        ];
    }
}
