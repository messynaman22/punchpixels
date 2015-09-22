<?php namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class AdminController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}

	
	public function index()
	{
		return redirect()->to("/admin/main-data");
	}

	/**
	 * Autor : Artur Poghosyan
	 * Email : developerarturpoghosyan@gmail.com
	 * @return \Illuminate\View\View
	 */
	public function mainData(){		
		$data = DB::table('content')
			->where('position','main')
			->get();
		$result = array();
		foreach ($data as $item)
		{
			$result[$item->name] = $item->content;
		}		
		return view('admin.main_data',compact('result'));
	}

	/**
	 * Autor : Artur Poghosyan
	 * Email : developerarturpoghosyan@gmail.com
	 * @return \Illuminate\View\View
	 */
	public function header(){
		
		$logo = DB::table('logo')
			->where('position','header')
			->select('name','image as val')
			->get();
		$content = DB::table('content')
			->where('position','header')
			->select('name','content AS val')
			->get();
		$data = array();
		foreach(array_merge($logo,$content) as $val)
			$data[$val->name] = $val->val;
		return view('admin.header',compact('data'));
	}

	/**
	 * Autor : Artur Poghosyan
	 * Email : developerarturpoghosyan@gmail.com
	 * @return \Illuminate\View\View
	 */
	public function footer(){		
		$logo = DB::table('logo')
			->where('position','footer')
			->select('name','image as val')
			->get();
		$content = DB::table('content')
			->where('position','footer')
			->select('name','content AS val')
			->get();
		$data = array();
		foreach(array_merge($logo,$content) as $val)
			$data[$val->name] = $val->val;
		
		return view('admin.footer',compact('data'));

	}

	/**
	 * Autor : Artur Poghosyan
	 * Email : developerarturpoghosyan@gmail.com
	 * @return \Illuminate\View\View
	 */
	public function footerFriendsLogo(){			
		return view('admin.footer.friends_logo')->with("token",\Session::token());
	}

	/**
	 * Autor : Artur Poghosyan
	 * Email : developerarturpoghosyan@gmail.com
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
	 */
	public function footerFriendsLogoAdd(){
		$input = Input::all();
		if(!empty($input)){
			$img = Input::file('friend_logo');
			if(!is_null($img)) {
				$rand = time() + rand(0,5000);
				$name = md5($rand).'.'.$img->getClientOriginalExtension();
				$img->move('images', $name);
				DB::table('images')
					->insertGetId(array('image' => $name,
						'alt' => $input['friend_logo_alt'],
						'position' => 'footer-friends-logo',
					));
			}
			return redirect('admin/footer/friends-logo');
		}
		return view('admin.footer.friends_logo_add');
	}

	/**
	 * Autor : Artur Poghosyan
	 * Email : developerarturpoghosyan@gmail.com
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
	 */
	public function footerFriendsLogoEdit($id){
		$input = Input::all();
		$result = DB::table('images')
			->where('position','=','footer-friends-logo')
			->find($id);
		if(!empty($input)){
			$update = array('alt' => $input['friend_logo_alt']);
			$file = Input::file('friend_logo');
			if(!is_null($file)) {
				$rand = time() + rand(0,5000);
				$name = md5($rand).'.'.$file->getClientOriginalExtension();
				$file->move('images', $name);
				$update['image'] = $name;
				$filename = public_path().'/images/'.$result->image;
				if (File::exists($filename)) {
					File::delete($filename);
				}
			}
			DB::table('images')
				->where('position', 'footer-friends-logo')
				->where('id', $id)
				->update($update);
			return redirect('admin/footer/friends-logo');
		}

		return view('admin.footer.friends_logo_edit',compact('result'));

	}

	/**
	 * Autor : Artur Poghosyan
	 * Email : developerarturpoghosyan@gmail.com
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function footerFriendsLogoDelete($id){

		DB::table('images')
			->where('position', 'footer-friends-logo')
			->where('id' , '=' , $id)
			->delete();
		return redirect('admin/footer/friends-logo');

	}

	/**
	 * Autor : Artur Poghosyan
	 * Email : developerarturpoghosyan@gmail.com
	 * @return \Illuminate\View\View
	 */
	public function CustomerSatisfaction(){
		$input = Input::all();
					
		return view('admin.customer_satisfaction');

	}

	/**
	 * Autor : Artur Poghosyan
	 * Email : developerarturpoghosyan@gmail.com
	 * @return \Illuminate\View\View
	 */
	public function youTrustSection(){
		$dara = DB::table('content')
			->where('position','=','main')
			->get();
		$result = array();
		foreach($dara as $val)
			$result[$val->name] = $val->content;
		return view('admin.you_trust_section',compact('result'));

	}

}
