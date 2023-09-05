<?php
namespace App\Http\View\Composers;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\Session;
use App\Modules\Category\Models\Category;


class CategoryComposer{

    public function compose(){

        if(Session::has('category_menu')){

            // do nothing

        }else{

            $category_model = Category::getWebMenu();

            Session::put('category_menu',$category_model);

        }

        if(Session::has('about')){
            // do nothing
        }else{
            $about =DB::table('config')->where('key','site.about')->first();
            Session::put('about',$about);
        }

        if(Session::has('main_logo')){

            // do nothing

        }else{

            $main_logo =DB::table('config')->where('key','logo')->first();

            Session::put('main_logo',$main_logo);

        }

        if(Session::has('facebooklink')){

            // do nothing

        }else{

            $facebooklink =DB::table('config')->where('key','facebook.link')->first();

            Session::put('facebooklink',$facebooklink);

        }


    }

}
