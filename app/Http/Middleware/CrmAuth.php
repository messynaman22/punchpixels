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
		$crmLogoutPages = array(
			URL::to('crm/login'),
			URL::to('crm/forgotpassword'),
			URL::to('crm/passwordreset')
		);

		if ($request->ajax())
			return response('Unauthorized.', 401);

		if( $this->admin==null  && !in_array($request->url(), $crmLogoutPages))
			return redirect()->to("crm/login");
		else
			return $next($request);
	}

}
