<?php

namespace App\Modules\Discount\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Discount\Models\Discount;
use App\Modules\Category\Models\Category;
use App\Modules\Discount\Requests;
use Illuminate\Support\Facades\Input;

use DB;
use Session;
use App;

class DiscountController extends Controller
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

        $pageTitle = "List Of Discount";
        // Get Parent user data
        $data = Discount::all();

        return view("Discount::discount.index",compact('data','pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = "Add Discount";

        $categories = Category::join('category_self_relation', 'category_self_relation.child_category_id', '=', 'category.id')
                ->where('category_self_relation.parent_category_id',NULL)
                ->orderby('category.short_order','asc')
                ->pluck('title','category.id')->all();

        return view("Discount::discount.create",compact('pageTitle','categories'));



    }

    public function find_category(Request $request)
    {
        $term = trim($request->q);

        if (empty($term)) {
            return \Response::json([]);
        }

        $categorys = Category::where('title', 'LIKE', '%'.$term.'%')->limit(5)->get();

        $formatted_categorys = [];

        foreach ($categorys as $category) {
            $formatted_categorys[] = ['id' => $category->id, 'text' => $category->title];
        }

        return \Response::json($formatted_categorys);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Get all input data
        $input = $request->all();

        $input['category_id'] = implode(",",$request->category_id);

        
            /* Transaction Start Here */
            DB::beginTransaction();
            try {

                // Store user data 
                $discount_data = Discount::create($input);

                DB::commit();
                Session::flash('message', 'Discount  is added!');
                return redirect('admin-discount-index');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();

                Session::flash('danger', $e->getMessage());
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
        $pageTitle = 'View Discount Informations';

        // Find menu data
        $data = Discount::where('id', $id)->first();                    

        if(!empty($data))
        {
            // If found menu
            return view("Discount::discount.show", compact('data','pageTitle'));

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
        $pageTitle = "Update Discount Informations";

        // Find Discount
       $data = Discount::where('id', $id)->first();
        // If Discount not found                
        if(empty($data)){

            Session::flash('danger', 'Data not found.');
            return redirect()->route('admin.discount.index');
        }


        // Return view
         return view("Discount::discount.edit", compact('data','pageTitle'));
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
         // Get all input data
            $input = $request->all();

            if ($request->category_id !==null) {
             
                $input['category_id'] = implode(",",$request->category_id);
            }else{

                $input['category_id']=$request->put_category;
            }
            // Check already presents or not
            $model = Discount::where('id',$id)->first();

            /* Transaction Start Here */
            DB::beginTransaction();
            try {

            // Store user data 
               $result = $model->update($input);

               DB::commit();
               Session::flash('message', 'Discount is Updated!');
               return redirect('admin-discount-index');

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
        $model = Discount::where('id',$id)->first();

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

        
        $pageTitle = 'Discount Information';

        // User model initialize
        $model = new Discount();

        if($this->isGetRequest())
        {
            // Search data found
            $search_keywords = trim(Input::get('search_keywords'));
            $model = $model->where(function ($query) use($search_keywords){
                    $query = $query->orWhere('category_id', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('disc_percentage', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('product_category_discount.status', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('product_category_discount.type', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('start_date', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('end_date', 'LIKE', '%'.$search_keywords.'%');
                });
            $data = $model->select('product_category_discount.*')->paginate(30);
        }else{

            // If get data not found
            $data = Discount::paginate(30);
        }

        // Return view
        return view("Discount::discount.index", compact('data','pageTitle'));
        

    }
}
