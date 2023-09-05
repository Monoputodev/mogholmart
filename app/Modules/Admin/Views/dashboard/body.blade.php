<div class="block-header">
    <h2>{{__('messages.dashboard')}}</h2>
</div>

<!-- Widgets -->
<div class="row clearfix">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a href="{{ route('admin.product.total.update.report') }}" style="text-decoration: none;" class="info-box bg-green hover-expand-effect mousepointer">
            <div class="icon">
                <i class="material-icons">devices</i>
            </div>
            <div class="content">
                <div class="text">TOTAL PRODUCT'S</div>
                <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20">({{$total_product}})</div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a href="{{ route('admin.order.total.order.report') }}" style="text-decoration: none;" class="info-box bg-orange hover-expand-effect mousepointer">
            <div class="icon">
                <i class="material-icons">shopping_cart</i>
            </div>
            <div class="content">
                <div class="text">TOTAL ORDER'S</div>
                <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20">({{$total_order}})</div>
            </div>
        </a>
    </div>

       

    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a href="{{ route('admin.order.todays.order.report') }}" style="text-decoration: none;" class="info-box bg-black hover-expand-effect mousepointer">
            <div class="icon">
                <i class="material-icons">list</i>
            </div>
            <div class="content">
                <div class="text">TODAY'S ORDER</div>
                <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20">({{$todays_order}})</div>
            </div>
        </a>
    </div>

     <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a href="{{ route('admin.order.fifteendays.order.report') }}" style="text-decoration: none;"class="info-box bg-red hover-expand-effect">
            <div class="icon">
                <i class="material-icons">list</i>
            </div>
            <div class="content">
                <div class="text">LAST 15 DAY'S ORDER</div>
                <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20">({{$last_15_days_order}})</div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
       <a href="{{ route('admin.order.last.onemonth.order.report') }}" style="text-decoration: none;" class="info-box bg-purple hover-expand-effect">
            <div class="icon">
                <i class="material-icons">list</i>
            </div>
            <div class="content">
                <div class="text">LAST 30 DAY'S ORDER</div>
                <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20">({{$last_30_days_order}})</div>
            </div>
        </a>
    </div>
    
    
</div>

<!-- #END# Widgets -->
