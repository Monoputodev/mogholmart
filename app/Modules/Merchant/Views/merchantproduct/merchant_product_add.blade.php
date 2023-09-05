@extends('Merchant::merchant.merchant_master')
@section('body')


<section class="top-teacher-area section-padding-50" style="background-image: url({{ asset('frontend') }}/ img/core-img/texture.png);">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading">
                    <h2>UPDATE PRODUCT</h2>
                    <h3>{{$varifaid_user->shop_name}}</h3>
                    <a href="javascript:history.back()" class="btn-style-1 float-right">Back</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="course--content">

                    <div class="clever-tabs-content">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="basic-information-tab" data-toggle="tab" href="#basic-information" role="tab" aria-controls="basic-information" aria-selected="false">Basic information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="image-tab" data-toggle="tab" href="#image" role="tab" aria-controls="image" aria-selected="true">Image</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="seo-tab" data-toggle="tab" href="#seo" role="tab" aria-controls="seo" aria-selected="true">SEO</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="category-tab" data-toggle="tab" href="#category" role="tab" aria-controls="category" aria-selected="true">Category</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="attribute-tab" data-toggle="tab" href="#attribute" role="tab" aria-controls="attribute" aria-selected="true">Attribute</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="stock-tab" data-toggle="tab" href="#stock" role="tab" aria-controls="stock" aria-selected="true">Stock</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="true">Review</a>
                            </li>

                            
                        </ul>

                        <div class="tab-content" id="myTabContent">
                            <!-- Tab Text -->
                            <div class="tab-pane fade show active" id="basic-information" role="tabpanel" aria-labelledby="">

                                <!-- About Course -->
                                <div class="about-course mb-30">

                                    <div class="contact-form">

                                        @include('Merchant::merchantproduct.besic_info')

                                    </div>

                                </div>

                            </div>

                            <!-- Tab Text -->
                            <div class="tab-pane fade" id="image" role="tabpanel" aria-labelledby="">
                                <div class="clever-curriculum">

                                    <!-- About Curriculum -->
                                    <div class="clever-description">

                                        <!-- About Course -->
                                        <div class="about-course mb-30">
                                            @include('Merchant::merchantproduct.product_image')
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <!-- Tab Text -->
                            <div class="tab-pane fade" id="description" role="tabpanel" aria-labelledby="">
                                <div class="clever-curriculum">

                                    <!-- About Curriculum -->
                                    <div class="clever-description">

                                        <!-- About Course -->
                                        <div class="about-course mb-30">
                                           @include('Merchant::merchantproduct.description')
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <!-- Tab Text -->
                            <div class="tab-pane fade" id="seo" role="tabpanel" aria-labelledby="">
                                <div class="clever-curriculum">

                                    <!-- About Curriculum -->
                                    <div class="clever-description">

                                        <!-- About Course -->
                                        <div class="about-course mb-30">
                                            @include('Merchant::merchantproduct.seo')
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <!-- Tab Text -->
                            <div class="tab-pane fade" id="category" role="tabpanel" aria-labelledby="">
                                <div class="clever-curriculum">

                                    <!-- About Curriculum -->
                                    <div class="clever-description">

                                        <!-- About Course -->
                                        <div class="about-course mb-30">
                                            @include('Merchant::merchantproduct.category')
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <!-- Tab Text -->
                            <div class="tab-pane fade" id="attribute" role="tabpanel" aria-labelledby="">
                                <div class="clever-curriculum">

                                    <!-- About Curriculum -->
                                    <div class="clever-description">

                                        <!-- About Course -->
                                        <div class="about-course mb-30">
                                             @include('Merchant::merchantproduct.attribute')
                                            
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <div class="tab-pane fade" id="stock" role="tabpanel" aria-labelledby="">
                                <div class="clever-curriculum">

                                    <!-- About Curriculum -->
                                    <div class="clever-description">

                                        <!-- About Course -->
                                        <div class="about-course mb-30">
                                            @include('Merchant::merchantproduct.inventory_form')
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="">
                                
                                <div class="clever-curriculum">

                                    <!-- About Curriculum -->
                                    <div class="clever-description">

                                        <!-- About Course -->
                                        <div class="about-course mb-30">
                                             @include('Merchant::merchantproduct.review')
                                        </div>

                                    </div>

                                </div>

                            </div>
                          

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection