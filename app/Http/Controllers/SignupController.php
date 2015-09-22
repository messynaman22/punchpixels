<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Profile;
use App\User;
use App\Order;
use AuthorizeNet_Subscription;
use AuthorizeNetAIM;
use AuthorizeNetARB;
use Illuminate\Http\Request;
use App\Admin;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Validator;
use Mail;
use Carbon\Carbon;
use App\Http\Requests\RegisterStep1PostRequest;
use PDF;
use App\Laststep;
use App\NotifSub;
use App\EmailDetails;
use App\Services\ContractAgreementService;
//use PayPal\Rest\ApiContext;
//use PayPal\Auth\OAuthTokenCredential;
//use PayPal\Api\Amount;
//use PayPal\Api\Details;
//use PayPal\Api\Item;
//use PayPal\Api\ItemList;
//use PayPal\Api\Payer;
//use PayPal\Api\Payment;
//use PayPal\Api\RedirectUrls;
//use PayPal\Api\ExecutePayment;
//use PayPal\Api\PaymentExecution;
//use PayPal\Api\Transaction;
use Psy\Util\String;
use Session;


class SignupController  extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
//    private $_api_context;
    /**
     * @var null
     */
    private $data = null;
    private $form_session = 'register_steps';
    private $current_step = "current_step";
    private $contractAgreementService = null;
    public function __construct(ContractAgreementService $contractAgreementService)
    {
        $this->getData();
        $this->contractAgreementService = $contractAgreementService;
        // define("AUTHORIZENET_API_LOGIN_ID", env('AUTHORIZENET_API_LOGIN_ID'));
        // define("AUTHORIZENET_TRANSACTION_KEY", env('AUTHORIZENET_TRANSACTION_KEY'));
        // define("AUTHORIZENET_SANDBOX", true);    
//        $user = User::find(21);
//         $user->charge(3333, [
//                'source' => 'btok_6Jycge4g8yAAaO',
//                'receipt_email' => $user->email,
//            ]);
//         dd('done');
//       // $user->subscription('monthly')->create('btok_6JyYZgrEE93fG9');die;
//        $paypal_conf = Config::get('paypal');
//        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
//        $this->_api_context->setConfig($paypal_conf['settings']);

    }

    /**
     * Autor : Artur Poghosyan
     * Email : developerarturpoghosyan@gmail.com
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data = Admin::all()->where('page_type', 'home_page');
        $result1 = array();
        foreach ($data as $item)
        {
            $result1[$item->page_item] = $item->value;
        }
        $result = array_merge($result1,$this->data);
        return view('main.signup',compact('result'));
    }

    /**
     * Autor : Artur Poghosyan
     * Email : developerarturpoghosyan@gmail.com
     * @return Redirect
     */
    // public function step1()
    // {
    //     $user = Input::get('signup');
    //     if(!empty($user)){
    //         $id = DB::table('users')->insertGetId([
    //             'name' => $user['first_name'].' '.$user['last_name'],
    //             "email" => $user['email']
    //         ]);
    //         $user['id'] = $id;
    //         Session::set('payment_step1', $user);
    //     }

    //     return redirect('signup/step2');
    // }

    protected function create(array $data)
    {
        $user = new User;
        $user->email = $data['email'];
        // $user->password =$data['password'];
        $user->name = $data['fname'] .  isset($data['mname']) ? $data['mname'] : "" . isset($data['lname']) ? $data['lname'] : ""  ;
        $user->sno = $data["serialno"];
        if($user->save()){

            $profile            = new Profile;
            $profile->fname     = $data['fname'];
            $profile->mname     = isset($data['mname']) ? $data['mname'] : null;
            $profile->lname = isset($data['lname']) ? $data['lname'] : null;
            $profile->paddress  = isset($data['paddress']) ? $data['paddress'] : null;
            $profile->city      = isset($data['city'])? $data['city'] : null;
            $profile->state     = isset($data['state'])? $data['state'] : null;
            $profile->zip       = isset($data['zip'])? $data['zip'] : null;

            $profile->mpaddress = isset($data['sameadd']) ? $data['paddress'] : $data['mpaddress'];
            $profile->mcity     = isset($data['sameadd']) ? $data['city']    : $data['mcity'];
            $profile->mstate    = isset($data['sameadd']) ? $data['state']   : $data['mstate'];
            $profile->mzip      = isset($data['sameadd']) ? $data['zip']     : $data['mzip'];

            $profile->hno       = isset($data['hno'])? $data['hno'] : null;
            $profile->mno       = isset($data['mno'])? $data['mno'] : null;

            $profile->ml = $data["ml"];
            $profile->hau = $data["hau"];
            $profile->btc = $data["btc"];
            $profile->in = $data["in"];

            $profile->user()->associate($user);
            $profile->save();

            return $profile;
        }


        return false;

    }

    protected function createOrders(array $data,$profile){
        $order = new Order;        
        
        $order->card_number =  $data["card_number"];
        $order->month = $data["month"];
        $order->year = $data["year"];
        $order->full_name = $data["full_name"];
        $order->cvv = $data["cvv"];
        $order->street_address = $data["street_address"];
        $order->primary_zip_code = $data["primary_zip_code"];
        $order->bank_name = $data["bank_name"];
        $order->routing_number = $data["routing_number"];
        $order->account_number = $data["account_number"];
        $order->contact_information = $data["contact_information"];
        $order->secondary_zip_code = $data["secondary_zip_code"];
        $order->billing_address = $data["billing_address"];
        $order->package = $data["package"];
        $order->package_start = $data["packagedate"];
        $order->account_type = $data["account_type"];
        $order->profile()->associate($profile);
        return $order->save();
    }

    protected  function createLaststep(array $data,$profile){
        $last = new Laststep;
        $last->driving_license_number = $data["dln"];
        $last->driving_license_state = $data["dls"];
        $last->social_security_number = $data["ssn"];
        $last->birthdate = $data["year"]."-".$data["month"]."-".$data["day"];
        $last->profile()->associate($profile);
        return $last->save();
    }

    public function getFinal(){
        return view("step3.success");
    }

    public function getRegister(){
        if(Session::has($this->current_step)&&session($this->current_step)!="step1")
            return redirect()->to("/".session($this->current_step));

        if(!Session::has($this->current_step))
                Session::set($this->current_step,"step1");

        $states = $this->getStateList(); 
        if(\Session::has($this->form_session)) {
            $data = \Session::get($this->form_session);
            return view('new_auth.register')->withInput($data)->with("states",$states);
        }

        return view('new_auth.register')->with("states",$states);
    }

public function postRegisterStep1(){
        $inputs = Input::all();
        $inputs["serialno"] = $this->returnSerialNo();
        \Session::set($this->form_session, $inputs);
        \Session::set($this->current_step, "step2");                
        return redirect()->to('/step2');
}

public function getRegisterStep3(){
    
    if(!Session::has($this->current_step))
        return redirect()->to("/step1");
    
    if(session($this->current_step)!="step3")
        return redirect()->to("/".session($this->current_step));

    $formData = session($this->form_session);

    $dates = array();
    $dates["days"] = array();
    $dates["month"] = array();
    $dates["year"] = array();
    $dates["days"]["default"] = "DATE";
    $dates["month"]["default"] = "MONTH";
    $dates["year"]["default"] = "YEAR";
    for($i=1;$i<=31;$i++){
        $dates["days"][$i.""] = $i;
    } 
    for($i=1;$i<=12;$i++){
      $dates["month"][$i.""] = $i;  
    }
    for($i=1930;$i<=2015;$i++){
      $dates["year"][$i.""] = $i;  
    }

      return view("step3.step3")->with("today",Carbon::now()->toDateString())->with("dates",$dates)->with("formData",$formData)->
                    with("states",$this->getStateList());  
}

public function postRegisterStep3(){
    set_time_limit(300);


    $input = Input::all();
    $input["receipt"] = [];
    $input["receipt"]  = $this->returnRecipient();
    $input["receipt"]["to"] = $input["step1_email"];
    $input["notification"] = $this->returnNotification();
    
    // dd(["receiptc"=>$input["receipt"] ,"notification"=>$input["notification"]]);

    $input["date"] = Carbon::now()->toFormattedDateString();
    $input["service_date"] = Carbon::now()->addDays(35)->toFormattedDateString();
    $sessionData = session($this->form_session);

    $profile = $this->create($sessionData["step1"]);
    $this->createOrders($sessionData["step2"],$profile);
    $this->createLaststep($input,$profile);
    
    $states = $this->getStateList(); 
    $input["step1_state_info"] = $states[$input["step1_state"]];
    $packageDate = explode("-", $input["step2_packagedate"]."");
    $then = Carbon::createFromDate($packageDate[0],$packageDate[1],$packageDate[2]);
    $after = Carbon::createFromDate($packageDate[0],$packageDate[1],$packageDate[2]);
    $input["credit_report_date"] = Carbon::now()->toFormattedDateString()." ".Carbon::now()->toTimeString();
    $input["first_payment_date"] = $then->toFormattedDateString();
    $input["service_start_date"] = $then->addDays(30)->toFormattedDateString();
    $input["today"] = $this->formatDate(Carbon::now()->toDateString());
    $input["three_today"] = $this->formatDate(Carbon::now()->addDays(3)->toDateString());
    $input["fpd_pdf"] = $input["first_payment_date"];
    $input["ssd_pdf"] =   $input["service_start_date"] ;
    $input["crd_pdf"] = Carbon::now()->toFormattedDateString();
    $input["signature"] = explode("-",$input["ssn"])[2];
    $input["agreement_date"] = Carbon::now()->format('jS \d\a\y \\of F') .", ". substr(Carbon::now()->format('Y'),0,2)."{".substr(Carbon::now()->format('Y'),2,4)."}";
    $tempDate = array();
    for($i=4;$i<=10;$i++){
    $tempDate[$i.""] = $i."th"; 
    }
    $selectedDay = array_merge( ["1"=>"1st","2"=>"2nd","3"=>"3rd"],$tempDate);
    $input["day_diff"] = $selectedDay[$after->diffInDays(Carbon::now())-1];
     $input["package_image"] =($input["step2_package"]=="Comprehensive")? URL::asset("/images").'/cs.jpg':URL::asset("/images").'/fss.jpg';
    // dd($input);

    $u="_";
    if($input["step1_mname"]!="")
            $filename = public_path()."/pdfs/".$input["step1_fname"].$u.$input["step1_mname"].$u.$input["step1_lname"].$u.$input['step1_serialno'].".pdf";
        else
            $filename = public_path()."/pdfs/".$input["step1_fname"].$u.$input["step1_lname"].$u.$input['step1_serialno'].".pdf";


    if($input["receipt"]["include_data"] || $input["notification"]["inlcude_data"]){
        $input['pdf_content'] = $this->contractAgreementService->getAll($input);
        $pdf = PDF::loadView('pdf.agreement', $input);
        $paper_size = array(0,0,790,850);
        $pdf->setPaper($paper_size);
        $pdf->setOrientation("portrait");
         // return $pdf->download("agreement.pdf");
        $pdf->save($filename);    
    }


    Mail::send('step3.email', $input, function($message) use ($input){
        if($input["notification"]["include_data"]){
            $u = "_";
            if($input["step1_mname"]!="")
                $file = public_path()."/pdfs/".$input["step1_fname"].$u.$input["step1_mname"].$u.$input["step1_lname"].$u.$input['step1_serialno'].".pdf";
            else
                $file = public_path()."/pdfs/".$input["step1_fname"].$u.$input["step1_lname"].$u.$input['step1_serialno'].".pdf";
            $message->attach($file);
        }
        
        $message->to($input["notification"]["email"], 'Credit1Solutions')->subject($input["notification"]["subject"]);
    });

    Mail::send('step3.receipient', $input, function($message) use ($input){
        if($input["receipt"]["include_data"]){
            $u = "_";
            if($input["step1_mname"]!="")
                $file = public_path()."/pdfs/".$input["step1_fname"].$u.$input["step1_mname"].$u.$input["step1_lname"].$u.$input['step1_serialno'].".pdf";
            else
                $file = public_path()."/pdfs/".$input["step1_fname"].$u.$input["step1_lname"].$u.$input['step1_serialno'].".pdf";
            $message->attach($file);
        }
        
        $message->to($input["receipt"]["to"], 'Credit1Solutions')->subject($input["receipt"]["subject"])->from($input["receipt"]["from"]);
    });
         
    unlink($filename);   
    \Session::pull($this->form_session);
    \Session::pull($this->current_step);
    
    // return "thanks";
    return redirect()->to("/final");
}

private function formatDate($date){
    $dateArray = explode("-",$date);
    return ($dateArray[1]."/".$dateArray[2]."/".$dateArray[0]);
}




public function step2($token=null){        
            if(!Session::has($this->current_step))
                return redirect()->to("/step1");

            if(session($this->current_step)!="step2")
                return redirect()->to("/".session($this->current_step));

            $dates = array();
            $dates = ["now"=>Carbon::now()->toFormattedDateString(),"fiveDays"=>Carbon::now()->addDays(5)->toFormattedDateString(),"later"=>Carbon::now()->addDays(35)->toFormattedDateString()];
            $data = Admin::all()->where('page_type', 'home_page');
            $result1 = array();
            foreach ($data as $item) {
                $result1[$item->page_item] = $item->value;
            }
            $result = array_merge($result1, $this->data);
            $result["prevStep"] = session($this->form_session);
    
            $result["dates"] = $dates;

            $currentYear = Carbon::now()->__get("year");
            $years = array();
            $years["EXP-year"] = "EXP-year";
            for($i=$currentYear,$j = $currentYear+7;$i<=$j;$i++){
                $years[substr($i."", 2,4)] = substr($i."", 2,4);
            }
        
            $result["years"] = $years;
            $result["step1"] = json_encode(session($this->form_session));

            $packageDate = array();
            $startDate = array();
            $startDate["default"] = "";
            $packageDate["default"] = "";
            for($i=3;$i<10;$i++){
                $packageDate[Carbon::now()->addDays($i)->toDateString().""] = Carbon::now()->addDays($i)->toFormattedDateString();
                $startDate[Carbon::now()->addDays($i)->toDateString().""] = Carbon::now()->addDays($i+30)->toFormattedDateString();
            }
            $result["packageDate"] = $packageDate;
            $result["json_package_date"] = json_encode($packageDate);
            $result["json_startdate"] = json_encode($startDate);
                        
            return view('main.step2', compact('result'));
    }

    /**
     * Autor : Artur Poghosyan
     * Email : developerarturpoghosyan@gmail.com
     * @return \Illuminate\View\View
     */
    public function thank_you(){
        $result = array();
        $payment_success = session('payment_success');
        $payment_error = session('payment_error');
        if(!empty($payment_success)){
            $result['payment_status'] = $payment_success;
            Session::forget('payment_success');
        }
        elseif(!empty($payment_error)){
            $result['payment_status'] = $payment_error;
            Session::forget('payment_error');
        }
        else
            $result['payment_status'] = 'payment was not done';

        $data = Admin::all()->where('page_type', 'home_page');
        foreach ($data as $item) {
            $result1[$item->page_item] = $item->value;
        }
        $result = array_merge($result1,$this->data);
        return view('main.thank_you',compact('result'));
    }

    /**
     * Autor : Artur Poghosyan
     * Email : developerarturpoghosyan@gmail.com
     * @return mixed
     */
    public function getPaymentStatus(){
        // Get the payment ID before session clear
        $payment_id = session('paypal_payment_id');
        // clear the session payment ID
        Session::forget('paypal_payment_id');
        $payerID = Input::get('PayerID');
        $token = Input::get('token');
        if (empty($payerID) || empty($token)) {
            return Redirect::route('original.route')
                ->with('error', 'Payment failed');
        }

        $payment = Payment::get($payment_id, $this->_api_context);

        // PaymentExecution object includes information necessary
        // to execute a PayPal account payment.
        // The payer_id is added to the request query parameters
        // when the user is redirected from paypal back to our site
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));

        //Execute the payment
        $result = $payment->execute($execution, $this->_api_context);

//        echo '<pre>';print_r($result);echo '</pre>';exit; // DEBUG RESULT, remove it later

        if ($result->getState() == 'approved') { // payment made
            Session::forget('payment_step1');
            return redirect('signup/thank_you')
                ->with('payment_success', 'Payment success');
        }
        return redirect('signup/thank_you')
            ->with('payment_error', 'Payment failed');
    }

    public function save($token)
    {

        $url_token=  $_SERVER['HTTP_REFERER'].'/'.$token;
        Session::put('url_token',$url_token);
//        dd($url_token);
        Mail::send('emails.welcome', ['key' => 'value'], function($message)
        {
            $message->to('info.punchpixels@gmail.com', 'John Smith')->subject('Activation');
        });
    }
    /**
     * Autor : Artur Poghosyan
     * Email : developerarturpoghosyan@gmail.com
     * @return Redirect
     */


    public function postSteptwo(){                                            
                        $form = array();
                        $form["step1"] = session($this->form_session);
                        $form["step2"] = Input::all();
                        \Session::set($this->form_session,$form);
                        \Session::set($this->current_step,"step3");                        
                        return redirect()->to("/step3");                         
        }


    public function postPayment(){



        $validator = Validator::make(
            array(
                'choose_service'                    => Input::get('choose_service'),
                'card_number'                       => Input::get('card_number'),
                'month'                             => Input::get('month'),
                'year'                              => Input::get('year'),
                'cvv'                               => Input::get('cvv'),
                'full_name'                         => Input::get('full_name'),
                'street_address'                    => Input::get('street_address'),
                'primary_zip_code'                  => Input::get('primary_zip_code'),
                'bank_name'                         => Input::get('bank_name'),
                'routing_number'                    => Input::get('routing_number'),
                'account_number'                    => Input::get('account_number'),
                'contact_information'               => Input::get('contact_information'),
                'billing_address'                   => Input::get('billing_address'),
                'secondary_zip_code'                => Input::get('secondary_zip_code'),



            ),
            array(
                'choose_service'                    => 'required',
                'card_number'                       => 'required|max:16',
                'month'                             => 'required|max:2',
                'year'                              => 'required|max:4',
                'cvv'                               => 'required|max:3',
                'full_name'                         => 'required',
                'street_address'                    => 'required',
                'primary_zip_code'                  => 'required',
                'bank_name'                         => 'required',
                'routing_number'                    => 'required',
                'account_number'                    => 'required',
                'contact_information'               => 'required',
                'billing_address'                   => 'required',
                'secondary_zip_code'                => 'required',




            ),
            array(
                'choose_service'                    => 'Delivery date is required.',
                'card_number'                       => 'Card number is required.',
                'month'                             => 'month is required.',
                'year'                              => 'Year is required.',
                'cvv'                               => 'CVV is required.',
                'full_name'                         => 'Full name is required.',
                'street_address'                    => 'Street address is required.',
                'primary_zip_code'                  => 'Zip code is required.',
                'bank_name'                         => 'Bank name is required.',
                'routing_number'                    => 'Routing number is required.',
                'account_number'                    => 'Account number  is required.',
                'contact_information'               => 'Contact information is required.',
                'billing_address'                   => 'Billing address is required.',
                'secondary_zip_code'                => 'Secondary Zip code is required.',

            )
        );
        if ($validator->fails()) {
            //form validation failed so display form again and populate with exsisting fields
            $data['messages']   = $validator->messages()->toArray();

            $inputs             = Input::all();
            foreach($inputs as $k=>$v){
                $data[$k]       = $v;
            }
            session(["step_error"=>$data]);
        
            return redirect()->back();
        } else {
            $inputs             = Input::all();
            $key=hash('sha256', str_shuffle('abcefghijklmnopqrstuvwxyz0123456789'));
            Orders::CreateOrders($inputs,$key);

            $this->save($key);
            return redirect('signup/thank-you');
        }

        return View('main.thank_you', $data);


        $step1 = session('payment_step1');
        $step2 = Input::all();
        if(!isset($step2['signup']['report_up_front'])){
            return redirect('signup/thank_you');
        }
//        $creditCardToken = $step2['stripeToken'];
//        $user = User::find($step1['id']);
//       $user->subscription('monthly')->create('btok_6Jy8q2CqZUsgcW');
//        if(isset($step2['signup']['report_up_front'])){
//            $creditCardToken1 = $step2['stripeToken'];
//            $user->charge(1399, [
//                'source' => 'btok_6Jy8q2CqZUsgcW',
//                'receipt_email' => $user->email,
//            ]);
//
//        }
        $first_payment = $step2['signup']['cc'][0];
        $input_date = explode('/',$first_payment['cc_exp']);
//        $date = '20'.$input_date[1].'-'.$input_date[0];
        if($step2['payment_method'][0] == 'cc') {
            $subscription = new AuthorizeNet_Subscription;
            $subscription->name = "PHP Monthly subscription";
            $subscription->intervalLength = "1";
            $subscription->intervalUnit = "months";
            $subscription->startDate = date("Y-m-d");//'2015-05-28';
            $subscription->totalOccurrences = "1";
            $subscription->amount = "99.90";
            $subscription->creditCardCardNumber = $first_payment['cc_num'];//"6011000000000012";
            $subscription->creditCardExpirationDate = $first_payment['cc_exp']; //"2018-10";
            $subscription->creditCardCardCode = $first_payment['cc_cvv'];
            $subscription->billToFirstName = $step1['first_name'];
            $subscription->billToLastName = $step1['last_name'];

// Create the subscription.
            $request = new AuthorizeNetARB;
            $response = $request->createSubscription($subscription);
            $subscription_id = $response->getSubscriptionId();
            $sale = new AuthorizeNetAIM;
            $sale->amount = "12.99";
            $sale->card_num = $first_payment['cc_num'];
            $sale->exp_date = $first_payment['cc_exp'];
            $sale->card_code = $first_payment['cc_cvv'];
// Use eCheck:
//        $sale->setECheck(
//            '121042882',
//            '123456789123',
//            'CHECKING',
//            'Bank of Earth',
//            'Jane Doe',
//            'WEB'
//        );

// Set multiple line items:
//        $sale->addLineItem('item1', 'Golf tees', 'Blue tees', '2', '5.00', 'N');
//        $sale->addLineItem('item2', 'Golf shirt', 'XL', '1', '40.00', 'N');

// Set Invoice Number:
            $sale->invoice_num = time();
        }else{
            $subscription = new AuthorizeNet_Subscription;
            $subscription->name = "PHP Monthly subscription";
            $subscription->intervalLength = "1";
            $subscription->intervalUnit = "months";
            $subscription->startDate = date("Y-m-d");//'2015-05-28';
            $subscription->totalOccurrences = "1";
            $subscription->amount = "90.99";
            $subscription->bankAccountRoutingNumber = $step2['signup']['ach'][0]['routing_number'];
            $subscription->bankAccountAccountNumber = $step2['signup']['ach'][0]['account_number'];
            $subscription->bankAccountNameOnAccount = 'test';
            $subscription->creditCardCardCode = $first_payment['cc_cvv'];
            $subscription->billToFirstName = $step1['first_name'];
            $subscription->billToLastName = $step1['last_name'];

// Create the subscription.
            $request = new AuthorizeNetARB;
            $response = $request->createSubscription($subscription);
            $subscription_id = $response->getSubscriptionId();
            $sale = new AuthorizeNetAIM;
            $sale->amount = "12.99";
// Use eCheck:
            $sale->setECheck(
                $step2['signup']['ach'][0]['routing_number'],//'121042882',
                //'123456789123',
                $step2['signup']['ach'][0]['account_number'],//'CHECKING',
                '',//'Bank of Earth',
                $step1['first_name'].' '.$step1['last_name'], //'Jane Doe',
                ''//'WEB'
            );
//

// Set Invoice Number:
            $sale->invoice_num = time();
        }
// Set a Merchant Defined Field:
        $sale->setCustomField("entrance_source", "Search Engine");
        $response = $sale->authorizeAndCapture();
        if ($response->approved) {
            $transaction_id = $response->transaction_id;
//            dd($transaction_id);
        };
        dd('done');

        Session::forget('payment_step1');
        return redirect('signup/thank_you')
            ->with('payment_success', 'Payment success');

//        $payer = new Payer();
//        $payer->setPaymentMethod('paypal');
//
//        $item_1 = new Item();
//        $item_1->setName('registration '.$step1['first_name'].' '.$step1['last_name']) // item name
//        ->setCurrency('USD')
//            ->setQuantity(1)
//            ->setDescription('test description')
//            ->setPrice('12.99'); // unit price
//
//
//        // add item to list
//        $item_list = new ItemList();
//        $item_list->setItems(array($item_1));
//
//        $amount = new Amount();
//        $amount->setCurrency('USD')
//            ->setTotal('12.99');
//
//        $transaction = new Transaction();
//        $transaction->setAmount($amount)
//            ->setItemList($item_list)
//            ->setDescription('Your transaction description');
//
//        $redirect_urls = new RedirectUrls();
//        $redirect_urls->setReturnUrl(URL::route('payment.status'))
//            ->setCancelUrl(URL::route('payment.status'));
//
//        $payment = new Payment();
//        $payment->setIntent('Sale')
//            ->setPayer($payer)
//            ->setRedirectUrls($redirect_urls)
//            ->setTransactions(array($transaction));
//
//        try {
//            $payment->create($this->_api_context);
//        } catch (\PayPal\Exception\PPConnectionException $ex) {
//            if (\Config::get('app.debug')) {
//                echo "Exception: " . $ex->getMessage() . PHP_EOL;
//                $err_data = json_decode($ex->getData(), true);
//                exit;
//            } else {
//                die('Some error occur, sorry for inconvenient');
//            }
//        }
//
//        foreach($payment->getLinks() as $link) {
//            if($link->getRel() == 'approval_url') {
//                $redirect_url = $link->getHref();
//                break;
//            }
//        }
//
//        // add payment ID to session
//        session(['paypal_payment_id' => $payment->getId()]);
//
//        if(isset($redirect_url)) {
//            // redirect to paypal
//            return Redirect::away($redirect_url);
//        }
//
//        return Redirect::route('original.route')
//            ->with('error', 'Unknown error occurred');
    }

    /**
     * Autor : Artur Poghosyan
     * Email : developerarturpoghosyan@gmail.com
     * Data from Db
     */
    private function getData(){
        $clients_reviews = DB::table('clients_reviews_slider')
            ->get();

        $why_us = DB::table('slider')
            ->where('type','=','why_us')
            ->get();
        $whyUS = array();
        for($i = 0;$i<count($why_us);$i+=3){
            $item = array();
            for($j = $i;$j<$i+3;$j++)
                if($j<count($why_us)){
                    $why_us[$j]->id = $j+1;
                    $item[]=$why_us[$j];

                }
            $whyUS[] = $item;
        }

        $main_slider = DB::table('slider')
            ->where('type','=','main')
            ->get();
        $logo = DB::table('logo')
            ->select('name','image AS val')
            ->get();
        $images = DB::table('images')
            ->select('name','image AS val')
            ->where('position','=','main')
            ->get();
        $content = DB::table('content')
            ->select('name','content AS val')
            ->get();
        $customer_satisfaction = DB::table('content')
            ->where('position','=','customer_satisfaction')
            ->get();
        $menu['header'] = DB::table('pages')
            ->select('name','url')
            ->where('position','=','header')
            ->get();
        $menu['you_trust_1'] = DB::table('pages')
            ->select('name','url')
            ->where('position','=','you_trust_1')
            ->get();
        $menu['you_trust_2'] = DB::table('pages')
            ->select('name','url')
            ->where('position','=','you_trust_2')
            ->get();
        $menu['footer_1'] = DB::table('pages')
            ->select('name','url')
            ->where('position','=','footer_1')
            ->get();
        $menu['footer_2'] = DB::table('pages')
            ->select('name','url')
            ->where('position','=','footer_2')
            ->get();
        $menu['footer_3'] = DB::table('pages')
            ->select('name','url')
            ->where('position','=','footer_3')
            ->get();
        $menu['footer_4'] = DB::table('pages')
            ->select('name','url')
            ->where('position','=','footer_4')
            ->get();
        $friends_logo = DB::table('images')
            ->where('position','=','footer-friends-logo')
            ->get();
        $data = array();
        $dbData = array_merge($logo,$content,$images);

        foreach($dbData as $val)
            $data[$val->name] = $val->val;

        $data['friends_logo'] = $friends_logo;
        $data['clients_reviews'] = $clients_reviews;
        $data['main_slider'] = $main_slider;
        $data['why_us'] = $whyUS;
        $data['menu'] = $menu;
        $data['customer_satisfaction'] = $customer_satisfaction;
        $this->data = $data;

    }

    private function getStateList(){
        return [
            'default' =>" ",
            'AL' => 'Alabama',
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
            'WY' => 'Wyoming',  
        ];
    }

    protected function returnRecipient(){
            $receipt = EmailDetails::where("type","=","receipt");
            $responseData=[];

            if($receipt->count()!=0){
                $receipt = $receipt->first();                
                $responseData["from"] = $receipt->to_from;
                $responseData["message"] = $receipt->message;
                $responseData["subject"] = $receipt->subject;
                $responseData["include_data"] = ($receipt->include_data==1);
                return $responseData;
            }

            $responseData["from"] = "noreply@credit1solutions.com";
            $responseData["message"] = "Your signup process is complete.";
            $responseData["subject"] = "Welcome to Credit1solution";
            $responseData["include_data"] = true;
            return $responseData;
    }


    protected function returnNotification(){
        $notification = EmailDetails::where("type","=","notification");
        $responseData = [];
        if($notification->count()!=0){
            $notification = $notification->first();
            $responseData["message"] = $notification->message;
            $responseData["subject"] = $notification->subject;
            $responseData["include_data"] = ($notification->include_data==1);
        }else{
            $responseData["message"] = "A customer signed up.";
            $responseData["subject"] = "New signup @ Credit1solution.com";
            $responseData["include_data"] = true;
        }

        $responseData["email"] = [];
        $emailSubscribers = NotifSub::where("included","=","1");
        
        if($emailSubscribers->count()==0){
            array_push($responseData["email"], "cs@credit1solutions.com") ;
        }else{
            $emailSubscribers = $emailSubscribers->get();            
            foreach ($emailSubscribers as $subs) {                
                array_push($responseData["email"], $subs->email);
            }
            
        }
        
        return $responseData;
    }

    private function returnSerialNo(){
        return rand(100000000,999999999)."-".substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), rand(0,21),3);
    }
}