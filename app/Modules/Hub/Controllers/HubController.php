<?php

namespace App\Modules\Hub\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Hub\Models\Hub;
use App\Modules\Hub\Requests;

use DB;
use Session;
use Illuminate\Support\Facades\Input;
use App;

class HubController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = "List of  Hub/Area";
        // Get Parent user data
        $data = Hub::all();
        // return view
        return view("Hub::hubsetting.index", compact('data','pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = "Add New Hub/Area";
        // return View
        return view("Hub::hubsetting.create", compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\HubRequest $request)
    {
        // Get all input data
        $input = $request->all();
        $input['slug'] = str_slug($input['slug']);
        // Check already presents or not
        $data = Hub::where('slug',$input['slug'])->exists();

        if(!$data )
        {
            /* Transaction Start Here */
            DB::beginTransaction();
            try {

                // Store user data 
                $hubdata = Hub::create($input);

                DB::commit();
                Session::flash('message', 'Hub is added!');
                return redirect('admin-hub-index');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();

                Session::flash('danger', $e->getMessage());
            }

        }else{
            Session::flash('info', 'This Hub/Area Name already added!');
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
        $pageTitle = 'View Hub Informations';

        // Find menu data
        $data = Hub::where('hubs.id', $id)
                ->select('hubs.*')
                ->first();                    

        if(!empty($data))
        {
            // If found menu
            return view("Hub::hubsetting.show", compact('data','pageTitle'));

        }else{
            // If menu not found
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
         $pageTitle = "Update Hub/Area";

        // Find menu
        $data = Hub::where('hubs.id', $id)
                ->select('hubs.*')
                ->first();
        // If menu not found                
        if(empty($data)){
            Session::flash('danger', 'Hub not found.');
            return redirect()->route('admin.hub.index');
        }


        // Return view
         return view("Hub::hubsetting.edit", compact('data','pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\HubRequest $request, $id)
    {
       // Get all input data
        $input = $request->all();
        $input['slug'] = str_slug($input['slug']);
        // Check already presents or not
        $model = Hub::where('hubs.id',$id)->first();

            /* Transaction Start Here */
            DB::beginTransaction();
            try {

                // Store user data 
                 $result = $model->update($input);

                DB::commit();
                Session::flash('message', 'Hub is Updated!');
                return redirect('admin-hub-index');

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $model = Hub::where('hubs.id',$id)->first();

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

        
        $pageTitle = 'Hub Information';

        // User model initialize
        $model = new Hub();

        if($this->isGetRequest())
        {
            // Search data found
            $search_keywords = trim(Input::get('search_keywords'));
            $model = $model->where(function ($query) use($search_keywords){
                    $query = $query->orWhere('title', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('hubs.status', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('slug', 'LIKE', '%'.$search_keywords.'%');
                });
            $data = $model->select('hubs.*')->paginate(30);
        }else{

            // If get data not found
            $data = Hub::paginate(30);
        }

        // Return view
        return view("Hub::hubsetting.index", compact('data','pageTitle'));
        

    }
}
