<?php

namespace App\Modules\Order\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Helpers\CourierService;
use App\Modules\Order\Requests;
use App\Modules\Order\Models\OrderHead;
use App\Modules\Order\Models\OrderDetails;
use App\Modules\Order\Models\OrderShipping;
use App\Modules\Order\Models\OrderTransaction;
use App\Modules\Web\Models\Division;
use App\Modules\Product\Models\VwProduct;
use App\Modules\Product\Models\ProductInventory;
use App\User;
use DB;
use Session;
use Illuminate\Support\Facades\Input;
use Auth;
use Image;
use File;

class OrderController extends Controller
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
     * OrderController constructor.
     */
    public function __construct()
    {

    }

    public function order_index()
    {
        $pageTitle = "Current Order List";
        $data = OrderHead::orderBy('id', 'desc')->whereNotIn('status',['Cancel',''])->paginate(30);

        $merchant_list=[''=>'Select Merchant']+User::join('merchant_profiles','users.id','=','merchant_profiles.users_id')
                ->where('users.type','seller')->pluck('merchant_profiles.shop_name','users.id')->all();

        
        return view('Order::order.index', [
            'pageTitle' => $pageTitle,
            'data' => $data,
            'merchant_list' => $merchant_list,

        ]);
    }



    public function show($id)
    {

        $data = OrderHead::with('relOrderDetail', 'relOrderShipping')->where('order_head.id', $id)->first();

        $pageTitle = 'Invoice Number :: ' . $data->order_number;

        $billing = OrderShipping::where('order_head_id', $data->id)->where('type', 'billing')->first();
        $shipping = OrderShipping::where('order_head_id', $data->id)->where('type', 'shipping')->first();

        return view('Order::order.show', ['data' => $data,
            'pageTitle' => $pageTitle,
            'billing' => $billing,
            'shipping' => $shipping
        ]);
    }


   public function change_order_status(Requests\ChangeOrderStatusRequest $request)
    {
        $input = $request->all();
        $order_status = $input['order_status'];
        $order_id = $input['order_id'];

        //order tracking mail system intregration
            $customer_email = '';
            $find_customer_billing_email=OrderHead::where('order_head.id',$order_id)
                ->select('order_head.*')
                ->first();

                if(isset($find_customer_billing_email->relOrderShipping)){
                    foreach($find_customer_billing_email->relOrderShipping as $bill_data){

                      if($bill_data->type == 'billing'){

                        $customer_email.=$bill_data['email'];
                    }
                }
            }
        /* Transaction Start Here */
        DB::beginTransaction();
        try {

            if($order_status == 'confirmed')
            {
                // Set new status
                $new_status = 'processing';
                // Inventory deduction
                $search_details=DB::table('order_details')->where('order_details.order_head_id', $order_id)->get();

                foreach ($search_details as  $order) {
                    $product_inventory = ProductInventory::where('product_id',$order->product_id)->first();

                    if(!empty($product_inventory->quantity) && $product_inventory->quantity != 0){
                        // Reduce inventory
                        $current_stock=$product_inventory->quantity-$order->quantity;
                        $product_inventory->quantity = $current_stock;
                        $product_inventory->save();
                    }
                    // comission setting
                    /*$comissions_setting=DB::table('comissions_setting')->where('comissions_setting.merchant_id',$order->product_merchant_id)->first();

                    if (!empty($comissions_setting->merchant_id) && $comissions_setting->comission_rate !=0 && $comissions_setting->comission_type != 'default') {

                        $comission_calculate=$order->total_price* $comissions_setting->comission_rate;
                        $total_comission=$comission_calculate/100;
                    }else{

                        $comission_calculate=$order->total_price* 2.00;
                        $total_comission=$comission_calculate/100;
                    }

                    $update_order_details=DB::table('order_details')
                    ->where('order_details.order_head_id', $order->order_head_id)
                    ->where('order_details.product_merchant_id', $order->product_merchant_id)
                    ->update(['order_details.comission_price' => $total_comission]);*/
                }


            }elseif ($order_status == 'processing') {
                $new_status = 'processing';
            }elseif ($order_status == 'on_transit') {
                $new_status = 'on_transit';
            }elseif ($order_status == 'delivered') {

                $new_status = 'delivered';
                //update user cashback data
                /*$cashback_total = 0;
                $order=OrderHead::where('order_head.id',$order_id)->first();
                if(isset($order->relOrderDetail)){
                    foreach($order->relOrderDetail as $details_data){
                        if(isset($details_data->cash_back)){
                            $details_cashback_sum=OrderDetails::where('order_head_id',$order_id)->sum('cash_back');
                        }
                    }
                    $cashback_total += $details_cashback_sum;
                }

                $customer_email='';
                if(isset($order->relOrderShipping)){
                    foreach($order->relOrderShipping as $bill_data){
                      if($bill_data->type == 'billing'){
                            $customer_email.=$bill_data['email'];
                        }
                    }
                }

                $user_data=DB::table('users')->where('id',$order->users_id)->first(['users.cash_back']);
                $user_total=0;

                if (isset($user_data->cash_back)) {
                    $user_total=0;
                    $user_total+=$user_data->cash_back;
                    $total=$cashback_total+$user_total;

                    if (isset($total)) {
                        $update_cashback=DB::table('users')->where('id',$order->users_id)->update(['users.cash_back' => $total]);
                    }
                }else{
                    $total=$cashback_total+$user_total;
                    if (isset($total)) {
                        $update_cashback=DB::table('users')->where('id',$order->users_id)->update(['users.cash_back' => $total]);
                    }
                }*/

            }elseif ($order_status == 'delivery_failed') {
                $new_status = 'delivery_failed';
            }elseif($order_status == 'cancel'){
                $new_status = 'cancel';

            }

            $data = OrderHead::with(['relOrderShipping','relOrderDetail.relProduct'=>function($query){
            }])->where('order_head.id', $order_id)->first();
            $data->status = $order_status;
            //order status change mail sending
            $data->save();

            if(!empty($customer_email))
            {
                if ($new_status=="cancel") {

                 $mail_body = \Illuminate\Support\Facades\View::make('Order::order.order_canceled_email', ['data'=> $data]);
                 $contents = $mail_body->render();
                 $send_mail = \App\Http\Helpers\SendMail::fire($customer_email, 'Order Canceled Information', $contents, '');

                }else{

                $mail_body = \Illuminate\Support\Facades\View::make('Order::order.order_tracking_email', ['data'=> $data]);
                $contents = $mail_body->render();
                $send_mail = \App\Http\Helpers\SendMail::fire($customer_email, 'Order Tracking Information', $contents, '');
                }
            }

            Session::flash('message', 'Successfully changed order status ' . $order_status .'.Send email to ' . $customer_email );
            DB::commit();

        } catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            Session::flash('danger', $e->getMessage());
        }
        return back();
    }


    public function order_cancel(Requests\ChangeOrderStatusRequest $request)
    {
        $response = [];
        $response['result'] = 'error';
        $input = $request->all();
        $order_status = $input['order_status'];
        $order_id = $input['order_id'];

        //order tracking mail system intregration
            $customer_email = '';
            $find_customer_billing_email=OrderHead::where('order_head.id',$order_id)
                ->select('order_head.*')
                ->first();

                if(isset($find_customer_billing_email->relOrderShipping)){
                    foreach($find_customer_billing_email->relOrderShipping as $bill_data){
                      if($bill_data->type == 'billing'){
                        $customer_email.=$bill_data['email'];
                    }

                }
            }

        //end mail system
        /* Transaction Start Here */
        DB::beginTransaction();
        try {

            if($order_status == 'pending')
            {
                // Set new status
                $new_status = 'cancel';
            }
            $data = OrderHead::with(['relOrderShipping','relOrderDetail.relProduct'=>function($query){

            }])->where('order_head.id', $order_id)->first();
            $data->status = $new_status;
            $data->save();
            
            if(!empty($customer_email))
            {
                $mail_body = \Illuminate\Support\Facades\View::make('Order::order.order_canceled_email', ['data'=> $data]);
                $contents = $mail_body->render();

                $send_mail = \App\Http\Helpers\SendMail::fire($customer_email, 'Order Canceled Information', $contents, '');
            }

            Session::flash('message', 'Status successfully changed ' . $order_status . ' to '.$new_status.' email send ' . $customer_email );
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

        //order tracking mail system intregration
            $customer_email = '';
            $find_customer_billing_email=OrderHead::where('order_head.id',$order_id)
                ->select('order_head.*')
                ->first();

                if(isset($find_customer_billing_email->relOrderShipping)){
                    foreach($find_customer_billing_email->relOrderShipping as $bill_data){

                      if($bill_data->type == 'billing'){
                        $customer_email.=$bill_data['email'];
                    }
                }
            }
        //end mail system
        /* Transaction Start Here */
        DB::beginTransaction();
        try {

            if ($order_status) {
                $new_status = 'cancel';

                // Inventory Update
                $search_details=OrderDetails::where('order_details.order_head_id', $order_id)->get();

                foreach ($search_details as  $order) {

                    $product_inventory = ProductInventory::where('product_id',$order->product_id)->first();
                    if(!empty($product_inventory)){
                        $current_stock=$order->quantity+$product_inventory->quantity;
                        $product_inventory->quantity = $current_stock;
                        $product_inventory->save();
                    }
                }

            }


            $data = OrderHead::with(['relOrderShipping','relOrderDetail.relProduct'=>function($query){

            }])->where('order_head.id', $order_id)->first();
            $data->status = $new_status;
            $data->note = $note_data;
            $data->save();
           
            if(!empty($customer_email))
            {
                $mail_body = \Illuminate\Support\Facades\View::make('Order::order.order_canceled_email', ['data'=> $data]);
                $contents = $mail_body->render();

                $send_mail = \App\Http\Helpers\SendMail::fire($customer_email, 'Order Canceled Information', $contents, '');
            }

            Session::flash('message', 'Status successfully changed ' . $order_status . ' to '.$new_status.' email send ' . $customer_email );

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

        $model = OrderHead::rightjoin('order_details','order_details.order_head_id','=','order_head.id');

        if ($this->isGetRequest()) {
            $order_no = Input::get('order_no');
            $status = Input::get('status');
            $payment_type = Input::get('payment_type');
            $date_range = Input::get('date_range');
            $from_date = Input::get('from_date');
            $to_date = Input::get('to_date');
            $merchant_id = Input::get('merchant_id');

            if ($order_no != '') {
                $model = $model->where('order_head.order_number', 'LIKE', '%' . $order_no . '%');
            }
            if ($status != '') {
                $model = $model->where('order_head.status', $status);
            }

            if ($payment_type != '') {
                $model = $model->where('order_head.payment_type', $payment_type);
            }

            if ($merchant_id != '') {
                $model = $model->where('order_details.product_merchant_id', $merchant_id);
            }

            if ($from_date != '' && $to_date != '') {
                $model = $model->where('order_head.date', '>=', $from_date);
                $model = $model->where('order_head.date', '<=', $to_date);
            }

            $data = $model->groupBy('order_head.id')->orderBy('order_head.id','desc')
                        ->get(['order_head.*',DB::raw('sum(order_details.total_price) as total_price')]);

        } else {
            $data = OrderHead::rightjoin('order_details','order_details.order_head_id','=','order_head.id')->groupBy('order_head.id')->paginate(30);
        }

        $merchant_list=[''=>'Select Merchant']+User::join('merchant_profiles','users.id','=','merchant_profiles.users_id')
                ->where('users.type','seller')->pluck('merchant_profiles.shop_name','users.id')->all();

        if ($merchant_id != '') {
                    return view('Order::order.merchant_index', [
                    'pageTitle' => $pageTitle,
                    'data' => $data,
                    'merchant_list' => $merchant_list,
                    'merchant_id' => $merchant_id,
                ]);
            }else{

                return view('Order::order.search_index', [
                    'pageTitle' => $pageTitle,
                    'data' => $data,
                    'merchant_list' => $merchant_list,
                ]);

            }
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

      /**
     * show merchant list for show merchant wise order list.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      public function merchant_index()
        {
            $pageTitle = "Merchant List";

            $data = User::join('merchant_profiles','users.id','=','merchant_profiles.users_id')
                    ->where('users.type','seller')->select('merchant_profiles.shop_name','users.id as users_id','users.first_name','users.last_name','users.mobile_no','users.email','users.status')->get();

            return view('Order::merchantwiseorder.index', [
                'pageTitle' => $pageTitle,
                'data' => $data
            ]);
        }


        public function search_merchant_order()
        {

            $pageTitle = 'Merchant Information';

            // User model initialize
            $model = User::join('merchant_profiles','users.id','=','merchant_profiles.users_id');


        if($this->isGetRequest())
        {
            // Search data found
            $search_keywords = trim(Input::get('search_keywords'));
            $model = $model->where(function ($query) use($search_keywords){
                    $query = $query->orWhere('users.email', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('users.status', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('users.first_name', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('users.last_name', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('users.type', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('merchant_profiles.shop_name', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('users.mobile_no', 'LIKE', '%'.$search_keywords.'%');
                });
            $data = $model->select('merchant_profiles.shop_name','users.id as users_id','users.first_name','users.last_name','users.mobile_no','users.email','users.status')->paginate(30);
        }else{

            // If get data not found
            $data = User::join('merchant_profiles','users.id','=','merchant_profiles.users_id')
                    ->where('users.type','seller')
                    ->select('merchant_profiles.shop_name','users.id as users_id','users.first_name','users.last_name','users.mobile_no','users.email','users.status')
                    ->paginate(30);
        }

        // Return view
        return view("Order::merchantwiseorder.index", compact('data','pageTitle'));


        }

        public function merchat_wise_order_index($id)
        {
             $pageTitle = "Current Order List";

             $data = OrderHead::rightjoin('order_details','order_details.order_head_id','=','order_head.id')
                ->where('order_details.product_merchant_id',$id)
                ->orderBy('order_head.id', 'desc')
                ->select('order_head.*',DB::raw('sum(order_details.total_price) as total_price'))
                ->groupBy('order_head.id')
                ->get();

             $merchant_list=[''=>'Select Merchant']+User::join('merchant_profiles','users.id','=','merchant_profiles.users_id')
                ->where('users.type','seller')->pluck('merchant_profiles.shop_name','users.id')->all();

             return view('Order::order.merchant_index', [
                'pageTitle' => $pageTitle,
                'data' => $data,
                'merchant_list' => $merchant_list,
                'merchant_id' => $id,
            ]);
        }

        public function pending_order()
        {
            $pageTitle = "Pending Order List";
            $data = OrderHead::where('status','pending')->orderBy('id', 'desc')->paginate(30);

            $merchant_list=[''=>'Select Merchant']+User::join('merchant_profiles','users.id','=','merchant_profiles.users_id')
            ->where('users.type','seller')->pluck('merchant_profiles.shop_name','users.id')->all();

            return view('Order::order.index', [
                'pageTitle' => $pageTitle,
                'data' => $data,
                'merchant_list' => $merchant_list,

            ]);
        }

        public function select_courier(Request $request)
        {
            $input=$request->all();
            $order_id = $input['order_head_id'];

            // Check order exists
            $data = OrderHead::where('id',$order_id)->first();

            if(!empty($data)){

                // Check Shipping
                $order_shipping = OrderShipping::where('order_head_id',$data->id)->where('type','shipping')->first();

                $name = $order_shipping->first_name . ' '.$order_shipping->last_name;

                $payment_method = 'COD';

                if($data->payment_type == 'cod'){
                    $payment_method = 'COD';
                }else{
                    $payment_method = 'CCRD';
                }

                // Prepare data
                $data_array =  array(
                    'parcel' => 'insert',
                    'recipient_name' => $name,
                    'recipient_mobile' => $order_shipping->phone,
                    'recipient_city' => $order_shipping->city,
                    'recipient_area' => $order_shipping->area,
                    'recipient_address' => $order_shipping->address,
                    'package_code' => $data->courier_package,
                    'product_price' => $data->total_price,
                    'payment_method' => $payment_method

                );

                // Call API
                $make_courier_call = CourierService::callAPI('POST', 'http://ecourier.com.bd/apiv2/',$data_array);

                $response = json_decode($make_courier_call, true);

                if($response['response_code'] == '200'){

                    // courier response sucess

                    $courier_id = $response['ID'];

                    $data->courier_id = $courier_id;
                    $data->courier_name = $input['courier'];

                    $data->save();

                }else{

                    // courier response errors

                    $data->courier_message = json_encode($response['errors']);
                    $data->save();

                }



            }

            return back();
        }

        public function edit_billing_address($id)
        {
            $response = [];

            $billing_shipping_data =DB::table('order_shipping')->where('type','shipping')->where('id',$id)->first();


            if(!empty($billing_shipping_data))
            {

                $citylist=[''=>'Select City']+Division::where('type','district')->orderby('parent_id','ASC')->pluck('name','id')->all();

                $arealist=[''=>'Select Area']+Division::where('type','thana')->pluck('name','name')->all();

                //call city api
                $view = \Illuminate\Support\Facades\View::make('Order::order.edit_billing_shipping_info',compact('billing_shipping_data','pageTitle','citylist','arealist'));

                $contents = $view->render();

                $response['result'] = 'success';
                $response['content'] = $contents;

            }else{

                $response['result'] = 'error';

            }

            return $response;

        }

        public function update_billing_shipping_address(Request $request, $id)
        {

            $input = $request->all();
            ///dd($input);
            $pageTitle = "Update Billing OR Shipping Address";

            $billing_shipping_data =OrderShipping::where('type','shipping')->where('id',$id)->first();


            DB::beginTransaction();
            try {
            // Update
                $billing_shipping_data->update($request->all());
                DB::commit();

                Session::flash('message', 'Successfully updated!');
                return back();
            }
            catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
                DB::rollback();
                Session::flash('danger', $e->getMessage());
            }

            return back();
        }

        public function citytoarea(Request $request)
        {

            $response = [];
            $response['data']='';
            $city_name = $_POST['city_name'];

            $arealist=DB::table('division_district_thana_rel')
            ->where('parent_id', $city_name)
            ->where('type','thana')
            ->orderby('parent_id','ASC')
            ->get(['id','name']);

            $response['data'] .="<option value='0'>----Select Area----</option>";

            if(!empty($arealist)){
                foreach($arealist as $data){
                    $response['data'] .= '<option value="' . $data->name . '">' . $data->name . '</option>';
                }
            }

            $response['result'] = 'success';
            return $response;
        }

        public function medicineIndex(Request $request)
        {
            $pageTitle = "Medicine Order List";

            $data = User::join('user_prescription','user_prescription.user_id','=','users.id')->where('users.type','customer')->where('users.status','active')->groupBy('users.id')->select(array('users.*', DB::raw('COUNT(user_prescription.user_id) as prescriptions')))->orderby('prescriptions','desc')->get();

            return view('Order::medicine.index', [
                'pageTitle' => $pageTitle,
                'data' => $data,
            ]);
        }

         public function medicineview(Request $request,$id)
        {
            $pageTitle = "Current Order List";

            $data = DB::table('user_prescription')->where('user_id',$id)->paginate(30);

            return view('Order::medicine.show', [
                'pageTitle' => $pageTitle,
                'data' => $data,
            ]);
        }

}
