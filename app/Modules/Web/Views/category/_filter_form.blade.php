{!! Form::open(['url' => $currentURL, 'method' => 'get', 'id' => 'submit_search_filter', 'class' => '']) !!}

<input type="hidden" id="filter_sort_by" name="sort_by" value="<?=isset($_GET['sort_by']) && !empty($_GET['sort_by'])?$_GET['sort_by']:'';?>">

<input type="hidden" id="filter_max_price" name="max_value" value="<?=isset($_GET['max_value']) && !empty($_GET['max_value'])?$_GET['max_value']:'';?>">
<input type="hidden" id="filter_min_price" name="min_value" value="<?=isset($_GET['min_value']) && !empty($_GET['min_value'])?$_GET['min_value']:'';?>">

	@if(isset($attribute_list))	
	@if(count($attribute_list) > 0)	
		@foreach($attribute_list as $attribute)

			<?php
				$attr_value = '';
				$attr = str_slug(strtolower($attribute['code_column']));
				if(isset($_GET[$attr]))
				{
					$attr_value = $_GET[$attr];
				}
			?>
			<input id="filter_attr_{{$attribute['attribute_id']}}" type="hidden" name="{{$attr}}" value='{{$attr_value}}'>	
		@endforeach
	@endif	
		@endif	

{!! Form::close() !!}