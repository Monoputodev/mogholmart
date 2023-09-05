<?php

namespace App\Modules\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Order\Models\OrderHead;
use App\Modules\Order\Models\OrderDetails;
use App\Modules\Product\Models\Product;
use App\User;
use Auth;
use Session;
use DB;


class AdminController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $admin=Auth::guard()->user();
        $pageTitle = 'Admin Dashboard';

        
       $todate=date('Y-m-d');
        $toyear = date("Y", strtotime($todate)); 
        $tomonth = date("m");
        $form_date=date('Y-m-d', strtotime('-15 days'));

        $total_product=Product::count();
        $total_order=OrderHead::count();
        
        $todays_order=OrderHead::whereDate('order_head.date', '>=', date('Y-m-d'))->count();
        $last_15_days_order=OrderHead::whereBetween('order_head.date', [$form_date,$todate])->count();
        $last_30_days_order=OrderHead::whereBetween('order_head.date', [date('Y-m-d', strtotime('-30 days')),$todate])->count();
        
       

        return view("Admin::dashboard.index", compact('admin','pageTitle','todays_order','last_15_days_order','last_30_days_order','total_product','total_order'));
    }

    public function documentation()
    {
        $pageTitle = 'Software Documentation';

        return view("Admin::layouts.documentation", compact('pageTitle'));
    }

    


}
