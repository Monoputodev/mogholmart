<?php

namespace App\Modules\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Admin\Models\GeneralPages;
use App\Modules\Admin\Requests;
use Illuminate\Support\Facades\Input;
use DB;
use Session;

use Image;
use File;

class GeneralPagesController extends Controller
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

    protected $generalpages_path;
    protected $generalpages_image_relative_path;



    /**
     * advertisement constructor.
     */
    public function __construct()
    {

        $this->generalpages_path = public_path('uploads/generalpages');
        $this->generalpages_image_relative_path = '/uploads/generalpages';

    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {   


        $pageTitle = "List of  General Pages";

        // Get Parent user data
        $data = GeneralPages::all();


        // return view
        return view("Admin::generalpages.index", compact('data','pageTitle'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $pageTitle = "Add New Page";

        // return View
        return view("Admin::generalpages.create", compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\PagesRequest $request)
    {
        // Get all input data
        $input = Input::all();
        $input['slug'] = str_slug($input['slug']);
        
        $data = GeneralPages::where('slug',$input['slug'])->exists();

        if( !$data )
        {
            

            // Image link 
            $generalpages_image = $request->file('image_link');

            if($generalpages_image) {
                $generalpages_image_title = str_replace(' ', '-', $input['slug'] . '.' . $generalpages_image->getClientOriginalExtension());
                $generalpages_image_link = $this->generalpages_image_relative_path.'/'.$generalpages_image_title;

            }else{
                $generalpages_image_link = '';
                $generalpages_image_title = '';
            }

            $input['image_link'] = $generalpages_image_title;

            /* Transaction Start Here */
            DB::beginTransaction();
            try {

                // Store user data 
                if($generalpages_data = GeneralPages::create($input))
                {

                    // Store category image
                    if($generalpages_image != null){
                        $generalpages_image->move($this->generalpages_path, $generalpages_image_title);
                    }

                }

                DB::commit();
                Session::flash('message', 'General Pages is added!');
                return redirect()->route('admin.generalpages.index');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                print($e->getMessage());
                exit();
                Session::flash('danger', $e->getMessage());
            }

        }else{
            Session::flash('info', 'This page already added!');
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
        $pageTitle = 'View GeneralPages Informations';

        // Find category data
        $data = GeneralPages::where('general_pages.id', $id)
                ->select('general_pages.*')
                ->first();                    

        if(count($data) > 0)
        {
            // If found category
            return view("Admin::generalpages.show", compact('data','pageTitle'));

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
       $pageTitle = "Update GeneralPages";

        // Find user
        $data = GeneralPages::where('general_pages.id', $id)
                        ->select('general_pages.*')
                        ->first();

        // If user not found                
        if(count($data) <= 0){
            Session::flash('danger', 'Slider not found.');
            return redirect()->route('admin.generalpages.index');
        }


        // Return view
        return view("Admin::generalpages.edit", compact('data','pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\PagesRequest  $request, $id)
    {
        $input = $request->all();
        $input['slug'] = str_slug($input['slug']);
        // Check already presents or not


        // Find user
        $model = GeneralPages::where('general_pages.id', $id)
            ->select('general_pages.*')
            ->first();

        // Image file 
        $generalpages_image = $request->file('image_link');

        if($generalpages_image) {
            $generalpages_image_title = str_replace(' ', '-', $input['slug'] . '.' . $generalpages_image->getClientOriginalExtension());
            $generalpages_image_link = $this->generalpages_image_relative_path.'/'.$generalpages_image_title;
        }else{
            $generalpages_image_link = $model->image_link;
            $generalpages_image_title = $model->image_link;
        }

        $input['image_link'] = $generalpages_image_title;


        DB::beginTransaction();
        try {
            // Update user
            $result = $model->update($input);

            if($result){

                if($generalpages_image != null){
                    File::Delete($model->image_link);
                    $generalpages_image->move($this->generalpages_path, $generalpages_image_title);
                }

                DB::commit();
            }

            Session::flash('message', 'Successfully updated!');
            return redirect()->route('admin.generalpages.index');
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
        $model =   GeneralPages::where('general_pages.id', $id)
            ->select('general_pages.*')
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

        
        $pageTitle = 'GeneralPages Information';

        // User model initialize
        $model = new GeneralPages();

        if($this->isGetRequest())
        {
            // Search data found
            $search_keywords = trim(Input::get('search_keywords'));
            $model = $model->where(function ($query) use($search_keywords){
                    $query = $query->orWhere('title', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('general_pages.status', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('slug', 'LIKE', '%'.$search_keywords.'%');
                });
            $data = $model->select('general_pages.*')->paginate(30);
        }else{

            // If get data not found
            $data = GeneralPages::paginate(30);
        }

        // Return view
        return view("Admin::generalpages.index", compact('data','pageTitle'));
        
    }
}
