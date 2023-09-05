<?php

namespace App\Modules\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Admin\Models\Menu;
use App\Modules\Admin\Requests;
use Illuminate\Support\Facades\Input;
use DB;
use Session;
use Image;
use File;
use App;

class MenuController extends Controller
{

     /**
     * @return bool
     */
    protected function isGetRequest(){
        return Input::server("REQUEST_METHOD") == "GET";
    }


    /**
     * @return bool
     */
    protected function isPostRequest(){
        return Input::server("REQUEST_METHOD") == "POST";
    }

    protected $menu_image_path;
    protected $menu_image_relative_path;



    /**
     * menu constructor.
     */
    public function __construct()
    {

        $this->menu_image_path = public_path('uploads/menu');
        $this->menu_image_relative_path = '/uploads/menu';

    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {   

        $pageTitle = "List of  Menu";
        // Get Parent user data
        $data = Menu::where('status','active')->paginate(30);;
        // return view
        return view("Admin::menu.index", compact('data','pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = "Add New Menu";
        // return View
        return view("Admin::menu.create", compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\MenuRequest $request)
    {
        // Get all input data
        $input = $request->all();
        $input['slug'] = str_slug($input['slug']);
        // Check already presents or not
        $data = Menu::where('slug',$input['slug'])->exists();

        if( !$data )
        {
            // Image link 
            $menu_image = $request->file('image_link');

            if($menu_image) {
                $menu_image_title = str_replace(' ', '-', $input['slug'] . '.' . $menu_image->getClientOriginalExtension());
                $menu_image_link = $this->menu_image_relative_path.'/'.$menu_image_title;

            }else{
                $menu_image_link = '';
                $menu_image_title = '';
            }

            $input['image_link'] = $menu_image_title;

            /* Transaction Start Here */
            DB::beginTransaction();
            try {
                // Store user data 
                if($menu_data = Menu::create($input))
                {
                    // Store category image
                    if($menu_image != null){
                        $menu_image->move($this->menu_image_path, $menu_image_title);
                    }
                }

                DB::commit();
                Session::flash('message', 'Menu is added!');
                return redirect(config('global.prefix_name').'/menu/index');
            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                Session::flash('danger', $e->getMessage());
            }
        }else{
            Session::flash('info', 'This Menu already added!');
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pageTitle = 'View Menu Informations';

        // Find menu data
        $data = Menu::where('menu.id', $id)
                ->select('menu.*')
                ->first();                    

        if(!empty($data))
        {
            // If found menu
            return view("Admin::menu.show", compact('data','pageTitle'));

        }else{
            // If menu not found
            return redirect()->back();

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $pageTitle = "Update Menu";
        // Find menu
        $data = Menu::where('menu.id', $id)
                        ->select('menu.*')
                        ->first();
        // If menu not found                
        if(empty($data)){
            Session::flash('danger', 'Menu not found.');
            return redirect()->route('admin.menu.index');
        }
        // Return view
        return view("Admin::menu.edit", compact('data','pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\MenuRequest  $request, $id)
    {
        $input = $request->all();

        $input['slug'] = str_slug($input['slug']); #make slug for menu
        // Check already presents or not
        // Find menu
        $model = Menu::where('menu.id', $id)
            ->select('menu.*')
            ->first();

        // Image file 
        $menu_image = $request->file('image_link');

        if($menu_image) {
            $menu_image_title = str_replace(' ', '-', $input['slug'] . '.' . $menu_image->getClientOriginalExtension());
            $menu_image_link = $this->menu_image_relative_path.'/'.$menu_image_title;
        }else{
            $menu_image_link = $model->image_link;
            $menu_image_title = $model->image_link;
        }

        $input['image_link'] = $menu_image_title;


        DB::beginTransaction();
        try {
            // Update menu
            $result = $model->update($input);

            if($result){

                if($menu_image != null){
                    File::Delete($model->image_link);
                    $menu_image->move($this->menu_image_path, $menu_image_title);
                }
                DB::commit();
            }

            Session::flash('message', 'Successfully updated!');
            return redirect(config('global.prefix_name').'/menu/index');
        }
        catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            Session::flash('danger', $e->getMessage());
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Find menu 
        $model =Menu::where('menu.id', $id) 
            ->select('menu.*')
            ->first();
        DB::beginTransaction();
        try {
            // Category update
            if($model->status =='active'){
                $model->status = 'cancel';
            }else{
                $model->status = 'active';
            }
            if($model->save())
            {
                DB::commit();
                Session::flash('message', "Successfully Deleted.");
            }
        } catch(\Exception $e) {
            DB::rollback();
            Session::flash('danger',$e->getMessage());
        }
        // redirect to current page
        return redirect()->back();
    }

    public function search(Request $request)
    {
        $pageTitle = 'Menu Information';
        // User model initialize
        $model = new Menu();
        if($this->isGetRequest())
        {
            // Search data found
            $search_keywords = trim(Input::get('search_keywords'));
            $model = $model->where(function ($query) use($search_keywords){
                    $query = $query->orWhere('title', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('menu.status', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('slug', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('short_order', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('position', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('description', 'LIKE', '%'.$search_keywords.'%');
                });
            $data = $model->where('status','active')->select('menu.*')->paginate(30);
        }else{

            // If get data not found
            $data = Menu::where('status','active')->paginate(30);
        }

        // Return view
        return view("Admin::menu.index", compact('data','pageTitle'));

    }
}
