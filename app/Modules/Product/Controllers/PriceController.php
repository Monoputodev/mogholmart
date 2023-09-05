<?php

namespace App\Modules\Product\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Modules\Category\Models\Category;
use App\Modules\Product\Models\PriceUpdate;
use App\Modules\Category\Models\CategorySelfRelation;
use App\Modules\Product\Models\Product;

use App\User;
use DB;
use Session;

use App;
use Auth;

class PriceController extends Controller
{
    // category wish search page show
    public function index(){
        
         $pageTitle = "Category wish Price Update";

        // Get Parent category data
        
        $category = Category::join('category_self_relation', 'category_self_relation.child_category_id', '=', 'category.id')
                #->where('category_self_relation.parent_category_id',NULL)
                ->whereNotIn('category.status',['cancel'])
                ->select('category.*')
                ->orderby('category.id','asc')
                ->get();

        return view("Product::price.index", compact('category','pageTitle'));
    }

    // category wish product show
    public function category_product_list(Request $Request){
        $pageTitle = "Category wish Price Update";

        // get from data
        $category_id = $_GET['product_category'];
        $orderby = $_GET['asc_desc'];
        $product_num = $_GET['product_number'];
        $limit_start = $_GET['limit_start'];
        $limit_end = $_GET['limit_end'];

        // Form Data Return redirect page

        $form_data = [];
        $form_data['category_id'] = $category_id;
        $form_data['orderby'] = $orderby;
        $form_data['product_num'] = $product_num;
        $form_data['limit_start'] = $limit_start;
        $form_data['limit_end'] = $limit_end;

        // Category List Data Return redirect page
        
        $category = Category::join('category_self_relation', 'category_self_relation.child_category_id', '=', 'category.id')
                #->where('category_self_relation.parent_category_id',NULL)
                ->whereNotIn('category.status',['cancel'])
                ->select('category.*')
                ->orderby('category.id','asc')
                ->get();



        if(isset($category_id)){
            // category id wish product id show
            $product_id_list_data = DB::table('category')->join('product_category', 'product_category.category_id', '=', 'category.id')
                            ->where('category.id',$category_id)
                            ->where('category.status','active')
                            ->select('product_category.product_id')
                            ->get()->toArray();
                            
                $new_product_id_array = [];
                if(!empty($product_id_list_data)){
                    foreach($product_id_list_data as $product_id_list){
                        array_push($new_product_id_array,$product_id_list->product_id);
                    }
                }
              
                if(count($new_product_id_array) > 0){
                    $product_id_list = $new_product_id_array;
                }

                // product id wish product select

                $data = DB::table('product')
                                ->whereIn('id',$product_id_list)
                                ->where('status','active')
                                ->select('id','title','sell_price','list_price','item_no','updated_at','created_at');

                $inactive_product = DB::table('product')
                                ->whereIn('id',$product_id_list)
                                ->where('status','inactive');

              $data = $data->orderby('id',$orderby);

              // jodi all data show korte chi
              if ($product_num == 'all') {
                $data = $data->get();
              }

              // jodi limited data show korle chi
              if($product_num == 'limit'){
                if(isset($limit_start) && isset($limit_end)){
                    $data = $data->take($limit_end)->skip($limit_start)->get();
                }
              }

        return view("Product::price.index", compact('data','pageTitle','form_data','category'));

        }else{
            Session::flash('message', 'Select Valid Category!');
            return redirect()->back();
        }
    }

    // category wish product price update

    public function update_price_store(){
        // get from data
        $all_product_id = $_POST['product_id'];
        $all_actual_price = $_POST['actual_price'];
        $all_update_price = $_POST['update_price'];
        $all_list_price = $_POST['actual_list_price'];
        $all_list_update_price = $_POST['update_list_price'];

        if(empty($all_update_price) && empty($all_list_update_price)){
            Session::flash('message', 'Nothing to Update, All are same value !');
            return redirect()->back();
        }



        if(isset($all_update_price) && Auth::user()){
            // array to single row convert
            for ($index = 0 ; $index < count($all_product_id); $index ++) {
            $PriceUpdate = new PriceUpdate();

            // data set into model

            $PriceUpdate->product_id = $all_product_id[$index];
            $PriceUpdate->actual_price = $all_actual_price[$index];

            if(empty($all_update_price[$index])){
                $PriceUpdate->update_price = $all_actual_price[$index];
                $update_sell_price = $all_actual_price[$index];
            }else{
                $update_sell_price = $all_update_price[$index];
                $PriceUpdate->update_price = $all_update_price[$index];
            }
            // echo $all_actual_price[$index].' '.$update_sell_price;
            // exit();
            $PriceUpdate->actual_list_price = $all_list_price[$index];


            if(empty($all_list_update_price[$index])){
                $PriceUpdate->list_update_price = $all_list_price[$index];
                $update_list_price = $all_list_price[$index];
            }else{
                $update_list_price =  $all_list_update_price[$index];
                $PriceUpdate->list_update_price = $all_list_update_price[$index];
            }

            $PriceUpdate->created_by = Auth::user()->id;
            $PriceUpdate->updated_by =  Auth::user()->id;
            
            // single product row show for update

            $product_price_update =Product::where('id',$all_product_id[$index])
                            ->where('status','active');

            /* Transaction Start Here */
            DB::beginTransaction();
            try {
                // data inser and update
                // if( ($all_actual_price[$index] != $update_sell_price) || ($all_list_price[$index] !=$update_list_price)){
                    $PriceUpdate->save();
                    $product_price_update->update([
                            'sell_price' => $update_sell_price,
                            'list_price' => $update_list_price
                    ]);
                    DB::commit();
                    Session::flash('message', 'Product Price Is Update!');

                // }    

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                print($e->getMessage());
                exit();
                Session::flash('danger', $e->getMessage());
            }
        }
            
        return redirect()->back();
        
         
        }else{
            // Session::flash('message', 'Product Price Is Update!');
            // return redirect()->back();
        }
    }  

// update details page show with data
    // public function update_details($id){
    //     $pageTitle = 'Product Update Details '; 

    //     // product update details
    //         $data = DB::table('price_update')->join('product','product.id','=','price_update.product_id')
    //                             ->where('price_update.product_id',$id)
    //                             ->select('price_update.*','product.title')
    //                             ->orderby('id','desc')
    //                             ->get();
            
    //     if(count($data) > 0){
    //         return view("Product::price.update_details", compact('pageTitle','data'));
    //     }else{
    //         $msg = 'Product ID '.$id.' Is Just Added !';
    //         Session::flash('message',$msg);
    //         return redirect()->back();
    //     }
    // } 

// update details page show with data by model 

    public function update_details($id){ 
        $response = [];

        // product update details
        $data = DB::table('price_update')->join('product','product.id','=','price_update.product_id')
                                ->where('price_update.product_id',$id)
                                ->select('price_update.*','product.title')
                                ->orderby('id','desc')
                                ->get();

        if(count($data) > 0){
            $view = \Illuminate\Support\Facades\View::make('Product::price.update_details',compact('data'));
            $contents = $view->render();

            $response['result'] = 'success';
            $response['content'] = $contents;
            $response['header'] = 'Price Update Details';
        }else{
            $response['result'] = 'error';
        }

        return $response;
    } 


    // Merchant wish price update

    public function merchant_index(){
        $pageTitle = "Merchant Wish Product Price Update";

        // Get merchant data
        
        $merchant = DB::table('users')->join('merchant_profiles','merchant_profiles.users_id','=','users.id')
                                 ->where('users.type','seller')
                                ->where('status','active')
                                ->select('users.*','merchant_profiles.shop_name')
                                 ->get();
        return view("Product::price.merchant.index", compact('merchant','pageTitle'));
    }

    // Merchant wish product show
    public function merchant_product_list(Request $request){
        $pageTitle = "Merchant Wish Product Price Update";
        
        // get data from table
        $merchant_id = $_GET['merchant_id'];
        $orderby = $_GET['asc_desc'];
        $product_num = $_GET['product_number'];
        $limit_start = $_GET['limit_start'];
        $limit_end = $_GET['limit_end'];

        
        // Form Data Return redirect page
        $form_data = [];
        $form_data['merchant_id'] = $merchant_id;
        $form_data['orderby'] = $orderby;
        $form_data['product_num'] = $product_num;
        $form_data['limit_start'] = $limit_start;
        $form_data['limit_end'] = $limit_end;

        // Get merchant data
        
        $merchant = DB::table('users')->join('merchant_profiles','merchant_profiles.users_id','=','users.id')
                                 ->where('users.type','seller')
                                ->where('status','active')
                                ->select('users.*','merchant_profiles.shop_name')
                                 ->get();

        // Product show by merchant id
        if(isset($merchant_id)){
                $data = DB::table('product')
                                ->where('merchant_id',$merchant_id)
                                ->where('status','active')
                                ->select('id','title','sell_price','list_price','item_no','updated_at','created_at');

              $data = $data->orderby('id',$orderby);
              // jodi all data show korte chi
              if ($product_num == 'all') {
                $data = $data->get();
              }

              // jodi limited data show korle chi
              if($product_num == 'limit'){
                if(isset($limit_start) && isset($limit_end)){
                    $data = $data->take($limit_end)->skip($limit_start)->get();
                }
              }

        return view("Product::price.merchant.index", compact('data','pageTitle','form_data','merchant'));

        }else{
            Session::flash('message','Merchant Id Not Present, Select A Valid Merchant !');
            return redirect()->back();
        }
    }

    public function undo($id){
        $response = [];

        // product update details
        $data = DB::table('price_update')->join('product','product.id','=','price_update.product_id')
                                ->where('price_update.product_id',$id)
                                ->select('price_update.*','product.title','product.sell_price','product.list_price')
                                ->orderby('id','desc')
                                ->get();

        if(count($data) > 0){
            $view = \Illuminate\Support\Facades\View::make('Product::price.undo',compact('data'));
            $contents = $view->render();

            $response['result'] = 'success';
            $response['content'] = $contents;
            $response['header'] = 'Set Your Product Price From Details';

        }else{
            $response['result'] = 'error';
        }

        return $response;
    }
    
}
