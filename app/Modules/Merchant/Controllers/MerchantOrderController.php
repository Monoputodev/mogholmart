<?php

namespace App\Modules\Merchant\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Modules\Order\Requests;
use App\Modules\Order\Models\OrderHead;
use App\Modules\Order\Models\OrderShipping;
use App\Modules\Product\Models\VwProduct;
use App\Modules\Product\Models\ProductInventory;
use App\User;
use App;
use DB;
use Session;
use Illuminate\Support\Facades\Input;

use Image;
use File;

class MerchantOrderController extends Controller
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
     * MerchantOrderController constructor.
     */
    public function __construct()
    {
        
    }

    public function index()
    {
        $pageTitle = "Merchant Order List";
        $data = \Auth::user();
        $todate=date('Y-m-d');
        $toyear = date("Y", strtotime($todate)); 
        $tomonth = date("m");
        $form_date=date('Y-m-d', strtotime('-15 days'));

        $varifaid_user =User::join('merchant_profiles','users.id','=','merchant_profiles.users_id')->where('users.id',$data->id)->select('users.email','users.merchant_agreement', 'users.id','merchant_profiles.shop_name')->first();

        $orderdata = OrderHead::join('order_details','order_details.order_head_id','=','order_head.id')
                        ->where('order_details.product_merchant_id',\Auth::user()->id)
                        ->select('order_head.*','order_details.product_merchant_id', DB::raw('sum(order_details.total_price) as total_price'))
                        ->groupBy('order_head.id')
                        ->orderBy('order_head.id', 'desc')
                        ->paginate(30);
        

        $footer_manu=DB::table('menu')->where('menu.position','footer-1')->where('menu.status','active')->orderBy('menu.short_order','asc')->get();

        $todays_order=OrderHead::join('order_details','order_details.order_head_id','=','order_head.id')
                                ->where('order_details.product_merchant_id',\Auth::user()->id)
                                ->whereDate('order_head.date', '>=', date('Y-m-d'))
                                ->groupBy('order_details.order_head_id')
                                ->count();

       

        $last_15_days_order=OrderHead::join('order_details','order_details.order_head_id','=','order_head.id')
                                ->where('order_details.product_merchant_id',\Auth::user()->id)
                                ->whereBetween('order_head.date', [$form_date,$todate])
                                ->groupBy('order_details.order_head_id')
                                ->count();

        $current_month_order=OrderHead::join('order_details','order_details.order_head_id','=','order_head.id')
                                ->where('order_details.product_merchant_id',\Auth::user()->id)
                                ->whereMonth('order_head.date',$tomonth)
                                ->groupBy('order_details.order_head_id')
                                ->count();

       $total_order=OrderHead::join('order_details','order_details.order_head_id','=','order_head.id')
                                ->where('order_details.product_merchant_id', \Auth::user()->id)
                                ->select('order_head.id')
                                ->count();


        return view('Merchant::merchantorder.index', [
            'pageTitle' => $pageTitle,
            'data' => $data,
            'orderdata' => $orderdata,
            'footer_manu' => $footer_manu,
            'varifaid_user' => $varifaid_user,
            'todays_order' => $todays_order,
            'last_15_days_order' => $last_15_days_order,
            'current_month_order' => $current_month_order,
            'total_order' => $total_order,
        ]);
    }

    public function todays_order()
    {
        $pageTitle = "Merchant Order List";
        $data = \Auth::user();


        $varifaid_user =User::join('merchant_profiles','users.id','=','merchant_profiles.users_id')->where('users.id',$data->id)->select('users.email','users.merchant_agreement', 'users.id','merchant_profiles.shop_name')->first();

        $orderdata = OrderHead::join('order_details','order_details.order_head_id','=','order_head.id')
                ->where('order_details.product_merchant_id',\Auth::user()->id)
                ->whereDate('order_head.date', '>=', date('Y-m-d'))
                ->select('order_head.*','order_details.product_merchant_id', DB::raw('sum(order_details.total_price) as total_price'))
                ->groupBy('order_head.id')
                ->orderBy('order_head.id', 'desc')
                ->paginate(30);
        

        $footer_manu=DB::table('menu')->where('menu.position','footer-1')->where('menu.status','active')->orderBy('menu.short_order','asc')->get();


        $todate=date('Y-m-d');
        $toyear = date("Y", strtotime($todate)); 
        $tomonth = date("m");
        $form_date=date('Y-m-d', strtotime('-15 days'));

        $todays_order=OrderHead::join('order_details','order_details.order_head_id','=','order_head.id')
                                ->where('order_details.product_merchant_id',\Auth::user()->id)
                                ->whereDate('order_head.date', '>=', date('Y-m-d'))
                                ->select('order_head.id')
                                ->count();


        $last_15_days_order=OrderHead::join('order_details','order_details.order_head_id','=','order_head.id')
                            ->where('order_details.product_merchant_id', \Auth::user()->id)
                            ->whereBetween('order_head.date', [$form_date,$todate])
                            ->select('order_head.id')
                            ->count();

        $current_month_order=OrderHead::join('order_details','order_details.order_head_id','=','order_head.id')
                                ->where('order_details.product_merchant_id', \Auth::user()->id)
                                ->whereMonth('order_head.date',$tomonth)
                                ->select('order_head.id')
                                ->count();

        $total_order=OrderHead::join('order_details','order_details.order_head_id','=','order_head.id')
                                ->where('order_details.product_merchant_id', \Auth::user()->id)
                                ->select('order_head.id')
                                ->count();

        return view('Merchant::merchantorder.index', [
            'pageTitle' => $pageTitle,
            'data' => $data,
            'orderdata' => $orderdata,
            'footer_manu' => $footer_manu,
            'varifaid_user' => $varifaid_user,
            'todays_order' => $todays_order,
            'last_15_days_order' => $last_15_days_order,
            'current_month_order' => $current_month_order,
            'total_order' => $total_order,
        ]);
    }

    public function fifteendays_order()
    {
        $pageTitle = "Merchant Order List";
        $data = \Auth::user();
        $todate=date('Y-m-d');
        $toyear = date("Y", strtotime($todate)); 
        $tomonth = date("m");
        $form_date=date('Y-m-d', strtotime('-15 days'));

        $varifaid_user =User::join('merchant_profiles','users.id','=','merchant_profiles.users_id')->where('users.id',$data->id)->select('users.email','users.merchant_agreement', 'users.id','merchant_profiles.shop_name')->first();

        $orderdata = OrderHead::join('order_details','order_details.order_head_id','=','order_head.id')
                ->where('order_details.product_merchant_id',\Auth::user()->id)
                ->whereBetween('order_head.date', [$form_date,$todate])
                ->select('order_head.*','order_details.product_merchant_id', DB::raw('sum(order_details.total_price) as total_price'))
                ->groupBy('order_head.id')
                ->orderBy('order_head.id', 'desc')
                ->paginate(30);
        

        $footer_manu=DB::table('menu')->where('menu.position','footer-1')->where('menu.status','active')->orderBy('menu.short_order','asc')->get();

        $todays_order=OrderHead::join('order_details','order_details.order_head_id','=','order_head.id')
                                ->where('order_details.product_merchant_id',\Auth::user()->id)
                                ->whereDate('order_head.date', '>=', date('Y-m-d'))
                                ->select('order_head.id')
                                ->count();


        $last_15_days_order=OrderHead::join('order_details','order_details.order_head_id','=','order_head.id')
                            ->where('order_details.product_merchant_id', \Auth::user()->id)
                            ->whereBetween('order_head.date', [$form_date,$todate])
                            ->select('order_head.id')
                            ->count();

        $current_month_order=OrderHead::join('order_details','order_details.order_head_id','=','order_head.id')
                                ->where('order_details.product_merchant_id', \Auth::user()->id)
                                ->whereMonth('order_head.date',$tomonth)
                                ->select('order_head.id')
                                ->count();

        $total_order=OrderHead::join('order_details','order_details.order_head_id','=','order_head.id')
                                ->where('order_details.product_merchant_id', \Auth::user()->id)
                                ->select('order_head.id')
                                ->count();

        return view('Merchant::merchantorder.index', [
            'pageTitle' => $pageTitle,
            'data' => $data,
            'orderdata' => $orderdata,
            'footer_manu' => $footer_manu,
            'varifaid_user' => $varifaid_user,
            'todays_order' => $todays_order,
            'last_15_days_order' => $last_15_days_order,
            'current_month_order' => $current_month_order,
            'total_order' => $total_order,
        ]);
    }

    public function current_month_order()
    {
        $pageTitle = "Merchant Order List";
        $data = \Auth::user();
        $todate=date('Y-m-d');
        $toyear = date("Y", strtotime($todate)); 
        $tomonth = date("m");
        $form_date=date('Y-m-d', strtotime('-15 days'));

        $varifaid_user =User::join('merchant_profiles','users.id','=','merchant_profiles.users_id')->where('users.id',$data->id)->select('users.email','users.merchant_agreement', 'users.id','merchant_profiles.shop_name')->first();

        $orderdata = OrderHead::join('order_details','order_details.order_head_id','=','order_head.id')
                ->where('order_details.product_merchant_id',\Auth::user()->id)
                ->whereMonth('order_head.date',$tomonth)
                ->select('order_head.*','order_details.product_merchant_id', DB::raw('sum(order_details.total_price) as total_price'))
                ->groupBy('order_head.id')
                ->orderBy('order_head.id', 'desc')
                ->paginate(30);
        

        $footer_manu=DB::table('menu')->where('menu.position','footer-1')->where('menu.status','active')->orderBy('menu.short_order','asc')->get();

        $todays_order=OrderHead::join('order_details','order_details.order_head_id','=','order_head.id')
                                ->where('order_details.product_merchant_id',\Auth::user()->id)
                                ->whereDate('order_head.date', '>=', date('Y-m-d'))
                                ->select('order_head.id')
                                ->count();


        $last_15_days_order=OrderHead::join('order_details','order_details.order_head_id','=','order_head.id')
                            ->where('order_details.product_merchant_id', \Auth::user()->id)
                            ->whereBetween('order_head.date', [$form_date,$todate])
                            ->select('order_head.id')
                            ->count();

        $current_month_order=OrderHead::join('order_details','order_details.order_head_id','=','order_head.id')
                                ->where('order_details.product_merchant_id', \Auth::user()->id)
                                ->whereMonth('order_head.date',$tomonth)
                                ->select('order_head.id')
                                ->count();

        $total_order=OrderHead::join('order_details','order_details.order_head_id','=','order_head.id')
                                ->where('order_details.product_merchant_id', \Auth::user()->id)
                                ->select('order_head.id')
                                ->count();

        return view('Merchant::merchantorder.index', [
            'pageTitle' => $pageTitle,
            'data' => $data,
            'orderdata' => $orderdata,
            'footer_manu' => $footer_manu,
            'varifaid_user' => $varifaid_user,
            'todays_order' => $todays_order,
            'last_15_days_order' => $last_15_days_order,
            'current_month_order' => $current_month_order,
            'total_order' => $total_order,
        ]);
    }
    
  public function total_order()
    {
        $pageTitle = "Merchant Order List";
        $data = \Auth::user();
        $todate=date('Y-m-d');
        $toyear = date("Y", strtotime($todate)); 
        $tomonth = date("m");
        $form_date=date('Y-m-d', strtotime('-15 days'));

        $varifaid_user =User::join('merchant_profiles','users.id','=','merchant_profiles.users_id')->where('users.id',$data->id)->select('users.email','users.merchant_agreement', 'users.id','merchant_profiles.shop_name')->first();

        $orderdata = OrderHead::join('order_details','order_details.order_head_id','=','order_head.id')
                ->where('order_details.product_merchant_id',\Auth::user()->id)
                ->select('order_head.*','order_details.product_merchant_id', DB::raw('sum(order_details.total_price) as total_price'))
                ->groupBy('order_head.id')
                ->orderBy('order_head.id', 'desc')
              ->paginate(30);
        

        $footer_manu=DB::table('menu')->where('menu.position','footer-1')->where('menu.status','active')->orderBy('menu.short_order','asc')->get();

        $todays_order=OrderHead::join('order_details','order_details.order_head_id','=','order_head.id')
                                ->where('order_details.product_merchant_id',\Auth::user()->id)
                                ->whereDate('order_head.date', '>=', date('Y-m-d'))
                                ->select('order_head.id')
                                ->count();


        $last_15_days_order=OrderHead::join('order_details','order_details.order_head_id','=','order_head.id')
                            ->where('order_details.product_merchant_id', \Auth::user()->id)
                            ->whereBetween('order_head.date', [$form_date,$todate])
                            ->select('order_head.id')
                            ->count();

        $current_month_order=OrderHead::join('order_details','order_details.order_head_id','=','order_head.id')
                                ->where('order_details.product_merchant_id', \Auth::user()->id)
                                ->whereMonth('order_head.date',$tomonth)
                                ->select('order_head.id')
                                ->count();

        $total_order=OrderHead::join('order_details','order_details.order_head_id','=','order_head.id')
                                ->where('order_details.product_merchant_id', \Auth::user()->id)
                                ->select('order_head.id')
                                ->count();

        return view('Merchant::merchantorder.index', [
            'pageTitle' => $pageTitle,
            'data' => $data,
            'orderdata' => $orderdata,
            'footer_manu' => $footer_manu,
            'varifaid_user' => $varifaid_user,
            'todays_order' => $todays_order,
            'last_15_days_order' => $last_15_days_order,
            'current_month_order' => $current_month_order,
            'total_order' => $total_order,
        ]);
    }


    public function show($id)
    {
        $data = \Auth::user();

        $varifaid_user =User::join('merchant_profiles','users.id','=','merchant_profiles.users_id')->where('users.id',$data->id)->select('users.email','users.merchant_agreement', 'users.id','merchant_profiles.shop_name')->first();

        $orderdata = OrderHead::with('relOrderDetail', 'relOrderShipping')->where('order_head.id', $id)->first();

        $pageTitle = 'Invoice Number :: ' .$orderdata->order_number;

        $billing = OrderShipping::where('order_head_id', $data->id)->where('type', 'billing')->first();
        $shipping = OrderShipping::where('order_head_id', $data->id)->where('type', 'shipping')->first();

        
        $footer_manu=DB::table('menu')->where('menu.position','footer-1')->where('menu.status','active')->orderBy('menu.short_order','asc')->get();

        return view('Merchant::merchantorder.show', ['data' => $data,
            'pageTitle' => $pageTitle,
            'billing' => $billing,
            'shipping' => $shipping,
            'varifaid_user' => $varifaid_user,
            'orderdata' => $orderdata,
            'footer_manu' => $footer_manu,
        ]);
    }


    public function change_order_status(Requests\ChangeOrderStatusRequest $request)
    {

        $response = [];
        $response['result'] = 'error';

        $input = $request->all();

        $order_status = $input['order_status'];
        $order_id = $input['order_id'];

        /* Transaction Start Here */
        DB::beginTransaction();
        try {

            if($order_status == 'pending')
            {  
                // Set new status
                $new_status = 'confirmed';

                // Inventory deduction
                $search_details=DB::table('order_details')
                ->where('order_details.order_head_id', $order_id)->get();
                
                foreach ($search_details as  $order) {
                    
                    $product_inventory = ProductInventory::where('product_id',$order->product_id)->first();

                    if(!empty($product_inventory->quantity) && $product_inventory->quantity != 0){
                        // Reduce inventory 
                        $current_stock=$product_inventory->quantity-$order->quantity;

                        $product_inventory->quantity = $current_stock;

                        $product_inventory->save();
                    }
                }
            }elseif ($order_status == 'confirmed') {
                $new_status = 'shipped';
            }elseif ($order_status == 'shipped') {
                $new_status = 'delivered';
            }else{
                $new_status = 'cancel';
            }
            
            $data = OrderHead::where('order_head.id', $order_id)->first();
            $data->status = $new_status;
            $data->save();

            Session::flash('message', 'Status successfully changed ' . $order_status . ' to '.$new_status );

            DB::commit();

        } catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            Session::flash('danger', $e->getMessage());
        }   

        

        return json_encode($response);
    }

    public function change_order_refund(Requests\ChangeOrderRefundRequest $request)
    {

        // Get all request
        $input = $request->all();

        $order_status = $input['order_status'];
        $order_id = $input['order_id'];
        $note_data = $input['note'];

        /* Transaction Start Here */
        DB::beginTransaction();
        try {

            if ($order_status) {
                $new_status = 'cancel';

                // Inventory Update
                $search_details=DB::table('order_details')
                ->where('order_details.order_head_id', $order_id)->get();

                foreach ($search_details as  $order) {
                   
                    $product_inventory = ProductInventory::where('product_id',$order->product_id)->first();

                    if(!empty($product_inventory)){

                        $current_stock=$order->quantity+$product_inventory->quantity;

                        $product_inventory->quantity = $current_stock;

                        $product_inventory->save();
                       
                    }
                }

            }

            $data = OrderHead::where('order_head.id', $order_id)->first();
            $data->status = $new_status;
            $data->note = $note_data;
            $data->save();

            Session::flash('message', 'Status successfully changed ' . $order_status . ' to '.$new_status );

            DB::commit();

        } catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            Session::flash('danger', $e->getMessage());
        }

        
        return redirect()->back();
    }


    public function search_order()
    {

        $pageTitle = 'Searching Order Lists';

        $model = OrderHead::with('relOrderDetail');

        if ($this->isGetRequest()) {
            $order_no = Input::get('order_no');
            $status = Input::get('status');
            $date_range = Input::get('date_range');
            $from_date = Input::get('from_date');
            $to_date = Input::get('to_date');

            if ($order_no != '') {
                $model = $model->where('order_number', 'LIKE', '%' . $order_no . '%');
            }
            if ($status != '') {
                $model = $model->where('status', $status);
            }
            if ($from_date != '' && $to_date != '') {
                $model = $model->where('date', '>=', $from_date);
                $model = $model->where('date', '<=', $to_date);
            }

            $data = $model->orderBy('id', 'desc')
                                ->paginate(30);

        } else {
            $data = OrderHead::with('relOrderDetail')->paginate(30);
        }

        $footer_manu=DB::table('menu')->where('menu.position','footer-1')->where('menu.status','active')->orderBy('menu.short_order','asc')->get();

        return view('Order::order.index', [
            'pageTitle' => $pageTitle,
            'data' => $data,
            'footer_manu' => $footer_manu,
        ]);

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

        $model = OrderHead::where('id',$id)
                ->first();

        DB::beginTransaction();
        try {

            $model->status = 'cancel';

            if($model->save())
            {

            }

            DB::commit();
            Session::flash('message', "Order Canceled.");

        } catch(\Exception $e) {
            DB::rollback();
            Session::flash('danger',$e->getMessage());
        }
        
        // redirect to current page
        return redirect()->back();
    }

}
