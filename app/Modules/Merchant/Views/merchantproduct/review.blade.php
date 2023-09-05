{!! Form::model($review_data,['method' => 'PATCH', 'files'=> true, "class"=>"", 'id' => 'inventoryform']) !!}


<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
?>

<div class="table-responsive">

    <table class="table table-bordered table-striped table-hover dataTable js-basic-example">
        <thead>
            <tr>
                <th>Serial No</th>
                <th> Rating </th>
                <th> Product Name </th>
                <th> Customer Name</th>
                <th> Review Title</th>
                <th> Review</th>
                <th> Status</th>
                
            </tr>
        </thead>
        <tbody>
         @if(count($review_data) > 0)
         <?php
         $total_rows = 1;
         ?>
         @foreach($review_data as $values)
         <tr>
            <td>
                <?=$total_rows?>

            </td>
            <td>
                {{$values->rating_value_score}}
            </td>
            <td>
                @if (isset($values->relProduct))
                {{$values->relProduct->product_title}}
                @endif

            </td>
            <td>
                @if (isset($values->relUser))
                {{$values->relUser->first_name}} {{$values->relUser->last_name}}
                @endif
            </td>
            <td>
                {{$values->title}}
            </td>
            <td>
               {!!$values->review!!}

           </td>
           <td>

            @if ($values->status=='inactive')
            <p style="color: red">{{$values->status}}</p>

            @elseif($values->status=='active')

            <p style="color: green">{{$values->status}}</p>

            @elseif($values->status=='cancel')

            <p style="color: orange">{{$values->status}}</p>
            @endif

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
{!! Form::close() !!}

