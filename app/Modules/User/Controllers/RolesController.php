<?php

namespace App\Modules\User\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\User\Models\Roles;
use App\Modules\User\Models\Permission;
use App\Modules\User\Models\RolesPermission;
use App\Modules\User\Models\RolesUser;
use App\Modules\User\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\User;
use File;
use Illuminate\Http\Request;


class RolesController extends Controller
{

    /**
     * @return bool
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
     * RolesController constructor.
     */
    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = "Role Lists";

        // Get Roles data
        $data = Roles::select('roles.*')->where('status','active')->get();


        // return view
        return view("User::roles.index", compact('data', 'pageTitle'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = "Add New Roles";

        // return View
        return view("User::roles.create", compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Requests\RolesRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\RolesRequest $request)
    {
        // Get all input data
        $input = $request->all();
        //making slug for the roles
        $input['slug'] = str_slug($input['title']);

        // Check already presents or not
        $data = Roles::where('slug', $input['slug'])->exists();

        if (!$data) {


            /* Transaction Start Here */
            DB::beginTransaction();
            try {

                // Store cateogory data 
                $roles_data = Roles::create($input);


                DB::commit();
                Session::flash('message', 'Role is added!');
                return redirect(config('global.prefix_name').'/roles/index');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                Session::flash('danger', $e->getMessage());
            }

        } else {
            Session::flash('info', 'This role already added!');
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pageTitle = 'View Roles';

        // Find roles data
        $data = Roles::where('id', $id)
            ->select('roles.*')
            ->first();

        if (count($data) > 0) {
            // If found roles
            return view("User::roles.show", compact('data', 'pageTitle'));

        } else {
            // If roles not found
            return redirect()->back();

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pageTitle = "Update Roles";

        // Find roles
        $data = Roles::where('id', $id)
            ->select('roles.*')
            ->first();

        // If roles not found                
        if (count($data) <= 0) {
            Session::flash('danger', 'Role not found.');
            return redirect()->route('admin.roles.index');
        }

        // Return view
        return view("User::roles.edit", compact('data', 'pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\RolesRequest $request, $id)
    {
        $input = $request->all();
        //making slug for the roles
        $input['slug'] = str_slug($input['title']);

        // Find roles
        $model = Roles::where('id', $id)->select('roles.*')->first();

        DB::beginTransaction();
        try {
            // Update category
            $result = $model->update($input);

            if ($result) {

                DB::commit();
            }

            Session::flash('message', 'Successfully updated!');
            return redirect(config('global.prefix_name').'/roles/index');
        } catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            Session::flash('danger', $e->getMessage());
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find roles

        $model = Roles::where('id', $id)
            ->select('roles.*')
            ->first();

        DB::beginTransaction();
        try {
            // Roles update
            if ($model->status == 'active') {
                $model->status = 'cancel';
            } else {
                $model->status = 'active';
            }

            if ($model->save()) {

            }

            DB::commit();
            Session::flash('message', "Successfully Deleted.");

        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('danger', $e->getMessage());
        }

        // redirect to current page
        return redirect()->back();
    }


    public function search(Request $request)
    {


        $pageTitle = 'Roles Information';

        // Roles model initialize
        $model = new Roles();

        if ($this->isGetRequest()) {
            // Search data found
            $search_keywords = trim(Input::get('search_keywords'));
            $model = $model->where(function ($query) use ($search_keywords) {
                $query = $query->orWhere('title', 'LIKE', '%' . $search_keywords . '%');
                $query = $query->orWhere('roles.status', 'LIKE', '%' . $search_keywords . '%');
                $query = $query->orWhere('slug', 'LIKE', '%' . $search_keywords . '%');
            });
            $data = $model->select('roles.*')->where('status','active')->orderBy('id', 'desc')->paginate(10);
        } else {

            // If get data not found
            $data = Roles::where('status','active')->orderBy('id', 'desc')->paginate(10);
        }

        // Return view
        return view("User::roles.index", compact('data', 'pageTitle'));


    }

    //roles permissioon part

    public function roles_permission_index()
    {
        $pageTitle = "Role Lists";

        // Get Roles data
        $data = Roles::where('status','active')->select('roles.*')->get();


        // return view
        return view("User::rolespermission.index", compact('data', 'pageTitle'));
    }


    public function roles_permission($id)
    {
        $pageTitle = "Update Roles Permission ";

        // Find Permission set
        $data = Roles::find($id);
        //Get Permission id for assigend store

        $roles_id = $data->id;


        // Get permission data

        $permission_list = DB::table("permission")
            ->select('permission.*')
            ->whereNOTIn('id', function ($query) use ($data) {
                $query->select('permission_id')
                    ->from('roles_permission')
                    ->where('roles_id', $data->id);
            })
            ->where('permission.status', 'active')
            ->orderBy('id', 'asc')
            ->get();


        $asssigned_roles = RolesPermission::where('roles_id', $data->id)->get();


        // If Roles not found                
        if (empty($data)) {
            Session::flash('danger', 'Roles Permission not found.');
            return redirect()->route('admin.roles.permission.index');
        }

        // Return view
        return view("User::rolespermission.roles_permission_form", compact('data', 'pageTitle', 'permission_list', 'asssigned_roles', 'roles_id'));
    }


    public function assigned_store(Request $request)
    {
//        dd($request->unassigned_permission);


        $roles_id = $request->roles_id;

        $data = Roles::where('id', $roles_id)->first();

        if ($data) {
            /* Transaction Start Here */
            DB::beginTransaction();
            try {

                if (count($request->unassigned_permission) > 0) {

                    for ($i = 0; $i < count($request->unassigned_permission); $i++) {

                        $model = new RolesPermission();
                        $model->roles_id = $request->roles_id;
                        $model->permission_id = $request->unassigned_permission[$i];
                        $model->status = "active";
                        $model->save();
                        DB::commit();
                    }


                }


                //return redirect('admin-attribute-set-index');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                print($e->getMessage());
                Session::flash('danger', $e->getMessage());
                exit();
            }
        } else {
            Session::flash('message', 'Roles Permission not found!');
        }
        return redirect()->back();
    }


    public function unassigned_store(Request $request)
    {

        $roles_id = $request->roles_id;

        $data = Roles::where('id', $roles_id)->first();

        if ($data) {

            /* Transaction Start Here */
            DB::beginTransaction();
            try {

                if (count($request->assigned_permission) > 0) {

                    for ($i = 0; $i < count($request->assigned_permission); $i++) {

                        $model = RolesPermission::where('id', $request->assigned_permission[$i])
                            ->where('roles_id', $roles_id)
                            ->delete();

                        DB::commit();

                        Session::flash('message', 'Roles Permission is Unassigned!');

                    }

                }


                //return redirect('admin-attribute-set-index');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                Session::flash('danger', $e->getMessage());
            }

        } else {
            Session::flash('message', 'Roles Permission not found!');
        }

        return redirect()->back();
    }

    public function roles_user_index()
    {
        $pageTitle = "User Lists";

        // Get Roles data
        $data = User::where('status','active')->where('type', 'admin')->select('users.*')->get();


        // return view
        return view("User::userrole.index", compact('data', 'pageTitle'));
    }

    public function roles_user($id)
    {
        $pageTitle = "Update Roles User ";

        // Find User 
        $data = User::find($id);
        //Get User id for assigend store

        $user_id = $data->id;


        // Get permission data

        $role_user_list = DB::table("roles")
            ->select('roles.*')
            ->whereNOTIn('id', function ($query) use ($data) {
                $query->select('roles_id')
                    ->from('roles_user')
                    ->where('user_id', $data->id);
            })
            ->where('roles.status', 'active')
            ->orderBy('id', 'asc')
            ->get();


        $asssigned_roles = RolesUser::where('status','active')->where('user_id', $data->id)->get();


        // If Roles not found                
        if (empty($data)) {
            Session::flash('danger', 'Roles User not found.');
            return redirect()->route('admin.roles.user.index');
        }

        // Return view
        return view("User::userrole.roles_user_form", compact('data', 'pageTitle', 'role_user_list', 'asssigned_roles', 'user_id'));
    }

    public function assigned_role_store(Request $request)
    {


        $user_id = $request->user_id;

        $data = User::where('id', $user_id)->first();

        if ($data) {
            /* Transaction Start Here */
            DB::beginTransaction();
            try {

                if (count($request->unassigned_user) > 0) {

                    for ($i = 0; $i < count($request->unassigned_user); $i++) {

                        $model = new RolesUser();
                        $model->user_id = $request->user_id;
                        $model->roles_id = $request->unassigned_user[$i];
                        $model->status = "active";
                        $model->save();
                        DB::commit();
                    }


                }


                //return redirect('admin-attribute-set-index');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                print($e->getMessage());
                exit();
                Session::flash('danger', $e->getMessage());
            }
        } else {

            Session::flash('message', 'Roles User not found!');

        }
        return redirect()->back();
    }

    public function unassigned_role_store(Request $request)
    {

        $user_id = $request->user_id;

        $data = User::where('id', $user_id)->first();

        if ($data) {

            /* Transaction Start Here */
            DB::beginTransaction();
            try {

                if (count($request->assigned_user) > 0) {

                    for ($i = 0; $i < count($request->assigned_user); $i++) {

                        $model = RolesUser::where('id', $request->assigned_user[$i])
                            ->where('user_id', $user_id)
                            ->delete();

                        DB::commit();

                        Session::flash('message', 'Roles User is Unassigned!');

                    }

                }


                //return redirect('admin-attribute-set-index');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                print($e->getMessage());
                exit();
                Session::flash('danger', $e->getMessage());
            }

        } else {
            Session::flash('message', 'Roles User not found!');
        }

        return redirect()->back();
    }

}
