<?php

namespace App\Modules\Product\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Product\Requests;
use App\Modules\Product\Models\ProductReview;
use App\Modules\Product\Models\VwProduct;
use Illuminate\Support\Facades\Input;
use App\User;
use DB;
use Session;

class ProductReviewController extends Controller
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
	    $pageTitle = "Review List";
	    $data = ProductReview::where('status','inactive')->orderby('id','DESC')->get();

	    return view('Product::productreview.index', [
	        'pageTitle' => $pageTitle,
	        'data' => $data
	    ]);
	}

     public function create()
    {
        $pageTitle = "Add Product Review";

        
       $customer_list = [''=>'Please select Customer email']+ User::where('type','customer')->pluck('email','id')->all();

       $product_list = [''=>'Please select Prodcut Name']+ VwProduct::pluck('product_title','product_id')->all();

        // return View
        return view("Product::productreview.create", compact('pageTitle','customer_list','product_list'));
        
    }

    public function store(Request $request)
    {
         // Get all input data
        $input = Input::all();
        
        $reviewadd = new ProductReview;
        $reviewadd->product_id= $input['product_id'];
        $reviewadd->customer_id=$input['customer_id'];
        $reviewadd->title=$input['title'];
        $reviewadd->rating_value_score=$input['rating_value_score'];
        $reviewadd->review=$input['review'];
        $reviewadd->status=$input['status'];


        /* Transaction Start Here */
        DB::beginTransaction();
        try {

            // Store Product review 
            if($reviewadd->save())
            {
                
            DB::commit();
            }
       
            Session::flash('message', 'Product is review is added!');

            return redirect()->route('admin.customer.product.review');

        } catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            print($e->getMessage());
            exit();
            Session::flash('danger', $e->getMessage());
        }

        // Redirect back to last page if error occurs 
        return redirect()->back();
    }

    

    public function show_all_review()
    {
        $pageTitle = " Show All Review List";
        $data = ProductReview::orderby('id','DESC')->get();

        return view('Product::productreview.index', [
            'pageTitle' => $pageTitle,
            'data' => $data
        ]);
        
    }


	public function show($id)
	{

	    $values = ProductReview::where('id',$id)->first();

	    $pageTitle = "Show Review";

	    return view('Product::productreview.show', ['values' => $values,
	        'pageTitle' => $pageTitle,
	    ]);
	}

    public function edit($id)
    {
        $pageTitle = "Update Review";

        // Find Product
        $data = ProductReview::where('product_review.id',$id)->first();

        // If Product not found                
        if(!isset($data)){
            Session::flash('danger', 'Product Review not found.');
            return redirect()->route('admin.customer.product.review');
        }

        $customer_list = [''=>'Please select Customer email']+ User::where('type','customer')->pluck('email','id')->all();

       $product_list = [''=>'Please select Prodcut Name']+ VwProduct::pluck('product_title','product_id')->all();
       
        // Return view
        return view("Product::productreview.edit", compact('data','customer_list','product_list','pageTitle'));
    }

    public function update(Requests\ProductReviewRequest $request, $id)
    {
        
        $input = $request->all();

        // Find review
        $model = ProductReview::where('product_review.id',$id)->first();



        DB::beginTransaction();
        try {
            // Update brand
            $result = $model->update($input);

            if($result){

                DB::commit();
            }

            Session::flash('message', 'Successfully updated!');
            return redirect()->route('admin.customer.product.review');
        }
        catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            Session::flash('danger', $e->getMessage());
        }

        return redirect()->back();

    }


	public function change_order_status(Requests\ChangeOrderStatusRequest $request)
	{

	    $response = [];
	    $response['result'] = 'error';

	    $input = $request->all();

	    $order_status = $input['order_status'];
	    $order_id = $input['order_id'];

	    if($order_status == 'pending')
	    {
	    	$new_status = 'confirmed';
	    }elseif ($order_status == 'confirmed') {
	    	$new_status = 'shipped';
	    }elseif ($order_status == 'shipped') {
	    	$new_status = 'delivered';
	    }else{
	    	$new_status = 'cancel';
	    }

	    $data = OrderHead::where('order_head.id', $order_id)
	        ->first();

	    if (count($data) > 0) {

	    	$data->status = $new_status;
	    	$data->save();

	    	Session::flash('message', 'Status successfully changed ' . $order_status . ' to '.$new_status );
	        
	    } else {
	    	Session::flash('danger', 'Order data not found.');
	    }

	    return json_encode($response);
	}


	public function search(Request $request)
    {

        
        $pageTitle = 'Product Review Information';

        // ProductReview model initialize
        $model = new ProductReview();

        if($this->isGetRequest())
        {
            // Search data found
            $search_keywords = trim(Input::get('search_keywords'));
            $model = $model->where(function ($query) use($search_keywords){
                    $query = $query->orWhere('rating_value_score', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('title', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('product_review.status', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('review', 'LIKE', '%'.$search_keywords.'%');
                });
            $data = $model->select('product_review.*')->orderBy('id','desc')->paginate(30);
        }else{

            // If get data not found
            $data = ProductReview::orderBy('id','desc')->paginate(30);
        }

        // Return view
        return view("Product::productreview.index", compact('data','pageTitle'));
        

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find review 

        $model = ProductReview::where('id',$id)
                ->delete();

        DB::beginTransaction();
        try {

            DB::commit();
            Session::flash('message', "Product Review Delete.");

        } catch(\Exception $e) {
            DB::rollback();
            Session::flash('danger',$e->getMessage());
        }
        
        // redirect to current page
        return redirect()->back();
    }

}