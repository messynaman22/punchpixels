<?php namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class HomeController extends Controller {

    /*
    |--------------------------------------------------------------------------
    | Home Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders your application's "dashboard" for users that
    | are authenticated. Of course, you are free to change or remove the
    | controller as you wish. It is just here to get your app started!
    |
    */


    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Autor : Artur Poghosyan
     * Email : developerarturpoghosyan@gmail.com
     * @return \Illuminate\View\View
     */
    public function index()
    {

        return view('home');
    }

    /**
     * Autor : Artur Poghosyan
     * Email : developerarturpoghosyan@gmail.com
     * @return \Illuminate\View\View
     */
    public function mainData(){
        $input = Input::all();
        if(!empty($input)){
            $img = Input::file('main_banner');
            if(!is_null($img)) {

                $rand = time() + rand(0,5000);
                $name = md5($rand).'.'.$img->getClientOriginalExtension();
                Input::file('main_banner')->move('images',$name );
                DB::table('images')
                    ->where('name','=','main_banner')
                    ->where('position','main')
                    ->update(array('image' => $name));
            }
            foreach($input as $key=>$val)
                DB::table('content')
                    ->where('position','main')
                    ->where('name',$key)
                    ->update(array('content' => $val));
        }
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
        $input = Input::all();
        if(!empty($input)){
            $signup_button = $input['signup_button'];
            $main_logo = Input::file('main_logo');
            if(!empty($main_logo)) {

                $rand = time() + rand(0,5000);
                $name = md5($rand).'.'.$main_logo->getClientOriginalExtension();
                $main_logo->move('images', $name);
                DB::table('logo')
                    ->where('name', 'main_logo')
                    ->update(array('image' => $name));
            }
            DB::table('content')
                ->where('name', 'signup_button')
                ->update(array('content' => $signup_button));

        }
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
        $input = Input::all();
        if(!empty($input)){
            $content = $input['content'];
            $logo = $input['logo']['footer_logo'];
            $image = $input['logo']['footer_image'];
                if(!is_null($logo)){
                    $rand = time() + rand(0,15000);
                    $name = md5($rand).'.'.$logo->getClientOriginalExtension();
                    $logo->move('images', $name);
                    DB::table('logo')
                        ->where('name', 'footer_main_logo')
                        ->update(array('image' => $name));
                }
                if(!is_null($image)){
                    $rand = time() + rand(0,15000);
                    $name = md5($rand).'.'.$image->getClientOriginalExtension();
                    $image->move('images', $name);
                    DB::table('images')
                        ->where('name', 'footer_main_image')
                        ->update(array('image' => $name));
                }
            foreach($content as $key => $val){
                if(!is_null($val)){
                    DB::table('content')
                        ->where('name', $key)
                        ->update(array('content' => $val));
                }
            }
        }
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
        $result = DB::table('images')
            ->where('position','=','footer-friends-logo')
            ->get();
        return view('admin.footer.friends_logo',compact('result'));
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
                        ->insert(array('image' => $name,
                            'alt' => $input['friend_logo_alt'],
                            'position' => 'footer-friends-logo',
                        ));
                }
               return redirect('home/footer/friends-logo');
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
            return redirect('home/footer/friends-logo');
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
        return redirect('home/footer/friends-logo');

    }

    /**
     * Autor : Artur Poghosyan
     * Email : developerarturpoghosyan@gmail.com
     * @return \Illuminate\View\View
     */
    public function CustomerSatisfaction(){
        $input = Input::all();
        if(!empty($input)) {
            foreach ($input as $key => $val)
                DB::table('content')
                    ->where('name', '=', $key)
                    ->where('position','=','customer_satisfaction')
                    ->update(array('display_name' => $val[0],'content' => $val[1]));
        }
        $result = DB::table('content')
            ->where('position','=','customer_satisfaction')
            ->get();
        return view('admin.customer_satisfaction',compact('result'));

    }

    /**
     * Autor : Artur Poghosyan
     * Email : developerarturpoghosyan@gmail.com
     * @return \Illuminate\View\View
     */
    public function youTrustSection(){
        $input = Input::all();
        if(!empty($input))
            foreach($input as $key=>$val)
                DB::table('content')
                    ->where('name','=',$key)
                    ->update(array('content'=>$val));

        $dara = DB::table('content')
            ->where('position','=','main')
            ->get();
        $result = array();
        foreach($dara as $val)
            $result[$val->name] = $val->content;
        return view('admin.you_trust_section',compact('result'));

    }

}
