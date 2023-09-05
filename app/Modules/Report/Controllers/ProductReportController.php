<?php

namespace App\Modules\Report\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Modules\Order\Models\OrderHead;
use App\Modules\Product\Models\Product;
use App\User;
use DB;
use Session;

use App;
use Auth;

class ProductReportController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       
        $pageTitle="Product Report Dahboard";
        $todate=date('Y-m-d');
        $toyear = date("Y", strtotime($todate)); 
        $tomonth = date("m");
        $form_date=date('Y-m-d', strtotime('-15 days'));


        $todays_product=Product::whereDate('product.updated_at', '>=', date('Y-m-d'))->count();
        $last_15_days_product=Product::whereBetween('product.updated_at', [$form_date,$todate])->count();
        $last_30_days_product=Product::whereBetween('product.updated_at', [date('Y-m-d', strtotime('-30 days')),$todate])->count();
        $current_month_product=Product::whereMonth('product.updated_at',$tomonth)->count();

        $merchant_lists = [''=>'Please select Merchant']+User::join('merchant_profiles','users.id','=','merchant_profiles.users_id')
                ->where('users.type','seller')->orderBy('merchant_profiles.shop_name','ASC')->pluck('merchant_profiles.shop_name','users.id')->all();

        $admin_lists = [''=>'Please select Admin']+User::where('users.type','admin')->where('users.roles_id','3')->orderBy('users.id','ASC')->pluck('users.first_name','users.id')->all();

         return view("Report::product.index",compact('pageTitle','todays_product','last_15_days_product','current_month_product','last_30_days_product','merchant_lists','admin_lists'));
    }
    

    public function total_product()
    {
        
        $pageTitle="TOTAL PRODUCT ADD OR MODIFY";

        $data = Product::join('merchant_profiles','product.merchant_id','=','merchant_profiles.users_id')->select('product.*','merchant_profiles.shop_name')->orderBy('product.id', 'desc')->paginate(200);

        return view("Report::product.product_report_index",compact('pageTitle','data'));
    }

    public function todays_update()
    {
        
        $pageTitle="TODAY'S PRODUCT ADD OR MODIFY";

        $data = Product::join('merchant_profiles','product.merchant_id','=','merchant_profiles.users_id')->select('product.*','merchant_profiles.shop_name')->whereDate('product.updated_at', '>=', date('Y-m-d'))->orderBy('product.id', 'desc')->paginate(200);

        return view("Report::product.product_report_index",compact('pageTitle','data'));
    }

    public function fifteendays_update()
    {
        
        $pageTitle="LAST FIFTEEN DAY'S PRODUCT ADD OR MODIFY";

        $todate=date('Y-m-d');
        $toyear = date("Y", strtotime($todate)); 
        $tomonth = date("m");
        $form_date=date('Y-m-d', strtotime('-15 days'));

        $data = Product::join('merchant_profiles','product.merchant_id','=','merchant_profiles.users_id')->select('product.*','merchant_profiles.shop_name')->whereBetween('product.updated_at', [$form_date,$todate])->orderBy('product.id', 'desc')->paginate(200);

        return view("Report::product.product_report_index",compact('pageTitle','data'));
    }

    public function currentmonth_update()
    {
        
        $pageTitle="CURRENT MONTH PRODUCT ADD OR MODIFY";

        $todate=date('Y-m-d');
        $toyear = date("Y", strtotime($todate)); 
        $tomonth = date("m");
        $form_date=date('Y-m-d', strtotime('-15 days'));

        $data = Product::join('merchant_profiles','product.merchant_id','=','merchant_profiles.users_id')->select('product.*','merchant_profiles.shop_name')->whereMonth('product.updated_at',$tomonth)->orderBy('product.id', 'desc')->paginate(200);

        return view("Report::product.product_report_index",compact('pageTitle','data'));
    }

    public function lastonemonth_update()
    {
        
        $pageTitle="LAST 30 DAY'S PRODUCT ADD OR MODIFY";

        $todate=date('Y-m-d');
        $toyear = date("Y", strtotime($todate)); 
        $tomonth = date("m");
        $form_date=date('Y-m-d', strtotime('-30 days'));

        $data = Product::join('merchant_profiles','product.merchant_id','=','merchant_profiles.users_id')->select('product.*','merchant_profiles.shop_name')->whereBetween('product.updated_at', [$form_date,$todate])->orderBy('product.id', 'desc')->paginate(200);

        return view("Report::product.product_report_index",compact('pageTitle','data'));
    }

    public function customreport(Request $request)
    {
        
        $todate=$request->to_date;
        $form_date=$request->from_date;

        $merchant_lists =User::join('merchant_profiles','users.id','=','merchant_profiles.users_id')
                ->where('users.id',$request->merchant_id)->first(['merchant_profiles.shop_name']);

         $data = Product::join('merchant_profiles','product.merchant_id','=','merchant_profiles.users_id');

        if(!empty($request->to_date) && !empty($request->from_date) && !empty($request->merchant_id)){
            $data = $data->where('product.merchant_id',$request->merchant_id);
            $data = $data->whereBetween('product.updated_at', [$form_date,$todate]);

            $pageTitle="FROM : ".$form_date.' TO : '.$todate." || MERCHANT:: ".($merchant_lists->shop_name);

        }elseif(!empty($request->merchant_id)){
            $data = $data->where('product.merchant_id',$request->merchant_id);

            $pageTitle="MERCHANT:: ".($merchant_lists->shop_name);
        }elseif(!empty($request->to_date) && !empty($request->from_date)){
            $data = $data->whereBetween('product.updated_at', [$form_date,$todate]);

            $pageTitle="FROM : ".$form_date.' TO : '.$todate;
        }else{
            $pageTitle = 'Recent Order';
            $data = $data->limit(50);
        }
        $data = $data->select('product.*','merchant_profiles.shop_name');
        $data = $data->orderBy('product.id', 'desc');
        $data = $data->get();

        return view("Report::product.product_report_search_index",compact('pageTitle','data'));
    }


    public function prouduct_entry(Request $request)
    {
        
        $todate=$request->to_date;
        $form_date=$request->from_date;

        $admin =User::where('users.id',$request->created_by)->first();

         $data = Product::join('users','product.created_by','=','users.id')->join('merchant_profiles','product.merchant_id','=','merchant_profiles.users_id');

        if(!empty($request->to_date) && !empty($request->from_date) && !empty($request->created_by)){
            $data = $data->where('product.created_by',$request->created_by);
           // $data = $data->whereBetween('product.updated_at', [$request->from_date,$request->to_date]);
            $data = $data->whereDate('product.created_at', '>=', $form_date);
            $data = $data->whereDate('product.created_at', '<=', $todate);
                
            $pageTitle="FROM : ".$form_date.' TO : '.$todate." || ADMIN:: ".($admin->first_name);

        }elseif(!empty($request->created_by)){
            $data = $data->where('product.created_by',$request->created_by);

            $pageTitle="ADMIN:: ".($admin->first_name);
        }elseif(!empty($request->to_date) && !empty($request->from_date)){
            //$data = $data->whereBetween('product.updated_by', [$request->from_date,$request->to_date]);
            $data = $data->whereDate('product.created_at', '>=', $form_date);
            $data = $data->whereDate('product.created_at', '<=', $todate);
            
            $pageTitle="FROM : ".$form_date.' TO : '.$todate;
        }else{
            $pageTitle = 'Recent Entry Product';
            $data = $data->limit(50);
        }
        $data = $data->select('product.*','merchant_profiles.shop_name','users.first_name');
        $data = $data->orderBy('product.created_at', 'asc');
        $data = $data->get();
        

        return view("Report::product.product_entry_report_search_index",compact('pageTitle','data','form_date','todate'));
    }

    public function product_update(Request $request)
    {
        
        $todate=$request->to_date;
        $form_date=$request->from_date;

        $admin =User::where('users.id',$request->created_by)->first();

         $data = Product::join('users','product.updated_by','=','users.id')->join('merchant_profiles','product.merchant_id','=','merchant_profiles.users_id');

        if(!empty($request->to_date) && !empty($request->from_date) && !empty($request->created_by)){
            $data = $data->where('product.updated_by',$request->created_by);
           // $data = $data->whereBetween('product.updated_at', [$request->from_date,$request->to_date]);
            $data = $data->whereDate('product.updated_at', '>=', $form_date);
            $data = $data->whereDate('product.updated_at', '<=', $todate);
                
            $pageTitle="FROM : ".$form_date.' TO : '.$todate." || ADMIN:: ".($admin->first_name);

        }elseif(!empty($request->created_by)){
            $data = $data->where('product.updated_by',$request->created_by);

            $pageTitle="ADMIN:: ".($admin->first_name);
        }elseif(!empty($request->to_date) && !empty($request->from_date)){
            //$data = $data->whereBetween('product.updated_by', [$request->from_date,$request->to_date]);
            $data = $data->whereDate('product.updated_at', '>=', $form_date);
            $data = $data->whereDate('product.updated_at', '<=', $todate);
            
            $pageTitle="FROM : ".$form_date.' TO : '.$todate;
        }else{
            $pageTitle = 'Recent Entry Product';
            $data = $data->limit(50);
        }
        $data = $data->select('product.*','merchant_profiles.shop_name','users.first_name');
        $data = $data->orderBy('product.updated_at', 'asc');
        $data = $data->get();
        

        return view("Report::product.product_entry_report_search_index",compact('pageTitle','data','form_date','todate'));
    }

   
}
