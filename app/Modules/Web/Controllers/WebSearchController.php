<?php

namespace App\Modules\Web\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;

use App\Modules\Product\Models\VwProductSearch;
use App\Modules\Product\Models\VwProduct;

use DB;
use App;

class WebSearchController extends Controller
{

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Change language 
        if(isset($_GET['lang']) && !empty($_GET['lang'])){
            App::setLocale($_GET['lang']);    
        }
    }

    protected function isGetRequest(){
        return Input::server("REQUEST_METHOD") == "GET";
    }

    protected function isPostRequest(){
        return Input::server("REQUEST_METHOD") == "POST";
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index(Request $request)
    {
        $get_request = Input::all();

            $model = new VwProduct();

           $search_keywords = trim(Input::get('keywords'));
           $category_slug = trim(Input::get('search_option'));

            $pageTitle = $search_keywords;
            $model =  $model->join('merchant_profiles','vw_product.product_merchant_id','=','merchant_profiles.users_id');
                $model = $model->where(function ($query) use($search_keywords){
                    $query = $query->orWhere('vw_product.product_title', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('vw_product.product_slug', 'LIKE', '%'.$search_keywords.'%');
                    /*$query = $query->orWhere('vw_product.manufacturer', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('vw_product.brand', 'LIKE', '%'.$search_keywords.'%');*/
                    $query = $query->orWhere('vw_product.item_no', 'LIKE', '%'.$search_keywords.'%');
                    // $query = $query->orWhere('vw_product.category_title', 'LIKE', '%'.$category_slug.'%');
                   
                })->select('vw_product.product_id', 'vw_product.product_title', 'vw_product.product_slug', 'vw_product.sell_price','vw_product.offer_price', 'vw_product.image', 'vw_product.item_no', 'vw_product.average_review','vw_product.product_merchant_id','vw_product.weight','vw_product.category_id');
                
            $total_product = $model->count();
            $product_data = $model->inRandomOrder();
            $product_data = $model->paginate(32)->setPath('');
            $product_data->appends(['search_option'=>$get_request['search_option'],'keywords' => Input::get('keywords')]);

        return view("Web::search.index", compact('product_data','pageTitle','total_product'));

    }


}