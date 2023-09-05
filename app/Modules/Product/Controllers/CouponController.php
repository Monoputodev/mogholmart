<?php

namespace App\Modules\Product\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Product\Models\Coupon;
use App\Modules\Product\Requests;
use Illuminate\Support\Facades\Input;
use DB;
use Session;
use App;
use Auth;

class CouponController extends Controller
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
     * CouponController constructor.
     */
    public function __construct()
    {

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = "List of Coupon Information";

        // Get Parent category data
        $data = Coupon::orderBy('id','desc')->get();

        // return view
        return view("Product::coupon.index", compact('pageTitle','data'));
        
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = "Add Coupon";

        // return View
        return view("Product::coupon.create", compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\CouponRequest $request)
    {
        // Get all input data
        $input = $request->all();

        // Check already presents or not
        $data = Coupon::where('coupon_code',$input['coupon_code'])->where('coupon_type',$input['coupon_type'])->exists();

        if(!$data )
        {

            /* Transaction Start Here */
            DB::beginTransaction();
            try {

                // Store Coupon data 
                if($coupon = Coupon::create($input))
                {  

                    DB::commit();
                }

                Session::flash('message', 'Coupon is added!');
                 return redirect()->route('admin.coupon.index');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
               
                Session::flash('danger', $e->getMessage());
            }

        }else{
            Session::flash('info', 'This Coupon already added!');
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

        $pageTitle = 'View Coupon Informations';

        // Find brand data
        $data = Coupon::where('coupon.id',$id)->first();                    

        if(count($data) > 0)
        {
            // If found brand
            return view("Product::coupon.show", compact('data','pageTitle'));

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
        $pageTitle = "Update Coupon";

        // Find Coupon
        $data = Coupon::where('coupon.id',$id)->first();

        // If Coupon not found                
        if(count($data) <= 0){
            Session::flash('danger', 'Coupon not found.');
            return redirect()->route('admin.coupon.index');
        }

        // Return view
        return view("Product::coupon.edit", compact('data','pageTitle'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\CouponRequest $request, $id)
    {
        
        $input = $request->all();

        // Check already presents or not
        $model = Coupon::where('coupon.id',$id)->first();

        if($model)
        {

            /* Transaction Start Here */
            DB::beginTransaction();
            try {
                // Store Coupon data 
                $modeldata =$model->update($input);

                DB::commit();
                Session::flash('message', 'Coupon is Updated!');
                 return redirect()->route('admin.coupon.index');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
               
                Session::flash('danger', $e->getMessage());
            }

        }else{
            Session::flash('info', 'This Coupon Not found!');
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
        // Find Coupon 

        $model = Coupon::where('coupon.id',$id)
                ->select('coupon.*')
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
            }

            Session::flash('message', "Successfully Deleted.");

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

        
        $pageTitle = 'Coupon Information';

        // Coupon model initialize
        $model = new Coupon();

        if($this->isGetRequest())
        {
            // Search data found
            $search_keywords = trim(Input::get('search_keywords'));
            $model = $model->where(function ($query) use($search_keywords){
                    $query = $query->orWhere('coupon_name', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('coupon.status', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('coupon_type', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('coupon_code', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('valid_from', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('valid_to', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('amount', 'LIKE', '%'.$search_keywords.'%');
                });
            $data = $model->select('coupon.*')->orderBy('id','desc')->paginate(30);
        }else{

            // If get data not found
            $data = Coupon::orderBy('id','desc')->paginate(30);
        }

        // Return view
        return view("Product::coupon.index", compact('data','pageTitle'));
        

    }
}
