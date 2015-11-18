<?php namespace App\Http\Controllers;

use Request;
use Response;
use DB;
use Carbon\Carbon;
use Input;
use File;
use Session;
use App\User;
use App\Order;
use App\Profile;
use App\Laststep;
use URL;
use PDF;
use Excel;
use App\Crmadmins;
use App\ContractAgreementSection;
use Mail;
use App\NotifSub;
use App\EmailDetails;
use Hash;
use App\Services\ContractAgreementService;

class ApiController extends Controller{

	private $contractAgreementService = null;
	public function __construct(ContractAgreementService $contractAgreementService){
		$this->middleware("token");
		$this->contractAgreementService = $contractAgreementService;
	}

	public function getPages(){
		$result = DB::table('pages')->orderBy('id', 'desc')->get();
		return Response::json($result,200);
	}

	public function getWhyus(){
		$input = Input::all();
		$result = DB::table('slider')->where('type','=',$input["type"])->get();
		$returnArray = ["data"=>$result,"type"=>"why_us"];
		return $this->validResponse($returnArray);
	}

	public function postWhyus(){
		$input = Request::all();
		DB::table('slider')
		    ->where('type','=',$input["type"])
		    ->where('id','=',$input["id"])
		    ->update(array(
		        'title' => $input['slider_title'],
		        'content' => $input['slider_content'],
		        'button1' => $input['first_button'],
		        'button2' => $input['second_button'],
		        'description'=>($input["type"]=="main") ? $input["description"]:"",
		    ));
		 return $this->validResponse("Success");
	}

	public function postCreatewhyus(){
		$input = Request::all();
		if($input["type"]=="why_us"){
			$insert = array(
					        'type' => $input['type'],
					        'title' => $input['slider_title'],
					        'content' => $input['slider_content'],
					        'button1' => $input['first_button'],
					        'button2' => $input['second_button'],
					    );
		}else{
			$insert = array(
					        'type' => $input['type'],
					        'title' => $input['slider_title'],
					        'content' => $input['slider_content'],
					        'button1' => $input['first_button'],
					        'button2' => $input['second_button'],
					        'description' => $input["description"],
					    );
		}

		$response = DB::table('slider')
		    ->insert($insert);
		$result = DB::table('slider')->where('title','=',$input["slider_title"])->get();    
		 return $this->validResponse($result[0]);
	}

	public function postDelpage(){
		$inputs = Request::all();
		DB::table('pages')->where('id','=',$inputs["id"])->delete();	
		return $this->validResponse("Deleted");	
	}

	public function postDelwhyus(){
		$inputs = Request::all();
		DB::table('slider')
		    ->where('id' , '=' , $inputs["id"])
		    ->where('type','=',$inputs['type'])
		    ->delete();
		return $this->validResponse("Deleted");
	}

	private function validResponse($message){
		return Response::json($message,200);
	}

	private function errorResponse($message){
		return Response::json($message,404);
	}

	
	public function postMaindata(){
		$input = Input::all();
		if(!empty($input)){
		if($input["main_banner"]!="")
			DB::table('images')
			->where('name','=','main_banner')
			->where('position','main')
			->update(array('image' => $input["main_banner"]));

		foreach($input as $key => $val)
			DB::table('content')
				->where('position','main')
				->where('name',$key)
				->update(array('content' => $val));

		return $this->validResponse("Success");
		}else{
			return $this->errorResponse("Failure");
		}

	}

	public function postHeader(){
		$input = Input::all();
		if(!empty($input)){
			$signup_button = $input['signup_button'];
			$main_logo = $input['main_logo'];
			if($main_logo!="") {				
				DB::table('logo')
					->where('name', 'main_logo')
					->update(array('image' => $main_logo));
			}
			DB::table('content')
				->where('name', 'signup_button')
				->update(array('content' => $signup_button));
		}else{
			return $this->errorResponse("Failure");
		}
	}

	public function postFooter(){
		$input = Input::all();
		if(!empty($input)){
			$content = $input['content'];
			$logo = $input['logo'];
			$image = $input['image'];
			if($logo!=""){			
				DB::table('logo')
					->where('name', 'footer_main_logo')
					->update(array('image' => $logo));
			}
			if($image!=""){				
				DB::table('images')
					->where('name', 'footer_main_image')
					->update(array('image' => $image));
			}
			foreach($content as $key => $val){
				if(!is_null($val)){
					DB::table('content')
						->where('name', $key)
						->update(array('content' => $val));
				}
			}
			return $this->validResponse("Success");
		}else{
			return $this->errorResponse("Error!");
		}	
	}	

	public function postTrust(){
		$input = Input::all();
		if(!empty($input)){
			foreach($input as $key=>$val)
				DB::table('content')
					->where('name','=',$key)
					->update(array('content'=>$val));
			return $this->validResponse("Success");
		}else{
			return $this->errorResponse("Failure");
		}
	}

	public function postMainfiles(){
		if(!Request::hasFile("file"))
			return $this->errorResponse("File not present.");
		
		$rand = time() + rand(0,5000);
		$name = md5($rand).'.'.Request::file("file")->getClientOriginalExtension();
		Request::file("file")->move('images',$name );
		return $this->validResponse($name);		
	}

	public function getFriendfooter(){
		$result = DB::table('images')
			->where('position','=','footer-friends-logo')
			->get();
		return $this->validResponse($result);	
	}

	public function postCreatefooterfriend(){
		$input = Input::all();
		if(!empty($input)&&$input["image"]!=""){
			$id = DB::table('images')
				->insertGetId(array('image' => $input["image"],
					'alt' => $input['alt'],
					'position' => 'footer-friends-logo',
				));	
			$data = ["id"=>$id,"image"=>$input["image"],"alt"=>$input["alt"],"position"=>"footer-friends-logo","date"=>Carbon::now()];		
			return $this->validResponse($data);
		}	
		return $this->errorResponse("Error");
		
	}

	public function postEditfooterfriend(){
		$input = Input::all();
		if(empty($input))
			return $this->errorResponse("Error");
		$result = DB::table('images')
			->where('position','=','footer-friends-logo')
			->find($input["id"]);
		
		

		$update = array('alt' => $input['alt']);		
		if($input["image"]!=""){
		$update['image']=$input["image"];

			$filename = public_path().'/images/'.$result->image;
			if (File::exists($filename)) {
				File::delete($filename);
			}
			$image = $input["image"];
		}else{
			$image = $result->image;
		}

		DB::table('images')
			->where('position', 'footer-friends-logo')
			->where('id', $input["id"])
			->update($update);
		$data = ["id"=>$input["id"],"image"=>$input["image"],"alt"=>$input["alt"],"position"=>"footer-friends-logo","date"=>Carbon::now()];		
		return $this->validResponse($data);
	}

	public function postDelfriendfooter(){
		$input = Input::all();
		if(empty($input))
			return $this->errorResponse("Error");
		DB::table('images')
			->where('position', 'footer-friends-logo')
			->where('id' , '=' , $input["id"])
			->delete();
	}

	public function getClientreview(){
		$result = DB::table('clients_reviews_slider')->get();
		
		return $this->validResponse($result);
	}

	public function postEditreview(){
		$input = Input::all();
		$id=$input["id"];
		$result = DB::table('clients_reviews_slider')
		    ->find($id);
		if(empty($input))
			return $this->errorResponse("Error");

		    $update = array(
		        'content' => $input['content']
		    );
		    $img = $input['image'];
		    if($img!="") {		        
		        $update['image'] = $img;
		        $filename = public_path().'/images/'.$result->image;
		        if (File::exists($filename)) {
		            File::delete($filename);
		        }
		    }
		    DB::table('clients_reviews_slider')
		        ->where('id', $id)
		        ->update($update);
		return $this->validResponse($input);
	}

	public function postCreatereview(){
		$input = Input::all();
		         if(empty($input)||$input["image"]=="")
		         	return $this->errorResponse("error");
		$img = $input["image"];
		$input["id"] = DB::table('clients_reviews_slider')
		                  ->insertGetId(array('image' => $img,
		                      'content' => $input['content']
		                  ));	
		 return $this->validResponse($input);		             	         
	}

	public function postDelreview(){
		$input = Input::all();
		$id=$input["id"];
		    $img = DB::table('clients_reviews_slider')->find($id);
		    $filename = public_path().'/images/'.$img->image;

		    if (File::exists($filename)) {
		        File::delete($filename);
		    }
		    DB::table('clients_reviews_slider')
		        ->where('id' , '=' , $id)
		        ->delete();
		    return $this->validResponse("Success");
		
	}

	public function getCustomersatisfaction(){
		$result = DB::table('content')
			->where('position','=','customer_satisfaction')
			->get();	
								
		return $this->validResponse($result);
	}

	public function postCustomersatisfaction(){
		$input = Input::all();
		DB::table('content')
			->where('id', '=', $input["id"])				
			->update(array('display_name' => $input["display_name"],'content' => $input['content']));
		return $this->validResponse("success");
	}

	public function postResponse(){
		$inputs = Request::all();
		if($inputs["date"]==NULL)
			$userData = User::all();
		else
			$userData = User::where("created_at",">=",$this->retDate($inputs["date"]) )->get();
	
		$users = array();
		$response = array();		
		$response["data"] = array();
		$response["states"] = array();
		$response["hauList"] = array();
		$response["interestedList"] = array();
		$response["hauList"] = $this->hauList();
		$response["interestedList"] = $this->interestedList();
		$response["states"] = $this->stateList();
		foreach ($userData as $user) {
			$profile = Profile::where("user_id","=",$user->id)->first();
			if($profile){
				$order = Order::where("user_id","=",$profile->id)->first();
				if($order){
					$laststep = Laststep::where("user_id","=",$profile->id)->first();
					if ($laststep){
						$user->date = $user->created_at->toFormattedDateString();
						$user->today = $user->created_at->toDateString();
						$user->time_submitted = $user->created_at->format('M j, Y g:i A');;
						array_push($response["data"], ["order"=>$order->toArray(),
							"profile"=>$profile->toArray(),
							"user"=>$user->toArray(),
							"last"=>$laststep->toArray()]);
					}
				}
			}
		}
		return $this->validResponse($response);
	}

	public function postUpdateresponse(){
		$input = Request::all();
		$update = [$input["fieldName"] =>$input["fieldValue"]];
		$idName = ($input["tableName"] == "last_step") ? "user_id" : "id";
		if($input["fieldName"] =="zip" ){
			$update["city"] = $input["city"];
			$update["state"] = $input["state"];
		}
		return DB::table($input["tableName"])
		 	->where($idName, '=', $input["id"])				
		 	->update($update);

	}


	public function postGenfile(){
		set_time_limit(300);
		$input = Request::all();
		
		if($input["type"]=="pdf"){
			$filen = $this->genPdf($this->retInputs($input["data"],$input["extra"]));
			return $this->validResponse(["url"=> URL::asset("pdfs")."/".$filen,"filename"=>$filen]);
		}else if($input["type"]=="xls"){
			$userData = array();
			$userData = $input["data"];
			$filename = (time() + rand(0,5000))."";			
			
			Excel::create($filename, function($excel) use ($userData){
			    $excel->sheet("User sheet", function($sheet) use ($userData){
			   	 $sheet->setOrientation('landscape');
			   	 $sheet->loadView('excel.exceldata')->with('userData', $userData);
			    });
			   })->store('xls',  public_path()."/excel" );
			return $this->validResponse(["url"=>URL::asset("excel")."/".$filename.".xls","filename"=>$filename.".xls"]);
		} else{
			return $this->errorResponse("Invalid input");
		}
	}

	private function genPdf($input){
		$input['pdf_content'] = $this->contractAgreementService->getAll($input);
		$pdf = PDF::loadView('pdf.agreement', $input);
		$paper_size = array(0,0,790,850);
		$pdf->setPaper($paper_size);
		$pdf->setOrientation("portrait");
		$name = $input["step1_serialno"].".pdf";
		$pdf->save( public_path()."/pdfs/".$name );
		chmod(public_path()."/pdfs/".$name, 0777);
		return $name;
	}

	
	private function retInputs($data,$extra){
			$input = [
			"step1_fname"=>$data["profile"]["fname"],
			"step1_serialno"=>$data["user"]["sno"],
			"step1_mname"=>$data["profile"]["mname"],
			"step1_lname"=>$data["profile"]["lname"],
			"step1_paddress"=>$data["profile"]["paddress"],
			"step1_city"=>$data["profile"]["city"],
			"step1_state"=>$data["profile"]["state"],
			"step1_zip"=>$data["profile"]["zip"],
			"step1_mpaddress"=>$data["profile"]["mpaddress"],
			"step1_mcity"=>$data["profile"]["mcity"],
			"step1_mstate"=>$data["profile"]["mstate"],
			"step1_mzip"=>$data["profile"]["mzip"],
			"step1_hno"=>$data["profile"]["hno"],
			"step1_mno"=>$data["profile"]["mno"],
			"step1_email"=>$data["user"]["email"],
			"step2_packagedate"=>$extra["package_start"],
			"step2_package"=>$data["order"]["package"],
			"step2_card_number"=>$data["order"]["card_number"],
			"step2_month"=>$data["order"]["month"],
			"step2_year"=>$data["order"]["year"],
			"step2_cvv"=>$data["order"]["cvv"],
			"step2_full_name"=>$data["order"]["full_name"],
			"step2_card_type"=>$extra["card_type"],
			"step2_account_type"=>$data["order"]["account_type"],
			"step2_bank_name"=>$data["order"]["bank_name"],
			"step2_routing_number"=>$data["order"]["routing_number"],
			"step2_account_number"=>$data["order"]["account_number"],
			"month"=>$extra["month"],
			"day"=>$extra['day'],
			"year"=>$extra['year'],
			"dls"=>$data["last"]["driving_license_state"],
			"dln"=>$data["last"]["driving_license_number"],
			"ssn"=>$data["last"]["social_security_number"],
			];

		          $states = $this->stateList(); 
		          $input["step1_state_info"] = $states[$input["step1_state"]];
		          $packageDate = explode("-", $input["step2_packagedate"]."");
		          $currentDate = explode("-", $extra["today"]."");
		          // $currentDate = Carbon::createFromDate($currentDate[0],$currentDate[1],$currentDate[2]);
		          $then = Carbon::createFromDate($packageDate[0],$packageDate[1],$packageDate[2]);
		          $after = Carbon::createFromDate($packageDate[0],$packageDate[1],$packageDate[2]);
		          $input["credit_report_date"] = $data["user"]["time_submitted"];
		          $input["first_payment_date"] = $then->toFormattedDateString();
		          $input["service_start_date"] = $then->addDays(30)->toFormattedDateString();
		          $input["today"] = $this->formatDate(Carbon::createFromDate($currentDate[0],$currentDate[1],$currentDate[2])->toDateString());
		          $input["three_today"] = $this->formatDate(Carbon::createFromDate($currentDate[0],$currentDate[1],$currentDate[2])->addDays(3)->toDateString());
		          $input["fpd_pdf"] = $input["first_payment_date"];
		          $input["ssd_pdf"] =   $input["service_start_date"] ;
		          $input["crd_pdf"] = Carbon::createFromDate($currentDate[0],$currentDate[1],$currentDate[2])->toFormattedDateString();
		          $input["signature"] = explode("-",$input["ssn"])[2];
		          $input["agreement_date"] = Carbon::createFromDate($currentDate[0],$currentDate[1],$currentDate[2])->format('jS \d\a\y \\of F') .", ". substr(Carbon::createFromDate($currentDate[0],$currentDate[1],$currentDate[2])->format('Y'),0,2)."{".substr(Carbon::createFromDate($currentDate[0],$currentDate[1],$currentDate[2])->format('Y'),2,4)."}";
		          $tempDate = array();
		          for($i=4;$i<=10;$i++){
		          $tempDate[$i.""] = $i."th"; 
		          }
		          $selectedDay = array_merge( ["1"=>"1st","2"=>"2nd","3"=>"3rd"],$tempDate);
		          $input["day_diff"] = $selectedDay[$after->diffInDays(Carbon::createFromDate($currentDate[0],$currentDate[1],$currentDate[2]))-1];
		          $input["package_image"] =($input["step2_package"]=="Comprehensive")? URL::asset("/images").'/cs.jpg':URL::asset("/images").'/fss.jpg';

		        return $input;	        
		        		      
	}

	public function postCreatecrmadmin(){
		$input = Request::all();
		$admin = Crmadmins::where("email","=",$input["email"]);
		if($admin->count()!=0)
			return $this->errorResponse("User already registered!");		

		$crm = new Crmadmins;
		$crm->email = $input["email"];
		$crm->password = "";
		$crm->role  = $input["role"];
		$crm->username = "";
		$crm->status = "invited";
		$random = str_random(45);
		$crm->token = $random;
		$url = URL::to("/crm/signup/".$random);

		$mailData = array();
		$mailData["to"] = $input["email"];		
		$mailData["url"] = $url ;

		Mail::queue('emails.signup', $mailData, function($message) use ($input){
		   $message->to($input["email"], 'Rujul Solanki')->subject("Welcome to Credit1solutions.com CRM");
		});

        if($crm->save())
		 	return $this->validResponse( $crm->toArray());
        else
		 	return $this->errorResponse("Unable to create user");
	}

	public function postChangeaccess(){
		$input = Request::all();
		$admin = Crmadmins::where("id","=",$input["id"]);
		if($admin->count()==0)
			return $this->errorResponse("No such user!");				
		$admin = $admin->first();
		$admin->role = $input["role"];
		return $this->validResponse($admin->save());

	}

	public function postDeletecrmadmin(){
		$input = Request::all();
		Crmadmins::where("id","=",$input["id"])->delete();
		return $this->validResponse("success");
	}

	public function postUnblockcrmadmin(){
		$input = Request::all();
		$admin = Crmadmins::where("id","=",$input["id"]);
		$admin = $admin->first();
		$admin->status = 'active';
		$admin->login_attemps = 0;
		$admin->save();
		return $this->validResponse("success");
	}

	
	public function getCrmadmins(){
		$crmadmins = Crmadmins::all();
		$responseData = ["invitations"=>[],"admins"=>[]];
		foreach ($crmadmins as $admin ) {
            if($admin->status == 'invited'){
                array_push($responseData["invitations"],$admin->toArray());
            }else if($admin->status == 'active' || $admin->status == 'blocked' ){
                array_push($responseData["admins"],$admin->toArray());
            }
		}
		return $this->validResponse($responseData);
	}

	public function getEmaildetails(){
		$receipt = EmailDetails::where("type","=","receipt");
		$notifs = EmailDetails::where("type","=","notification");
		$emails = NotifSub::all();
		$responseData = ["receipt"=>[],"notification"=>[]];
		
		$responseData["receipt"] = ($receipt->count()==0)?"absent":$receipt->first();
		$responseData["notification"] = ($notifs->count()==0)?"absent":$notifs->first();
		$responseData["emails"] = $emails;

		return $this->validResponse($responseData);
		
	}

	public function postCreateemaildetails(){
		$inputs = Request::all();
		$emailObj = EmailDetails::where("type","=",$inputs["data"]["type"]);
		if($emailObj->count()==0){
			EmailDetails::create($inputs['data']);
			return $this->validResponse("success");
		}
		$emailObj = $emailObj->first();
		$emailObj->to_from = $inputs["data"]["to_from"];
		$emailObj->subject = $inputs["data"]["subject"];
		$emailObj->message = $inputs["data"]["message"];
		$emailObj->include_data = intval($inputs["data"]["include_data"]);
		$emailObj->save();
		return $this->validResponse("success");		
	}
	
	public function postNewuser(){
		$input = Request::all();
		$input = $input["data"];
		
		$userData = $this->createUser($input["user"],$input["profile"]);
		$orders = $this->createOrders($input["order"],$userData["profile"]);
		$last = $this->createLaststep($input["last"],$userData["profile"]);
		$userData["user"]->date = $userData["user"]->created_at->toFormattedDateString();	
		$userData["user"]->today = $userData["user"]->created_at->toDateString();
		$userData["user"]->time_submitted = $userData["user"]->created_at->format('M j, Y g:i A');;			 		
		$response = ["order"=>$orders->toArray(),
					    "profile"=>$userData["profile"]->toArray(),
					    "user"=>$userData["user"]->toArray(),
					    "last"=>$last->toArray()];
		return $this->validResponse($response);				
	}

	public function postAddemails(){
		$input = Request::all();
		$notifs = new NotifSub;
		$notifs->email = $input["email"];
		$notifs->included = 1;
		$notifs->save();
		$notifs->included = "1";
		return $this->validResponse($notifs);
	}

	public function postDelemails(){
		$input = Request::all();
		NotifSub::destroy($input["id"]);
		return $this->validResponse("success");
	}

	public function postChangeemailaccess(){
		$input = Request::all();
		$notification = NotifSub::where("id","=",$input["id"]);
		if($notification->count()==0)
			return $this->errorResponse("error");
		$notification = $notification->first();
		$notification->included = ($notification->included == 0) ? 1:0;
		$notification->save();
		return $this->validResponse("success");
	}

	public function postRemoveuser(){
		$input = Request::all();
		User::destroy($input["idList"]);
		return $this->validResponse("Success");
	}
	
	public function postEdituser(){
		$input = Request::all();
		$user =  Crmadmins::where("id","=",$input["data"]["id"]);
		if($user->count()==0)
			return $this->errorResponse("User doesn't exist");
		$user = $user->first();

		$user->username = $input["data"]["username"];
		$user->password = ($input["data"]["password"]!="") ? Hash::make($input["data"]["password"]):$user->password;
		$user->email = $input["data"]["email"];
		$user->save();
		\Session::forget("admin");
		session()->set("admin",["id"=>$user->id,"username"=>$user->username,"email"=>$user->email,"role"=>$user->role]);
		return $this->validResponse("success");

	}

    public function getAgreementsections()
    {
        $agreementSections = ContractAgreementSection::all();
        $responseData = ["agreementSections"=>[]];
        foreach ($agreementSections as $agreementSection ) {
            array_push($responseData["agreementSections"], $agreementSection->toArray());
        }
        return $this->validResponse($responseData);
    }

    public function postCreateagreementsection()
    {
        $input = Request::all();
        $section = ContractAgreementSection::where("section_name","=",$input["section_name"]);
        if($section->count()!=0)
            return $this->errorResponse("Contract Agreement Section with the same name already registered!");

        $contractAgreementSection = new ContractAgreementSection;
        $contractAgreementSection->section_name = $input["section_name"];
        $contractAgreementSection->section_description = $input["section_description"];
        $contractAgreementSection->content = $input["content"];

        if($contractAgreementSection->save())
            return $this->validResponse( $contractAgreementSection->toArray());
        else
            return $this->errorResponse("Unable to create contract agreement section");
    }

    public function postEditagreementsection()
    {
        $input = Request::all();
        $contractAgreementSection = ContractAgreementSection::where("id", "=", $input["id"]);
        if ($contractAgreementSection->count() == 0)
            return $contractAgreementSection->errorResponse("Contract Agreement Section doesn't exist");
        $contractAgreementSection = $contractAgreementSection->first();

        $contractAgreementSection->section_name = $input["section_name"];
        $contractAgreementSection->section_description = $input["section_description"];
        $contractAgreementSection->content = $input["content"];
        $contractAgreementSection->save();
        return $this->validResponse($contractAgreementSection->toArray());
    }

    public function postRemoveagreementsection()
    {
        $input = Request::all();
        ContractAgreementSection::destroy($input["id"]);
        return $this->validResponse("Success");
    }

    protected function createUser(array $data,array $profile)
	{
	    $user = new User;
	    $user->email = $data['email'];	    
	    $user->name = $profile['fname'] ." ".$profile["mname"]." ".$profile["lname"] ;
	    $user->sno = $this->returnSerialNo();
	    if($user->save()){

	        $newprofile            = new Profile;
	        $newprofile->fname     = $profile['fname'];
	        $newprofile->mname     =  $profile['mname'];
	        $newprofile->lname = $profile['lname'];
	        $newprofile->paddress  = $profile['paddress'];
	        $newprofile->city      =$profile['city'];
	        $newprofile->state     =  $profile['state'];
	        $newprofile->zip       = $profile['zip'];

	        $newprofile->mpaddress =  $profile['paddress'];
	        $newprofile->mcity     =  $profile['city']   ;
	        $newprofile->mstate    =  $profile['state']  ;
	        $newprofile->mzip      =  $profile['zip']    ;

	        $newprofile->hno       = null;
	        $newprofile->mno       = $profile['mno'] ;

	        $newprofile->ml = ($profile["ml"]["value"]==1)?1:0;
	        $newprofile->hau = $profile["hau"]["value"];
	        $newprofile->btc = $profile["btc"]["value"];
	        $newprofile->in = $profile["in"]["value"];

	        $newprofile->user()->associate($user);
	        $newprofile->save();

	        return ["profile"=>$newprofile,"user"=>$user];
	    }


	    return false;

	}

	protected function createOrders(array $data,$profile){
	    $order = new Order;        
	    
	    $order->card_number =  $data["card_number"];
	    $order->month = $data["month"]["value"];
	    $order->year = $data["year"]["value"];
	    $order->full_name = $data["full_name"];
	    $order->cvv = $data["cvv"];
	    $order->street_address = $data["street_address"];
	    $order->primary_zip_code = $data["pzip"];
	    $order->bank_name = $data["bank_name"];
	    $order->routing_number = $data["routing_number"];
	    $order->account_number = $data["account_number"];
	    $order->contact_information = $data["contact_information"];
	    $order->secondary_zip_code = $data["szip"];
	    $order->billing_address = $data["billing_address"];
	    $order->package = $data["package"]["value"];
	    $order->package_start = $data["package_start"]["value"];
	    $order->account_type = $data["account_type"]["value"];
	    $order->profile()->associate($profile);
	    $order->save();
	    return $order;
	}

	protected  function createLaststep(array $data,$profile){
	    $last = new Laststep;
	    $last->driving_license_number = $data["dln"];
	    $last->driving_license_state = $data["dls"]["value"];
	    $last->social_security_number = $data["ssn"];
	    $last->birthdate = $data["year"]["value"]."-".$data["month"]["value"]."-".$data["day"]["value"];
	    $last->profile()->associate($profile);
	    $last->save();
	    return $last;
	}




	private function formatDate($date){
		$packageDate = explode("-", $date."");
		$then = Carbon::createFromDate($packageDate[0],$packageDate[1],$packageDate[2]);
		return $then->toFormattedDateString();
	}

	


	private function retDate($date){
		$packageDate = explode("-", $date."");
		return Carbon::createFromDate($packageDate[0],$packageDate[1],$packageDate[2]);
		 
	}
	
	private function stateList(){
		return  ['AL' => 'Alabama',
		'AK' => 'Alaska',
		'AZ' => 'Arizona',
		'AR' => 'Arkansas',
		'CA' => 'California',
		'CO' => 'Colorado',
		'CT' => 'Connecticut',
		'DE' => 'Delaware',
		'FL' => 'Florida',
		'GA' => 'Georgia',
		'HI' => 'Hawaii',
		'ID' => 'Idaho', 
		'IL' => 'Illinois',   
		'IN' => 'Indiana',    
		'IA' => 'Iowa',   
		'KS' => 'Kansas', 
		'KY' => 'Kentucky',   
		'LA' => 'Louisiana',  
		'ME' => 'Maine',  
		'MD' => 'Maryland',   
		'MA' => 'Massachusetts',  
		'MI' => 'Michigan',   
		'MN' => 'Minnesota',      
		'MS' => 'Mississippi',    
		'MO' => 'Missouri',   
		'MT' => 'Montana',    
		'NE' => 'Nebraska',   
		'NV' => 'Nevada',    
		'NH' => ' New Hampshire',  
		'NJ' => ' New Jersey',  
		'NM' => ' New Mexico',  
		'NY' => ' New York',  
		'NC' => 'North Carolina',  
		'ND' => 'North Dakota',  
		'OH' => 'Ohio',  
		'OK' => 'Oklahoma',  
		'OR' => 'Oregon',  
		'PA' => 'Pennsylvania',  
		'RI' =>  'Rhode Island',  
		'SC' => 'South Carolina',  
		'SD' => 'South Dakota',  
		'TN' => 'Tennessee',  
		'TX' => 'Texas',  
		'UT' => 'Utah',  
		'VT' => 'Vermont',  
		'VA' => 'Virginia',  
		'WA' => 'Washington',  
		'WV' => 'West Virginia',  
		'WI' => 'Wisconsin',  
		'WY' => 'Wyoming'];
	}

	private function hauList(){
		return
				[
					'Auto Dealer'=>'Auto Dealer',
					'BBB' => 'BBB',
					'Billboard' =>'Billboard',
					'Friend or Relative' =>'Friend or Relative',
					'From a Current Client' => 'From a Current Client',
					'I was a Former Client' => 'I was a Former Client',
					'Internet-Google'=>'Internet-Google',
					'Internet-MSN'=>'Internet-MSN',
					'Internet-Yahoo'=>'Internet-Yahoo',
					'Internet-Other'=>'Internet-Other',
					'Magazine' => 'Magazine',
					'Mortgage Broker' =>'Mortgage Broker',
					'Movie Theater Trailer'=>'Movie Theater Trailer',
					'Newspaper' => 'Newspaper',
					"Other" => "Other",
					"Phone Book" => "Phone Book",
					"Radio" => "Radio",
					"Realtor" => "Realtor",
					"Sign on Building" => "Sign on Building"
				];
	}

	private function interestedList(){
		return ['Auto Purchase'=>'Auto Purchase', 'Auto Refinance'=>'Auto Refinance',
		                                                                      'Basic Credit Building' => 'Basic Credit Building',
		                                                                      'Employment Creditability'=>'Employment Creditability',
		                                                                      'Mortgage Purchase' =>'Mortgage Purchase',
		                                                                      'Mortgage Refinance' =>'Mortgage Refinance'];
	}

	private function returnSerialNo(){
	    return rand(100000000,999999999)."-".substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), rand(0,21),3);
	}
		
}