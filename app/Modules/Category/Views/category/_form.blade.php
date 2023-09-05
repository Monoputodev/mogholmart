    <?php
    use Illuminate\Support\Facades\URL;
    use Illuminate\Support\Facades\Input;
    ?>


    <div class="row">
      <div class="col-md-6">
        <div class="form-group">

          <div class="form-line">
            {!! Form::label('parent_category', 'Parent Category', array('class' => 'col-form-label')) !!}     
            {!! Form::Select('parent_category', $parent_category_options ,Input::old('parent_category'),['id'=>'parent_category', 'class'=>'form-control selectheight select2class']) !!}
            {!! $errors->first('parent_category') !!}
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">

          <div class="form-line">
            {!! Form::label('title', 'Title', array('class' => 'col-form-label')) !!}     
            {!! Form::text('title',Input::old('title'),['id'=>'title','class' => 'form-control','required'=> 'required',  'placeholder'=>'Enter category Title', 'onkeyup'=>"convert_to_slug();"]) !!}
            {!! $errors->first('title') !!}
          </div>
        </div>

      </div>

      <div class="col-md-6">
        <div class="form-group">

          <div class="form-line">
           {!! Form::label('slug', 'Slug', array('class' => 'col-form-label')) !!}     
           {!! Form::text('slug',Input::old('slug'),['id'=>'slug','class' => 'form-control','required'=> 'required', 'placeholder'=>'Enter category Slug' ]) !!}

           {!! $errors->first('slug') !!}
         </div>
       </div>
     </div>
     <div class="col-md-6">
      <div class="form-group">

        <div class="form-line">
         {!! Form::label('short_order', 'Short Order', array('class' => 'col-form-label')) !!}
         {!! Form::text('short_order',Input::old('short_order'),['id'=>'short_order','class' => 'form-control', 'placeholder'=>'Enter Serial' ]) !!}

         {!! $errors->first('short_order') !!}
       </div>
     </div>
   </div>
   <div class="col-md-12">

    <div class="form-group">

      <div class="form-line">
       {!! Form::label('description', 'Description', array('class' => 'col-form-label')) !!}
       {!! Form::textarea('description',Input::old('description'),['id'=>'description','class' => 'form-control', 'placeholder'=>'Enter Description', 'rows'=>'3', 'cols'=>'50']) !!}

       {!! $errors->first('description') !!}
     </div>
   </div>
 </div>



 <div class="col-md-6">


  <div class="form-group">

    <div class="form-line">
      {!! Form::label('show_in_main_menu', 'Show in Main Menu', array('class' => 'col-form-label')) !!}

      {!! Form::Select('show_in_main_menu',array('no'=>'No','yes'=>'Yes'),Input::old('show_in_main_menu'),['id'=>'show_in_main_menu', 'class'=>'form-control selectheight']) !!}

      {!! $errors->first('show_in_main_menu') !!}
    </div>
  </div>
</div>
<div class="col-md-6">
  <div class="form-group">

    <div class="form-line">
      {!! Form::label('show_in_right_navigation_menu', 'Show in Right Navigation Menu', array('class' => 'col-form-label')) !!}

      {!! Form::Select('show_in_right_navigation_menu',array('no'=>'No','yes'=>'Yes'),Input::old('show_in_left_navigation_menu'),['id'=>'show_in_right_navigation_menu', 'class'=>'form-control selectheight']) !!}

      {!! $errors->first('show_in_right_navigation_menu') !!}
    </div>
  </div>
</div>
<div class="col-md-6">
  <div class="form-group">

    <div class="form-line">
      {!! Form::label('show_in_left_navigation_menu', 'Show in Left Navigation Menu', array('class' => 'col-form-label')) !!} 

      {!! Form::Select('show_in_left_navigation_menu',array('no'=>'No','yes'=>'Yes'),Input::old('show_in_left_navigation_menu'),['id'=>'show_in_left_navigation_menu', 'class'=>'form-control selectheight']) !!}

      {!! $errors->first('show_in_left_navigation_menu') !!}
    </div>
  </div> 
</div>
<div class="col-md-6">
  <div class="form-group">

    <div class="form-line">
      {!!  Form::label('status', 'Status', array('class' => 'col-form-label')) !!}     

      {!! Form::Select('status',array('active'=>'Active','inactive'=>'Inactive','cancel' => 'Cancel'),Input::old('status'),['id'=>'status', 'class'=>'form-control selectheight']) !!}
      {!! $errors->first('status') !!}
    </div>
  </div>
</div>
<div class="col-md-6">
  <div class="form-group">

    <div class="form-line">
      {!! Form::label('image_link', 'Image (Supported format :: jpeg,png,jpg,gif & file size max :: 1MB)', array('class' => 'col-form-label')) !!}


      <div style="position:relative;">
        <a class='btn btn-primary btn-sm font-10' href='javascript:;'>
          Choose File...
          <input name="image_link" type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="file_source" size="40"  onchange='$("#upload-file-info").html($(this).val());'>
        </a>
        &nbsp;
        <span class='label label-info' id="upload-file-info"></span>


      </div>

      @if(isset($data['image_link'] ) && !empty($data['image_link']) )
      <a target="_blank" href="{{URL::to('')}}/uploads/category/{{$data->image_link}}" style="margin-top: 5px;" class="btn btn-primary btn-sm font-10"><img src="{{URL::to('')}}/uploads/category/200x200/{{$data->image_link}}" height="50px" alt="{{$data['image_link']}}" ></img>
      </a>
      @endif
    </div>
  </div> 
  <br>
  <div class="form-group">

    <div class="form-line">
      {!! Form::label('meta_title', 'Meta Title', array('class' => 'col-form-label')) !!} 

      {!! Form::text('meta_title',Input::old('meta_title'),['id'=>'meta_title','class' => 'form-control','placeholder'=>'Enter category Meta Title']) !!}

      {!! $errors->first('meta_title') !!}
    </div>
  </div>
  <br>
  <div class="form-group">

    <div class="form-line">
      {!! Form::label('meta_keywords', 'Meta Keywords', array('class' => 'col-form-label')) !!}

      {!! Form::text('meta_keywords',Input::old('meta_keywords'),['id'=>'meta_keywords','class' => 'form-control','placeholder'=>'Enter category Meta Key']) !!}

      {!! $errors->first('meta_keywords') !!}
    </div>
  </div>
</div>
<div class="col-md-6">

  <div class="form-group">

      <div class="form-line">
        {!! Form::label('banner_link', 'Banner Image (Supported format :: jpeg,png,jpg,gif & file size max :: 1MB)', array('class' => 'col-form-label')) !!}


        <div style="position:relative;">
          <a class='btn btn-primary btn-sm font-10' href='javascript:;'>
            Choose File...
            <input name="banner_link" type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="banner_source" size="40"  onchange='$("#upload-banner-info").html($(this).val());'>
          </a>
          &nbsp;
          <span class='label label-info' id="upload-banner-info"></span>


        </div>

        @if(isset($data['banner_link'] ) && !empty($data['banner_link']) )
        <a target="_blank" href="{{URL::to('')}}/uploads/category/banner/{{$data->banner_link}}" style="margin-top: 5px;" class="btn btn-primary btn-sm font-10"><img src="{{URL::to('')}}/uploads/category/banner/{{$data->banner_link}}" height="50px" alt="{{$data['banner_link']}}" ></img>
        </a>
        @endif
      </div>
    </div>
    <br>
  <div class="form-group">

    <div class="form-line">
      {!! Form::label('meta_description', 'Meta Description', array('class' => 'col-form-label')) !!}

      {!! Form::textarea('meta_description',Input::old('meta_description'),['id'=>'meta_description','class' => 'form-control', 'placeholder'=>'Enter Meta Description','size' => '120x3']) !!}

      {!! $errors->first('meta_description') !!}


    </div>





    <div class="col-md-12">

     {!! Form::submit('Save changes', ['class' => 'btn btn-primary pull-right btn-sm font-10 m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}&nbsp;

   </div>
 </div>


</div>



</div>

<script>
  jQuery('.select2class').select2({
    width: "100%",
    tag: true
  });
  function convert_to_slug(){
    var str = document.getElementById("title").value;
    str = str.replace(/[^a-zA-Z0-12\s]/g,"");
    str = str.toLowerCase();
    str = str.replace(/\s/g,'-');
    document.getElementById("slug").value = str;

  }

</script>

<script>
  $(function() {
            // highlight
            var elements = $("input[type!='submit'], textarea, select");
            elements.focus(function() {
              $(this).parents('li').addClass('highlight');
            });
            elements.blur(function() {
              $(this).parents('li').removeClass('highlight');
            });

            $("#categoryform").validate({
              rules:{
                title:{
                  required:true
                },
                slug:{
                  required:true
                },

                status:{
                  required:true
                }


              },
              messages:{
                title:'Please enter title',
                slug: 'Plese enter slug',
                status: 'Plese choose status'
              }
            });
          });
        </script>

