<?php

namespace App\Modules\Admin\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Http\Request;
use Auth;
use DB;
use Illuminate\Support\Facades\Session;
use App\Modules\Admin\Requests;
use Exception;
use url;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    
    protected $adminRedirectTo = RouteServiceProvider::HOME;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required',
            'password' => 'required',
        ]);
    }



    public function index()
    {

        if(Auth::check())
        {
            Session::flash('message', "You Have Already Logged In.");
            return redirect()->intended(config('global.prefix_name').'/dashboard');

        }else{

            return view('Admin::auth.login');
            
        }


    }

    /*
     * Post_login
     */
    public function post_login(Requests\LoginRequest $request)
    {
        $data = Input::all();

        if(count($data)>0){
            if(Auth::check() ){
                
                $user_type = Auth::user()->type;

                Session::flash('message', "You Have Already Logged In.");
                return redirect()->intended($this->adminRedirectTo);

            }else{
                $user_data_exists = DB::table('users')->where('email', $data['email'])->where(function ($query) {
                    $query->where('type', '=', 'admin');
                })->exists();


                if($user_data_exists)
                {
                    $user_data = DB::table('users')->where('email', $data['email'])->where(function ($query) {
                        $query->where('type', '=', 'admin');

                    })->first();
                    $check_password = Hash::check( $data['password'], $user_data->password);

                    //if password matched
                    if($check_password)
                    {
                        //if user is inactive
                        if($user_data->status=='inactive')
                        {
                            Session::flash('error', "Sorry! Your Account Is Inactive.Please Contact With Administrator To active Account.");
                        }
                        else
                        {
                            if(Auth::check())
                            {
                                Session::flash('message', "You are already Logged-in! ");

                            }else{
                                $attempt = Auth::attempt([
                                    'email' => $request->get('email'),
                                    'password' => $request->get('password'),
                                ]);

                                if($attempt)
                                {
                                    DB::beginTransaction();
                                    try{
                                        
                                        DB::commit();

                                    }catch ( \Exception $e ){
                                        //If there are any exceptions, rollback the transaction
                                        DB::rollback();
                                    }

                                    Session::flash('message', "Successfully  Logged In.");

                                }else{
                                    Session::flash('danger', "Password Incorrect.Please Try Again");
                                }
                            }
                            return redirect()->intended(config('global.prefix_name').'/dashboard');
                        }
                    }else{
                        Session::flash('danger', "Password Incorrect.Please Try Again!!!");
                    }
                }else{
                    Session::flash('danger', "UserName/Email does not exists.Please Try Again");

                }
                return redirect()->back();
            }
        }else{
            Session::flash('danger', "UserName/Email does not exists.Please Try Again");
            return redirect()->back();
        }


    }


     /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function logout(Request $request)
     {
        $this->guard()->logout();

       Session::invalidate();

        return redirect('/login');
    }

}