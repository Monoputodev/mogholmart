<?php

namespace App\Modules\Web\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Http\Helpers\ProductHelper;
use App\Modules\Newsletter\Models\Subscriptions;
use App\Modules\Product\Models\VwProduct;
use App\Modules\Product\Models\Brand;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use App;
use App\Modules\Category\Models\Category;
use Session;

class WebController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()
    {
        $pageTitle = 'Furniture Shop';
        // slider data

        /*if( Cache::has( 'slider_data' ) ) {
            $slider_data = Cache::get( 'slider_data' );
        }else{*/

        $slider_data = DB::table('slider')
            ->where('slider.status', 'active')
            ->orderBy('slider.id', 'asc')
            ->get();

        /*  Cache::put( 'slider_data', $slider_data, '60' );
            $slider_data = Cache::get( 'slider_data' );


        }*/

        // offer product data

        /* if( Cache::has( 'offer_product_data' ) ) {
            $offer_product_data = Cache::get( 'offer_product_data' );
        }else{*/

        $offer_product_data = VwProduct::limit(12)
            ->Where('offer_price', '>', 0)
            ->inRandomOrder()
            ->select('product_id', 'product_title', 'product_slug', 'sell_price', 'offer_price', 'image', 'item_no', 'average_review', 'product_merchant_id', 'weight', 'category_id', 'quantity')
            ->get();

        /* Cache::put( 'offer_product_data', $offer_product_data, '20' );
            $offer_product_data = Cache::get( 'offer_product_data' );
        }
*/
        // Home product with category
        /*if( Cache::has( 'home_product' ) ) {
            $home_product = Cache::get( 'home_product' );
        }else{*/
        $home_product = ProductHelper::home_product(6);
        /*Cache::put( 'home_product', $home_product, '40' );
            $home_product = Cache::get( 'home_product' );*/
        /*}

        if( Cache::has( 'latest_product' ) ) {
            $latest_product = Cache::get( 'latest_product' );
        }else{*/

        $latest_product = VwProduct::orderBy('product_id', 'DESC')
            ->limit(8)
            ->get(['product_id', 'product_title', 'product_slug', 'sell_price', 'offer_price', 'image', 'item_no', 'average_review', 'product_merchant_id', 'weight', 'category_id', 'quantity']);


        /* Cache::put( 'latest_product', $latest_product, '15' );
            $latest_product = Cache::get( 'latest_product' );
        }


        if( Cache::has( 'top_rated' ) ) {
            $top_rated = Cache::get( 'top_rated' );
        }else{*/

        $top_rated = VwProduct::orderBy('total_review', 'DESC')
            ->limit(6)
            ->get(['product_id', 'product_title', 'product_slug', 'sell_price', 'offer_price', 'image', 'item_no', 'average_review', 'product_merchant_id', 'weight', 'category_id', 'quantity']);


        /*  Cache::put( 'top_rated', $top_rated, '15' );
            $top_rated = Cache::get( 'latest_product' );
        }*/

        $most_view = VwProduct::join("product_views", "product_views.product_id", "=", "vw_product.product_id")
            ->where("created_at", ">=", date("Y-m-d H:i:s", strtotime('-48 hours', time())))
            ->groupBy("vw_product.product_id")
            ->orderBy(DB::raw('COUNT(vw_product.product_id)', 'desc'))
            ->limit(6)
            ->get(array(DB::raw('COUNT(vw_product.product_id) as total_views'), 'vw_product.product_id', 'vw_product.product_title', 'vw_product.product_slug', 'vw_product.sell_price', 'vw_product.offer_price', 'vw_product.image', 'vw_product.item_no', 'vw_product.average_review', 'vw_product.product_merchant_id', 'vw_product.weight', 'vw_product.category_id', 'vw_product.quantity'));

        /*if( Cache::has('just_for_you_product_data') ) {
            $just_for_you_product_data = Cache::get( 'just_for_you_product_data' );
        }else{*/

        $just_for_you_product_data = DB::table('vw_product')
            ->inRandomOrder()
            ->limit(12)
            ->select('product_id', 'product_title', 'product_slug', 'sell_price', 'offer_price',  'image', 'item_no', 'average_review', 'product_merchant_id', 'weight', 'category_id', 'quantity')
            ->get();


        /*  Cache::put( 'just_for_you_product_data', $just_for_you_product_data, '15' );
            $just_for_you_product_data = Cache::get( 'just_for_you_product_data' );
        }*/

        /* if( Cache::has('brands') ) {
            $brands = Cache::get( 'brands' );
        }else{*/

        $brands = Brand::where('status', 'active')
            ->InRandomOrder()
            ->limit(30)
            ->get();


        /* Cache::put( 'brands', $brands, '15' );
            $brands = Cache::get( 'brands' );
        }*/

        //For attribute new products

        $filter_attribute_product_list = [];
        $get_attribute_data = 'New Products';

        $filter_attribute_product_list = ProductHelper::custome_attribute_with_product($get_attribute_data);

        $new_product_data = DB::table('vw_product')
            ->select('product_id', 'product_title', 'product_slug', 'sell_price', 'offer_price',  'image', 'item_no', 'average_review', 'product_merchant_id', 'weight', 'category_id', 'quantity')
            ->inRandomOrder()
            ->limit(6)
            ->get();

        //For featured product
        $featured_attribute_product_list = [];
        $get_featured_data = 'Featured Products';

        $featured_attribute_product_list = ProductHelper::custome_attribute_with_product($get_featured_data);

        // special magic start

        // Get the category with the highest short order
        $lastCategory = Category::orderBy('short_order', 'desc')->first();

        // Loop over each short order value from 1 to the highest value
        $categoryCount = 1;
        $categories = [];

        for ($i = 0; $i < $lastCategory->short_order; $i++, $categoryCount++) {
            // Find the category with the current short order value
            $categories[$i] = Category::where('short_order', $categoryCount)->first();
        }
        // dd($categories);
        // Loop over each category and get its products
        $productCollection = [];
        for ($j = 0; $j < $categoryCount; $j++) {
            // Find the category by its ID
            $category = Category::find($categories[$j]->id);
            if ($category) {
                // If the category was found, get its products and add them to the collection
                $productCollection[$j] = $category->products()->with('image')->limit(6)->get();
            } else {
                // If the category was not found, add an empty collection to avoid errors
                $productCollection[$j] = collect();
            }
        }
        $categoryItem = Category::where('status', 'active')->where('show_in_main_menu', 'yes')
        ->orderBy('short_order', 'ASC')
        ->get();
// dd($category);
        // dd($categoryCount);
        // dd($productCollection);
        // special magic end
        return view("Web::home.index", compact(
            'categoryItem',
            'categoryCount',
            'categories',
            'pageTitle',
            'slider_data',
            'productCollection'
        ));
    }


    public function loadmoreIndex(Request $request)
    {
        // Get the category by ID
        $category = Category::find($request->category_id);


        // Retrieve the next set of 6 products, skipping those that have already been shown
        $alreadyShown = $request->shown;

        $products = $category->products()
            ->with('image')
            ->latest()
            ->skip($alreadyShown)
            ->limit(6)
            ->get();

        if ($products->count() == 0) {
        return 0;
        }

        return view('Web::home.view_more', compact('products'));
    }
    /**

     * Display about us content.

     *

     * @return Web::pages.about

     */



    public function about_us()
    {
        $pageTitle = 'About Us';
        $about_us = DB::table('general_pages')->where('slug', 'about-us')->first();
        return view("Web::pages.about", compact('pageTitle', 'about_us'));
    }
    /**

     * Display privacy policy content.

     *

     * @return Web::pages.privacy policy

     */

    public function privacy_policy()
    {

        $pageTitle = 'Policy Privacy';
        $privacy = DB::table('general_pages')->where('slug', 'privacy-policy')->first();
        return view("Web::pages.privacy", compact('pageTitle', 'privacy'));
    }

    /**

     * Display contact us content.

     *

     * @return Web::pages.contact

     */
    public function contact_us()
    {

        $pageTitle = 'Contact Page';
        return view("Web::pages.contact", compact('pageTitle'));
    }

    /**

     * Send Contact Email.

     *

     * @return Submit email

     */
    public function contact_mail(Request $request)
    {
        $input = Input::all();

        if (empty($input['email'])) {
            $emailError = 'Email is empty';
        } else {
            $email =  $input['email'];
            // validating the email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailError = 'Invalid email';
            }
        }

        if (empty($input['message'])) {
            $messageError = 'Message is empty';
        } else {
            $message =  $input['message'];
        }
        if (!empty($input['name'])) {
            $name =  $input['name'];
        }

        if (!empty($input['title'])) {
            $title =  $input['title'];
        }

        if (empty($emailError) && empty($messageError)) {
            $subject = "Contacting with us";
            $contents = "<html><head><title>$title</title></head><body style=\"background-color:#fafafa;\"><div style=\"padding:20px;\">Email: <span style=\"color:#888\">" . $email . "</span><br>Message: <div style=\"color:#888\">" . $message . "</div></div></body></html>";
            try {

                if (isset($email)) {
                    $send_mail = \App\Http\Helpers\SendMail::fire($email, $subject, $contents, '');

                    if ($send_mail) {
                        Session::flash('message', 'Thanks for your  complain.We will contact you very soon');

                        return redirect()->route('web.contact.us');
                    }
                }
            } catch (Exception $e) {
                Session::flash('error', '');
                return redirect()->back();
            }
        }
    }



    /**
     * Display faq content.
     *
     * @return Web::pages.faq
     */
    public function faq()
    {

        # code...
        $pageTitle = "FAQ";
        $faqdata = DB::table('faq')->where('status', 'active')->get();
        return view('Web::pages.faq', compact('pageTitle', 'faqdata'));
    }

    public function return_refund()
    {

        # code...
        $pageTitle = "Return & Refunds";
        $data = DB::table('general_pages')->where('slug', 'returns-refunds')->first();
        return view("Web::pages.return", compact('pageTitle', 'data'));
    }



    public function warranty_services()
    {

        # code...
        $pageTitle = "Warranty & Services";
        $data = DB::table('general_pages')->where('slug', 'warranty-and-services')->first();
        return view("Web::pages.return", compact('pageTitle', 'data'));
    }



    public function terms_condition()
    {
        # code...
        $pageTitle = "Terms & Conditions";
        $data = DB::table('general_pages')->where('slug', 'terms-conditions')->first();
        return view("Web::pages.return", compact('pageTitle', 'data'));
    }

    public function shopping_guide()
    {
        # code...
        $pageTitle = "Shopping & Guide";
        $data = DB::table('general_pages')->where('slug', 'shopping-guide')->first();
        return view("Web::pages.return", compact('pageTitle', 'data'));
    }

    public function promotion()
    {
        # code...
        $pageTitle = "Promotions";
        $data = DB::table('general_pages')->where('slug', 'promotions')->first();
        return view("Web::pages.return", compact('pageTitle', 'data'));
    }



    public function code_conduct()
    {

        # code...
        $pageTitle = "Code Of Conduct";
        $codeofconduct = [

            'Business Integrity, Anti Bribery' => 'Business must be carried out with a high degree of ethics, honesty and fair dealings; ensuring staff is familiar with such policies/procedures and does not engage in threats, bribery or corruption practices. The offering, paying, soliciting or accepting of bribes or kick-backs, including facilitation payments, is strictly prohibited.',



            'Child Labor' => 'Employment of children in any form is strictly prohibited. Business partners and suppliers shall employ only those workers, who meet the minimum age criterion of 14 years or legal minimum age for working in any specific country, whichever is greater. Further, workers below 18 years of age should not be employed night shifts and in hazardous conditions. All applicable laws relating to young labor including employment, wages, working hours, overtime and working conditions shall be complied with.',



            'Forced Labor' => 'All forms of forced and bonded labor are prohibited including compulsory overtime. Workers should be able to voluntarily end their employment without any restrictions. Any restrictions on employees to voluntarily end their employment, such as excessive notice periods or substantial fines for terminating their employment contracts, are prohibited.',



            'Harassment & Abuse' => 'Employees should be treated with respect and dignity and should not be subjected to any form of physical abuse or discipline, the threat of physical abuse, sexual or other harassment and verbal abuse or other forms of intimidation.',



            'Discrimination' => 'Employees should not be subjected to discrimination in employment, including hiring, compensation, promotion or discipline, on the basis of gender, race, religion, caste, age, disability, sexual orientation, pregnancy, marital status, nationality, political opinion, trade union affiliation, social or ethnic origin or other status protected by law'

        ];

        return view("Web::pages.codeConduct", compact('pageTitle', 'codeofconduct'));
    }

    public function support()
    {
        # code...
        $pageTitle = "Support";
        $data = DB::table('general_pages')->where('slug', 'support')->first();
        return view("Web::pages.return", compact('pageTitle', 'data'));
    }



    public function our_goal()
    {

        # code...
        $pageTitle = "Our Goal";
        $data = DB::table('general_pages')->where('slug', 'our-goal')->first();
        return view("Web::pages.return", compact('pageTitle', 'data'));
    }



    public function subscription(Request $request)
    {

        # code...
        $response = [];
        if (!empty($_POST['email'])) {
            $email =  $_POST['email'];
            // validating the email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $response['result'] = 'invalid_email';
            }
        }

        $data = Subscriptions::where('email', $email)->exists();
        if (!$data) {

            DB::beginTransaction();
            try {

                $model = new Subscriptions;
                $model->email = $email;
                if ($model->save()) {

                    DB::commit();
                }

                $response['result'] = 'success';
            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                Session::flash('danger', $e->getMessage());
            }
        } else {
            $response['result'] = 'false';
        }
        return $response;
    }
}
