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

class CollectionReportController extends Controller
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
        $pageTitle="Collection Report";
        
        return view("Report::collection.form",compact('pageTitle'));
    }

    public function search_index()
    {       

        $model =  new OrderHead;

        if ($this->isGetRequest()) {
            $payment_type=Input::get('payment_type');
            $from_date = Input::get('from_date');
            $to_date = Input::get('to_date');

        

         if($payment_type != ''){

           $model = $model->where('order_head.payment_type', '=', $payment_type);
           $pageTitle="Collection Type : ".$payment_type;

         }

         if ($from_date != '' && $to_date != '' && $payment_type != '') {

                     $model = $model->whereDate('order_head.date', '>=', $from_date);
                     $model = $model->whereDate('order_head.date', '<=', $to_date);
                     $model = $model->where('order_head.payment_type', '=', $payment_type);

                $pageTitle="Collection Type : ".$payment_type.' FROM : '.$from_date.' TO : '.$to_date;
            }

        }

            $total_product=$model->count();
            $data = $model->orderBy('id', 'desc')->paginate(50)->setPath('');
            $data->appends(['payment_type'=>$payment_type,'from_date'=>$from_date,'to_date'=>$to_date]);

         return view("Report::collection.index",compact('pageTitle','data','total_product'));
    }
    

   

   
}
