<?php
	$total = count($data) + count($inactive_product);
?>


<h3>Total product for this category is {{$total}} , Active : {{count($data)}} , Inactive : {{count($inactive_product)}}</h3>
<table class="table table-bordered table-striped table-hover">
                    <thead>
                     <tr>
                        <th>No</th>
                        <th>Product Id</th>
                        {{-- <th> Item No </th> --}}
                        <th> Title </th>
                        <th>Sell Price</th>
                        <th>Update Price</th>
                        <th>Status</th>
                        <th> Action </th>
                    </tr>
                </thead>

                <tbody>
                  @if(count($data) > 0)
                  <?php
                  $total_rows = 1;
                  ?>
                  @foreach($data as $values)


                <tr>
                    <td><?=$total_rows?></td>
                    <td>
                    	<a href="{{ route('admin.product.edit', $values->id) }}">{{$values->id}}</a>
                    </td>
                    {{-- <td><a href="{{ route('admin.product.edit', $values->id) }}">{{$values->item_no}}</a></td> --}}
                    <td>
                        {{$values->title}}
                    </td>
                    <td>
                    	{{$values->sell_price}}
                    </td>

                    <td>
                    	<input type="text" placeholder="Update Price">
                    </td>

                    <td>
                    	{{$values->status}}
                    </td>
					
                    <td>
                     <a href="{{ route('admin.product.edit', $values->id) }}" class="demo-google-material-icon" ><i class="material-icons">border_color</i></a>
                 </td>

             </tr>
             <?php
             $total_rows++;
             ?>
             @endforeach
             @endif

         </tbody>
     </table>