<?php

namespace App\Modules\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Admin\Models\Testimonial;
use App\Modules\Admin\Requests;
use Illuminate\Support\Facades\Input;
use DB;
use Session;

class TestimonialController extends Controller
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {   
        $pageTitle = "List of  Testimonial";
        // Get Parent user data
        $data = Testimonial::where('status','active')->paginate();
        // return view
        return view("Admin::testimonial.index", compact('data','pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $pageTitle = "Add New Testimonial";

        // return View
        return view("Admin::testimonial.create", compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\TestimonialRequest $request)
    {
        // Get all input data
        $input = $request->all();
        $input['slug'] = str_slug($input['slug']);
        $data = Testimonial::where('title',$input['title'])->exists();

        if( !$data )
        {
        

            /* Transaction Start Here */
            DB::beginTransaction();
            try {

                // Store user data 
                $testimonial_data = Testimonial::create($input);
                

                DB::commit();
                Session::flash('message', 'Testimonial is added!');
                return redirect(config('global.prefix_name').'/testimonial/index');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                print($e->getMessage());
                exit();
                Session::flash('danger', $e->getMessage());
            }

        }else{
            Session::flash('info', 'This Testimonial already added!');
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
        $pageTitle = 'View Testimonial Informations';

        // Find category data
        $data = Testimonial::where('testimonial.id', $id)
                ->select('testimonial.*')
                ->first();                    

        if(count($data) > 0)
        {
            // If found category
            return view("Admin::testimonial.show", compact('data','pageTitle'));

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
       $pageTitle = "Update Testimonial";

        // Find user
        $data = Testimonial::where('testimonial.id', $id)
                        ->select('testimonial.*')
                        ->first();

        // If user not found                
        if(count($data) <= 0){
            Session::flash('danger', 'Testimonial not found.');
            return redirect()->route('admin.testimonial.index');
        }


        // Return view
        return view("Admin::testimonial.edit", compact('data','pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\TestimonialRequest  $request, $id)
    {
        $input = $request->all();
        $input['slug'] = str_slug($input['slug']);

        // Find user
        $model = Testimonial::where('testimonial.id', $id)
                        ->select('testimonial.*')
                        ->first();
        DB::beginTransaction();
        try {
            // Update user
            $result = $model->update($input);

            DB::commit();
    
            Session::flash('message', 'Successfully updated!');
            return redirect(config('global.prefix_name').'/testimonial/index');
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
        $model =  Testimonial::where('testimonial.id', $id)
                        ->select('testimonial.*')
                        ->first();
        DB::beginTransaction();
        try {
            // Category update
            if($model->status =='active'){
                $model->status = 'cancel';
            }else{
                $model->status = 'active';
            }

            $model->save();
            

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

        
        $pageTitle = 'Testimonial Information';

        // User model initialize
        $model = new Testimonial();

        if($this->isGetRequest())
        {
            // Search data found
            $search_keywords = trim(Input::get('search_keywords'));
            $model = $model->where(function ($query) use($search_keywords){
                    $query = $query->orWhere('title', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('testimonial.status', 'LIKE', '%'.$search_keywords.'%');
                    
                });
            $data = $model->where('status','active')->select('testimonial.*')->paginate(30);
        }else{

            // If get data not found
            $data = Testimonial::where('status','active')->paginate(30);
        }

        // Return view
        return view("Admin::testimonial.index", compact('data','pageTitle'));
        

    }
}
