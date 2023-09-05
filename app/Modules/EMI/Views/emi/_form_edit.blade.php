<?php
    use Illuminate\Support\Facades\URL;
    use Illuminate\Support\Facades\Input;
?>

<div class="row">

    <div class="col-md-6">
        <div class="form-group">
            <div class="form-line">
                {!! Form::label('bank_name', 'Select Bank', array('class' => 'col-form-label')) !!}    
                <select name="bank_name" class="form-control" id="bank_name">

                    @if ($data->bank_name == 'ab_bank')
                        <option selected value="ab_bank">AB Bank Limited</option>

                        @elseif($data->bank_name == 'bank_asia')
                            <option selected value="bank_asia">Bank Asia Limited</option>

                            @elseif($data->bank_name == 'brac_bank')
                            <option selected value="brac_bank">Brac Bank Limited</option>

                            @elseif($data->bank_name == 'city_bank')
                            <option selected value="city_bank">City Bank Limited</option>

                            @elseif($data->bank_name == 'dhaka_bank')
                            <option selected value="dhaka_bank">Dhaka Bank Limited</option>

                            @elseif($data->bank_name == 'dutch_bangla_bank')
                            <option selected value="dutch_bangla_bank">Dutch-Bangla Bank Limited</option>

                            @elseif($data->bank_name == 'eastern_bank')
                            <option selected value="eastern_bank">Eastern Bank Limited</option>

                            @elseif($data->bank_name == 'ific_bank')
                            <option selected value="ific_bank">IFIC Bank Limited</option>

                            @elseif($data->bank_name == 'prime_bank')
                            <option selected value="prime_bank">Prime Bank Limited</option>

                            @elseif($data->bank_name == 'mutual_trust_bank')
                            <option selected value="mutual_trust_bank">Mutual Trust Bank Limited</option>

                            @elseif($data->bank_name == 'ucb_bank')
                            <option selected value="ucb_bank">UCB Bank Limited</option>

                            @elseif($data->bank_name == 'standard_chartered_bank')
                            <option selected value="standard_chartered_bank">Standard Bank Limited</option>
                        @endif
                            <option>Select Bank</option>
                            <option value="ab_bank">AB Bank Limited</option>
                            <option value="bank_asia">Bank Asia Limited</option>
                            <option value="brac_bank">BRAC Bank Limited</option>
                            <option value="city_bank">City Bank Limited</option>
                            <option value="dhaka_bank">Dhaka Bank Limited</option>
                            <option value="dutch_bangla_bank">Dutch-Bangla Bank Limited</option>
                            <option value="eastern_bank">Eastern Bank Limited</option>
                            <option value="ific_bank">IFIC Bank Limited</option>
                            <option value="prime_bank">Prime Bank Limited</option>
                            <option value="mutual_trust_bank">Mutual Trust Bank Limited</option>
                            <option value="ucb_bank">United Commercial Bank Limited</option>
                            <option value="standard_chartered_bank">Standard Chartered Bank</option>
                    
                    
                  
                </select>
                <span class="error">{!! $errors->first('bank_name') !!}</span>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <div class="form-line">
                {!! Form::label('emi_month', 'Select Month', array('class' => 'col-form-label')) !!}    
                <select name="emi_month" class="form-control" id="emi_month">
                    <option >Select EMI Month</option>
                    @if ($data->emi_month == '1')
                            <option selected value="1">1 Month</option>
                        @elseif($data->emi_month)
                             <option selected value="2">2 Month</option>

                             @elseif($data->emi_month)
                             <option selected value="2">2 Month</option>

                             @elseif($data->emi_month)
                             <option selected value="3">3 Month</option>

                             @elseif($data->emi_month)
                             <option selected value="4">4 Month</option>

                             @elseif($data->emi_month)
                             <option selected value="5">5 Month</option>

                             @elseif($data->emi_month)
                             <option selected value="6">6 Month</option>

                             @elseif($data->emi_month)
                             <option selected value="7">7 Month</option>

                             @elseif($data->emi_month)
                             <option selected value="8">8 Month</option>

                             @elseif($data->emi_month)
                             <option selected value="9">9 Month</option>

                             @elseif($data->emi_month)
                             <option selected value="10">10 Month</option>

                             @elseif($data->emi_month)
                             <option selected value="11">11 Month</option>

                             @elseif($data->emi_month)
                             <option selected value="12">12 Month</option>

                             @elseif($data->emi_month)
                             <option selected value="13">13 Month</option>

                             @elseif($data->emi_month)
                             <option selected value="14">14 Month</option>

                             @elseif($data->emi_month)
                             <option selected value="15">15 Month</option>

                             @elseif($data->emi_month)
                             <option selected value="16">16 Month</option>

                             @elseif($data->emi_month)
                             <option selected value="17">17 Month</option>

                             @elseif($data->emi_month)
                             <option selected value="18">18 Month</option>

                             @elseif($data->emi_month)
                             <option selected value="19">19 Month</option>

                             @elseif($data->emi_month)
                             <option selected value="20">20 Month</option>

                             @elseif($data->emi_month)
                             <option selected value="21">21 Month</option>

                             @elseif($data->emi_month)
                             <option selected value="22">22 Month</option>

                             @elseif($data->emi_month)
                             <option selected value="23">23 Month</option>
                             @elseif($data->emi_month)
                             <option selected value="24">24 Month</option>
                    @endif
                    <option value="1">1 Month</option>
                    <option value="2">2 Month</option>
                    <option value="3">3 Month</option>
                    <option value="4">4 Month</option>
                    <option value="5">5 Month</option>
                    <option value="6">6 Month</option>
                    <option value="7">7 Month</option>
                    <option value="8">8 Month</option>
                    <option value="9">9 Month</option>
                    <option value="10">10 Month</option>
                    <option value="11">11 Month</option>
                    <option value="12">12 Month</option>
                    <option value="13">13 Month</option>
                    <option value="14">14 Month</option>
                    <option value="15">15 Month</option>
                    <option value="16">16 Month</option>
                    <option value="17">17 Month</option>
                    <option value="18">18 Month</option>
                    <option value="19">19 Month</option>
                    <option value="20">20 Month</option>
                    <option value="21">21 Month</option>
                    <option value="22">22 Month</option>
                    <option value="23">23 Month</option>
                    <option value="24">24 Month</option>
                    
                </select>
                <span class="error">{!! $errors->first('emi_month') !!}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="form-line">
                {!! Form::label('emi_rate', 'EMI Rate', array('class' => 'col-form-label')) !!}    

                {!! Form::number('emi_rate',Input::old('emi_rate'),['id'=>'emi_rate','class' => 'form-control','required'=> 'required', 'placeholder'=>'EMI Rate']) !!}

                <span class="error">{!! $errors->first('emi_rate') !!}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="form-line">
                {!! Form::label('emi_interest_rate', 'EMI Interest Rate', array('class' => 'col-form-label')) !!}

                {!! Form::number('emi_interest_rate',Input::old('emi_interest_rate'),['id'=>'emi_interest_rate','class' => 'form-control', 'placeholder'=>'EMI Interest Rate']) !!}

                <span class="error">{!! $errors->first('emi_interest_rate') !!}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="form-line">
                {!! Form::label('status', 'Status', array('class' => 'col-form-label')) !!}    
                {!! Form::Select('status',array('active'=>'Active','inactive'=>'Inactive','cancel' => 'Cancel'),Input::old('status'),['id'=>'status', 'class'=>'form-control selectheight']) !!}
                <span class="error">{!! $errors->first('status') !!}</span>
            </div>
        </div>
    </div>
        <div class="col-md-6">

                {!! Form::submit('Save changes', ['class' => 'btn btn-primary pull-right btn-sm font-10 m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}&nbsp;
            </div>
    </div>




<!-- @@============================================validate and convet to slug part=========================@@ -->

<script>

    $("#emi_form").validate({
          rules:{
            
            bank_name:{
              required:true
            },
            emi_month:{
              required:true
            },

            emi_rate:{
              required:true
            },

            status:{
              required:true
            }
            
          },
          messages:{
            bank_name:'Please select a bank',
            emi_month: 'Please select emi month',
            emi_rate: 'Please enter emi rate',
            status: 'Please choose status'
          }
    });
</script>

