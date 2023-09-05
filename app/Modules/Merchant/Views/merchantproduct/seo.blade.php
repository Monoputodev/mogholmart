{!! Form::model($seo_data, ['method' => 'PATCH', 'files'=> true, "class"=>"seoformdata", 'id' => 'seoform']) !!}

<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
?>


<div class="row">

    <div class="col-md-6">
        <div class="form-group">
           
            <div class="form-line">
                {!! Form::label('meta_title', 'Meta Title', array('class' => 'col-form-label')) !!}     

                {!! Form::text('meta_title', Input::old('meta_title'),['id'=>'meta_title','class' => 'form-control','required'=> 'required',  'meta_title'=>'Enter product meta_title']) !!}
                <span class="error">{!! $errors->first('meta_title') !!}</span>
            </div>
        </div>
        
        <div class="form-group">
            
            <div class="form-line">
                {!! Form::label('meta_keywords', 'Meta Keywords', array('class' => 'col-form-label')) !!}     

                {!! Form::text('meta_keywords',Input::old('meta_keywords'),['id'=>'meta_keywords','class' => 'form-control','required'=> 'required', 'title'=>'Enter product meta_keywords' ]) !!}

                <span class="error">{!! $errors->first('meta_keywords') !!}</span>
            </div>
        </div>
         
        <div class="form-group">
            
            <div class="form-line">
                {!! Form::label('meta_image_link', 'Meta Image', array('class' => 'col-form-label')) !!}
                    
                {!! Form::text('meta_image_link',Input::old('meta_image_link'),['id'=>'meta_image_link','class' => 'form-control','title'=>'Enter Brand Meta Image']) !!}

                <span class="error">{!! $errors->first('meta_image_link') !!}</span>
            </div>
        </div>
        


    </div>

    

    <div class="col-md-6">
        <div class="form-group">
            
            <div class="form-line">
                {!! Form::label('meta_description', 'Meta description', array('class' => 'col-form-label')) !!}
                
                {!! Form::textarea('meta_description',Input::old('meta_description'),['id'=>'meta_description','class' => 'textarea form-control', 'title'=>'Enter meta_description', 'rows'=>'9', 'cols'=>'50']) !!}

                <span class="error">{!! $errors->first('meta_description') !!}</span>
            </div>
            
        </div>
         
        <div class="form-group">
            <div class="col-md-12">
              

                <input type="submit" name="save_continue" class="btn btn-primary pull-right btn-sm font-10 m-r-15" value="Save Change">
                <input type="hidden" name="product_id" id="product_id" value="{{$product->id}}">


            </div>
        </div>
    </div>
</div>


{!! Form::close() !!}
<!-- @@============================================validate and convet to slug part=========================@@ -->

