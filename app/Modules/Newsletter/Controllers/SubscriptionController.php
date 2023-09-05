<?php

namespace App\Modules\Newsletter\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Newsletter\Models\Subscriptions;
use DB;
use Session;
use Illuminate\Support\Facades\Input;

class SubscriptionController extends Controller
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
         $pageTitle = "List of  Subscriptions";

            // Get Parent user data
         $data = Subscriptions::paginate(30);


            // return view
         return view("Newsletter::subscription.index", compact('data','pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
     {
        $model =  Subscriptions::where('id', $id) ->first();
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

    public function search(Request $request)
    {


        $pageTitle = 'Subscriptions Information';

            // User model initialize
        $model = new Subscriptions();

        if($this->isGetRequest())
        {
                // Search data found
            $search_keywords = trim(Input::get('search_keywords'));
            $model = $model->where(function ($query) use($search_keywords){
                $query = $query->orWhere('email', 'LIKE', '%'.$search_keywords.'%');
               

            });
            $data = $model->select('subscription.*')->paginate(30);
        }else{

                // If get data not found
            $data = Subscriptions::paginate(30);
        }

            // Return view
        return view("Newsletter::subscription.index", compact('data','pageTitle'));
    }
}
