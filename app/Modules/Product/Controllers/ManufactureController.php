<?php

namespace App\Modules\Product\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Product\Models\Manufacturer;
use App\Modules\Product\Requests;
use Illuminate\Support\Facades\Input;
use DB;
use Session;
use Image;
use File;
use App;
Use Auth;

class ManufactureController extends Controller
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

    protected $manufacture_image_path;
    protected $manufacture_image_relative_path;



    /**
     * ManufactureController constructor.
     */
    public function __construct()
    {

        $this->manufacture_image_path = public_path('uploads/manufacture');
        $this->manufacture_image_relative_path = '/uploads/manufacture';

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   

        $pageTitle = "List of Dealer Information";

        // Get Manufacture data
        $data = Manufacturer::orderBy('id','desc')->paginate(30);


        // return view
        return view("Product::manufacture.index",compact('pageTitle','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $pageTitle = "Add New Dealer";

        // return View
        return view("Product::manufacture.create", compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\ManufactureRequest $request)
    {
        // Get all input data
        $input = $request->all();

        // Check already presents or not
        $data = Manufacturer::where('slug',$input['slug'])->exists();

        if( !$data )
        {
            

            // Image link 
            $manufacture_image = $request->file('image_link');

            if($manufacture_image) {
                $manufacture_image_title = str_replace(' ', '-', $input['title'] . '.' . $manufacture_image->getClientOriginalExtension());
                $manufacture_image_link = $this->manufacture_image_relative_path.'/'.$manufacture_image_title;

            }else{
                $manufacture_image_link = '';
                $manufacture_image_title = '';
            }

            $input['image_link'] = $manufacture_image_title;

            /* Transaction Start Here */
            DB::beginTransaction();
            try {

         
                if($manufacturedata = Manufacturer::create($input))
                {
                    
                    // Store manufacture image
                    if($manufacture_image != null){
                        $manufacture_image->move($this->manufacture_image_path, $manufacture_image_title);
                    }

                }

                DB::commit();
                Session::flash('message', 'Dealer is added!');
                return redirect(config('global.prefix_name').'/manufacture/index');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                print($e->getMessage());
                exit();
                Session::flash('danger', $e->getMessage());
            }

        }else{
            Session::flash('info', 'This Dealer already added!');
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
        $pageTitle = 'View Dealer Informations';

        // Find category data
        $data = Manufacturer::find($id);

        if(!empty($data))
        {
            // If found category
            return view("Product::manufacture.show", compact('data','pageTitle'));

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
       $pageTitle = "Update Dealer";

        // Find manufacture
        $data = Manufacturer::find($id);

        // If manufacture not found                
        if(count($data) <= 0){
            Session::flash('danger', 'Dealer not found.');
            return redirect()->route('admin.manufacture.index');
        }


        // Return view
        return view("Product::manufacture.edit", compact('data','pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\ManufactureRequest $request, $id)
    {
        $input = $request->all();

        // Find manufacture
        $model = Manufacturer::where('manufacturer.id', $id)
            ->select('manufacturer.*')
            ->first();

        // Image file 
        $manufacture_image = $request->file('image_link');

        if($manufacture_image) {
            $manufacture_image_title = str_replace(' ', '-', $input['title'] . '.' . $manufacture_image->getClientOriginalExtension());
            $manufacture_image_link = $this->manufacture_image_relative_path.'/'.$manufacture_image_title;

        }else{
            $manufacture_image_link = $model->image_link;
            $manufacture_image_title = $model->image_link;
        }

        $input['image_link'] = $manufacture_image_title;


        DB::beginTransaction();
        try {
            // Update manufacture
            $result = $model->update($input);

            if($result){

                if($manufacture_image != null){
                    File::Delete($model->image_link);
                    $manufacture_image->move($this->manufacture_image_path, $manufacture_image_title);
                }

                DB::commit();
            }

            Session::flash('message', 'Successfully updated!');
            return redirect(config('global.prefix_name').'/manufacture/index');
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
        $model = Manufacturer::where('manufacturer.id', $id)
            ->select('manufacturer.*')
            ->first();

        DB::beginTransaction();
        try {
            // Mnaufacture update
            if($model->status =='active'){
                $model->status = 'cancel';
            }else{
                $model->status = 'active';
            }

            if($model->save())
            {
            DB::commit();

            }

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
        $pageTitle = 'Dealer Information';

        // Manufacture model initialize
        $model = new Manufacturer();

        if($this->isGetRequest())
        {
            // Search data found
            $search_keywords = trim(Input::get('search_keywords'));
            $model = $model->where(function ($query) use($search_keywords){
                    $query = $query->orWhere('title', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('manufacturer.status', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('description', 'LIKE', '%'.$search_keywords.'%');
                });
            $data = $model->where('status','active')->select('manufacturer.*')->orderBy('id','desc')->paginate(30);
        }else{

            // If get data not found
            $data = Manufacturer::where('status','active')->orderBy('id','desc')->paginate(30);
        }

        // Return view
        return view("Product::manufacture.index", compact('data','pageTitle'));
        

    }
}
