<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Storage;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Session;

class SliderController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
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
        $data = DB::table('slider')
            ->get();
        return view('admin.slider.index',compact('data'));

    }

    public function mainSlider(){
        return view('admin.slider.main_slider_new')->with("token",Session::token())->with("type","main");
    }

    /**
     * Autor : Artur Poghosyan
     * Email : developerarturpoghosyan@gmail.com
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function mainSliderAdd(){
        $input = Input::all();
        if(!empty($input)){
            DB::table('slider')
                ->insert(array(
                    'type' => 'main',
                    'title' => $input['slider_title'],
                    'description' => $input['slider_description'],
                    'content' => $input['slider_content'],
                    'button1' => $input['first_button'],
                    'button2' => $input['second_button'],
                ));
            return redirect('home/slider/mainslider');
        }

        $result = array(
            'type' => 'main',
            'name' => 'Main Slider',
            'form' => 'mainslider_add'
        );
        return view('admin.slider.main_slider_add',compact('result'));
    }

    /**
     * Autor : Artur Poghosyan
     * Email : developerarturpoghosyan@gmail.com
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function mainSliderEdit($id){
        $input = Input::all();
        if(!empty($input)){
            DB::table('slider')
                ->where('id', $id)
                ->where('type','=','main')
                ->update(array(
                    'title' => $input['slider_title'],
                    'description' => $input['slider_description'],
                    'content' => $input['slider_content'],
                    'button1' => $input['first_button'],
                    'button2' => $input['second_button'],
                ));
            return redirect('home/slider/mainslider');
        }
        $result = DB::table('slider')
            ->where('type','=','main')
            ->find($id);
        $result->data = array(
            'type' => 'main',
            'name' => 'Main Slider',
            'form' => 'mainslider'
        );
        return view('admin.slider.main_slider_edit',compact('result'));
    }

    /**
     * Autor : Artur Poghosyan
     * Email : developerarturpoghosyan@gmail.com
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function mainSliderDelete($id){

        $img = DB::table('slider')->find($id);
        $filename = public_path().'/images/'.$img->image;

        if (File::exists($filename)) {
            File::delete($filename);
        }
        DB::table('slider')
            ->where('type','=','main')
            ->where('id' , '=' , $id)
            ->delete();
        return redirect('home/slider/mainslider');
    }

    /**
     * Autor : Artur Poghosyan
     * Email : developerarturpoghosyan@gmail.com
     * @return \Illuminate\View\View
     */
    public function whyUs(){            
            $data = Session::token(); 
            return view('admin.slider.main_slider_new')->with("token",$data)->with("type","why_us");
    }

    /**
     * Autor : Artur Poghosyan
     * Email : developerarturpoghosyan@gmail.com
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function whyUSAdd(){
        $input = Input::all();
        if(!empty($input)){
            DB::table('slider')
                ->insert(array(
                    'type' => 'why_us',
                    'title' => $input['slider_title'],
                    'content' => $input['slider_content'],
                    'button1' => $input['first_button'],
                    'button2' => $input['second_button'],
                ));
            return redirect('home/slider/whyus');
        }
        $result = array(
            'type' => 'why_us',
            'name' => 'Why Us',
            'form' => 'whyus_add'
        );
        return view('admin.slider.main_slider_add',compact('result'));
    }

    /**
     * Autor : Artur Poghosyan
     * Email : developerarturpoghosyan@gmail.com
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function whyUsEdit($id){
        $input = Input::all();
        if(!empty($input)){
            DB::table('slider')
                ->where('type','=','why_us')
                ->where('id','=',$id)
                ->update(array(
                    'title' => $input['slider_title'],
                    'content' => $input['slider_content'],
                    'button1' => $input['first_button'],
                    'button2' => $input['second_button'],
                ));
            return redirect('home/slider/whyus');
        }

        $result = DB::table('slider')
            ->where('type','=','why_us')
            ->find($id);
        $result->data = array(
            'type' => 'why_us',
            'name' => 'Why Us',
            'form' => 'whyus'
        );
        return view('admin.slider.main_slider_edit',compact('result'));
    }

    /**
     * Autor : Artur Poghosyan
     * Email : developerarturpoghosyan@gmail.com
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function whyUsDelete($id){

        $img = DB::table('slider')->find($id);
        $filename = public_path().'/images/'.$img->image;

        if (File::exists($filename)) {
            File::delete($filename);
        }
        DB::table('slider')
            ->where('id' , '=' , $id)
            ->where('type','=','why_us')
            ->delete();
        return redirect('home/slider/whyus');
    }

    /**
     * Autor : Artur Poghosyan
     * Email : developerarturpoghosyan@gmail.com
     * @return \Illuminate\View\View
     */
    public function clientsReviews(){        
        return view('admin.slider.clients_reviews_slider')->with("token",Session::token());
    }

    /**
     * Autor : Artur Poghosyan
     * Email : developerarturpoghosyan@gmail.com
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function clientsReviewsEdit($id){
        $input = Input::all();
        $result = DB::table('clients_reviews_slider')
            ->find($id);
        if(!empty($input)){
            $update = array(
                'content' => $input['slider_content']
            );
            $img = Input::file('slider_image');
            if(!is_null($img)) {
                $rand = time() + rand(0,5000);
                $name = md5($rand).'.'.$img->getClientOriginalExtension();
                Input::file('slider_image')->move('images', $name);
                $update['image'] = $name;
                $filename = public_path().'/images/'.$result->image;
                if (File::exists($filename)) {
                    File::delete($filename);
                }
            }
            DB::table('clients_reviews_slider')
                ->where('id', $id)
                ->update($update);
            return redirect('home/slider/clientsreviews');
        }

        return view('admin.slider.clients_reviews_slider_edit',compact('result'));
    }

    /**
     * Autor : Artur Poghosyan
     * Email : developerarturpoghosyan@gmail.com
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function clientsReviewsAdd(){
        $input = Input::all();
        if(!empty($input)){
            $img = Input::file('slider_image');
            if(!is_null($img)) {
                $rand = time() + rand(0,5000);
                $name = md5($rand).'.'.$img->getClientOriginalExtension();
                Input::file('slider_image')->move('images', $name);
                DB::table('clients_reviews_slider')
                    ->insert(array('image' => $name,
                        'content' => $input['slider_content']
                    ));
            }
            return redirect('home/slider/clientsreviews');
        }
        return view('admin.slider.clients_reviews_slider_add');
    }

    /**
     * Autor : Artur Poghosyan
     * Email : developerarturpoghosyan@gmail.com
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function clientsReviewsDelete($id){

        $img = DB::table('clients_reviews_slider')->find($id);
        $filename = public_path().'/images/'.$img->image;

        if (File::exists($filename)) {
            File::delete($filename);
        }
        DB::table('clients_reviews_slider')
            ->where('id' , '=' , $id)
            ->delete();
        return redirect('home/slider/clientsreviews');
    }
}
