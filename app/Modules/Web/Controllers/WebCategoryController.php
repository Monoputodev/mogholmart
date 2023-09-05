<?php

namespace App\Modules\Web\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Modules\Product\Models\Product;
use App\Http\Helpers\ProductHelper;
use App\Http\Helpers\FilterHelper;
use DB;
use Session;
use App;
class WebCategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        $currentURL = \URL::full();

        // Category Data
        $category_data = DB::table('vw_product_category')
                        ->where('category_slug',$slug)
                        ->first();
        $og_title='Welcome to Super Tiles BD ';
        $og_type='';
        $og_description='';
        $og_image='https://supertilesbd.com/uploads/category/orginal_image/'.$category_data->image_link.'';
        $og_image_alt=''.$category_data->category_title.'';

// dd($category_data);
        if(!empty($category_data))
        {

          // Filter Calculation
          $max_value_request_open = 'no';
          $min_value_request_open = 'no';
          $attribte_request_open = 'no';
          $shorting_request_open = 'no';
          $limit_request_open = 'no';
          $rating_request_open = 'no';
          $request_data_full = '';
          $get_parameter = parse_url($currentURL);
          if(!empty($get_parameter['query']))
          {
                parse_str($get_parameter['query'], $query);
                $request_data = $query;
                $request_data_full = $query;
                // Remove show & short by from query
                unset($request_data['min_value']);
                unset($request_data['max_value']);
                unset($request_data['sort_by']);

                unset($request_data['rating']);
                unset($request_data['page']);
                unset($request_data['lang']);
                unset($request_data['fbclid']);
                if(isset($request_data) && count($request_data) > 0)
                {
                    // If request found from filter
                    foreach($request_data as $request)
                    {
                        if(!empty($request))
                        {
                            $attribte_request_open = 'yes';
                        }
                    }
                }
                if(!empty($query['min_value']) && !empty($query['max_value']))
                {
                    $max_value_request_open = 'yes';
                    $min_value_request_open = 'yes';
                }

                if(!empty($query['rating']))
                {
                    $rating_request_open = 'yes';

                }
          }
          //$filter_brand_product_list = [];
          $filter_attribute_product_list = [];
          if($attribte_request_open == 'yes')
          {
            // Filter attribute list
            $filter_attribute_product_list = FilterHelper::search_attribute_with_product($request_data_full);

          }
          //price filtering.............
        $filter_price_product_list = [];
        if($max_value_request_open == 'yes' || $min_value_request_open == 'yes' )
          {
            // Explode brand from url
            if(isset($request_data_full['min_value']) && isset($request_data_full['max_value'])){
                $filter_max = $request_data_full['max_value'];
                $filter_min = $request_data_full['min_value'];
                $filter_price_product_list = FilterHelper::filter_price_list($filter_max,$filter_min);
            }
          }
        //price filtering.............
        $filter_rating_product_list = [];

        if($rating_request_open == 'yes')
        {
            // Explode brand from url
            if(isset($request_data_full['rating'])){
                $filter_rating = explode(",",$request_data_full['rating']);
                $filter_rating_product_list = FilterHelper::filter_rating_list($filter_rating);
            }
        }
        // Set PageTitle
        $pageTitle = $category_data->category_title;
        // Sub Category list
        $sub_category=DB::table('vw_product_category')
                      ->where('vw_product_category.parent_category_id',$category_data->category_id)
                      ->get();
        // explode product id
        $product_id_list = explode(',', $category_data->product_id);
        $product_id_list_data = DB::table('category')->join('product_category', 'product_category.category_id', '=', 'category.id')
                        ->where('category.slug',$slug)
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
          # Find product Brand
          # Find product attribute
          $attribute_list = Product::findProductAttribute($product_id_list);
          # Product list
          $product_data = DB::table('vw_product')->whereIn('product_id',$product_id_list);
          $product_data = $product_data->where(function($query) use ($filter_attribute_product_list,$filter_price_product_list, $request_data_full, $attribte_request_open,$max_value_request_open,$min_value_request_open,$filter_rating_product_list,$rating_request_open)
          {

              # Filter with rating
              if($rating_request_open == 'yes' && !empty($request_data_full['rating'])){
                  $query->whereIn('product_id',$filter_rating_product_list);
              }
              # Filter with attribute
               if($attribte_request_open == 'yes'){
                   $query->whereIn('product_id',$filter_attribute_product_list);
               }
               # Filter with price
              if($max_value_request_open == 'yes' && $min_value_request_open == 'yes' && !empty($request_data_full['max_value']) && !empty($request_data_full['min_value'])){
                  $query->whereIn('product_id',$filter_price_product_list);
              }
               # Main search result it is open when no filter request found
          });

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
          $product_data = $product_data->paginate(20);
          $product_data->appends($request_data_full);
       return view("Web::category.index", compact('sub_category','pageTitle','category_data','total_product','product_data','attribute_list', 'currentURL','og_title','og_type','og_description','og_image','og_image_alt'));
        }

    }

    /**
     * Display about us content.
     *
     * @return pages.about
     */

    public function sub_category($main_category_slug,$slug)
    {
        $currentURL = \URL::full();
        // Category Data
        $category_data = DB::table('vw_product_category')
                        ->where('category_slug',$slug)
                        ->first();
         // main category data
        $main_category_data = DB::table('vw_product_category')
                        ->where('category_slug',$main_category_slug)
                        ->first();


          $og_title='welcome to Super Tiles BD  | '.$main_category_data->category_meta_title.'' ;
          $og_type=''.$main_category_data->category_meta_keywords.'';
          $og_description=''.$main_category_data->category_meta_description.'';
          $og_image='https://supertilesbd.com/uploads/category/orginal_image/'.$main_category_data->image_link.'';
          $og_image_alt=''.$main_category_data->category_title.'';


        if(!empty($category_data) && !empty($main_category_data))
        {

          // Filter Calculation
          $max_value_request_open = 'no';
          $min_value_request_open = 'no';
          $attribte_request_open = 'no';
          $shorting_request_open = 'no';
          $limit_request_open = 'no';
          $rating_request_open = 'no';
          $request_data_full = '';
          $get_parameter = parse_url($currentURL);
          if(!empty($get_parameter['query']))
          {
                parse_str($get_parameter['query'], $query);
                $request_data = $query;
                $request_data_full = $query;
                // Remove show & short by from query
                unset($request_data['min_value']);
                unset($request_data['max_value']);
                unset($request_data['sort_by']);

                unset($request_data['rating']);
                unset($request_data['page']);
                unset($request_data['lang']);
                unset($request_data['fbclid']);
                if(isset($request_data) && count($request_data) > 0)
                {
                    // If request found from filter
                    foreach($request_data as $request)
                    {
                        if(!empty($request))
                        {
                            $attribte_request_open = 'yes';
                        }
                    }
                }
                if(!empty($query['min_value']) && !empty($query['max_value']))
                {
                    $max_value_request_open = 'yes';
                    $min_value_request_open = 'yes';
                }

                if(!empty($query['rating']))
                {
                    $rating_request_open = 'yes';

                }
          }
          //$filter_brand_product_list = [];
          $filter_attribute_product_list = [];
          if($attribte_request_open == 'yes')
          {
            // Filter attribute list
            $filter_attribute_product_list = FilterHelper::search_attribute_with_product($request_data_full);

          }
          //price filtering.............
        $filter_price_product_list = [];
        if($max_value_request_open == 'yes' || $min_value_request_open == 'yes' )
          {
            // Explode brand from url
            if(isset($request_data_full['min_value']) && isset($request_data_full['max_value'])){
                $filter_max = $request_data_full['max_value'];
                $filter_min = $request_data_full['min_value'];
                $filter_price_product_list = FilterHelper::filter_price_list($filter_max,$filter_min);
            }
          }
        //price filtering.............
        $filter_rating_product_list = [];

        if($rating_request_open == 'yes')
        {
            // Explode brand from url
            if(isset($request_data_full['rating'])){
                $filter_rating = explode(",",$request_data_full['rating']);
                $filter_rating_product_list = FilterHelper::filter_rating_list($filter_rating);
            }
        }

        // Set PageTitle
        $pageTitle = $category_data->category_title;
          // explode product id
        $sub_category=DB::table('vw_product_category')
        ->where('vw_product_category.parent_category_id',$category_data->category_id)
        ->get();
        // explode product id
        $product_id_list = explode(',', $category_data->product_id);
        $product_id_list_data = DB::table('category')->join('product_category', 'product_category.category_id', '=', 'category.id')
                        ->where('category.slug',$slug)
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
          # Find product Brand
          # Find product attribute
          $attribute_list = Product::findProductAttribute($product_id_list);
          # Product list
          $product_data = DB::table('vw_product')->whereIn('product_id',$product_id_list);
          $product_data = $product_data->where(function($query) use ($filter_attribute_product_list,$filter_price_product_list, $request_data_full, $attribte_request_open,$max_value_request_open,$min_value_request_open,$filter_rating_product_list,$rating_request_open)
          {

              # Filter with rating
              if($rating_request_open == 'yes' && !empty($request_data_full['rating'])){
                  $query->whereIn('product_id',$filter_rating_product_list);
              }
              # Filter with attribute
               if($attribte_request_open == 'yes'){
                   $query->whereIn('product_id',$filter_attribute_product_list);
               }
               # Filter with price
              if($max_value_request_open == 'yes' && $min_value_request_open == 'yes' && !empty($request_data_full['max_value']) && !empty($request_data_full['min_value'])){
                  $query->whereIn('product_id',$filter_price_product_list);
              }
               # Main search result it is open when no filter request found
          });

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
          $product_data = $product_data->paginate(20);
          $product_data->appends($request_data_full);

       return view("Web::category.sub_category", compact('sub_category','pageTitle','category_data','total_product','product_data','attribute_list', 'currentURL','main_category_data','og_title','og_type','og_description','og_image','og_image_alt'));

        } // End if
    }

    /**
     * Display privacy policy content.
     *
     * @return pages.privacy policy
     */

    public function sub_category_second($main_category_slug,$child_category_slug,$slug)
    {
            $currentURL = \URL::full();
              // Category Data
              $category_data = DB::table('vw_product_category')
              ->where('category_slug',$slug)
              ->first();

                // main category data
              $main_category_data = DB::table('vw_product_category')
              ->where('category_slug',$main_category_slug)
              ->first();

                // child category data
              $child_category_data = DB::table('vw_product_category')
              ->where('category_slug',$child_category_slug)
              ->first();

              $og_title='Welcome to Super Tiles BD  | '.$child_category_data->category_meta_title.'' ;
              $og_type=''.$child_category_data->category_meta_keywords.'';
              $og_description=''.$child_category_data->category_meta_description.'';
              $og_image='https://supertilesbd.com/uploads/category/orginal_image/'.$child_category_data->image_link.'';
              $og_image_alt=''.$child_category_data->category_title.'';


              if(!empty($category_data) && !empty($main_category_data) && !empty($child_category_data))
              {
                // Filter Calculation
                    $max_value_request_open = 'no';
                    $min_value_request_open = 'no';
                    $attribte_request_open = 'no';
                    $shorting_request_open = 'no';
                    $rating_request_open = 'no';
                    $request_data_full = '';
                    $get_parameter = parse_url($currentURL);
                    if(!empty($get_parameter['query']))
                    {
                      parse_str($get_parameter['query'], $query);

                      $request_data = $query;
                      $request_data_full = $query;
                    // Remove show & short by from query

                      unset($request_data['min_value']);
                      unset($request_data['max_value']);
                      unset($request_data['sort_by']);
                      unset($request_data['rating']);
                      unset($request_data['page']);
                      unset($request_data['lang']);
                      unset($request_data['fbclid']);

                      if(isset($request_data) && count($request_data) > 0)
                      {
                        // If request found from filter
                        foreach($request_data as $request)
                        {
                            if(!empty($request))
                            {
                                $attribte_request_open = 'yes';
                            }
                        }
                    }

                    if(!empty($query['min_value']) && !empty($query['max_value']))
                    {
                        $max_value_request_open = 'yes';
                        $min_value_request_open = 'yes';
                    }

                    if(!empty($query['rating']))
                    {
                        $rating_request_open = 'yes';

                    }
                }
                $filter_attribute_product_list = [];
                if($attribte_request_open == 'yes')
                {
                // Filter attribute list
                    $filter_attribute_product_list = FilterHelper::search_attribute_with_product($request_data_full);
                }
              //price filtering.............
                $filter_price_product_list = [];
                if($max_value_request_open == 'yes' || $min_value_request_open == 'yes' )
                {
                // Explode brand from url
                    if(isset($request_data_full['min_value']) && isset($request_data_full['max_value'])){
                        $filter_max = $request_data_full['max_value'];
                        $filter_min = $request_data_full['min_value'];
                        $filter_price_product_list = FilterHelper::filter_price_list($filter_max,$filter_min);
                    }
                }
              //price filtering.............
                $filter_rating_product_list = [];
                if($rating_request_open == 'yes')
                {
                    // Explode brand from url
                    if(isset($request_data_full['rating'])){
                        $filter_rating = explode(",",$request_data_full['rating']);
                        $filter_rating_product_list = FilterHelper::filter_rating_list($filter_rating);
                    }
                }
                // Set PageTitle
                $pageTitle = $category_data->category_title;
                // Sub Category list
                $sub_category=DB::table('vw_product_category')
                ->where('vw_product_category.parent_category_id',$category_data->category_id)
                ->get();
                // explode product id
                $product_id_list = explode(',', $category_data->product_id);
                $product_id_list_data = DB::table('category')->join('product_category', 'product_category.category_id', '=', 'category.id')
                ->where('category.slug',$slug)
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

            // Find product Brand

              $attribute_list = Product::findProductAttribute($product_id_list);
                // Product list
              $product_data = DB::table('vw_product')->whereIn('product_id',$product_id_list);

              $product_data = $product_data->where(function($query) use ($filter_attribute_product_list,$filter_price_product_list,$request_data_full, $attribte_request_open,$max_value_request_open,$min_value_request_open,$filter_rating_product_list,$rating_request_open){

                // Filter with rating
                if($rating_request_open == 'yes' && !empty($request_data_full['rating']))
                {
                  $query->whereIn('product_id',$filter_rating_product_list);
              }
                  // Filter with attribute
              if($attribte_request_open == 'yes')
              {
                $query->whereIn('product_id',$filter_attribute_product_list);
            }
                // Filter with price
            if($max_value_request_open == 'yes' && $min_value_request_open == 'yes' && !empty($request_data_full['max_value']) && !empty($request_data_full['min_value'])){
              $query->whereIn('product_id',$filter_price_product_list);
          }
                // Main search result it is open when no filter request found

      });

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
            $product_data = $product_data->paginate(20);
            $product_data->appends($request_data_full);

            return view("Web::category.sub_category_child", compact('sub_category','pageTitle','category_data','main_category_data','child_category_data','total_product','product_data','attribute_list','currentURL','og_title','og_type','og_description','og_image','og_image_alt'));
        }

    }
}
