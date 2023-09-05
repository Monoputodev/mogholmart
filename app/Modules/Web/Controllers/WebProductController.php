<?php
namespace App\Modules\Web\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Modules\Web\Models\ProductViews;
use App\Modules\Product\Models\Product;
use App\Modules\Product\Models\VwProduct;
use App\Modules\Product\Models\ProductAttribute;
use App\Modules\Product\Models\ProductCategory;
use App\Modules\Product\Models\ProductReview;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\URL;
use DB;
use App;
use Session;


class WebProductController extends Controller
{
	public function index($slug)
    {
        $product_data = VwProduct::where('product_slug', $slug)->firstOrFail();

        #For Product Views Most Product View
        ProductViews::createViewLog($product_data);

        $product_id=$product_data->product_id;
        Session::put('pro_id',$product_id);

        if (!empty($product_data)) {
			$pageTitle = $product_data->product_title;

			// Product Image
			$product_image = DB::table('product_image')->where('product_id', $product_data->product_id)->get();

			// Product Brand
			$product_brand = DB::table('brand')
				->join('product_brand', 'brand.id', '=', 'product_brand.brand_id')
				->where('product_brand.product_id', $product_data->product_id)
				->select('brand.*')
				->get();

			// Product attribute
			$product_attribute_data = ProductAttribute::where('product_id', $product_data->product_id)->get();

			$review_data = ProductReview::where('product_review.product_id', $product_data->product_id)->where('status', 'active');
			$review_count=  $review_data->count();
			$review_data=  $review_data->paginate(5);



			// Get size & color
			$product_color_size = ProductAttribute::find_product_color_size($product_attribute_data, $product_data);

			$new_product_id_array = [];

			array_push($new_product_id_array,$product_id);

			if(count($new_product_id_array) > 0){
				$product_id_list = $new_product_id_array;
			}
          # Find product Brand
          # Find product attribute
			$attribute_list = Product::findProductAttribute($product_id_list);

			//dd($product_color_size);

			// find category in this product
			$product_category = ProductCategory::where('product_id', $product_data->product_id)->orderBy('category_id', 'desc')->first(['category_id']);

			// check category present or not
			if(empty($product_category)){
			    $product_category = [];
			}

			$find_product_id = ProductCategory::whereIn('category_id', $product_category)->get(['product_id'])->toArray();

			$related_product = VwProduct::whereIn('product_id', $find_product_id)
				->whereNotIn('product_id', [$product_data->product_id])
				->select('product_id', 'product_title',  'product_slug', 'sell_price', 'image', 'item_no', 'average_review', 'product_merchant_id','weight','category_id','quantity')
				->limit(12)
				->inRandomOrder()
				->get();

			$merchant_name = DB::table('merchant_profiles')->join('users','merchant_profiles.users_id','=','users.id')
				->where('merchant_profiles.users_id', $product_data->product_merchant_id)
				->first(['merchant_profiles.*','users.email','users.image']);

			//dd($merchant_name);

			$offer_product_data = DB::table('vw_product')
				->limit(12)
				->Where('offer_price','>',0)
				->inRandomOrder()
				->select('product_id', 'product_title', 'product_slug', 'sell_price','offer_price', 'image', 'item_no', 'average_review','product_merchant_id','weight','category_id','quantity')
				->get();

			return view("Web::details.product", compact('pageTitle','product_data','product_image','product_brand','product_attribute_data','related_product','product_color_size','review_data','merchant_name','product_category','review_count','offer_product_data','attribute_list'));
		}else{
			return back();
		    Session::flash('danger','No Product Found');

		}
    }



}

