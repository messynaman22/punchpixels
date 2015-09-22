<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegisterStep1PostRequest extends Request
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
            'fname' => 'required',
            'email' => 'required|email|unique:users',
        ];
    }


    public function messages()
    {
        return [
            'fname.required'=>'The First Name field is required.',
            'email.required' => 'We need to know your e-mail address!',
            'email.unique' => 'Email already taken',
        ];
    }

}
