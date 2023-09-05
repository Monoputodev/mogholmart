<?php

namespace App\Modules\Comission\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;
use App\Modules\Comission\Models\ComissionSetting;
use App\Modules\Order\Models\OrderDetails;
use App\Modules\Order\Models\OrderHead;
use App\User;
use App\Modules\Comission\Requests;

use DB;
use Session;
use Illuminate\Support\Facades\Input;

class ComissionController extends Controller
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
* comision constructor.
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

    $pageTitle = "List of  Comission";
// Get Parent user data
    $data = ComissionSetting::whereNotIn('comissions_setting.comission_type',['default'])->with('relMerchant')->get();


// return view
    return view("Comission::comissionsetting.index", compact('data','pageTitle'));
}

/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
public function create()
{
    $pageTitle = "Add New Comission";
// return View
    $merchant=[''=>'Please Select Merchant']+ User::where('status','active')->where('type','seller')->pluck('mobile_no','id')->all();
    return view("Comission::comissionsetting.create", compact('pageTitle','merchant'));
}

/**
* Store a newly created resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @return \Illuminate\Http\Response
*/
public function store(Requests\ComissionSettingRequest $request)
{
// Get all input data
    $input = $request->all();

    $check_merchant = ComissionSetting::where('comissions_setting.merchant_id',$input['merchant_id'])->first();

// Find unique product
    if(count($check_merchant) > 0)
    {
// Slug presents in current id
        $comission_update_required = 'yes';

    }  

    if($comission_update_required == 'yes')
    {
        Session::flash('error','This Merchant already presents, Please Try another one.');

    }else{
# code...

        /* Transaction Start Here */
        DB::beginTransaction();
        try {

// Store user data 
            $comission_data = ComissionSetting::create($input);

            DB::commit();
            Session::flash('message', 'Comission is added!');

            return redirect(config('global.prefix_name').'/comission/setting/index');

        } catch (\Exception $e) {
//If there are any exceptions, rollback the transaction`
            DB::rollback();
            Session::flash('danger', $e->getMessage());
        }
    }

    return back();
}

/**
* Display the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function show($id)
{
    $pageTitle = 'View Comission Informations';

// Find ComissionSetting data
    $data = ComissionSetting::where('comissions_setting.id', $id)
    ->select('comissions_setting.*')
    ->first();                    

    if(!empty($data))
    {
// If found ComissionSetting
        return view("Comission::comissionsetting.show", compact('data','pageTitle'));

    }else{
// If ComissionSetting not found
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
    $pageTitle = "Update Comission";

// Find menu
    $data = ComissionSetting::where('comissions_setting.id', $id)
    ->select('comissions_setting.*')
    ->first();

    $merchant=[''=>'Please select Merchant']+ User::where('status','active')->where('type','seller')->pluck('mobile_no','id')->all();
// If menu not found                
    if(empty($data)){
        Session::flash('danger', 'Comission not found.');
        return redirect()->route('admin.comission.setting.index');
    }


// Return view
    return view("Comission::comissionsetting.edit", compact('data','pageTitle','merchant'));
}

/**
* Update the specified resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function update(Requests\ComissionSettingRequest $request, $id)
{
// Get all input data
    $input = $request->all();

    $model = ComissionSetting::where('comissions_setting.id', $id)
    ->select('comissions_setting.*')
    ->first();

    if($model)
    {
// Check Slug
        $check_merchant = ComissionSetting::where('comissions_setting.merchant_id',$input['merchant_id'])
        ->first();

// Find unique product
        if(count($check_merchant) > 0 && $check_merchant->id == $id)
        {
// Slug presents in current id
            $comission_update_required = 'yes';
        }elseif (count($check_merchant) > 0 && $check_merchant->id != $id) {
// Slug present, but not in current id
            $comission_update_required = 'no';
        }else{
// Slug not present
            $comission_update_required = 'yes';
        }   


        if($comission_update_required == 'yes')
        {


            /* Transaction Start Here */
            DB::beginTransaction();
            try {

// Store user data 
                $result = $model->update($input);

                DB::commit();
                Session::flash('message', 'Comission is Updated!');

                return redirect(config('global.prefix_name').'/comission/setting/index');

            } catch (\Exception $e) {
//If there are any exceptions, rollback the transaction`
                DB::rollback();
                print($e->getMessage());
                exit();
                Session::flash('danger', $e->getMessage());
            }
        }else{
            Session::flash('danger','This Merchant already presents, Please Try another one.');
        }


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
    $model = ComissionSetting::where('comissions_setting.id', $id)
    ->select('comissions_setting.*')
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


    $pageTitle = 'Comission Information';

// User model initialize
    $model = new ComissionSetting();

    if($this->isGetRequest())
    {
// Search data found
        $search_keywords = trim(Input::get('search_keywords'));
        $model = $model->where(function ($query) use($search_keywords){
            $query = $query->orWhere('merchant_id', 'LIKE', '%'.$search_keywords.'%');
            $query = $query->orWhere('comissions_setting.status', 'LIKE', '%'.$search_keywords.'%');
            $query = $query->orWhere('comission_type', 'LIKE', '%'.$search_keywords.'%');
            $query = $query->orWhere('to_date', 'LIKE', '%'.$search_keywords.'%');
            $query = $query->orWhere('from_date', 'LIKE', '%'.$search_keywords.'%');
            $query = $query->orWhere('comission_rate', 'LIKE', '%'.$search_keywords.'%');
        })->whereNotIn('comissions_setting.comission_type',['default']);
        $data = $model->select('comissions_setting.*')->paginate(30);
    }else{

// If get data not found
        $data = ComissionSetting::paginate(30);
    }

// Return view
    return view("Comission::comissionsetting.index", compact('data','pageTitle'));


}

// comission by merchant...........................

public function comission_by_merchant()
{
    $pageTitle = "List of  Comissin By Merchant";
// Get Parent user data

    $data=OrderDetails::join('merchant_profiles','order_details.product_merchant_id','=','merchant_profiles.users_id')
    ->leftjoin('comissions_setting','order_details.product_merchant_id','=','comissions_setting.merchant_id')
    ->join('order_head','order_details.order_head_id','=','order_head.id')
    ->whereNotIn('order_head.status',['pending'])
    ->select('merchant_profiles.shop_name','comissions_setting.comission_rate','comissions_setting.comission_type','order_details.product_merchant_id', DB::raw('sum(order_details.comission_price) as comission_amount'), DB::raw('sum(order_details.total_price) as total_amount'))
    ->groupby('order_details.product_merchant_id')
    ->get();  


// return view
    return view("Comission::comissinbymerchant.index", compact('data','pageTitle'));
}

//comission serarch

public function comission_by_merchant_search(Request $request)
{
    $pageTitle = 'Comission By Merchant Information';

// User model initialize
    $model = OrderDetails::join('merchant_profiles','order_details.product_merchant_id','=','merchant_profiles.users_id')
    ->leftjoin('comissions_setting','order_details.product_merchant_id','=','comissions_setting.merchant_id')
    ->join('order_head','order_details.order_head_id','=','order_head.id');



    if($this->isGetRequest())
    {
// Search data found
        $search_keywords = trim(Input::get('search_keywords'));
        $model = $model->where(function ($query) use($search_keywords){
            $query = $query->orWhere('merchant_profiles.shop_name', 'LIKE', '%'.$search_keywords.'%');   
            $query = $query->orWhere('comissions_setting.comission_type', 'LIKE', '%'.$search_keywords.'%');
            $query = $query->orWhere('comissions_setting.comission_rate', 'LIKE', '%'.$search_keywords.'%');
            $query = $query->whereNotIn('order_head.status',['pending']);
        });
        $data = $model->select('merchant_profiles.shop_name','comissions_setting.comission_rate','comissions_setting.comission_type','order_details.product_merchant_id', DB::raw('sum(order_details.comission_price) as comission_amount'), DB::raw('sum(order_details.total_price) as total_amount'))
        ->groupby('order_details.product_merchant_id')->paginate(30);
    }else{

// If get data not found
        $data = OrderDetails::join('merchant_profiles','order_details.product_merchant_id','=','merchant_profiles.users_id')
        ->leftjoin('comissions_setting','order_details.product_merchant_id','=','comissions_setting.merchant_id')
        ->join('order_head','order_details.order_head_id','=','order_head.id')
        ->whereNotIn('order_head.status',['pending'])
        ->select('merchant_profiles.shop_name','comissions_setting.comission_rate','comissions_setting.comission_type','order_details.product_merchant_id', DB::raw('sum(order_details.comission_price) as comission_amount'), DB::raw('sum(order_details.total_price) as total_amount'))
        ->groupby('order_details.product_merchant_id')->paginate(30);
    }

// Return view
    return view("Comission::comissinbymerchant.index", compact('data','pageTitle'));
}

//merchant wise details show

public function comission_by_merchant_show($id)
{
    $pageTitle = 'Merchant Comission Details ';

    $merchant_wise_data=OrderDetails::join('merchant_profiles','order_details.product_merchant_id','=','merchant_profiles.users_id')
    ->leftjoin('comissions_setting','order_details.product_merchant_id','=','comissions_setting.merchant_id')
    ->join('order_head','order_details.order_head_id','=','order_head.id')
    ->whereNotIn('order_head.status',['pending'])
    ->where('order_details.product_merchant_id',$id)
    ->select('merchant_profiles.shop_name','comissions_setting.comission_rate','comissions_setting.comission_type','order_details.product_merchant_id', DB::raw('sum(order_details.comission_price) as comission_amount'), DB::raw('sum(order_details.total_price) as total_amount'))
    ->groupby('order_details.product_merchant_id')
    ->first();

    $data = OrderHead::rightjoin('order_details','order_details.order_head_id','=','order_head.id')
    ->where('order_details.product_merchant_id',$id)
    ->whereNotIn('order_head.status',['pending'])
    ->orderBy('order_head.id', 'desc')
    ->groupBy('order_head.id')
    ->get(['order_head.*','order_details.comission_price',DB::raw('sum(order_details.comission_price) as comission_price'), DB::raw('sum(order_details.total_price) as total_price')]);

    $merchant_list=[''=>'Select Merchant']+OrderDetails::join('merchant_profiles','order_details.product_merchant_id','=','merchant_profiles.users_id')
    ->join('order_head','order_details.order_head_id','=','order_head.id')
    ->whereNotIn('order_head.status',['pending'])
    ->groupby('order_details.product_merchant_id')
    ->pluck('merchant_profiles.shop_name','order_details.product_merchant_id')
    ->all();

    return view("Comission::comissinbymerchant.show", compact('data','pageTitle','merchant_wise_data','id','merchant_list'));

}

public function comission_by_merchant_search_show(Request $request)
{
    $pageTitle = 'Searching Order Lists';

    $model = OrderHead::rightjoin('order_details','order_details.order_head_id','=','order_head.id');

    if ($this->isGetRequest()) {

        $status = Input::get('status');
        $date_range = Input::get('date_range');
        $from_date = Input::get('from_date');
        $to_date = Input::get('to_date');
        $merchant_id = Input::get('merchant_id');

        if ($status != '') {
            $model = $model->where('order_head.status', $status);
        }

        if ($merchant_id != '') {
            $model = $model->where('order_details.product_merchant_id', $merchant_id);
        }

        if ($from_date != '' && $to_date != '') {
            $model = $model->where('order_head.date', '>=', $from_date);
            $model = $model->where('order_head.date', '<=', $to_date);
        }

        $data = $model->whereNotIn('order_head.status',['pending'])
        ->orderBy('order_head.id', 'desc')
        ->groupBy('order_head.id')
        ->get(['order_head.*','order_details.comission_price',DB::raw('sum(order_details.comission_price) as comission_price'), DB::raw('sum(order_details.total_price) as total_price')]);

    } else {
        $data = OrderHead::rightjoin('order_details','order_details.order_head_id','=','order_head.id')->whereNotIn('order_head.status',['pending'])
        ->orderBy('order_head.id', 'desc')
        ->groupBy('order_head.id')
        ->select('order_head.*','order_details.comission_price',DB::raw('sum(order_details.comission_price) as comission_price'), DB::raw('sum(order_details.total_price) as total_price'))
        ->paginate(30);
    }

    $merchant_list=[''=>'Select Merchant']+OrderDetails::join('merchant_profiles','order_details.product_merchant_id','=','merchant_profiles.users_id')
    ->join('order_head','order_details.order_head_id','=','order_head.id')
    ->whereNotIn('order_head.status',['pending'])
    ->groupby('order_details.product_merchant_id')
    ->pluck('merchant_profiles.shop_name','order_details.product_merchant_id')
    ->all();

    $merchant_wise_data=OrderDetails::join('merchant_profiles','order_details.product_merchant_id','=','merchant_profiles.users_id')
    ->leftjoin('comissions_setting','order_details.product_merchant_id','=','comissions_setting.merchant_id')
    ->join('order_head','order_details.order_head_id','=','order_head.id')
    ->whereNotIn('order_head.status',['pending'])
    ->where('order_details.product_merchant_id',$merchant_id)
    ->select('merchant_profiles.shop_name','comissions_setting.comission_rate','comissions_setting.comission_type','order_details.product_merchant_id', DB::raw('sum(order_details.comission_price) as comission_amount'), DB::raw('sum(order_details.total_price) as total_amount'))
    ->groupby('order_details.product_merchant_id')
    ->first();

    return view('Comission::comissinbymerchant.show', [
        'pageTitle' => $pageTitle,
        'data' => $data,
        'merchant_list' => $merchant_list,
        'merchant_wise_data' => $merchant_wise_data,
        'id' => $merchant_id,
    ]);


}


}

/*echo '<pre>';
print_r($data);
echo '</pre>';    
exit();*/
