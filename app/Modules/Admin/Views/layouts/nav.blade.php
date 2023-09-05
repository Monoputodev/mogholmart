@if(!empty(Auth::guard()->user()) > 0)

<aside id="leftsidebar" class="sidebar">
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li>
                <a href="{{URL::to(config('global.prefix_name').'/dashboard')}}">
                    <i class="material-icons">home</i>
                    <span>{{__('messages.Home')}}</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">settings_applications</i>
                    <span>{{__('messages.configuration')}}</span>
                </a>
                <ul class="ml-menu">
                    <li ><a href="{{ route('admin.settings.index') }}">{{__('messages.systemSetting')}}</a></li>
                {{-- <li><a href="{{ route('admin.roles.index') }}">Role</a></li>
                <li><a href="{{ route('admin.permission.index') }}">Permission</a></li>
                <li><a href="{{ route('admin.roles.permission.index') }}">Role Permission</a></li> --}}
                <li><a href="{{ route('admin.user.index') }}">User</a></li>
                {{-- <li><a href="{{ route('admin.roles.user.index') }}">Role User</a></li> --}}
            </ul>
        </li>
        <li>
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">group</i>
                <span>Merchant</span>
            </a>
            <ul class="ml-menu">
             <li><a href="{{ route('admin.merchant.list') }}">Merchant List</a></li>

             <li><a href="{{ route('admin.merchant.inactive') }}">Inactive Merchant List</a></li>

             <li><a href="{{ route('admin.merchant.non.agreement') }}">Non Agreement Merchant List</a></li>
             <li><a href="{{ route('admin.merchant.switching') }}">Merchant Switch</a></li>

         </ul>
     </li>
    {{--  <li>
        <a href="javascript:void(0);" class="menu-toggle">
            <i class="material-icons">attach_money</i>
            <span>Discount</span>
        </a>
        <ul class="ml-menu">
            <li><a href="{{ route('admin.discount.index') }}">Discount</a></li>

        </ul>
    </li> --}}

    <li>
        <a href="javascript:void(0);" class="menu-toggle">
            <i class="material-icons">list</i>
            <span>Commission</span>
        </a>
        <ul class="ml-menu">
            <li><a href="{{ route('admin.comission.setting.index') }}">Commission Setting</a></li>
            <li><a href="{{ route('admin.comission.merchant.index') }}">Commission By Merchant</a></li>
        </ul>
    </li>
    <li>
        <a href="javascript:void(0);" class="menu-toggle">
            <i class="material-icons">list</i>
            <span>Product</span>
        </a>
        <ul class="ml-menu">
            <li><a href="{{route('admin.category.index')}}">Category</a></li>
            <li><a href="{{ route('admin.attribute.index') }}">Attribute</a></li>
            <li><a href="{{ route('admin.attribute.set.index') }}">Attribute Set</a></li>
            <li><a href="{{ route('admin.manufacture.index') }} ">Dealer</a></li>
            <li><a href="{{ route('admin.brand.index') }}">Brand</a></li>
            <li><a href="{{ route('admin.product.index') }}">Product</a></li>
            <li><a href="{{ route('admin.product.inventory.index') }}">Product Inventory</a></li>
            <li><a href="{{ route('admin.customer.product.review') }}">Product Review</a></li>

            <li><a href="{{ route('admin.coupon.index') }}">Coupon</a></li>
            {{-- <li><a href="{{ route('admin.product.general.image') }}">General Image</a></li> --}}
        </ul>
    </li>
    <li>
        <a href="javascript:void(0);" class="menu-toggle">
            <i class="material-icons">add_shopping_cart</i>
            <span>Order</span>
        </a>
        <ul class="ml-menu">
            <li><a href="{{ route('admin.order.index') }}">Order</a></li>
            {{-- {{--  <li><a href="{{ route('admin.merchant.order.index') }}">Merchant Wise Order</a></li> --}}
            {{-- <li><a href="{{ route('admin.medicine.index') }}">Medicine Order</a></li> --}}
        </ul>
    </li>
    <li>
        <a href="javascript:void(0);" class="menu-toggle">
            <i class="material-icons">view_list</i>
            <span>Common</span>
        </a>
        <ul class="ml-menu">
           <li><a href="{{ route('admin.slider.index') }}">Slider</a></li>
           <li><a href="{{ route('admin.generalpages.index') }}">General Pages</a></li>
           {{-- <li><a href="{{ route('admin.menu.index') }}">Web Menu</a></li> --}}
           <li><a href="{{ route('admin.advertisement.index') }} ">Advertisement</a></li>
           <li><a href="{{ route('admin.testimonial.index') }} ">Testimonial</a></li>
           <li><a href="{{ route('admin.faq.index') }}">Faq</a></li>

       </ul>
   </li>
   <li>
    <a href="javascript:void(0);" class="menu-toggle">
        <i class="material-icons">report</i>
        <span>Report</span>
    </a>
    <ul class="ml-menu">
        <li><a href="{{ route('admin.product.report.index') }}">Product</a></li>
        <li><a href="{{ route('admin.order.report.index') }}">Order</a></li>
        <li><a href="{{ route('admin.collection.report.index') }}">Collection Report</a></li>
        <li><a href="{{ route('admin.sales.report.index') }}">Sales Report</a></li>
    </ul>
</li>
<li>
    <a href="javascript:void(0);" class="menu-toggle">
        <i class="material-icons">send</i>
        <span>Newsletter</span>
    </a>
    <ul class="ml-menu">
     <li><a href="{{ route('admin.subscription.index') }}">Subscription</a></li>
     {{-- <li><a href="#">Promotion</a></li> --}}
 </ul>
</li>

</ul>
</div>
<!-- #Menu -->
</aside>
@endif


