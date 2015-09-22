<?php namespace App\Http\Middleware;

use Closure;
use Session;
use Request;
use Redirect;
use Response;
class TokenVerifier {
	private $token;
	public function __construct(){
		$this->token = Session::token();
	}

	public function handle($request, Closure $next)
	{	
			if($request->ajax()){
				if($request->input("token")===$this->token)
					return $next($request);
			}							
			else{
				return Response::json("Invalid request",200);
			}

	}

}
