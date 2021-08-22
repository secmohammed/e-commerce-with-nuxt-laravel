<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\APIRequest;
use Illuminate\Support\Arr;

class UserRegisterFormRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'password' => 'required|min:8|max:32|confirmed',
            'email' => 'required|unique:users,email',
        ];
    }

    public function validated()
    {
        return array_merge(
            Arr::except(parent::validated(), ['password_confirmation']),
            ['password' => \Hash::make($this->request->get('password'))]
        );
    }
}
