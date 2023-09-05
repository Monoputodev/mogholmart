<?php

namespace App\Modules\User\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Modules\User\Models\Roles;
use App\Modules\User\Requests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use DB;
use Session;
use Auth;
use Image;
use File;

class UserController extends Controller
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



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

  


    public function index()
    {   


        $pageTitle = "List of User Information";

        // Get Parent user data
        $data = User::Where('created_by',Auth::user()->id)->get();


        // return view
        return view("User::user.index", compact('data','pageTitle'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = "Add New User";

        // Roles List
        $roles_list = [''=>'Please select roles']+ Roles::pluck('title','id')->all();
        // return View
        return view("User::user.create", compact('roles_list','pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\UserRequest $request)
    {
        // Get all input data
        $input = $request->all();

        // Check already presents or not
        $data = User::where('email',$input['email'])->exists();

        if( !$data )
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

                $input['password']=Hash::make($input['password']);
                // Store user data 
                $user_data = User::create($input);

                $check_user=DB::table('users')
                ->where('email',$input['email'])
                ->where(function ($query) {
                            $query->where('type', '=', $input['type']);
                })->first();

                if($check_user){

                     $model = DB::table('users')
                     ->where('users.id', $check_user->id)
                     ->update([
                        'password' => Hash::make($request->password),
                    ]);

                        // Store category image
                    if($user_image != null){
                        $user_image->move($this->user_image_path, $user_image_title);
                    }

                }

                if ($user_data) {
                    DB::commit();

                }//end user data

                Session::flash('message', 'User is added!');
                return redirect(config('global.prefix_name').'/user/index');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                print($e->getMessage());
                exit();
                Session::flash('danger', $e->getMessage());
            }

        }else{
            Session::flash('info', 'This user already added!');
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pageTitle = 'View User Informations';

        // Find category data
        $data = User::where('users.id', $id)
                ->select('users.*')
                ->first();                    

        if(count($data) > 0)
        {
            // If found category
            return view("User::user.show", compact('data','pageTitle'));

        }else{
            // If category not found
            return redirect()->back();

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
       $pageTitle = "Update User";

        // Find user
        $data = User::where('users.id', $id)
                        ->select('users.*')
                        ->first();
       
        // If user not found                
        if(count($data) <= 0){
            Session::flash('danger', 'User not found.');
            return redirect()->route('admin.user.index');
        }

        $roles_list = ['' => 'Please select roles'] + Roles::pluck('title', 'id')->all();
        // Return view
        return view("User::user.edit", compact('data','roles_list','pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UserRequest  $request, $id)
    {
        $input = $request->all();
        $model = User::where('users.id', $id)
            ->select('users.*')
            ->first();

       
        $user_image = $request->file('image');

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
            return redirect(config('global.prefix_name').'/user/index');
        }
        catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            Session::flash('danger', $e->getMessage());
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

            $model->save();
            
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

        
        $pageTitle = 'User Information';

        // User model initialize
        $model = new User();

        if($this->isGetRequest())
        {
            // Search data found
            $search_keywords = trim(Input::get('search_keywords'));
            $model = $model->where(function ($query) use($search_keywords){
                    $query = $query->orWhere('email', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('users.status', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('first_name', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('last_name', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('type', 'LIKE', '%'.$search_keywords.'%');
                });
            $data = $model->where('id',auth()->id())->where('created_by',auth::user()->id)->select('users.*')->paginate(10);
        }else{

            // If get data not found
            $data = User::where('id',auth()->id())->where('created_by',auth::user()->id)->paginate(10);
        }

        // Return view
        return view("User::user.index", compact('data','pageTitle'));
        

    }

    /**
     * Change password
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function password_reset($id)
    {
       $pageTitle = "Password Reset";

        // Find user
        $data = User::where('users.id', $id)
                        ->select('users.*')
                        ->first();

        // If user not found                
        if(count($data) <= 0){
            Session::flash('danger', 'User not found.');
            return redirect()->route('admin.user.index');
        }

        // Return view
        return view("User::user.password_reset", compact('data','pageTitle'));
    }

    /**
     * Update Password
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_password(Requests\PasswordResetRequest  $request, $id)
    {
        // Auth checking
        $user = User::findOrFail($id);

        // Get all request
        $request = $request->all();

        // Get parameter
        $old_password = $request['old_password'];
        $newPassword = $request['password'];

        if(count($user) > 0)
        {
            // Transaction Start
            DB::beginTransaction();

            try {
                
                if (Hash::check($old_password, $user->password)) {

                    $model = DB::table('users')
                    ->where('id',$id)
                    ->update([
                        'password' => Hash::make($newPassword),
                    ]);

                    DB::commit();
                    Session::flash('message', 'Password Changed Successfully.');
                }
                else
                {
                    Session::flash('danger', 'Sorry! password not updated.');
                }
             } catch(\Exception $e) {
                DB::rollback();
                Session::flash('danger',$e->getMessage());
            }
    
        }
        
        // Redirect back to last step
        return redirect()->back();
    }
}
