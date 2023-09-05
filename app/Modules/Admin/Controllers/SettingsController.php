<?php

namespace App\Modules\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Modules\Admin\Models\SettingsModel;
use Illuminate\Support\Facades\Input;
use Auth;
use Session;
use DB;
use Image;
use File;
use Storage;


class SettingsController extends Controller
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


    protected $generel_image_path;
    protected $generel_image_relative_path;

    public function __construct()
    {
        $this->generel_image_path = public_path('uploads/generel_file');
        $this->generel_image_relative_path = '/uploads/generel_file';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = 'System Settings Data';

        $data=DB::table('config')->paginate(30);
        
        return view("Admin::settings.index", compact('pageTitle','data'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $pageTitle = "Add New Settings";

        // return View
        return view("Admin::settings.create", compact('pageTitle'));
    }


    public function store(Request $request){
        // Get all input data
        $input = Input::all();

        // Check already presents or not
        $data = SettingsModel::where('key',$input['key'])->exists();

        if( !$data )
        {


            // Image link 
            $generel_image = Input::file('image');

            if($generel_image) {
                $generel_image_title = str_replace(' ', '-', $input['key'] . '.' . $generel_image->getClientOriginalExtension());
                $generel_image_link = $this->generel_image_relative_path.'/'.$generel_image_title;

            }else{
                $generel_image_link = '';
                $generel_image_title = '';
            }

            if ($input['type']=="file") {
                
                $input['value'] = $generel_image_title;
                
            }


            /* Transaction Start Here */
            DB::beginTransaction();
            try {

              
                $model = SettingsModel::create($input);

               

               if($generel_image != null){
                        $generel_image->move($this->generel_image_path, $generel_image_title);
                    }

                if ($model) {
                    DB::commit();

                }//end user data

                Session::flash('message', 'Config is added!');
                return redirect(config('global.prefix_name').'/settings/index');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                print($e->getMessage());
                exit();
                Session::flash('danger', $e->getMessage());
            }

        }else{
            Session::flash('info', 'This settings already added!');
        }
        return redirect()->back();

    }

    public function show($id)
    {
        $pageTitle = 'View Settings Informations';

        // Find category data
        $data = SettingsModel::where('config.id', $id)
                ->select('config.*')
                ->first();                    

        if(count($data) > 0)
        {
            // If found category
            return view("Admin::settings.show", compact('data','pageTitle'));

        }else{
            // If category not found
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
       $pageTitle = "Update Settings";

        // Find user
        $data = SettingsModel::findOrFail($id);
       
        // If user not found                
        if(count($data) <= 0){
            Session::flash('danger', 'Settings not found.');
            return redirect()->route('admin.settings.index');
        }
        return view("Admin::settings.edit", compact('data','pageTitle'));
    }


     public function update(Request $request, $id)
    {
        $input = Input::all();

        ///dd($input);
        $model = SettingsModel::findOrFail($id);

       
        $generel_image = Input::file('image');

        if($generel_image) {
            $generel_image_title = str_replace(' ', '-', $input['key'] . '.' . $generel_image->getClientOriginalExtension());
            $generel_image_link = $this->generel_image_relative_path.'/'.$generel_image_title;
        }else{
            $generel_image_link = $model->value;
            $generel_image_title = $model->value;
        }

        if ($input['type']=="file") {
                
                $input['value'] = $generel_image_title;
                
            }


        DB::beginTransaction();
        try {
            // Update user
           
           if($model->update($input)){

                if($generel_image != null){

                    
                    $filename = $this->generel_image_path.'/'.$model->value;
                    File::delete($filename);

                    $generel_image->move($this->generel_image_path, $generel_image_title);
                }
                 DB::commit();
            }

            Session::flash('message', 'Successfully updated!');
            return redirect(config('global.prefix_name').'/settings/index');
        }
        catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            Session::flash('danger', $e->getMessage());
        }

        return redirect()->back();
    }

    public function destroy($id)
    {
        $model =  SettingsModel::findOrFail($id);

        DB::beginTransaction();
        try {
            // Category update
            $model->delete();
               if ($model) {
                $filename = $this->generel_image_path.'/'.$model->value;
                File::delete($filename);
               }
            
            DB::commit();
            Session::flash('message', "Successfully Deleted.");

        } catch(\Exception $e) {
            DB::rollback();
            Session::flash('danger',$e->getMessage());
        }
        
        // redirect to current page
        return redirect()->back();
    }

     public function search(Request $request)
    {

        
        $pageTitle = 'Settings Information';

        // User model initialize
        $model = new SettingsModel();

        if($this->isGetRequest())
        {
            // Search data found
            $search_keywords = trim(Input::get('search_keywords'));
            $model = $model->where(function ($query) use($search_keywords){
                    $query = $query->orWhere('key', 'LIKE', '%'.$search_keywords.'%');
                    
                    $query = $query->orWhere('value', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('type', 'LIKE', '%'.$search_keywords.'%');
                   
                });
            $data = $model->select('config.*')->paginate(10);
        }else{

            // If get data not found
            $data = SettingsModel::paginate(10);
        }
        // Return view
        return view("Admin::settings.index", compact('data','pageTitle'));
        

    }

}
