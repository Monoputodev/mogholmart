<?php


namespace App\Http\Helpers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use \Illuminate\Support\Facades\Route;
use App\Modules\Category\Models\Category;
use App;


class ProductHelper
{

    /**
        Get Parent Category Data
        parameter is limit
     **/
    public static function home_product($limit = '1')
    {
        $response = [];

        $new_category_array = [];
        $product_data_array = [];


        if(Session::has('category_menu')){

             $category = Session::get('category_menu');

        }else{

            $category_model = Category::getWebMenu();

            Session::put('category_menu',$category_model);

            $category = Session::get('category_menu');

        }

        $rand_keys_category = array_rand($category, 6);

        if(!empty($rand_keys_category)){
            foreach($rand_keys_category as $values){

                array_push($new_category_array,$category[$values]);

                $product_data_array[$category[$values]['id']] = self::get_product_data($category[$values]['id']);
            }
        }

        $response['category_data'] = $new_category_array;
        $response['product_data'] = $product_data_array;


        return $response;
    }

    /**
        Get product data
        Parameter is product_id
     **/
    public static function get_product_data($category_id)
    {
        $lang = App::getLocale();

        $response = [];

        if (!empty($category_id)) {

            $product_data = DB::table('vw_product')
                    ->join('product_category','vw_product.product_id','=','product_category.product_id')
                    ->where('product_category.category_id', $category_id)->limit(6)->inRandomOrder()->select('product_category.category_id','vw_product.product_id','vw_product.product_merchant_id', 'product_title','product_slug', 'sell_price','offer_price', 'image', 'item_no', 'average_review','weight','quantity')->get()->toArray();



            if (count($product_data) > 0) {
                foreach ($product_data as $key => $value) {
                    $response[$key]['product_id'] = $value->product_id;
                    $response[$key]['product_title'] = $value->product_title;

                    $response[$key]['product_slug'] = $value->product_slug;
                    $response[$key]['sell_price'] = $value->sell_price;

                    $response[$key]['offer_price'] = $value->offer_price;

                    $response[$key]['image'] = $value->image;
                    $response[$key]['item_no'] = $value->item_no;
                    $response[$key]['product_merchant_id'] = $value->product_merchant_id;
                    $response[$key]['average_review'] = $value->average_review;
                    $response[$key]['weight'] = $value->weight;
                    $response[$key]['quantity'] = $value->quantity;
                }
            }
        }

        return $response;

    }

    /**
        Get sub category data
        Parameter is category
     **/
    public static function get_sub_category($category_id)
    {
        $lang = App::getLocale();

        $response = [];

        $sub_category_data = DB::table('vw_product_category')
            ->where('vw_product_category.parent_category_id', $category_id)
            ->limit(9)
            ->inRandomOrder()
            ->get()->toArray();

        if (count($sub_category_data) > 0) {
            foreach ($sub_category_data as $key => $value) {
                $response[$key]['category_id'] = $value->category_id;
                $response[$key]['category_title'] = $value->category_title;
                if ($lang == 'bn' && !empty($value->cat_title_bn)) {
                    $response[$key]['category_title'] = $value->cat_title_bn;
                }
                $response[$key]['category_slug'] = $value->category_slug;

                // get category data
                $sub_category_child = self::get_sub_category($value->category_id);

                if (count($sub_category_child) > 0) {
                    $response[$key]['sub_category_child'] = $sub_category_child;
                }

            }
        }

        return $response;

    }

    /**
        Get Parent Category Data
        Parameter is limit
     **/
    public static function categorys($limit = '1')
    {
        $lang = App::getLocale();

        $response = [];

        $main_category = DB::table('vw_product_category')
            ->where('vw_product_category.parent_category_id', null)
            ->limit($limit)
            ->inRandomOrder()
            ->get()
            ->toArray();

        if (count($main_category) > 0) {
            foreach ($main_category as $key => $value) {
                $response[$key]['category_id'] = $value->category_id;
                $response[$key]['category_title'] = $value->category_title;
                if ($lang == 'bn' && !empty($value->cat_title_bn)) {
                    $response[$key]['category_title'] = $value->cat_title_bn;
                }
                $response[$key]['category_slug'] = $value->category_slug;
                $response[$key]['image_link'] = $value->image_link;
            }
        }

        return $response;
    }


    public static function random_products()
    {
        $response = [];



        $product_data = DB::table('vw_product')->limit(12)->inRandomOrder()->select('product_id', 'product_title', 'product_slug', 'sell_price','offer_price','image', 'item_no', 'average_review')->get()->toArray();


        if (count($product_data) > 0) {
            foreach ($product_data as $key => $value) {
                $response[$key]['product_id'] = $value->product_id;
                $response[$key]['product_title'] = $value->product_title;

                $response[$key]['product_slug'] = $value->product_slug;
                $response[$key]['sell_price'] = $value->sell_price;

                $response[$key]['offer_price'] = $value->offer_price;
                $response[$key]['image'] = $value->image;
                $response[$key]['item_no'] = $value->item_no;
                $response[$key]['average_review'] = $value->average_review;
            }
        }


        return $response;

    }


    /**
        Custome filter & get attribute product data

     **/

    public static function custome_attribute_with_product($get_attribute_data){

        $filter_attribute_array = array();

        if(!empty($get_attribute_data)){

            $key='product';

            $product_attribute_data = DB::table('product_attribute');
            $product_attribute_data = $product_attribute_data->where('attribute_code',$key);

            $product_attribute_data = $product_attribute_data->where('attribute_data', 'LIKE', '%=='.$get_attribute_data.'==%');
            $product_attribute_data = $product_attribute_data->get();

            if(!empty($product_attribute_data)){

                foreach($product_attribute_data as $p_attr_data){

                                // TODO :: Prepare data for attribute value
                    array_push($filter_attribute_array,$p_attr_data->product_id);

                }
            }

        } //end main if

        return $filter_attribute_array;

    }

    /*end filter*/



}
