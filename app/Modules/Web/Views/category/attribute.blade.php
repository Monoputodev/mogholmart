

@if(count($attribute_list) > 0)	
@foreach($attribute_list as $attribute)

<div class="single-widget category so-filter-options" data-id="{{$attribute['attribute_id']}}">
	<h3 class="title">{{$attribute['frontend_title']}}</h3>

	<ul class="check-box-list">
		@if(count($attribute['attribute-option']) > 0)
				@foreach($attribute['attribute-option'] as $attribute_option)

				<?php
				$attr_checked = 'no';
				$attribute_filter_class = 'attribute_filter';
				$attr = str_slug(strtolower($attribute['code_column']));
				if(isset($_GET[$attr]) && $_GET[$attr] == $attribute_option)
				{
					$attr_checked = 'yes';
					$attribute_filter_class = 'attribute_remove_filter';
				}
				?>
		<li>
			<label class="checkbox-inline" for="{{$attribute['attribute_id']}}_{{$attribute_option}}">
				<input type="checkbox" <?=$attr_checked=='yes'?'checked':''?> class="ant-checkbox-input <?=$attribute_filter_class?>"  value="{{$attribute_option}}" id="{{$attribute['attribute_id']}}_{{$attribute_option}}" name="attribute"  data-id="{{$attribute['attribute_id']}}">  {{$attribute_option}}</span>
			</label>
		</li>

		@endforeach
		@endif
		
	</ul>
</div>
@endforeach
@endif

