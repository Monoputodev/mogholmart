<?php
if (Session::has('main_logo')) {
    $main_logo = Session::get('main_logo');
}
use App\Modules\Admin\Models\Advertisement;

?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="{{ $product_data->short_description }}">
    <meta name="author" content="monoputu">
    <meta name="keywords"
        content="furniture, furnitureshop, decoration, interiordesign, #sofa, architecture, storage, couch,space, carpenter, homedecor, living, officefurniture, furnituredesign, beds #interior, homefurninshing, moderndesign, modern, modernfurniture, furnitureonline, furniturecustom, furnituredecor, furnituremaker, furniturestore, Super Tiles BD ">
    <meta name="robots" content="all">
    <title>{{ config('app.name') }} | {{ isset($pageTitle) ? $pageTitle : 'Tiles Importer & Supplier in Bangladesh' }}
    </title>

    <link rel="icon" type="image/png" href="{{ URL::to('uploads/generel_file') }}/{{ $main_logo->value }}">
    <meta property="og:url" content="{{ config('global.DOMAIN_NAME') }}<?php print $_SERVER['REQUEST_URI']; ?>" />
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $product_data->product_title }}">
    <meta name="og:site_name" content="{{ config('global.DOMAIN_NAME') }}" />
    <meta property="og:description" content="{{ $product_data->short_description }}">
    <meta property="og:image"
        content="{{ URL::to('uploads/product/' . $product_data->product_id . '/orginal_image/' . $product_data->image) }}" />
    <meta property="og:image:alt" content="{{ $product_data->product_title }}" />
    <!-- Web Font -->
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap"
        rel="stylesheet">
    @include('Web::layouts.css')
    <link rel="stylesheet" type="text/css" href="{{ URL::to('src/xzoom.css') }}" media="all" />
</head>

<body class="js">

    @include('Web::layouts.header')
    @include('Web::pages.msg')
    @include('Web::home.popup_cart')
    <?php
    $cart_items = [];
    if (Session::has('cart')) {
        $cart_items = Session::get('cart');
    }
    $product_quantity = 1;
    $selected_attribute = [];
    ?>
    @if (count($cart_items) > 0)
        @foreach ($cart_items as $cart)
            @if ($cart['product_id'] == $product_data->product_id)
                <?php
                $product_quantity = $cart['product_quantity'];
                $product_color = $cart['product_color'];
                $product_size = $cart['product_size'];

                $selected_attribute = [$product_color, $product_size];
                ?>
            @endif
        @endforeach
    @endif


    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="index.php">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active">{{ $product_data->product_title }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <section class="shop single section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-lg-4 col-12">
                            <!-- Product Slider -->
                            <div class="product-gallery">
                                <!-- Images slider -->
                                <div class="flexslider-thumbnails">

                                    <div class="flex-viewport" style="overflow: hidden; position: relative;">

                                        <ul class="slides"
                                            style="width: 1200%; transition-duration: 0s; transform: translate3d(-555px, 0px, 0px);">
                                            @if (count($product_image) > 0)
                                                @foreach ($product_image as $key => $image)
                                                    <li data-thumb="{{ URL::to('uploads/product/' . $product_data->product_id . '/orginal_image/' . $image->image) }}"
                                                        rel="adjustX:10, adjustY:" class="flex-active-slide"
                                                        style="width: 555px; float: right; display: block;">
                                                        <img src="{{ URL::to('uploads/product/' . $product_data->product_id . '/orginal_image/' . $image->image) }}"
                                                            xoriginal="{{ URL::to('uploads/product/' . $product_data->product_id . '/orginal_image/' . $image->image) }}"
                                                            class="xzoom" alt="#">
                                                            <div class="xzoom-thumbs d-none">
                                                                {{-- <a href="{{ URL::to('uploads/product/' . $product_data->product_id . '/orginal_image/' . $image->image) }}"> --}}
                                                                  <img class="xzoom-gallery" width="200" src="{{ URL::to('uploads/product/' . $product_data->product_id . '/orginal_image/' . $image->image) }}"  xpreview="{{ URL::to('uploads/product/' . $product_data->product_id . '/orginal_image/' . $image->image) }}">
                                                                {{-- </a> --}}
                                                              </div>
                                                    </li>
                                                @endforeach
                                            @else
                                                <li data-thumb="{{ URL::to('logo/nofound.jpg') }}"
                                                    rel="adjustX:10, adjustY:" class="flex-active-slide"
                                                    style="width: 555px; float: right; display: block;">
                                                    <img src="{{ URL::to('logo/nofound.jpg') }}"
                                                        xoriginal="{{ URL::to('logo/nofound.jpg') }}" class="xzoom"
                                                        alt="#">
                                                </li>
                                            @endif

                                        </ul>
                                    </div>

                                    <ul class="flex-direction-nav">
                                        <li><a class="flex-prev" href="#"></a></li>
                                        <li><a class="flex-next" href="#"></a></li>
                                    </ul>
                                </div>
                                <!-- End Images slider -->
                            </div>
                            <!-- End Product slider -->
                        </div>
                        <div class="col-lg-5 col-12">
                            <div class="product-des">
                                <!-- Description -->
                                <div class="short">
                                    <h4>{{ $product_data->product_title }}</h4>
                                    <?php
                                    if ($product_data->average_review == null) {
                                        $average_review = 0;
                                    } else {
                                        $average_review = $product_data->average_review;
                                    }
                                    ?>
                                    <div class="rating-main">
                                        <ul class="rating">
                                            @if ($product_data->average_review)
                                                <?php
                                                $blank_start = round(5 - $product_data->average_review);
                                                ?>
                                                @for ($i = 1; $i <= $product_data->average_review; $i++)
                                                    <li><i class="fa fa-star"></i></li>
                                                @endfor

                                                @for ($j = 1; $j <= $blank_start; $j++)
                                                    <li><i class="fa fa-star-o"></i></li>
                                                @endfor
                                            @else
                                                <li class="dark"><i class="fa fa-star-o"></i></li>
                                                <li class="dark"><i class="fa fa-star-o"></i></li>
                                                <li class="dark"><i class="fa fa-star-o"></i></li>
                                                <li class="dark"><i class="fa fa-star-o"></i></li>
                                                <li class="dark"><i class="fa fa-star-o"></i></li>
                                            @endif
                                        </ul>
                                        <a href="#"
                                            onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;"
                                            class="total-review">({{ $product_data->total_review > 0 ? $product_data->total_review : '' }})
                                            Review</a>
                                    </div>
                                    <p class="price">
                                        <span class="discount">{{ __('messages.tk') }}
                                            {{ round($product_data->sell_price) }}</span>
                                        <s>
                                            @if (isset($product_data->offer_price))
                                                {{ __('messages.tk') }} {{ round($product_data->offer_price) }}
                                            @endif
                                        </s>
                                    </p>

                                    <p class="description">{!! $product_data->short_description !!}</p>

                                </div>
                                <!--/ End Description -->
                                <!-- Color -->


                                @if (count($attribute_list) > 0)
                                    <h4>Available Options </h4>
                                    @foreach ($attribute_list as $attribute)
                                        @if ($attribute['frontend_title'] == 'Color' || $attribute['frontend_title'] == 'Size')
                                            <div style="display: inline-block;">
                                                <h4
                                                    style="display: block;
									font-size: 14px;
									font-weight: 500;
									margin-top: 0px;">
                                                    <span>{{ $attribute['frontend_title'] }}</span></h4>
                                                @if (count($attribute['attribute-option']) > 0)
                                                    <select name="attribute_{{ $attribute['frontend_title'] }}"
                                                        class="form-control"
                                                        id="attribute_{{ $attribute['frontend_title'] }}">
                                                        <option value="null">--Select
                                                            {{ $attribute['frontend_title'] }}--</option>

                                                        @foreach ($attribute['attribute-option'] as $attribute_option)
                                                            <option
                                                                <?= in_array($attribute_option, $selected_attribute) ? 'selected' : '' ?>
                                                                value="{{ $attribute_option }}">
                                                                {{ $attribute_option }}</option>
                                                        @endforeach
                                                    </select>
                                                @endif
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                                <!--/ End Size -->
                                <!-- Product Buy -->
                                <div class="product-buy">
                                    @if ($product_data->quantity > 0 || $product_data->quantity == null)
                                        <div class="quantity">
                                            <h6>Quantity :</h6>
                                            <!-- Input Order -->
                                            <div class="input-group contaty">
                                                <div class="button minus">
                                                    <button type="button"
                                                        class="btn btn-primary btn-number minusbutton"
                                                        data-type="minus" data-field="quant[1]">
                                                        <i class="ti-minus"></i>
                                                    </button>
                                                </div>

                                                <input type="text" name="quant"
                                                    class="input-number soniacountereliment"
                                                    product_id="{{ $product_data->product_id }}"
                                                    data-quantity="{{ $product_quantity }}" data-min="1"
                                                    data-max="1000" value="{{ $product_quantity }}">

                                                <div class="button plus">
                                                    <button type="button" class="btn btn-primary btn-number"
                                                        data-type="plus" data-field="quant[1]">
                                                        <i class="ti-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <!--/ End Input Order -->
                                        </div>

                                        <div class="add-to-cart">


                                            <a href="#" product_quantity="1"
                                                product_weight="{{ $product_data->weight }}"
                                                product_id="{{ $product_data->product_id }}"
                                                product_category_id="{{ $product_data->category_id }}"
                                                product_merchant_id="{{ $product_data->product_merchant_id }}"
                                                product_image="{{ URL::to('uploads/product/' . $product_data->product_id . '/200x200/' . $product_data->image) }}"
                                                class="btn product_add_cart_ajax">Add to Bag</a>

                                            @if (!empty(\Auth::user()))
                                                <a class="btn min add_to_wishlist" data-toggle="tooltip"
                                                    data-placement="right" title="Save For Later"
                                                    data-href="{{ route('customer.add.to.wishlist') }}"
                                                    product-id="{{ $product_data->product_id }}">
                                                    <i class="ti-heart"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('web.customer.account') }}" class="btn min"><i
                                                        class="ti-heart"></i></a>
                                            @endif

                                        </div>
                                    @endif

                                    @if ($product_data->quantity > 0 || $product_data->quantity == null)
                                        <p class="availability" style="color: #28a745; font-size: 16px;"><i
                                                class="fa fa-check-circle"></i> <span>In Stock</span></p>
                                    @else
                                        <p class="availability" style="color: #FF0000; font-size: 16px;"><i
                                                class="fa fa-times-circle"></i> <span>Out Of Stock</span></p>
                                    @endif

                                    <p class="cat">Brand :@if (!empty($product_brand))
                                            @foreach ($product_brand as $brand)
                                                <a
                                                    href="{{ route('brand.slug', ['slug' => $brand->slug]) }}">{{ $brand->title }}</a>
                                            @endforeach
                                        @endif
                                    </p>

                                    <hr>
                                    <div class="form-group social-share clearfix">
                                        <div class="title-share cat">Share This</div>
                                        <div class="addthis_inline_share_toolbox"
                                            data-url="{{ config('global.DOMAIN_NAME') }}<?php print $_SERVER['REQUEST_URI']; ?>"
                                            data-title="{{ trim($product_data->product_title) }}"
                                            data-description="{{ $product_data->short_description }}"
                                            data-media="{{ URL::to('uploads/product/' . $product_data->product_id . '/orginal_image/' . $product_data->image) }}">
                                        </div>
                                    </div>


                                    <!-- Go to www.addthis.com/dashboard to customize your tools -->
                                    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5e3be89140baa6c8"></script>
                                </div>
                                <!--/ End Product Buy -->
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="product-des">
                                <?php
                                $advertisement_4 = Advertisement::where('type', '8')
                                    ->orderby('id', 'desc')
                                    ->where('status', 'active')
                                    ->first();
                                ?>
                                @if (count($advertisement_4) > 0)
                                    <a target="__blank" href="{{ $advertisement_4->short_order }}"
                                        title="{{ $advertisement_4->title }}"><img
                                            src="{{ URL::to('uploads/advertisement') }}/{{ $advertisement_4->image_link }}"
                                            alt="{{ $advertisement_4->title }}"></a>
                                @endif
                            </div>
                            <div class="right-bar-product">
                                <h2>Payment Methods</h2>
                                <p><img alt="payment-logo" src="{{ URL::to('logo/payment-logo.jpg') }}"
                                        class="img-responsive"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="product-info">
                                <div class="nav-main">
                                    <!-- Tab Nav -->
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item"><a class="nav-link active" data-toggle="tab"
                                                href="#description" role="tab"
                                                aria-selected="true">Description</a></li>

                                        <li class="nav-item"><a class="nav-link" data-toggle="tab"
                                                href="#tab-review" role="tab" aria-selected="false">Reviews
                                                (<?= isset($review_count) ? $review_count : 0 ?>)</a></li>

                                        <li class="nav-item"><a class="nav-link" data-toggle="tab"
                                                href="#termscondition" role="tab" aria-selected="false">Terms &
                                                Conditions</a></li>
                                    </ul>
                                    <!--/ End Tab Nav -->
                                </div>
                                <div class="tab-content" id="myTabContent">
                                    <!-- Description Tab -->
                                    <div class="tab-pane fade active show" id="description" role="tabpanel">
                                        <div class="tab-single">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="single-des"
                                                        style="box-shadow: 0px 0px 15px #0000001a;padding: 50px;">
                                                        {!! $product_data->description !!}
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="tab-pane fade show" id="tab-review" role="tabpanel">
                                        <div class="tab-single">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="single-des"
                                                        style="box-shadow: 0px 0px 15px #0000001a;padding: 50px;">
                                                        <div id="review">
                                                            @if (isset($review_data))
                                                                @foreach ($review_data as $review)
                                                                    <table class="table table-striped table-bordered">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td style="width: 50%;">
                                                                                    <strong>{{ $review->title }}</strong>
                                                                                </td>
                                                                                <td class="text-right">
                                                                                    {{ date_format($review->created_at, 'd-M-Y H:i:s') }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="2">
                                                                                    <p>{!! $review->review !!}</p>
                                                                                    @for ($i = 1; $i <= $review->rating_value_score; $i++)
                                                                                        <span class="rating">
                                                                                            <i style="color: green"
                                                                                                class="fa fa-star"></i>
                                                                                        </span>
                                                                                    @endfor
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                @endforeach
                                                                <div class="pull-right">
                                                                    {{ $review_data->links() }}
                                                                </div>
                                                                <br>
                                                                <br>
                                                                <br>
                                                            @endif
                                                        </div>

                                                        @if (\Auth::user())
                                                            <?php $url = route('customer.review.store'); ?>

                                                            {!! Form::open(['url' => $url, 'id' => 'form-review', 'class' => 'form-horizontal']) !!}

                                                            <div class="title">

                                                                <h3 style="margin-left: 13px;margin-bottom: 20px;">
                                                                    Write a review</h3>
                                                            </div>
                                                            <div class="form-group required">
                                                                <div class="col-sm-12">
                                                                    <label class="control-label" for="input-name">Your
                                                                        Name</label>
                                                                    <input type="text" name="title"
                                                                        value="&nbsp;" id="input-name"
                                                                        class="form-control" />
                                                                </div>
                                                            </div>


                                                            <div class="form-group required">
                                                                <div class="col-sm-12">
                                                                    <label class="control-label"
                                                                        for="input-review">Your Review</label>
                                                                    <textarea name="review" rows="5" id="input-review" class="form-control"></textarea>
                                                                    <div class="help-block"><span
                                                                            class="text-danger">Note:</span> HTML is
                                                                        not translated!</div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group required">
                                                                <div class="col-sm-12">
                                                                    <label class="control-label">Rating</label> <br>
                                                                    &nbsp;&nbsp;&nbsp; Bad&nbsp;
                                                                    <input type="radio" name="rating_value_score"
                                                                        value="1" />
                                                                    &nbsp;
                                                                    <input type="radio" name="rating_value_score"
                                                                        value="2" />
                                                                    &nbsp;
                                                                    <input type="radio" name="rating_value_score"
                                                                        value="3" />
                                                                    &nbsp;
                                                                    <input type="radio" name="rating_value_score"
                                                                        value="4" />
                                                                    &nbsp;
                                                                    <input type="radio" name="rating_value_score"
                                                                        value="5" />
                                                                    &nbsp;Good
                                                                </div>
                                                            </div>

                                                            <div class="buttons clearfix">
                                                                <div class="pull-right">
                                                                    <button type="submit" id="button-review"
                                                                        data-loading-text="Loading..."
                                                                        class="btn btn-primary">Submit</button>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="product_id"
                                                                value="{{ $product_data->product_id }}">

                                                            <input type="hidden" name="customer_id"
                                                                value="{{ \Auth::user()->id }}">

                                                            {!! Form::close() !!}
                                                        @else
                                                            <h4>Please <a title="Click here to login."
                                                                    target="__blank"
                                                                    href="{{ route('web.customer.account') }}"
                                                                    style="color: blue;">Login</a> for your first
                                                                review.</h4>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade show" id="termscondition" role="tabpanel">
                                        <div class="tab-single">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="single-des"
                                                        style="box-shadow: 0px 0px 15px #0000001a;padding: 50px;">
                                                        <div>
                                                            <p><strong>* Order delivery is subject to availability of
                                                                    stock.</strong></p>
                                                            <h4>Returns Policy</h4>
                                                            <p>Customers have to pay the bill amount in advance through
                                                                Credit Card/Bkash/Bank Deposit for any orders from
                                                                outside of Dhaka City.<br>You may return most new,
                                                                unopened items within 30 days of delivery for a full
                                                                refund. We'll also pay the return shipping costs if the
                                                                return is a result of our error (you received an
                                                                incorrect or defective item, etc.).</p>
                                                            <p>You should expect to receive your refund within four
                                                                weeks of giving your package to the return shipper,
                                                                however, in many cases you will receive a refund more
                                                                quickly. This time period includes the transit time for
                                                                us to receive your return from the shipper (5 to 10
                                                                business days), the time it takes us to process your
                                                                return once we receive it (3 to 5 business days), and
                                                                the time it takes your bank to process our refund
                                                                request (5 to 10 business days).</p>
                                                            <p>If you need to return an item, simply login to your
                                                                account, view the order using the 'Complete Orders' link
                                                                under the My Account menu and click the Return Item(s)
                                                                button. We'll notify you via e-mail of your refund once
                                                                we've received and processed the returned item.</p>
                                                            <h4>Shipping</h4>
                                                            <p>We can ship to virtually any address in the world. Note
                                                                that there are restrictions on some products, and some
                                                                products cannot be shipped to international
                                                                destinations.</p>
                                                            <p>When you place an order, we will estimate shipping and
                                                                delivery dates for you based on the availability of your
                                                                items and the shipping options you choose. Depending on
                                                                the shipping provider you choose, shipping date
                                                                estimates may appear on the shipping quotes page.</p>
                                                            <p>Please also note that the shipping rates for many items
                                                                we sell are weight-based. The weight of any such item
                                                                can be found on its detail page. To reflect the policies
                                                                of the shipping companies we use, all weights will be
                                                                rounded up to the next full pound.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/ End Description Tab -->


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <section class="midium-banner section">
        <div class="container">
            <div class="row">
                <?php
                $advertisement_4 = Advertisement::where('type', '9')
                    ->orderby('id', 'desc')
                    ->where('status', 'active')
                    ->limit(2)
                    ->get();
                ?>
                @if (count($advertisement_4) > 0)
                    @foreach ($advertisement_4 as $value)
                        <div class="col-md-6">

                            <a href="{{ $value->short_order }}" title="{{ $value->title }}"><img
                                    src="{{ URL::to('uploads/advertisement') }}/{{ $value->image_link }}"
                                    alt="{{ $value->title }}" class="bannerimage"></a>

                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    <div class="product-area most-popular section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Related Item</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="owl-carousel popular-slider">
                        <!-- Start Single Product -->

                        @if (isset($related_product))
                            @foreach ($related_product as $key => $r_product_data)
                                <?php
                                if ($r_product_data->offer_price > $r_product_data->sell_price) {
                                    $percentage = round((($r_product_data->offer_price - $r_product_data->sell_price) * 100) / $r_product_data->offer_price);
                                } else {
                                    $percentage = 0;
                                }

                                ?>
                                <div class="single-product-owl box-shadow mb-10 product-height">
                                    <div class="product-img">
                                        <a target="__blank"
                                            href="{{ route('product.slug', ['slug' => $r_product_data->product_slug]) }}">

                                            @if ($r_product_data->image != '')
                                                <img class="default-img"
                                                    src="{{ URL::to('uploads/product/' . $r_product_data->product_id . '/200x200/' . $r_product_data->image) }}"
                                                    alt="">
                                            @else
                                                <img class="default-img" src="{{ URL::to('logo/nofound.jpg') }}"
                                                    alt="{{ $r_product_data->product_title }}">
                                            @endif

                                            @if ($r_product_data->offer_price)
                                                <span class="price-dec">{{ $percentage }}% Off</span>
                                            @endif
                                        </a>
                                        <div class="button-head">
                                            <div class="product-action">
                                                {{-- <a class="product_quick_view" data-href="{{route('product.quick.view')}}" product-id="{{$r_product_data->product_id}}"  title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a> --}}

                                                @if (!empty(\Auth::user()))
                                                    <a class="add_to_wishlist"
                                                        data-href="{{ route('customer.add.to.wishlist') }}"
                                                        product-id="{{ $r_product_data->product_id }}"
                                                        title="Wishlist"> <i class="ti-heart"></i><span>Add to
                                                            Wishlist</span> </a>
                                                @else
                                                    <a class="add-to-cart" href="{{ route('web.customer.account') }}"
                                                        target="__blank" title="Wishlist"> <i
                                                            class="ti-heart"></i><span>Add to Wishlist</span> </a>
                                                @endif

                                            </div>
                                            <div class="product-action-2">
                                                <a title="Add to cart" class="add_cart_ajax" product_quantity="1"
                                                    product_weight="{{ $r_product_data->weight }}"
                                                    product_id="{{ $r_product_data->product_id }}"
                                                    product_category_id=""
                                                    product_merchant_id="{{ $r_product_data->product_merchant_id }}"
                                                    product_image="{{ URL::to('uploads/product/' . $r_product_data->product_id . '/200x200/' . $r_product_data->image) }}">Add
                                                    to cart</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h3><a
                                                href="{{ route('product.slug', ['slug' => $r_product_data->product_slug]) }}">{{ $r_product_data->product_title }}</a>
                                        </h3>
                                        <div class="product-price">
                                            @if ($r_product_data->offer_price)
                                                <span class="old">{{ __('messages.tk') }}
                                                    {{ number_format($r_product_data->offer_price, 2) }}</span>
                                            @endif

                                            <span>{{ __('messages.tk') }}
                                                {{ number_format($r_product_data->sell_price, 2) }}</span>
                                            <section class="addButtonWrapper border-radius-small">
                                                <i class="express ti-bag" id="svgIcon"></i>
                                                @if ($r_product_data->quantity > 0 || $r_product_data->quantity == null)
                                                    <p class="buyText add_cart_ajax" product_quantity="1"
                                                        product_weight="{{ $r_product_data->weight }}" id="cart"
                                                        product_id="{{ $r_product_data->product_id }}"
                                                        product_category_id=""
                                                        product_merchant_id="{{ $r_product_data->product_merchant_id }}"
                                                        product_image="{{ URL::to('uploads/product/' . $r_product_data->product_id . '/200x200/' . $r_product_data->image) }}">
                                                        Add to bag</p>
                                                @else
                                                    <p class="buyText" id="cart-out"><a
                                                            href="{{ route('product.slug', ['slug' => $r_product_data->product_slug]) }}">Out
                                                            of stock</a></p>
                                                @endif
                                            </section>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>



    @include('Web::layouts.footer')
    @include('Web::layouts.js')
    <script type="text/javascript" src="{{ URL::to('src/xzoom.js') }}"></script>
    <script>
        /* calling script */
    $(".xzoom, .xzoom-gallery").xzoom({tint: '#333', Xoffset: 15});
    </script>
    @include('Web::layouts.javascript')

    <div class="back-to-top"><i class="fa fa-angle-up"></i></div>
</body>

</html>
