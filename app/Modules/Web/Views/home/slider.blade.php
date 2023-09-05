<section>
  <div class="container">
    <div class="row">
        <div class="col-xl-3 col-md-3 col-lg-3">
            <div class="moduletable_menu">
                <h3>Products Catagory</h3>
                <ul class="menu">

       
                    @foreach($categoryItem as $item)
                    <li>
                        <a href="{{route('category.slug',['slug' => $item->slug])}}">
                            {{$item->title}}
                        <span class="indicator" style="float: right;"><i class="ti-angle-right"></i></span>
                    </a>
                </li>
                @endforeach


            </ul>
        </div>
    </div>
    <div class="col-xl-9 col-md-9 col-lg-9 col-sm-12">
      <div class="flexslider">
         <ul class="slides">
            @if (isset($slider_data) && !empty ($slider_data))
            @foreach ($slider_data as $data)
            <li>
               <img src="{{URL::to('uploads/slider')}}/{{$data->image_link}}" alt="Los Angeles" style="width:100%;">
           </li>
           @endforeach
           @endif
       </ul>
   </div>
</div>
</div>
</div>

</section>
