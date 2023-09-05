<?php

namespace App\Modules\Web\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Modules\Product\Models\VwProduct;
use App\Modules\Product\Models\Product;
use App\Modules\Product\Models\ProductAttribute;
use App\Modules\Product\Models\ProductInventory;
use App\Http\Helpers\CartHelper;
use App\Http\Helpers\CourierService;
use Illuminate\Support\Facades\Session;
use App\Modules\User\Models\UserBillingShipping;
use App\Modules\Order\Models\OrderShipping;
use App\Modules\Order\Models\OrderDetails;
use App\Modules\Order\Models\OrderHead;
use App\Modules\Order\Models\OrderTransaction;
use App\Modules\Newsletter\Models\Subscriptions;
use App\Modules\Web\Models\Division;
use App\Modules\Web\Requests;
use App\User;
use Auth;
use Hash;
use DB;
use Redirect;
use App;

class CartController extends Controller
{

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Change language

    }

    /**
     * Add Item In cart.
     *
     * @return response
     */
    public function product_quick_view(Request $request)
    {
       $input = Input::all();
       $product_id = $input['product_id'];
       $response = [];

       $product = VwProduct::where('product_id',$product_id)->first();
       $product_image = DB::table('product_image')->where('product_id', $product_id)->get();

        $new_product_id_array = [];

        array_push($new_product_id_array,$product_id);

        if(count($new_product_id_array) > 0){
            $product_id_list = $new_product_id_array;
        }
        $attribute_list = Product::findProductAttribute($product_id_list);

            if(!empty($product))
            {
                $cart_body = \Illuminate\Support\Facades\View::make('Web::cart.quick_view', ['single_items'=> $product,'product_image'=>$product_image,'attribute_list'=>$attribute_list]);
                $contents = $cart_body->render();

                $response['result'] = 'success';
                $response['message'] = 'Product successfully View';

                $response['cart_body'] = $contents;

            }else{
                $response['result'] = 'error';
                $response['message'] = 'Product not found.';
            }

            return $response;

    }

    public function add_items(Request $request)
    {

        $input = Input::all();
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
            $product_image = $input['product_image'];

            $product_color = isset($input['product_color'])?  $input['product_color']:'';
            $product_size = isset($input['product_size'])?$input['product_size']:'';

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
                $item['product_color'] = $product_color;
                $item['product_size'] = $product_size;

                $cart = CartHelper::add_item($item);
                //session(['product_category_id' => $item['product_category_id']]);
                Session::put('product_category_id',$item['product_category_id']);

            }

            $response = [];

            if(Session::has('cart')){
                $cart_total = Session::get('cart_total')['total'];
            }else{
                $cart_total = number_format(0,0);
            }

            if(count($cart) > 0)
            {

                $cart_body = \Illuminate\Support\Facades\View::make('Web::cart._cart', ['cart_items'=> '']);
                $contents = $cart_body->render();

                $response['result'] = 'success';
                $response['message'] = 'Product successfully added to cart.';
                $response['total_item'] = count($cart);
                $response['cart_total'] = $cart_total;
                $response['cart_body'] = $contents;

                $cart_body2 = \Illuminate\Support\Facades\View::make('Web::cart._skikycart', ['cart_items'=> '']);
                $contents2 = $cart_body2->render();
                $response['cart_body2'] = $contents2;

            }else{
                $response['result'] = 'error';
                $response['message'] = 'Product not added to cart.';
            }

            return $response;

        }
    }


    /**
     * Remove Item By Javascript Ajax.
     *
     * @return response
     */

    public function  remove_item_ajax(){
        $product_id = $_POST['product_id'];

        $cart = CartHelper::remove_item($product_id);

        if(Session::has('cart')){
            $cart_total = number_format(Session::get('cart_total')['total'], 2);
        }else{
            $cart_total = number_format(0,2);
        }

        if(count($cart) > 0)
        {

            $cart_body = \Illuminate\Support\Facades\View::make('Web::cart._cart', ['cart_items'=> '']);
            $contents = $cart_body->render();

            $response['result'] = 'success';
            $response['message'] = 'Product successfully added to cart.';
            $response['total_item'] = count($cart);
            $response['cart_total'] = $cart_total;
            $response['cart_body'] = $contents;

            $cart_body2 = \Illuminate\Support\Facades\View::make('Web::cart._skikycart', ['cart_items'=> '']);
                $contents2 = $cart_body2->render();
                $response['cart_body2'] = $contents2;

        }else{
            $response['result'] = 'error';
            $response['message'] = 'Product not added to cart.';
        }


        return $response;
    }

     /**
     * Increment Decrement By Ajax.
     *
     * @return response
     */


    public function cart_update_ajax()
    {
        $items = $_POST['data'];

        $cart = CartHelper::update($items);

        if(Session::has('cart')){
            $cart_total = number_format(Session::get('cart_total')['total'], 2);
        }else{
            $cart_total = number_format(0,2);
        }

        if(count($cart) > 0)
        {

            $cart_body = \Illuminate\Support\Facades\View::make('Web::cart._cart', ['cart_items'=> '']);
            $contents = $cart_body->render();

            $response['result'] = 'success';
            $response['message'] = 'Product successfully added to cart.';
            $response['total_item'] = count($cart);
            $response['cart_total'] = $cart_total;
            $response['cart_body'] = $contents;

            $cart_body2 = \Illuminate\Support\Facades\View::make('Web::cart._skikycart', ['cart_items'=> '']);
                $contents2 = $cart_body2->render();
                $response['cart_body2'] = $contents2;


        }else{
            $response['result'] = 'error';
            $response['message'] = 'Product not added to cart.';
        }

        return $response;

    }


    /**
     * View Shopping Cart.
     * Update Shopping Cart.
     * @return response
     */

    public function cart()
    {

        $pageTitle = 'My Cart';

        $cart_items = [];
        $total_weight = [];
        if(Session::has('cart')){
            $cart_items = Session::get('cart');
            $total_weight=0;
            //count all shipping weight
            foreach ($cart_items as $key => $value) {

                $total_weight += $value['product_weight'];
            }

        }

        $cart_total = [];
        if(Session::has('cart_total')){
            $cart_total = Session::get('cart_total');
        }

        $shipping_charge = 60.00;
        return view("Web::cart.webcart",compact('pageTitle', 'cart_items', 'cart_total','shipping_charge'));
    }

    /**
     * View Checkout page.
     * Update Shopping Cart.
     * Show item,recieve customer data.
     * @return response
     */

    public function checkout(Request $request)
    {

        $pageTitle="Checkout";

        $cart_items = [];
        $total_weight = [];
        if(Session::has('cart')){
            $cart_items = Session::get('cart');
            $total_weight=0;
            //count all shipping weight
            foreach ($cart_items as $key => $value) {

                $total_weight += $value['product_weight'];
            }

        }

        $shipping_charge = 60.00;

        // Check cart empty or not
        if(empty($cart_items)){
            return redirect()->route('web.my.cart');
        }

        // Get total cart price from session
        $cart_total = 0;
        if(Session::has('cart_total')){
            $cart_total = Session::get('cart_total');
        }

        $user_data = \Auth::user();
        if ($user_data) {
            // UserBillingShipping object creation
            $billing = UserBillingShipping::where('users_id',$user_data->id)->where('type','billing')->first();
            $shipping = UserBillingShipping::where('users_id',$user_data->id)->where('users_billing_shipping.type','shipping')->orderBy('users_billing_shipping.id','asc')->get(['users_billing_shipping.*']);
        }


        return view('Web::cart.checkout',compact('pageTitle','cart_items','cart_total','shipping_charge','billing','shipping'));
    }


    /**
     * City to Area.
     * @return response
     */
    public function citytoarea(Request $request)
    {
        $response = [];
        $response['data'] = '';
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

     /**
     * Calculate coupon code amount.
     * Update total amount.
     * Return on checkout page cart section.
     * @return response
     */

    public function coupon_code(Request $request)
    {
        $response = [];
        $input=Input::all();

        $checkCoupon=DB::table('coupon')->where('coupon_code',$input['coupon_code'])->whereDate('valid_to', '>=', date('Y-m-d'))
       ->where('status','active')->first();

       if (isset($checkCoupon) && count($checkCoupon)>0) {
            if(Session::has('cart_total')){
                $cart_total = Session::get('cart_total');
            }

            $couponAmount = $checkCoupon->amount;
            Session::put('coupon_amount',$couponAmount);
            Session::put('coupon_code',$input['coupon_code']);
            $response['result'] = 'success';
            $response['coupon_amount'] = $couponAmount;
            $response['cart_amount'] = $cart_total['total'] + $input['gen_delivery_cost'];
        }else{
            Session::forget('coupon_amount');
        }
        return $response;
    }

    /**
     * Check User Email and Password.
     * If match then redirect checkout page.
     * Otherwise return error message.
     * @return response
     */
    public function checkoutLogin(Request $request)
    {
        $input = Input::all();
        $user_data = \Auth::user();

        if(Auth::check() && $user_data->type != 'customer'){
            Auth::logout();
        }

        if(count($input)>0){
            // Already LogIn

            if(Auth::check() && $user_data->type == 'customer')
            {
                Session::flash('message', "You Have Already Logged In.");
                if($user_data->type == 'customer'){
                    return redirect()->route('web.cart.checkout');
                }
            }
            else
            {
                //Check email is exists into this system
                $user_data_exists = DB::table('users')->where('email',$input['email'])->where('type','customer')->exists();

                if($user_data_exists)
                {
                    $user_data = DB::table('users')->where('email',$input['email'])->where('type','customer')->first();
                    $user_id = $user_data->id;
                    $check_password = Hash::check( $input['password'], $user_data->password);
                    //if password matched
                    if($check_password)
                    {
                        //if user is inactive
                        if($user_data->status=='inactive')
                        {
                            Session::flash('danger', "Sorry! Your Account Is Inactive. Please verify your email or Contact With Administrator To active Account.");
                        }
                        else
                        {
                            if(Auth::check() && $user_data->type == 'customer')
                            {
                                Session::flash('message', "You are already Logged-in! ");
                                return redirect()->route('customer.dashboard');
                            }else{

                                $attempt = Auth::attempt([
                                    'email' => $input['email'],
                                    'password' => $input['password'],
                                    'type' => 'customer'
                                ]);

                                if($attempt)
                                {
                                    Session::flash('message', "Successfully  Logged In.");
                                    return redirect()->route('web.cart.checkout');
                                }
                            }
                        }
                    }else{
                        Session::flash('danger', "Password Incorrect. Please Try Again!!!");
                    }
                }else{
                    Session::flash('danger', "Email does not exists. Please Try Again");

                }
            }
        }else{
            Session::flash('danger', "Email does not exists. Please Try Again");
        }

        return redirect()->back();
    }

    /**
     * Confirm Checkout.
     * If user has loged in then take all info for his database.
     * Otherwise take data from his billing and shipping address.
     * @return response
     */

    public function confirm_checkout(Requests\CheckoutRequest $request)
    {
        //Get all input request in input array.
        $input=Input::all();
        //If customer already loged in then working this block.
        $user_data = \Auth::user();

        Session::put('user_email',$input['email']);
        $same_as_avobe = isset($input['same_as_avobe'])?$input['same_as_avobe']:'';

                    $billing_model = new OrderShipping();
                    $billing_model->type = 'billing';
                    $billing_model->first_name = $input['first_name'];
                    $billing_model->last_name = $input['last_name'];
                    $billing_model->email = $input['email'];
                    $billing_model->address = $input['address'];
                    $billing_model->special_instruction = $input['special_instruction'];
                    $billing_model->phone = $input['phone'];
                    $billing_model->city = $input['city'];
                    $billing_model->area = $input['area'];
                    $billing_model->post_code = $input['post_code'];
                    $billing_model->status = 'active';

                    $user_billing_model=DB::table('users_billing_shipping')
                    ->updateOrInsert(
                        ['users_id' => $user_data->id,'type' =>  'billing'],

                        [
                            'first_name' =>  $input['first_name'],
                            'last_name' =>  $input['last_name'],
                            'email' =>  $input['email'],
                            'phone' =>  $input['phone'],
                            'address' =>  $input['address'],
                            'special_instruction' =>  $input['special_instruction'],
                            'city' =>  $input['city'],
                            'area' =>  $input['area'],
                            'post_code' =>  $input['post_code'],
                            'status' =>  'active',
                        ]
                    );


                    if (!empty($user_data)) {

                        if(!empty($same_as_avobe)){
                            // Delivery address na thakle
                            $shipping_model = new OrderShipping();
                            $shipping_model->type = 'shipping';
                            $shipping_model->first_name = $input['first_name'];
                            $shipping_model->last_name = $input['last_name'];
                            $shipping_model->email = $input['email'];
                            $shipping_model->address = $input['address'];
                            $shipping_model->special_instruction = $input['special_instruction'];
                            $shipping_model->phone = $input['phone'];
                            $shipping_model->city = $input['city'];
                            $shipping_model->area = $input['area'];
                            $shipping_model->post_code = $input['post_code'];
                            $shipping_model->status = 'active';

                            $user_shipping_model=DB::table('users_billing_shipping')
                                ->updateOrInsert(
                                    ['users_id' => $user_data->id,'type' =>  'shipping'],

                                    [
                                     'first_name' =>  $input['first_name'],
                                     'last_name' =>  $input['last_name'],
                                     'email' =>  $input['email'],
                                     'phone' =>  $input['phone'],
                                     'address' =>  $input['address'],
                                     'special_instruction' =>  $input['special_instruction'],
                                     'city' =>  $input['city'],
                                     'area' =>  $input['area'],
                                     'post_code' =>  $input['post_code'],
                                     'status' =>  'active',
                                    ]
                                );


                        }else{

                            //if loged in user have deliver address.
                            $shipping_id = $input['shipping_value'];
                            $shipping_data = DB::table('users_billing_shipping')->where('id',$shipping_id)->first();

                            if($shipping_id !='' && $shipping_data !=''){
                                $shipping_model = new OrderShipping();
                                $shipping_model->type = 'shipping';
                                $shipping_model->first_name = $shipping_data->first_name;
                                $shipping_model->email = $shipping_data->email;
                                $shipping_model->address = $shipping_data->address;
                                $shipping_model->special_instruction = $shipping_data->special_instruction;
                                $shipping_model->phone = $shipping_data->phone;
                                $shipping_model->alternative_phone = $shipping_data->alternative_phone;
                                $shipping_model->city = $shipping_data->city;
                                $shipping_model->area = $shipping_data->area;
                                $shipping_model->post_code = $shipping_data->post_code;

                            }else{

                                $shipping_model = new OrderShipping();
                                $shipping_model->type = 'shipping';
                                $shipping_model->first_name = $input['shipping_first_name'];
                                $shipping_model->last_name = $input['shipping_last_name'];
                                $shipping_model->email = $input['shipping_email'];
                                $shipping_model->address = $input['shipping_address'];
                                $shipping_model->special_instruction = $input['special_instruction'];
                                $shipping_model->phone = $input['shipping_phone'];
                                $shipping_model->city = $input['shipping_city'];
                                $shipping_model->area = $input['shipping_area'];
                                $shipping_model->post_code = $input['shipping_post_code'];
                                $shipping_model->status = 'active';

                                $user_shipping_model=DB::table('users_billing_shipping')
                                ->updateOrInsert(
                                    ['users_id' => $user_data->id,'type' =>  'shipping'],

                                    [
                                        'first_name' =>  $input['shipping_first_name'],
                                        'last_name' =>  $input['shipping_last_name'],
                                        'email' =>  $input['shipping_email'],
                                        'phone' =>  $input['shipping_phone'],
                                        'address' =>  $input['shipping_address'],
                                        'special_instruction' =>  $input['special_instruction'],
                                        'city' =>  $input['shipping_city'],
                                        'area' =>  $input['shipping_area'],
                                        'post_code' =>  $input['shipping_post_code'],
                                        'status' =>  'active',
                                    ]
                                );

                            }
                        }


                }else{



                    #check email exists or not.
                    $isCustomer=DB::table('users')->where('email',$input['email'])->exists();
                    if(!$isCustomer){
                        $model = new User();
                        $model->first_name = $input['first_name'];
                        $model->last_name = $input['last_name'];
                        $model->email = $input['email'];
                        $model->password = Hash::make($request->confirm_new_password);
                        $model->mobile_no = $input['phone'];
                        $model->status = 'active';
                        $model->remember_token = md5(str_random(10));
                        $model->type = 'customer';
                        $model->post_code = $input['post_code'];
                        $model->save(); # Save Customer/Merchange Basic Information.
                        # Subscribe Email
                        if (isset($input['email'])) {
                                # code...
                            $model= new Subscriptions;
                            $model->email=$input['email'];
                            $model->save();
                        }
                        #Hashing password agin for user.
                        $changepass=DB::table('users')
                        ->where('email',$input['email'])
                        ->update([
                            'password' => Hash::make($input['confirm_new_password']),
                        ]);

                        $checkCurrentUser=DB::table('users')
                        ->where('email',$input['email'])->first();

                        $user_billing_model=DB::table('users_billing_shipping')
                        ->updateOrInsert(
                            ['users_id' => $checkCurrentUser->id,'type' =>  'billing'],

                            [
                                'first_name' =>  $input['first_name'],
                                'last_name' =>  $input['last_name'],
                                'email' =>  $input['email'],
                                'phone' =>  $input['phone'],
                                'address' =>  $input['address'],
                                'special_instruction' =>  $input['special_instruction'],
                                'city' =>  $input['city'],
                                'area' =>  $input['area'],
                                'post_code' =>  $input['post_code'],
                                'status' =>  'active',
                            ]
                        );

                         //end isCustomer
                    }

                    if(!empty($same_as_avobe)){
                        //guest user er delivery address thakle customer address k delivaey address kore nibe
                            $shipping_model = new OrderShipping();
                            $shipping_model->type = 'shipping';
                            $shipping_model->first_name = $input['first_name'];
                            $shipping_model->last_name = $input['last_name'];
                            $shipping_model->email = $input['email'];
                            $shipping_model->phone = $input['phone'];
                            $shipping_model->address = $input['address'];
                            $shipping_model->special_instruction = $input['special_instruction'];
                            $shipping_model->city = $input['city'];
                            $shipping_model->area = $input['area'];
                            $shipping_model->post_code = $input['post_code'];
                            $shipping_model->status = 'active';

                            $user_shipping_model=DB::table('users_billing_shipping')->where('users_id',$checkCurrentUser->id)->where('type','shipping')
                            ->updateOrInsert(
                                ['users_id' => $checkCurrentUser->id,'type' =>  'shipping'],

                                [
                                    'first_name' =>  $input['first_name'],
                                    'last_name' =>  $input['last_name'],
                                    'email' =>  $input['email'],
                                    'phone' =>  $input['phone'],
                                    'address' =>  $input['address'],
                                    'special_instruction' =>  $input['special_instruction'],
                                    'city' =>  $input['city'],
                                    'area' =>  $input['area'],
                                    'post_code' =>  $input['post_code'],
                                    'status' =>  'active',
                                ]
                            );


                        }else{
                            // guest user er delivery address na thakle customer address k delivary address kore nibe
                             $shipping_model = new OrderShipping();
                             $shipping_model->type = 'shipping';
                             $shipping_model->first_name = $input['shipping_first_name'];
                             $shipping_model->last_name = $input['shipping_last_name'];
                             $shipping_model->email = $input['shipping_email'];
                             $shipping_model->address = $input['shipping_address'];
                             $shipping_model->special_instruction = $input['special_instruction'];
                             $shipping_model->phone = $input['shipping_phone'];
                             $shipping_model->city = $input['shipping_city'];
                             $shipping_model->area = $input['shipping_area'];
                             $shipping_model->post_code = $input['shipping_post_code'];
                             $shipping_model->status = 'active';

                             $user_shipping_model=DB::table('users_billing_shipping')->where('users_id',$checkCurrentUser->id)->where('type','shipping')
                             ->updateOrInsert(
                                ['users_id' => $checkCurrentUser->id,'type' =>  'shipping'],

                                [
                                    'first_name' =>  $input['shipping_first_name'],
                                    'last_name' =>  $input['shipping_last_name'],
                                    'email' =>  $input['shipping_email'],
                                    'phone' =>  $input['shipping_phone'],
                                    'address' =>  $input['shipping_address'],
                                    'special_instruction' =>  $input['special_instruction'],
                                    'city' =>  $input['shipping_city'],
                                    'area' =>  $input['shipping_area'],
                                    'post_code' =>  $input['shipping_post_code'],
                                    'status' =>  'active',
                                ]
                            );
                    }

                } //end user data not found block

                $cart_total_price = 0;
                $users_id = null;
                if(isset($user_data) && $user_data->type == 'customer'){
                    $users_id = $user_data->id;
                }else{
                    $isCustomer=DB::table('users')->where('email',$input['email'])->first();
                    $users_id=$isCustomer->id;
                }

                $items = [];
                $cart_items = [];
                //cart total product item
                if(Session::has('cart')){
                    $cart_items = Session::get('cart');
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
                        $product_item->color = $item['product_color'];
                        $product_item->size = $item['product_size'];
                        $product_item->total_price = $item['sell_price']*$item['product_quantity'];
                        $product_item->cash_back = 0;
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
              $order_head->shipping_method = 'Self';
              $order_head->courier_package = '';
              $order_head->payment_type = $_POST['payment_method'];
              $order_head->coupon_code = $coupon_code;
              $order_head->coupon_code_value = $coupon_amount;
              $order_head->status = 'pending';

              /* Transaction Start Here */
             // DB::beginTransaction();
              try {
                if($order_head->save())
                {

                    $order_head->order_number = 'mogholmart-'.str_replace('-','',date('Y-m-d')).'-'.str_pad($order_head->id,6,"0",STR_PAD_LEFT);
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

                   // DB::commit();

                    //Return route on checkout success page

                     return Redirect::route('web.cart.checkout.success',['order_number'=>$order_head->order_number]);

                    /*if($input['payment_method'] == 'online_payment'){

                        $order_transaction= new OrderTransaction();
                        $order_transaction->order_head_id= $order_head->id;
                        $order_transaction->transaction_number= '';
                        $order_transaction->date= date('Y-m-d');
                        $order_transaction->amount=$cart_total_price;
                        $order_transaction->currency='BDT';
                        $order_transaction->status='active';
                        $order_transaction->save();

                        Session::put('order_head_id',$order_head->order_number);*/

                        //return redirect()->action('yourPaymentController@index');

                    /*}else{

                    }*/


                }

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                //DB::rollback();
               /* $error_info = $e->getMessage();
                return redirect()->route('web.cart.checkout.fail')->with('additional_data',$error_info);
*/
                print($e->getMessage());
                Session::flash('danger', $e->getMessage());
                exit();
            }
    }

    /**
     * If checkout fail for any resion.
     * Then return this page
     * @return response
     */

    public function checkout_fail ()
    {
        $pageTitle = 'Checkout Fail';

        return view("Web::cart.fail",compact('pageTitle'));
    }

    public function checkout_success($order_number)
    {
        $pageTitle = 'Checkout Success';

        if(Session::has('user_email')){
            $user_email = Session::get('user_email');
        }

        $user_data = \Auth::user();
        if(isset($user_data) && $user_data->type == 'customer'){
            $users_id = $user_data->id;
        }else{

            $order_head_data = OrderHead::where('order_number',$order_number)->first();
            $users_id = $order_head_data->users_id;
        }

        if(Session('cart')!=='')
        {

            $checkemail=DB::table('users')
            ->where('users.id',$users_id)
            ->first();

            if ($checkemail->email!='') {

            $data = OrderHead::with(['relOrderShipping','relOrderDetail.relProduct'=>function($query){}])->where('order_number',$order_number)->first();
            $mail_body = \Illuminate\Support\Facades\View::make('Web::email.cartmail', ['data'=> $data]);
            $contents = $mail_body->render();

            $send_mail = \App\Http\Helpers\SendMail::fire($user_email, 'Order confirmation email ', $contents, '');

            Session::flash('message', 'Your order is successfully placed. Also send you order email');
          }else{
            $data = OrderHead::with(['relOrderShipping','relOrderDetail.relProduct'=>function($query){}])->where('order_number',$order_number)->where('users_id',$users_id)->first();
            Session::flash('message', 'Your order is successfully placed.');
        }
        // Session Remove
        Session::forget('cart');
        Session::forget('cart_total');
        Session::forget('coupon_amount');
        Session::forget('coupon_code');
        Session::forget('user_email');

        return view('Web::cart.checkout_success', [
              'pageTitle'=>$pageTitle,
              'data' => $data
          ]);

        }else{
             Session::flash('error', 'Sorry your cart is empty.');
             return back();
        }
    }


    public function destroy_billing_shipping($id)
    {

        $user_data = \Auth::user();

        if(empty($user_data)){
            return redirect()->intended('customer/account');
        }

        if($user_data->type != 'customer'){
            return redirect()->intended('customer/account');
        }

        $billing_shipping_data =UserBillingShipping::where('users_id',$user_data->id)->where('id',$id)->first();

        if(!isset($billing_shipping_data)){
            return redirect('customer/address');
        }

        DB::beginTransaction();
        try {
            // Destroy
            $billing_shipping_data->delete();

            DB::commit();
            Session::flash('message', "Successfully Deleted.");

           return redirect()->back();

        } catch(\Exception $e) {
            DB::rollback();
            Session::flash('danger',$e->getMessage());
        }

        // redirect to current page
        return redirect()->back();
    }

}
