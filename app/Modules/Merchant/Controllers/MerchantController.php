<?php

namespace App\Modules\Merchant\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Merchant\Requests;
use App\Modules\Merchant\Models\Merchant;
use App\Modules\Product\Models\Product;
use App\Modules\Product\Models\ProductAttribute;
use App\Modules\Product\Models\Manufacturer;
use App\Modules\Product\Models\Brand;
use App\Modules\Product\Models\ProductImage;
use App\Modules\Product\Models\ProductDetails;
use App\Modules\Product\Models\ProductSeo;
use App\Modules\Product\Models\ProductReview;
use App\Modules\Product\Models\ProductInventory;
use App\Modules\Product\Models\ProductVariation;
use App\Modules\Product\Models\ProductBrand;
use App\Modules\Product\Models\ProductCategory;
use App\Modules\Attribute\Models\AttributeSet;
use App\Modules\Attribute\Models\Attribute;
use App\Modules\Category\Models\Category;
use App\Modules\Attribute\Models\AttributeSetItems;
use App\Modules\Order\Models\OrderDetails;
use App\Modules\Order\Models\OrderHead;
use App\User;

use Illuminate\Support\Facades\Input;

use DB;
use Illuminate\Support\Facades\Session;
use Auth;
use Illuminate\Support\Facades\Hash;
use App;
use Image;
use File;
use Storage;


class MerchantController extends Controller
{
    public function __construct()
    {
        // Change language
        if (isset($_GET['lang']) && !empty($_GET['lang'])) {
            App::setLocale($_GET['lang']);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected function isGetRequest()
    {
        return Input::server("REQUEST_METHOD") == "GET";
    }


    /**
     * @return bool
     */
    protected function isPostRequest()
    {
        return Input::server("REQUEST_METHOD") == "POST";
    }

    /**
     * @return array
     */
    protected static function array_of_size()
    {
        $array_of_size = array(
            '200',
            '400',
            '600',
            'orginal_image'
        );

        return $array_of_size;
    }

    /**
     * @param $size
     * @param $precision
     * @return value
     */
    public static function formatBytes($size, $precision = 2)
    {
        $base = log($size, 1024);
        $suffixes = array('', 'K', 'M', 'G', 'T');

        return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
    }

    /**
     *  Check if Directory Exists
     */
    protected static function check_directory($target_location, $value)
    {

        $target_location = $target_location . '/' . $value . 'x' . $value;
        if (!Storage::disk('public')->exists($target_location)) {
            $target_location = public_path($target_location);

            File::makeDirectory($target_location, 0777, true, true);
        }

        return true;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = 'Merchant Corner';

        if ($user = Auth::user()) {
            if ($user->type == 'seller') {
                Session::flash('message', "You Have Already Logged In.");
                return redirect()->back();
            }
        }

        $model = new User();



        return view('Merchant::merchant.index', [
            'pageTitle' => $pageTitle,
            'model' => $model,

        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\MerchantProductRequest $request)
    {
        // Get all input data
        $input = $request->all();

        /* Transaction Start Here */
        DB::beginTransaction();
        try {


            $product_data = Product::create($input);

            DB::commit();
            Session::flash('message', 'Product is added!');
            return redirect('merchant/my-product');

        } catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            Session::flash('danger', $e->getMessage());
        }

        // Redirect back to last page if error occurs
        return redirect()->back();
    }


    /**
     * Show the form for register a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function registration()
    {
        $pageTitle = 'Merchant Registration';


        return view('Merchant::merchant.registration', [
            'pageTitle' => $pageTitle,

        ]);

    }
    /**
     * Show the form for merchant profile a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function merchant_profile()
    {
        $pageTitle = 'Merchant Profile';

        $data = \Auth::user();

        $varifaid_user = User::join('merchant_profiles', 'users.id', '=', 'merchant_profiles.users_id')->where('users.id', $data->id)->select('users.email', 'users.merchant_agreement', 'users.mobile_no', 'users.id', 'merchant_profiles.*')->first();



        return view('Merchant::merchant.merchant_profile', [
            'pageTitle' => $pageTitle,

            'varifaid_user' => $varifaid_user
        ]);

    }

    public function merchant_comission_details()
    {
        $pageTitle = 'Merchant Profile';

        $data = \Auth::user();

        $varifaid_user = User::join('merchant_profiles', 'users.id', '=', 'merchant_profiles.users_id')->where('users.id', $data->id)->select('users.email', 'users.merchant_agreement', 'users.mobile_no', 'users.id', 'merchant_profiles.*')->first();



         $merchant_wise_data=OrderDetails::join('merchant_profiles','order_details.product_merchant_id','=','merchant_profiles.users_id')
              ->leftjoin('comissions_setting','order_details.product_merchant_id','=','comissions_setting.merchant_id')
              ->join('order_head','order_details.order_head_id','=','order_head.id')
              ->whereNotIn('order_head.status',['pending'])
              ->where('order_details.product_merchant_id',$data->id)
              ->select('merchant_profiles.shop_name','comissions_setting.comission_rate','comissions_setting.comission_type','order_details.product_merchant_id', DB::raw('sum(order_details.comission_price) as comission_amount'), DB::raw('sum(order_details.total_price) as total_amount'))
              ->groupby('order_details.product_merchant_id')
              ->first();

        $merchant_wise_details=OrderHead::rightjoin('order_details','order_details.order_head_id','=','order_head.id')
                ->where('order_details.product_merchant_id',$data->id)
                ->whereNotIn('order_head.status',['pending'])
                ->orderBy('order_head.id', 'desc')
                ->groupBy('order_head.id')
                ->select('order_head.*','order_details.comission_price',DB::raw('sum(order_details.comission_price) as comission_price'), DB::raw('sum(order_details.total_price) as total_price'))
                ->paginate(30);

        return view('Merchant::merchantcomission.index', [
            'pageTitle' => $pageTitle,

            'varifaid_user' => $varifaid_user,
            'merchant_wise_data' => $merchant_wise_data,
            'merchant_wise_details' => $merchant_wise_details,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function do_registration(Requests\MerchantRegisterRequest $request)
    {

        $input = $request->all();

        // Check already presents or not
        $data = User::where('email',$input['email'])->exists();

        if(!$data)
        {

            $model = new User();

            $model->email = $input['email'];
            $model->password = Hash::make($input['password']);
            $model->mobile_no = $input['mobile_no'];
            $model->type = 'seller';
            $model->status = 'active';
            $model->merchant_agreement = 'no';
            $model->remember_token = md5(str_random(10));
            $model->save();

            $user = DB::table('users')
                ->where('email', $input['email'])
                ->where('type', 'seller')
                ->first();


            /* Transaction Start Here */
            DB::beginTransaction();
            try {
                if (count($user) > 0) {
                    $merchant_model = new Merchant();
                    $merchant_model->users_id = $user->id;
                    $merchant_model->shop_name = $input['shop_name'];
                    $merchant_model->shop_address = $input['shop_address'];
                    $merchant_model->save();

                    //$mail_body = \Illuminate\Support\Facades\View::make('Merchant::email._registration', ['user_data' => $user]);
                    //$contents = $mail_body->render();

                    //$send_mail = \App\Http\Helpers\SendMail::fire($user->email, 'Registration from Super Tiles BD ', $contents, '');

                }

                DB::commit();

                Session::flash('message', 'Please check your email for complete registration.');
                return redirect()->route('merchant.corner');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                Session::flash('danger', $e->getMessage());

            }
        }else{
            Session::flash('info', 'This merchant already added!');
        }

        return redirect()->route('merchant.do_registration');
    }


    /**
     * Show the form for confrim a new merchant registratrion.
     *
     * @return \Illuminate\Http\Response
     */
    //confirm mail
    public function confirm_email($slug)
    {

        $pageTitle = 'Confirm registration email';

        $user_data = User::where('users.remember_token', $slug)
            ->select('users.*')
            ->first();

        if (!isset($user_data->remember_token)) {

            Session::flash('danger', "Token not found.");
            return redirect('merchant-corner');
        } else {

            $model = DB::table('users')
                ->where('users.remember_token', $slug)
                ->update([
                    'status' => 'active',
                    'remember_token' => '',
                ]);

            Session::flash('message', "Thank You So Much For Your Registration, Please Login Here To Next Process.");
            return redirect('merchant/login');
        }
    }

    /**
     * Show the form for login a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        $pageTitle = 'Merchant Login';

        return view('Merchant::merchant.login', [
            'pageTitle' => $pageTitle,

        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function post_login(Request $request)
    {
       $input = Input::all();
        $user_data = DB::table('users')->where('email',$input['email'])->where('status','active')->where('type','seller')->first();


        if(Auth::check() && $user_data->type != 'customer'){
            Auth::logout();
        }

        if(count($input)>0){

            if(Auth::check() && $user_data->type == 'seller')
            {
                Session::flash('message', "You Have Already Logged In.");

                if($user_data->type == 'seller'){
                    return redirect()->route('merchant.dashboard');
                }
            }
            else
            {
                //Check email is exists into this system
                $user_data_exists = DB::table('users')
                                        ->where('email',$input['email'])
                                        ->where('type','seller')
                                        ->exists();

                if($user_data_exists)
                {
                    $user_data = DB::table('users')
                                            ->where('email',$input['email'])
                                            ->where('type','seller')
                                            ->first();

                    $check_password = Hash::check($input['password'], $user_data->password);

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
                            if(Auth::check() && $user_data->type == 'seller')
                            {
                                Session::flash('message', "You are already Logged-in! ");
                                return redirect()->route('merchant.dashboard');
                            }else{

                                $attempt = Auth::attempt([
                                    'email' => $input['email'],
                                    'password' => $input['password'],
                                    'type' => 'seller'
                                ]);

                                if($attempt)
                                {
                                    Session::flash('message', "Successfully  Logged In.");
                                    return redirect()->route('merchant.dashboard');
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $pageTitle = 'Dashboard';

        $user_data = \Auth::user();

         if (empty($user_data)) {
            return redirect()->intended('merchant/login');
        }

        if ($user_data->type != 'seller' &&  $user_data->status != 'active') {
            return redirect()->intended('merchant/login');
        }

        $todate=date('Y-m-d');

        $toyear = date("Y", strtotime($todate));
        $tomonth = date("m");

        $form_date=date('Y-m-d', strtotime('-15 days'));

        $varifaid_user = User::join('merchant_profiles', 'users.id', '=', 'merchant_profiles.users_id')->where('users.id', $user_data->id)->select('users.email', 'users.id', 'merchant_profiles.shop_name', 'users.merchant_agreement','users.image')->first();



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

        $total_product = Product::where('merchant_id',  \Auth::user()->id)->count();
        $thismonth_product = Product::where('merchant_id',  \Auth::user()->id)->whereMonth('created_at',$tomonth)->count();

        $totoal_sell_price=OrderDetails::join('order_head','order_details.order_head_id','=','order_head.id')
              ->whereNotIn('order_head.status',['pending'])
              ->where('order_details.product_merchant_id', \Auth::user()->id)
              ->select(DB::raw('sum(order_details.total_price) as total_amount'))
              ->first();

        return view('Merchant::merchant.dashboard', [
            'pageTitle' => $pageTitle,
            'user_data' => $user_data,
            'varifaid_user' => $varifaid_user,

            'todays_order' => $todays_order,
            'last_15_days_order' => $last_15_days_order,
            'current_month_order' => $current_month_order,
            'total_order' => $total_order,
            'total_product' => $total_product,
            'thismonth_product' => $thismonth_product,
            'totoal_sell_price' => $totoal_sell_price,
        ]);
    }


    /**
     * Show the form for logout from zinismart merchant.
     *
     * @return \Illuminate\Http\Response
     */

    public function merchant_logout()
    {
        Auth::logout();
        return redirect()->route('login.merchant.corner');
    }


    /**
     * Show the form for forget passord from zinismart merchant.
     *
     * @return \Illuminate\Http\Response
     */

    public function forget_password()
    {

        $pageTitle = 'Forget Password';



        return view('Merchant::passwordreset.forgetpassword', [
            'pageTitle' => $pageTitle,


        ]);

    }

    /**
     * Show the form for mail send for password change.
     *
     * @return \Illuminate\Http\Response
     */
    public function send_mail_to_merchant(Request $request)
    {

        $user_data = \Auth::user();

        $input = $request->all();

        //Check email is exists into this system

        $token = md5(time());
        $model = DB::table('users')
            ->where('users.email', $request->email)
            ->update(['remember_token' => $token]);

        $user = DB::table('users')
            ->where('email', $input['email'])
            ->where('type', 'seller')
            ->first();


        if (count($user) > 0) {

            $mail_body = \Illuminate\Support\Facades\View::make('Merchant::passwordreset._password_email_template', ['user_data' => $user]);
            $contents = $mail_body->render();

            $send_mail = \App\Http\Helpers\SendMail::fire($user->email, 'Reset Password', $contents, '');

            Session::flash('message', 'Please check your email, and follow those instruction.');
            return redirect()->back();


            return redirect()->back();
        } else {

            Session::flash('danger', "email incorrect.");
        }

        return redirect()->back();
    }


    /**
     * Show the form for change password form a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function change_password_form($slug)
    {

        $pageTitle = 'Forget Password';


        $data = User::where('users.remember_token', $slug)
            ->select('users.*')
            ->first();

        if (!isset($data->remember_token)) {

            Session::flash('danger', "Token not found.");
            return redirect('merchant/login');
        } else {

            return view('Merchant::passwordreset.passwordchange_form', [
                'pageTitle' => $pageTitle,
                'data' => $data,

            ]);
        }

    }

    /**
     * Show the form for save change
     *
     * @return \Illuminate\Http\Response
     */
    public function save_chage_password(Request $request)
    {

        $user_data = \Auth::user();


        $input = $request->all();

        $this->validate($request, [
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
        ]);

        $check_password = $input['password'] === $input['password_confirmation'];
        if ($check_password) {

            $model = DB::table('users')
                ->where('users.remember_token', $input['dataemail'])
                ->update([
                    'password' => Hash::make($input['password']),
                    'remember_token' => '',
                ]);

            if ($model) {
                Session::flash('message', "Password changed successfully.");
                return redirect('merchant/login');
            } else {
                Session::flash('danger', "Unable to change password.");
            }
        } else {
            Session::flash('danger', "Do not match confirm password");
        }

        return redirect()->back();

    }



    /**
     * Show the form for change password form a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function reset_password_form($id)
    {

        $pageTitle = 'Reset Password';

        $data = \Auth::user();



        $varifaid_user = User::join('merchant_profiles', 'users.id', '=', 'merchant_profiles.users_id')->where('users.id', $data->id)->select('users.email', 'users.merchant_agreement', 'users.id', 'merchant_profiles.shop_name')->first();


        if (!isset($data->id)) {

            Session::flash('danger', "Token not found.");
            return redirect('merchant/login');
        } else {

            return view('Merchant::passwordreset.passwordrest_form', [
                'pageTitle' => $pageTitle,
                'data' => $data,
                'varifaid_user' => $varifaid_user,

            ]);
        }

    }



    /**
     * Show the form for save change
     *
     * @return \Illuminate\Http\Response
     */
    public function password_reset(Request $request)
    {

        $user_data = \Auth::user();


        $input = $request->all();

        $this->validate($request, [
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
        ]);

        $check_password = $input['password'] === $input['password_confirmation'];
        if ($check_password) {

            $model = DB::table('users')
                ->where('users.id', $input['dataemail'])
                ->update([
                    'password' => Hash::make($input['password']),
                ]);

            if ($model) {
                Session::flash('message', "Password changed successfully.");
                return redirect('merchant/dashboard');
            } else {
                Session::flash('danger', "Unable to change password.");
            }
        } else {
            Session::flash('danger', "Do not match confirm password");
        }

        return redirect()->back();

    }


    /**
     * Show the form for save change
     *
     * @return \Illuminate\Http\Response
     */
    public function edit_merchant_profile(Requests\MerchantProfileRequest $request)
    {

        $input = $request->all();

        /* Transaction Start Here */
        DB::beginTransaction();
        try {

            $model = DB::table('merchant_profiles')
                ->where('merchant_profiles.users_id', $input['user_id'])
                ->update([
                    'shop_name' => $input['shop_name'],
                    'shop_address' => $input['shop_address'],
                    'shop_description' => $input['shop_description'],
                    'first_contact_person_details' => $input['first_contact_person_details'],
                    'second_contact_person_details' => $input['second_contact_person_details']
                ]);

            DB::commit();

            Session::flash('message', 'Merchant Profile Successfully Updated');
            return redirect()->route('merchant.profile');

        } catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            Session::flash('danger', $e->getMessage());

        }

        return redirect()->back();

    }

    /**
     * Show the form for change merchant product form.
     *
     * @return \Illuminate\Http\Response
     */

    public function my_product()
    {

        $pageTitle = 'Merchant Product';

        $data = \Auth::user();

        $varifaid_user = User::join('merchant_profiles', 'users.id', '=', 'merchant_profiles.users_id')->where('users.id', $data->id)->select('users.email', 'users.merchant_agreement', 'users.id', 'merchant_profiles.shop_name')->first();

        $product = Product::where('merchant_id', $data->id)->orderBy('id', 'desc')->paginate(30);

        $attribute_set_lists = ['' => 'Please select Attribute Set'] + AttributeSet::pluck('title', 'id')->all();


        return view('Merchant::merchantproduct.merchant_product', [
            'pageTitle' => $pageTitle,
            'data' => $data,
            'varifaid_user' => $varifaid_user,
            'product' => $product,
            'attribute_set_lists' => $attribute_set_lists,


        ]);


    }

    public function current_month_product_list()
    {

        $pageTitle = 'Merchant Product';

        $data = \Auth::user();
        $tomonth = date("m");
        $varifaid_user = User::join('merchant_profiles', 'users.id', '=', 'merchant_profiles.users_id')->where('users.id', $data->id)->select('users.email', 'users.merchant_agreement', 'users.id', 'merchant_profiles.shop_name')->first();

        $product = Product::where('merchant_id', $data->id)->whereMonth('created_at',$tomonth)->orderBy('id', 'desc')->paginate(30);

        $attribute_set_lists = ['' => 'Please select Attribute Set'] + AttributeSet::pluck('title', 'id')->all();


        return view('Merchant::merchantproduct.merchant_product', [
            'pageTitle' => $pageTitle,
            'data' => $data,
            'varifaid_user' => $varifaid_user,
            'product' => $product,
            'attribute_set_lists' => $attribute_set_lists,


        ]);


    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function merchant_product_show($id)
    {
        $pageTitle = 'Merchant Product Details';

        $data = \Auth::user();

        $varifaid_user = User::join('merchant_profiles', 'users.id', '=', 'merchant_profiles.users_id')->where('users.id', $data->id)->select('users.email', 'users.merchant_agreement', 'users.id', 'merchant_profiles.shop_name')->first();

        $product = Product::join('product_inventory', 'product.id', '=', 'product_inventory.product_id')
                    ->select('product.*','product_inventory.warehouse','product_inventory.note','product_inventory.quantity')
                    ->with('relProductAttribute')
                    ->where('product.id', $id)
                    ->where('product.merchant_id', $data->id)
                    ->first();



        $seo = ProductSeo::where('product_seo.product_id', $id)->first();

          // assigned category
        $product_category = DB::table('product_category')->join('category', 'product_category.category_id', '=', 'category.id')->where('product_category.product_id', $id)->select('category.title')->get();


        $review_data = ProductReview::where('product_review.product_id', $id)->get();

        $imagedata = ProductImage::where('product_image.product_id', $id)->get();

          if (isset($product->attribute_set_id)) {
             // Attribute lists found
            $attributes_list = Attribute::join('attribute_set_items', 'attribute_set_items.attribute_id', '=', 'attribute.id')->where('attribute_set_items.attribute_set_id', $product->attribute_set_id)->select('attribute.*')->get();



            $attributes = [];

            if (count($attributes_list) > 0) {
                foreach ($attributes_list as $item) {
                    $attributes[$item->code_column] = $item;
                }
            }

            return view('Merchant::merchantproduct.product_details', [
                'pageTitle' => $pageTitle,
                'data' => $data,
                'varifaid_user' => $varifaid_user,
                'product' => $product,
                'seo' => $seo,
                'product_category' => $product_category,
                'review_data' => $review_data,
                'attributes' => $attributes,
                'imagedata' => $imagedata,


            ]);

          }else{

                   return view('Merchant::merchantproduct.product_details', [
                    'pageTitle' => $pageTitle,
                    'data' => $data,
                    'varifaid_user' => $varifaid_user,
                    'product' => $product,
                    'seo' => $seo,
                    'product_category' => $product_category,
                    'review_data' => $review_data,

                    'imagedata' => $imagedata,


                ]);
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
        $pageTitle = "Update Merchant Product";

        $data = \Auth::user();
        // Find Product
        $product = Product::with('relProductAttribute')->where('product.id', $id)->where('product.merchant_id', $data->id)->first();

        // If Product not found
        if (!isset($product)) {
            Session::flash('danger', 'Product not found.');
            return redirect()->route('merchant.my.product');
        }



        $varifaid_user = User::join('merchant_profiles', 'users.id', '=', 'merchant_profiles.users_id')->where('users.id', $data->id)->select('users.email', 'users.merchant_agreement', 'users.id', 'merchant_profiles.shop_name')->first();

        // Get parent & child hierarchy
        $manufacturer_lists = ['' => 'Please select manufacturer'] + Manufacturer::pluck('title', 'id')->all();

        $imagedata = ProductImage::where('product_image.product_id', $id)->get();

        $seo_data = ProductSeo::where('product_seo.product_id', $id)->first();

        $inventory_data = ProductInventory::where('product_inventory.product_id', $id)->first();

        $review_data = ProductReview::where('product_review.product_id', $id)->get();

        // Attribute lists found
        $attributes_list = Attribute::join('attribute_set_items', 'attribute_set_items.attribute_id', '=', 'attribute.id')->where('attribute_set_items.attribute_set_id', $product->attribute_set_id)->select('attribute.*')->get();
        $attributes = [];

        if (count($attributes_list) > 0) {
            foreach ($attributes_list as $item) {
                $attributes[$item->code_column] = $item;
            }
        }


        // Get Category list
        $category_lists = Category::getHierarchyCategory('');
            //array_shift($category_lists);
        unset($category_lists['']);



            // assigned category
        $product_category = DB::table('product_category')->where('product_id', $id)->pluck('category_id')->all();
        // Return view
        return view("Merchant::merchantproduct.merchant_product_add", compact('data', 'manufacturer_lists', 'pageTitle', 'product', 'varifaid_user', 'inventory_data', 'seo_data', 'review_data', 'attributes', 'category_lists', 'product_category', 'imagedata'));
    }

    public function getbrand(Request $request)
    {

        $response = [];
        $response['data'] = '';

        $manufacturer_id = $_POST['manufacturer_id'];
        $product_id = $_POST['product_id'];

        $selected_brand = ProductBrand::where('product_id', $product_id)->pluck('brand_id')->all();

        $response['brand_data'] = [];

        $data1 = Brand::where('status', 'active')->where('manufacturer_id', $manufacturer_id)->pluck('title', 'id')->all();
        $data = Brand::where('status', 'active')->where('manufacturer_id', $manufacturer_id)->get();

        if (count($data1) > 0) {
            foreach ($data1 as $key => $value) {
                $response['data'] .= '<div class="checkbox-list">';
                $response['data'] .= '<input type="checkbox" name="ProductBrand[]" class="field" value="' . $key . '" id="brand_' . $key . '" ' . (in_array($key, $selected_brand) ? 'checked' : '') . '>';
                $response['data'] .= '<label for="brand_' . $key . '" >' . $value . '</label>';
                $response['data'] .= '</div>';
            }
        }

        $i = 0;
        if (count($data) > 0) {
            foreach ($data as $key => $value) {
                $response['brand_data'][$i]['id'] = $value->id;
                $response['brand_data'][$i]['text'] = $value->title;
                $response['brand_data'][$i]['level'] = 1;
                $i++;
            }
        }

        $response['selected'] = $selected_brand;


        $response['result'] = 'success';

        return $response;


        echo "<option value='0'>Select A Brand</option>";

        $branddata = DB::table('brand')
            ->join('manufacturer', 'brand.manufacturer_id', '=', 'manufacturer.id')
            ->where('brand.manufacturer_id', $request->manufacturer_id)
            ->get(['brand.title', 'brand.id as brand_id']);

        foreach ($branddata as $key => $data) {
            echo '<option value="' . $data->brand_id . '">' . $data->title . '</option>';
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_basic(Request $request, $id)
    {
        $response = [];

        $input = $request->all();

        $input['slug'] = str_slug($input['slug']);
        $item = $request->item_no;
        $merchant=$request->merchant_id;

        $input['item_no']=$input['item_no'];

        if ($input['item_no_copy']==null) {

            $item_no_custom='ZM-'.$merchant.'-'.$item.'-'.str_pad($id, 8, "0", STR_PAD_LEFT);
            $input['item_no'] =$item_no_custom;

        }
        // Find Product
        $model = Product::where('product.id', $id)->first();

        if ($model) {
            // Check Slug
            $check_slug = Product::where('slug', $input['slug'])->where('item_no',$input['item_no'])->first();

            // Find unique product
            if (count($check_slug) > 0 && $check_slug->id == $id) {
                // Slug presents in current id
                $product_update_required = 'yes';
            } elseif (count($check_slug) > 0 && $check_slug->id != $id) {
                // Slug present, but not in current id
                $product_update_required = 'no';
            } else {
                // Slug not present
                $product_update_required = 'yes';
            }


            if ($product_update_required == 'yes') {
                DB::beginTransaction();
                try {
                    // Update product basic info
                    $result = $model->update($input);


                    $model->title_tr = $input['title'];

                    $model->sell_price_tr = $input['sell_price'];
                    $model->list_price_tr = $input['list_price'];
                    $model->offer_price_tr = $input['offer_price'];

                    App::setLocale('bn');
                    $model->title_tr = $input['title_tr'];

                    $model->sell_price_tr = $input['sell_price_tr'];
                    $model->list_price_tr = $input['list_price_tr'];
                    $model->offer_price_tr = $input['offer_price_tr'];
                    $model->save();

                    if ($result) {

                        // If brand data is selected
                        if (isset($input['brand']) && count($input['brand']) > 0) {
                                    // Find old brand
                            $old_brands = ProductBrand::where('product_id', $id)->pluck('brand_id')->all();
                            $new_brands = [];

                            foreach ($input['brand'] as $key => $brand_id) {
                                        // Find brand in this product
                                $model = ProductBrand::where('brand_id', $brand_id)->where('product_id', $id)->first();

                                if ($model) {
                                           // Do nothing
                                } else {
                                            // New brand is found
                                    $model = new ProductBrand();
                                    $model->brand_id = $brand_id;
                                    $model->product_id = $id;

                                    $model->save();

                                }

                                // all brand push in new brand
                                array_push($new_brands, $model->brand_id);
                            }

                            // find differentiate in old brands & new brands
                            $removed_brands = array_diff($old_brands, $new_brands);

                            // Delete not selected brand
                            ProductBrand::where('product_id', $id)->whereIn('brand_id', $removed_brands)->delete();
                        }


                        DB::commit();

                        $response['result'] = 'success';
                        $response['message'] = 'Successfully updated!';

                    }



                } catch (\Exception $e) {
                            //If there are any exceptions, rollback the transaction`
                    DB::rollback();

                    $response['result'] = 'error';
                    $response['message'] = $e->getMessage();
                }

            } else {

                // Product not found
                $response['result'] = 'error';
                $response['message'] = 'This slug already presents in another product, Please another one.';
            }


        }

        return $response;

    }

    /**
     * @param $id
     * @return Update
     */
    public function description_update(Request $request, $id)
    {
        $response = [];

        $input = $request->all();
        $model = Product::where('product.id', $id)->first();

        if (count($model) > 0) {
            DB::beginTransaction();
            try {
                    // Update product basic info
                $result = $model->update($input);
                $model->short_description_tr = $input['short_description'];
                $model->specification_tr = $input['specification'];
                $model->description_tr = $input['description'];


                App::setLocale('bn');
                $model->short_description_tr = $input['short_description_tr'];
                $model->specification_tr = $input['specification_tr'];
                $model->description_tr = $input['description_tr'];

                $model->save();

                DB::commit();

                $response['result'] = 'success';
                $response['message'] = 'Successfully updated!';

            } catch (\Exception $e) {
                    //If there are any exceptions, rollback the transaction`
                DB::rollback();

                $response['result'] = 'error';
                $response['message'] = $e->getMessage();
            }

        } else {
                 // Product not found
            $response['result'] = 'error';
            $response['message'] = 'This product allready updated.';
        }
        return $response;

    }

    public function seo_update(Request $request, $id)
    {
        $response = [];
        // Find product data
        $data = Product::where('id', $id)->first();

        // If data is found
        if (count($data) > 0) {
            // Get all request
            $input = $request->all();

            // Transaction start
            DB::beginTransaction();
            try {

                // Get Seo data
                $seo_data = ProductSeo::where('product_id', $id)->first();

                if (count($seo_data) > 0) {   // For update
                    $seo_modal = $seo_data->update($input);
                } else {
                    // For Insert
                    $seo_data = new ProductSeo();

                    $seo_data->product_id = $id;
                    $seo_data->meta_title = $input['meta_title'];
                    $seo_data->meta_keywords = $input['meta_keywords'];
                    $seo_data->meta_description = $input['meta_description'];
                    $seo_data->meta_image_link = $input['meta_image_link'];

                    $seo_data->save();

                }


                DB::commit();
                $response['result'] = 'success';
                $response['message'] = 'Successfully updated!';


            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();

                $response['result'] = 'error';
                $response['message'] = $e->getMessage();
            }



        } else {
            $response['result'] = 'error';
            $response['message'] = 'Product Not Found.';
        }
        return $response;


    }


    public function inventory_update(Request $request, $id)
    {
        $response = [];
         // Find product data
        $data = Product::where('id', $id)->first();

        // If data is found
        if (count($data) > 0) {
            // Get all request
            $input = $request->all();

            // Transaction start
            DB::beginTransaction();
            try {

                // Get product inventory data
                $inventory_data = ProductInventory::where('product_id', $id)->first();

                if (count($inventory_data) > 0) {   // For update
                    $seo_modal = $inventory_data->update($input);

                } else {
                    // For Insert
                    $inventory_data = new ProductInventory();

                    $inventory_data->product_id = $id;
                    $inventory_data->warehouse = $input['warehouse'];
                    $inventory_data->item_number = $input['item_number'];
                    $inventory_data->quantity = $input['quantity'];
                    $inventory_data->note = $input['note'];
                    $inventory_data->save();

                }


                DB::commit();
                // Press Save & Continue
                $response['result'] = 'success';
                $response['message'] = 'Successfully updated!';


            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();

                $response['result'] = 'error';
                $response['message'] = $e->getMessage();
            }



        } else {
            $response['result'] = 'error';
            $response['message'] = 'Product Not Found!';
        }
        return $response;

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function category_update(Request $request, $id)
    {

        $response = [];

        $input = $request->all();

            // Find Product
        $data = Product::where('product.id', $id)->first();

            // If Product not found
        if (count($data) <= 0) {
            Session::flash('danger', 'Product not found.');
            return redirect()->route('merchant.my.product');
        }

            // Transaction start
        DB::beginTransaction();
        try {

            if (isset($input['category']) && count($input['category']) > 0) {

                $old_category_array = [];
                $new_category_array = [];

                $old_category = DB::table('product_category')->where('product_id', $id)->get();
                if (!empty($old_category)) {
                    foreach ($old_category as $item) {
                        array_push($old_category_array, $item->category_id);
                    }
                }


                $category_data = $input['category'];

                foreach ($input['category'] as $key => $value) {

                    $category_exits = DB::table('category')->where('status', 'active')->where('id', $value)->first();


                    if (!empty($category_exits)) {

                        array_push($new_category_array, $category_exits->id);

                        $already_presents_category_rel = DB::table('product_category')->where('product_id', $id)->where('category_id', $value)->first();


                        if (empty($already_presents_category_rel)) {

                            $category_model = new ProductCategory();

                            $category_model->product_id = $id;
                            $category_model->category_id = $value;

                            $category_model->save();

                        }

                    }
                }



                $deleted_category = array_diff($old_category_array, $new_category_array);
                if (!empty($deleted_category)) {
                    DB::table('product_category')->whereIn('category_id', $deleted_category)->where('product_id', $id)->delete();
                }

            }

            DB::commit();

            $response['result'] = 'success';
            $response['message'] = 'Successfully updated Category!';

        } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
            DB::rollback();
            Session::flash('danger', $e->getMessage());

            $response['result'] = 'error';
            $response['message'] = $e->getMessage();
        }
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function product_attribute_update(Request $request, $id)
    {
        $response = [];
        // Get all request

        // Get all request
        $input=$request->all();

        // Initalize blank array
        $attr_model_list = [];
        $new_attr_list = [];

        // find current inseted attribute
        $old_attr_list = ProductAttribute::where('product_id',$id)->pluck('attribute_code')->all();
        if(isset($_POST['Attribute'])){
            foreach ($_POST['Attribute'] as $attr_key => $attr_value){

                // Find ProductAttribute
                $attr_model = ProductAttribute::where('product_id',$id)->where('attribute_code',$attr_key)->first();
                if(!$attr_model){
                    $attr_model = new ProductAttribute();
                }

                $attr_model->attribute_code = $attr_key;
                if(is_array($attr_value)){
                    $attr_value = implode('==',$attr_value);
                }

                // Prepare attribute data
                $attr_model->attribute_data = '=='.$attr_value.'==';

                $attr_model->product_id = $id;

                array_push($attr_model_list,$attr_model);
                array_push($new_attr_list,$attr_model->attribute_code);
            }
        }

        // Find difference attribute
        $removed_attr_list = array_diff($old_attr_list,$new_attr_list);

        // Transaction start
        DB::beginTransaction();
        try {

            // Save attribute
            if(count($attr_model_list) > 0){
                foreach ($attr_model_list as $attr){
                    $attr->save();
                }
            }

            // Delete attributee
            if(count($removed_attr_list) > 0){

                $del = DB::table('product_attribute')
                        ->where('product_id',$id)
                        ->whereIn('attribute_code',$removed_attr_list)
                        ->delete();

            }

            DB::commit();
            // Press Save & Continue
            $response['result'] = 'success';
            $response['message'] = 'Successfully updated Attribute!';


        } catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();

            $response['result'] = 'error';
            $response['message'] = $e->getMessage();
        }


        return $response;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find Product
        $data = \Auth::user();
        $model = Product::where('product.id', $id)->where('product.merchant_id', $data->id)
            ->select('product.*')
            ->first();

        DB::beginTransaction();
        try {
            // Category update
            if ($model->status == 'active') {
                $model->status = 'cancel';
            } else {
                $model->status = 'active';
            }

            $model->save();


            DB::commit();
            Session::flash('message', "Successfully Deleted.");

        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('danger', $e->getMessage());
        }

        // redirect to current page
        return redirect()->back();
    }


    public function duplicate(Request $request, $id)
    {
        //check product data
        $ckdata = \Auth::user();


        $product_check = Product::where('id', $id)->where('merchant_id', $ckdata->id)->first();


        if ($product_check) {
            // Check Slug
            $check_slug = Product::where('slug', $product_check->slug)
                ->first();

            // Find unique product
            if (count($check_slug) > 0 && $check_slug->id == $id) {
                // Slug presents in current id
                $product_update_required = 'yes';
            } elseif (count($check_slug) > 0 && $check_slug->id != $id) {
                // Slug present, but not in current id
                $product_update_required = 'no';
            } else {
                // Slug not present
                $product_update_required = 'yes';
            }


            if ($product_update_required == 'yes') {
                DB::beginTransaction();
                try {
                    // Update product basic info
                    $product_model = new Product();
                    $product_model->type = $product_check->type;
                    $product_model->title = $product_check->title . '-clone';
                    $product_model->slug = $product_check->slug . '-clone';
                    $product_model->item_no = $product_check->item_no . '-clone';
                    $product_model->sell_price = $product_check->sell_price;
                    $product_model->list_price = $product_check->list_price;
                    $product_model->offer_price = $product_check->offer_price;
                    $product_model->manufacturer_id = $product_check->manufacturer_id;
                    $product_model->attribute_set_id = $product_check->attribute_set_id;
                    $product_model->short_description = $product_check->short_description;
                    $product_model->description = $product_check->description;
                    $product_model->specification = $product_check->specification;
                    $product_model->status = $product_check->status;
                    $product_model->merchant_id = $ckdata->id;
                    $product_model->save();

                    if ($product_model) {

                        $check_brands_data = ProductBrand::where('product_id', $id)->pluck('brand_id')->all();
                        // If brand data is selected
                        if (isset($check_brands_data) && count($check_brands_data) > 0) {
                            // Find old brand
                            $old_brands = ProductBrand::where('product_id', $id)->pluck('brand_id')->all();
                            $new_brands = [];

                            foreach ($check_brands_data as $key => $brand_id) {
                                // Find brand in this product
                                $model = ProductBrand::where('brand_id', $brand_id)->where('product_id', $id)->first();

                                if ($model) {
                                    $model = new ProductBrand();
                                    $model->brand_id = $brand_id;
                                    $model->product_id = $product_model->id;
                                    $model->save();
                                } else {
                                    // New brand is found
                                    $model = new ProductBrand();
                                    $model->brand_id = $brand_id;
                                    $model->product_id = $product_model->id;
                                    $model->save();

                                }

                                // all brand push in new brand
                                array_push($new_brands, $model->brand_id);
                            }

                            // find differentiate in old brands & new brands
                            $removed_brands = array_diff($old_brands, $new_brands);

                            // Delete not selected brand
                            ProductBrand::where('product_id', $id)->whereIn('brand_id', $removed_brands)->delete();
                        }

                        //product seo clone

                        $check_seo_data = ProductSeo::where('product_id', $id)->first();

                        if (count($check_seo_data) > 0) {   // For update
                            $seo_data = new ProductSeo();

                            $seo_data->product_id = $product_model->id;
                            $seo_data->meta_title = $check_seo_data->meta_title;
                            $seo_data->meta_keywords = $check_seo_data->meta_keywords;
                            $seo_data->meta_description = $check_seo_data->meta_description;
                            $seo_data->meta_image_link = $check_seo_data->meta_image_link;

                            $seo_data->save();
                        }

                        //product inventory clone

                        $check_inventory_data = ProductInventory::where('product_id', $id)->first();

                        if (count($check_inventory_data) > 0) {   // For update
                            $inventory_data = new ProductInventory();

                            $inventory_data->product_id = $product_model->id;
                            $inventory_data->warehouse = $check_inventory_data->warehouse;
                            $inventory_data->item_number = $check_inventory_data->item_number;
                            $inventory_data->quantity = $check_inventory_data->quantity;
                            $inventory_data->note = $check_inventory_data->note;
                            $inventory_data->save();

                        }

                        //product variation clone

                        $product_data = Product::where('id', $id)->first();

                        if (!empty($product_data)) {
                            $variation_data = ProductVariation::where('product_variation.parent_product_id', $id)->where('product_id', $product_data->id)->exists();

                            if (!$variation_data) {

                                $variation_data = new ProductVariation();

                                $variation_data->parent_product_id = $product_model->id;
                                $variation_data->product_id = $product_data->id;
                                $variation_data->save();
                            }
                        }


                        //product category clone


                        $check_category = DB::table('product_category')->where('product_id', $id)->get();
                        if (!empty($check_category)) {

                            $old_category_array = [];
                            $new_category_array = [];

                            foreach ($check_category as $key => $value) {
                                array_push($old_category_array, $value->category_id);

                                $category_exits = DB::table('category')->where('status', 'active')->where('id', $value->category_id)->first();

                                if (!empty($category_exits)) {

                                    array_push($new_category_array, $category_exits->id);

                                    $already_presents_category_rel = DB::table('product_category')->where('product_id', $product_model->id)->where('category_id', $value->category_id)->first();


                                    if (empty($already_presents_category_rel)) {

                                        $category_model = new ProductCategory();

                                        $category_model->product_id = $product_model->id;
                                        $category_model->category_id = $value->category_id;

                                        $category_model->save();

                                    }

                                }

                            }

                            $deleted_category = array_diff($old_category_array, $new_category_array);
                            if (!empty($deleted_category)) {
                                DB::table('product_category')->whereIn('category_id', $deleted_category)->where('product_id', $product_model->id)->delete();
                            }
                        }




                        //product review clone

                        $check_review_data = ProductReview::where('product_id', $id)->first();

                        if (count($check_review_data) > 0) {   // For update
                            $seo_data = new ProductReview();

                            $seo_data->product_id = $product_model->id;
                            $seo_data->rating_value_score = $check_review_data->rating_value_score;
                            $seo_data->customer_id = $check_review_data->customer_id;
                            $seo_data->title = $check_review_data->title;
                            $seo_data->review = $check_review_data->review;
                            $seo_data->status = $check_review_data->status;
                            $seo_data->save();
                        }



                    }
                        // Get product inventory data


                    DB::commit();
                    Session::flash('success', 'Product Duplicate successfully');

                } catch (\Exception $e) {
                    //If there are any exceptions, rollback the transaction`
                    DB::rollback();
                    Session::flash('danger', $e->getMessage());
                }

            } else {
                Session::flash('danger', 'This slug already presents in another product, Please another one.');
            }


        }


        return redirect()->route('merchant.my.product');
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update_image(Requests\MerchantImageRequest $request, $id)
    {
        // Set mime type
        $mime_type_data = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        // Check product data
        $productdata = Product::where('product.id', $id)->first();

        if (count($productdata) > 0) {
            $slug = $productdata->slug;

            DB::beginTransaction();
            try {

                // Check image file exists or not
                if ($request->hasfile('file')) {

                    $count = 1;
                    foreach ($request->file('file') as $image) {

                        $image_info = getimagesize($image);

                        // check image dimension in width & height
                        if ((isset($image_info['0']) && $image_info['0'] != '1024') && isset($image_info['1']) && $image_info['1'] != '1024') {
                            Session::flash('error', 'Image size must be width 1024px & height 1024px');
                            break;
                        }

                        // Check image mime type
                        if (isset($image_info['mime']) && !in_array($image_info['mime'], $mime_type_data)) {
                            Session::flash('error', 'Invalid image type');
                            break;
                        }

                        // Check image size

                        if ($image->getClientSize() > 2e+6) {
                            Session::flash('error', 'Image size much bigget than 2M');
                            break;
                        }

                        // generate image name
                        $name = $slug . '-' . time() . '-' . $count . '.' . $image->getClientOriginalExtension();
                        $path_image_link = '/uploads/product';

                        // upload image & create directory
                        $this->image_upload($name, $image->getRealPath(), $path_image_link, $id);

                        // Prepare image_link field value

                        $image_link = $path_image_link . '/' . $id;

                        $model = DB::table('product_image')
                            ->insert([

                                'product_id' => $id,
                                'image_link' => $image_link,
                                'image' => $name,
                                'created_by' => Auth::user()->id,
                                'created_at' => date('Y-m-d h:i:s'),

                            ]);

                        // Check product image is uplode or not
                        if ($model) {
                            DB::commit();
                            Session::flash('message', 'Successfully updated!');
                        } else {
                            Session::flash('error', 'Image not inserted');
                        }

                        $count++;

                    } // end foreach


                } // end if


                    // Press Save & Continue
                if (isset($input['save_continue']) && $input['save_continue'] == 'Save & Continue') {
                    return redirect()->back();
                }



            } catch (\Exception $e) {
                        //If there are any exceptions, rollback the transaction`
                DB::rollback();
                Session::flash('danger', $e->getMessage());
            }

                // redirect to current page
        }

        return redirect()->back();

    }


    /**
     * @param string $image
     * @param string $destinationPath
     * @return array
     */

    public static function image_upload($image_name, $realpath, $destinationPath, $id)
    {
        // Check image name presents or not
        if ($image_name != '') {
            // get sizes
            $sizes = self::array_of_size();

            if (count($sizes) > 0) {
                $destinationPath = $destinationPath . "/" . $id;
                $uploaddestinationPath = $destinationPath;
                foreach ($sizes as $value) {

                    if ($value == 'orginal_image') {
                        $target_location = $uploaddestinationPath . '/' . 'orginal_image';
                        if (!Storage::disk('public')->exists($target_location)) {
                            $target_location = public_path($target_location);

                            File::makeDirectory($target_location, 0777, true, true);
                        }

                            // upload image
                        $destinationPath = public_path($target_location);

                        $img = Image::make($realpath);
                        $img->save($target_location . '/' . $image_name);
                    } elseif ($value != 'orginal_image') {
                       // create directory
                        $target_location = $uploaddestinationPath . '/' . $value . 'x' . $value;
                        if (!Storage::disk('public')->exists($target_location)) {
                            $target_location = public_path($target_location);

                            File::makeDirectory($target_location, 0777, true, true);
                        }

                        // upload image
                        $destinationPath = public_path($target_location);

                        $img = Image::make($realpath);
                        $img->resize($value, $value, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save($target_location . '/' . $image_name);
                    }

                }
            }

        }

        return true;

    }

    /**
     * @param $id
     * @return Views
     */
    public function image_show($id)
    {



        $pageTitle = "Product Image Show";

        // Find image option
        $data = ProductImage::find($id);
        $imageid = $data->id;

        if (count($data) > 0) {

            return view('Merchant::merchantproduct.show_image', compact('data', 'pageTitle', 'imageid'));

        }



    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function DeleteImage($id)
    {

        $check_image = ProductImage::where('product_image.id', $id)->first();

        if (count($check_image) > 0) {
            DB::beginTransaction();
            try {
                // Check sizes
                $sizes = self::array_of_size();

                if (count($sizes) > 0) {
                    foreach ($sizes as $value) {

                        if ($value == 'orginal_image') {
                            $imagePath = $check_image->image_link . '/' . 'orginal_image' . '/' . $check_image->image;

                            $realImagePath = public_path($imagePath);
                            // remove image from folder
                            if (file_exists($realImagePath)) {
                                unlink($realImagePath);
                            }
                        } elseif ($value != 'orginal_image') {

                            $imagePath = $check_image->image_link . '/' . $value . 'x' . $value . '/' . $check_image->image;

                            $realImagePath = public_path($imagePath);
                            // remove image from folder
                            if (file_exists($realImagePath)) {
                                unlink($realImagePath);
                            }
                        }


                    }
                }

                // delete image
                $deleteimage = DB::table('product_image')->where('product_image.id', $id)->delete();

                if ($deleteimage) {
                    DB::commit();
                    return 'true';
                } else {
                    return 'false';
                }

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                Session::flash('danger', $e->getMessage());
            }
        }



    }

}
