<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class LoginCrmRequest extends Request {

	
	public function authorize()
	{
		return true;
	}


	public function rules()
	{
		return [			
			'email' => 'required|email',
			'password'=>'required',
		];
	}

}
