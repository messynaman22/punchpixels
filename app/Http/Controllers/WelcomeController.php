<?php namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller {
    /**
     * @var null
     */
    private $data = null;
	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
        $this->getData();
//		$this->middleware('guest');
	}
    /**
     * Autor : Artur Poghosyan
     * Email : developerarturpoghosyan@gmail.com
     * @return \Illuminate\View\View
     * Show the application home page to the user.
     */
	public function index()
	{
        $data = Admin::all()->where('page_type', 'home_page');
        $data1 = array();
        foreach ($data as $item)
        {
            $data1[$item->page_item] = $item->value;
        }
        $result = array_merge($data1,$this->data);
		return view('welcome',compact('result'));
	}

    /**
     * Autor : Artur Poghosyan
     * Email : developerarturpoghosyan@gmail.com
     * @param $id
     * @return \Illuminate\View\View
     */
    public function page($id)
    {
        $page = DB::table('pages')->
        where('id','=',$id)->
        orWhere('url','=',$id)
            ->get();
        $result = array_merge($this->data,array('page_content' => $page[0]->content));

        return view('page',compact('result'));
    }

    /**
     * Autor : Artur Poghosyan
     * Email : developerarturpoghosyan@gmail.com
     * Data from db
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
            ->where('status','=','1')
            ->get();
        $menu['you_trust_1'] = DB::table('pages')
            ->select('name','url')
            ->where('position','=','you_trust_1')
            ->where('status','=','1')
            ->get();
        $menu['you_trust_2'] = DB::table('pages')
            ->select('name','url')
            ->where('position','=','you_trust_2')
            ->where('status','=','1')
            ->get();
        $menu['footer_1'] = DB::table('pages')
            ->select('name','url')
            ->where('position','=','footer_1')
            ->where('status','=','1')
            ->get();
        $menu['footer_2'] = DB::table('pages')
            ->select('name','url')
            ->where('position','=','footer_2')
            ->where('status','=','1')
            ->get();
        $menu['footer_3'] = DB::table('pages')
            ->select('name','url')
            ->where('position','=','footer_3')
            ->where('status','=','1')
            ->get();
        $menu['footer_4'] = DB::table('pages')
            ->select('name','url')
            ->where('position','=','footer_4')
            ->where('status','=','1')
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
}
