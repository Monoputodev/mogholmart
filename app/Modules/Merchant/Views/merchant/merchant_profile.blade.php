@extends('Merchant::merchant.merchant_master')
@section('body')

  <section class="top-teacher-area section-padding-50" style="background-image: url({{URL::to('frontend')}}/img/core-img/texture.png);">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading">
                        <h2>MY PROFILE</h2>
                        <h3>{{$varifaid_user->shop_name}}</h3>
                        <a href="javascript:history.back()" class="btn-style-1 float-right">Back</a>
                    </div>
                </div>
            </div>

            <div class="row">
              <div class="col-lg-12">
          <div class="clever-description">
            <div class="all-instructors mb-30">
                        <h4>My Profile</h4>
                       
                          <div class="profile-details" >                          
                            <button data-toggle="modal" data-target="#edit_profile" class="btn-style-1 pull-right">Edit Profile</button>
                <b>Email</b> : {{$varifaid_user->email}}
                <br/>
                <b>Phone</b> : {{$varifaid_user->mobile_no}}
                          </div>                                        
                       
                    </div>
                </div>

                <div class="clever-description">
            <div class="all-instructors mb-30">
                        <h4>Shop</h4>
                       
                          <div class="profile-details" >
                <b>Shop Name</b> : {{$varifaid_user->shop_name}}
                <br/>
                <b>Shop Address</b> : {{$varifaid_user->shop_address}}
                <br/>
                <b>Shop Description</b> : {{$varifaid_user->shop_description}}
                          </div>                                        
                       
                    </div>
                </div>

          <div class="clever-description">
            <div class="all-instructors mb-30">
                        <h4>Agreement</h4>
                       
                          <div class="profile-details" >
                <b>Agreement Date</b> : {{$varifaid_user->agreement_date}}
                <br/>
                <b>Details of Agreement</b> : {!!$varifaid_user->agreement_details!!}
                          </div>                                        
                       
                    </div>
                </div>

                <div class="clever-description">
            <div class="all-instructors mb-30">
                        <h4>Contact Person</h4>
                       
                            <div class="profile-details" >
                  <b>First Contact Person</b> : {{$varifaid_user->first_contact_person_details}}
                  <br/>
                  <b>Second Contact Person</b> : {{$varifaid_user->second_contact_person_details}}
                            </div>                                        
                        
                    </div>
                </div>

        </div>
            </div>

        </div>
    </section>



    <!-- Large Size -->
    <div class="modal fade" id="edit_profile" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="largeModalLabel">Edit My Profile</h4>
                    <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">&times;</span>
          </button>                    
                </div>
                <div class="modal-body">
                    <div class="contact-form">

                      <?php $url = route('merchant.post.edit.profile'); ?>
                            {!! Form::open(array('url' => $url, 'method' => 'post', 'class' => "edit-formas")) !!}
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <input name="shop_name" required="required" type="text" class="form-control"  placeholder="Shop Name *" value="{{$varifaid_user->shop_name}}">

                                        <input type="hidden" name="user_id" value="{{$varifaid_user->users_id}}">
                                    </div>
                                </div>
                                
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <textarea name="shop_address" class="form-control" cols="30" rows="3" placeholder="Shop Address">{{$varifaid_user->shop_address}}</textarea>
                                    </div>
                                </div>

                                 <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <textarea name="shop_description" class="form-control" cols="30" rows="5" placeholder="Shop Description">{{$varifaid_user->shop_description}}</textarea>
                                    </div>
                                </div>

                                 <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <textarea name="first_contact_person_details" class="form-control" cols="30" rows="5" placeholder="First Contact Person">{{$varifaid_user->first_contact_person_details}}</textarea>
                                    </div>
                                </div>

                                 <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <textarea name="second_contact_person_details" class="form-control" cols="30" rows="5" placeholder="Second Contact Person">{{$varifaid_user->second_contact_person_details}}</textarea>
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <button type="submit" class="btn clever-btn w-25 pull-right">Update</button>
                                </div>
                            </div>
                        {!! Form::close() !!}

                    </div>
                </div>
                
            </div>
        </div>
    </div>

@endsection

