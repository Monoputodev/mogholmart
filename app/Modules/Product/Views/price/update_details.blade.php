

    
                <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                     <tr>
                        <th>No</th>
                        <th>Product Id</th>
                        <th>Title</th>
                        <th>Sell Price</th>
                        <th>Update sell Price</th>
                        <th>list Price</th>
                        <th>Update list Price</th>
                        <th>Time / Date</th>                    </tr>
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
                        {{number_format($values->update_price,2)}}
                    </td>

                    <td>
                        {{number_format($values->actual_list_price,2)}}
                        
                    </td>

                    <td>
                        {{number_format($values->list_update_price,2)}}
                        
                    </td>
                    
                    <td>
                     {{$values->updated_at}}
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