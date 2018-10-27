<?php

namespace App\Users\Domain\Requests;

use App\App\Http\Requests\APIRequest;
class LoginRequestForm extends APIRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required'
        ];
    }
}
