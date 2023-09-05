<?php

namespace App\Modules\Order\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Product\Models\Product;
use App\Modules\Product\Models\VwProduct;
use App\Modules\Product\Models\ProductAttribute;
use App\Modules\User\Models\UserBillingShipping;
use App\Modules\Order\Models\OrderShipping;
use App\Modules\Order\Models\OrderDetails;
use App\Modules\Order\Models\OrderHead;
use App\Modules\Web\Models\Division;
use App\Http\Helpers\CourierService;
use App\Http\Helpers\CartHelper;
use App\Modules\Order\Requests;
use Auth;
use DB;
use Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;
use Image;
use File;
use Storage;
use App\User;
use Redirect;

class NewOrderController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
     * @return array
     */


    public function index()
    {
        $pageTitle = "List of Product Information";

    
        // return view
       return view("Order::newOrder.index", compact('pageTitle'));
    }

    /**
     * Show the form for search a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function search_product_for_order($query)
    {

        $product_data = VwProduct::where(function($query_data) use($query) {
                return $query_data->where('product_title', 'like', '%'.$query.'%')
                    ->orWhere('item_no', 'like', '%'.$query.'%');
            })->get();
       
        $data = [];

        if(!empty($product_data)){
            foreach($product_data as $product){
                array_push($data, ['id'=>$product->product_id,'title'=>$product->product_title,'item_no'=>$product->item_no,
                    'image'=> '<img src="'.url('').'/uploads/'.$product->product_id.'">'
                ]);
            }
        }

        return json_encode($data);
    }


     public function add_items(Request $request)
    {
        
        $input = $request->all();

        $added_items = [];

        $cart = [];
        if(isset($input['product_quantity'])){

            $product_quantity = $input['product_quantity'];
            
            $product_id = $input['product_id'];
            $product_merchant_id = $input['product_merchant_id'];
            // product id checking for color & size
            $explode_product_id = explode("==",$product_id);

            if(isset($explode_product_id['1']) && !empty($explode_product_id['1'])){

                $color_list = explode("--", $explode_product_id['0']);
                $size_list = explode("--", $explode_product_id['1']);
                $product_id = array_values(array_intersect($color_list, $size_list));
                $product_id = $product_id['0'];
            }

            $product_image = $request->product_image;

            $product = VwProduct::where('product_id',$product_id)->first();

            if(!empty($product))
            {
                $item['product_id'] = $product_id;
                $item['product_title'] = $product->product_title;
                #$item['pro_title_bn'] = $product->pro_title_bn;
                $item['product_slug'] = $product->product_slug;
                $item['sell_price'] = $product->sell_price;
                $item['product_item_no'] = $product->item_no;
                $item['product_image'] = $product_image;
                $item['image_link'] = $product->image;
                $item['product_quantity'] = $product_quantity;
                $item['product_merchant_id'] = $product->product_merchant_id;
                $item['product_weight'] = $product->weight;
                $item['product_category_id'] = $product->product_category_id;



                /*$discount_set = CartHelper::exclude_discount();
                
                if(!in_array($input['product_category_id'], $discount_set['category_list'])){
                    
                    $item['product_discount'] = ($product->sell_price * $discount_set['percentage'])/100;
                    
                }else{
                    $item['product_discount'] = 0;
                }*/

                $cart = CartHelper::admin_add_item($item);
                //$cart = CartHelper::add_item($item);
                
                Session::put('product_category_id',$item['product_category_id']);
                
            }

            $response = [];

            if(Session::has('admin_cart')){
                $cart_total = number_format(Session::get('admin_cart_total')['total'], 2);
            }else{
                $cart_total = number_format(0,2);
            }

            if(count($cart) > 0)
            {
                $response['result'] = 'success';
                $response['message'] = 'Product successfully added to cart.';
                $response['total_item'] = 'Cart ('.count($cart).')';
                $response['cart_total'] = $cart_total . ' Tk'; 
            }else{
                $response['result'] = 'error';
                $response['message'] = 'Product not added to cart.';
            }
            
            return $response;

        }
    }


    public function search(Request $request)
    {

        
        $pageTitle = 'Product Information';

        // Product model initialize
        $model = new Product();

        if($this->isGetRequest())
        {
            // Search data found
            $item_no = trim(Input::get('item_no'));
            $model = $model->where(function ($query) use($item_no){
                    $query = $query->orWhere('item_no', 'LIKE', '%'.$item_no.'%');
                });

            $data = $model->select('product.*')->orderBy('id','desc')->first();

            if ($data!="") {
               
                $product_data = VwProduct::where('item_no',$item_no)->first();

                // Product attribute
                $product_attribute_data = ProductAttribute::where('product_id',$product_data->product_id)->get();

                // Get size & color
                $product_color_size = ProductAttribute::find_product_color_size($product_attribute_data,$product_data);
            }else{
                return back();
            }


        }

        $cart_items = [];
        $total_weight = [];

        if(Session::has('admin_cart')){
            $cart_items = Session::get('admin_cart');
            $total_weight=0;

            foreach ($cart_items as $key => $value) { 
                
                $total_weight += $value['product_weight'];
            }
        }

        $cart_total = [];
        if(Session::has('admin_cart_total')){
            $cart_total = Session::get('admin_cart_total');
        }

         ///dd($cart_items);

        $user_data = \Auth::user();



        if(!isset($user_data))
        {
            $user_data = new User();
        }

        // UserBillingShipping object creation
        $billing = new UserBillingShipping();
        $shipping = new UserBillingShipping();

        if(isset($user_data)){

            $billing = UserBillingShipping::where('users_id',$user_data->id)->where('type','billing')->first();
            $shipping = UserBillingShipping::join('division_district_thana_rel','users_billing_shipping.city','=','division_district_thana_rel.id')->where('users_id',$user_data->id)->where('users_billing_shipping.type','shipping')->orderBy('users_billing_shipping.id','asc')->get(['users_billing_shipping.*','division_district_thana_rel.name as city']);

        } 

        $citylist=[''=>'Select City']+Division::where('type','district')->orderby('parent_id','ASC')->pluck('name','id')->all();

        $arealist=[''=>'Select Area']+Division::where('type','thana')->pluck('name','name')->all();
        
        $shipping_charge = 60;

        // Return view
        return view("Order::newOrder.searchindex", compact('data','pageTitle','product_color_size','product_data','cart_items','cart_total','billing','shipping','user_data','citylist','shipping_charge'));
        

    }

    public function citytoarea(Request $request)
    {

        $response = [];

        $response['data']='';
       
        $city_name = $_POST['city_name'];

         $model=DB::table('division_district_thana_rel')
         ->where('parent_id', $city_name)
         ->where('type','thana')
         ->orderby('parent_id','ASC')
         ->get(['id','name']);
        
        $response['data'] .= "<option value=''>--Select Area--</option>";
        if (!empty($model)) {
            foreach ($model as $data) {
                $response['data'] .= '<option value="' . $data->name . '">' . $data->name . '</option>';
            }
        }

        $response['result'] = 'success';
        return $response;
    }

    public function customer_search(Request $request)
    {
        $pageTitle = 'Customer check';

        
        // Product model initialize
        $user_model = new User();

        if($this->isGetRequest())
        {
            // Search data found
            $searchinput = trim(Input::get('searchinput'));
            $user_model = $user_model->where('users.type','customer')->where(function ($query) use($searchinput){
                    $query = $query->orWhere('email', 'LIKE', '%'.$searchinput.'%');
                    $query = $query->orWhere('mobile_no', 'LIKE', '%'.$searchinput.'%');
                });

            $user_data = $user_model->select('users.*')->orderBy('id','desc')->first();

            if(!isset($user_data))
            {   

                return redirect()->back();
            }

        // UserBillingShipping object creation
            $billing = new UserBillingShipping();
            $shipping = new UserBillingShipping();

            if(isset($user_data)){

                $billing = UserBillingShipping::where('users_id',$user_data->id)->where('type','billing')->first();
                $shipping = UserBillingShipping::join('division_district_thana_rel','users_billing_shipping.city','=','division_district_thana_rel.id')->where('users_id',$user_data->id)->where('users_billing_shipping.type','shipping')->orderBy('users_billing_shipping.id','asc')->get(['users_billing_shipping.*','division_district_thana_rel.name as city']);

            }   

        }else{

           return redirect()->back();
        }


         $cart_items = [];
        $total_weight = [];

        if(Session::has('admin_cart')){
            $cart_items = Session::get('admin_cart');
            $total_weight=0;

            foreach ($cart_items as $key => $value) { 
                
                $total_weight += $value['product_weight'];
            }
        }

        $cart_total = [];
        if(Session::has('admin_cart_total')){
            $cart_total = Session::get('admin_cart_total');
        }

         ///dd($cart_items);



        if(!isset($user_data))
        {
            $user_data = new User();
        }

        // UserBillingShipping object creation
        $billing = new UserBillingShipping();
        $shipping = new UserBillingShipping();

        if(isset($user_data)){

            $billing = UserBillingShipping::where('users_id',$user_data->id)->where('type','billing')->first();
            $shipping = UserBillingShipping::join('division_district_thana_rel','users_billing_shipping.city','=','division_district_thana_rel.id')->where('users_id',$user_data->id)->where('users_billing_shipping.type','shipping')->orderBy('users_billing_shipping.id','asc')->get(['users_billing_shipping.*','division_district_thana_rel.name as city']);

        } 

        $citylist=[''=>'Select City']+Division::where('type','district')->orderby('parent_id','ASC')->pluck('name','id')->all();

        $arealist=[''=>'Select Area']+Division::where('type','thana')->pluck('name','name')->all();
        
        $shipping_charge = 60;

         // Return view
        return view("Order::newOrder.billing_shipping", compact('pageTitle','user_data','billing','shipping','cart_items','cart_total','citylist','shipping_charge'));

    }

    public function  remove_item(){
        $product_id = $_POST['product_id'];

        $cart = CartHelper::admin_remove_item($product_id);

        $response = [];
        $response['result'] = 'success';
        $response['message'] = 'Product successfully removed from cart.';
        return $response;
    }
    

    public function cart_update()
    {
        $items = $_POST['data'];

        $cart = CartHelper::admin_update($items);

        $response = [];
        $response['result'] = 'success';
        $response['message'] = 'Product successfully removed from cart.';
        
        return $response;

    }



    public function guest_confirm_checkout(Requests\AdminCheckoutRequest $request)
    {
        $input = $request->all();

        $billing_model = new OrderShipping();
        $billing_model->type = 'billing';
        $billing_model->first_name = $input['first_name'];
        
        $billing_model->email = $input['email'];
        $billing_model->address = $input['address'];
        $billing_model->phone = $input['phone'];

        if(isset($input['shipping_same_as_billing']) && $input['shipping_same_as_billing'] == 'on'){

            $shipping_id = $input['shipping_value'];

            $shipping_data = DB::table('users_billing_shipping')->where('id',$shipping_id)->first();

            if(isset($shipping_data))
            {
                $shipping_model = new OrderShipping();
                $shipping_model->type = 'shipping';
                $shipping_model->first_name = $shipping_data->first_name;
                
                $shipping_model->email = $shipping_data->email;
                $shipping_model->address = $shipping_data->address;
                $shipping_model->phone = $shipping_data->phone;
                $shipping_model->city = $shipping_data->city;
                $shipping_model->area = $shipping_data->area;
            }else{
                $shipping_model = new OrderShipping();
                $shipping_model->type = 'shipping';
                $shipping_model->first_name = $input['first_name'];
                
                $shipping_model->email = $input['email'];
                $shipping_model->address = $input['address'];
                $shipping_model->phone = $input['phone'];
                $shipping_model->city = $input['city'];
                $shipping_model->area = $input['area'];
            }
            
        }else{

            $shipping_model = new OrderShipping();
            $shipping_model->type = 'shipping';
            $shipping_model->first_name = $input['first_name'];
            
            $shipping_model->email = $input['email'];
            $shipping_model->address = $input['address'];
            $shipping_model->phone = $input['phone'];
        }

        if(isset($input['shipping_defferent_address'])){
           $shipping_model = new OrderShipping();
           $shipping_model->type = 'shipping';
           $shipping_model->first_name = $input['shipping_first_name'];
           
           $shipping_model->email = $input['shipping_email'];
           $shipping_model->address = $input['shipping_address'];
           $shipping_model->phone = $input['shipping_phone'];
           $shipping_model->city = $input['city'];
           $shipping_model->area = $input['area'];
        }

        
        $cart_total_price = 0;

        $users_id = null;
        $user_data = \Auth::user();
        if(isset($user_data) && $user_data->type == 'customer'){
            $users_id = $user_data->id;
        }

        $items = [];

        $cart_items = [];
        if(Session::has('admin_cart')){
            $cart_items = Session::get('admin_cart');
        }

        if(count($cart_items) > 0){
            foreach ($cart_items as $item){
                $product_item = new OrderDetails();
                $product_item->order_head_id = 0;
                $product_item->price = $item['sell_price'];
                $product_item->product_id = $item['product_id'];
                $product_item->product_merchant_id = $item['product_merchant_id'];
                $product_item->status = 'active';
                $product_item->quantity = $item['product_quantity'];
                $product_item->total_price = $item['sell_price']*$item['product_quantity'];
                $product_item->cash_back = '';

                $cart_total_price += $item['sell_price']*$item['product_quantity'];
                array_push($items,$product_item);
            }
        }
        $subtotal = $cart_total_price;

        $coupon_amount = 0;
            if(Session::has('coupon_amount')){
              $coupon_amount = Session::get('coupon_amount');
          }

          $coupon_code = '';
          if(Session::has('coupon_code')){
              $coupon_code = Session::get('coupon_code');
          }


        $order_head = new OrderHead();
        $order_head->users_id = $users_id;
        $order_head->order_number = time();
        $order_head->date = date('Y-m-d');

        $order_head->sub_total_price = $subtotal;
        $order_head->total_price = $cart_total_price;
        $order_head->shipping_value = $input['gen_delivery_cost'];
        $order_head->shipping_method = 'self';
        $order_head->courier_package ='';
        $order_head->payment_type = $_POST['payment_method'];
        $order_head->coupon_code = $coupon_code;
        $order_head->coupon_code_value = $coupon_amount;
        $order_head->status = 'pending';



        /* Transaction Start Here */
        DB::beginTransaction();
        try {
            if($order_data = $order_head->save())
            {

                $order_head->order_number = 'dbazar-'.str_replace('-','',date('Y-m-d')).'-'.str_pad($order_head->id,6,"0",STR_PAD_LEFT);
                $order_head->save();

                $billing_model->order_head_id = $order_head->id;
                $billing_model->save();

                $shipping_model->order_head_id = $order_head->id;
                $shipping_model->save();

                if(count($items) > 0){
                    foreach ($items as $item){
                        $item->order_head_id = $order_head->id;
                        $item->save();
                    }
                }
                
                DB::commit();

                // Session Remove
                Session::forget('admin_cart');
                Session::forget('admin_cart_total');
                Session::forget('coupon_code');
                Session::forget('coupon_amount');

                Session::flash('message', 'Order Confriam successfully');

                return Redirect::route('admin.order.show',['order_id'=>$order_head->id]);
                
            }
            

        } catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            
            echo '<pre>';
            print_r($e->getMessage());
            exit();
            $error_info = [''];

            return redirect()->route('admin.cart.checkout.fail')->with('additional_data',$error_info);

        }

        return redirect()->back();

    } 

    public function exist_confirm_checkout(Requests\AdminCheckoutRequest $request)
    {
        $input = $request->all();

        $billing_model = new OrderShipping();
        $billing_model->type = 'billing';
        $billing_model->first_name = $input['first_name'];
        
        $billing_model->email = $input['email'];
        $billing_model->address = $input['address'];
        $billing_model->phone = $input['phone'];

        

        $shipping_id = $input['shipping_value'];

        $shipping_data = DB::table('users_billing_shipping')->where('id',$shipping_id)->first();

        if(isset($shipping_data))
        {
            $shipping_model = new OrderShipping();
            $shipping_model->type = 'shipping';
            $shipping_model->first_name = $shipping_data->first_name;

            $shipping_model->email = $shipping_data->email;
            $shipping_model->address = $shipping_data->address;
            $shipping_model->phone = $shipping_data->phone;
            $shipping_model->city = $shipping_data->city;
            $shipping_model->area = $shipping_data->area;
        }else{
            $shipping_model = new OrderShipping();
            $shipping_model->type = 'shipping';
            $shipping_model->first_name = $input['first_name'];

            $shipping_model->email = $input['email'];
            $shipping_model->address = $input['address'];
            $shipping_model->phone = $input['phone'];
            $shipping_model->city = $input['city'];
            $shipping_model->area = $input['area'];
        }

     

        

        
        $cart_total_price = 0;

        $users_id = null;
        $user_data = DB::table('users')->where('id',$request->user_search_id)->first();
        if(isset($user_data) && $user_data->type == 'customer'){
            $users_id = $user_data->id;
        }

        $items = [];

        $cart_items = [];
        if(Session::has('admin_cart')){
            $cart_items = Session::get('admin_cart');
        }

        if(count($cart_items) > 0){
            foreach ($cart_items as $item){
                $product_item = new OrderDetails();
                $product_item->order_head_id = 0;
                $product_item->price = $item['sell_price'];
                $product_item->product_id = $item['product_id'];
                $product_item->product_merchant_id = $item['product_merchant_id'];
                $product_item->status = 'active';
                $product_item->quantity = $item['product_quantity'];
                $product_item->total_price = $item['sell_price']*$item['product_quantity'];
                $product_item->cash_back = '';

                $cart_total_price += $item['sell_price']*$item['product_quantity'];
                array_push($items,$product_item);
            }
        }
        $subtotal = $cart_total_price;

         $coupon_amount = 0;
            if(Session::has('coupon_amount')){
              $coupon_amount = Session::get('coupon_amount');
          }

          $coupon_code = '';
          if(Session::has('coupon_code')){
              $coupon_code = Session::get('coupon_code');
          }


        $order_head = new OrderHead();
        $order_head->users_id = $users_id;
        $order_head->order_number = time();
        $order_head->date = date('Y-m-d');

        
        $order_head->sub_total_price = $subtotal;
        $order_head->total_price = $cart_total_price;
        $order_head->shipping_value = $input['gen_delivery_cost'];
        $order_head->shipping_method = 'self';
        $order_head->courier_package = '';
        $order_head->payment_type = $_POST['payment_method'];
        $order_head->coupon_code = $coupon_code;
        $order_head->coupon_code_value = $coupon_amount;
        $order_head->status = 'pending';



        /* Transaction Start Here */
        DB::beginTransaction();
        try {
            if($order_data = $order_head->save())
            {

                $order_head->order_number = 'XO-'.str_replace('-','',date('Y-m-d')).'-'.str_pad($order_head->id,6,"0",STR_PAD_LEFT);
                $order_head->save();

                $billing_model->order_head_id = $order_head->id;
                $billing_model->save();

                $shipping_model->order_head_id = $order_head->id;
                $shipping_model->save();

                if(count($items) > 0){
                    foreach ($items as $item){
                        $item->order_head_id = $order_head->id;
                        $item->save();
                    }
                }
                
                DB::commit();

                // Session Remove
                Session::forget('admin_cart');
                Session::forget('admin_cart_total');
                Session::forget('coupon_code');
                Session::forget('coupon_amount');
                Session::flash('message', 'Order Confriam successfully');
                
                return Redirect::route('admin.exits.cart.checkout.success',['order_number'=>$order_head->order_number,'user_search_id'=>$order_head->users_id]);
                
            }
            

        } catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            
            echo '<pre>';
            print_r($e->getMessage());
            exit();
            $error_info = [''];

            return redirect()->route('admin.cart.checkout.fail')->with('additional_data',$error_info);

        }

        return redirect()->back();

    }

    public function checkout_fail ()
    {
        $pageTitle = 'Checkout Fail';

        return view("Order::newOrder.fail",compact('pageTitle'));
    }

    public function checkout_success($order_number)
    {
        $pageTitle = 'Checkout Success';
        
        $user_data = \Auth::user();
        if(isset($user_data) && $user_data->type == 'customer'){

            $users_id = $user_data->id;
            

        }else{
            
            $order_head_data = OrderHead::where('order_number',$order_number)->first();

            $users_id = $order_head_data->users_id;
           
        }

        $data = OrderHead::with(['relOrderShipping','relOrderDetail.relProduct'=>function($query){
            
            }])->where('order_number',$order_number)->where('users_id',$users_id)->first();

        $checkemail=DB::table('users')
                   ->where('users.id',$users_id)
                   ->first();

        if (!isset($checkemail->email)) {

                   Session::flash('message', 'Order Confriam mail not send , We will call you later.'); 
        }else{
            // $mail_body = \Illuminate\Support\Facades\View::make('Order::newOrder.cartmail', ['data'=> $data]);
            //         $contents = $mail_body->render();

            //         $send_mail = \App\Http\Helpers\SendMail::fire($user_data->email, 'Order confirmation email ', $contents, '');

                    Session::flash('message', 'Order Confriam mail send successfully.');
             
        }

        return view('Order::order.show', [
                'pageTitle'=>$pageTitle,
                'data' => $data
            ]);
    }

    public function exist_checkout_success($order_number,$user_search_id)
    {
        $pageTitle = 'Checkout Success';
        
        $user_data =  $user_data = DB::table('users')->where('id',$user_search_id)->first();
        if(isset($user_data) && $user_data->type == 'customer'){

            $users_id = $user_data->id;
            

        }else{
            
            $order_head_data = OrderHead::where('order_number',$order_number)->first();

            $users_id = $order_head_data->users_id;
           
        }

        $data = OrderHead::with(['relOrderShipping','relOrderDetail.relProduct'=>function($query){
            
            }])->where('order_number',$order_number)->where('users_id',$users_id)->first();

        $checkemail=DB::table('users')
                   ->where('users.id',$users_id)
                   ->first();

        if (!isset($checkemail->email)) {

                   Session::flash('message', 'Order Confriam mail not send , we will call you later.'); 
        }else{
            // $mail_body = \Illuminate\Support\Facades\View::make('Order::newOrder.cartmail', ['data'=> $data]);
            //         $contents = $mail_body->render();

            //         $send_mail = \App\Http\Helpers\SendMail::fire($user_data->email, 'Order confirmation email ', $contents, '');

                    Session::flash('message', 'Order Confriam mail send successfully.');
             
        }

        return view('Order::order.show', [
                'pageTitle'=>$pageTitle,
                'data' => $data
            ]);
    }


    public function add_shipping_address (Request $request)
    {
        $input = $request->all();

        $user_data = DB::table('users')->where('users.id',$request->users_id)->first();

        $type = $input['type'];


        /* Transaction Start Here */
        DB::beginTransaction();
        try {

            $users_billing_shipping_model = new UserBillingShipping();
            $users_billing_shipping_model->create($input);
            

            DB::commit();

            Session::flash('message', 'The Shipping Address Add Successfully.');
            return redirect()->back();

        } catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            Session::flash('danger', $e->getMessage());
            
        }

        return redirect()->back();
    
    }
    
    public function coupon_code_form(Request $request)
    {

       $response = [];
        
       $input=$request->all();

       $checkcoupon=DB::table('coupon')->where('coupon_code',$input['coupon_code'])
                   ->whereDate('valid_to', '>=', date('Y-m-d'))
                   ->where('status','active')
                   ->first();

        $shipping_charge = 60;
       if (isset($checkcoupon) && count($checkcoupon)>0) {
               
              if(Session::has('cart_total')){
                $cart_total = Session::get('cart_total');
            }
               
              $item = $checkcoupon->amount;

              Session::put('coupon_amount',$item);
              Session::put('coupon_code',$input['coupon_code']);
              
              $response['result'] = 'success';
              $response['coupon_amount'] = $item;
              $response['cart_amount'] = $cart_total['total'] + $shipping_charge;

      }else{
          Session::forget('coupon_amount');
      }
        return $response;
    }
}
