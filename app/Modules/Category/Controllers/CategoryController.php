<?php

namespace App\Modules\Category\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Category\Models\Category;
use App\Modules\Category\Models\CategorySelfRelation;
use App\Modules\Category\Requests;
use Illuminate\Support\Facades\Input;
use DB;
use Session;
use Image;
use File;
use Storage;
use App;
Use Auth;

class CategoryController extends Controller
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

    protected $category_image_path;
    protected $category_image_relative_path;



    /**
     * CategoryController constructor.
     */
    public function __construct()
    {

        $this->category_image_path = public_path('uploads/category');
        $this->category_image_relative_path = '/uploads/category';

        $this->category_image_banner_path = public_path('uploads/category/banner');
        $this->category_image_banner_relative_path = '/uploads/category/banner';

    }

    protected static function array_of_size()
    {
        $array_of_size = array(
            'orginal_image',
            '200'
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = "List of Category Information";

        
        // Get Parent category data
        $data = Category::join('category_self_relation', 'category_self_relation.child_category_id', '=', 'category.id')
                ->where('category_self_relation.parent_category_id',NULL)
                ->whereNotIn('category.status',['cancel'])
                ->select('category.*')
                ->orderby('category.short_order','asc')
                ->get();
        // return view
        return view("Category::category.index", compact('data','pageTitle'));
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sub_category($id)
    {
        $pageTitle = "List of Category Information";

        // Get Parent category data
        $data = Category::join('category_self_relation', 'category_self_relation.child_category_id', '=', 'category.id')
                ->where('category_self_relation.parent_category_id',$id)
                ->whereNotIn('category.status',['cancel'])
                ->select('category.*')
                ->orderby('category.short_order','asc')
                ->get();


        // return view
        return view("Category::category.index", compact('data','pageTitle'));
    }

    public function category_product_list($category_id)
    {
        $pageTitle = "List of Category Wise Product";

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

          $data = DB::table('product')->whereIn('id',$product_id_list)->select('title','slug','item_no','status','id');
          $total_product = $data->count();
          $data = $data->orderby('id','desc');
          $data = $data->paginate(50);

        // return view
        return view("Category::category.product_index", compact('data','pageTitle','total_product'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = "Add New Category";

        // find child & parent relations
        $parent_category_options = Category::getHierarchyCategory('');

        // return View
        return view("Category::category.create", compact('parent_category_options','pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\CategoryRequest $request)
    {   
        // Get all input data
        $input = $request->all();

        // Check already presents or not
        $data = Category::where('slug',$input['slug'])->exists();

        if(!$data )
        {
            // Set parent cateogry id 
            if(isset($_POST['parent_category'])){
                $category_self_relation = new CategorySelfRelation();
                if($_POST['parent_category'] != ''){
                    $category_self_relation->parent_category_id = $_POST['parent_category'];
                }
                else{
                    $category_self_relation->parent_category_id = NULL;
                }
            }

            // Check image file exists or not
                if($request->hasfile('image_link')){
                    // Image link 
                    $category_image = $request->file('image_link');
                    if(!empty($category_image)) {
                        $image_info = getimagesize($category_image);

                        // check image dimension in width & height
                        /*if((isset($image_info['0']) && $image_info['0'] == '1920') && isset($image_info['1']) && $image_info['1'] == '300'  ){
                        Session::flash('error', 'Image size must be width 1920px & height 300px');    
                        return redirect()->back();
                        }*/
                        // Check image size
                        /* if($category_image->getClientSize() > 1024)
                        {
                        Session::flash('error', 'This Image size bigger than 1024KB');    
                        return redirect()->back();
                        }*/

                        if($category_image) {
                         $category_image_title = str_replace(' ', '-', $input['slug'] . '.' . $category_image->getClientOriginalExtension());
                         $category_image_link = $this->category_image_relative_path;
                         $this->image_upload($category_image_title,$category_image->getRealPath(),$category_image_link);

                        }else{
                            $category_image_link = '';
                            $category_image_title = '';
                        }

                        $input['image_link'] = $category_image_title;

                     }

                 }


                 // Check image file exists or not
                if($request->hasfile('banner_link')){
                    // Image link 
                    $category_image_banner = $request->file('banner_link');
                    if(!empty($category_image_banner)) {
                        

                        if($category_image_banner) {

                          $category_image_banner_title = str_replace(' ', '-', $input['slug'] . '.' . $category_image_banner->getClientOriginalExtension());
                          $category_image_banner_link = $this->category_image_banner_relative_path.'/'.$category_image_banner_title;

                        }else{
                            $category_image_banner_link = '';
                            $category_image_banner_title = '';
                        }

                        $input['banner_link'] = $category_image_banner_title;

                     }

                 }
            
            

            /* Transaction Start Here */
            DB::beginTransaction();
            try {
                // Store cateogory data 
                if($category_data = Category::create($input))
                {
                // Store parent category & child category relation
                    if(isset($category_self_relation)){
                        $category_self_relation->child_category_id = $category_data->id;
                        $category_self_relation->save();
                    }

                    if($category_image_banner != null){
                        $category_image_banner->move($this->category_image_banner_path, $category_image_banner_title);
                    }

                }

                DB::commit();
                Session::flash('message', 'Category is added!');
                return redirect(config('global.prefix_name').'/category/index');
                

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                print($e->getMessage());
                exit();
                Session::flash('danger', $e->getMessage());
            }

        }else{
            Session::flash('info', 'This category already added!');
        }
        return redirect()->back();

    }

    public static function image_upload($image_name, $realpath, $destinationPath)
    {
        // Check image name presents or not
        if ($image_name != '')
        {   
            // get sizes
            $sizes = self::array_of_size();

            if(count($sizes)>0)
            {
                
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $pageTitle = 'View Category Informations';

        // Find category data
        $data = Category::where('category.id', $id)
                ->select('category.*')
                ->first();                    

        if(!empty($data))
        {
            // If found category
            return view("Category::category.show", compact('data','pageTitle'));

        }else{
            // If category not found
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
        $pageTitle = "Update Category";

        // Find category
        $data = Category::where('category.id', $id)
                        ->select('category.*')
                        ->first();

        // If category not found                
        if(count($data) <= 0){
            Session::flash('danger', 'Category not found.');
            return redirect()->route('admin.category.index');
        }

        // Find relations
        $category_self_relation = $data->relCategorySelfRelation;
        if(count($category_self_relation) > 0){
            $data->parent_category = $category_self_relation->parent_category_id;
        }

        // Get parent & child hierarchy
        $parent_category_options = Category::getHierarchyCategory($data->id, '');

        // Return view
        return view("Category::category.edit", compact('data','parent_category_options','pageTitle'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\CategoryRequest $request, $id)
    {
        
        $input = $request->all();


        // Find catgory
        $model = Category::where('category.id', $id)
            ->select('category.*')
            ->first();

        // child parent relation    
        if(isset($_POST['parent_category'])){
            $category_self_relation = $model->relCategorySelfRelation;
            if(count($category_self_relation) == 0){
                $category_self_relation = new CategorySelfRelation();
            }

            if($_POST['parent_category'] != ''){
                $category_self_relation->parent_category_id = $_POST['parent_category'];
            }
            else{
                $category_self_relation->parent_category_id = NULL;
            }
        }

        // Check image file exists or not
        if($request->hasfile('image_link')){

            // Image link 
                    $category_image = $request->file('image_link');

                    if(!empty($category_image)) {

                        $image_info = getimagesize($category_image);

                // check image dimension in width & height
                        // if((isset($image_info['0']) && $image_info['0'] == '1920') && isset($image_info['1']) && $image_info['1'] == '300'  ){
                        //     Session::flash('error', 'Image size must be width 1900px & height 269px');    
                        //     return redirect()->back();
                        // }

                // Check image size

                        // if($category_image->getClientSize() < 1024)
                        // {
                        //     Session::flash('error', 'This Image size bigger than 512KB');    
                        //     return redirect()->back();
                        // }



                        if($category_image) {

                            $category_image_title = str_replace(' ', '-', $input['slug'] . '.' . $request->file('image_link')->getClientOriginalExtension());
                            $category_image_link = $this->category_image_relative_path;
                            $this->image_upload($category_image_title,$request->file('image_link')->getRealPath(),$category_image_link);

                        }else{
                            $category_image_link = $model->image_link;
                            $category_image_title = $model->image_link;
                        }

                        $input['image_link'] = $category_image_title;
                     }


        }


        $category_image_banner = $request->file('banner_link');

        if($category_image_banner) {
            $category_image_banner_title = str_replace(' ', '-', $input['slug'] . '.' . $category_image_banner->getClientOriginalExtension());
            $category_image_banner_link = $this->category_image_banner_relative_path.'/'.$category_image_banner_title;
        }else{
            $category_image_banner_link = $model->banner_link;
            $category_image_banner_title = $model->banner_link;
        }

        $input['banner_link'] = $category_image_banner_title;

        DB::beginTransaction();
        try {
            // Update category
            $result = $model->update($input);

            if($result){

                if($request->file('image_link') != null){
                    File::Delete($model->image_link);
                }

                // Update parent category 
                if(isset($category_self_relation)){
                    $category_self_relation->child_category_id = $model->id;
                    $category_self_relation->save();
                }

                if($category_image_banner != null){
                    File::Delete($model->banner_link);
                    $category_image_banner->move($this->category_image_banner_path, $category_image_banner_title);
                }

                DB::commit();
            }

            Session::flash('message', 'Successfully updated!');
            return redirect(config('global.prefix_name').'/category/index');
        }
        catch (\Exception $e) {
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
        // Find category 

        $model = Category::where('category.id', $id)
            ->select('category.*')
            ->first();

        DB::beginTransaction();
        try {
            // Category update
            if($model->status =='active'){
                $model->status = 'cancel';
            }else{
                $model->status = 'active';
            }

           $model->save();
          
            DB::commit();
            Session::flash('message', "Successfully Deleted.");

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

        
        $pageTitle = 'Category Information';

        // Category model initialize
        $model = new Category();

        if($this->isGetRequest())
        {
            // Search data found
            $search_keywords = trim(Input::get('search_keywords'));
            $model = $model->where(function ($query) use($search_keywords){
                    $query = $query->orWhere('title', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('category.status', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('description', 'LIKE', '%'.$search_keywords.'%');
                });
            $data = $model->whare('category.status','active')->select('category.*')->paginate(30);
        }else{

            // If get data not found
            $data = Category::join('category_self_relation', 'category_self_relation.child_category_id', '=', 'category.id')
                        ->where('category_self_relation.parent_category_id',NULL)
                        ->whare('category.status','active')
                        ->select('category.*')
                        ->groupBy('category.id')
                        ->paginate(30);
        }

        // Return view
        return view("Category::category.index", compact('data','pageTitle'));
        

    }

   
}