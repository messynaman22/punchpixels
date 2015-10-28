<?php namespace App\Http\Controllers;

use Request;
use Session;
use App\Crmadmins;
use App\CrmPasswordReset;
use Response;
use Hash;
use Mail;
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

		if($admin->status != 'active')
			return redirect()->to("crm/login")->with("errormessage","Invalid user. Please register first.");

		if(!Hash::check($input["password"],$admin->password))
			return redirect()->to("crm/login")->with("errormessage","Invalid password");
		
		session()->set("admin",["id"=>$admin->id,"username"=>$admin->username,"email"=>$admin->email,"role"=>$admin->role]);
		return redirect()->to("crm/response");
	}

    public function getForgotpassword(){
        return view("crm.forgotpassword");
    }

    public function postForgotpassword(){
        $input = Request::all();

        $admin = Crmadmins::whereRaw("email = ? and status='active'", array($input['email']));
        if($admin->count()==0){
            return view("crm.forgotpassword")->with('errormessage', "User doesn't exist");
        }

        $admin = $admin->first();
        $token = str_random(45);
        $url = URL::to("/crm/passwordreset/?email={$input['email']}&token={$token}");

        $passwordReset = new CrmPasswordReset();
        $passwordReset->email = $admin->email;
        $passwordReset->token = $token;
        $passwordReset->save();

        Mail::queue('emails.reset_password', array("to" => $admin->username, 'url'=> $url), function($message) use ($admin){
            $message->to($admin->email, $admin->username)->subject("Password reset at Credit1solutions.com CRM");
        });
        return view("crm.forgotpassword")->with('successmessage', "An emails has been sent to email ".$input['email']);
    }

    public function getPasswordReset(){
        $input = Request::all();
        $passwordReset = CrmPasswordReset::whereRaw("email = ? and token = ?", array($input['email'], $input['token']));
        if($passwordReset->count()==0){
            App::abort(403, 'Unauthorized action.');
        }

        $admin = Crmadmins::whereRaw("email = ? and status='active'", array($input['email']));
        if($admin->count()==0){
            App::abort(403, 'Unauthorized action.');
        }

        return view('crm.passwordreset', array('admin'=> $admin->first(), 'token'=> $input['token']));
    }
    public function postPasswordReset(){

    }

    public function getResponse(){
		return view("crm.dashboard.response")->with("admin",$this->admin)->with("resclass","set");
	}

	public function getOptions(){
		if($this->admin["role"] != 'Admin')
			return redirect()->to("crm/response");
		return view("crm.dashboard.options")->with("admin",$this->admin)->with("optclass","set");
	}

	public function getInvite(){
		if($this->admin["role"] != 'Admin')
			return redirect()->to("crm/response");

		return view("crm.dashboard.invite")->with("admin",$this->admin)->with("invclass","set");
	}

	public function getAgreement(){
		if($this->admin["role"] != 'Admin')
			return redirect()->to("crm/response");
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


