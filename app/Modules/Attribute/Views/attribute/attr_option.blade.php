@extends('Admin::layouts.master')
@section('body')

<div class="block-header block-header-2">
    <h2 class="pull-left">
        Attribute Option
    </h2>

    <a style="margin-left: 10px;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>
    <a data-toggle="modal"  data-color="blue" href="#open_modal" class="btn btn-primary waves-effect pull-right">Add Attribute Option</a>

</div>


<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                   LIST OF ATTRIBUTE OPTION
               </h2>
           </div>
           <div class="body">
            <div class="table-responsive">

                <table class="table table-bordered table-striped table-hover dataTable js-basic-example">
                    <thead>
                        <tr>
                            <th> No</th>
                            <th> Option Title </th>
                                                   
                            <th> Slug </th>
                            <th> Status</th>
                            <th> Action </th>
                        </tr>
                    </thead>

                    <tbody>
                     @if(count($attr_option) > 0)
                     <?php
                     $serial = 1;
                     ?>
                     @foreach($attr_option as $attr)
                     <tr>
                        <td>
                         {{$serial}}
                     </td>
                     <td>
                         {{$attr->frontend_title}}
                     </td>

                     

                     <td>
                         {{$attr->slug}}
                     </td>
                     <td>
                      @if($attr->status=='active')
                      <button type="button" class="btn btn-success btn-sm">{{ucfirst($attr->status)}}</button>
                      @elseif($attr->status=='inactive')
                      <button type="button" class="btn btn-warning btn-sm">{{ucfirst($attr->status)}}</button>
                       @else
                       <button type="button" class="btn btn-danger btn-sm">{{ucfirst($attr->status)}}</button>
                       @endif
                     </td>
                     <td>

                        <a data-href="{{ route('admin.attribute.option.edit', $attr->id) }}" class="open-attr-modal demo-google-material-icon mousepointer" ><i class="material-icons">border_color</i></a>
                    </a>

                    <a href="{{ route('admin.attribute.option.destroy', $attr->id) }}" class="demo-google-material-icon" onclick="return confirm('Are you sure to Delete?')" ><i class="material-icons">delete</i></a>
                </td>
            </tr>
            <?php
            $serial++;
            ?>
            @endforeach
            @endif
        </tbody>
    </table>

</div>
</div>
</div>
</div>
</div>



<div class="modal fade" id="open_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">Attribute Option</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'admin.attribute.option.store',  'files'=> true, 'id'=>'', 'class' => 'form-horizontal attribute_option_form']) !!}

                @include('Attribute::attribute._form_option')
                <input type="hidden" value="{{$attid}}">

                {!! Form::close() !!}
            </div>

        </div>
    </div>
</div>
<!-- modal for attribute update -->

<div class="modal fade open_modal_update" tabindex="" role="dialog" style="display: none;">
    <div class="modal-dialog modal-lg">

        <div class="modal-content">
         <div class="modal-header">
            <h4>Attribute Option update</h4>
        </div>
        <div class="modal-body">



        </div> <!-- / .modal-body -->
    </div> <!-- / .modal-content -->
</div> 
</div>


<script type="text/javascript">
  // function loadModal(url) {
  // $('.modal-body').load(url);
  // }


  function convert_to_slug(){
    var str = document.getElementById("frontend_title").value;
    str = str.replace(/[^a-zA-Z0-12\s]/g,"");
    str = str.toLowerCase();
    str = str.replace(/\s/g,'-');
    document.getElementById("slug").value = str;

}

function custom_validate(){

    $(".attribute_option_form").validate({
        rules:{
            slug:{
                required:true,
            },

            
            frontend_title:{
                required:true
            },

            status:{
                required:true
            }

        },
        messages:{
            slug:'Please enter slug',
           
            frontend_title: 'Plese enter frontend title',
            status: 'Plese choose status'
        }
    });

}

custom_validate();

$(document).delegate('.open-attr-modal','click',function () {

    var url = $(this).attr('data-href');
    var id = '';

    $.ajax({
        url: url,
        method: "GET",
        data: {id:id},
        dataType: "json",
        beforeSend: function( xhr ) {

        }
    }).done(function( response ) {
        if(response.result == 'success'){

            $('.open_modal_update .modal-body').html(response.content);

            $('.open_modal_update').modal('show');

        }else{

        }
    }).fail(function( jqXHR, textStatus ) {
    });
    return false;
});

</script>

@endsection