<aside class="col-md-3 col-sm-4 col-xs-12 content-aside right_column sidebar-offcanvas">
	
	<div class="list-group">
		@if(Auth::user())
		<a href="{{route('customer.dashboard')}}" class="list-group-item <?=Route::currentRouteName()=='customer.dashboard'? 'active-hover-m':'active-m'?>">Dashboard</a>



		<a href="{{route('customer.profile')}}" class="list-group-item <?=Route::currentRouteName()=='customer.profile'? 'active-hover-m':'active-m'?>">Profile</a>

		

		<a href="{{route('customer.address')}}" class="list-group-item <?=Route::currentRouteName()=='customer.address'? 'active-hover-m':''?>">Address Book</a>
		<a href="{{route('customer.wishlist')}}" class="list-group-item <?=Route::currentRouteName()=='customer.wishlist'? 'active-hover-m':''?>">Wish List</a>

		<a href="{{route('customer.order')}}" class="list-group-item <?=Route::currentRouteName()=='customer.order'? 'active-hover-m':''?>">Order History</a> 
		
		
		<a href="{{route('customer.change.password')}}" class="list-group-item <?=Route::currentRouteName()=='customer.change.password'? 'active-hover-m':''?>">Change Password</a>
		<a href="{{route('customer.logout')}}" class="list-group-item">Logout</a>
		@else
		
		<a href="{{route('web.customer.account')}}" class="list-group-item <?=Route::currentRouteName()=='web.customer.account'? 'active-hover-m':'active-m'?>">Sign In</a>

		<a href="{{route('web.customer.register')}}" class="list-group-item <?=Route::currentRouteName()=='web.customer.register'? 'active-hover-m':'active-m'?>">Sign Up</a> 
		@endif
		
	</div>

</aside>
