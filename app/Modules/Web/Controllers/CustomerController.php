<?php
namespace App\Modules\Web\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Modules\Web\Requests;
use App\Http\Helpers\Postcode;
use App\Http\Controllers\Controller;
use App\Modules\Merchant\Models\Merchant;
use App\Modules\Web\Models\Division;
use App\Modules\Web\Models\Prescription;
use App\Modules\Newsletter\Models\Subscriptions;
use App\Modules\User\Models\UserBillingShipping;
use App\Modules\Product\Models\ProductReview;
use App\Modules\Order\Models\OrderHead;
use App\Modules\Order\Models\OrderShipping;
use App\Modules\Order\Models\OrderTransaction;
use App\Modules\Order\Models\OrderDetails;
use App\Modules\Product\Models\ProductInventory;
use App\Modules\Web\Models\Wishlist;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\URL;

use DB;
use Session;
use App\User;
use Auth;
use Hash;
use App;
use Str;
use Image;
use File;
use Storage;

class CustomerController extends Controller
{	
   
	protected $user_image_path;
    protected $user_image_relative_path;



    /**
     * CategoryController constructor.
     */
    public function __construct()
    {
        $this->user_image_path = public_path('uploads/user');
        $this->user_image_relative_path = '/uploads/user';
    }


	public function index()
    {   
        $pageTitle = 'Customer Account';
        if(Auth::check() && Auth::user()->type == 'customer')
        {
        	Session::flash('message', "You are already Logged-in! ");
        	return redirect()->route('customer.dashboard');
        }else{

        return view('Web::customer.account',compact('pageTitle'));
        }
    }

    public function register(Request $request)
    {
    	# code...
    	$pageTitle = 'Customer Register';
        if(Auth::check() && Auth::user()->type == 'customer')
        {
        	Session::flash('message', "You are already Logged-in! ");
        	return redirect()->route('customer.dashboard');
        }else{
        	return view('Web::customer.register',compact('pageTitle'));
    	}
    }

    //Validate Uk Post Code by calling postcode.io api

    public function validatePostCode(Request $request)
    {
        $response = [];
        $response['data'] = '';
        
        $query =$_POST["postcode"]; 

        $postcode = new Postcode();

        $model = $postcode->validate($query);

        
        
        if (!empty($model) && $model=='true') {
            
                $response['data'] .= '<span style="color:green">This is valid post code.</span>';
            
        }else{
                $response['data'] .= '<span style="color:red">This is in valid post code.</<span>';

        }

        $response['result'] = 'success';
        return $response;
    }


    public function do_register(Requests\RegisterRequest $request)
    {

    	# code...
    	$input = Input::all();
    	# validating the email
    	if (isset($input['email'])) {
    		if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
    			# code...
    			Session::flash('danger','Please Enter a Valid Email.');
    			return back();
    		}
    	}

    	$data=DB::table('users')->where('email',$input['email'])->exists(); #check email exists or not.
    	if(!$data){
    		$model = new User();
    		$model->first_name = $input['first_name'];
    		$model->last_name = $input['last_name'];
    		$model->email = $input['email'];
    		$model->password = Hash::make($request->password);
    		$model->mobile_no = $input['mobile_no'];
    		$model->status = 'inactive';
            $model->post_code = '';
    		$model->remember_token = md5(str_random(10));
    		$model->type = 'customer';
    		$model->save(); # Save Customer/Merchange Basic Information.

            # Subscribe Email
            if ($input['newsletter']=='1') {
            	if (isset($input['email'])) {
            		# code...
	            	$model= new Subscriptions;
	            	$model->email=$input['email'];
	            	$model->save();
            	}
            	
            }

            #Sending Conformation Email Code Here.
            $user=DB::table('users')
            ->where('email',$input['email'])
            ->where('type','customer')
            ->first();
            #Hashing password agin for user.
            $changepass=DB::table('users')
            ->where('email',$input['email'])
            ->update([
            	'password' => Hash::make($input['password']),
            ]);
    		/* Transaction Start Here */
            
            	if(isset($input['email']))
                {
                	$mail_body = \Illuminate\Support\Facades\View::make('Web::email._registration', ['user_data'=> $user]);
                    $contents = $mail_body->render();

                    $send_mail = \App\Http\Helpers\SendMail::fire($user->email, 'Sign Up Confirmation link', $contents, '');

                    if ($send_mail) {
                    	Session::flash('message', 'Please check your email for complete sign up.');
                    }

                }else{
                	Session::flash('message', 'Thank you for sign up, please stay with us.');
                }

                return redirect('customer/account');
                

    	}else{

    		Session::flash('danger', 'This email already taken.');

    	}

    	return back();

    }

    public function confirm_email($slug)
    {
    	$pageTitle = 'Confirm sign up email';

    	$user_data = User::where('users.remember_token', $slug)
    	->select('users.*')
    	->first();

    	if (!isset($user_data->remember_token)) {

    		Session::flash('danger', "Token not found.");
    		return redirect('customer/account');
    	}else{

    		$model=DB::table('users')
    		->where('users.remember_token', $slug)
    		->update([
    			'status' => 'active',
    			'remember_token' =>'',  
    		]);

    		Session::flash('message', "Thank You So Much For Your Registration, Please Sign In Here To Next Process.");

    		return redirect('customer/account');
    	}   
    }

    # For Login page

    public function post_login(Request $request)
    {
    	$input = Input::all();
    	$user_data = \Auth::user();

    	if(Auth::check() && $user_data->type != 'customer'){
    		Auth::logout();
    	}

    	if(count($input)>0){

    		if(Auth::check() && $user_data->type == 'customer')
    		{
    			Session::flash('message', "You Have Already Logged In.");

    			if($user_data->type == 'customer'){
    				return redirect()->route('customer.dashboard');
    			}
    		}
    		else
    		{
                //Check email is exists into this system
    			$user_data_exists = DB::table('users')
    			->where('email',$input['email'])
    			->where('type','customer')
    			->exists();

    			if($user_data_exists)
    			{
    				$user_data = DB::table('users')
    				->where('email',$input['email'])
    				->where('type','customer')
    				->first();

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
    								return redirect()->route('customer.dashboard');
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

    #Customer Dashboard funtion
    public function dashboard(Request $request)
    {
    	$pageTitle='Customer Dashboard';
    	$data=Auth::user();
    	return view('Web::customer.dashboard',compact('pageTitle','data'));
    }

    #Customer Profile 
    public function profile()
    {
    	$pageTitle="Personal Profile";

    	$customer_data=Auth::user();
        
        return view('Web::customer.profile',compact('pageTitle','customer_data'));
    }
    #Customer Profile Update
    public function do_customer_edit_information(Request $request)
    {
    	$input = Input::all();
        $model = User::where('users.id', Auth::user()->id)
            ->select('users.*')
            ->first();

       
        $user_image = Input::file('image');

        if($user_image) {
            $user_image_title = str_replace(' ', '-', $input['email'] . '.' . $user_image->getClientOriginalExtension());
            $user_image_link = $this->user_image_relative_path.'/'.$user_image_title;
        }else{
            $user_image_link = $model->image;
            $user_image_title = $model->image;
        }

        $input['image'] = $user_image_title;


        DB::beginTransaction();
        try {
            // Update user
           
           if($model->update($input)){

                if($user_image != null){
                    File::Delete($model->image);
                    $user_image->move($this->user_image_path, $user_image_title);
                }
                 DB::commit();
            }

            Session::flash('message', 'Successfully updated!');
            return back();
        }
        catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            Session::flash('danger', $e->getMessage());
        }

        return redirect()->back();
    }
    #Customer logout function
    public function customer_logout(){
    	Auth::logout();
    	return redirect('customer/account');
    }

    #Customer forget password
    public function resetpassword(){

    	$pageTitle = 'Forget Password';

        return view('Web::customer.forgetpass', [
            'pageTitle' => $pageTitle,
        ]);
    }

    #Send email for forget password

    public function sendmailtouser(Request $request)
    {
    	$user_data = \Auth::user();
    	$input = Input::all();
    	#Check email is exists into this system
    	
        $model=DB::table('users')
        	->where('users.email',$input['email'])
        	->update(['remember_token' => md5(str_random(10)) ]);

        $user = DB::table('users')
            ->where('email',$input['email'])
            ->where('type','customer')
            ->first();

        if(count($user)>0){

        	$mail_body = \Illuminate\Support\Facades\View::make('Web::email._password_email_template', ['user_data'=> $user]);
        	$contents = $mail_body->render();

        	$send_mail = \App\Http\Helpers\SendMail::fire($user->email, 'Reset Password Link');
        	if($send_mail) {
        		# code...
        	Session::flash('message', 'Please Check Your Email, and follow those instruction.');
        	}

        	return redirect()->back();
            	
        }else{

            Session::flash('danger', "Email incorrect.");
        }

        return redirect()->back();
    }

    public function change_form($slug)
    {
        $pageTitle = 'Forget Password';

        $data = User::where('users.remember_token', $slug)
                        ->select('users.*')
                        ->first();

        if (empty($data->remember_token)){

                Session::flash('danger', "Token not found.");
                return redirect('customer/account');
        }else{

        	return view('Web::customer.password_reset_form', [
                'pageTitle' => $pageTitle,
                'data' => $data,
               
            ]);
        } 
        
    }

     public function save_chage_password(Request $request){

        $user_data = \Auth::user();
        $input = Input::all();
        
        $check_password = $input['password'] === $input['password_confirmation'];
        if($check_password){

            $model=DB::table('users')
                    ->where('users.remember_token',$input['remember_token'])
                    ->update([
                        'password' => Hash::make($input['password']),
                        'remember_token' =>'',  
                    ]);
                    
            if($model){
                Session::flash('message', "Password changed successfully.");
                return redirect('customer/account');
            }else{
                Session::flash('danger', "Unable to change password.");
            }
        }else{
            Session::flash('danger', "Do not match confirm password");
        }

        return redirect()->back();


    } 

    #Change Password Function works when customer login there panel

    public function change_password()
    {
    	$pageTitle='Change Password Form';

    	if(Auth::check() && Auth::user()->type == 'customer')
        {
        	return view('Web::customer.password_change',compact('pageTitle'));

        }else{
        	Session::flash('danger', "You are not Logged-in! ");
        	return redirect()->route('web.customer.account');
    	}

    }

    public function change_password_submit(Request $request){

        $user_data = \Auth::user();
        $input = Input::all();
        
        $check_password = $input['password'] === $input['password_confirmation'];
        if($check_password){

            $model=DB::table('users')
                    ->where('users.email',$user_data->email)
                    ->update([
                        'password' => Hash::make($input['password']),
                    ]);
                    
            if($model){
                Session::flash('message', "Password changed successfully.");
                return redirect('customer/dashboard');
            }else{
                Session::flash('danger', "Unable to change password.");
            }
        }else{
            Session::flash('danger', "Do not match confirm password");
        }
        return redirect()->back();
    } 

    public function prescription(Request $request)
    {
        $pageTitle = 'Upload Prescription';

        $user_data = \Auth::user();

        if(empty($user_data)){
            return redirect()->intended('customer/account');
        }

        if($user_data->type != 'customer'){
            return redirect()->intended('customer/account');
        }

        $imagedata=Prescription::where('user_id',$user_data->id)->get();

        return view('Web::customer.prescription',compact('pageTitle','imagedata'));

    }

    public function prescriptionStore(Request $request)
    {

        $user_data = \Auth::user();

        if(empty($user_data)){
            return redirect()->intended('customer/account');
        }

        if($user_data->type != 'customer'){
            return redirect()->intended('customer/account');
        }

        // Set mime type 
        $mime_type_data = ['image/jpeg','image/jpg','image/png','image/gif'];
        
            $slug='prescription';  
            $id=$user_data->id;  

            DB::beginTransaction();
            try {

                // Check image file exists or not
                if($request->hasfile('file')){
                   
                   $count = 1;
                    foreach($request->file('file') as $image)
                    { 

                        $image_info = getimagesize($image);
                        // Check image mime type
                        if(isset($image_info['mime']) && !in_array($image_info['mime'], $mime_type_data))
                        {
                            Session::flash('error', 'Invalid image type');    
                            break;
                        }

                        // Check image size
                        if($image->getClientSize() > 2e+6)
                        {
                            Session::flash('error', 'Image size much bigget than 2M');    
                            break;   
                        }
                       
                        // generate image name
                        $name=$slug.'-'.time().'-'.$count.'.'.$image->getClientOriginalExtension();
                        $path_image_link='/uploads/prescription';

                        // upload image & create directory
                        $this->image_upload($name,$image->getRealPath(),$path_image_link,$id);

                        // Prepare image_link field value
                        

                        $model=DB::table('user_prescription')
                        ->insert([

                            'user_id' => $id,
                            'image_link' =>  $name,  
                            'comment' =>$request->comment,
                            'status' =>'active',
                            'created_by'=>Auth::user()->id,
                            'created_at'=>date('Y-m-d h:i:s'),  
                           
                        ]);

                        // Check product image is uplode or not
                        if($model){
                            DB::commit();
                            Session::flash('success', 'Successfully Uploaded!'); 
                        }else{
                            Session::flash('error', 'Image not inserted');    
                        } 

                        $count++;

                    } // end foreach

                           
                    } // end if

                                        
                   
                }catch (\Exception $e) {
                        //If there are any exceptions, rollback the transaction`
                    DB::rollback();
                    Session::flash('danger', $e->getMessage());
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
        if ($image_name != '')
        {   
            $destinationPath = $destinationPath."/".$id;
            $uploaddestinationPath = $destinationPath;

            $target_location = $uploaddestinationPath;
            if (!Storage::disk('public')->exists($target_location)) 
            {
                $target_location = public_path($target_location);

                File::makeDirectory($target_location, 0777, true, true);         
            }

                        // upload image
            $destinationPath =  public_path($target_location);

            $img = Image::make($realpath);
            $img->save($target_location.'/'.$image_name);    
        }

        return true;

    }


     /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function DeleteImage($id)
    {
        $response = [];

        $check_image=Prescription::where('id',$id)->first();

        if(count($check_image) > 0)
        {
            DB::beginTransaction();
            try {

            $imagePath = '/'.'uploads/prescription'.'/'.$check_image->user_id.'/'.$check_image->image_link;

               $realImagePath = public_path($imagePath);
                // remove image from folder
               if(file_exists($realImagePath)){
                unlink($realImagePath);
            }
               
        
                // delete image
                $deleteimage=Prescription::where('id',$id)->delete();
               
                if($deleteimage)
                {
                    DB::commit();
                    $response['result'] = 'success';    
                }else{
                    $response['result'] = 'error';
                }
                
            }catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                Session::flash('danger', $e->getMessage());
            }

        }
            return $response;
    }

    #Customer Address [Billing & Shipping Address]

    public function address()
    {

        $pageTitle = "My Address ";

        $user_data = \Auth::user();
        if(empty($user_data)){
            return redirect()->intended('customer/account');
        }
        if($user_data->type != 'customer'){
            return redirect()->intended('customer/account');
        }
        #Redirection End

        $billing_address = DB::table('users_billing_shipping')
        ->where('users_billing_shipping.type','billing')
        ->where('users_billing_shipping.users_id',$user_data->id)
        ->first(['users_billing_shipping.*']);

        $shipping_address = DB::table('users_billing_shipping')
        ->where('users_billing_shipping.type','shipping')
        ->where('users_billing_shipping.users_id',$user_data->id)
        ->get(['users_billing_shipping.*']);

        

        return view('Web::customer.customer_address', [
            'pageTitle'=>$pageTitle,
            'user_data' => $user_data,
            'billing_address' => $billing_address,
            'shipping_address' => $shipping_address,
            
        ]);
    }

    public function area(Request $request)
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

    public function store_billing_shipping (Requests\UsersBillingShippingRequest $request)
    {
        $input = Input::all();

        $user_data = \Auth::user();

        if(empty($user_data))
        {
            return redirect()->intended('customer/account');
        }

        if($user_data->type != 'customer'){
            return redirect()->intended('customer/account');
        }

        $type = $input['type'];

        if($type == 'billing')
        {
            $exists_billing_shipping_data = DB::table('users_billing_shipping')->where('users_id',$input['users_id'])->where('type','billing')->exists();

            if($exists_billing_shipping_data){
                Session::flash('danger', 'Already added billing address, please select shipping');

                return redirect()->back();
            }
        }

        /* Transaction Start Here */
        DB::beginTransaction();
        try {

            $users_billing_shipping_model = new UserBillingShipping();
            if($users_billing_shipping_model->create($input))
            {
                
            	DB::commit();
            }


            Session::flash('message', 'The billing/shipping information added.');
            return back();

        } catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            Session::flash('danger', $e->getMessage());
            
        }

        //return redirect()->back();
    
    }

    public function edit_billing_address ($id)
    {
        $response = [];

        $user_data = \Auth::user();

        if(empty($user_data)){
            return redirect()->intended('customer/account');
        }

        if($user_data->type != 'customer'){
            return redirect()->intended('customer/account');
        }

        $billing_shipping_data = DB::table('users_billing_shipping')->where('users_id',$user_data->id)->where('id',$id)->first();

        if(!isset($billing_shipping_data)){
            return redirect()->intended('customer/account');
        }

       if(!empty($billing_shipping_data))
        {   
        	
            $view = \Illuminate\Support\Facades\View::make('Web::customer.edit_billing_shipping_info',compact('billing_shipping_data','pageTitle','user_data'));

            $contents = $view->render();

            $response['result'] = 'success';
            $response['content'] = $contents;

        }else{

            $response['result'] = 'error';

        }

        return $response;

    }

    public function update_billing_shipping_address(Requests\UsersBillingShippingRequest $request, $id)
    {

        $input = Input::all();

        $pageTitle = "Update Billing OR Shipping Address";

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
            // Update
            $result = $billing_shipping_data->update($input);
                DB::commit();

            Session::flash('message', 'Successfully updated!');
            return redirect()->back();
        }
        catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            Session::flash('danger', $e->getMessage());
        }

        return redirect()->back();
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

    /*Product Reveie By Customer*/

    public function ReviewStore()
    {
        $response = [];

        if(isset($_POST) && !empty($_POST['rating_value_score']) && !empty($_POST['title']) && !empty($_POST['review']) ){

            $user_data = \Auth::user();
            if(empty($user_data)){
                return redirect()->intended('customer/account');
            }
            if($user_data->type != 'customer'){
                return redirect()->intended('customer/account');
            }
            $input_data = [
                'product_id'   =>  $_POST['product_id'],
                'rating_value_score'   =>  $_POST['rating_value_score'],
                'customer_id'    =>   $_POST['customer_id'],
                'title'        =>  $_POST['title'],
                'review' =>  $_POST['review'],
                'status'            =>  'inactive',
            ];

            /* Transaction Start Here */
            DB::beginTransaction();
            try {

                if(ProductReview::create($input_data))
                {
                    DB::commit();

                    $response['result'] = 'success';
                    $response['message'] = 'Reviews has been successfully submitted';
                }

            }catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                $response['result'] = 'error';
                $response['message'] = $e->getMessage();
                
            }
        }else{
            $response['result'] = 'error';
            $response['message'] = 'Please filled up required field';
        }
        return $response;
    }

    #Customer Wishlist Store

    public function WishlistStore (Request $request){

        $response = [];

        $input = Input::all();

        if(!\Auth::user()){
            $response['result'] = 'error';
            $response['message'] = 'Please login your account to wishlist this item.';
            return $response;
        }

        $user_data = \Auth::user();

        $product_id = $input['product_id'];
        if(count($product_id) > 0){

            $check_exist = Wishlist::where('users_id',$user_data->id)->where('product_id',$product_id)->first();

            if(!$check_exist){
                $model = new Wishlist();
                $model->users_id = $user_data->id;
                $model->product_id = $product_id;
                $model->save();

                $response['result'] = 'success';
                $response['message'] = 'Product successfully added to wishlist.';


            }else{
                $response['result'] = 'already_added';
                $response['message'] = 'Product already added to your wishlist.';
            }
        }else{

            $response['result'] = 'already_added';
            $response['message'] = 'Product already added to your wishlist.';

        }


        $total_items = Wishlist::where('users_id',$user_data->id)->count();
        $response['total_item'] = $total_items;
        
        return $response;
    }

    #Customer Wishlist
    public function wishlist()
    {

        $pageTitle = "Customer Wishlist";

        $user_data = \Auth::user();

        if(empty($user_data)){
            return redirect()->intended('customer/account');
        }

        if($user_data->type != 'customer'){
            return redirect()->intended('customer/account');
        }

        // WishList
        $wishlist_data = Wishlist::where('users_id',$user_data->id)->orderby('id','desc')->paginate(30);
        
        return view('Web::customer.wishlist', [
            'pageTitle'=>$pageTitle,
            'user_data' => $user_data,
            'wishlist_data' => $wishlist_data,

        ]);

    }

    #Customer Wishlist Item Remove
    public function RemoveWishlistItem($id)
    {
         // Find Wishlist
        $user_data = \Auth::user();

        $model = Wishlist::where('product_id',$id)
                ->where('users_id',$user_data->id)
                ->first();

        DB::beginTransaction();
        try {
           
            if($model->delete())
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
     * Instantiate a customer order history.
     *
     * View all order history by [todyas,last week, last month]
     */

    public function CustomerOrder()
    {
        $pageTitle = 'Order History';

        $user_data = \Auth::user();

        if(empty($user_data)){
            return redirect()->intended('customer/account');
        }

        if($user_data->type != 'customer'){
            return redirect()->intended('customer/account');
        }

        $todate=date('Y-m-d');

        $toyear = date("Y", strtotime($todate)); 
        $tomonth = date("m");

        $form_date=date('Y-m-d', strtotime('-15 days'));

        $todays_order=OrderHead::where('order_head.users_id',\Auth::user()->id)
                                ->whereDate('order_head.date', '>=', date('Y-m-d'))
                                ->select('order_head.id')
                                ->count();

        $last_15_days_order=OrderHead::where('order_head.users_id', \Auth::user()->id)
                            ->whereBetween('order_head.date', [$form_date,$todate])
                            ->select('order_head.id')
                            ->count();

        $current_month_order=OrderHead::where('order_head.users_id', \Auth::user()->id)
                                ->whereMonth('order_head.date',$tomonth)
                                ->select('order_head.id')
                                ->count();

        $total_order=OrderHead::where('order_head.users_id', \Auth::user()->id)
                                ->select('order_head.id')
                                ->count();

        $order_data = OrderHead::where('users_id',$user_data->id)->orderby('id','desc')->paginate(30);

        return view('Web::customer.order_history', [
            'pageTitle'=>$pageTitle,
            'user_data' => $user_data,
            'order_data' => $order_data,
            'todays_order' => $todays_order,
            'last_15_days_order' => $last_15_days_order,
            'current_month_order' => $current_month_order,
            'total_order' => $total_order,
        ]);
    }


    public function show_order($id)
    {

        $user_data = \Auth::user();

        if(empty($user_data)){
            return redirect()->intended('customer/account');
        }

        if($user_data->type != 'customer'){
            return redirect()->intended('customer/account');
        }

        $data = OrderHead::with('relOrderDetail', 'relOrderShipping')->where('order_head.users_id',$user_data->id)->where('order_head.id', $id)->first();

        $pageTitle = 'Invoice Number :: ' . $data->order_number;


        return view('Web::customer.order_show', ['data' => $data,
            'pageTitle' => $pageTitle,
            'user_data' => $user_data,
           
        ]);
    }

    public function todays_order(){
        $pageTitle = 'Customer todays order';

        $user_data = \Auth::user();

        if(empty($user_data)){
            return redirect()->intended('customer/account');
        }

        if($user_data->type != 'customer'){
            return redirect()->intended('customer/account');
        }

         $todate=date('Y-m-d');

        $toyear = date("Y", strtotime($todate)); 
        $tomonth = date("m");

        $form_date=date('Y-m-d', strtotime('-15 days'));

        $todays_order=OrderHead::where('order_head.users_id',\Auth::user()->id)
                                ->whereDate('order_head.date', '>=', date('Y-m-d'))
                                ->select('order_head.id')
                                ->count();


        $last_15_days_order=OrderHead::where('order_head.users_id', \Auth::user()->id)
                            ->whereBetween('order_head.date', [$form_date,$todate])
                            ->select('order_head.id')
                            ->count();

        $current_month_order=OrderHead::where('order_head.users_id', \Auth::user()->id)
                                ->whereMonth('order_head.date',$tomonth)
                                ->select('order_head.id')
                                ->count();

        $total_order=OrderHead::where('order_head.users_id', \Auth::user()->id)
                                ->select('order_head.id')
                                ->count();

        $order_data = OrderHead::where('users_id',$user_data->id)->whereDate('order_head.date', '>=', date('Y-m-d'))->orderby('id','desc')->paginate(30);

        

        return view('Web::customer.order_history', [
            'pageTitle'=>$pageTitle,
            'user_data' => $user_data,
            'order_data' => $order_data,
            'todays_order' => $todays_order,
            'last_15_days_order' => $last_15_days_order,
            'current_month_order' => $current_month_order,
            'total_order' => $total_order,
        ]);
    }

    public function fifteen_todays_order(){
        $pageTitle = 'Customer fifteen days order';

        $user_data = \Auth::user();

        if(empty($user_data)){
            return redirect()->intended('customer/account');
        }

        if($user_data->type != 'customer'){
            return redirect()->intended('customer/account');
        }

         $todate=date('Y-m-d');

        $toyear = date("Y", strtotime($todate)); 
        $tomonth = date("m");

        $form_date=date('Y-m-d', strtotime('-15 days'));

        $todays_order=OrderHead::where('order_head.users_id',\Auth::user()->id)
                                ->whereDate('order_head.date', '>=', date('Y-m-d'))
                                ->select('order_head.id')
                                ->count();


        $last_15_days_order=OrderHead::where('order_head.users_id', \Auth::user()->id)
                            ->whereBetween('order_head.date', [$form_date,$todate])
                            ->select('order_head.id')
                            ->count();

        $current_month_order=OrderHead::where('order_head.users_id', \Auth::user()->id)
                                ->whereMonth('order_head.date',$tomonth)
                                ->select('order_head.id')
                                ->count();

        $total_order=OrderHead::where('order_head.users_id', \Auth::user()->id)
                                ->select('order_head.id')
                                ->count();

        $order_data = OrderHead::where('users_id',$user_data->id)->whereBetween('order_head.date', [$form_date,$todate])->orderby('id','desc')->paginate(30);

        
        return view('Web::customer.order_history', [
            'pageTitle'=>$pageTitle,
            'user_data' => $user_data,
            'order_data' => $order_data,
            'todays_order' => $todays_order,
            'last_15_days_order' => $last_15_days_order,
            'current_month_order' => $current_month_order,
            'total_order' => $total_order,
        ]);
    }

    public function current_month_order(){
        $pageTitle = 'Customer current month order';

        $user_data = \Auth::user();

        if(empty($user_data)){
            return redirect()->intended('customer/account');
        }

        if($user_data->type != 'customer'){
            return redirect()->intended('customer/account');
        }

         $todate=date('Y-m-d');

        $toyear = date("Y", strtotime($todate)); 
        $tomonth = date("m");

        $form_date=date('Y-m-d', strtotime('-15 days'));

        $todays_order=OrderHead::where('order_head.users_id',\Auth::user()->id)
                                ->whereDate('order_head.date', '>=', date('Y-m-d'))
                                ->select('order_head.id')
                                ->count();


        $last_15_days_order=OrderHead::where('order_head.users_id', \Auth::user()->id)
                            ->whereBetween('order_head.date', [$form_date,$todate])
                            ->select('order_head.id')
                            ->count();

        $current_month_order=OrderHead::where('order_head.users_id', \Auth::user()->id)
                                ->whereMonth('order_head.date',$tomonth)
                                ->select('order_head.id')
                                ->count();

        $total_order=OrderHead::where('order_head.users_id', \Auth::user()->id)
                                ->select('order_head.id')
                                ->count();

        $order_data = OrderHead::where('users_id',$user_data->id)->whereMonth('order_head.date',$tomonth)->orderby('id','desc')->paginate(30);

       

        return view('Web::customer.order_history', [
            'pageTitle'=>$pageTitle,
            'user_data' => $user_data,
            'order_data' => $order_data,
            'todays_order' => $todays_order,
            'last_15_days_order' => $last_15_days_order,
            'current_month_order' => $current_month_order,
            'total_order' => $total_order,
        ]);
    }

    public function change_order_refund(Requests\CustomerChangeOrderRefundRequest $request)
    {

        // Get all request
        $input = Input::all();
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
        if($data->save())
        {
            $mail_body = \Illuminate\Support\Facades\View::make('Order::order.order_canceled_email', ['data'=> $data]);
            $contents = $mail_body->render();
            $send_mail = \App\Http\Helpers\SendMail::fire($customer_email, 'Order canceled mail', $contents, '');
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



}

