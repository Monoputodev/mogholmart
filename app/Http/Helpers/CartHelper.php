<?php


namespace App\Http\Helpers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use \Illuminate\Support\Facades\Route;


class CartHelper
{
    
	public static function add_item($data)
	{

	    if(Session::has('cart')){
	        $cart_items = Session::get('cart');
	    }else{
	        $cart_items = [];
	    }

	    if(isset($cart_items[$data['product_id']])){

	        $cart_items[$data['product_id']]['product_quantity'] += $data['product_quantity'];
	        
	    }else{
	        $cart_items[$data['product_id']] = $data;
	    }

	    $new_items = CartHelper::calculate_cart($cart_items);

	    return $new_items;

	}


	public static function admin_add_item($data)
	{

	    if(Session::has('admin_cart')){
	        $cart_items = Session::get('admin_cart');
	    }else{
	        $cart_items = [];
	    }

	    if(isset($cart_items[$data['product_id']])){

	        $cart_items[$data['product_id']]['product_quantity'] += $data['product_quantity'];
	        
	    }else{
	        $cart_items[$data['product_id']] = $data;
	    }

	    $new_items = CartHelper::admin_calculate_cart($cart_items);

	    return $new_items;

	}


	public static function update($items)
    {

        if(Session::has('cart')){
            $cart_items = Session::get('cart');
        }else{
            $cart_items = [];
        }

        foreach ($items as $new_item){
            $product_id = $new_item['product_id'];
            if(isset($cart_items[$product_id])){
                if($new_item['product_quantity'] > 0)
                {
                    $cart_items[$product_id]['product_quantity'] = $new_item['product_quantity'];
                }else{
                    /*Quantiy value 0 or negative*/
                    $cart_items[$product_id]['product_quantity'] = 1;
                }

            }
        }

        $new_items = CartHelper::calculate_cart($cart_items);


        return $new_items;

    }

 public static function admin_update($items)
    {

        if(Session::has('admin_cart')){
            $cart_items = Session::get('admin_cart');
        }else{
            $cart_items = [];
        }

        foreach ($items as $new_item){
            $product_id = $new_item['product_id'];
            if(isset($cart_items[$product_id])){
                if($new_item['product_quantity'] > 0)
                {
                    $cart_items[$product_id]['product_quantity'] = $new_item['product_quantity'];
                }else{
                    /*Quantiy value 0 or negative*/
                    $cart_items[$product_id]['product_quantity'] = 1;
                }

            }
        }

        $new_items = CartHelper::admin_calculate_cart($cart_items);


        return $new_items;

    }


	protected static function calculate_cart($cart_items){
	    $cart_total = [];

	    $new_items = [];
	    $cart_total['total'] = 0;
	    if(count($cart_items) > 0){
	        foreach ($cart_items as $item){

	            $item['product_quantity'] = $item['product_quantity'];
	            
	            $item['subtotal'] = round($item['sell_price']*$item['product_quantity'],2);

	            $cart_total['total'] += $item['subtotal'];
	            $new_items[$item['product_id']] = $item;
	        }
	    }

	    Session::put('cart',$new_items);
	    Session::put('cart_total',$cart_total);

	    return $new_items;
	}

	protected static function admin_calculate_cart($cart_items){
	    $cart_total = [];

	    $new_items = [];
	    $cart_total['total'] = 0;
	    if(count($cart_items) > 0){
	        foreach ($cart_items as $item){

	            $item['product_quantity'] = $item['product_quantity'];
	            
	            $item['subtotal'] = round($item['sell_price']*$item['product_quantity'],2);

	            $cart_total['total'] += $item['subtotal'];
	            $new_items[$item['product_id']] = $item;
	        }
	    }

	    Session::put('admin_cart',$new_items);
	    Session::put('admin_cart_total',$cart_total);

	    return $new_items;
	}

	public static function remove_item($product_id)
	{

	    if(Session::has('cart')){
	        $cart_items = Session::get('cart');
	    }else{
	        $cart_items = [];
	    }

	    if(isset($cart_items[$product_id])){
	        unset($cart_items[$product_id]);
	    }

	    $new_items = CartHelper::calculate_cart($cart_items,true);

	    return $new_items;

	}

	public static function admin_remove_item($product_id)
	{

	    if(Session::has('admin_cart')){
	        $cart_items = Session::get('admin_cart');
	    }else{
	        $cart_items = [];
	    }

	    if(isset($cart_items[$product_id])){
	        unset($cart_items[$product_id]);
	    }

	    $new_items = CartHelper::admin_calculate_cart($cart_items,true);

	    return $new_items;

	}


}