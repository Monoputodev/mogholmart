<?php

namespace App\Modules\Report\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Modules\Order\Models\OrderHead;
use App\User;
use DB;
use Session;

use App;
use Auth;

class SalesReportController extends Controller
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

    /**
     * OrderController constructor.
     */
    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       
        $pageTitle="Sales Report Dahboard";
        
        $data = OrderHead::where('order_head.status','delivered')->orderBy('id', 'desc')->paginate(50);
        

         return view("Report::sales.index",compact('pageTitle','data'));
    }
    

    public function search_order()
    {


        $model =  new OrderHead;

        if ($this->isGetRequest()) {
            
           
            $from_date = Input::get('from_date');
            $to_date = Input::get('to_date');

            if ($from_date != '' && $to_date != '') {
                $model = $model->where('order_head.date', '>=', $from_date);
                $model = $model->where('order_head.date', '<=', $to_date);
                $model = $model->where('order_head.status','delivered');
            }

            $data = $model->orderBy('order_head.id','desc')->paginate(50);

            $pageTitle="FROM : ".$from_date.' TO : '.$to_date;


        }else{

            $data =OrderHead::where('order_head.status','delivered')->orderBy('id', 'desc')->paginate(50);
             $pageTitle="FROM : ".$from_date.' TO : '.$to_date;
        }

       
            return view('Report::sales.index', ['pageTitle' => $pageTitle,'data' => $data]);

    }

   
}
