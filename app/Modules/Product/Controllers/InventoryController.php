<?php

namespace App\Modules\Product\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Product\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;
use Session;


class InventoryController extends Controller
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

    public function inventory_index()
	{
	    $pageTitle = "Current Order List";

	    $data = Product::join('product_inventory','product.id','=','product_inventory.product_id')
                        ->select('product.title','product.item_no','product.sell_price','product.list_price','product_inventory.quantity','product.id','product.status')
                        ->orderBy('product_inventory.quantity','ASC')
                        ->paginate(30);

	    return view('Product::inventory.index', [
	        'pageTitle' => $pageTitle,
	        'data' => $data
	    ]);
	}


	public function search_invetory()
    {

        $pageTitle = 'Searching Inventory Lists';

        $model = new Product;

        if ($this->isGetRequest()) {
            $item_no = Input::get('item_no');
            $status = Input::get('status');
            $title = Input::get('title');
            $inventory = Input::get('inventory');

            if ($item_no != '') {
                $model = $model->where('item_no', 'LIKE', '%' . $item_no . '%');
            }

            if ($title != '') {
                $model = $model->where('title', 'LIKE', '%' . $title . '%');
            }
            if ($status != '') {
                $model = $model->where('product.status', $status);
            }

            if ($inventory != '') {
                $model = $model->orderBy('product_inventory.quantity', $inventory);
            }
           

            $data = $model->join('product_inventory','product.id','=','product_inventory.product_id')
                        ->select('product.title','product.item_no','product.sell_price','product.list_price','product_inventory.quantity','product.id','product.status')
                        ->paginate(30);
                      

        } else {
            $data = Product::join('product_inventory','product.id','=','product_inventory.product_id')
                        ->select('product.title','product.item_no','product.sell_price','product.list_price','product_inventory.quantity','product.id','product.status')
                        ->orderBy('product_inventory.quantity','ASC')
                        ->paginate(30);
        }

        return view('Product::inventory.index', [
            'pageTitle' => $pageTitle,
            'data' => $data
        ]);

    }

}