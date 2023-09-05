@extends('Merchant::merchant.merchant_master')
@section('body')

<section class="top-teacher-area section-padding-50" style="background-image: url({{ asset('frontend') }}/img/core-img/texture.png);">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading">
                    	<h2>MARCHANT PRODUCT LIST</h2>
                        <h3>{{$varifaid_user->shop_name}}</h3>
                                                
                            <button data-toggle="modal" data-target="#edit_profile" class="btn-style-1 float-left">Add New Product</button>
                            <a href="javascript:history.back()" class="btn-style-1 float-right">Back</a>
                    </div>
                </div>
            </div>

            <div class="row">
            	<div class="col-lg-12">

            		<div class="table-responsive">

            			<table class="table table-striped">
							  <thead>
							    <tr>
							      <th scope="col">#</th>
							      <th scope="col">Style No</th>
							      <th scope="col">Product Name</th>
                                  <th scope="col">Price</th>
							      <th scope="col">Stock</th>
							     
								  <th scope="col">Status</th>	
								  <th scope="col">Action</th>
							    </tr>
							  </thead>
							  <tbody>
							  	@if(count($product) > 0)
								  	<?php
								  		$total_rows = 1;
								  	?>
								  	@foreach($product as $values)
								  		
								    <tr>
								      <th scope="row"> <?=$total_rows?></th>
								      <td><?php
											$item_no_explode = explode('-',$values->item_no);

											if(isset($item_no_explode)){
												


												for($i=2;$i<(count($item_no_explode) - 1);$i++){
													echo $item_no_explode[$i];

													if($i < (count($item_no_explode) - 2)){
														echo '-';
													}
												}
											}?></td>
								      <td>{{$values->title}}</td>
								      <td>Tk {{$values->sell_price}}</td>
								      
                                      <td>{{isset($values->relProductInventory->quantity)?ucfirst($values->relProductInventory->quantity):''}}</td>
								      <td>{{$values->status}}</td>
								      <td>
								      	<div class="btn-group" role="group" aria-label="Button group with nested dropdown">                         

				                          <div class="btn-group" role="group">
				                            <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				                             Action
				                            </button>
				                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
				                              <a class="dropdown-item" href="{{ route('merchant.product.show', $values->id) }}">Details</a>
				                              <a class="dropdown-item" href="{{ route('merchant.product.edit',$values->id) }}">Edit</a>
				                              <a class="dropdown-item" onclick="return confirm('Are you sure to Delete?')" href="{{ route('merchant.product.delete',$values->id) }}">Delete</a>
				                              <a class="dropdown-item" href="{{ route('merchant.product.clone', $values->id) }}">Duplicate</a>
				                            </div>
				                          </div>
				                        </div>
								      </td>
								    </tr>
								    <?php
								    $total_rows++;
								    ?>
								    @endforeach
							    @endif
							  </tbody>
							</table>

							<nav aria-label="Page navigation" class="float-right">
							  <ul class="pagination">
							  {{ $product->links() }}
							  </ul>
							</nav>

            		</div>

            	</div>
            </div>

        </div>
</section>


<div class="modal fade" id="edit_profile" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="largeModalLabel">Add New Product</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>                    
            </div>
            <div class="modal-body">
                <div class="contact-form">

                  <?php $url = route('merchant.product.store'); ?>
                  {!! Form::open(array('url' => $url, 'method' => 'post', 'id'=>'productform')) !!}
                  <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                           {!! Form::label('attribute_set_id', 'Attribute Set', array('class' => 'col-form-label')) !!}     

                           {!! Form::Select('attribute_set_id', $attribute_set_lists ,Input::old('attribute_set_id'),['id'=>'attribute_set_id', 'class'=>'form-control selectheight']) !!}
                           <span class="error">{!! $errors->first('attribute_set_id') !!}</span>

                           <input type="hidden" name="type" id="type" value="simple-product">
                           <input type="hidden" name="status" id="status" value="inactive">
                           <input type="hidden" name="merchant_id" id="merchant_id" value="{{Auth::user()->id}}">
                           
                       </div>
                   </div>
             <div class="col-12">
            <button type="submit" class="btn clever-btn w-25 pull-right">Submet</button>
        </div>
    </div>
    {!! Form::close() !!}

</div>
</div>

</div>
</div>
</div>

    
@endsection