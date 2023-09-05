<?php


namespace App\Http\Helpers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use \Illuminate\Support\Facades\Route;


class FilterHelper
{

	public static function filter_brand_list($brand_list = [])
	{
	    $model = DB::table('product_brand');
	    $model = $model->join('brand','brand.id','=','product_brand.brand_id');

	    $model = $model->whereIn('brand.title',$brand_list);
	    $model = $model->select('brand.title','product_brand.product_id');
	    $model = $model->get();

	    $new_product_list = [];

	    if(count($model) > 0)
	    {
	        foreach($model as $value)
	        {
	            array_push($new_product_list,$value->product_id);
	        }
	    }

	    //
	    $response = array_unique($new_product_list, SORT_REGULAR);

	    return $response;

	}




	public static function filter_price_list($filter_max = '',$filter_min = '')
	{

	    $model = DB::table('vw_product');
	    $model = $model->whereBetween('vw_product.sell_price', [$filter_min, $filter_max]);
	    $model = $model->select('product_id');
	    $model = $model->get();

	    $new_product_list = [];

	    if(count($model) > 0)
	    {
	        foreach($model as $value)
	        {
	            array_push($new_product_list,$value->product_id);
	        }
	    }

	    //
	    $response = array_unique($new_product_list, SORT_REGULAR);

	    return $response;

	}

	public static function filter_rating_list($filter_rating ='')
	{

	    $model = DB::table('vw_product');
	    $model = $model->where('vw_product.average_review',$filter_rating);
	    $model = $model->select('product_id');
	    $model = $model->get();

	    $new_product_list = [];

	    if(count($model) > 0)
	    {
	        foreach($model as $value)
	        {
	            array_push($new_product_list,$value->product_id);
	        }
	    }

	    //
	    $response = array_unique($new_product_list, SORT_REGULAR);

	    return $response;

	}

	

	public static function search_attribute_with_product($get_request){

	    $filter_attribute_array = array();
	    $key_count = 1;

	    foreach($get_request as $key => $values){

	        if($key != 'brand' && $key != 'search' &&
	            $key != 'sort_by' && $key !='page' && !empty($values)){

	            // explode attribute values from url
	            $filter_attribute_r = explode(",",$values);

	            $total_attribute = count($filter_attribute_r);

	            $key_array = array();

	            foreach($filter_attribute_r as $filter_attribute){

	                if(!empty($filter_attribute)){

	                    $product_attribute_data = DB::table('product_attribute');
	                    $product_attribute_data = $product_attribute_data->where('attribute_code',$key);
	                    
	                    $product_attribute_data = $product_attribute_data->where('attribute_data', 'LIKE', '%=='.$filter_attribute.'==%');
	                    $product_attribute_data = $product_attribute_data->get();

	                    if(!empty($product_attribute_data)){

	                        foreach($product_attribute_data as $p_attr_data){

	                            // TODO :: Prepare data for attribute value
	                            array_push($key_array,$p_attr_data->product_id);

	                        }
	                    }


	                }

	                if($key_count == $total_attribute){

	                    if($filter_attribute_array != ''){
	                        $filter_attribute_array = $key_array;
	                    }else{

	                        $filter_attribute_array = array_intersect($filter_attribute_array,$key_array);

	                    }

	                    $key_count = 1;

	                }else{

	                    if($filter_attribute_array != ''){
	                        // echo 'sss';
	                        $filter_attribute_array = array_intersect($filter_attribute_array,$key_array);
	                    }else{

	                        $filter_attribute_array = array_intersect($filter_attribute_array,$key_array);

	                    }



	                }

	                $key_count++;

	            }



	        }



	    }


	    return $filter_attribute_array;

	}


}