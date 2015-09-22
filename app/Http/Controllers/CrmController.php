<?php namespace App\Http\Controllers;

use Request;
use Session;
use App\Crmadmins;
use Response;
use Hash;
use App\Http\Requests\LoginCrmRequest;

class CrmController extends Controller{
	private $token;
	private $admin;

	public function __construct(){
		$this->token = Session::token();
		$this->admin = session()->get("admin",null);
		$this->middleware("crmauth");
	}

	public function getIndex(){
		return redirect()->to("crm/login");
	}

	public function getLogin(){		
		$error = session()->get("errormessage", "default");			
		return view("crm.login")->with("extra","CRM")->with("message",$error);
	}

	public function postLogin(LoginCrmRequest $login){
		$input = $login->all();
		
		if($input["_token"]!=$this->token)
			return redirect()->to("crm/login")->with("errormessage","Invalid Request");
		$admin = Crmadmins::where("email","=",$input["email"]);
		if($admin->count()==0)
			return redirect()->to("crm/login")->with("errormessage","Invalid user. Please register first.");				
		
		$admin = $admin->first();
		
		if($admin->user_state==4 || $admin->user_state == 5)
			return redirect()->to("crm/login")->with("errormessage","Invalid user. Please register first.");				

		if(!Hash::check($input["password"],$admin->password))
			return redirect()->to("crm/login")->with("errormessage","Invalid password");
		
		session()->set("admin",["id"=>$admin->id,"username"=>$admin->username,"email"=>$admin->email,"user_state"=>$admin->user_state]);
		return redirect()->to("crm/response");
	}

	public function getResponse(){			
		return view("crm.dashboard.response")->with("admin",$this->admin)->with("resclass","set");
	}

	public function getOptions(){
		return view("crm.dashboard.options")->with("admin",$this->admin)->with("optclass","set");
	}

	public function getInvite(){
		if($this->admin["user_state"] != 1)
			return redirect()->to("crm/response");

		return view("crm.dashboard.invite")->with("admin",$this->admin)->with("invclass","set");
	}

	public function getAgreement(){
		return view("crm.dashboard.agreement")->with("admin",$this->admin)->with("agreclass","set");
	}

	public function getUser(){
		return view("crm.dashboard.user")->with("admin",$this->admin)->with("invclass","set");
	}
	public function getLogout(){
		\Session::remove("admin");
		return redirect()->to("crm\login");
	}
}


