<?php

namespace App\Http\Requests;

class StoreInvitationRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // The email address of the user who has to be invited.
            'email' => [
                'required',
                'string',
            ],
        ];
    }
}
