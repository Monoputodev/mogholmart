@extends('Admin::layouts.master')
@section('body')

<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
?>

<div class="block-header block-header-2">
    <h2 class="pull-left">
        New Product Search
    </h2>
    <a style="margin-left: 10px;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>
</div>
<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">

			<div class="body">
				{!! Form::open(['method' =>'GET', 'route' => 'admin.new.order.search', 'id'=>'', 'class' => 'form-horizontal']) !!}
				<div class="input-group">
					<div class="form-line">            
						{!! Form::text('item_no',@Input::get('item_no')? Input::get('item_no') : null,['class' => 'form-control assign_product_typeahead','placeholder'=>'Please type product name or item no', 'data-type'=>'assign_child_product']) !!}
					</div>
					<span class="input-group-addon">
						<button type="submit" class="btn bg-red waves-effect">
							Search
						</button>
					</span>
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	
	    function init_typeahead_assign_product() {
        var pid = $('#product_id').attr('data-val');

        $(".assign_product_typeahead").typeahead("destroy");

        var product_list = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.whitespace,
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
                url: '<?php echo URL::to(''); ?>/{{config('global.prefix_name')}}/admin/new/search/product/%QUERY',
                wildcard: '%QUERY'
            }
        });

       //var Handlebars = require('handlebars');

        $(".assign_product_typeahead").typeahead({
            hint: true,
            highlight: true,
            minLength: 2,
            limit: 50
        },
        {
            name: 'product_list',
            source: product_list,
            displayKey : 'item_no',
            templates: {
                suggestion: Handlebars.compile("<p style='padding:5px 10px;margin-bottom:0;'><b style='font-size:12px;'>@{{title}}</b><br/><small><i>Item no:</i> @{{item_no}} </small></p>")
            }

        }).bind('typeahead:selected', function(obj, selected, name) {

            var target = obj.target;
            var add_type = $(target).attr('data-type');

            //save_assign_product(selected.id,add_type);

            return false;

        });

    }
	init_typeahead_assign_product();
 
</script>
@endsection