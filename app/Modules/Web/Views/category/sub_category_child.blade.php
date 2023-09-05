@extends('Web::layouts.master')
@section('body')

<div class="breadcrumbs">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="bread-inner">
          <ul class="bread-list">
            <li><a href="{{URL::to('/')}}">Home<i class="ti-arrow-right"></i></a></li>
            <li><a href="{{route('category.child.slug',['main_category_slug' => $main_category_data->category_slug, 'slug' => $child_category_data->category_slug ])}}">{{$child_category_data->category_title}} <i class="ti-arrow-right"></i></a></li>

            <li>{{$category_data->category_title}}</li>
          </ul>
          @if(str_slug($main_category_data->category_title)=='medicine')
          <a href="{{route('customer.prescription')}}" style="float:right!important; margin-left: 10px;" class="btn btn-danger btn-sm"><i class="ti-tablet"></i> Upload prescription</a>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
<div class="col-12" style="text-align:center">
  @if(!empty ($category_data->banner_link))
  <img src="{{URL::to('uploads/category/banner')}}/{{$category_data->banner_link}}" >
  @endif
</div>
<section class="small-banner section">
    <div class="row">
        <div class="col-12">
          <div class="section-title">
            <h2>Product Categories</h2>
          </div>
        </div>
      </div>
    <div class="container-fluid">
      <div class="row">
       
          @if(count($sub_category) > 0)
        @foreach($sub_category as $sub_category_data)
        <div class="col-lg-3 col-md-6 col-12">
          
          <a target="__blank" href="{{route('category.child.slug',[
		'main_category_slug' => $category_data->category_slug,
		'slug' => $sub_category_data->category_slug
		])}}">
          <div class="categoryBox">
            <div class="categoryName">{{$sub_category_data->category_title}}</div>
            <div class="categoryImg"><img src="{{ URL::to('uploads/category/orginal_image') }}/{{$sub_category_data->image_link}}" alt="{{$sub_category_data->category_title}}"></div>
          </div>
          </a>

        </div>
        @endforeach
        @endif
        
       
      </div>
    </div>
  </section>
<section class="product-area shop-sidebar shop section">
  <div class="col-12">
    <div class="row">
      <div class="col-lg-3 col-md-4 col-12">
        <div class="shop-sidebar">
          <!-- Single Widget -->
          @include('Web::category.related_category',['type' => 'first-category'])
          <!--/ End Single Widget -->
          <!-- Shop By Price -->
          @include('Web::category.price')
          @include('Web::category.attribute')
          @include('Web::category._filter_form')
          
        </div>
      </div>
      <div class="col-lg-9 col-md-8 col-12">
        @include('Web::category._product')
        
      </div>
    </div>
  </div>
</section>
@endsection