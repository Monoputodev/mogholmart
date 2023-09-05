<?php

namespace App\Modules\Report\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Modules\Order\Models\OrderHead;
use App\User;
use DB;
use Session;

use App;
use Auth;

class OrderReportController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       
        $pageTitle="Order Report Dahboard";
        $todate=date('Y-m-d');
        $toyear = date("Y", strtotime($todate)); 
        $tomonth = date("m");
        $form_date=date('Y-m-d', strtotime('-15 days'));


        $todays_order=OrderHead::whereDate('order_head.date', '>=', date('Y-m-d'))->count();
        $last_15_days_order=OrderHead::whereBetween('order_head.date', [$form_date,$todate])->count();
        $last_30_days_order=OrderHead::whereBetween('order_head.date', [date('Y-m-d', strtotime('-30 days')),$todate])->count();
        $current_month_order=OrderHead::whereMonth('order_head.date',$tomonth)->count();

        $merchant_lists = [''=>'Please select Merchant']+User::join('merchant_profiles','users.id','=','merchant_profiles.users_id')
                ->where('users.type','seller')->orderBy('merchant_profiles.shop_name','ASC')->pluck('merchant_profiles.shop_name','users.id')->all();

         return view("Report::order.index",compact('pageTitle','todays_order','last_15_days_order','current_month_order','last_30_days_order','merchant_lists'));
    }
    

    public function total_order()
    {
        
        $pageTitle="TOTAL ORDER LIST";

        $data = OrderHead::orderBy('id', 'desc')->paginate(30);

        return view("Report::order.order_report_index",compact('pageTitle','data'));
    }
     public function todays_order()
    {
        
        $pageTitle="TODAY'S TOTAL ORDER LIST";

        $data = OrderHead::whereDate('order_head.date', '>=', date('Y-m-d'))->orderBy('id', 'desc')->paginate(30);

        return view("Report::order.order_report_index",compact('pageTitle','data'));
    }

    public function fifteendays_order()
    {
        
        $pageTitle="LAST FIFTEEN DAY'S TOTAL ORDER LIST";

        $todate=date('Y-m-d');
        $toyear = date("Y", strtotime($todate)); 
        $tomonth = date("m");
        $form_date=date('Y-m-d', strtotime('-15 days'));

        $data = OrderHead::whereBetween('order_head.date', [$form_date,$todate])->orderBy('id', 'desc')->paginate(30);

        return view("Report::order.order_report_index",compact('pageTitle','data'));
    }

    public function currentmonth_order()
    {
        
        $pageTitle="CURRENT MONTH TOTAL ORDER LIST";

        $todate=date('Y-m-d');
        $toyear = date("Y", strtotime($todate)); 
        $tomonth = date("m");
        $form_date=date('Y-m-d', strtotime('-15 days'));

        $data = OrderHead::whereMonth('order_head.date',$tomonth)->orderBy('id', 'desc')->paginate(30);

        return view("Report::order.order_report_index",compact('pageTitle','data'));
    }

    public function lastonemonth_order()
    {
        
        $pageTitle="LAST 30 DAY'S TOTAL ORDER LIST";

        $todate=date('Y-m-d');
        $toyear = date("Y", strtotime($todate)); 
        $tomonth = date("m");
        $form_date=date('Y-m-d', strtotime('-30 days'));

        $data = OrderHead::whereBetween('order_head.date', [$form_date,$todate])->orderBy('id', 'desc')->paginate(30);

        return view("Report::order.order_report_index",compact('pageTitle','data'));
    }

    public function customreport(Request $request)
    {
        
        $todate=$request->to_date;
        $form_date=$request->from_date;

        $merchant_lists =User::join('merchant_profiles','users.id','=','merchant_profiles.users_id')
                ->where('users.id',$request->merchant_id)->first(['merchant_profiles.shop_name']);

        $data = OrderHead::join('order_details','order_details.order_head_id','=','order_head.id');

        if(!empty($request->to_date) && !empty($request->from_date) && !empty($request->merchant_id)){
            $data = $data->where('order_details.product_merchant_id',$request->merchant_id);
            $data = $data->whereBetween('order_head.date', [$form_date,$todate]);

            $pageTitle="FROM : ".$form_date.' TO : '.$todate." || MERCHANT:: ".($merchant_lists->shop_name);

        }elseif(!empty($request->merchant_id)){
            $data = $data->where('order_details.product_merchant_id',$request->merchant_id);

            $pageTitle="MERCHANT:: ".($merchant_lists->shop_name);
        }elseif(!empty($request->to_date) && !empty($request->from_date)){
            $data = $data->whereBetween('order_head.date', [$form_date,$todate]);

            $pageTitle="FROM : ".$form_date.' TO : '.$todate;
        }else{
            $pageTitle = 'Recent Order';
            $data = $data->limit(50);
        }

        $data = $data->orderBy('order_head.id', 'desc');
        $data = $data->get();


        return view("Report::order.order_report_search_index",compact('pageTitle','data'));
    } 

    public function customreport_by_payment(Request $request)
    {
        
        $payment_type=$request->payment_type;
        $status=$request->status;

        $data = new OrderHead;

        if(!empty($request->payment_type) && !empty($request->status)){
            $data = $data->where('order_head.payment_type',$request->payment_type);
            $data = $data->where('order_head.status', $request->status);

            $pageTitle="PAYMENT TYPE : ".$payment_type.' ORDER STATUS : '.$status;

        }elseif(!empty($request->payment_type)){
            $data = $data->where('order_head.payment_type',$request->payment_type);

            $pageTitle="PAYMENT TYPE : ".$payment_type;
        }elseif(!empty($request->status)){
            $data = $data->where('order_head.status',$request->status);

            $pageTitle="PAYMENT TYPE : ".$status;
        }else{
            $pageTitle = 'Recent Order';
            $data = $data->limit(50);
        }

        $data = $data->orderBy('order_head.id', 'desc');
        $data = $data->get();


        return view("Report::order.order_report_by_payment_search_index",compact('pageTitle','data'));
    }

   
}
