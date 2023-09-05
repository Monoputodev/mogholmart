
@if(count($sub_category) > 0)


<div class="single-widget category">
	<h3 class="title">Categories</h3>
	<ul class="categor-list">
		@foreach($sub_category as $sub_category_data)
		<li><a href="{{route('category.child.slug',[
		'main_category_slug' => $category_data->category_slug,
		'slug' => $sub_category_data->category_slug
		])}}">{{$sub_category_data->category_title}} </a></li>
		@endforeach
	</ul>
</div>
@endif
