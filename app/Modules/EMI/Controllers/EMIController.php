<?php

namespace App\Modules\EMI\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\EMI\Models\EMI;
use App\Modules\EMI\Requests;

use DB;
use Session;
use Illuminate\Support\Facades\Input;
use App;

class EMIController extends Controller
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


    public function index()
    {   
        $pageTitle = "List of  EMI Data";
        // Get Parent user data
        $data = EMI::all();
      

        return view("EMI::emi.index", compact('data','pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $pageTitle = "Create EMI";
        
      

        return view("EMI::emi.create", compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\EmiRequest $request)
    {
       // Get all input data
        $input = $request->all();
       
        $data = EMI::where('bank_name',$input['bank_name'])->where('emi_month',$input['emi_month'])->exists();

        if(!$data)
        {
            /* Transaction Start Here */
            DB::beginTransaction();
            try {

                // Store user data 
                $hubdata = EMI::create($input);

                DB::commit();
                Session::flash('message', 'Emi is added!');
                return redirect('admin-emi-index');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();

                Session::flash('danger', $e->getMessage());
            }

        }else{
            Session::flash('info', 'This Bank Name Or Emi Month already added!');
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
        $pageTitle = 'View EMI Informations';

        // Find menu data
        $data = EMI::where('emi.id', $id)
                ->select('emi.*')
                ->first();                    

        if(!empty($data))
        {
            // If found menu
            return view("EMI::emi.show", compact('data','pageTitle'));

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
       $pageTitle = "Update EMI ";

        // Find menu
          $data = EMI::where('emi.id', $id)
                ->select('emi.*')
                ->first();      
        // If menu not found                
        if(empty($data)){
            Session::flash('danger', 'EMi not found.');
            return redirect()->route('admin.emi.index');
        }


        // Return view
         return view("EMI::emi.edit", compact('data','pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\EmiRequest $request, $id)
    {
       // Get all input data
     
        $input = $request->all();
       
        $model = EMI::where('id',$id)->first();

            /* Transaction Start Here */
            DB::beginTransaction();
            try {

                // Store user data 
                 $result = $model->update($input);

                DB::commit();
                Session::flash('message', 'EMI is Updated!');
                return redirect('admin-emi-index');

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
         $model = EMI::where('id',$id)->first();

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
             return redirect('admin-emi-index');
        } catch(\Exception $e) {
            DB::rollback();
            Session::flash('danger',$e->getMessage());
        }
        
        // redirect to current page
        return redirect()->back();
    }

     public function search(Request $request)
    {

        
        $pageTitle = 'EMI Information';

        // User model initialize
        $model = new EMI();

        if($this->isGetRequest())
        {
            // Search data found
            $search_keywords = trim(Input::get('search_keywords'));
            $model = $model->where(function ($query) use($search_keywords){
                    $query = $query->orWhere('bank_name', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('emi_month', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('emi_rate', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('emi_interest_rate', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('emi.status', 'LIKE', '%'.$search_keywords.'%');
                    
                });
            $data = $model->select('emi.*')->paginate(30);
        }else{

            // If get data not found
            $data = Hub::paginate(30);
        }

        // Return view
        return view("EMI::emi.index", compact('data','pageTitle'));
        

    }
}
