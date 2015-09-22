<?php namespace App\Http\Middleware;

use Closure;
use Session;
use URL;
class CrmAuth {
	private $admin;
	
	public function __construct(){
		$this->admin = session()->get("admin",null);
	}

	public function handle($request, Closure $next)
	{

		if ($request->ajax())
			return response('Unauthorized.', 401);

		if( $this->admin==null  && $request->url()!=URL::to("crm/login") )
			return redirect()->to("crm/login");
		else
			return $next($request);
	}

}
