<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\APIRequest;

class UserLoginFormRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' => 'required|min:8|max:32',
            'email' => 'required|exists:users,email',
        ];
    }
}
