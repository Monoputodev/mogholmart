<?php

namespace App\Modules\Product\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Modules\Product\Models\ShippingCalculationSetting;
use App\Modules\Product\Requests;

use DB;
use Session;
use Illuminate\Support\Facades\Input;


class ShippingCalculationController extends Controller
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
     * ShippingCalculationController constructor.
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

        $pageTitle = "List of Shipping Information";

        // Get Shipping data
        $data = ShippingCalculationSetting::orderBy('id','desc')->get();


        // return view
        return view("Product::shippingcalculation.index",compact('pageTitle','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $pageTitle = "Add New Shipping Calculation Setting";

        // return View
        return view("Product::shippingcalculation.create", compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\ShippingCalculationRequest $request)
    {
        // Get all input data
        $input = $request->all();

        // Check already presents or not
        $data = ShippingCalculationSetting::where('shipping_type',$input['shipping_type'])->exists();

        if( !$data )
        {
            

           
            /* Transaction Start Here */
            DB::beginTransaction();
            try {

         
                $shippingdata = ShippingCalculationSetting::create($input);
                
                DB::commit();
                Session::flash('message', 'Shipping Calculation Setting is added!');
                return redirect('admin-shipping-calculation-index');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                print($e->getMessage());
                exit();
                Session::flash('danger', $e->getMessage());
            }

        }else{
            Session::flash('info', 'This Shipping Calculation Setting already added!');
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
        $pageTitle = 'View Shipping Calculation Setting Informations';

        // Find Shipping Calculation Setting data
        $data = ShippingCalculationSetting::find($id);

        if(count($data) > 0)
        {
            // If found Shipping Calculation Setting
            return view("Product::shippingcalculation.show", compact('data','pageTitle'));

        }else{
            // If Shipping Calculation Setting not found
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
       $pageTitle = "Update Shipping Calculation Setting";

        // Find Shipping Calculation Setting
        $data = ShippingCalculationSetting::find($id);

        // If Shipping Calculation Setting not found                
        if(count($data) <= 0){
            Session::flash('danger', 'Shipping Calculation Setting not found.');
            return redirect()->route('admin.shipping.calculation.setting.index');
        }


        // Return view
        return view("Product::shippingcalculation.edit", compact('data','pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\ShippingCalculationRequest $request, $id)
    {
        $input = $request->all();

        // Find shipping_calculation_setting

        $model = ShippingCalculationSetting::where('shipping_calculation_setting.id', $id)
            ->select('shipping_calculation_setting.*')
            ->first();


        DB::beginTransaction();
        try {
            // Update shipping_calculation_setting

                $result = $model->update($input);
                DB::commit();

            Session::flash('message', 'Successfully updated!');
            return redirect('admin-shipping-calculation-index');
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
        $model = ShippingCalculationSetting::where('shipping_calculation_setting.id', $id)
            ->select('shipping_calculation_setting.*')
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

        
        $pageTitle = 'Shipping Calculation Information';

        // Shipping Calculation model initialize
        $model = new ShippingCalculationSetting();

        if($this->isGetRequest())
        {
            // Search data found
            $search_keywords = trim(Input::get('search_keywords'));
            $model = $model->where(function ($query) use($search_keywords){
                    $query = $query->orWhere('shipping_type', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('shipping_calculation_setting.status', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('method', 'LIKE', '%'.$search_keywords.'%');
                });
            $data = $model->select('shipping_calculation_setting.*')->orderBy('id','desc')->paginate(30);
        }else{

            // If get data not found
            $data = ShippingCalculationSetting::orderBy('id','desc')->paginate(30);
        }

        // Return view
        return view("Product::shippingcalculation.index", compact('data','pageTitle'));

    }
}
