<?php

namespace App\Users\Domain\Requests;

use App\App\Http\Requests\APIRequest;
class RegisterRequestForm extends APIRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|unique:users,email',
            'name' => 'required',
            'password' => 'required|confirmed'
        ];
    }
}
