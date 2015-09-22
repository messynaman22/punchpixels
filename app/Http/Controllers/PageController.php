<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Session;
class PageController extends Controller {

    /**
     * @var array
     */
    private $menu  = array(
                    'header' =>'Header',
                    'you_trust_1' =>'You Trust First',
                    'you_trust_2' =>'You Trust Second',
                    'footer_1' =>'Footer - WHO WE ARE',
                    'footer_2' =>'Footer - HOW IT WORKS',
                    'footer_3' =>'Footer - RESOURCES',
                    'footer_4' =>'Footer - EDUCATION'
                    );
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // $result['data'] = DB::table('pages')
        //     ->orderBy('id', 'desc')
        //     ->get();
        $data = Session::token();
        return view('admin.page_new.index',compact('data'));
            // return dd(compact("result"));
    }

    /**
     * Autor : Artur Poghosyan
     * Email : developerarturpoghosyan@gmail.com
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function create()
    {
        $input = Input::all();
        if(!empty($input)){
            DB::table('pages')->insert(array(
                'name' => $input['name'],
                'url'  => $input['url'],
                'content' => $input['page_content'],
                'status' => $input['status'],
                'position' => $input['position'],
                'created_at' => date('Y-m-d H:i:s')
            ));
            return redirect('home/pages/');
        }

        $result = $this->menu;
        return view('admin.page.add',compact('result'));


    }

    /**
     * Autor : Artur Poghosyan
     * Email : developerarturpoghosyan@gmail.com
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function edit($id)
    {
        $input = Input::all();
        if(!empty($input)){
            DB::table('pages')->
                where('id','=',$id)->
                update(array(
                    'name' => $input['name'],
                    'url'  => $input['url'],
                    'content' => $input['page_content'],
                    'status' => $input['status'],
                    'position' => $input['position']
                ));
            return redirect('home/pages/');
        }
        $result['page'] = DB::table('pages')->find($id);
        $result['menu'] = $this->menu;
        return view('admin.page.edit',compact('result'));
    }

    /**
     * Autor : Artur Poghosyan
     * Email : developerarturpoghosyan@gmail.com
     *
     * Remove the specified Page from storage.
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        DB::table('pages')->
        where('id','=',$id)->delete();
        return redirect('home/pages/');
    }

}
