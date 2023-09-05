

<div class="single-widget range">
	<h3 class="title">Shop by Price</h3>
	<div class="price-filter">
		<div class="price-filter-inner">
			
			<div class="price_slider_amount">
				<div class="label-input">
					
					<input id="min_value" type="number" min="0" name="min_value" class="form-control input_min pull-left" placeholder="Min" value="<?=isset($_GET['min_value']) && !empty($_GET['min_value'])?$_GET['min_value']:'';?>" pattern="[0-9]*" data-spm-anchor-id="">
					<input id="max_value" type="number" min="0" class="form-control input_max pull-right" name="max_value" placeholder="Max" value="<?=isset($_GET['max_value']) && !empty($_GET['max_value'])?$_GET['max_value']:'';?>" pattern="[0-9]*"> 
				</div>
			</div>
		</div>
	</div>

</div>