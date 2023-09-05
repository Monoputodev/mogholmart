@extends('Admin::layouts.master')
@section('body')

    <div class="block-header block-header-2">
        <h2 class="pull-left">
          View Of Merchant
        </h2>    
        <a style="margin-left: 10px;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>            
    </div>
    <div class="row clearfix">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body">

                    <div class="table-responsive">  
                       
                    <table id="" class="table table-bordered  table-striped">
                    <tr>
                        <th>Shop Name</th>
                        <td>{{ isset($data->shop_name)?ucfirst($data->shop_name):''}}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ isset($data->email)?ucfirst($data->email):''}}</td>
                    </tr>
                    <tr>
                        <th>Merchant Name</th>
                        <td>{{ isset($data->first_name)?ucfirst($data->first_name):''}} {{ isset($data->last_name)?ucfirst($data->last_name):''}}</td>
                    </tr>
                    <tr>
                        <th>Mobile No</th>
                        <td>{{ isset($data->mobile_no)?ucfirst($data->mobile_no):''}}</td>
                    </tr>
                    
                    <tr>
                        <th>Shop Address</th>
                        <td>{{ isset($data->shop_address)?ucfirst($data->shop_address):'' }}</td>
                    </tr>
                    <tr>
                        <th>Shop Description</th>
                        <td>{{ isset($data->shop_description)?ucfirst($data->shop_description):'' }}</td>
                    </tr> 
                    <tr>
                        <th>Agreement Type</th>
                        <td>{{ isset($data->merchant_agreement)?ucfirst($data->merchant_agreement):''}}</td>
                    </tr>
                    <tr>
                        <th>Agreement Date</th>
                        <td>{{ isset($data->agreement_date)?ucfirst($data->agreement_date):'' }}</td>
                    </tr>
                    <tr>
                        <th>Agreement Details</th>
                        <td>{!! isset($data->agreement_details)?ucfirst($data->agreement_details):'' !!}</td>
                    </tr>
                    <tr>
                        <th>Contact Person Details</th>
                        <td>{{ isset($data->first_contact_person_details)?ucfirst($data->first_contact_person_details):'' }}
                            <br>
                            {{ isset($data->second_contact_person_details)?ucfirst($data->second_contact_person_details):'' }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{{ isset($data->status)?ucfirst($data->status):'' }}</td>
                    </tr>
                    
                    <tr>
                        <th>Image</th>
                        <td>
                            @if(isset($data->image) > 0 && !empty($data->image))
                                
                            <a target="_blank" href="{{URL::to('')}}/uploads/user/{{$data->image}}">
                                <img width="50" height="50" src="{{URL::to('')}}/uploads/user/{{$data->image}}">            
                            </a>
                            @endif
                        </td>
                    </tr>

                </table>
            </div>
        </div>
        <!-- end panel-body -->
    </div>
    <!-- end panel -->
</div>
</div>
@endsection  