<!DOCTYPE html>
<html lang="{{App::getLocale()}}">
<head>
 <meta charset="UTF-8">
 <meta name="description" content="">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 <title>
  @if(isset($pageTitle))
  {{$pageTitle}}
  @endif
</title>
  @include('Web::layouts.frontend_css')
   <link href="{{ asset('backend/css/typeahead.css') }}" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{ asset('backend/plugins/select2/dist/css/select2.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/jquery-confirm.css') }}"/>
  <link href="{{ asset('backend/css/summernote.css') }}" type="text/css" rel="stylesheet"/>

</head>
<body>
  <div id="preloader">
    <div class="spinner"></div>
  </div>
  <!-- header for desktop  -->
  @include('Merchant::merchant.merchant_header')

  @include('Admin::error.msg')
  @yield('body')
    <!-- Footer part -->  
    @include('Web::layouts.footer')
    <!-- script -->
    @include('Web::layouts.frontend_js')
    <script src="{{ asset('backend/js/typehead.bundle.js') }}"></script>
    <script src="{{ asset('backend/plugins/select2/dist/js/select2.min.js') }}"></script>
    <script src=" {{ asset('backend/plugins/jquery-validation/jquery.validate.js') }} "></script>
    <script src=" {{ asset('frontend/js/plugins/jquery.toaster.js') }} "></script>
    
    <script src="{{ asset('backend/js/summernote.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/jquery-confirm.js') }}"></script>
    @include('Merchant::merchant.merchant_js_script')


</body>
</html>