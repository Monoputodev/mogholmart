<?php

namespace App\Modules\Product\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Product\Models\Brand;
use App\Modules\Product\Models\Manufacturer;
use App\Modules\Product\Requests;
use Illuminate\Support\Facades\Input;
use DB;
use Session;
use Image;
use File;
use App;
use Auth;

class BrandController extends Controller
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

    protected $brand_image_path;
    protected $brand_image_relative_path;
    /**
     * BrandController constructor.
     */
    public function __construct()
    {

        $this->brand_image_path = public_path('uploads/brand');
        $this->brand_image_relative_path = '/uploads/brand';

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = "List of Brand Information";
        // Get Parent category data
        $data = Brand::where('status','active')->orderBy('id','desc')->paginate(30);
        // return view
        return view("Product::brand.index", compact('pageTitle','data'));
        
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = "Add New Brand";

        // find child & parent relations
        $manufacturer_lists = [''=>'Please select dealer']+ Manufacturer::where('status','active')->pluck('title','id')->all();

        // return View
        return view("Product::brand.create", compact('manufacturer_lists','pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\BrandRequest $request)
    {
        // Get all input data
        $input = $request->all();

        // Check already presents or not
        $data = Brand::where('slug',$input['slug'])->exists();

        if( !$data )
        {

            // Image link 
            $brand_image = $request->file('image_link');

            if($brand_image) {
                $brand_image_title = str_replace(' ', '-', $input['title'] . '.' . $brand_image->getClientOriginalExtension());
                $brand_image_link = $this->brand_image_relative_path.'/'.$brand_image_title;

            }else{
                $brand_image_link = '';
                $brand_image_title = '';
            }

            $input['image_link'] = $brand_image_title;

            /* Transaction Start Here */
            DB::beginTransaction();
            try {

                // Store Brand data 
                if($brand_data = Brand::create($input))
                {
                    // Store Brand image
                    if($brand_image != null){
                        $brand_image->move($this->brand_image_path, $brand_image_title);
                    }

                }

                DB::commit();
                Session::flash('message', 'Brand is added!');
                return redirect(config('global.prefix_name').'/brand/index');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                print($e->getMessage());
                exit();
                Session::flash('danger', $e->getMessage());
            }

        }else{
            Session::flash('info', 'This Brand already added!');
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

        $pageTitle = 'View Brand Informations';

        // Find brand data
        $data = Brand::where('brand.id',$id)->first();                    

        if(count($data) > 0)
        {
            // If found brand
            return view("Product::brand.show", compact('data','pageTitle'));

        }else{
            // If brand not found
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
        $pageTitle = "Update Brand";

        // Find Brand
        $data = Brand::where('brand.id',$id)->first();

        // If Brand not found                
        if(count($data) <= 0){
            Session::flash('danger', 'Brand not found.');
            return redirect()->route('admin.brand.index');
        }

        // Get parent & child hierarchy
        $manufacturer_lists = [''=>'Please select manufacturer']+ Manufacturer::where('status','active')->pluck('title','id')->all();

        // Return view
        return view("Product::brand.edit", compact('data','manufacturer_lists','pageTitle'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\BrandRequest $request, $id)
    {
        
        $input = $request->all();

        // Find Brand
        $model = Brand::where('brand.id',$id)->first();

        // Image file 
        $brand_image = $request->file('image_link');

        if($brand_image) {
            $brand_image_title = str_replace(' ', '-', $input['title'] . '.' . $brand_image->getClientOriginalExtension());
            $brand_image_link = $this->brand_image_relative_path.'/'.$brand_image_title;
        }else{
            $brand_image_link = $model->image_link;
            $brand_image_title = $model->image_link;
        }

        $input['image_link'] = $brand_image_title;


        DB::beginTransaction();
        try {
            // Update brand
            $result = $model->update($input);

            if($result){

                if($brand_image != null){
                    File::Delete($model->image_link);
                    $brand_image->move($this->brand_image_path, $brand_image_title);
                }

                DB::commit();
            }

            Session::flash('message', 'Successfully updated!');
            return redirect(config('global.prefix_name').'/brand/index');
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
        // Find Brand 

        $model = Brand::where('brand.id',$id)
                ->select('brand.*')
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



    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {

        $pageTitle = 'Brand Information';

        // Brand model initialize
        $model = new Brand();

        if($this->isGetRequest())
        {
            // Search data found
            $search_keywords = trim(Input::get('search_keywords'));
            $model = $model->where(function ($query) use($search_keywords){
                    $query = $query->orWhere('title', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('brand.status', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('is_top_brand', 'LIKE', '%'.$search_keywords.'%');
                });
            $data = $model->where('status','active')->select('brand.*')->orderBy('id','desc')->paginate(30);
        }else{

            // If get data not found
            $data = Brand::where('status','active')->orderBy('id','desc')->paginate(30);
        }

        $data->appends(['search_keywords' => Input::get('search_keywords')]);

        // Return view
        return view("Product::brand.index", compact('data','pageTitle'));
        

    }
}
