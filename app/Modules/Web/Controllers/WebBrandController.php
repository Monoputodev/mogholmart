<?php

namespace App\Modules\Web\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Product\Models\Brand;
use App\Modules\Product\Models\ProductBrand;

use DB;
use App;

class WebBrandController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentURL = \URL::full();
        $pageTitle = 'Brand';

        $brand_list = Brand::where('status','active')
                            ->InRandomOrder()
                            ->paginate(50);

        return view("Web::brand.index",compact('pageTitle','brand_list','currentURL'));
    }

    /**
     * Show the login form for customer login.
     *
     * @return \Illuminate\Http\Response
     */


    public function product_list($slug)
    {
        $currentURL = \URL::full();
        // brand
        $brand = Brand::where('slug',$slug)->first();

        $og_title='welcome to giftoutletbd || '.$brand->title.'' ;
        $og_type=''.$brand->meta_title.'';
        $og_description=''.$brand->meta_description.'';
        $og_image='http:/giftoutletbd/uploads/brand/'.$brand->image_link.'';
        $og_image_alt=''.$brand->title.'';

         $request_data_full = '';
          $get_parameter = parse_url($currentURL);
          if(!empty($get_parameter['query']))
          {
                parse_str($get_parameter['query'], $query);
                $request_data = $query;
                $request_data_full = $query;
                // Remove show & short by from query
                unset($request_data['sort_by']);
        }


        if(count($brand) > 0){

            $pageTitle = $brand->title;

            // find product id from product brand
            $brand_product_id = ProductBrand::where('brand_id',$brand->id)->get(['product_id'])->toArray();

            $product_data = DB::table('vw_product')->whereIn('product_id',$brand_product_id)->select('product_id','description', 'product_title', 'product_slug','sell_price', 'offer_price',  'image', 'item_no', 'average_review', 'product_merchant_id','weight','category_id');

            if(isset($request_data_full['sort_by'])){

                switch ($request_data_full['sort_by']) {
                    case "price_desc":
                    $product_data = $product_data->orderBy('sell_price','DESC');
                    break;
                    case "price_asc":
                    $product_data = $product_data->orderBy('sell_price','ASC');
                    break;

                    case "name_asc":
                    $product_data = $product_data->orderBy('product_title','ASC');
                    break;
                    case "name_desc":
                    $product_data = $product_data->orderBy('product_title','DESC');
                    break;

                    case "rating_desc":
                    $product_data = $product_data->orderBy('total_review','DESC');
                    break;

                    case "rating_asc":
                    $product_data = $product_data->orderBy('total_review','ASC');
                    break;
                    default:
                    $product_data = $product_data->orderBy('product_id','DESC');
            } // end switch case
        }//end if
        $total_product = $product_data->count();
        $product_data = $product_data->paginate(30);
        $product_data->appends($request_data_full);

            return view("Web::brand.productList", compact('pageTitle','total_product','product_data','brand','og_title','og_type','og_description','og_image','og_image_alt','currentURL'));
        }
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
    public function destroy($id)
    {
        //
    }
}