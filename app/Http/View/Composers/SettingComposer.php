<?php
namespace App\Http\View\Composers;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use App\Modules\Order\Models\OrderHead;
use App\Modules\Order\Models\OrderDetails;


class SettingComposer{

    public function compose(){

        if(Session::has('main_logo')){

            // do nothing

        }else{

            $main_logo =DB::table('config')->where('key','logo')->first();

            Session::put('main_logo',$main_logo);  

        }
        
        if(Session::has('image_size')){

            // do nothing

        }else{

            $image_size=DB::table('config')->where('key','product.image.size')->first();

            Session::put('image_size',$image_size);  

        }

        if(Session::has('shortcut_icon')){

            // do nothing

        }else{

            $shortcut_icon =DB::table('config')->where('key','short.cut.icon')->first();

            Session::put('shortcut_icon',$shortcut_icon);  

        }

        if(Session::has('site_name')){

            // do nothing

        }else{

            $site_name =DB::table('config')->where('key','site.name')->first();

            Session::put('site_name',$site_name);  

        }

        if(Session::has('weekend')){

            // do nothing

        }else{

            $weekend =DB::table('config')->where('key','weekend')->first();

            Session::put('weekend',$weekend);  

        }

         if(Session::has('total_pending_order')){

            // do nothing

        }else{

            $total_pending_order=OrderHead::where('status','pending')->count();

            Session::put('total_pending_order',$total_pending_order);  

        }

        if(Session::has('pending_order')){

            // do nothing

        }else{

            $pending_order=OrderHead::where('status','pending')->limit(10)->orderby('id','desc')->get(['id','order_number','date', 'updated_at']);

            Session::put('pending_order',$pending_order);  

        }
    }

}
