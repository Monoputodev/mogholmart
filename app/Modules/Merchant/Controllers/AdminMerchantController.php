<?php

namespace App\Modules\Merchant\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Merchant\Requests;
use App\Modules\Merchant\Models\Merchant;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use App\User;
use DB;
use Session;
use Auth;
use App;
use Image;
use File;
use Storage;


class AdminMerchantController extends Controller
{
    public function __construct()
    {
        $this->user_image_path = public_path('uploads/user');
        $this->user_image_relative_path = '/uploads/user';
    }
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
    
    protected $user_image_path;
    protected $user_image_relative_path;



    /**
     * CategoryController constructor.
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $pageTitle = 'Show All Merchant';

        $data=User::join('merchant_profiles','users.id','=','merchant_profiles.users_id')
                ->where('users.type','seller')
                ->select('users.email','users.first_name','users.last_name','users.merchant_agreement','users.status','users.image','users.mobile_no', 'users.id as user_id','merchant_profiles.*')
                ->get();

        return view('Merchant::adminmerchant.show_all_merchant', [
            'pageTitle' => $pageTitle,
            'data' => $data
        ]);

    }

   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_active()
    {   
        $pageTitle = 'Show All Active Merchant';

        $data=User::join('merchant_profiles','users.id','=','merchant_profiles.users_id')
                ->where('users.type','seller')
                ->where('users.status','active')
                ->select('users.email','users.first_name','users.last_name','users.merchant_agreement','users.status','users.image','users.mobile_no', 'users.id as user_id','merchant_profiles.*')
                ->get();

        return view('Merchant::adminmerchant.show_all_merchant', [
            'pageTitle' => $pageTitle,
            'data' => $data
        ]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_inactive()
    {   
        $pageTitle = 'Show All InActive Merchant';

        $data=User::join('merchant_profiles','users.id','=','merchant_profiles.users_id')
                ->where('users.type','seller')
                ->where('users.status','inactive')
                ->select('users.email','users.first_name','users.last_name','users.merchant_agreement','users.status','users.image','users.mobile_no', 'users.id as user_id','merchant_profiles.*')
                ->get();

        return view('Merchant::adminmerchant.show_all_merchant', [
            'pageTitle' => $pageTitle,
            'data' => $data
        ]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_agreement()
    {   
        $pageTitle = 'Show All Agreement Merchant';

        $data=User::join('merchant_profiles','users.id','=','merchant_profiles.users_id')
                ->where('users.type','seller')
                ->where('users.merchant_agreement','yes')
                ->select('users.email','users.first_name','users.last_name','users.merchant_agreement','users.status','users.image','users.mobile_no', 'users.id as user_id','merchant_profiles.*')
                ->get();

        return view('Merchant::adminmerchant.show_all_merchant', [
            'pageTitle' => $pageTitle,
            'data' => $data
        ]);

    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_nonagreement()
    {   
        $pageTitle = 'Show All Non Agreement Merchant';

        $data=User::join('merchant_profiles','users.id','=','merchant_profiles.users_id')
                ->where('users.type','seller')
                ->where('users.merchant_agreement','no')
                ->select('users.email','users.first_name','users.last_name','users.merchant_agreement','users.status','users.image','users.mobile_no', 'users.id as user_id','merchant_profiles.*')
                ->get();

        return view('Merchant::adminmerchant.show_all_merchant', [
            'pageTitle' => $pageTitle,
            'data' => $data
        ]);

    }

          /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = 'Merchant Add';

        return view('Merchant::adminmerchant.create', [
            'pageTitle' => $pageTitle,
            
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\AdminMerchantRegisterRequest $request)
    {
        // Get all input data
        $input = $request->all();

        // Check already presents or not
        $data = User::where('email',$input['email'])->exists();

        if(!$data)
        {
            // Image link 
            $user_image = $request->file('image');

            if($user_image) {
                $user_image_title = str_replace(' ', '-', $input['email'] . '.' . $user_image->getClientOriginalExtension());
                $user_image_link = $this->user_image_relative_path.'/'.$user_image_title;

            }else{
                $user_image_link = '';
                $user_image_title = '';
            }

            $input['image'] = $user_image_title;

            /* Transaction Start Here */
            DB::beginTransaction();
            try {

                $input['password']=Hash::make($request->password);
                // Store user data 
                $model = User::create($input);



                $check_user=DB::table('users')
                ->where('email',$input['email'])
                ->where('type','seller')
                ->first();

                if($check_user)
                {   
                    $model = DB::table('users')
                    ->where('users.id', $check_user->id)
                    ->update([
                        'password' => Hash::make($request->password),
                    ]);

                    $merchant_model= new Merchant();
                    $merchant_model->users_id = $check_user->id;
                    $merchant_model->shop_name = $input['shop_name'];
                    $merchant_model->fathers_name = $input['fathers_name'];
                    $merchant_model->age = $input['age'];
                    $merchant_model->nid = $input['nid'];
                    $merchant_model->tin_no = $input['tin_no'];
                    $merchant_model->shop_address = $input['shop_address'];
                    $merchant_model->shop_description = $input['shop_description'];
                    $merchant_model->shop_agreement = $input['shop_agreement'];
                    $merchant_model->agreement_date = $input['agreement_date'];
                    $merchant_model->first_contact_person_details = $input['first_contact_person_details'];
                    $merchant_model->agreement_details = $input['agreement_details'];
                    $merchant_model->second_contact_person_details = $input['second_contact_person_details'];
                    $merchant_model->save();

                    // Store category image
                    if($user_image != null){
                        $user_image->move($this->user_image_path, $user_image_title);
                    }

                }

                DB::commit();
                Session::flash('message', 'Merchant is added!');
                return redirect(config('global.prefix_name').'/all/merchant/list');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
               
                Session::flash('danger', $e->getMessage());
            }

        }else{
            Session::flash('info', 'This user already added!');
        }
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pageTitle = 'Merchant Details ';

        $data=User::join('merchant_profiles','users.id','=','merchant_profiles.users_id')
                ->where('users.id',$id)
                ->select('users.email','users.first_name','users.last_name','users.merchant_agreement','users.status','users.image','users.mobile_no', 'users.id','merchant_profiles.*')
                ->first();

        return view('Merchant::adminmerchant.show', [
            'pageTitle' => $pageTitle,
            'data' => $data
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $pageTitle = 'Merchant Update ';

        $data=User::join('merchant_profiles','users.id','=','merchant_profiles.users_id')
                ->where('users.id',$id)
                ->select('users.email','users.first_name','users.last_name','users.merchant_agreement','users.status','users.image','users.mobile_no', 'users.id as user_id','merchant_profiles.*')
                ->first();

        return view('Merchant::adminmerchant.edit', [
            'pageTitle' => $pageTitle,
            'data' => $data
        ]);
    }

    
      /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\AdminMerchantRegisterRequest $request, $id)
    { 
        
       // Get all input data
        $input = $request->all();
        
        // Check already presents or not
        $data = User::where('users.id',$id)->where('type','seller')->first();

        if($data)
        {
            $user_image = $request->file('image');

            if($user_image) {
                $user_image_title = str_replace(' ', '-', $input['email'] . '.' . $user_image->getClientOriginalExtension());
                $user_image_link = $this->user_image_relative_path.'/'.$user_image_title;
            }else{
                $user_image_link = $data->image;
                $user_image_title = $data->image;
            }

            $input['image'] = $user_image_title;

            /* Transaction Start Here */
            DB::beginTransaction();
            try {

                $result = $data->update($input);

                $merchant_model=Merchant::where('merchant_profiles.users_id', $data->id)->first();
                $merchant_model->users_id = $data->id;
                $merchant_model->shop_name = $input['shop_name'];
                $merchant_model->fathers_name = $input['fathers_name'];
                $merchant_model->age = $input['age'];
                $merchant_model->nid = $input['nid'];
                $merchant_model->tin_no = $input['tin_no'];
                $merchant_model->shop_address = $input['shop_address'];
                $merchant_model->shop_description = $input['shop_description'];
                $merchant_model->shop_agreement = $input['shop_agreement'];
                $merchant_model->agreement_date = $input['agreement_date'];
                $merchant_model->first_contact_person_details = $input['first_contact_person_details'];
                $merchant_model->agreement_details = $input['agreement_details'];
                $merchant_model->second_contact_person_details = $input['second_contact_person_details'];
                $merchant_model->save();

                if ($input['status']=='inactive' || $input['status']=='cancel') {

                    $model=DB::table('product')->where('merchant_id',$id)->update(['status'=>$input['status']]);
                }else{
                        $model=DB::table('product')->where('merchant_id',$id)->update(['status'=>$input['status']]);
                }
                if($user_image != null){
                    File::Delete($data->image);
                    $user_image->move($this->user_image_path, $user_image_title);
                }

                DB::commit();
                Session::flash('message', 'Merchant is Updated!');
                return redirect(config('global.prefix_name').'/all/merchant/list');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                print($e->getMessage());
                Session::flash('danger', $e->getMessage());
            }

        }else{
            Session::flash('info', 'This user already Updated!');
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
      $model =  User::where('users.id', $id)
            ->select('users.*')
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

        
        $pageTitle = 'Merchant Information';

        // User model initialize
        $model = User::join('merchant_profiles','users.id','=','merchant_profiles.users_id');

        if($this->isGetRequest())
        {
            // Search data found
            $search_keywords = trim(Input::get('search_keywords'));
            $model = $model->where(function ($query) use($search_keywords){
                    $query = $query->orWhere('users.email', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('users.first_name', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('users.last_name', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('users.merchant_agreement', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('users.status', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('users.mobile_no', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('merchant_profiles.shop_name', 'LIKE', '%'.$search_keywords.'%');
                });
            $data = $model->select('users.email','users.first_name','users.last_name','users.merchant_agreement','users.status','users.image','users.mobile_no', 'users.id as user_id','merchant_profiles.*')->paginate(30);
        }else{

            // If get data not found
            $data =User::join('merchant_profiles','users.id','=','merchant_profiles.users_id')
                ->where('users.type','seller')
                ->select('users.email','users.first_name','users.last_name','users.merchant_agreement','users.status','users.image','users.mobile_no', 'users.id as user_id','merchant_profiles.*')->paginate(30);
        }

        // Return view
        return view("Merchant::adminmerchant.show_all_merchant", compact('data','pageTitle'));
        

    }
    public function merchant_switch(Request $request)
    {   
        $pageTitle = 'Merchant Switching';

        $merchant_lists = [''=>'Please select Merchant']+User::join('merchant_profiles','users.id','=','merchant_profiles.users_id')
                ->where('users.type','seller')->pluck('merchant_profiles.shop_name','users.id')->all();


        return view("Merchant::adminmerchant.merchant_switting", compact('merchant_lists','pageTitle'));

    }
    
    public function merchant_switch_patch(Request $request)
    {   
       // Get all input data
        $input = $request->all();

        $getProduct=DB::table('product')
            ->where('product.merchant_id',$input['merchant_id_form'])
            ->update(['merchant_id' => $input['merchant_id_to']]);

        if ($getProduct) {
           
           $update_order=DB::table('order_details')
                       ->where('product_merchant_id',$input['merchant_id_form'])
                       ->update(['product_merchant_id'=>$input['merchant_id_to']]);
        }

        Session::flash('message', 'Merchant is Switching Successfully!');

        return redirect('merchant-switch');


    }

    public function admin_merchant_excell()
    {
       
        $pageTitle = 'Merchant Excel Sheet';

        $data=User::join('merchant_profiles','users.id','=','merchant_profiles.users_id')
                ->where('users.type','seller')
                ->select('users.email','users.first_name','users.last_name','users.merchant_agreement','users.status','users.image','users.mobile_no', 'users.id as user_id','merchant_profiles.*')
                ->get();

        return view('Merchant::adminmerchant.excell_form', [
            'pageTitle' => $pageTitle,
            'data' => $data
        ]);

    }

    public function admin_merchant_password_change($id)
    {
        $pageTitle = 'Merchant Password Chnage';

        $data = User::where('users.id',$id)->where('type','seller')->first();

        return view('Merchant::adminmerchant.password_change', [
            'pageTitle' => $pageTitle,
            'data' => $data
        ]);


    }

    public function admin_merchant_password_update(Request $request,$id)
    {
           $input = Input::all();

           Input::validate([
            'new_password' => 'min:6|required_with:retype_password|same:retype_password',
            'retype_password' => 'min:6'
        ]);
        $check_password = $input['new_password'] === $input['retype_password'];
        if ($check_password) {

            $model = DB::table('users')
            ->where('users.id', $id)
            ->update([
                'password' => Hash::make($input['new_password']),
            ]);

            if ($model) {
                Session::flash('message', "Password changed successfully.");
                return redirect(config('global.prefix_name').'/all/merchant/list');
            } else {
                Session::flash('danger', "Unable to change password.");
            }
        } else {
            Session::flash('danger', "Do not match confirm password");
        }

        return redirect()->back();
    }

}

