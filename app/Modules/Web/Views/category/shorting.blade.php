<div class="col-12">
	<!-- Shop Top -->
	<div class="shop-top">
		<div class="shop-shorter">
			
			<div class="single-shorter">
				<label>Sort By :</label>
				<select id="sort_by" class="form-control-select sort_by" name="sort_by" data-role="sort_by">

					<option <?=isset($_GET['sort_by']) && $_GET['sort_by'] == 'latest' ? 'selected': '';?> value="latest">Default</option>

					<option  <?=isset($_GET['sort_by']) && $_GET['sort_by'] == 'name_asc' ? 'selected': '';?> value="name_asc">Name (A - Z)</option>


					<option <?=isset($_GET['sort_by']) && $_GET['sort_by'] == 'name_desc' ? 'selected': '';?> value="name_desc">Name (Z - A)</option>


					<option <?=isset($_GET['sort_by']) && $_GET['sort_by'] == 'price_asc' ? 'selected': '';?> value="price_asc">Price (Low &gt; High)</option>


					<option <?=isset($_GET['sort_by']) && $_GET['sort_by'] == 'price_desc' ? 'selected': '';?> value="price_desc">Price (High &gt; Low)</option>


					<option <?=isset($_GET['sort_by']) && $_GET['sort_by'] == 'rating_desc' ? 'selected': '';?> value="rating_desc">Rating (Highest)</option>


					<option <?=isset($_GET['sort_by']) && $_GET['sort_by'] == 'rating_asc' ? 'selected': '';?> value="rating_asc">Rating (Lowest)</option>
				</select>
			</div>
		</div>
		
	</div>
	<!--/ End Shop Top -->
</div>