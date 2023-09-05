<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">

            <div class="body">

               
                <div class="input-group">

                    <div class="col-md-2 col-sm-2" >
                        <div class="form-line">
                            <label>Filter By Month & Year:</label>

                            {!! Form::text('month',isset($_GET['month']) ? $_GET['month'] :Input::old('month'),['id'=>'month','class' => 'form-control datepicker-here monthpic','data-min-view'=> 'months','data-view'=> 'months',  'data-date-format'=>'MM-yyyy','data-language'=>'en',  'placeholder'=>'Click Here']) !!}

                        </div>

                    </div>


                    <div class="col-md-2 col-sm-2" >
                        <div class="form-line">

                            <label>From Date</label>
                            {!! Form::text('from_date',isset($_GET['from_date']) ? $_GET['from_date'] :Input::old('from_date'),['id'=>'from_date', 'class'=>'form-control', 'placeholder'=>'yyyy-mm-dd']) !!}
                        </div>

                    </div>

                    <div class="col-md-2 col-sm-2" >
                        <div class="form-line">

                            <label>To Date</label>
                            {!! Form::text('to_date',isset($_GET['to_date']) ? $_GET['to_date'] :Input::old('to_date'),['id'=>'to_date', 'class'=>'form-control ','placeholder'=>'yyyy-mm-dd']) !!}
                        </div>

                    </div>  


                    <div class="col-md-2 col-sm-2">
                        <label>&nbsp;</label><br/>
                        {!! Form::submit('Filter', array('class'=>'btn btn-success btn-info','id'=>'button_filter', 'data-placement'=>'right', 'data-content'=>'type code or title or both in specific field then click search button for required information')) !!}
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>