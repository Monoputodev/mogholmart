



    
                <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                     <tr>
                        <th>No</th>
                        <th>Product Id</th>
                        <th>Title</th>
                        <th>Sell Price</th>
                        <th>list Price</th>
                        <th>Date / Time</th>
                        <th>Action</th>
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
                        <a target="new" href="{{ route('admin.product.edit', $values->product_id) }}">{{$values->product_id}}</a>
                    </td>
                    <td>
                        {{$values->title}}
                    </td>
                    
                    <td>
                        {{number_format($values->actual_price,2)}}
                    </td>

                    

                    <td>
                        {{number_format($values->actual_list_price,2)}}
                        
                    </td>

                    <td>{{$values->updated_at}}</td>

                    <td>
                      <form id="form_data" method="POST" action="{{ route('admin.price.update.store') }}">
                        {{ csrf_field()}}
                        <input type="hidden" name="product_id[]" value="{{$values->product_id}}">
                        <input type="hidden" name="actual_price[]" id="actual_price" value="{{$values->sell_price}}">
                        <input type="hidden" name="update_price[]" value="{{$values->actual_price}}" class="form-control" placeholder="Update Price">
                        <input type="hidden" name="actual_list_price[]" id="actual_list_price" value="{{$values->list_price}}">

                        <input type="hidden" name="update_list_price[]" value="{{$values->actual_list_price}}" class="form-control" placeholder="Update List Price">
                        <button onClick="return confirm('Are you absolutely sure,you want to change price?')" type="submit" id="update" class="btn btn-primary waves-effect float-right">Set Current</button>
                      {{-- <a href=""></a> --}}
                    </form>
                    </td>

             </tr>
             <?php
             $total_rows++;
             ?>

             @endforeach
         
             @endif

         </tbody>
     </table>
       
     </div>