<?php

namespace App\Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App;
use App\Modules\Category\Models\Category;

class Product extends Model {

    protected $table = 'product';

    protected $fillable = [
        'type',
        'title',
        'slug',
        'item_no',
        'sell_price',
        'list_price',
        'offer_price',
        'weight',
        'unit',
        'attribute_set_id',
        'manufacturer_id',
        'short_description',
        'description',
        'specification',
        'status',
        'merchant_id',
        'is_emi'
    ];

    // Relations

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_category', 'product_id', 'category_id');
    }



    public function image()
    {
        return $this->hasOne(ProductImage::class);
    }




    public function relAttribute(){
        return $this->hasOne('App\Modules\Attribute\Models\AttributeSet', 'id', 'attribute_set_id');
    }

    public function relProductAttribute(){
        return $this->hasMany('App\Modules\Product\Models\ProductAttribute','product_id','id');
    }

    public function relProductInventory(){
        return $this->hasOne('App\Modules\Product\Models\ProductInventory','product_id','id');
    }

    public function relManufacturer(){
        return $this->hasOne('App\Modules\Product\Models\Manufacturer', 'id', 'manufacturer_id');
    }
   public static function findProductAttribute($product_id_list){

        $response = [];

        $attribute_list = DB::table('attribute')
                        ->join('product_attribute','attribute.code_column','=','product_attribute.attribute_code')
                        ->join('product','product_attribute.product_id','=','product.id')
                        ->where('attribute.use_in_filter','yes')
                        ->where('product.status','active')
                        ->whereIn('product_attribute.product_id',$product_id_list)
                        ->distinct()
                        ->get(['attribute.id','attribute.frontend_title','attribute.code_column']);

        if(count($attribute_list) > 0)
        {
            foreach($attribute_list as $key => $value)
            {
                $response[$key]['attribute_id'] = $value->id;
                $response[$key]['code_column'] = $value->code_column;
                $response[$key]['frontend_title'] = $value->frontend_title;


                $response[$key]['attribute-option'] = self::attributeOption($value->code_column,$product_id_list);
            }
        }

        return $response;

    }

    public static function attributeOption($code_column, $product_id){

        $response = [];

        $attribute_option_data = DB::table('product_attribute')
             ->join('product','product_attribute.product_id','=','product.id')
            ->select('id','attribute_data')
            ->where('attribute_code',$code_column)
            ->where('product.status','active')
            ->whereIn('product_id',$product_id)
            ->select('product_attribute.*')
            ->get();

        $attribute_list = [];

        $attribute_list_string = '';

        if(count($attribute_option_data) > 0)
        {
            foreach($attribute_option_data as $attribute_option)
            {
                $attribute_list_string.=$attribute_option->attribute_data;
            }
        }

        $attribute_list = array_filter(explode('==', $attribute_list_string));

        $attribute_list = array_unique($attribute_list);

        return $attribute_list;
    }


    public static function findBrand($product_id_list = []){

        $brand_list = DB::table('brand')
                    ->join('product_brand', 'brand.id', '=', 'product_brand.brand_id')
                    ->join('product', 'product_brand.product_id', '=', 'product.id')
                    ->whereIn('product_brand.product_id',$product_id_list)
                    ->where('product.status','active')
                    ->distinct()
                    ->get(['brand.title','brand.slug','brand.id'])->toArray();
        $response = [];

        if(count($brand_list) > 0)
        {
            foreach($brand_list as $key => $value)
            {

                $response[$key]['id'] = $value->id;
                $response[$key]['title'] = $value->title;
                $response[$key]['slug'] = $value->slug;
            }
        }

        return array_map("unserialize", array_unique(array_map("serialize", $response)));;
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
