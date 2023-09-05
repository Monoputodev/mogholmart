<?php

namespace App\Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
//use Dimsav\Translatable\Translatable;

class ProductAttribute extends Model {

    //use Translatable;

    protected $table = 'product_attribute';
    //public $translatedAttributes = ['attribute_data_tr'];
    protected $fillable = [
        'product_id',
        'attribute_code',
        'attribute_data',
    ];


    // Relations
    public function relAttribute(){
        return $this->hasOne('App\Modules\Attribute\Models\Attribute', 'code_column', 'attribute_code');
    }

    protected function find_product_color_size($attribute_list,$product_data){

        $size_color_array = [];
        $color_array = [];
        $size_array = [];
        $color_variation_array = [];
        $size_variation_array = [];

        // Find self color & size
        if(!empty($attribute_list))
        {
            foreach($attribute_list as $attribute)
            {
                if($attribute->attribute_code == 'color')
                {
                    $color_array[$attribute->product_id] =str_replace("=="," ",$attribute->attribute_data);
                   
                }

                if($attribute->attribute_code == 'size')
                {
                    $size_array[$attribute->product_id] =str_replace("=="," ",$attribute->attribute_data);
                }
                
            }
        }

        // Find variation color & size
        // $variation_data=ProductVariation::join('product_attribute','product_variation.product_id','=','product_attribute.product_id')
        //                     ->where('product_variation.parent_product_id',$product_data->product_id)
        //                     ->get(['product_attribute.product_id','product_attribute.attribute_code','product_attribute.attribute_data'])
        //                     ->toArray();

        // if(!empty($variation_data))
        // {
        //     foreach($variation_data as $variation)
        //     {
        //         $attr_data = str_replace("==","",$variation['attribute_data']);
        //         if($variation['attribute_code'] == 'color')
        //         {
        //             $key = array_search ($attr_data, $color_array);

        //             if(!empty($key))
        //             {               
        //                 $color_array[$key.'--'.$variation['product_id']] = $attr_data;
        //                 unset($color_array[$variation['product_id']]);
        //                 unset($color_array[$key]);

        //             }else{
        //                 $color_array[$variation['product_id']] = $attr_data;
        //             }                    
                   
        //         }

        //         if($variation['attribute_code'] == 'size')
        //         {
        //             $key = array_search ($attr_data, $size_array);

        //             if(!empty($key))
        //             {               
        //                 $size_array[$key.'--'.$variation['product_id']] = $attr_data;
        //                 unset($size_array[$variation['product_id']]);
        //                 unset($size_array[$key]);

        //             }else{
        //                 $size_array[$variation['product_id']] = $attr_data;
        //             }
        //         }
        //     }
        // }  
       
        // All size merge  

        $size_color_array['color'] = $color_array;
        $size_color_array['size'] = $size_array;

        return $size_color_array;

    }


    // TODO :: boot
    // boot() function used to insert logged user_id at 'created_by' & 'updated_by'
    public static function boot(){
        parent::boot();
        static::creating(function($query){
            if(Auth::check()){
                $query->created_by = @\Auth::user()->id;
            }
        });
        static::updating(function($query){
            if(Auth::check()){
                $query->updated_by = @\Auth::user()->id;
            }
        });
    }
    

}
