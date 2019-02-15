<?php

namespace App\Addresses\Domain\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddressRequestForm extends FormRequest
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
            'name' => 'required',
            'address_1' => 'required',
            'city' => 'required',
            'postal_code' => 'required',
            'country_id' => 'required|exists:countries,id',
            'default' => 'nullable|boolean'
        ];
    }
}
