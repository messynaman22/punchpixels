<?php
use Carbon\Carbon;	
use App\Profile;
use App\Crmadmins;
use App\NotifSub;
use App\Services\ContractAgreementService;

Route::get('/', 'WelcomeController@index');

Route::get('/step2', 'SignupController@step2');
Route::post('/poststeptwo', 'SignupController@postSteptwo');
Route::get('/thank_you', 'SignupController@thank_you');
Route::post('/step1', 'SignupController@postRegisterStep1');
Route::get('/step1', 'SignupController@getRegister');
Route::post('/step3', 'SignupController@postRegisterStep3');
Route::get('/step3', 'SignupController@getRegisterStep3');
Route::get("/final","SignupController@getFinal");

Route::get("/testlol","SignupController@pdfTest");

Route::get('home', function(){
    return redirect('admin');
});

Route::get("/date",function(){
	return Carbon::now();
});

Route::get("/test",function(){
	$notifs = NotifSub::where("included","=","1");
	dd($notifs->count());
});


Route::get("/genpdf",function(ContractAgreementService $contractAgreementService){
	$input = [
	"step1_fname"=>"Courtney",
	"step1_serialno"=>"917796248-NZU",
	"step1_mname"=>"Crystal",
	"step1_lname"=>"Rivers",
	"step1_paddress"=>"392 shelby ave apt 6",
	"step1_city"=>"Radcliff",
	"step1_state"=>"KY",
	"step1_zip"=>"40160",
	"step1_mpaddress"=>"392 shelby ave apt 6",
	"step1_mcity"=>"Radcliff",
	"step1_mstate"=>"KY",
	"step1_mzip"=>"40160",
	"step1_hno"=>"",
	"step1_mno"=>"912-210-1424",
	"step1_email"=>"ccbarker86@gmail.com",
	"step2_packagedate"=>"2015-7-23",
	"step2_package"=>"FreshStart",
	"step2_card_number"=>"4236-9810-0312-3303",
	"step2_month"=>"06",
	"step2_year"=>"17",
	"step2_cvv"=>"509",
	"step2_full_name"=>"Courtney Crystal Rivers",
	"step2_card_type"=>"Visa",
	"step2_account_type"=>"Checking Account",
	"step2_bank_name"=>"FORT KNOX CREDITUNION",
	"step2_routing_number"=>"283978425",
	"step2_account_number"=>"10092044",
	"month"=>"11",
	"day"=>"8",
	"year"=>"1986",
	"dls"=>"KY",
	"dln"=>"B05-280-537",
	"ssn"=>"435-71-2343",
	];

        $dateArray =   explode("-",Carbon::createFromDate(2015,7,10)->toDateString());
       $todayInput = $dateArray[1]."/".$dateArray[2]."/".$dateArray[0];
        $dateArray = explode("-",Carbon::createFromDate(2015,7,10)->addDays(3)->toDateString());
        $threeInput = $dateArray[1]."/".$dateArray[2]."/".$dateArray[0];
        $input["step1_state_info"] = "Kentucky";
        $packageDate = explode("-", $input["step2_packagedate"]."");
        $then = Carbon::createFromDate($packageDate[0],$packageDate[1],$packageDate[2]);
        $after = Carbon::createFromDate($packageDate[0],$packageDate[1],$packageDate[2]);
        $input["credit_report_date"] = "Jul 10, 2015 17:17:56";
        $input["first_payment_date"] = $then->toFormattedDateString();
        $input["service_start_date"] = $then->addDays(30)->toFormattedDateString();
        $input["today"] =$todayInput;
        $input["three_today"] = $threeInput;
        $input["fpd_pdf"] = $input["first_payment_date"];
        $input["ssd_pdf"] =   $input["service_start_date"] ;
        $input["crd_pdf"] = Carbon::createFromDate(2015,7,10)->toFormattedDateString();
        $input["signature"] = explode("-",$input["ssn"])[2];
        $input["agreement_date"] = Carbon::createFromDate(2015,7,10)->format('jS \d\a\y \\of F') .", ". substr(Carbon::createFromDate(2015,7,10)->format('Y'),0,2)."{".substr(Carbon::createFromDate(2015,7,10)->format('Y'),2,4)."}";
        $tempDate = array();
        for($i=4;$i<=15;$i++){
        $tempDate[$i.""] = $i."th"; 
        }
        $selectedDay = array_merge( ["1"=>"1st","2"=>"2nd","3"=>"3rd"],$tempDate);
        $input["day_diff"] = $selectedDay[$after->diffInDays(Carbon::createFromDate(2015,7,10))-1];

        $input["package_image"] =($input["step2_package"]=="Comprehensive")? URL::asset("/images").'/cs.jpg':URL::asset("/images").'/fss.jpg';
        // dd($input);
        $input['pdf_content'] = $contractAgreementService->getAll($input);
        $pdf = PDF::loadView('pdf.agreement', $input);
        $paper_size = array(0,0,790,850);
        $pdf->setPaper($paper_size);
        $pdf->setOrientation("portrait");
        return $pdf->download("agreement.pdf");
});

// Route::get("/test",function(){
// $profiles = Profile::all();
// 	foreach ($profiles as $profile) {
// 		$profile->btc = "Morning";
// 		$profile->in = "Auto Purchase";
// 		$profile->hau = "Auto Dealer";
// 		$profile->ml = 0;
// 		$profile->save(); 
// 	}
// $crm = new Crmadmins;
// $crm->username = "Test Admin";
// $crm->email = "test1234@gmail.com";
// $crm->password = Hash::make("test1234");
// $crm->user_state = 1;
// $crm->save();
// });

Route::get('admin', 'AdminController@index');
Route::get('admin/main-data', 'AdminController@mainData');
Route::post('admin/main-data', 'AdminController@mainData');
Route::get('admin/header', 'AdminController@header');
Route::post('admin/header', 'AdminController@header');
Route::get('admin/footer', 'AdminController@footer');
Route::post('admin/footer', 'AdminController@footer');



Route::get('admin/footer/friends-logo', 'AdminController@footerFriendsLogo');
Route::get('admin/footer/friends-logo/add', 'AdminController@footerFriendsLogoAdd');
Route::post('admin/footer/friends-logo/add', 'AdminController@footerFriendsLogoAdd');
Route::get('admin/footer/friends-logo/edit/{id}', 'AdminController@footerFriendsLogoEdit');
Route::post('admin/footer/friends-logo/edit/{id}', 'AdminController@footerFriendsLogoEdit');
Route::get('admin/footer/friends-logo/delete/{id}', 'AdminController@footerFriendsLogoDelete');


Route::get('admin/customer-satisfaction','AdminController@CustomerSatisfaction');
Route::post('admin/customer-satisfaction','AdminController@CustomerSatisfaction');
Route::get('admin/you-trust','AdminController@youTrustSection');
Route::post('admin/you-trust','AdminController@youTrustSection');


/**
 * sliders
 */
Route::get('admin/slider/clientsreviews', 'SliderController@clientsReviews');
Route::get('admin/slider/clientsreviews_edit/{type}', 'SliderController@clientsReviewsEdit');
Route::post('admin/slider/clientsreviews_edit/{type}', 'SliderController@clientsReviewsEdit');
Route::get('admin/slider/clientsreviews_delete/{type}', 'SliderController@clientsReviewsDelete');
Route::post('admin/slider/clientsreviews_add', 'SliderController@clientsReviewsAdd');
Route::get('admin/slider/clientsreviews_add', 'SliderController@clientsReviewsAdd');


Route::get('admin/slider/mainslider', 'SliderController@mainSlider');
Route::get('admin/slider/mainslider/{type}', 'SliderController@mainSliderEdit');
Route::post('admin/slider/mainslider/{type}', 'SliderController@mainSliderEdit');
Route::get('admin/slider/mainslider_delete/{type}', 'SliderController@mainSliderDelete');
Route::post('admin/slider/mainslider_add', 'SliderController@mainSliderAdd');
Route::get('admin/slider/mainslider_add', 'SliderController@mainSliderAdd');



Route::get('admin/slider/whyus', 'SliderController@whyUs');
Route::get('admin/slider/whyus/{type}', 'SliderController@whyUsEdit');
Route::post('admin/slider/whyus/{type}', 'SliderController@whyUsEdit');
Route::get('admin/slider/whyus_delete/{type}', 'SliderController@whyUsDelete');
Route::post('admin/slider/whyus_add', 'SliderController@whyUsAdd');
Route::get('admin/slider/whyus_add', 'SliderController@whyUsAdd');


/**
 * pages
 */

Route::get('admin/pages/', 'PageController@index');
Route::get('admin/pages/add', 'PageController@create');
Route::post('admin/pages/add', 'PageController@create');
Route::get('admin/pages/edit/{id}', 'PageController@edit');
Route::post('admin/pages/edit/{id}', 'PageController@edit');
Route::get('admin/pages/delete/{id}', 'PageController@destroy');


Route::get('page/{id}', 'WelcomeController@page');

Route::controller("api","ApiController");

Route::get("crm/signup/{token}", function($token){
	$admin = Crmadmins::where("token","=",$token);
	if($admin->count()==0)
		return view("errors.503");
	$error = session()->get("signuperror","default");
	$username = session()->get("user","");
	$admin = $admin->first()->toArray();
	return view("crm.signup")->with("admin",$admin)->withExtra("CRM")->withErr($error)->withUsername($username);	
});

Route::post("crm/signup", function(){
	$inputs = Request::all();
	if($inputs["password"] != $inputs["conf_password"] )
		return redirect()->back()->with("signuperror","Password doesn't match!")->withUser($inputs["username"]);
	$crm = Crmadmins::where("id","=",$inputs["id"])->first();	
	$crm->token = NULL;
	$crm->username = $inputs["username"];
	$crm->password = Hash::make($inputs["password"]);
	$crm->user_state= ($crm->user_state == 4)? 2:3;
	$crm->save();
	return redirect()->to("crm/login");
});



Route::controller("crm","CrmController");



Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
Route::post('signup/payment', array(
    'as' => 'payment',
    'uses' => 'SignupController@postPayment',
));

Route::get('payment/status', array(
    'as' => 'payment.status',
    'uses' => 'SignupController@getPaymentStatus',
));

Route::get("/clearsession",function(){
	if(\Session::has('register_steps'))
		\Session::pull( 'register_steps');
	if(\Session::has("current_step"))
		\Session::pull("current_step");
});



