<?php

namespace App\Modules\User\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\User\Models\Permission;
use App\Modules\User\Requests;

use DB;
use Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Route;
use Auth;
use Illuminate\Support\Facades\Hash;
use Image;
use File;



class PermissionController extends Controller
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
     * PermissionController constructor.
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
        $pageTitle = "List of Permission Route";

        // Get Parent user data
        $data = DB::table('permission')->orderby('id','DESC')->get();

        // return view
        return view("User::permission.index", compact('data','pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    public function route_add(Request $request)
    {          

        DB::beginTransaction();
        try {

            $routeCollection = Route::getRoutes();
           //dd($routeCollection);
            // Get Parent user data
                foreach ($routeCollection as $value) {
                  

                    //Check already presents or not
                    $data = Permission::where('description',$value->getActionName())->first();

                    if (!$data) {
                         $model = New Permission;
                         $model->method = $value->methods()[0];
                         $model->route = $value->uri();
                         $model->title = $value->getName();
                         $model->description = $value->getActionName();
                         $model->status = "active";
                         $model->save();
                     }else{

                        $model = Permission::where('id',$data->id)->first();
                        $model->method = $value->methods()[0];
                        $model->route = $value->uri();
                        $model->title = $value->getName();
                        $model->description = $value->getActionName();
                        $model->status = "active";
                        $model->save();
                     }

                    
                    
                }
                 // Store user data
            DB::commit();
            Session::flash('message', 'Route is added!');
            return redirect(config('global.prefix_name').'/permission/index');

        } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
            DB::rollback();               
            Session::flash('danger', $e->getMessage());
        }
        return redirect()->back();

            /*$routes = collect(Route::getRoutes())->reduce(function ($carry = [], $route) {
                !starts_with($route->getName(), 'admin') ?: $carry[] = $route->getName();

                return  $carry;
            });*/

            // $routeCollection = Route::getRoutes();
            // $adminRoutes = [];
            // $perm_arry = ['App\Modules\Employee\Controllers\EmployeeTypeController','App\Modules\User\Controllers\RolesController'];
            // foreach ($routeCollection as $value) {
            //     starts_with($value->getActionName(), $perm_arry) === false ?: $adminRoutes[] = $value->uri();
            // }

            // dd($adminRoutes);


    }




    public function route_search(Request $request)
    {

        
        $pageTitle = 'Route List ';

        // User model initialize
        $model = new Permission();

        if($this->isGetRequest())
        {
            // Search data found
            $search_keywords = trim(Input::get('search_keywords'));
            $model = $model->where(function ($query) use($search_keywords){
                    $query = $query->orWhere('method', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('route', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('title', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('description', 'LIKE', '%'.$search_keywords.'%');
                   
                });
            $data = $model->select('permission.*')->get();
        }else{

            // If get data not found
            $data = User::get();
        }

        // Return view
        return view("User::permission.index", compact('data','pageTitle'));
        

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pageTitle = "Update Permission";

        // Find roles
        $data = Permission::where('id', $id)
                    ->first();

        // If roles not found                
        if(count($data) <= 0){
            Session::flash('danger', 'Role not found.');
            return redirect()->route('admin.permission.index');
        }

        // Return view
        return view("User::permission.edit", compact('data','pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $input = $request->all();

        // Find roles
        $model = Permission::where('id', $id)
            ->first();

        DB::beginTransaction();
        try {
            // Update category
            $result = $model->update($input);

            if($result){

                DB::commit();
            }

            Session::flash('message', 'Successfully updated!');
            return redirect(config('global.prefix_name').'/permission/index');
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
       $model = Permission::where('id', $id)
                ->first();

        DB::beginTransaction();
        try {
            

            if($model->delete())
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
        

    }
}
