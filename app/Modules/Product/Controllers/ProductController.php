<?php

namespace App\Modules\Product\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Product\Models\Product;
use App\Modules\Product\Models\ProductAttribute;
use App\Modules\Product\Models\Manufacturer;
use App\Modules\Product\Models\Brand;
use App\Modules\Product\Models\ProductImage;
use App\Modules\Product\Models\ProductDetails;
use App\Modules\Product\Models\ProductSeo;
use App\Modules\Product\Models\ProductReview;
use App\Modules\Product\Models\ProductInventory;

use App\Modules\Product\Models\ProductBrand;
use App\Modules\Product\Models\ProductCategory;

use App\Modules\Attribute\Models\AttributeSet;
use App\Modules\Attribute\Models\Attribute;
use App\Modules\Category\Models\Category;
use App\Modules\Attribute\Models\AttributeSetItems;

use App\Modules\Product\Models\VwAdminProductSearch;
use App\Modules\Product\Models\VwProduct;
use Illuminate\Support\Facades\Input;
use App\Modules\Product\Requests;
use Auth;
use DirectoryIterator;
use DB;
use Session;
use Image;
use File;
use Storage;
use App;
use App\User;
use glob;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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

    protected $general_image_path;
    protected $general_image_relative_path;
    protected $product_image_size;
    public function __construct()
    {

        $this->general_image_path = public_path('uploads/generel_file');
        $this->general_image_relative_path = '/uploads/generel_file';
        $this->product_image_size = DB::table('config')->where('key','product.image.size')->first(['value']);

    }

    /**
     * @return array
     */
    protected static function array_of_size()
    {
        $array_of_size = array(
            '50',
            '200',
            'orginal_image'
        );

        return $array_of_size;
    }

    /**
     *  Check if Directory Exists
     */
    protected static function check_directory($target_location, $value)
    {

        $target_location = $target_location.'/'.$value.'x'.$value;
        if (!Storage::disk('public')->exists($target_location)) 
        {
            $target_location = public_path($target_location);

            File::makeDirectory($target_location, 0777, true, true);         
        }
        
        return true;
    }


    public function index()
    { 
        $pageTitle = "List of Product Information";

        // Get Parent category data
        $data = Product::where('status','active')->orderBy('id','desc')->paginate(50);

        // return view
       return view("Product::product.index", compact('pageTitle','data'));
    }

    public function active_index()
    { 
        $pageTitle = "List of Active Product Information";

        // Get Parent category data
        $data = Product::where('status','active')->orderBy('id','desc')->paginate(50);

        // return view
       return view("Product::product.index", compact('pageTitle','data'));
    }

     public function inactive_index()
    { 
        $pageTitle = "List of Active Product Information";

        // Get Parent category data
        $data = Product::where('status','inactive')->orderBy('id','desc')->paginate(50);

        // return view
       return view("Product::product.index", compact('pageTitle','data'));
    }

     public function cancel_index()
    { 
        $pageTitle = "List of Cancel Product Information";

        // Get Parent category data
        $data = Product::where('status','cancel')->orderBy('id','desc')->paginate(50);

        // return view
       return view("Product::product.index", compact('pageTitle','data'));
    }

    public function merchant_list_index()
    {   

        $data=User::join('merchant_profiles','users.id','=','merchant_profiles.users_id')
                ->where('users.type','seller')
                ->select('users.email','users.first_name','users.last_name','users.merchant_agreement','users.status','users.image','users.mobile_no', 'users.id as user_id','merchant_profiles.*')
                ->get();
        
       return view("Product::merchant.merchantlist", compact('pageTitle','data'));

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function merchant_wise_product($id)
    {   
        $pageTitle = "List of Product Information";

        $data = Product::where('merchant_id',$id)->orderBy('id','desc')->paginate(50);

        // return view
       return view("Product::product.index", compact('pageTitle','data'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $pageTitle = "Add New Product";

        
        $attribute_set_lists = AttributeSet::pluck('title','id')->all();

        $merchant_lists = User::join('merchant_profiles','users.id','=','merchant_profiles.users_id')
                ->where('users.type','seller')->pluck('merchant_profiles.shop_name','users.id')->all();

        // return View
        return view("Product::product.create", compact('pageTitle','attribute_set_lists','merchant_lists'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\ProductRequest $request)
    {
         // Get all input data
        $input = Input::all();
       
        /* Transaction Start Here */
        DB::beginTransaction();
        try {

            // Store Product data 
           //$product_data = Product::create($input);

           $product_data = DB::table('product')->insertGetId(
                ['type' => $input['type'], 'merchant_id' => $input['merchant_id'],'attribute_set_id' => $input['attribute_set_id'],'status' => $input['status']]
            );
        
        
            DB::commit();
            Session::flash('message', 'Product is added!');

            return redirect(config('global.prefix_name').'/product/edit/'.$product_data);

        } catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
           
            Session::flash('danger', $e->getMessage());
        }

        // Redirect back to last page if error occurs 
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
        $pageTitle = 'View Product Informations';

        // Find Product data
        $data = Product::where('product.id',$id)->first();                    

        if(count($data) > 0)
        {
            // If found product
            return view("Product::product.show", compact('data','pageTitle'));

        }else{
            // If product not found
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
         $pageTitle = "Update Product";

        // Find Product
        $data = Product::join('users','product.merchant_id','=','users.id')->where('product.id',$id)->first(['users.first_name','users.last_name','product.*']);

        // If Product not found                
        if(!isset($data)){
            Session::flash('danger', 'Product not found.');
            return redirect()->route('admin.product.index');
        }
        $attribute_set_lists = [''=>'Please select Attribute Set']+ AttributeSet::pluck('title','id')->all();
        // Get parent & child hierarchy
        $manufacturer_lists = [''=>'Please select dealer']+ Manufacturer::where('status','active')->pluck('title','id')->all();
        $merchant_lists = [''=>'Please select Merchant']+User::join('merchant_profiles','users.id','=','merchant_profiles.users_id')
                ->where('users.type','seller')->pluck('merchant_profiles.shop_name','users.id')->all();
        // Return view
        return view("Product::product.edit", compact('data','manufacturer_lists','pageTitle','merchant_lists','attribute_set_lists'));
    }

    // get brand data.....................@@

    public function getbrand(Request $request)
    {

        $response = [];
        $response['data'] = '';

        $manufacturer_id = $_POST['manufacturer_id'];
        $product_id = $_POST['product_id'];

        $selected_brand = ProductBrand::where('product_id',$product_id)->pluck('brand_id')->all();

        $response['brand_data'] = [];

        $data1 = Brand::where('status','active')->where('manufacturer_id',$manufacturer_id)->pluck('title','id')->all();
        $data = Brand::where('status','active')->where('manufacturer_id',$manufacturer_id)->get();

        if(count($data1) > 0){
            foreach ($data1 as $key => $value){
                $response['data'] .= '<div class="checkbox-list">';
                $response['data'] .= '<input type="checkbox" name="ProductBrand[]" class="field" value="'.$key.'" id="brand_'.$key.'" '.(in_array($key,$selected_brand)?'checked':'').'>';
                $response['data'] .= '<label for="brand_'.$key.'" >'.$value.'</label>';
                $response['data'] .= '</div>';
            }
        }

        $i=0;
        if(count($data) > 0){
            foreach ($data as $key => $value){
                $response['brand_data'][$i]['id'] = $value->id;
                $response['brand_data'][$i]['text'] = $value->title;
                $response['brand_data'][$i]['level'] = 1;
                $i++;
            }
        }

        $response['selected'] = $selected_brand;


        $response['result'] = 'success';

        return $response;


        echo "<option value='0'>Select A Brand</option>";

        $branddata=DB::table('brand')
        ->join('manufacturer','brand.manufacturer_id','=','manufacturer.id')
        ->where('brand.manufacturer_id',$request->manufacturer_id)
        ->get(['brand.title','brand.id as brand_id']);

        foreach ($branddata as $key => $data) {
            echo '<option value="'.$data->brand_id.'">'.$data->title.'</option>';
        }
    }

    
    public function product_item_change()
    {

       /*$search_keywords="DIAP-";

       $model = Product::where('item_no', 'LIKE', '%'.$search_keywords.'%')
       ->orderby('id','asc')
       /*->offset(1000)*/
      /* ->limit(500)*/
       //->get(['id','item_no','merchant_id']);
        //$ccc=0;
       //foreach ($model as $key => $value) {
         // $ccc++;
        //$item=$value->item_no;
        //$merchant=$value->merchant_id;
       // $id=$value->id;*/

        //echo $ccc.'=====>'.$item .'<br>';

        //$data=str_replace('ZM-','', $item);

        //$item_no_custom='ZM-'.$merchant.'-'.$item.'-'.str_pad($id, 8, "0", STR_PAD_LEFT);

        //echo $data  .'<br>';
        //echo $item_no_custom  .'<br>';

        //$update=DB::table('product')->where('item_no',$item)->update(['item_no'=>$item_no_custom]);

        
         
       //}

       /*if ($update) {
          echo "success";
        }*/
    }
   

    // Product Basic info update
    public function update(Requests\ProductBaseicRequest $request, $id)
    {   

        $pid=$id;
        $input = Input::all();
        $input['slug'] = str_slug($input['slug']);
        
        //dd($input);

        // Find Product
        $model = Product::where('product.id',$id)->first();

        $item = $request->item_no;
        $merchant=$request->merchant_id;

        $input['item_no']=$input['item_no'];

        if ($input['item_no_copy']==null) {
                    
            $item_no_custom=$item.'-'.str_pad($id, 5, "0", STR_PAD_LEFT);
            $input['item_no'] =$item_no_custom;                

        }
        //for short description data
        if (intval($input['weight']) <= 999 && $input['unit']=='gram') {
            $weight=number_format($input['weight'])."&nbsp;"."g";

        }elseif (intval($input['weight']) <= 999 && $input['unit']=='millilitre') {
            $weight=number_format($input['weight'])."&nbsp;"."mL";

        }elseif (intval($input['weight']) >= 1000 && $input['unit']=='kg') {

            $sub_weight=intval($input['weight'])/1000;

            $floatweight=(float)$sub_weight;

            $weight=number_format($floatweight)."&nbsp;"."kg";

        }elseif (intval($input['weight']) >= 1000 && $input['unit']=='litre') {

            $sub_weight=intval($input['weight'])/1000;

            $floatweight=(float)$sub_weight;

            $weight=number_format($floatweight)."&nbsp;"."L";

        }

    $input['short_description']="Product Name: ".$input['title'].". <br> \n"."Product Weight: ".$weight;

        //end for short description.

        if($model)
        {   

           
            // Check Slug
            $check_slug = Product::where('slug',$input['slug'])
                        ->first();

            // Find unique product
            if(count($check_slug) > 0 && $check_slug->id == $id)
            {
                // Slug presents in current id
                $product_update_required = 'yes';
            }elseif (count($check_slug) > 0 && $check_slug->id != $id) {
                // Slug present, but not in current id
                $product_update_required = 'no';
            }else{
                // Slug not present
                $product_update_required = 'yes';
            }   


            if($product_update_required == 'yes')
            {
                 DB::beginTransaction();
                try {

                    
                   // Update product basic info
                    $result = $model->update($input);

                    if ($result) {
                        
                        // If brand data is selected
                        if(isset($input['brand']) && count($input['brand']) > 0)
                        {
                            // Find old brand
                            $old_brands = ProductBrand::where('product_id',$id)->pluck('brand_id')->all();
                            $new_brands = [];

                            foreach ($input['brand'] as $key => $brand_id){
                                // Find brand in this product
                                $model = ProductBrand::where('brand_id',$brand_id)->where('product_id',$id)->first();

                                if ($model) {
                                   // Do nothing
                                } else {
                                    // New brand is found
                                    $model = new ProductBrand();
                                    $model->brand_id = $brand_id;
                                    $model->product_id = $id;

                                    $model->save();
                                    
                                }

                                // all brand push in new brand
                                array_push($new_brands,$model->brand_id);
                            }

                            // find differentiate in old brands & new brands
                            $removed_brands = array_diff($old_brands,$new_brands);

                            // Delete not selected brand
                            ProductBrand::where('product_id',$id)->whereIn('brand_id',$removed_brands)->delete();                            
                        }
                        

                        DB::commit();

                        Session::flash('message', 'Successfully updated!');

                        // Press Save & Continue
                        if (isset($input['save_continue']) && $input['save_continue'] == 'Save & Continue') {
                            return redirect()->back();
                        }

                        // Press Save & Finish
                        if (isset($input['finish']) && $input['finish'] == 'Save & Finished') {
                            return redirect(config('global.prefix_name').'/product/index');
                        }

                     }
                    
                }
                catch (\Exception $e) {
                    //If there are any exceptions, rollback the transaction`
                    DB::rollback();
                    Session::flash('danger', $e->getMessage());
                }

            }else{
                Session::flash('danger','This slug already presents in another product, Please another one.');
            }

           
        }
        

        return redirect()->back();

    }

    public function destroy($id)
    {
        // Find Product 

       $model = Product::where('product.id',$id)
       ->select('product.*')
       ->first();

       DB::beginTransaction();
       try {

         if ($model) {
             
             
             
             
             
             $deleteimage = DB::table('product_image')->where('product_id', $model->id)->delete();
             
            $delete_brand = ProductBrand::where('product_id',$model->id)->delete();
            $delete_attribute = DB::table('product_attribute')->where('product_id',$model->id)->delete();
            $delete_product_category = DB::table('product_category')->where('product_id',$model->id)->delete();
            $product_inventory = DB::table('product_inventory')->where('product_id',$model->id)->delete();
            $product_inventory = DB::table('product_inventory')->where('product_id',$model->id)->delete();
            $product_review = DB::table('product_review')->where('product_id',$model->id)->delete();
            $product_seo = DB::table('product_seo')->where('product_id',$model->id)->delete();
            $product_shipping = DB::table('product_shipping')->where('product_id',$model->id)->delete();
            $product_views = DB::table('product_views')->where('product_id',$model->id)->delete();

                
        }

        if ($delete_all=$model->delete()) {
            
            DB::commit();
            Session::flash('message', "Successfully Deleted.");
        }


    } catch(\Exception $e) {
        DB::rollback();
        Session::flash('danger',$e->getMessage());
    }

        // redirect to current page
    return redirect()->back();
}



    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {

        
        $pageTitle = 'Product Information';

        // Product model initialize
        $model = new VwAdminProductSearch();
         $search_keywords = trim(Input::get('search_keywords'));
        if($this->isGetRequest())
        {
            // Search data found
           

            $model = $model->where(function ($query) use($search_keywords){
            $query = $query->orWhere('product_title', 'LIKE', '%'.$search_keywords.'%');
            $query = $query->orWhere('product_slug', 'LIKE', '%'.$search_keywords.'%');

            $query = $query->orWhere('manufacturer', 'LIKE', '%'.$search_keywords.'%');
            $query = $query->orWhere('brand', 'LIKE', '%'.$search_keywords.'%');
            $query = $query->orWhere('item_no', 'LIKE', '%'.$search_keywords.'%');

            $query = $query->orWhere('meta_title', 'LIKE', '%'.$search_keywords.'%');
            $query = $query->orWhere('meta_keywords', 'LIKE', '%'.$search_keywords.'%');
            $query = $query->orWhere('meta_description', 'LIKE', '%'.$search_keywords.'%');
            $query = $query->orWhere('category_title', 'LIKE', '%'.$search_keywords.'%');
            $query = $query->orWhere('cat_meta_keywords', 'LIKE', '%'.$search_keywords.'%');

            });


            $data = $model->select('product_id as id', 'product_title as title', 'product_slug as slug','status','manufacturer','attribute_title')->orderBy('product_id','desc');

           
            $data = $model->paginate(50)->setPath('');

            $data->appends(['search_keywords' => Input::get('search_keywords')]);

        }else{

            // If get data not found
            $data = VwAdminProductSearch::select('product_id as id', 'product_title as title','product_slug as slug','status','manufacturer','attribute_title')->orderBy('product_id','desc')->paginate(50)->setPath('');

            $data->appends(['search_keywords' => Input::get('search_keywords')]);
        }



        // Return view
        return view("Product::product.index", compact('data','pageTitle'));
        

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function image($id)
    {
        $pageTitle = "Update Image";

        // Find Product
        $data = Product::where('product.id',$id)->first();

        // If Product not found                
        if(empty($data)){
            Session::flash('danger', 'Image not found.');
            return redirect()->route('admin.product.index');
        }

        $imagedata=ProductImage::where('product_image.product_id',$id)->get();
       
        // Return view
        return view("Product::product._image_form", compact('data','pageTitle','imagedata'));
    }

    /**
     * @param $size
     * @param $precision
     * @return value 
     */
    public static function formatBytes($size, $precision = 2)
    {
        $base = log($size, 1024);
        $suffixes = array('', 'K', 'M', 'G', 'T');   

        return round(pow(1024, $base - floor($base)), $precision).$suffixes[floor($base)];
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update_image(Requests\ProductImageRequest $request, $id)
    {
        // Set mime type 
        $mime_type_data = ['image/jpeg','image/jpg','image/png','image/gif'];
        // Check product data 
        $productdata = Product::where('product.id',$id)->first();

        if(count($productdata) > 0)
        {
            $slug=$productdata->slug;  

            DB::beginTransaction();
            try {

                // Check image file exists or not
                if($request->hasfile('file')){
                   
                   $count = 1;
                    foreach($request->file('file') as $image)
                    { 

                        $image_info = getimagesize($image);
                        


                        // check image dimension in width & height
                        // if((isset($image_info['0']) && $image_info['0'] != $this->product_image_size->value) && isset($image_info['1']) && $image_info['1'] != $this->product_image_size->value){
                        //     Session::flash('error', 'Image size must be width "'.$this->product_image_size->value.'" px & height "'.$this->product_image_size->value.'" px');    
                        //     break;
                        // }

                        // Check image mime type
                        // if(isset($image_info['mime']) && !in_array($image_info['mime'], $mime_type_data))
                        // {
                        //     Session::flash('error', 'Invalid image type');    
                        //     break;
                        // }

                        // Check image size
                        
                        if($image->getClientSize() > 2e+6)
                        {
                            Session::flash('error', 'Image size much bigget than 2M');    
                            break;   
                        }
                       
                        // generate image name
                        $name=$slug.'-'.time().'-'.$count.'.'.$image->getClientOriginalExtension();
                        $path_image_link='/uploads/product';

                        // upload image & create directory
                        $this->image_upload($name,$image->getRealPath(),$path_image_link,$id);

                        // Prepare image_link field value
                        
                        $image_link=$path_image_link.'/'.$id;

                        $model=DB::table('product_image')
                        ->insert([

                            'product_id' => $id,
                            'image_link' =>  $image_link,  
                            'image' =>  $name,
                            'created_by'=>Auth::user()->id,
                            'created_at'=>date('Y-m-d h:i:s'),  
                           
                        ]);

                        // Check product image is uplode or not
                        if($model){
                            DB::commit();
                            Session::flash('message', 'Successfully updated!'); 
                        }else{
                            Session::flash('error', 'Image not inserted');    
                        } 

                        $count++;

                    } // end foreach

                           
                    } // end if

                                        
                    // Press Save & Continue
                    if (isset($input['save_continue']) && $input['save_continue'] == 'Save & Continue') {
                        return redirect()->back();
                    }

                                // Press Save & Finish
                    if (isset($input['finish']) && $input['finish'] == 'Save & Finished') {
                        return redirect(config('global.prefix_name').'/product/index');
                    }

                }catch (\Exception $e) {
                        //If there are any exceptions, rollback the transaction`
                    DB::rollback();
                    Session::flash('danger', $e->getMessage());
                }

                // redirect to current page  
        }

        return redirect()->back();

    }


    /**
     * @param string $image
     * @param string $destinationPath
     * @return array
     */

    public static function image_upload($image_name, $realpath, $destinationPath, $id)
    {
        // Check image name presents or not
        if ($image_name != '')
        {   
            // get sizes
            $sizes = self::array_of_size();

            if(count($sizes)>0)
            {
                $destinationPath = $destinationPath."/".$id;
                $uploaddestinationPath = $destinationPath;
                foreach ($sizes as $value)
                {   

                    if ($value=='orginal_image') {
                        $target_location = $uploaddestinationPath.'/'.'orginal_image';
                        if (!Storage::disk('public')->exists($target_location)) 
                        {
                            $target_location = public_path($target_location);

                            File::makeDirectory($target_location, 0777, true, true);         
                        }

                            // upload image
                        $destinationPath =  public_path($target_location);

                        $img = Image::make($realpath);
                        $img->save($target_location.'/'.$image_name);
                    }elseif ($value!='orginal_image') {
                       // create directory
                        $target_location = $uploaddestinationPath.'/'.$value.'x'.$value;
                        if (!Storage::disk('public')->exists($target_location)) 
                        {
                            $target_location = public_path($target_location);

                            File::makeDirectory($target_location, 0777, true, true);         
                        }

                        // upload image
                        $destinationPath =  public_path($target_location);

                        $img = Image::make($realpath);
                        $img->resize($value, $value, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save($target_location.'/'.$image_name);
                    }

                }
            }

        }

        return true;

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function DeleteImage($id)
    {

        $check_image=ProductImage::where('product_image.id',$id)->first();

        if(count($check_image) > 0)
        {
            DB::beginTransaction();
            try {
                // Check sizes    
                $sizes = self::array_of_size();

                if(count($sizes) > 0)
                {
                    foreach($sizes as $value)
                    {   

                        if ($value=='orginal_image') {
                             $imagePath = $check_image->image_link.'/'.'orginal_image'.'/'.$check_image->image;

                             $realImagePath = public_path($imagePath);
                            // remove image from folder
                             if(file_exists($realImagePath)){
                                unlink($realImagePath);   
                            }
                        }elseif($value!='orginal_image'){

                             $imagePath = $check_image->image_link.'/'.$value.'x'.$value.'/'.$check_image->image;

                             $realImagePath = public_path($imagePath);
                            // remove image from folder
                             if(file_exists($realImagePath)){
                                unlink($realImagePath);   
                            }
                        }

                        
                    }
                }
        
                // delete image
                $deleteimage=DB::table('product_image')->where('product_image.id',$id)->delete();
               
                if($deleteimage)
                {
                    DB::commit();
                    return 'true';    
                }else{
                    return 'false';
                }
                
            }catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                Session::flash('danger', $e->getMessage());
            }
        }

        
 
    }
 
    /**
     * @param $id
     * @return Views
     */
    public function image_show($id)
    {
 
        $response = [];
 
        $pageTitle = "Product Image Show";
 
        // Find image option
        $data = ProductImage::find($id);
        $imageid=$data->id;
 
        if(count($data) > 0)
        {
 
            $view = \Illuminate\Support\Facades\View::make('Product::product.show_image',compact('data','pageTitle','imageid'));
 
            $contents = $view->render();
 
            $response['result'] = 'success';
            $response['content'] = $contents;
 
        }else{
 
            $response['result'] = 'error';
 
        }
 
        return $response;
 
       
    }
    // for image upload

    


    /**
     * @param $id
     * @return Views
     */

    public function descriptionform($id)
    {
        $pageTitle = "Update Description";

        // Find Product
        $data = Product::where('product.id',$id)->first();

        // If Product not found                
        if(empty($data)){
            Session::flash('danger', 'Description not found.');
            return redirect()->route('admin.product.index');
        }

       
        // Return view
        return view("Product::product.descriptionform", compact('data','pageTitle'));
    }



    /**
     * @param $id
     * @return Update
     */
    public function description_update(Requests\ProductDetailsRequest $request,$id)
    {
        $input = Input::all();
        $model = Product::where('product.id',$id)->first();

        if(count($model) > 0 )
        {
                DB::beginTransaction();
                try {
                    // Update product basic info
                    $result = $model->update($input);
                        

                        DB::commit();

                        Session::flash('message', 'Successfully updated!');

                        // Press Save & Continue
                        if (isset($input['save_continue']) && $input['save_continue'] == 'Save & Continue') {
                            return redirect()->back();
                        }

                        // Press Save & Finish
                        if (isset($input['finish']) && $input['finish'] == 'Save & Finished') {
                            return redirect(config('global.prefix_name').'/product/index');
                        }

                    }catch (\Exception $e) {
                    //If there are any exceptions, rollback the transaction`
                    DB::rollback();
                    Session::flash('danger', $e->getMessage());
                }

            }else{
                Session::flash('error', 'this input allready added!');            }
            return redirect()->back();
    }


    /**
     * @param $id
     * @return Views
     */

    public function seo($id)
    {
        $pageTitle = "Prodcut SEO";

        // Find Product
        $data = Product::where('product.id',$id)->first();

        // If Product not found                
        if(empty($data)){
            Session::flash('danger', 'Seo not found.');
            return redirect()->route('admin.product.index');
        }

        // Get seo data
        $seo_data=ProductSeo::where('product_seo.product_id',$id)->first();
       
        // Return view
        return view("Product::product.seo", compact('data','pageTitle','seo_data'));
    }

    // for seo update-----------------------

    public function seo_update(Requests\ProductSeoRequest $request,$id)
    {       
        
// Find product data
        $data = Product::where('id',$id)->first();

        // If data is found
        if(count($data) > 0)
        {
            // Get all request
            $input=Input::all();

            // Transaction start
            DB::beginTransaction();
            try {

                // Get Seo data 
                $seo_data = ProductSeo::where('product_id',$id)->first();

                if(count($seo_data) > 0)
                {   // For update
                    $seo_modal=$seo_data->update($input);
                }else{
                    // For Insert
                    $seo_data = new ProductSeo();

                    $seo_data->product_id = $id;
                    $seo_data->meta_title = $input['meta_title'];
                    $seo_data->meta_keywords = $input['meta_keywords'];
                    $seo_data->meta_description = $input['meta_description'];
                    $seo_data->meta_image_link = $input['meta_image_link'];

                    $seo_data->save();

                }


                DB::commit();
                // Press Save & Continue
                if (isset($input['save_continue']) && $input['save_continue'] == 'Save & Continue') {
                    return redirect()->back();
                }

                // Press Save & Finish
                if (isset($input['finish']) && $input['finish'] == 'Save & Finished') {
                    return redirect(config('global.prefix_name').'/product/index');
                }


            }catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                Session::flash('danger', $e->getMessage());
            }


            
         }else{
            Session::flash('danger', 'Product not found');
         }  

        return redirect()->back();
}

        
        public function category_update(Request $request,$id)
        {
            
            $input = Input::all();

            // Find Product
            $data = Product::where('product.id',$id)->first();

            // If Product not found                
            if(count($data) <= 0){
                Session::flash('danger', 'Product not found.');
                return redirect()->route('admin.product.index');
            }

            // Transaction start
            DB::beginTransaction();
            try {

                if(isset($input['category']) && count($input['category']) > 0)
                {

                    $old_category_array = [];
                    $new_category_array = [];

                    $old_category = DB::table('product_category')->where('product_id',$id)->get();
                    if(!empty($old_category)){
                        foreach ($old_category as $item){
                            array_push($old_category_array,$item->category_id);
                        }
                    }

                   
                    $category_data = $input['category'];

                    foreach($input['category'] as $key => $value)
                    {

                        $category_exits = DB::table('category')->where('status','active')->where('id',$value)->first();


                        if(!empty($category_exits)){

                            array_push($new_category_array,$category_exits->id);

                            $already_presents_category_rel = DB::table('product_category')->where('product_id',$id)->where('category_id',$value)->first();


                            if(empty($already_presents_category_rel)){

                                $category_model = new ProductCategory();

                                $category_model->product_id = $id;
                                $category_model->category_id = $value;

                                $category_model->save();

                            }

                        }
                    }



                    $deleted_category = array_diff($old_category_array, $new_category_array);
                    if(!empty($deleted_category)){
                        DB::table('product_category')->whereIn('category_id',$deleted_category)->where('product_id',$id)->delete();
                    }
                    
                }

                DB::commit();

                // Press Save & Continue
                if (isset($input['save_continue']) && $input['save_continue'] == 'Save & Continue') {
                    return redirect()->back();
                }

                // Press Save & Finish
                if (isset($input['finish']) && $input['finish'] == 'Save & Finished') {
                    return redirect(config('global.prefix_name').'/product/index');
                }

            }catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                Session::flash('danger', $e->getMessage());
            }

            return redirect()->back();
            
        }
    
        //======================product category=====================

        public function product_category($id)
        {
            $pageTitle = "Prodcut Category";

            // Find Product
            $data = Product::where('product.id',$id)->first();

            // If Product not found                
            if(empty($data)){
                Session::flash('danger', 'Product not found.');
                return redirect()->route('admin.product.index');
            }

            // Get Category list
            $category_lists = Category::getHierarchyCategory('');
            //array_shift($category_lists);
            unset($category_lists['']);


            // assigned category
            $product_category = DB::table('product_category')->where('product_id',$id)->pluck('category_id')->all();

            // Return view
            return view("Product::product.category", compact('data','pageTitle','category_lists','product_category'));
        }

    //==========================product attribute=======================
    public function product_attribute($id)
    {
         $pageTitle = "Prodcut Attribute";

        // Find Product
        $data = Product::with('relProductAttribute')->where('product.id',$id)->first();

        // If Product not found                
        if(empty($data)){
            Session::flash('danger', 'Product not found.');
            return redirect()->route('admin.product.index');
        }

        // Attribute lists found 
        $attributes_list = Attribute::join('attribute_set_items','attribute_set_items.attribute_id','=','attribute.id')->where('attribute_set_items.attribute_set_id',$data->attribute_set_id)->select('attribute.*')->get();
            $attributes = [];

            if(count($attributes_list) > 0){
                foreach ($attributes_list as $item){
                    $attributes[$item->code_column] = $item;
                }
            }

        // Return view
        return view("Product::product.productAttribute.productattribute", compact('data','pageTitle','attributes'));
    }

    public function product_attribute_update(Request $request,$id)
    {
      
        // Get all request
        $input=Input::all();

        // Initalize blank array
        $attr_model_list = [];
        $new_attr_list = [];

        // find current inseted attribute
        $old_attr_list = ProductAttribute::where('product_id',$id)->pluck('attribute_code')->all();
        if(isset($_POST['Attribute'])){
            foreach ($_POST['Attribute'] as $attr_key => $attr_value){

                // Find ProductAttribute 
                $attr_model = ProductAttribute::where('product_id',$id)->where('attribute_code',$attr_key)->first();
                if(!$attr_model){
                    $attr_model = new ProductAttribute();
                }

                $attr_model->attribute_code = $attr_key;
                if(is_array($attr_value)){
                    $attr_value = implode('==',$attr_value);
                }

                // Prepare attribute data 
                $attr_model->attribute_data = '=='.$attr_value.'==';
                
                $attr_model->product_id = $id;

                array_push($attr_model_list,$attr_model);
                array_push($new_attr_list,$attr_model->attribute_code);
            }
        }

        // Find difference attribute
        $removed_attr_list = array_diff($old_attr_list,$new_attr_list);

        // Transaction start
        DB::beginTransaction();
        try {

            // Save attribute
            if(count($attr_model_list) > 0){
                foreach ($attr_model_list as $attr){
                    $attr->save();
                }
            }

            // Delete attributee
            if(count($removed_attr_list) > 0){

                $del = DB::table('product_attribute')
                        ->where('product_id',$id)
                        ->whereIn('attribute_code',$removed_attr_list)
                        ->delete();
                
            }

            DB::commit();
            // Press Save & Continue
            if (isset($input['save_continue']) && $input['save_continue'] == 'Save & Continue') {
                Session::flash('message','Successfully Attribute Added');
                return redirect()->back();
            }

            // Press Save & Finish
            if (isset($input['finish']) && $input['finish'] == 'Save & Finished') {
                return redirect(config('global.prefix_name').'/product/index');
            }


        }catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            Session::flash('danger', $e->getMessage());
        }
    

        return redirect()->back();
    }


    //Product inventory

    public function product_inventory($id)
    {
        $pageTitle = "Prodcut Inventory";

        // Find Product
        $data = Product::where('product.id',$id)->first();

        // If Product not found                
        if(empty($data)){
            Session::flash('danger', 'Inventory not found.');
            return redirect()->route('admin.product.index');
        }

        // Get invetory data
        $inventory_data=ProductInventory::where('product_inventory.product_id',$id)->first();
       
        // Return view
        return view("Product::product.productInventory.inventory", compact('data','pageTitle','inventory_data'));
    }

    //Product inventory update

    public function product_inventory_update(Request $request,$id)
    {
         // Find product data
        $data = Product::where('id',$id)->first();

        // If data is found
        if(count($data) > 0)
        {
            // Get all request
            $input=Input::all();

            // Transaction start
            DB::beginTransaction();
            try {

                // Get product inventory data 
                $inventory_data = ProductInventory::where('product_id',$id)->first();

                if(count($inventory_data) > 0)
                {   // For update
                    $seo_modal=$inventory_data->update($input);

                }else{
                    // For Insert
                    $inventory_data = new ProductInventory();

                    $inventory_data->product_id = $id;
                    $inventory_data->warehouse = $input['warehouse'];
                    $inventory_data->item_number = $input['item_number'];
                    $inventory_data->quantity = $input['quantity'];
                    $inventory_data->note = $input['note'];
                    $inventory_data->save();

                }


                DB::commit();
                // Press Save & Continue
                if (isset($input['save_continue']) && $input['save_continue'] == 'Save & Continue') {
                    Session::flash('message','Successfully  Added');
                    return redirect()->back();
                }

                // Press Save & Finish
                if (isset($input['finish']) && $input['finish'] == 'Save & Finished') {
                    return redirect(config('global.prefix_name').'/product/index');
                }


            }catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                Session::flash('danger', $e->getMessage());
            }


            
        }else{
            Session::flash('danger', 'Product not found');
        }  

        return redirect()->back();
    }

    //product review
     public function product_review($id)
    {
        $pageTitle = "Prodcut Review";

        // Find Product
        $data = Product::where('product.id',$id)->first();

        // If Product not found                
        if(empty($data)){
            Session::flash('danger', 'Review not found.');
            return redirect()->route('admin.product.index');
        }

        // Get review data
        $review_data=ProductReview::where('product_review.product_id',$id)->get();


       
        // Return view
        return view("Product::product.product_review", compact('data','pageTitle','review_data'));
    }

    //product preview
     public function product_preview($id)
    {
        $pageTitle = "Prodcut Preview";

        // Find Product
        $data = VwProduct::where('product_id',$id)->first(['vw_product.product_id as id','vw_product.*']);
        $imagedata=ProductImage::where('product_image.product_id',$id)->get();
        // If Product not found                
        if(empty($data)){
            Session::flash('danger', 'Preview not found.');
            return redirect()->route('admin.product.index');
        }

        $headerData = Product::where('product.id',$id)->first();

        // Return view
        return view("Product::product.product_preview", compact('data','pageTitle','imagedata','headerData'));
    }

   

    //product emi//

     public function product_emi($id)
    {
        $pageTitle = "Prodcut EMI";

        // Find Product
        $data = Product::where('product.id',$id)->first();

        // If Product not found                
        if(empty($data)){
            Session::flash('danger', 'Emi not found.');
            return redirect()->route('admin.product.index');
        }

        // Return view
        return view("Product::product.product_emi", compact('data','pageTitle'));
    }


        public function product_emi_update(Request $request,$id)
    {
         // Find product data
        $data = Product::where('id',$id)->first();

        // If data is found
        if(count($data) > 0)
        {
            // Get all request
            $input=Input::all();

            // Transaction start
            DB::beginTransaction();
            try {

                $model=$data->update($input);

                DB::commit();
                // Press Save & Continue
                if (isset($input['save_continue']) && $input['save_continue'] == 'Save & Continue') {
                    Session::flash('message','Successfully  Added');
                    return redirect()->back();
                }

                // Press Save & Finish
                if (isset($input['finish']) && $input['finish'] == 'Save & Finished') {
                    return redirect(config('global.prefix_name').'/product/index');
                }


            }catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                Session::flash('danger', $e->getMessage());
            }


            
        }else{
            Session::flash('danger', 'Product not found');
        }  

        return redirect()->back();
    }

  
    public function general_file_uploder(Request $request)
    {  
        $pageTitle = "General file uploader";

        $dir_path = public_path() . '/uploads/generel_file/';
        $files = new DirectoryIterator($dir_path);

        $files_array = [];

        if(!empty($files )){
          foreach($files as $fileinfo){
            if(!$fileinfo->isDot()){
               array_push($files_array,$fileinfo->getFilename());
            }
          }
        }
        asort($files_array);
  
        return view("Product::generalimage.index", compact('pageTitle','files_array'));
        
        // Return view
        
    }

    public function general_file_uploder_store(Request $request)
    {
       // Get all input data
        $input = Input::all();

       
            // Image link 
            $general_file = $request->file('image_link');

            if($general_file) {
                $image_title = str_replace(' ', '-',time().'-'.$input['title'] . '.' . $general_file->getClientOriginalExtension());
                $image_link = $this->general_image_relative_path.'/'.$image_title;

            }else{
                $image_link = '';
                $image_title = '';
            }

            $input['image_link'] = $image_title;

            try {

                // Store Brand image
                if($general_file != null){
                    $general_file->move($this->general_image_path, $image_title);
                }

                
                Session::flash('message', 'General file upload successfully');

                return redirect(config('global.prefix_name').'general/product/file');

            } catch (\Exception $e) {
               
                print($e->getMessage());
                Session::flash('danger', $e->getMessage());
            }

       
        return redirect()->back();
    }


    //click hear to download pdf

    public function merchant_wise_product_csv($id)
    {

        $pageTitle = "List of Product Information";

        $merchant_lists = User::join('merchant_profiles','users.id','=','merchant_profiles.users_id')->where('users.type','seller')->where('users.id',$id)->select('merchant_profiles.shop_name','users.id')->first();

        $data = Product::where('merchant_id',$id)->orderBy('id','desc')->paginate(200);

         // return view
        return view("Product::merchant.product_list", compact('pageTitle','data','merchant_lists'));

    }


}
