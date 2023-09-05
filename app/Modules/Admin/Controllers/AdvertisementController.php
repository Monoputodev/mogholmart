<?php

namespace App\Modules\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Admin\Models\Advertisement;
use App\Modules\Admin\Requests;
use Illuminate\Support\Facades\Input;
use DB;
use Session;
use Image;
use File;

class AdvertisementController extends Controller
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

    protected $advertisement_image_path;
    protected $advertisement_image_relative_path;
    /**
     * advertisement constructor.
     */
    public function __construct()
    {

        $this->advertisement_image_path = public_path('uploads/advertisement');
        $this->advertisement_image_relative_path = '/uploads/advertisement';

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {   


        $pageTitle = "List of  Advertisement";

        // Get Parent user data
        $data = Advertisement::where('status','active')->paginate(30);


        // return view
        return view("Admin::advertisement.index", compact('data','pageTitle'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $pageTitle = "Add New Advertisement";

        // return View
        return view("Admin::advertisement.create", compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\AdvertisementRequest $request)
    {
        // Get all input data
        $input = $request->all();
        $input['slug'] = str_slug($input['slug']);
        // Check already presents or not
        $data = Advertisement::where('slug',$input['slug'])->exists();

        if( !$data )
        {
            

            // Image link 
            $advertisement_image = $request->file('image_link');

            if($advertisement_image) {
                $advertisement_image_title = str_replace(' ', '-', $input['slug'] . '.' . $advertisement_image->getClientOriginalExtension());
                $advertisement_image_link = $this->advertisement_image_relative_path.'/'.$advertisement_image_title;

            }else{
                $advertisement_image_link = '';
                $advertisement_image_title = '';
            }

            $input['image_link'] = $advertisement_image_title;

            /* Transaction Start Here */
            DB::beginTransaction();
            try {

                // Store user data 
                if($advertisement_data = Advertisement::create($input))
                {

                    // Store category image
                    if($advertisement_image != null){
                        $advertisement_image->move($this->advertisement_image_path, $advertisement_image_title);
                    }

                }

                DB::commit();
                Session::flash('message', 'Advertisement is added!');
                return redirect(config('global.prefix_name').'/advertisement/index');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                print($e->getMessage());
                exit();
                Session::flash('danger', $e->getMessage());
            }

        }else{
            Session::flash('info', 'This Advertisement already added!');
        }
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
        $pageTitle = 'View Advertisement Informations';

        // Find category data
        $data = Advertisement::where('advertisement.id', $id)
                ->select('advertisement.*')
                ->first();                    

        if(count($data) > 0)
        {
            // If found category
            return view("Admin::advertisement.show", compact('data','pageTitle'));

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
       $pageTitle = "Update Advertisement";

        // Find user
        $data = Advertisement::where('advertisement.id', $id)
                        ->select('advertisement.*')
                        ->first();

        // If user not found                
        if(count($data) <= 0){
            Session::flash('danger', 'Advertisement not found.');
            return redirect()->route('admin.advertisement.index');
        }


        // Return view
        return view("Admin::advertisement.edit", compact('data','pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\AdvertisementRequest  $request, $id)
    {
        $input = $request->all();
        $input['slug'] = str_slug($input['slug']);
        // Check already presents or not


        // Find user
        $model = Advertisement::where('advertisement.id', $id)
            ->select('advertisement.*')
            ->first();

        // Image file 
        $advertisement_image = $request->file('image_link');

        if($advertisement_image) {
            $advertisement_image_title = str_replace(' ', '-', $input['slug'] . '.' . $advertisement_image->getClientOriginalExtension());
            $advertisement_image_link = $this->advertisement_image_relative_path.'/'.$advertisement_image_title;
        }else{
            $advertisement_image_link = $model->image_link;
            $advertisement_image_title = $model->image_link;
        }

        $input['image_link'] = $advertisement_image_title;


        DB::beginTransaction();
        try {
            // Update user
            $result = $model->update($input);

            if($result){

                if($advertisement_image != null){
                    File::Delete($model->image_link);
                    $advertisement_image->move($this->advertisement_image_path, $advertisement_image_title);
                }

                DB::commit();
            }

            Session::flash('message', 'Successfully updated!');
            return redirect(config('global.prefix_name').'/advertisement/index');
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
        $model =   Advertisement::where('advertisement.id', $id)
            ->select('advertisement.*')
            ->first();

        DB::beginTransaction();
        try {
            // Category update
            if($model->status =='active'){
                $model->status = 'cancel';
            }else{
                $model->status = 'active';
            }

            if($model->save())
            {

                DB::commit();
            }

            Session::flash('message', "Successfully Deleted.");

        } catch(\Exception $e) {
            DB::rollback();
            Session::flash('danger',$e->getMessage());
        }
        
        // redirect to current page
        return redirect()->back();
    }

    public function search(Request $request)
    {
        $pageTitle = 'Advertisement Information';
        // User model initialize
        $model = new Advertisement();
        if($this->isGetRequest())
        {
            // Search data found
            $search_keywords = trim(Input::get('search_keywords'));
            $model = $model->where(function ($query) use($search_keywords){
                    $query = $query->orWhere('title', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('advertisement.status', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('slug', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('short_order', 'LIKE', '%'.$search_keywords.'%');
                    $query = $query->orWhere('type', 'LIKE', '%'.$search_keywords.'%');
                });
            $data = $model->where('status','active')->select('advertisement.*')->paginate(30);
        }else{
            // If get data not found
            $data = Advertisement::where('status','active')->paginate(30);
        }
        // Return view
        return view("Admin::advertisement.index", compact('data','pageTitle'));
        

    }
}
